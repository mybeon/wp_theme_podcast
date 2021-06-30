const swiper = new Swiper(".swiper-container", {
  direction: "horizontal",
  slidesPerView: 3,
  loop: true,
  spaceBetween: 30,

  navigation: {
    nextEl: ".swiperNext",
    prevEl: ".swiperPrev",
  },
});
