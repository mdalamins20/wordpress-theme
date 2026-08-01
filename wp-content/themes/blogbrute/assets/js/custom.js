function featuredStory() {
  var featuredStory = new Swiper('.featured-story-slider', {
    direction: 'horizontal',
    loop: true,
    spaceBetween: 16,
    autoplay:{
      delay:4000,
    },
    speed:700,
    slidesPerView: 4,
    // Navigation arrows
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev'
    },
    // Default (mobile first)
    slidesPerView: 1,
    breakpoints: {
      // Mobile
      576: {
        slidesPerView: 2,
      },
      // Tablet
      768: {
        slidesPerView: 3,
      },

      // Desktop
      992: {
        slidesPerView: 4,
      }
    },

  });              
}
featuredStory(); 