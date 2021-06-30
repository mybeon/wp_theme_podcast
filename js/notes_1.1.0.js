const ulNotes = document.querySelector("#all_notes");
const createNoteContainer = document.querySelector("#create_note");
const createNoteBtn = createNoteContainer.querySelector("button");

ulNotes.addEventListener("click", (e) => {
  //delete statement

  if (e.target.className == "delete_note") {
    let parentLi = e.target.closest("li");
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
        }, 550);
      })
      .catch((error) => {
        console.log("error", error);
      });
  }

  //edit statement

  if (e.target.className == "edit_note") {
    let parentLi = e.target.closest("li");
    let inputNote = parentLi.querySelector("input");
    let inputText = parentLi.querySelector("textarea");
    let saveBtnsec = parentLi.querySelector(".save_note");

    if (parentLi.dataset.edit == "no") {
      e.target.textContent = "cancel";
      inputNote.readOnly = false;
      inputText.readOnly = false;
      inputNote.classList.add("flashy_note");
      inputText.classList.add("flashy_note");
      parentLi.setAttribute("data-edit", "yes");
      saveBtnsec.style.display = "block";
    } else {
      e.target.textContent = "edit";
      inputNote.classList.remove("flashy_note");
      inputText.classList.remove("flashy_note");
      inputNote.readOnly = true;
      inputText.readOnly = true;
      saveBtnsec.style.display = "none";
      parentLi.setAttribute("data-edit", "no");
    }
  }

  //save statement

  if (e.target.className == "save_note") {
    let parentLi = e.target.closest("li");
    let inputNote = parentLi.querySelector("input");
    let inputText = parentLi.querySelector("textarea");
    let editBtn = parentLi.querySelector(".edit_note");
    let saveBtnsec = e.target;

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
  }
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
    let showAlert = createNoteContainer.querySelector("p");
    showAlert.classList.add("alert_active");
    setTimeout(() => {
      showAlert.classList.remove("alert_active");
    }, 5000);
  }
});
