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
        wp_enqueue_style(
            'customtheme-style',
            get_template_directory_uri() . '/assets/dist/css/style.css',
            array(),
            filemtime(get_template_directory() . '/assets/dist/css/style.css')
        );
        
        wp_enqueue_script(
            'customtheme-main',
            get_template_directory_uri() . '/assets/dist/js/main.js',
            array(),
            filemtime(get_template_directory() . '/assets/dist/js/main.js'),
            true
        );
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