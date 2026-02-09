<?php
/**
 * Enqueue Scripts and Styles
 * 
 * @package Custom_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue theme assets
 */
function customtheme_enqueue_assets() {
    $theme_dir = get_template_directory();
    $theme_uri = get_template_directory_uri();
    $manifest_path = $theme_dir . '/assets/dist/.vite/manifest.json';
    
    // Swiper CSS (CDN)
    wp_enqueue_style(
        'swiper',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
        array(),
        '11.0.0'
    );
    
    // Check if manifest exists
    if (!file_exists($manifest_path)) {
        // Fallback to direct files
        $css_path = $theme_dir . '/assets/dist/css/style.css';
        $js_path = $theme_dir . '/assets/dist/js/main.js';
        
        if (file_exists($css_path)) {
            wp_enqueue_style(
                'custom-theme-style',
                $theme_uri . '/assets/dist/css/style.css',
                array('swiper'),
                filemtime($css_path)
            );
        }
        
        if (file_exists($js_path)) {
            wp_enqueue_script(
                'custom-theme-script',
                $theme_uri . '/assets/dist/js/main.js',
                array(),
                filemtime($js_path),
                true
            );
        }
        
        return;
    }
    
    // Read manifest
    $manifest = json_decode(file_get_contents($manifest_path), true);
    
    if (!$manifest) {
        return;
    }
    
    // Find the main entry (could be "src/js/main.js" or "assets/src/js/main.js")
    $main_entry = null;
    foreach ($manifest as $key => $entry) {
        if (strpos($key, 'main.js') !== false && isset($entry['isEntry']) && $entry['isEntry']) {
            $main_entry = $entry;
            break;
        }
    }
    
    if (!$main_entry) {
        return;
    }
    
    // Enqueue CSS files
    if (isset($main_entry['css']) && is_array($main_entry['css'])) {
        foreach ($main_entry['css'] as $index => $css_file) {
            $css_path = $theme_dir . '/assets/dist/' . $css_file;
            
            if (file_exists($css_path)) {
                wp_enqueue_style(
                    'custom-theme-style-' . $index,
                    $theme_uri . '/assets/dist/' . $css_file,
                    array('swiper'),
                    filemtime($css_path)
                );
            }
        }
    }
    
    // Enqueue main JS
    if (isset($main_entry['file'])) {
        $js_path = $theme_dir . '/assets/dist/' . $main_entry['file'];
        
        if (file_exists($js_path)) {
            wp_enqueue_script(
                'custom-theme-script',
                $theme_uri . '/assets/dist/' . $main_entry['file'],
                array('swiper-cdn'), // ← WICHTIG: Abhängigkeit von Swiper CDN
                filemtime($js_path),
                true
            );
            
            // Localize script
            wp_localize_script('custom-theme-script', 'customTheme', array(
                'ajaxUrl' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('custom-theme-nonce'),
                'themePath' => $theme_uri,
            ));
        }
    }
}
add_action('wp_enqueue_scripts', 'customtheme_enqueue_assets');

/**
 * Enqueue Swiper JS from CDN
 * 
 * Load before theme scripts so Swiper is available globally
 */
function customtheme_enqueue_swiper_cdn() {
    wp_enqueue_script(
        'swiper-cdn',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
        array(),
        '11.0.0',
        true // Load in footer
    );
}
add_action('wp_enqueue_scripts', 'customtheme_enqueue_swiper_cdn', 5); // Priority 5 - before theme scripts (default priority 10)