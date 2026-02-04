/**
 * Main JavaScript Entry Point
 */

// Swiper Import
import Swiper from 'swiper';
import 'swiper/css';

// Import Styles
import '../scss/style.scss';

// Import Components
import './components/theme-switcher.js';
import './components/hero-slider.js';
import './components/accordion.js';
import './components/theme-switcher.js';
import './components/lightbox.js';
import './components/modal.js';
import './components/back-to-top.js';
import './components/cookie-notice.js';
import './components/scroll-animations.js';

import TestimonialsSlider from './components/testimonials-slider';
import Tabs from './components/tabs';
import Notification from './components/notification';
import Notifications from './components/notifications';
import StatsCounter from './components/stats-counter';
import ImageComparison from './components/image-comparison';
import LogoCarousel from './components/logo-carousel';
import VideoPlayer from './components/video-player';
import FAQAccordion from './components/faq-accordion';

// DOM Ready
document.addEventListener('DOMContentLoaded', () => {
  console.log('Agency Starter Kit loaded ✨');
  
  // Mobile Navigation
  initMobileNav();
  
  // Smooth Scroll for anchor links
  initSmoothScroll();
});

/**
 * Mobile Navigation Toggle
 */
function initMobileNav() {
  const toggle = document.querySelector('.mobile-menu-toggle');
  const menu = document.querySelector('.main-navigation');
  
  if (toggle && menu) {
    toggle.addEventListener('click', () => {
      menu.classList.toggle('active');
      toggle.classList.toggle('active');
      document.body.classList.toggle('menu-open');
    });
  }
}

/**
 * Smooth Scroll for Anchor Links
 */
function initSmoothScroll() {
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      const href = this.getAttribute('href');
      
      if (href === '#') return;
      
      const target = document.querySelector(href);
      
      if (target) {
        e.preventDefault();
        target.scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        });
      }
    });
  });
}