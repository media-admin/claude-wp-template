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


/**
 * Generate Picture Element with WebP support
 * 
 * @param int $image_id Attachment ID
 * @param string $size Image size
 * @param array $args Additional arguments
 * @return string Picture HTML
 */
function customtheme_get_picture($image_id, $size = 'large', $args = array()) {
    if (!$image_id) {
        return '';
    }
    
    $defaults = array(
        'class' => '',
        'alt' => '',
        'loading' => 'lazy',
    );
    
    $args = wp_parse_args($args, $defaults);
    
    // Get image URLs
    $image_url = wp_get_attachment_image_url($image_id, $size);
    $image_webp = str_replace(['.jpg', '.jpeg', '.png'], '.webp', $image_url);
    
    // Get srcset
    $srcset = wp_get_attachment_image_srcset($image_id, $size);
    $sizes = wp_get_attachment_image_sizes($image_id, $size);
    
    // Alt text
    $alt = $args['alt'] ?: get_post_meta($image_id, '_wp_attachment_image_alt', true);
    
    ob_start();
    ?>
    <picture>
        <!-- WebP -->
        <source 
            type="image/webp" 
            srcset="<?php echo esc_attr($image_webp); ?>"
            sizes="<?php echo esc_attr($sizes); ?>"
        >
        
        <!-- Fallback -->
        <img 
            src="<?php echo esc_url($image_url); ?>"
            srcset="<?php echo esc_attr($srcset); ?>"
            sizes="<?php echo esc_attr($sizes); ?>"
            alt="<?php echo esc_attr($alt); ?>"
            class="<?php echo esc_attr($args['class']); ?>"
            loading="<?php echo esc_attr($args['loading']); ?>"
        >
    </picture>
    <?php
    
    return ob_get_clean();
}