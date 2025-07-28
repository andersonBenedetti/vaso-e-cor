document.addEventListener("DOMContentLoaded", function () {
  const swiperCarrossel = new Swiper(".swiper-carrossel", {
    loop: true,
    slidesPerView: 1,
    spaceBetween: 0,
    autoplay: {
      delay: 6000,
      disableOnInteraction: false,
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
  });
});
