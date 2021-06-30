const audio = document.querySelectorAll(".audio_player audio");
const playBtn = document.querySelectorAll(".play_btn");
const current_time = document.querySelectorAll(".current_time");
const totalTime = document.querySelectorAll(".total_time");
const volumeInput = document.querySelectorAll(".volume input");
const volumeBtn = document.querySelectorAll(".volume button");
const timeInputRange = document.querySelectorAll(".progress_bar input");

for (let i = 0; i < audio.length; i++) {
  playBtn[i].addEventListener("click", () => {
    if (audio[i].paused) {
      audio[i].play();
      playBtn[i].innerHTML = '<i class="fas fa-pause-circle"></i>';
    } else {
      audio[i].pause();
      playBtn[i].innerHTML = '<i class="fas fa-play-circle"></i>';
    }
  });

  // INPUT RANGE

  timeInputRange[i].value = 0;

  timeInputRange[i].addEventListener("change", () => {
    var timeRange = audio[i].currentTime / audio[i].duration;
    audio[i].currentTime = (timeInputRange[i].value * audio[i].duration) / 100;
  });

  audio[i].addEventListener("timeupdate", () => {
    current_time[i].innerHTML = `${Math.floor(
      parseInt(audio[i].currentTime / 60)
    )}:${Math.floor(parseInt(audio[i].currentTime % 60))} s`;

    var timeRange = audio[i].currentTime / audio[i].duration;
    timeInputRange[i].value = timeRange * 100;
  });

  audio[i].addEventListener("loadedmetadata", () => {
    totalTime[i].innerHTML = `${Math.floor(
      parseInt(audio[i].duration / 60)
    )}:${Math.floor(parseInt(audio[i].duration % 60))} s`;
  });

  // VOLUME

  volumeBtn[i].addEventListener("click", () => {
    if (audio[i].muted) {
      audio[i].muted = false;
      volumeBtn[i].innerHTML = '<i class="fas fa-volume-up"></i>';
    } else {
      audio[i].muted = true;
      volumeBtn[i].innerHTML = '<i class="fas fa-volume-mute"></i>';
    }
  });

  volumeBtn[i].addEventListener("mouseover", () => {
    volumeInput[i].style.opacity = "1";
    volumeInput[i].style.transform = "translatey(0)";
  });

  volumeBtn[i].addEventListener("mouseout", () => {
    setTimeout(() => {
      volumeInput[i].style.opacity = "0";
      volumeInput[i].style.transform = "translatey(20px)";
    }, 5000);
  });

  volumeInput[i].value = 100;
  volumeInput[i].addEventListener("change", () => {
    audio[i].volume = volumeInput[i].value / 100;
  });
}
