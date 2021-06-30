const likeBtn = document.querySelector(".like_button");

likeBtn.addEventListener("click", clickDispatcher);

function clickDispatcher() {
  if (likeBtn.dataset.liked == "true") {
    removeLike();
  } else {
    addLike();
  }
}

function removeLike() {
  fetch(
    gocastVariables.main_url +
      "/wp-json/gocast_api/likes?likeID=" +
      likeBtn.getAttribute("like-id"),
    {
      method: "DELETE",
      credentials: "same-origin",
      headers: {
        "X-WP-Nonce": gocastVariables.nonce,
      },
    }
  )
    .then((res) => {
      return res.json();
    })
    .then((data) => {
      likeBtn.dataset.liked = "false";
      let likeCount = parseInt(likeBtn.querySelector("span").innerHTML, 10);
      likeCount--;
      likeBtn.querySelector("span").innerHTML = likeCount;
      likeBtn.setAttribute("like-id", "");
      console.log(data);
    });
}

function addLike() {
  let data = {
    postID: likeBtn.getAttribute("post-id"),
  };
  fetch(gocastVariables.main_url + "/wp-json/gocast_api/likes", {
    method: "POST",
    credentials: "same-origin",
    headers: {
      "Content-Type": "application/json",
      "X-WP-Nonce": gocastVariables.nonce,
    },
    body: JSON.stringify(data),
  })
    .then((res) => {
      if (res.ok) {
        return res.json();
      } else {
        console.log(res, "error");
      }
    })
    .then((data) => {
      likeBtn.dataset.liked = "true";
      let likeCount = parseInt(likeBtn.querySelector("span").innerHTML, 10);
      likeCount++;
      likeBtn.querySelector("span").innerHTML = likeCount;
      likeBtn.setAttribute("like-id", data.toString());
    });
}
