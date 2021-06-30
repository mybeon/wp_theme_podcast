const deleteBtn = document.querySelectorAll(".delete_note");
const editBtn = document.querySelectorAll(".edit_note");
const saveBtn = document.querySelectorAll(".save_note");
const createNoteContainer = document.querySelector("#create_note");
const createNoteBtn = createNoteContainer.querySelector("button");
const ulNotes = document.querySelector("#all_notes");

//delete function
deleteBtn.forEach((e) => {
  let parentLi = e.closest("li");
  e.addEventListener(
    "click",
    () => {
      fetch(
        gocastVariables.main_url +
          "/wp-json/wp/v2/usernote/" +
          parentLi.dataset.id,
        {
          method: "DELETE",
          credentials: "same-origin",
          headers: {
            "X-WP-Nonce": gocastVariables.nonce,
          },
        }
      )
        .then((succes) => {
          console.log(succes);
          parentLi.style.opacity = "0";
          setTimeout(() => {
            parentLi.style.display = "none";
          }, 450);
        })
        .catch((error) => {
          console.log("error", error);
        });
    },
    true
  );
});

// edit function
editBtn.forEach((e) => {
  let parentLi = e.closest("li");
  let inputNote = parentLi.querySelector("input");
  let inputText = parentLi.querySelector("textarea");
  let saveBtnsec = parentLi.querySelector(".save_note");
  e.addEventListener("click", () => {
    if (parentLi.dataset.edit == "no") {
      makeNoteEditable(e, parentLi, inputNote, inputText, saveBtnsec);
    } else {
      makeNoteNoEditable(e, parentLi, inputNote, inputText, saveBtnsec);
    }
  });
});

function makeNoteEditable(e, parentLi, inputNote, inputText, saveBtnsec) {
  e.textContent = "cancel";
  inputNote.readOnly = false;
  inputNote.classList.add("flashy_note");
  inputText.readOnly = false;
  inputText.classList.add("flashy_note");
  parentLi.setAttribute("data-edit", "yes");
  saveBtnsec.style.display = "block";
}

function makeNoteNoEditable(e, parentLi, inputNote, inputText, saveBtnsec) {
  e.textContent = "edit";
  inputNote.classList.remove("flashy_note");
  inputText.classList.remove("flashy_note");
  inputNote.readOnly = true;
  inputText.readOnly = true;
  saveBtnsec.style.display = "none";
  parentLi.setAttribute("data-edit", "no");
}

// Save function

saveBtn.forEach((e) => {
  let parentLi = e.closest("li");
  let inputNote = parentLi.querySelector("input");
  let inputText = parentLi.querySelector("textarea");
  let saveBtnsec = parentLi.querySelector(".save_note");
  let editBtn = parentLi.querySelector(".edit_note");

  e.addEventListener("click", () => {
    let data = {
      title: inputNote.value.trim(),
      content: inputText.value.trim(),
    };

    fetch(
      gocastVariables.main_url +
        "/wp-json/wp/v2/usernote/" +
        parentLi.dataset.id,
      {
        method: "POST",
        credentials: "same-origin",
        headers: {
          "X-WP-Nonce": gocastVariables.nonce,
          "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
      }
    )
      .then((succes) => {
        console.log(succes);
        editBtn.textContent = "edit";
        inputNote.classList.remove("flashy_note");
        inputText.classList.remove("flashy_note");
        inputNote.readOnly = true;
        inputText.readOnly = true;
        saveBtnsec.style.display = "none";
        parentLi.setAttribute("data-edit", "no");
      })
      .catch((error) => {
        console.log("error", error);
      });
  });
});

// create note function
createNoteBtn.addEventListener("click", () => {
  let input = createNoteContainer.querySelector("input");
  let textarea = createNoteContainer.querySelector("textarea");

  let data = {
    title: input.value.trim(),
    content: textarea.value.trim(),
    status: "publish",
  };
  if (data.title != "" && data.content != "") {
    createNoteContainer.classList.add("bar");
    createNoteContainer.querySelector("p").classList.remove("alert_active");

    fetch(gocastVariables.main_url + "/wp-json/wp/v2/usernote/", {
      method: "POST",
      //credentials= "same-origin",
      headers: {
        "X-WP-Nonce": gocastVariables.nonce,
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
    })
      .then((res) => {
        return res.json();
      })
      .then((data) => {
        input.value = "";
        textarea.value = "";
        ulNotes.insertAdjacentHTML(
          "afterbegin",
          `
        <li data-id="${data.id}" data-edit="no">
          <div>
              <label for="note_title">note title</label>
              <button class="edit_note">edit</button><button class="delete_note">delete</button>
          </div>
          <input class="note_title" type="text" value="${data.title.raw}"  readonly>
          <label for="note_desc">note description</label>
          <textarea name="note_desc" id="note_desc" cols="30" rows="10" readonly>${data.content.raw}</textarea>
          <button class="save_note">save</button>
        </li>
  
        `
        );
      });
  } else {
    createNoteContainer.querySelector("p").classList.add("alert_active");
  }
});
