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

/**
 * Register Hero Slide Post Type
 */
function agency_core_register_hero_slide_cpt() {
    $labels = array(
        'name'                  => _x('Hero Slides', 'Post Type General Name', 'agency-core'),
        'singular_name'         => _x('Hero Slide', 'Post Type Singular Name', 'agency-core'),
        'menu_name'             => __('Hero Slides', 'agency-core'),
        'name_admin_bar'        => __('Hero Slide', 'agency-core'),
        'archives'              => __('Hero Slide Archives', 'agency-core'),
        'attributes'            => __('Hero Slide Attributes', 'agency-core'),
        'parent_item_colon'     => __('Parent Hero Slide:', 'agency-core'),
        'all_items'             => __('All Hero Slides', 'agency-core'),
        'add_new_item'          => __('Add New Hero Slide', 'agency-core'),
        'add_new'               => __('Add New', 'agency-core'),
        'new_item'              => __('New Hero Slide', 'agency-core'),
        'edit_item'             => __('Edit Hero Slide', 'agency-core'),
        'update_item'           => __('Update Hero Slide', 'agency-core'),
        'view_item'             => __('View Hero Slide', 'agency-core'),
        'view_items'            => __('View Hero Slides', 'agency-core'),
        'search_items'          => __('Search Hero Slide', 'agency-core'),
        'not_found'             => __('Not found', 'agency-core'),
        'not_found_in_trash'    => __('Not found in Trash', 'agency-core'),
        'featured_image'        => __('Featured Image', 'agency-core'),
        'set_featured_image'    => __('Set featured image', 'agency-core'),
        'remove_featured_image' => __('Remove featured image', 'agency-core'),
        'use_featured_image'    => __('Use as featured image', 'agency-core'),
        'insert_into_item'      => __('Insert into hero slide', 'agency-core'),
        'uploaded_to_this_item' => __('Uploaded to this hero slide', 'agency-core'),
        'items_list'            => __('Hero Slides list', 'agency-core'),
        'items_list_navigation' => __('Hero Slides list navigation', 'agency-core'),
        'filter_items_list'     => __('Filter hero slides list', 'agency-core'),
    );
    
    $args = array(
        'label'                 => __('Hero Slide', 'agency-core'),
        'description'           => __('Hero Slider Slides', 'agency-core'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail'),
        'hierarchical'          => false,
        'public'                => false,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 20,
        'menu_icon'             => 'dashicons-slides',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => false,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
    );
    
    register_post_type('hero_slide', $args);
}
add_action('init', 'agency_core_register_hero_slide_cpt', 0);


/**
 * Register FAQ Post Type
 */
function agency_core_register_faq_cpt() {
    $labels = array(
        'name'                  => _x('FAQs', 'Post Type General Name', 'agency-core'),
        'singular_name'         => _x('FAQ', 'Post Type Singular Name', 'agency-core'),
        'menu_name'             => __('FAQs', 'agency-core'),
        'name_admin_bar'        => __('FAQ', 'agency-core'),
        'archives'              => __('FAQ Archives', 'agency-core'),
        'attributes'            => __('FAQ Attributes', 'agency-core'),
        'parent_item_colon'     => __('Parent FAQ:', 'agency-core'),
        'all_items'             => __('All FAQs', 'agency-core'),
        'add_new_item'          => __('Add New FAQ', 'agency-core'),
        'add_new'               => __('Add New', 'agency-core'),
        'new_item'              => __('New FAQ', 'agency-core'),
        'edit_item'             => __('Edit FAQ', 'agency-core'),
        'update_item'           => __('Update FAQ', 'agency-core'),
        'view_item'             => __('View FAQ', 'agency-core'),
        'view_items'            => __('View FAQs', 'agency-core'),
        'search_items'          => __('Search FAQ', 'agency-core'),
        'not_found'             => __('Not found', 'agency-core'),
        'not_found_in_trash'    => __('Not found in Trash', 'agency-core'),
    );
    
    $args = array(
        'label'                 => __('FAQ', 'agency-core'),
        'description'           => __('Frequently Asked Questions', 'agency-core'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'page-attributes'),
        'hierarchical'          => false,
        'public'                => false,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 25,
        'menu_icon'             => 'dashicons-editor-help',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => false,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
    );
    
    register_post_type('faq', $args);
}
add_action('init', 'agency_core_register_faq_cpt', 0);

/**
 * Register FAQ Category Taxonomy
 */
function agency_core_register_faq_category_taxonomy() {
    $labels = array(
        'name'              => _x('FAQ Categories', 'taxonomy general name', 'agency-core'),
        'singular_name'     => _x('FAQ Category', 'taxonomy singular name', 'agency-core'),
        'search_items'      => __('Search FAQ Categories', 'agency-core'),
        'all_items'         => __('All FAQ Categories', 'agency-core'),
        'parent_item'       => __('Parent FAQ Category', 'agency-core'),
        'parent_item_colon' => __('Parent FAQ Category:', 'agency-core'),
        'edit_item'         => __('Edit FAQ Category', 'agency-core'),
        'update_item'       => __('Update FAQ Category', 'agency-core'),
        'add_new_item'      => __('Add New FAQ Category', 'agency-core'),
        'new_item_name'     => __('New FAQ Category Name', 'agency-core'),
        'menu_name'         => __('Categories', 'agency-core'),
    );
    
    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'public'            => false,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => false,
        'show_tagcloud'     => false,
        'show_in_rest'      => true,
    );
    
    register_taxonomy('faq_category', array('faq'), $args);
}
add_action('init', 'agency_core_register_faq_category_taxonomy', 0);

/**
 * Register Carousel Post Type
 */
function agency_core_register_carousel_cpt() {
    $labels = array(
        'name'                  => _x('Carousel Items', 'Post Type General Name', 'agency-core'),
        'singular_name'         => _x('Carousel Item', 'Post Type Singular Name', 'agency-core'),
        'menu_name'             => __('Carousel', 'agency-core'),
        'name_admin_bar'        => __('Carousel Item', 'agency-core'),
        'archives'              => __('Carousel Archives', 'agency-core'),
        'attributes'            => __('Carousel Attributes', 'agency-core'),
        'all_items'             => __('All Items', 'agency-core'),
        'add_new_item'          => __('Add New Item', 'agency-core'),
        'add_new'               => __('Add New', 'agency-core'),
        'new_item'              => __('New Item', 'agency-core'),
        'edit_item'             => __('Edit Item', 'agency-core'),
        'update_item'           => __('Update Item', 'agency-core'),
        'view_item'             => __('View Item', 'agency-core'),
        'view_items'            => __('View Items', 'agency-core'),
        'search_items'          => __('Search Item', 'agency-core'),
        'not_found'             => __('Not found', 'agency-core'),
        'not_found_in_trash'    => __('Not found in Trash', 'agency-core'),
    );
    
    $args = array(
        'label'                 => __('Carousel Item', 'agency-core'),
        'description'           => __('Carousel Items', 'agency-core'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'page-attributes'),
        'hierarchical'          => false,
        'public'                => false,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 26,
        'menu_icon'             => 'dashicons-images-alt2',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => false,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
    );
    
    register_post_type('carousel', $args);
}
add_action('init', 'agency_core_register_carousel_cpt', 0);

/**
 * Register Carousel Category Taxonomy
 */
function agency_core_register_carousel_category_taxonomy() {
    $labels = array(
        'name'              => _x('Carousel Categories', 'taxonomy general name', 'agency-core'),
        'singular_name'     => _x('Carousel Category', 'taxonomy singular name', 'agency-core'),
        'search_items'      => __('Search Categories', 'agency-core'),
        'all_items'         => __('All Categories', 'agency-core'),
        'edit_item'         => __('Edit Category', 'agency-core'),
        'update_item'       => __('Update Category', 'agency-core'),
        'add_new_item'      => __('Add New Category', 'agency-core'),
        'new_item_name'     => __('New Category Name', 'agency-core'),
        'menu_name'         => __('Categories', 'agency-core'),
    );
    
    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'public'            => false,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => false,
        'show_tagcloud'     => false,
        'show_in_rest'      => true,
    );
    
    register_taxonomy('carousel_category', array('carousel'), $args);
}
add_action('init', 'agency_core_register_carousel_category_taxonomy', 0);