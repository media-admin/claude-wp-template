<?php
/**
 * AJAX Search Handler
 * 
 * @package Agency_Core
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register AJAX Search Handlers
 */
add_action('wp_ajax_agency_search', 'agency_core_ajax_search');
add_action('wp_ajax_nopriv_agency_search', 'agency_core_ajax_search');

/**
 * AJAX Search Handler
 */
function agency_core_ajax_search() {
    // Verify nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'agency_search_nonce')) {
        wp_send_json_error(array('message' => 'Invalid security token'));
        return;
    }
    
    // Get search query
    $search_query = isset($_POST['query']) ? sanitize_text_field($_POST['query']) : '';
    
    // Minimum query length
    if (strlen($search_query) < 2) {
        wp_send_json_error(array('message' => 'Query too short'));
        return;
    }
    
    // Get post types to search
    $post_types = isset($_POST['post_types']) ? array_map('sanitize_text_field', $_POST['post_types']) : array('post', 'page');
    
    // Get limit
    $limit = isset($_POST['limit']) ? intval($_POST['limit']) : 10;
    
    // Build query
    $args = array(
        's' => $search_query,
        'post_type' => $post_types,
        'post_status' => 'publish',
        'posts_per_page' => $limit,
        'orderby' => 'relevance',
        'order' => 'DESC',
    );
    
    // Execute search
    $search_results = new WP_Query($args);
    
    $results = array();
    
    if ($search_results->have_posts()) {
        while ($search_results->have_posts()) {
            $search_results->the_post();
            
            $post_type_obj = get_post_type_object(get_post_type());
            
            $results[] = array(
                'id' => get_the_ID(),
                'title' => get_the_title(),
                'excerpt' => wp_trim_words(get_the_excerpt(), 20),
                'url' => get_permalink(),
                'post_type' => get_post_type(),
                'post_type_label' => $post_type_obj ? $post_type_obj->labels->singular_name : '',
                'thumbnail' => get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'),
                'date' => get_the_date('d.m.Y'),
            );
        }
        
        wp_reset_postdata();
    }
    
    // Send response
    wp_send_json_success(array(
        'results' => $results,
        'total' => $search_results->found_posts,
        'query' => $search_query,
    ));
}

/**
 * Register Search Stats (optional - track popular searches)
 */
add_action('wp_ajax_agency_search_track', 'agency_core_ajax_search_track');
add_action('wp_ajax_nopriv_agency_search_track', 'agency_core_ajax_search_track');

function agency_core_ajax_search_track() {
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'agency_search_nonce')) {
        wp_send_json_error();
        return;
    }
    
    $query = isset($_POST['query']) ? sanitize_text_field($_POST['query']) : '';
    
    if (empty($query)) {
        wp_send_json_error();
        return;
    }
    
    // Store search query (for analytics)
    $searches = get_option('agency_core_search_queries', array());
    
    if (!isset($searches[$query])) {
        $searches[$query] = 0;
    }
    
    $searches[$query]++;
    
    // Keep only top 100
    arsort($searches);
    $searches = array_slice($searches, 0, 100, true);
    
    update_option('agency_core_search_queries', $searches);
    
    wp_send_json_success();
}