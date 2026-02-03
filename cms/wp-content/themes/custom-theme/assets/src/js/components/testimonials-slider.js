/**
 * Testimonials Slider
 */

export default class TestimonialsSlider {
  constructor() {
    this.sliders = document.querySelectorAll('.testimonials--slider');
    this.init();
  }
  
  init() {
    if (this.sliders.length === 0) return;
    
    this.sliders.forEach(slider => {
      this.initSlider(slider);
    });
  }
  
  initSlider(sliderElement) {
    const autoplay = sliderElement.dataset.autoplay === 'true';
    
    new Swiper(sliderElement, {
      slidesPerView: 1,
      spaceBetween: 30,
      loop: true,
      autoplay: autoplay ? {
        delay: 5000,
        disableOnInteraction: false,
      } : false,
      navigation: {
        nextEl: sliderElement.querySelector('.testimonials__button--next'),
        prevEl: sliderElement.querySelector('.testimonials__button--prev'),
      },
      pagination: {
        el: sliderElement.querySelector('.testimonials__pagination'),
        clickable: true,
      },
      breakpoints: {
        768: {
          slidesPerView: 2,
        },
        1024: {
          slidesPerView: 3,
        },
      },
    });
  }
}

// Initialize
new TestimonialsSlider();