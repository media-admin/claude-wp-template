<?php
/**
 * Helper Functions
 */

if (!defined('ABSPATH')) exit;

// Get SVG Icon
function customtheme_get_svg($icon_name) {
    $svg_path = CUSTOMTHEME_DIR . '/assets/src/images/icons/' . $icon_name . '.svg';
    if (file_exists($svg_path)) {
        return file_get_contents($svg_path);
    }
    return '';
}

// Reading Time
function customtheme_reading_time($post_id = null) {
    $post_id = $post_id ?: get_the_ID();
    $content = get_post_field('post_content', $post_id);
    $word_count = str_word_count(strip_tags($content));
    return ceil($word_count / 200);
}

// Excerpt Length
function customtheme_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'customtheme_excerpt_length');