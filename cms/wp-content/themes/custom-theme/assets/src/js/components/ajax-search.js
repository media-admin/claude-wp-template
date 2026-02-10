/**
 * AJAX Search Component
 */

export default class AjaxSearch {
  constructor() {
    this.searchContainers = document.querySelectorAll('.ajax-search');
    this.searchTimeout = null;
    
    if (this.searchContainers.length > 0) {
      this.init();
    }
  }
  
  init() {
    this.searchContainers.forEach(container => {
      const input = container.querySelector('.ajax-search__input');
      const clearBtn = container.querySelector('.ajax-search__clear');
      const resultsContainer = container.querySelector('.ajax-search__results-list');
      const resultsWrapper = container.querySelector('.ajax-search__results');
      const noResults = container.querySelector('.ajax-search__no-results');
      const loadingIcon = container.querySelector('.ajax-search__loading');
      
      if (!input) return;
      
      // Input event
      input.addEventListener('input', (e) => {
        const query = e.target.value.trim();
        const minChars = parseInt(input.dataset.minChars) || 2;
        
        // Show/hide clear button
        if (query.length > 0) {
          clearBtn.style.display = 'block';
        } else {
          clearBtn.style.display = 'none';
          resultsWrapper.style.display = 'none';
          noResults.style.display = 'none';
          return;
        }
        
        // Clear previous timeout
        if (this.searchTimeout) {
          clearTimeout(this.searchTimeout);
        }
        
        // Check minimum length
        if (query.length < minChars) {
          resultsWrapper.style.display = 'none';
          noResults.style.display = 'none';
          return;
        }
        
        // Debounce search
        this.searchTimeout = setTimeout(() => {
          this.performSearch(query, input, resultsContainer, resultsWrapper, noResults, loadingIcon);
        }, 300);
      });
      
      // Clear button
      clearBtn.addEventListener('click', () => {
        input.value = '';
        clearBtn.style.display = 'none';
        resultsWrapper.style.display = 'none';
        noResults.style.display = 'none';
        input.focus();
      });
      
      // Close on outside click
      document.addEventListener('click', (e) => {
        if (!container.contains(e.target)) {
          resultsWrapper.style.display = 'none';
          noResults.style.display = 'none';
        }
      });
      
      // Keyboard navigation
      input.addEventListener('keydown', (e) => {
        this.handleKeyboard(e, resultsWrapper);
      });
    });
  }
  
  async performSearch(query, input, resultsContainer, resultsWrapper, noResults, loadingIcon) {
    // Show loading
    loadingIcon.style.display = 'block';
    
    const postTypes = JSON.parse(input.dataset.postTypes || '["post","page"]');
    const limit = parseInt(input.dataset.limit) || 10;
    
    try {
      const response = await fetch(window.customTheme.ajaxUrl, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
          action: 'agency_search',
          nonce: window.customTheme.nonce,
          query: query,
          post_types: postTypes,
          limit: limit,
        }),
      });
      
      const data = await response.json();
      
      // Hide loading
      loadingIcon.style.display = 'none';
      
      if (data.success && data.data.results.length > 0) {
        this.displayResults(data.data.results, resultsContainer, resultsWrapper);
        noResults.style.display = 'none';
        
        // Track search (optional)
        this.trackSearch(query);
      } else {
        resultsWrapper.style.display = 'none';
        noResults.style.display = 'block';
      }
    } catch (error) {
      console.error('Search error:', error);
      loadingIcon.style.display = 'none';
      noResults.style.display = 'block';
      noResults.querySelector('p').textContent = 'Ein Fehler ist aufgetreten.';
    }
  }
  
  displayResults(results, container, wrapper) {
    container.innerHTML = '';
    
    results.forEach(result => {
      const resultItem = document.createElement('a');
      resultItem.href = result.url;
      resultItem.className = 'ajax-search__result';
      
      let thumbnailHTML = '';
      if (result.thumbnail) {
        thumbnailHTML = `
          <div class="ajax-search__result-thumbnail">
            <img src="${result.thumbnail}" alt="${this.escapeHtml(result.title)}" loading="lazy">
          </div>
        `;
      }
      
      resultItem.innerHTML = `
        ${thumbnailHTML}
        <div class="ajax-search__result-content">
          <h4 class="ajax-search__result-title">${this.highlightQuery(result.title)}</h4>
          ${result.excerpt ? `<p class="ajax-search__result-excerpt">${this.highlightQuery(result.excerpt)}</p>` : ''}
          <div class="ajax-search__result-meta">
            <span class="ajax-search__result-type">${result.post_type_label}</span>
            ${result.date ? `<span class="ajax-search__result-date">${result.date}</span>` : ''}
          </div>
        </div>
      `;
      
      container.appendChild(resultItem);
    });
    
    wrapper.style.display = 'block';
  }
  
  highlightQuery(text) {
    const input = document.querySelector('.ajax-search__input');
    const query = input ? input.value.trim() : '';
    
    if (!query) return this.escapeHtml(text);
    
    const regex = new RegExp(`(${this.escapeRegex(query)})`, 'gi');
    return this.escapeHtml(text).replace(regex, '<mark>$1</mark>');
  }
  
  handleKeyboard(e, resultsWrapper) {
    if (!resultsWrapper || resultsWrapper.style.display === 'none') return;
    
    const results = resultsWrapper.querySelectorAll('.ajax-search__result');
    if (results.length === 0) return;
    
    const activeResult = resultsWrapper.querySelector('.ajax-search__result.is-active');
    let currentIndex = Array.from(results).indexOf(activeResult);
    
    if (e.key === 'ArrowDown') {
      e.preventDefault();
      currentIndex = currentIndex < results.length - 1 ? currentIndex + 1 : 0;
    } else if (e.key === 'ArrowUp') {
      e.preventDefault();
      currentIndex = currentIndex > 0 ? currentIndex - 1 : results.length - 1;
    } else if (e.key === 'Enter' && activeResult) {
      e.preventDefault();
      activeResult.click();
      return;
    } else if (e.key === 'Escape') {
      resultsWrapper.style.display = 'none';
      return;
    } else {
      return;
    }
    
    // Update active state
    results.forEach((result, index) => {
      if (index === currentIndex) {
        result.classList.add('is-active');
        result.scrollIntoView({ block: 'nearest' });
      } else {
        result.classList.remove('is-active');
      }
    });
  }
  
  async trackSearch(query) {
    try {
      await fetch(window.customTheme.ajaxUrl, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
          action: 'agency_search_track',
          nonce: window.customTheme.nonce,
          query: query,
        }),
      });
    } catch (error) {
      // Silent fail
    }
  }
  
  escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
  }
  
  escapeRegex(text) {
    return text.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
  }
}

// Initialize
new AjaxSearch();