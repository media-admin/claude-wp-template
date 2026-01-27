<?php
/**
 * Enqueue Scripts and Styles
 */

if (!defined('ABSPATH')) exit;

function customtheme_enqueue_assets() {
    // Check Development Mode (.dev marker im Root, nicht im cms/)
    $is_dev = file_exists(ABSPATH . '../.dev');
    
    if ($is_dev) {
        // Development: Vite Dev Server
        wp_enqueue_script(
            'vite-client',
            'http://localhost:3000/@vite/client',
            array(),
            null,
            false
        );
        
        wp_enqueue_script(
            'customtheme-main',
            'http://localhost:3000/cms/wp-content/themes/custom-theme/assets/src/js/main.js',
            array(),
            null,
            true
        );
    } else {
        // Production: Compiled Assets
        $manifest_path = CUSTOMTHEME_DIR . '/assets/dist/manifest.json';
        
        if (file_exists($manifest_path)) {
            $manifest = json_decode(file_get_contents($manifest_path), true);
            
            // CSS
            if (isset($manifest['cms/wp-content/themes/custom-theme/assets/src/scss/style.scss'])) {
                wp_enqueue_style(
                    'customtheme-style',
                    CUSTOMTHEME_ASSETS . '/' . $manifest['cms/wp-content/themes/custom-theme/assets/src/scss/style.scss']['file'],
                    array(),
                    null
                );
            }
            
            // JS
            if (isset($manifest['cms/wp-content/themes/custom-theme/assets/src/js/main.js'])) {
                wp_enqueue_script(
                    'customtheme-main',
                    CUSTOMTHEME_ASSETS . '/' . $manifest['cms/wp-content/themes/custom-theme/assets/src/js/main.js']['file'],
                    array(),
                    null,
                    true
                );
            }
        }
    }
    
    // Localize Script
    wp_localize_script('customtheme-main', 'customthemeData', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('customtheme-nonce'),
        'themeUrl' => CUSTOMTHEME_URI,
    ));
    
    // Comment Reply
    if (is_singular() && comments_open()) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'customtheme_enqueue_assets');

// Module Attribute für Vite
function customtheme_add_module_attr($tag, $handle) {
    if (strpos($handle, 'customtheme-main') !== false || strpos($handle, 'vite') !== false) {
        return str_replace('<script', '<script type="module"', $tag);
    }
    return $tag;
}
add_filter('script_loader_tag', 'customtheme_add_module_attr', 10, 2);