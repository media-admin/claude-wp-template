/**
 * FAQ Accordion
 */

export default class FAQAccordion {
  constructor() {
    this.accordions = document.querySelectorAll('.faq-accordion');
    this.init();
  }
  
  init() {
    if (this.accordions.length === 0) return;
    
    this.accordions.forEach(accordion => {
      this.initAccordion(accordion);
    });
  }
  
  initAccordion(accordion) {
    const items = accordion.querySelectorAll('.faq-item');
    const allowMultiple = accordion.hasAttribute('data-allow-multiple');
    
    items.forEach(item => {
      const question = item.querySelector('.faq-item__question');
      const answer = item.querySelector('.faq-item__answer');
      const icon = item.querySelector('.faq-item__icon');
      
      question.addEventListener('click', () => {
        const isActive = item.classList.contains('is-active');
        
        // Close all if not allowing multiple
        if (!allowMultiple) {
          items.forEach(otherItem => {
            if (otherItem !== item) {
              this.closeItem(otherItem);
            }
          });
        }
        
        // Toggle current item
        if (isActive) {
          this.closeItem(item);
        } else {
          this.openItem(item);
        }
      });
      
      // Keyboard support
      question.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' || e.key === ' ') {
          e.preventDefault();
          question.click();
        }
      });
    });
  }
  
  openItem(item) {
    const question = item.querySelector('.faq-item__question');
    const answer = item.querySelector('.faq-item__answer');
    const icon = item.querySelector('.faq-item__icon');
    
    item.classList.add('is-active');
    question.setAttribute('aria-expanded', 'true');
    answer.style.display = 'block';
    icon.textContent = '−';
  }
  
  closeItem(item) {
    const question = item.querySelector('.faq-item__question');
    const answer = item.querySelector('.faq-item__answer');
    const icon = item.querySelector('.faq-item__icon');
    
    item.classList.remove('is-active');
    question.setAttribute('aria-expanded', 'false');
    answer.style.display = 'none';
    icon.textContent = '+';
  }
}

// Initialize
new FAQAccordion();