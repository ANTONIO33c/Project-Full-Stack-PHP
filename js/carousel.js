
var swiper = new Swiper('#banners', {
  loop: true,
  speed: 1000,
  autoplay: {
    delay: 2000,
    disableOnInteraction: false,
  },
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  slidesPerView: 1, // mostra 1 slide por vez
  spaceBetween: 0,  // sem espaço entre slides
});
