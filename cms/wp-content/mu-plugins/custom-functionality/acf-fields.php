<?php
/**
 * ACF Field Groups
 * 
 * Defined in PHP for version control
 * 
 * @package CustomTheme
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('acf_add_local_field_group')) {
    return;
}

/**
 * Hero Slider Fields
 */
acf_add_local_field_group(array(
    'key' => 'group_hero_slider',
    'title' => 'Hero Slider Einstellungen',
    'fields' => array(
        array(
            'key' => 'field_slide_subtitle',
            'label' => 'Untertitel',
            'name' => 'slide_subtitle',
            'type' => 'text',
        ),
        array(
            'key' => 'field_slide_button_text',
            'label' => 'Button Text',
            'name' => 'slide_button_text',
            'type' => 'text',
            'default_value' => 'Mehr erfahren',
        ),
        array(
            'key' => 'field_slide_button_link',
            'label' => 'Button Link',
            'name' => 'slide_button_link',
            'type' => 'link',
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'slide',
            ),
        ),
    ),
));

/**
 * Project Fields
 */
acf_add_local_field_group(array(
    'key' => 'group_project',
    'title' => 'Projekt Details',
    'fields' => array(
        array(
            'key' => 'field_project_url',
            'label' => 'Projekt URL',
            'name' => 'project_url',
            'type' => 'url',
        ),
        array(
            'key' => 'field_project_client',
            'label' => 'Kunde',
            'name' => 'project_client',
            'type' => 'text',
        ),
        array(
            'key' => 'field_project_year',
            'label' => 'Jahr',
            'name' => 'project_year',
            'type' => 'number',
            'default_value' => date('Y'),
        ),
        array(
            'key' => 'field_project_gallery',
            'label' => 'Projekt Galerie',
            'name' => 'project_gallery',
            'type' => 'gallery',
            'return_format' => 'array',
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

/**
 * Team Member Fields
 */
acf_add_local_field_group(array(
    'key' => 'group_team',
    'title' => 'Team Mitglied Details',
    'fields' => array(
        array(
            'key' => 'field_team_position',
            'label' => 'Position',
            'name' => 'team_position',
            'type' => 'text',
            'required' => true,
        ),
        array(
            'key' => 'field_team_email',
            'label' => 'E-Mail',
            'name' => 'team_email',
            'type' => 'email',
        ),
        array(
            'key' => 'field_team_phone',
            'label' => 'Telefon',
            'name' => 'team_phone',
            'type' => 'text',
        ),
        array(
            'key' => 'field_team_social',
            'label' => 'Social Media',
            'name' => 'team_social',
            'type' => 'repeater',
            'sub_fields' => array(
                array(
                    'key' => 'field_social_platform',
                    'label' => 'Plattform',
                    'name' => 'platform',
                    'type' => 'select',
                    'choices' => array(
                        'linkedin' => 'LinkedIn',
                        'twitter' => 'Twitter',
                        'github' => 'GitHub',
                        'instagram' => 'Instagram',
                    ),
                ),
                array(
                    'key' => 'field_social_url',
                    'label' => 'URL',
                    'name' => 'url',
                    'type' => 'url',
                ),
            ),
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

/**
 * Testimonial Fields
 */
acf_add_local_field_group(array(
    'key' => 'group_testimonial',
    'title' => 'Testimonial Details',
    'fields' => array(
        array(
            'key' => 'field_testimonial_rating',
            'label' => 'Bewertung',
            'name' => 'testimonial_rating',
            'type' => 'range',
            'min' => 1,
            'max' => 5,
            'step' => 1,
            'default_value' => 5,
        ),
        array(
            'key' => 'field_testimonial_company',
            'label' => 'Firma',
            'name' => 'testimonial_company',
            'type' => 'text',
        ),
        array(
            'key' => 'field_testimonial_position',
            'label' => 'Position',
            'name' => 'testimonial_position',
            'type' => 'text',
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

/**
 * Service Fields
 */
acf_add_local_field_group(array(
    'key' => 'group_service',
    'title' => 'Leistungs Details',
    'fields' => array(
        array(
            'key' => 'field_service_icon',
            'label' => 'Icon',
            'name' => 'service_icon',
            'type' => 'image',
            'return_format' => 'array',
        ),
        array(
            'key' => 'field_service_features',
            'label' => 'Features',
            'name' => 'service_features',
            'type' => 'repeater',
            'sub_fields' => array(
                array(
                    'key' => 'field_feature_text',
                    'label' => 'Feature',
                    'name' => 'text',
                    'type' => 'text',
                ),
            ),
        ),
        array(
            'key' => 'field_service_price',
            'label' => 'Preis',
            'name' => 'service_price',
            'type' => 'text',
            'placeholder' => 'Ab 999€',
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

/**
 * FAQ Fields (Order)
 */
acf_add_local_field_group(array(
    'key' => 'group_faq',
    'title' => 'FAQ Einstellungen',
    'fields' => array(
        array(
            'key' => 'field_faq_order',
            'label' => 'Reihenfolge',
            'name' => 'faq_order',
            'type' => 'number',
            'default_value' => 10,
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
));

/**
 * Page Builder Fields (ACF Free Version - Separate Groups)
 */

// Hero Slider Section
acf_add_local_field_group(array(
    'key' => 'group_page_hero',
    'title' => 'Hero Slider Section',
    'fields' => array(
        array(
            'key' => 'field_show_hero',
            'label' => 'Hero Slider anzeigen',
            'name' => 'show_hero',
            'type' => 'true_false',
            'default_value' => 0,
            'ui' => 1,
        ),
        array(
            'key' => 'field_hero_slides',
            'label' => 'Slides',
            'name' => 'hero_slides',
            'type' => 'relationship',
            'post_type' => array('slide'),
            'return_format' => 'object',
            'conditional_logic' => array(
                array(
                    array(
                        'field' => 'field_show_hero',
                        'operator' => '==',
                        'value' => '1',
                    ),
                ),
            ),
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'page',
            ),
        ),
    ),
    'menu_order' => 10,
));

// FAQ/Accordion Section
acf_add_local_field_group(array(
    'key' => 'group_page_faq',
    'title' => 'FAQ Section',
    'fields' => array(
        array(
            'key' => 'field_show_faq',
            'label' => 'FAQ Section anzeigen',
            'name' => 'show_faq',
            'type' => 'true_false',
            'default_value' => 0,
            'ui' => 1,
        ),
        array(
            'key' => 'field_faq_title',
            'label' => 'Titel',
            'name' => 'faq_title',
            'type' => 'text',
            'default_value' => 'Häufige Fragen',
            'conditional_logic' => array(
                array(
                    array(
                        'field' => 'field_show_faq',
                        'operator' => '==',
                        'value' => '1',
                    ),
                ),
            ),
        ),
        array(
            'key' => 'field_faq_items',
            'label' => 'FAQs',
            'name' => 'faq_items',
            'type' => 'relationship',
            'post_type' => array('faq'),
            'return_format' => 'object',
            'conditional_logic' => array(
                array(
                    array(
                        'field' => 'field_show_faq',
                        'operator' => '==',
                        'value' => '1',
                    ),
                ),
            ),
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'page',
            ),
        ),
    ),
    'menu_order' => 20,
));

// Projects Section
acf_add_local_field_group(array(
    'key' => 'group_page_projects',
    'title' => 'Projekte Section',
    'fields' => array(
        array(
            'key' => 'field_show_projects',
            'label' => 'Projekte Section anzeigen',
            'name' => 'show_projects',
            'type' => 'true_false',
            'default_value' => 0,
            'ui' => 1,
        ),
        array(
            'key' => 'field_projects_title',
            'label' => 'Titel',
            'name' => 'projects_title',
            'type' => 'text',
            'default_value' => 'Unsere Projekte',
            'conditional_logic' => array(
                array(
                    array(
                        'field' => 'field_show_projects',
                        'operator' => '==',
                        'value' => '1',
                    ),
                ),
            ),
        ),
        array(
            'key' => 'field_projects_items',
            'label' => 'Projekte',
            'name' => 'projects_items',
            'type' => 'relationship',
            'post_type' => array('project'),
            'return_format' => 'object',
            'conditional_logic' => array(
                array(
                    array(
                        'field' => 'field_show_projects',
                        'operator' => '==',
                        'value' => '1',
                    ),
                ),
            ),
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'page',
            ),
        ),
    ),
    'menu_order' => 30,
));

// Team Section
acf_add_local_field_group(array(
    'key' => 'group_page_team',
    'title' => 'Team Section',
    'fields' => array(
        array(
            'key' => 'field_show_team',
            'label' => 'Team Section anzeigen',
            'name' => 'show_team',
            'type' => 'true_false',
            'default_value' => 0,
            'ui' => 1,
        ),
        array(
            'key' => 'field_team_title',
            'label' => 'Titel',
            'name' => 'team_title',
            'type' => 'text',
            'default_value' => 'Unser Team',
            'conditional_logic' => array(
                array(
                    array(
                        'field' => 'field_show_team',
                        'operator' => '==',
                        'value' => '1',
                    ),
                ),
            ),
        ),
        array(
            'key' => 'field_team_members_list',
            'label' => 'Team Mitglieder',
            'name' => 'team_members_list',
            'type' => 'relationship',
            'post_type' => array('team'),
            'return_format' => 'object',
            'conditional_logic' => array(
                array(
                    array(
                        'field' => 'field_show_team',
                        'operator' => '==',
                        'value' => '1',
                    ),
                ),
            ),
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'page',
            ),
        ),
    ),
    'menu_order' => 40,
));

// Testimonials Section
acf_add_local_field_group(array(
    'key' => 'group_page_testimonials',
    'title' => 'Testimonials Section',
    'fields' => array(
        array(
            'key' => 'field_show_testimonials',
            'label' => 'Testimonials Section anzeigen',
            'name' => 'show_testimonials',
            'type' => 'true_false',
            'default_value' => 0,
            'ui' => 1,
        ),
        array(
            'key' => 'field_testimonials_title',
            'label' => 'Titel',
            'name' => 'testimonials_title',
            'type' => 'text',
            'default_value' => 'Was unsere Kunden sagen',
            'conditional_logic' => array(
                array(
                    array(
                        'field' => 'field_show_testimonials',
                        'operator' => '==',
                        'value' => '1',
                    ),
                ),
            ),
        ),
        array(
            'key' => 'field_testimonials_items',
            'label' => 'Testimonials',
            'name' => 'testimonials_items',
            'type' => 'relationship',
            'post_type' => array('testimonial'),
            'return_format' => 'object',
            'conditional_logic' => array(
                array(
                    array(
                        'field' => 'field_show_testimonials',
                        'operator' => '==',
                        'value' => '1',
                    ),
                ),
            ),
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'page',
            ),
        ),
    ),
    'menu_order' => 50,
));