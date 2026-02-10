/**
 * FAQ Accordion Component
 */

export default class FaqAccordion {
  constructor() {
    this.accordions = document.querySelectorAll('.faq-accordion');
    
    if (this.accordions.length > 0) {
      this.init();
    }
  }
  
  init() {
    this.accordions.forEach(accordion => {
      this.initAccordion(accordion);
    });
  }
  
  initAccordion(accordion) {
    const items = accordion.querySelectorAll('.faq-item');
    
    if (!items || items.length === 0) {
      return;
    }
    
    items.forEach(item => {
      const question = item.querySelector('.faq-question');
      const answer = item.querySelector('.faq-answer');
      
      // Skip if elements not found
      if (!question || !answer) {
        return;
      }
      
      question.addEventListener('click', () => {
        const isActive = item.classList.contains('is-active');
        
        // Toggle current item
        if (isActive) {
          item.classList.remove('is-active');
          question.setAttribute('aria-expanded', 'false');
          answer.style.display = 'none';
        } else {
          item.classList.add('is-active');
          question.setAttribute('aria-expanded', 'true');
          answer.style.display = 'block';
        }
      });
    });
  }
}

// Initialize
new FaqAccordion();