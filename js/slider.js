document.addEventListener("DOMContentLoaded", function () {
  const mainCarousel = new Swiper(".main-carousel", {
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

  const catCarousel = new Swiper(".cat-carousel", {
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
    breakpoints: {
      1024: {
        slidesPerView: 3,
      },
      2200: {
        slidesPerView: 4,
      },
    },
  });

  const formatCarousel = new Swiper(".format-carousel", {
    loop: true,
    slidesPerView: 1,
    spaceBetween: 0,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    breakpoints: {
      768: {
        slidesPerView: 2.2,
      },
      1024: {
        slidesPerView: 3.2,
      },
      2200: {
        slidesPerView: 4.2,
      },
    },
  });

  const allFormatCarousel = new Swiper(".all-main-carousel", {
    loop: true,
    slidesPerView: 1.2,
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
