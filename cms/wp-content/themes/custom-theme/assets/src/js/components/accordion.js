/**
 * Accordion Component
 */

export default class Accordion {
  constructor(element, options = {}) {
    this.element = element;
    this.options = {
      allowMultiple: false,
      speed: 300,
      ...options
    };
    
    this.items = this.element.querySelectorAll('.accordion__item');
    this.init();
  }
  
  init() {
    this.items.forEach((item, index) => {
      const trigger = item.querySelector('.accordion__trigger');
      const content = item.querySelector('.accordion__content');
      
      // Set initial heights
      if (!item.classList.contains('is-active')) {
        content.style.maxHeight = '0';
      } else {
        content.style.maxHeight = content.scrollHeight + 'px';
      }
      
      trigger.addEventListener('click', () => {
        this.toggle(index);
      });
    });
  }
  
  toggle(index) {
    const item = this.items[index];
    const content = item.querySelector('.accordion__content');
    const isActive = item.classList.contains('is-active');
    
    // Close all if not allowing multiple
    if (!this.options.allowMultiple && !isActive) {
      this.closeAll();
    }
    
    if (isActive) {
      this.close(item);
    } else {
      this.open(item);
    }
  }
  
  open(item) {
    const content = item.querySelector('.accordion__content');
    item.classList.add('is-active');
    content.style.maxHeight = content.scrollHeight + 'px';
  }
  
  close(item) {
    const content = item.querySelector('.accordion__content');
    item.classList.remove('is-active');
    content.style.maxHeight = '0';
  }
  
  closeAll() {
    this.items.forEach(item => {
      this.close(item);
    });
  }
}

// Auto-initialize
document.addEventListener('DOMContentLoaded', () => {
  const accordions = document.querySelectorAll('.accordion');
  accordions.forEach(accordion => {
    const allowMultiple = accordion.dataset.allowMultiple === 'true';
    new Accordion(accordion, { allowMultiple });
  });
});