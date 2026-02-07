<?php
/**
 * Enqueue Scripts and Styles
 * 
 * @package CustomTheme
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue Theme Assets
 */
function customtheme_enqueue_assets() {
    // Check if in development mode
    $is_dev = defined('WP_DEBUG') && WP_DEBUG && file_exists(get_template_directory() . '/.dev');
    
    if ($is_dev) {
        // Development: Vite Dev Server
        wp_enqueue_script(
            'vite-client',
            'http://localhost:3000/@vite/client',
            array(),
            null,
            false
        );
        
        // Main JS (includes CSS via Vite)
        wp_enqueue_script(
            'customtheme-main',
            'http://localhost:3000/src/js/main.js',
            array(),
            null,
            true
        );
    } else {
        // Production: Compiled Assets
        $manifest_path = get_template_directory() . '/assets/dist/manifest.json';
        
        if (file_exists($manifest_path)) {
            $manifest = json_decode(file_get_contents($manifest_path), true);
            
            // Enqueue CSS (Vite generiert main.css aus main.scss)
            if (isset($manifest['src/scss/main.scss'])) {
                wp_enqueue_style(
                    'customtheme-style',
                    get_template_directory_uri() . '/assets/dist/' . $manifest['src/scss/main.scss']['file'],
                    array(),
                    null
                );
            } elseif (isset($manifest['src/js/main.js']['css'])) {
                // Fallback: CSS ist im main.js entry
                foreach ($manifest['src/js/main.js']['css'] as $css_file) {
                    wp_enqueue_style(
                        'customtheme-style',
                        get_template_directory_uri() . '/assets/dist/' . $css_file,
                        array(),
                        null
                    );
                }
            }
            
            // Enqueue JS
            if (isset($manifest['src/js/main.js'])) {
                wp_enqueue_script(
                    'customtheme-main',
                    get_template_directory_uri() . '/assets/dist/' . $manifest['src/js/main.js']['file'],
                    array(),
                    null,
                    true
                );
            }
        } else {
            // Fallback wenn kein Manifest vorhanden
            if (file_exists(get_template_directory() . '/assets/dist/css/style.css')) {
                wp_enqueue_style(
                    'customtheme-style',
                    get_template_directory_uri() . '/assets/dist/css/style.css',
                    array(),
                    filemtime(get_template_directory() . '/assets/dist/css/style.css')
                );
            }
            
            if (file_exists(get_template_directory() . '/assets/dist/js/main.js')) {
                wp_enqueue_script(
                    'customtheme-main',
                    get_template_directory_uri() . '/assets/dist/js/main.js',
                    array(),
                    filemtime(get_template_directory() . '/assets/dist/js/main.js'),
                    true
                );
            }
        }
    }
    
    // Localize Script
    wp_localize_script('customtheme-main', 'customthemeData', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('customtheme-nonce'),
        'siteUrl' => get_site_url(),
    ));
}
add_action('wp_enqueue_scripts', 'customtheme_enqueue_assets');

/**
 * Add type="module" to scripts
 */
function customtheme_script_type_module($tag, $handle, $src) {
    if (in_array($handle, array('customtheme-main', 'vite-client'))) {
        $tag = str_replace('<script', '<script type="module"', $tag);
    }
    return $tag;
}
add_filter('script_loader_tag', 'customtheme_script_type_module', 10, 3);