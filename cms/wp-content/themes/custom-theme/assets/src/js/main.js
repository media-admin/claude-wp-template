/**
 * Main JavaScript Entry Point
 */

// Import Styles
import '../scss/style.scss';

// DOM Ready
document.addEventListener('DOMContentLoaded', () => {
  console.log('Custom Theme loaded');
  
  initMobileNav();
  initSmoothScroll();
});

// Mobile Navigation
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

// Smooth Scroll
function initSmoothScroll() {
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      const href = this.getAttribute('href');
      if (href === '#') return;
      
      const target = document.querySelector(href);
      if (target) {
        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth' });
      }
    });
  });
}