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
 * Check if ACF is active
 */
if (!function_exists('acf_add_local_field_group')) {
    add_action('admin_notices', function() {
        echo '<div class="notice notice-warning"><p><strong>Agency Core:</strong> Advanced Custom Fields plugin is required for custom fields functionality.</p></div>';
    });
    return;
}

/**
 * Team Member Fields
 */
add_action('acf/init', function() {
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
            ),
            array(
                'key' => 'field_team_email',
                'label' => 'Email',
                'name' => 'email',
                'type' => 'email',
            ),
            array(
                'key' => 'field_team_phone',
                'label' => 'Phone',
                'name' => 'phone',
                'type' => 'text',
            ),
            array(
                'key' => 'field_team_social',
                'label' => 'Social Media',
                'name' => 'social_media',
                'type' => 'group',
                'sub_fields' => array(
                    array(
                        'key' => 'field_team_linkedin',
                        'label' => 'LinkedIn',
                        'name' => 'linkedin',
                        'type' => 'url',
                    ),
                    array(
                        'key' => 'field_team_twitter',
                        'label' => 'Twitter',
                        'name' => 'twitter',
                        'type' => 'url',
                    ),
                    array(
                        'key' => 'field_team_facebook',
                        'label' => 'Facebook',
                        'name' => 'facebook',
                        'type' => 'url',
                    ),
                ),
            ),
            array(
                'key' => 'field_team_display_order',
                'label' => 'Display Order',
                'name' => 'display_order',
                'type' => 'number',
                'default_value' => 0,
                'instructions' => 'Lower numbers appear first',
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
    ));
});

/**
 * Project Fields
 */
add_action('acf/init', function() {
    acf_add_local_field_group(array(
        'key' => 'group_project',
        'title' => 'Project Details',
        'fields' => array(
            array(
                'key' => 'field_project_client',
                'label' => 'Client',
                'name' => 'client',
                'type' => 'text',
            ),
            array(
                'key' => 'field_project_date',
                'label' => 'Project Date',
                'name' => 'project_date',
                'type' => 'date_picker',
                'display_format' => 'd/m/Y',
                'return_format' => 'd/m/Y',
            ),
            array(
                'key' => 'field_project_url',
                'label' => 'Project URL',
                'name' => 'project_url',
                'type' => 'url',
            ),
            array(
                'key' => 'field_project_gallery',
                'label' => 'Gallery',
                'name' => 'gallery',
                'type' => 'gallery',
                'return_format' => 'array',
            ),
            array(
                'key' => 'field_project_technologies',
                'label' => 'Technologies Used',
                'name' => 'technologies',
                'type' => 'textarea',
                'rows' => 3,
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
    ));
});

/**
 * Testimonial Fields
 */
add_action('acf/init', function() {
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
            ),
            array(
                'key' => 'field_testimonial_company',
                'label' => 'Company',
                'name' => 'company',
                'type' => 'text',
            ),
            array(
                'key' => 'field_testimonial_position',
                'label' => 'Position',
                'name' => 'position',
                'type' => 'text',
            ),
            array(
                'key' => 'field_testimonial_rating',
                'label' => 'Rating',
                'name' => 'rating',
                'type' => 'number',
                'min' => 1,
                'max' => 5,
                'step' => 1,
            ),
            array(
                'key' => 'field_testimonial_image',
                'label' => 'Author Image',
                'name' => 'author_image',
                'type' => 'image',
                'return_format' => 'url',
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
    ));
});

/**
 * Service Fields
 */
add_action('acf/init', function() {
    acf_add_local_field_group(array(
        'key' => 'group_service',
        'title' => 'Service Details',
        'fields' => array(
            array(
                'key' => 'field_service_icon',
                'label' => 'Icon Class',
                'name' => 'icon',
                'type' => 'text',
                'instructions' => 'Dashicon class (e.g., dashicons-admin-tools)',
            ),
            array(
                'key' => 'field_service_price',
                'label' => 'Starting Price',
                'name' => 'price',
                'type' => 'text',
                'instructions' => 'e.g., "ab 500€" or "On Request"',
            ),
            array(
                'key' => 'field_service_features',
                'label' => 'Key Features',
                'name' => 'features',
                'type' => 'repeater',
                'button_label' => 'Add Feature',
                'sub_fields' => array(
                    array(
                        'key' => 'field_service_feature_text',
                        'label' => 'Feature',
                        'name' => 'feature_text',
                        'type' => 'text',
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
    ));
});