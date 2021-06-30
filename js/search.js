const body = document.querySelector("body");
htmlSearch();
const openBtn = document.querySelector(".search_btn");
const closeBtn = document.querySelector(".fa-times");
const searchOverlay = document.querySelector(".search_overlay");
const searchInput = document.querySelector("#text_input");
const searchArea = document.querySelector(".search_results");
const allInputs = document.querySelectorAll("input, textarea");
let testOverlay = false;
let isSpinnerVisibile = false;
let isfocused = false;
let previousValue;
let typeTimer;

allInputs.forEach((input) => {
  input.addEventListener(
    "focusin",
    () => (isfocused = true),
    input.addEventListener("focusout", () => (isfocused = false))
  );
});

document.addEventListener("keydown", keyPressDispatcher);
openBtn.addEventListener("click", openOverlay);
closeBtn.addEventListener("click", closeOverlay);
searchInput.addEventListener("keyup", typingLogic);

function typingLogic() {
  if (previousValue != searchInput.value) {
    clearTimeout(typeTimer);

    if (searchInput.value) {
      setTimeout(() => {
        if (!isSpinnerVisibile) {
          searchArea.innerHTML =
            '<i class="fas fa-spinner" aria-hidden="true"></i>';
          isSpinnerVisibile = true;
        }
      }, 200);

      typeTimer = setTimeout(searchResults, 1000);
    } else {
      searchArea.innerHTML = "";
      isSpinnerVisibile = false;
    }
  }
  previousValue = searchInput.value;
}
/*
function searchResults() {
  Promise.all([
    fetch(
      "http://localhost/wordev/wp-json/wp/v2/posts?search=" + searchInput.value
    ).then((res) => res.json()),
    fetch(
      "http://localhost/wordev/wp-json/wp/v2/pages?search=" + searchInput.value
    ).then((res) => res.json()),
  ])
    .then((data) => {
      for (let i = 0; i < data.length; i++) {
        var results = data[i].concat(data[(i = +1)]);
      }
      searchArea.innerHTML = `
      <h3>general information</h3>
      ${results.length ? "<ul>" : "<p>no result found</p>"}
      ${results
        .map(
          (item) =>
            `<li><a href="${item.link}" target="_blank">${
              item.title.rendered
            }</a>${item.type == "post" ? ` by ${item.theauthor}` : ""}</li>`
        )
        .join("")}
      ${results.length ? "</ul>" : ""}
      `;
    })
    .catch(() => (searchArea.innerHTML = "<p>search failed</p>"));
  isSpinnerVisibile = false;
}
*/
function searchResults() {
  fetch(
    gocastVariables.main_url +
      "/wp-json/gocast_api/v1/api?search=" +
      searchInput.value
  )
    .then((res) => res.json())
    .then((data) => {
      searchArea.innerHTML = `
      <div class="general_result">
      <h3>general information</h3>
      ${data.generalinfo.length ? "<ul>" : "<p>no result found</p>"}
      ${data.generalinfo.map(
        (item) =>
          `<li><a href="${item.link}" target="_blank">${item.title}</a>${
            item.type == "post" ? ` by ${item.author}` : ""
          }</li>`
      )}
      ${data.length ? "</ul>" : ""}
      </div>
      <div>
      <h3>Podcasts</h3>
      ${
        data.podcasts.length
          ? "<ul>"
          : `<p>no podcast found. <a href="${gocastVariables.main_url}/episodes">view all</a></p>`
      }
      ${data.podcasts.map(
        (item) =>
          `<div class="podcast_result">
            <a href="${item.link}" target="_blank">${item.image}</a>
            <li><a href="${item.link}" target="_blank">${item.title}</a></li>
          </div>`
      )}
      ${data.length ? "</ul>" : ""}
      </div>
      `;
    });
  isSpinnerVisibile = false;
}

function openOverlay() {
  searchOverlay.classList.add("search_active");
  body.style.overflowY = "hidden";
  searchInput.value = "";
  setTimeout(() => searchInput.focus(), 200);
  testOverlay = true;
}

function closeOverlay() {
  searchOverlay.classList.remove("search_active");
  body.style.overflowY = "scroll";
  testOverlay = false;
}

function keyPressDispatcher(e) {
  if (e.keyCode == 83 && !testOverlay && !isfocused) {
    openOverlay();
  }

  if (e.keyCode == 27 && testOverlay) {
    closeOverlay();
  }
}

function htmlSearch() {
  body.insertAdjacentHTML(
    "beforeend",
    `
  <div class="search_overlay">
      <i class="fas fa-times"></i>
      <div class="search_input">
        <h3>what are you looking for</h3>
        <div>
        <i class="fas fa-search" aria-hidden="true"></i>
        <input id="text_input" type="text" placeholder="search">
        </div>
      </div>
      <div class="search_container">
            <div class="search_results">
      </div>
      </div>
    </div>
  `
  );
}

/** Preloader */

const customPreloader = document.querySelector(".preloader");
window.addEventListener("load", () =>
  customPreloader.classList.add("preloader_finish")
);
