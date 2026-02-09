<?php
/**
 * ACF Field Groups
 * 
 * Define ACF field groups for custom post types.
 * 
 * @package Agency_Core
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register ACF Field Groups
 * 
 * WICHTIG: acf/include_field_types Hook wird nach ACF init aufgerufen
 */
add_action('acf/include_field_types', 'agency_core_register_acf_fields');

function agency_core_register_acf_fields() {
    // Check if ACF is available
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    
    // Team Member Fields
    agency_core_register_team_fields();
    
    // Project Fields
    agency_core_register_project_fields();
    
    // Testimonial Fields
    agency_core_register_testimonial_fields();
    
    // Service Fields
    agency_core_register_service_fields();

    // Hero Slides Fields
    agency_core_register_hero_slide_fields();

    // FAQ Fields
    agency_core_register_faq_fields();

    // Carousel Fields
    agency_core_register_carousel_fields();

    // WooCommerce Product Fields
    agency_core_register_product_fields();


}

/**
 * Team Member Fields
 */
function agency_core_register_team_fields() {
    acf_add_local_field_group(array(
        'key' => 'group_team_member',
        'title' => 'Team Member Details',
        'fields' => array(
            array(
                'key' => 'field_team_role',
                'label' => 'Role / Position',
                'name' => 'role',
                'type' => 'text',
                'required' => 1,
                'placeholder' => 'e.g., CEO, Developer, Designer',
            ),
            array(
                'key' => 'field_team_email',
                'label' => 'Email',
                'name' => 'email',
                'type' => 'email',
                'placeholder' => 'email@example.com',
            ),
            array(
                'key' => 'field_team_phone',
                'label' => 'Phone',
                'name' => 'phone',
                'type' => 'text',
                'placeholder' => '+43 XXX XXX XXX',
            ),
            array(
                'key' => 'field_team_social',
                'label' => 'Social Media',
                'name' => 'social_media',
                'type' => 'group',
                'layout' => 'block',
                'sub_fields' => array(
                    array(
                        'key' => 'field_team_linkedin',
                        'label' => 'LinkedIn',
                        'name' => 'linkedin',
                        'type' => 'url',
                        'placeholder' => 'https://linkedin.com/in/username',
                    ),
                    array(
                        'key' => 'field_team_twitter',
                        'label' => 'Twitter',
                        'name' => 'twitter',
                        'type' => 'url',
                        'placeholder' => 'https://twitter.com/username',
                    ),
                    array(
                        'key' => 'field_team_facebook',
                        'label' => 'Facebook',
                        'name' => 'facebook',
                        'type' => 'url',
                        'placeholder' => 'https://facebook.com/username',
                    ),
                    array(
                        'key' => 'field_team_instagram',
                        'label' => 'Instagram',
                        'name' => 'instagram',
                        'type' => 'url',
                        'placeholder' => 'https://instagram.com/username',
                    ),
                ),
            ),
            array(
                'key' => 'field_team_display_order',
                'label' => 'Display Order',
                'name' => 'display_order',
                'type' => 'number',
                'default_value' => 0,
                'min' => 0,
                'step' => 1,
                'instructions' => 'Lower numbers appear first (0 = first)',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'team',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
    ));
}

/**
 * Project Fields
 */
function agency_core_register_project_fields() {
    acf_add_local_field_group(array(
        'key' => 'group_project',
        'title' => 'Project Details',
        'fields' => array(
            array(
                'key' => 'field_project_client',
                'label' => 'Client',
                'name' => 'client',
                'type' => 'text',
                'placeholder' => 'Client name',
            ),
            array(
                'key' => 'field_project_date',
                'label' => 'Project Date',
                'name' => 'project_date',
                'type' => 'date_picker',
                'display_format' => 'd/m/Y',
                'return_format' => 'd/m/Y',
                'first_day' => 1,
            ),
            array(
                'key' => 'field_project_url',
                'label' => 'Project URL',
                'name' => 'project_url',
                'type' => 'url',
                'placeholder' => 'https://example.com',
            ),
            array(
                'key' => 'field_project_gallery',
                'label' => 'Gallery',
                'name' => 'gallery',
                'type' => 'gallery',
                'return_format' => 'array',
                'preview_size' => 'medium',
                'library' => 'all',
            ),
            array(
                'key' => 'field_project_technologies',
                'label' => 'Technologies Used',
                'name' => 'technologies',
                'type' => 'textarea',
                'rows' => 3,
                'placeholder' => 'e.g., WordPress, React, PHP',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'project',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
    ));
}

/**
 * Testimonial Fields
 */
function agency_core_register_testimonial_fields() {
    acf_add_local_field_group(array(
        'key' => 'group_testimonial',
        'title' => 'Testimonial Details',
        'fields' => array(
            array(
                'key' => 'field_testimonial_author',
                'label' => 'Author Name',
                'name' => 'author_name',
                'type' => 'text',
                'required' => 1,
                'placeholder' => 'John Doe',
            ),
            array(
                'key' => 'field_testimonial_company',
                'label' => 'Company',
                'name' => 'company',
                'type' => 'text',
                'placeholder' => 'Company Name',
            ),
            array(
                'key' => 'field_testimonial_position',
                'label' => 'Position',
                'name' => 'position',
                'type' => 'text',
                'placeholder' => 'CEO, Founder, etc.',
            ),
            array(
                'key' => 'field_testimonial_rating',
                'label' => 'Rating',
                'name' => 'rating',
                'type' => 'number',
                'min' => 1,
                'max' => 5,
                'step' => 1,
                'default_value' => 5,
            ),
            array(
                'key' => 'field_testimonial_image',
                'label' => 'Author Image',
                'name' => 'author_image',
                'type' => 'image',
                'return_format' => 'url',
                'preview_size' => 'thumbnail',
                'library' => 'all',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'testimonial',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
    ));
}

/**
 * Service Fields
 */
function agency_core_register_service_fields() {
    acf_add_local_field_group(array(
        'key' => 'group_service',
        'title' => 'Service Details',
        'fields' => array(
            array(
                'key' => 'field_service_icon',
                'label' => 'Icon Class',
                'name' => 'icon',
                'type' => 'text',
                'instructions' => 'Dashicon class (e.g., dashicons-admin-tools) or Font Awesome (e.g., fa-rocket)',
                'placeholder' => 'dashicons-admin-tools',
            ),
            array(
                'key' => 'field_service_price',
                'label' => 'Starting Price',
                'name' => 'price',
                'type' => 'text',
                'instructions' => 'e.g., "ab 500€" or "On Request"',
                'placeholder' => 'ab 500€',
            ),
            array(
                'key' => 'field_service_features',
                'label' => 'Key Features',
                'name' => 'features',
                'type' => 'repeater',
                'button_label' => 'Add Feature',
                'layout' => 'table',
                'sub_fields' => array(
                    array(
                        'key' => 'field_service_feature_text',
                        'label' => 'Feature',
                        'name' => 'feature_text',
                        'type' => 'text',
                        'placeholder' => 'Feature description',
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'service',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
    ));
}


/**
 * Product Additional Fields
 */
function agency_core_register_product_fields() {
    acf_add_local_field_group(array(
        'key' => 'group_product_additional',
        'title' => 'Additional Product Information',
        'fields' => array(
            array(
                'key' => 'field_product_highlights',
                'label' => 'Product Highlights',
                'name' => 'product_highlights',
                'type' => 'repeater',
                'button_label' => 'Add Highlight',
                'layout' => 'table',
                'sub_fields' => array(
                    array(
                        'key' => 'field_highlight_text',
                        'label' => 'Highlight',
                        'name' => 'highlight_text',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_highlight_icon',
                        'label' => 'Icon (optional)',
                        'name' => 'highlight_icon',
                        'type' => 'text',
                        'placeholder' => 'dashicons-yes',
                    ),
                ),
            ),
            array(
                'key' => 'field_product_specifications',
                'label' => 'Specifications',
                'name' => 'specifications',
                'type' => 'repeater',
                'button_label' => 'Add Specification',
                'layout' => 'table',
                'sub_fields' => array(
                    array(
                        'key' => 'field_spec_label',
                        'label' => 'Label',
                        'name' => 'spec_label',
                        'type' => 'text',
                        'placeholder' => 'Größe, Gewicht, Material...',
                    ),
                    array(
                        'key' => 'field_spec_value',
                        'label' => 'Value',
                        'name' => 'spec_value',
                        'type' => 'text',
                    ),
                ),
            ),
            array(
                'key' => 'field_product_video',
                'label' => 'Product Video URL',
                'name' => 'product_video',
                'type' => 'url',
                'placeholder' => 'YouTube oder Vimeo URL',
            ),
            array(
                'key' => 'field_product_badge',
                'label' => 'Custom Badge',
                'name' => 'product_badge',
                'type' => 'select',
                'choices' => array(
                    '' => 'None',
                    'new' => 'Neu',
                    'bestseller' => 'Bestseller',
                    'limited' => 'Limitiert',
                    'eco' => 'Umweltfreundlich',
                ),
                'allow_null' => 1,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'product',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
    ));
}


/**
 * Hero Slide Fields
 */
function agency_core_register_hero_slide_fields() {
    acf_add_local_field_group(array(
        'key' => 'group_hero_slide',
        'title' => 'Hero Slide Details',
        'fields' => array(
            array(
                'key' => 'field_hero_subtitle',
                'label' => 'Subtitle',
                'name' => 'subtitle',
                'type' => 'text',
                'placeholder' => 'Untertitel oder Tagline',
            ),
            array(
                'key' => 'field_hero_button_text',
                'label' => 'Button Text',
                'name' => 'button_text',
                'type' => 'text',
                'placeholder' => 'z.B. Mehr erfahren',
            ),
            array(
                'key' => 'field_hero_button_url',
                'label' => 'Button URL',
                'name' => 'button_url',
                'type' => 'url',
                'placeholder' => 'https://example.com',
            ),
            array(
                'key' => 'field_hero_button_style',
                'label' => 'Button Style',
                'name' => 'button_style',
                'type' => 'select',
                'choices' => array(
                    'primary' => 'Primary',
                    'secondary' => 'Secondary',
                    'outline' => 'Outline',
                ),
                'default_value' => 'primary',
            ),
            array(
                'key' => 'field_hero_image_desktop',
                'label' => 'Desktop Image',
                'name' => 'image_desktop',
                'type' => 'image',
                'return_format' => 'url',
                'preview_size' => 'medium',
                'library' => 'all',
                'instructions' => 'Empfohlene Größe: 1920x1080px',
            ),
            array(
                'key' => 'field_hero_image_mobile',
                'label' => 'Mobile Image',
                'name' => 'image_mobile',
                'type' => 'image',
                'return_format' => 'url',
                'preview_size' => 'medium',
                'library' => 'all',
                'instructions' => 'Empfohlene Größe: 800x600px',
            ),
            array(
                'key' => 'field_hero_overlay_opacity',
                'label' => 'Overlay Opacity',
                'name' => 'overlay_opacity',
                'type' => 'range',
                'min' => 0,
                'max' => 100,
                'step' => 5,
                'default_value' => 30,
                'append' => '%',
            ),
            array(
                'key' => 'field_hero_text_color',
                'label' => 'Text Color',
                'name' => 'text_color',
                'type' => 'select',
                'choices' => array(
                    'light' => 'Light (White)',
                    'dark' => 'Dark (Black)',
                ),
                'default_value' => 'light',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'hero_slide',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
    ));
}

/**
 * FAQ Fields
 */
function agency_core_register_faq_fields() {
    acf_add_local_field_group(array(
        'key' => 'group_faq',
        'title' => 'FAQ Details',
        'fields' => array(
            array(
                'key' => 'field_faq_answer',
                'label' => 'Answer',
                'name' => 'answer',
                'type' => 'wysiwyg',
                'required' => 1,
                'tabs' => 'all',
                'toolbar' => 'basic',
                'media_upload' => 0,
                'instructions' => 'The question is the post title, this is the answer.',
            ),
            array(
                'key' => 'field_faq_order',
                'label' => 'Display Order',
                'name' => 'display_order',
                'type' => 'number',
                'default_value' => 0,
                'min' => 0,
                'step' => 1,
                'instructions' => 'Lower numbers appear first (0 = first)',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'faq',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
    ));
}

/**
 * Carousel Fields
 */
function agency_core_register_carousel_fields() {
    acf_add_local_field_group(array(
        'key' => 'group_carousel',
        'title' => 'Carousel Item Details',
        'fields' => array(
            array(
                'key' => 'field_carousel_subtitle',
                'label' => 'Subtitle',
                'name' => 'subtitle',
                'type' => 'text',
                'placeholder' => 'Optional subtitle or tagline',
            ),
            array(
                'key' => 'field_carousel_link',
                'label' => 'Link URL',
                'name' => 'link_url',
                'type' => 'url',
                'placeholder' => 'https://example.com',
            ),
            array(
                'key' => 'field_carousel_link_target',
                'label' => 'Open Link In',
                'name' => 'link_target',
                'type' => 'select',
                'choices' => array(
                    '_self' => 'Same Window',
                    '_blank' => 'New Window',
                ),
                'default_value' => '_self',
            ),
            array(
                'key' => 'field_carousel_image',
                'label' => 'Image',
                'name' => 'image',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
                'library' => 'all',
                'instructions' => 'Recommended size: 800x600px',
            ),
            array(
                'key' => 'field_carousel_overlay',
                'label' => 'Show Text Overlay',
                'name' => 'show_overlay',
                'type' => 'true_false',
                'default_value' => 1,
                'ui' => 1,
            ),
            array(
                'key' => 'field_carousel_display_order',
                'label' => 'Display Order',
                'name' => 'display_order',
                'type' => 'number',
                'default_value' => 0,
                'min' => 0,
                'step' => 1,
                'instructions' => 'Lower numbers appear first',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'carousel',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
    ));
}