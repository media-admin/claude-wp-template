<?php
/**
 * Custom Post Types
 * 
 * Register all custom post types for the agency core functionality.
 * These CPTs persist across theme changes.
 * 
 * @package Agency_Core
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Team CPT
 */
function agency_core_register_team_cpt() {
    $labels = array(
        'name' => __('Team', 'agency-core'),
        'singular_name' => __('Team Member', 'agency-core'),
        'menu_name' => __('Team', 'agency-core'),
        'add_new' => __('Add New', 'agency-core'),
        'add_new_item' => __('Add New Team Member', 'agency-core'),
        'edit_item' => __('Edit Team Member', 'agency-core'),
        'new_item' => __('New Team Member', 'agency-core'),
        'view_item' => __('View Team Member', 'agency-core'),
        'search_items' => __('Search Team', 'agency-core'),
        'not_found' => __('No team members found', 'agency-core'),
        'not_found_in_trash' => __('No team members found in trash', 'agency-core'),
    );
    
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'show_in_rest' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'),
        'menu_icon' => 'dashicons-groups',
        'menu_position' => 20,
        'rewrite' => array('slug' => 'team'),
        'capability_type' => 'post',
    );
    
    register_post_type('team', $args);
}
add_action('init', 'agency_core_register_team_cpt');

/**
 * Register Projects CPT
 */
function agency_core_register_projects_cpt() {
    $labels = array(
        'name' => __('Projects', 'agency-core'),
        'singular_name' => __('Project', 'agency-core'),
        'menu_name' => __('Projects', 'agency-core'),
        'add_new' => __('Add New', 'agency-core'),
        'add_new_item' => __('Add New Project', 'agency-core'),
        'edit_item' => __('Edit Project', 'agency-core'),
        'new_item' => __('New Project', 'agency-core'),
        'view_item' => __('View Project', 'agency-core'),
        'search_items' => __('Search Projects', 'agency-core'),
        'not_found' => __('No projects found', 'agency-core'),
        'not_found_in_trash' => __('No projects found in trash', 'agency-core'),
    );
    
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'show_in_rest' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'),
        'menu_icon' => 'dashicons-portfolio',
        'menu_position' => 21,
        'rewrite' => array('slug' => 'projects'),
        'capability_type' => 'post',
        'taxonomies' => array('project_category'),
    );
    
    register_post_type('project', $args);
}
add_action('init', 'agency_core_register_projects_cpt');

/**
 * Register Project Categories
 */
function agency_core_register_project_categories() {
    $labels = array(
        'name' => __('Project Categories', 'agency-core'),
        'singular_name' => __('Project Category', 'agency-core'),
        'search_items' => __('Search Categories', 'agency-core'),
        'all_items' => __('All Categories', 'agency-core'),
        'parent_item' => __('Parent Category', 'agency-core'),
        'parent_item_colon' => __('Parent Category:', 'agency-core'),
        'edit_item' => __('Edit Category', 'agency-core'),
        'update_item' => __('Update Category', 'agency-core'),
        'add_new_item' => __('Add New Category', 'agency-core'),
        'new_item_name' => __('New Category Name', 'agency-core'),
        'menu_name' => __('Categories', 'agency-core'),
    );
    
    register_taxonomy('project_category', array('project'), array(
        'labels' => $labels,
        'hierarchical' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'rewrite' => array('slug' => 'projekt-kategorie'),
    ));
}
add_action('init', 'agency_core_register_project_categories');

/**
 * Register Testimonials CPT
 */
function agency_core_register_testimonials_cpt() {
    $labels = array(
        'name' => __('Testimonials', 'agency-core'),
        'singular_name' => __('Testimonial', 'agency-core'),
        'menu_name' => __('Testimonials', 'agency-core'),
        'add_new' => __('Add New', 'agency-core'),
        'add_new_item' => __('Add New Testimonial', 'agency-core'),
        'edit_item' => __('Edit Testimonial', 'agency-core'),
        'new_item' => __('New Testimonial', 'agency-core'),
        'view_item' => __('View Testimonial', 'agency-core'),
        'search_items' => __('Search Testimonials', 'agency-core'),
        'not_found' => __('No testimonials found', 'agency-core'),
        'not_found_in_trash' => __('No testimonials found in trash', 'agency-core'),
    );
    
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'show_in_rest' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'page-attributes'),
        'menu_icon' => 'dashicons-testimonial',
        'menu_position' => 22,
        'rewrite' => array('slug' => 'testimonials'),
        'capability_type' => 'post',
    );
    
    register_post_type('testimonial', $args);
}
add_action('init', 'agency_core_register_testimonials_cpt');

/**
 * Register Services CPT
 */
function agency_core_register_services_cpt() {
    $labels = array(
        'name' => __('Services', 'agency-core'),
        'singular_name' => __('Service', 'agency-core'),
        'menu_name' => __('Services', 'agency-core'),
        'add_new' => __('Add New', 'agency-core'),
        'add_new_item' => __('Add New Service', 'agency-core'),
        'edit_item' => __('Edit Service', 'agency-core'),
        'new_item' => __('New Service', 'agency-core'),
        'view_item' => __('View Service', 'agency-core'),
        'search_items' => __('Search Services', 'agency-core'),
        'not_found' => __('No services found', 'agency-core'),
        'not_found_in_trash' => __('No services found in trash', 'agency-core'),
    );
    
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'show_in_rest' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'),
        'menu_icon' => 'dashicons-admin-tools',
        'menu_position' => 23,
        'rewrite' => array('slug' => 'leistungen'),
        'capability_type' => 'post',
    );
    
    register_post_type('service', $args);
}
add_action('init', 'agency_core_register_services_cpt');