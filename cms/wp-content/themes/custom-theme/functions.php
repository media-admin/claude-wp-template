<?php
/**
 * Custom Theme Functions
 * 
 * @package CustomTheme
 * @since 1.0.0
 */

if (!defined('ABSPATH')) exit;

// Theme Constants
define('CUSTOMTHEME_VERSION', '1.0.0');
define('CUSTOMTHEME_DIR', get_template_directory());
define('CUSTOMTHEME_URI', get_template_directory_uri());
define('CUSTOMTHEME_ASSETS', CUSTOMTHEME_URI . '/assets/dist');

// Require Theme Files
require_once CUSTOMTHEME_DIR . '/inc/setup.php';
require_once CUSTOMTHEME_DIR . '/inc/enqueue.php';
require_once CUSTOMTHEME_DIR . '/inc/helpers.php';
require_once CUSTOMTHEME_DIR . '/inc/performance.php';

/**
 * Enable WebP Upload Support
 */
function customtheme_enable_webp_upload($mimes) {
    $mimes['webp'] = 'image/webp';
    return $mimes;
}
add_filter('mime_types', 'customtheme_enable_webp_upload');

/**
 * Fix WebP display in Media Library
 */
function customtheme_webp_is_displayable($result, $path) {
    if ($result === false) {
        $info = @getimagesize($path);
        if ($info && $info[2] === IMAGETYPE_WEBP) {
            $result = true;
        }
    }
    return $result;
}
add_filter('file_is_displayable_image', 'customtheme_webp_is_displayable', 10, 2);

// Load Dashicons in Frontend
add_action('wp_enqueue_scripts', 'load_dashicons_frontend');
function load_dashicons_frontend() {
    wp_enqueue_style('dashicons');
}

// Block Patterns
require_once get_template_directory() . '/inc/block-patterns.php';

