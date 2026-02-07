/**
 * Hero Slider
 */

export default class HeroSlider {
  constructor() {
    this.sliders = document.querySelectorAll('.hero-slider');
    this.init();
  }
  
  init() {
    if (this.sliders.length === 0) {
      console.log('Keine Hero Sliders gefunden');
      return;
    }
    
    if (typeof Swiper === 'undefined') {
      console.error('Swiper nicht geladen!');
      return;
    }
    
    console.log('Hero Slider Init:', this.sliders.length);
    
    this.sliders.forEach(slider => {
      this.initSlider(slider);
    });
  }
  
  initSlider(sliderElement) {
    const autoplay = sliderElement.dataset.autoplay === 'true';
    const delay = parseInt(sliderElement.dataset.delay) || 5000;
    const loop = sliderElement.dataset.loop === 'true';
    
    const slideCount = sliderElement.querySelectorAll('.swiper-slide').length;
    const shouldLoop = slideCount > 1 && loop;
    
    const swiperInstance = new Swiper(sliderElement, {
      slidesPerView: 1,
      spaceBetween: 0,
      loop: shouldLoop,
      autoplay: autoplay && shouldLoop ? {
        delay: delay,
        disableOnInteraction: false,
      } : false,
      pagination: {
        el: '.swiper-pagination',  // ← Standard Swiper Klasse
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',  // ← Standard Swiper Klasse
        prevEl: '.swiper-button-prev',  // ← Standard Swiper Klasse
      },
      effect: 'fade',
      fadeEffect: {
        crossFade: true
      },
      on: {
        init: function() {
          console.log('✅ Hero Slider initialisiert');
        }
      }
    });
  }
}

// Initialize
new HeroSlider();