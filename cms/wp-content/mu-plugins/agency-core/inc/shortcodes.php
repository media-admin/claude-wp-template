<?php
/**
 * Shortcodes
 * 
 * Load all shortcode functionality from custom-blocks.
 * This file acts as a bridge to the existing shortcodes.
 * 
 * @package Agency_Core
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Include all shortcodes from custom-blocks
 * 
 * We're loading the existing custom-blocks.php file here.
 * In the future, these could be refactored into separate files.
 */
$custom_blocks_file = WPMU_PLUGIN_DIR . '/custom-blocks/custom-blocks.php';

if (file_exists($custom_blocks_file)) {
    require_once $custom_blocks_file;
} else {
    add_action('admin_notices', function() {
        echo '<div class="notice notice-error"><p><strong>Agency Core:</strong> Shortcodes file not found. Please ensure custom-blocks.php exists.</p></div>';
    });
}

/**
 * Filter: Allow themes to modify shortcode output
 * 
 * Themes can hook into this to add their own wrapper classes or markup.
 * 
 * @param string $output Shortcode HTML output
 * @param string $shortcode Shortcode name
 * @param array $atts Shortcode attributes
 * @return string Modified output
 */
function agency_core_shortcode_output_filter($output, $shortcode, $atts) {
    return apply_filters('agency_core_shortcode_output', $output, $shortcode, $atts);
}

/**
 * Helper: Get shortcode wrapper class
 * 
 * Allows themes to add custom classes to shortcode wrappers.
 * 
 * @param string $base_class Base CSS class
 * @param string $shortcode Shortcode name
 * @return string Class names
 */
function agency_core_get_shortcode_class($base_class, $shortcode) {
    $classes = array($base_class);
    
    // Allow themes to add classes
    $additional_classes = apply_filters('agency_core_shortcode_wrapper_class', '', $shortcode);
    
    if (!empty($additional_classes)) {
        $classes[] = $additional_classes;
    }
    
    return implode(' ', $classes);
}