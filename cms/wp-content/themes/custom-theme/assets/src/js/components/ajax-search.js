/**
 * AJAX Live Search Component
 */
document.addEventListener('DOMContentLoaded', function() {
    const searchContainers = document.querySelectorAll('.ajax-search');
    
    if (searchContainers.length === 0) return;
    
    searchContainers.forEach(container => {
        const input = container.querySelector('.ajax-search__input');
        const resultsContainer = container.querySelector('.ajax-search__results');
        const loadingIndicator = container.querySelector('.ajax-search__loading');
        
        // Get settings from data attributes
        const limit = parseInt(container.dataset.limit) || 5;
        const postTypes = container.dataset.postTypes ? container.dataset.postTypes.split(',').map(type => type.trim()) : ['post', 'page'];
        
        if (!input || !resultsContainer) return;
        
        let debounceTimer;
        
        // Debounced search function
        input.addEventListener('input', function() {
            const query = this.value.trim();
            
            clearTimeout(debounceTimer);
            
            if (query.length < 2) {
                resultsContainer.style.display = 'none';
                resultsContainer.innerHTML = '';
                return;
            }
            
            // Show loading
            if (loadingIndicator) {
                loadingIndicator.style.display = 'block';
            }
            
            debounceTimer = setTimeout(() => {
                performSearch(query, resultsContainer, loadingIndicator, limit, postTypes);
            }, 300);
        });
        
        // Close results when clicking outside
        document.addEventListener('click', function(e) {
            if (!container.contains(e.target)) {
                resultsContainer.style.display = 'none';
            }
        });
    });
});

/**
 * Perform AJAX Search
 */
function performSearch(query, resultsContainer, loadingIndicator, limit, postTypes) {
    const ajaxUrl = window.customTheme?.ajaxUrl || '/wp-admin/admin-ajax.php';
    const nonce = window.customTheme?.nonce || '';
    
    fetch(ajaxUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            action: 'agency_search',
            nonce: nonce,
            query: query,
            post_types: JSON.stringify(postTypes),  // ← Verwendet die Data Attribute!
            limit: limit
        })
    })
    .then(response => response.json())
    .then(data => {
        // Hide loading
        if (loadingIndicator) {
            loadingIndicator.style.display = 'none';
        }
        
        if (data.success && data.data.results.length > 0) {
            displayResults(data.data.results, resultsContainer);
        } else {
            displayNoResults(resultsContainer);
        }
    })
    .catch(error => {
        console.error('Search error:', error);
        if (loadingIndicator) {
            loadingIndicator.style.display = 'none';
        }
        displayError(resultsContainer);
    });
}

/**
 * Display search results
 */
function displayResults(results, container) {
    let html = '<div class="ajax-search__list">';
    
    results.forEach(result => {
        // Post Type Label
        let typeLabel = '';
        switch(result.post_type) {
            case 'post':
                typeLabel = 'Beitrag';
                break;
            case 'page':
                typeLabel = 'Seite';
                break;
            case 'product':
                typeLabel = 'Produkt';
                break;
            case 'project':
                typeLabel = 'Projekt';
                break;
            default:
                typeLabel = result.post_type;
        }
        
        html += `
            <a href="${result.permalink}" class="ajax-search__item ajax-search__item--${result.post_type}">
                ${result.thumbnail ? `
                    <div class="ajax-search__thumbnail">
                        <img src="${result.thumbnail}" alt="${result.title}">
                    </div>
                ` : ''}
                <div class="ajax-search__content">
                    <div class="ajax-search__meta">
                        <span class="ajax-search__type">${typeLabel}</span>
                        ${result.date ? `<span class="ajax-search__date">${result.date}</span>` : ''}
                        ${result.price ? `<span class="ajax-search__price">${result.price}</span>` : ''}
                    </div>
                    <div class="ajax-search__title">${result.title}</div>
                    ${result.excerpt ? `<div class="ajax-search__excerpt">${result.excerpt}</div>` : ''}
                </div>
            </a>
        `;
    });
    
    html += '</div>';
    
    container.innerHTML = html;
    container.style.display = 'block';
}

/**
 * Display no results message
 */
function displayNoResults(container) {
    container.innerHTML = '<div class="ajax-search__no-results">Keine Ergebnisse gefunden.</div>';
    container.style.display = 'block';
}

/**
 * Display error message
 */
function displayError(container) {
    container.innerHTML = '<div class="ajax-search__error">Ein Fehler ist aufgetreten. Bitte versuchen Sie es erneut.</div>';
    container.style.display = 'block';
}