/**
 * Hero Slider Component
 */

import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay, EffectFade } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/effect-fade';

export default class HeroSlider {
  constructor(element, options = {}) {
    this.element = element;
    this.options = {
      modules: [Navigation, Pagination, Autoplay, EffectFade],
      effect: 'fade',
      speed: 1000,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
      loop: true,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      ...options
    };
    
    this.init();
  }
  
  init() {
    if (!this.element) return;
    
    this.swiper = new Swiper(this.element, this.options);
  }
  
  destroy() {
    if (this.swiper) {
      this.swiper.destroy();
    }
  }
}

// Auto-initialize
document.addEventListener('DOMContentLoaded', () => {
  const sliders = document.querySelectorAll('.hero-slider');
  sliders.forEach(slider => {
    new HeroSlider(slider);
  });
});