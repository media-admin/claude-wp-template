<?php
/**
 * Plugin Name: Custom Blocks
 * Description: Shortcodes für Custom Components
 * Version: 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

// ============================================
// ACCORDION SHORTCODES
// ============================================

function accordion_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'allow_multiple' => 'false',
    ), $atts);
    
    $allow_multiple = $atts['allow_multiple'] === 'true' ? 'data-allow-multiple="true"' : '';
    
    return '<div class="accordion" ' . $allow_multiple . '>' . do_shortcode($content) . '</div>';
}
add_shortcode('accordion', 'accordion_shortcode');

function accordion_item_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'title' => 'Accordion Item',
        'open' => 'false',
    ), $atts);
    
    $is_open = $atts['open'] === 'true';
    $active_class = $is_open ? 'is-active' : '';
    $expanded = $is_open ? 'true' : 'false';
    $icon = $is_open ? '−' : '+';
    $display = $is_open ? 'style="display:block;"' : '';
    
    return '
    <div class="accordion__item ' . $active_class . '">
        <button class="accordion__trigger" aria-expanded="' . $expanded . '">
            <span class="accordion__title">' . esc_html($atts['title']) . '</span>
            <span class="accordion__icon">' . $icon . '</span>
        </button>
        <div class="accordion__content" ' . $display . '>
            <div class="accordion__content-inner">' . wpautop(do_shortcode($content)) . '</div>
        </div>
    </div>';
}
add_shortcode('accordion_item', 'accordion_item_shortcode');

// ============================================
// HERO SLIDER SHORTCODES
// ============================================

function hero_slider_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'autoplay' => 'true',
        'delay' => '5000',
        'loop' => 'true',
    ), $atts);
    
    $slider_id = 'hero-slider-' . uniqid();
    
    $autoplay_attr = $atts['autoplay'] === 'true' ? 'data-autoplay="true"' : '';
    $delay_attr = 'data-delay="' . esc_attr($atts['delay']) . '"';
    $loop_attr = $atts['loop'] === 'true' ? 'data-loop="true"' : '';
    
    return '
    <div class="hero-slider swiper" id="' . $slider_id . '" ' . $autoplay_attr . ' ' . $delay_attr . ' ' . $loop_attr . '>
        <div class="swiper-wrapper">' . do_shortcode($content) . '</div>
        <div class="hero-slider__navigation">
            <button class="hero-slider__button hero-slider__button--prev" aria-label="Previous slide">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </button>
            <button class="hero-slider__button hero-slider__button--next" aria-label="Next slide">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </button>
        </div>
        <div class="hero-slider__pagination"></div>
    </div>';
}
add_shortcode('hero_slider', 'hero_slider_shortcode');

function hero_slide_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'image' => '',
        'title' => '',
        'subtitle' => '',
        'button_text' => '',
        'button_link' => '',
        'button_target' => '_self',
    ), $atts);
    
    $image_url = esc_url($atts['image']);
    $title = esc_html($atts['title']);
    $subtitle = esc_html($atts['subtitle']);
    $button_text = esc_html($atts['button_text']);
    $button_link = esc_url($atts['button_link']);
    $button_target = esc_attr($atts['button_target']);
    
    $button_html = '';
    if ($button_text && $button_link) {
        $button_html = '<a href="' . $button_link . '" class="hero-slider__button-cta" target="' . $button_target . '">' . $button_text . '</a>';
    }
    
    return '
    <div class="swiper-slide hero-slider__slide">
        <div class="hero-slider__image" style="background-image: url(' . $image_url . ')"></div>
        <div class="hero-slider__content">
            <div class="hero-slider__content-inner">
                ' . ($title ? '<h1 class="hero-slider__title">' . $title . '</h1>' : '') . '
                ' . ($subtitle ? '<p class="hero-slider__subtitle">' . $subtitle . '</p>' : '') . '
                ' . $button_html . '
            </div>
        </div>
    </div>';
}
add_shortcode('hero_slide', 'hero_slide_shortcode');

// ============================================
// MODAL SHORTCODES
// ============================================

function modal_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'id' => 'modal-' . uniqid(),
        'title' => '',
        'size' => 'normal',
        'show_header' => 'true',
        'show_footer' => 'false',
    ), $atts);
    
    $modal_id = esc_attr($atts['id']);
    $size_class = $atts['size'] !== 'normal' ? ' modal--' . esc_attr($atts['size']) : '';
    $title = esc_html($atts['title']);
    $show_header = $atts['show_header'] === 'true';
    $show_footer = $atts['show_footer'] === 'true';
    
    $body_content = wpautop(do_shortcode($content));
    
    $html = '<div class="modal' . $size_class . '" id="' . $modal_id . '">';
    $html .= '<div class="modal__dialog">';
    
    if ($show_header) {
        $html .= '<div class="modal__header">';
        if ($title) {
            $html .= '<h3 class="modal__title">' . $title . '</h3>';
        }
        $html .= '<button class="modal__close" data-modal-close aria-label="Schließen">&times;</button>';
        $html .= '</div>';
    } else {
        $html .= '<button class="modal__close" data-modal-close aria-label="Schließen" style="position: absolute; top: 10px; right: 10px; z-index: 10;">&times;</button>';
    }
    
    $html .= '<div class="modal__body">' . $body_content . '</div>';
    
    if ($show_footer) {
        $html .= '<div class="modal__footer">';
        $html .= '<button class="button button--secondary" data-modal-close>Schließen</button>';
        $html .= '</div>';
    }
    
    $html .= '</div></div>';
    
    return $html;
}
add_shortcode('modal', 'modal_shortcode');

function modal_trigger_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'target' => '',
        'style' => 'button',
        'color' => 'primary',
    ), $atts);
    
    $target = esc_attr($atts['target']);
    $button_text = $content ? esc_html($content) : 'Modal öffnen';
    
    if ($atts['style'] === 'button') {
        $class = 'button button--' . esc_attr($atts['color']);
        return '<button class="' . $class . '" data-modal-trigger="' . $target . '">' . $button_text . '</button>';
    } 
    elseif ($atts['style'] === 'link') {
        return '<a href="#" data-modal-trigger="' . $target . '" style="color: #667eea; text-decoration: underline;">' . $button_text . '</a>';
    }
    else {
        return '<span data-modal-trigger="' . $target . '" style="cursor: pointer; color: #667eea; text-decoration: underline;">' . $button_text . '</span>';
    }
}
add_shortcode('modal_trigger', 'modal_trigger_shortcode');

// ============================================
// ADMIN BUTTONS
// ============================================

add_action('media_buttons', 'add_shortcode_buttons');
function add_shortcode_buttons() {
    echo '<button type="button" class="button" id="insert-accordion">
        <span class="dashicons dashicons-list-view" style="margin-top: 3px;"></span> Accordion
    </button>';
    
    echo '<button type="button" class="button" id="insert-hero-slider" style="margin-left: 5px;">
        <span class="dashicons dashicons-images-alt2" style="margin-top: 3px;"></span> Hero Slider
    </button>';
    
    echo '<button type="button" class="button" id="insert-modal" style="margin-left: 5px;">
        <span class="dashicons dashicons-admin-page" style="margin-top: 3px;"></span> Modal
    </button>';

    echo '<button type="button" class="button" id="insert-testimonials" style="margin-left: 5px;">
        <span class="dashicons dashicons-star-filled" style="margin-top: 3px;"></span> Testimonials
    </button>';

    echo '<button type="button" class="button" id="insert-tabs" style="margin-left: 5px;">
        <span class="dashicons dashicons-index-card" style="margin-top: 3px;"></span> Tabs
    </button>';

    echo '<button type="button" class="button" id="insert-notification" style="margin-left: 5px;">
        <span class="dashicons dashicons-bell" style="margin-top: 3px;"></span> Notification
    </button>';

    echo '<button type="button" class="button" id="insert-notification" style="margin-left: 5px;">
        <span class="dashicons dashicons-megaphone" style="margin-top: 3px;"></span> Notification
    </button>';

    echo '<button type="button" class="button" id="insert-stats" style="margin-left: 5px;">
        <span class="dashicons dashicons-chart-bar" style="margin-top: 3px;"></span> Stats
    </button>'; 

}

add_action('admin_footer', 'shortcode_buttons_js');
function shortcode_buttons_js() {
    ?>
    <script>
    jQuery(document).ready(function($) {
        // Accordion
        $('#insert-accordion').on('click', function(e) {
            e.preventDefault();
            var shortcode = `[accordion]
                [accordion_item title="Frage 1"]
                    Antwort 1
                [/accordion_item]
                [accordion_item title="Frage 2"]
                    Antwort 2
                [/accordion_item]
                [/accordion]`;
            insertShortcode(shortcode);
        });
        
        // Hero Slider
        $('#insert-hero-slider').on('click', function(e) {
            e.preventDefault();
            var shortcode = `[hero_slider]
                [hero_slide image="https://picsum.photos/1920/800?random=1" title="Slide 1" subtitle="Beschreibung" button_text="Mehr" button_link="/link"]
                [/hero_slide]
                [hero_slide image="https://picsum.photos/1920/800?random=2" title="Slide 2"]
                [/hero_slide]
                [/hero_slider]`;
            insertShortcode(shortcode);
        });
        
        // Modal
        $('#insert-modal').on('click', function(e) {
            e.preventDefault();
            var shortcode = `[modal_trigger target="beispiel-modal"]Modal öffnen[/modal_trigger]
                [modal id="beispiel-modal" title="Modal Titel"]
                Ihr Modal-Inhalt hier...
                [/modal]`;
            insertShortcode(shortcode);
        });

        // Testimonials
        $('#insert-testimonials').on('click', function(e) {
            e.preventDefault();
            var shortcode = `[testimonials columns="3" style="card"]
                [testimonial name="Max Mustermann" role="CEO" company="Firma GmbH" image="https://i.pravatar.cc/150?img=1" rating="5"]
                    Hervorragende Arbeit! Das Team hat unsere Erwartungen übertroffen.
                [/testimonial]
                [testimonial name="Anna Schmidt" role="Marketing Manager" company="StartUp AG" image="https://i.pravatar.cc/150?img=5" rating="5"]
                    Professionell, schnell und kreativ. Absolut empfehlenswert!
                [/testimonial]
                [testimonial name="Peter Müller" role="Geschäftsführer" image="https://i.pravatar.cc/150?img=12" rating="5"]
                    Beste Entscheidung für unser Projekt. Vielen Dank!
                [/testimonial]
                [/testimonials]`;
            insertShortcode(shortcode);
        });

        // Tabs
        $('#insert-tabs').on('click', function(e) {
            e.preventDefault();
            var shortcode = `[tabs style="default"]
                [tab title="Tab 1" active="true"]
                    Inhalt des ersten Tabs.
                [/tab]
                [tab title="Tab 2"]
                    Inhalt des zweiten Tabs.
                [/tab]
                [tab title="Tab 3"]
                    Inhalt des dritten Tabs.
                [/tab]
                [/tabs]`;
            insertShortcode(shortcode);
        });

        // Notification
        $('#insert-notification').on('click', function(e) {
            e.preventDefault();
            var shortcode = `[notification type="info" title="Information" dismissible="true"]
                Dies ist eine Info-Benachrichtigung. Sie können hier wichtige Informationen anzeigen.
                [/notification]`;
            insertShortcode(shortcode);
        });

        // Notifications
        $('#insert-notification').on('click', function(e) {
            e.preventDefault();
            var shortcode = `[notification type="info" dismissible="true"]
                <strong>Hinweis:</strong> Dies ist eine Info-Benachrichtigung.
                [/notification]`;
            insertShortcode(shortcode);
        });

        // Stats
        $('#insert-stats').on('click', function(e) {
            e.preventDefault();
            var shortcode = `[stats columns="4" style="default"]
                [stat number="1000" suffix="+" label="Kunden"]
                    Zufriedene Kunden weltweit
                [/stat]
                [stat number="250" suffix="+" label="Projekte"]
                    Erfolgreich abgeschlossen
                [/stat]
                [stat number="15" label="Jahre"]
                    Erfahrung im Markt
                [/stat]
                [stat number="98" suffix="%" label="Zufriedenheit"]
                    Kundenzufriedenheit
                [/stat]
                [/stats]`;
            insertShortcode(shortcode);
        });




        
        function insertShortcode(shortcode) {
            if (typeof tinymce !== 'undefined' && tinymce.activeEditor) {
                tinymce.activeEditor.execCommand('mceInsertContent', false, shortcode);
            } else {
                var editor = $('#content');
                editor.val(editor.val() + shortcode);
            }
        }
    });
    </script>
    <?php
}

// ============================================
// TESTIMONIALS SHORTCODES
// ============================================

function testimonials_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'columns' => '3', // 1, 2, 3, 4
        'style' => 'card', // card, quote, minimal
        'autoplay' => 'false',
        'slider' => 'false', // Slider-Modus
    ), $atts);
    
    $columns = esc_attr($atts['columns']);
    $style = esc_attr($atts['style']);
    $is_slider = $atts['slider'] === 'true';
    
    $container_class = 'testimonials testimonials--' . $style;
    
    if ($is_slider) {
        $slider_id = 'testimonials-' . uniqid();
        $autoplay_attr = $atts['autoplay'] === 'true' ? 'data-autoplay="true"' : '';
        
        return '
        <div class="' . $container_class . ' testimonials--slider swiper" id="' . $slider_id . '" ' . $autoplay_attr . '>
            <div class="swiper-wrapper">' . do_shortcode($content) . '</div>
            <div class="testimonials__navigation">
                <button class="testimonials__button testimonials__button--prev" aria-label="Previous">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </button>
                <button class="testimonials__button testimonials__button--next" aria-label="Next">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </button>
            </div>
            <div class="testimonials__pagination"></div>
        </div>';
    } else {
        return '
        <div class="' . $container_class . '" data-columns="' . $columns . '">' . do_shortcode($content) . '</div>';
    }
}
add_shortcode('testimonials', 'testimonials_shortcode');

function testimonial_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'name' => '',
        'role' => '',
        'company' => '',
        'image' => '',
        'rating' => '', // 1-5
    ), $atts);
    
    $name = esc_html($atts['name']);
    $role = esc_html($atts['role']);
    $company = esc_html($atts['company']);
    $image = esc_url($atts['image']);
    $rating = intval($atts['rating']);
    $quote = wpautop(do_shortcode($content));
    
    // Rating Stars
    $stars_html = '';
    if ($rating > 0 && $rating <= 5) {
        $stars_html = '<div class="testimonial__rating">';
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $rating) {
                $stars_html .= '<span class="star star--filled">★</span>';
            } else {
                $stars_html .= '<span class="star star--empty">☆</span>';
            }
        }
        $stars_html .= '</div>';
    }
    
    // Image HTML
    $image_html = '';
    if ($image) {
        $image_html = '<div class="testimonial__image"><img src="' . $image . '" alt="' . $name . '"></div>';
    }
    
    // Meta (Name, Role, Company)
    $meta_html = '<div class="testimonial__meta">';
    if ($name) {
        $meta_html .= '<div class="testimonial__name">' . $name . '</div>';
    }
    if ($role || $company) {
        $meta_parts = array_filter(array($role, $company));
        $meta_html .= '<div class="testimonial__role">' . implode(' · ', $meta_parts) . '</div>';
    }
    $meta_html .= '</div>';
    
    // Check if inside slider
    $parent_is_slider = false; // This would be set by parent context
    $wrapper_class = $parent_is_slider ? 'swiper-slide' : 'testimonial';
    
    return '
    <div class="' . $wrapper_class . ' testimonial">
        ' . $stars_html . '
        <div class="testimonial__quote">' . $quote . '</div>
        <div class="testimonial__footer">
            ' . $image_html . '
            ' . $meta_html . '
        </div>
    </div>';
}
add_shortcode('testimonial', 'testimonial_shortcode');

// ============================================
// TABS SHORTCODES (IMPROVED)
// ============================================

function tabs_shortcode($atts, $content = null) {
    static $tabs_counter = 0;
    $tabs_counter++;
    
    $atts = shortcode_atts(array(
        'style' => 'default', // default, pills, underline
    ), $atts);
    
    $style = esc_attr($atts['style']);
    $unique_id = 'tabs-' . $tabs_counter;
    
    // Parse content to extract tabs
    global $tab_items;
    $tab_items = array();
    
    // Process nested shortcodes
    do_shortcode($content);
    
    if (empty($tab_items)) {
        return '';
    }
    
    // Build navigation
    $navigation = '<div class="tabs__navigation" role="tablist">';
    foreach ($tab_items as $index => $tab) {
        $is_active = $tab['active'] ? ' is-active' : '';
        $tab_id = $unique_id . '-tab-' . $index;
        $icon_html = $tab['icon'] ? '<span class="dashicons ' . esc_attr($tab['icon']) . '"></span> ' : '';
        
        $navigation .= '<button class="tabs__button' . $is_active . '" data-tab="' . $tab_id . '" role="tab" aria-selected="' . ($tab['active'] ? 'true' : 'false') . '">';
        $navigation .= $icon_html . esc_html($tab['title']);
        $navigation .= '</button>';
    }
    $navigation .= '</div>';
    
    // Build content
    $panels = '<div class="tabs__content">';
    foreach ($tab_items as $index => $tab) {
        $is_active = $tab['active'] ? ' is-active' : '';
        $tab_id = $unique_id . '-tab-' . $index;
        
        $panels .= '<div class="tabs__panel' . $is_active . '" id="' . $tab_id . '" role="tabpanel" aria-hidden="' . ($tab['active'] ? 'false' : 'true') . '">';
        $panels .= wpautop(do_shortcode($tab['content']));
        $panels .= '</div>';
    }
    $panels .= '</div>';
    
    // Reset for next tabs group
    $tab_items = array();
    
    // Return complete tabs
    return '<div class="tabs tabs--' . $style . '" data-tabs-id="' . $unique_id . '">' . $navigation . $panels . '</div>';
}
add_shortcode('tabs', 'tabs_shortcode');

function tab_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'title' => 'Tab',
        'icon' => '',
        'active' => 'false',
    ), $atts);
    
    global $tab_items;
    
    if (!isset($tab_items)) {
        $tab_items = array();
    }
    
    // Check if this is the first tab and no active tab is set
    $is_first = empty($tab_items);
    $has_active = false;
    foreach ($tab_items as $item) {
        if ($item['active']) {
            $has_active = true;
            break;
        }
    }
    
    // If no active tab and this is first, or explicitly set active
    $is_active = ($atts['active'] === 'true') || ($is_first && !$has_active);
    
    $tab_items[] = array(
        'title' => $atts['title'],
        'icon' => $atts['icon'],
        'content' => $content,
        'active' => $is_active,
    );
    
    // Return empty string (content is collected in global array)
    return '';
}
add_shortcode('tab', 'tab_shortcode');

// ============================================
// NOTIFICATION SHORTCODES
// ============================================

function notification_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'type' => 'info', // info, success, warning, error
        'title' => '',
        'dismissible' => 'true',
        'icon' => 'auto', // auto, custom dashicon, or 'none'
    ), $atts);
    
    $type = esc_attr($atts['type']);
    $title = esc_html($atts['title']);
    $dismissible = $atts['dismissible'] === 'true';
    $icon = $atts['icon'];
    
    // Auto icon based on type
    if ($icon === 'auto') {
        $icons = array(
            'info' => 'dashicons-info',
            'success' => 'dashicons-yes-alt',
            'warning' => 'dashicons-warning',
            'error' => 'dashicons-dismiss',
        );
        $icon = isset($icons[$type]) ? $icons[$type] : 'dashicons-info';
    }
    
    // Build notification
    $notification_id = 'notification-' . uniqid();
    $dismissible_class = $dismissible ? ' notification--dismissible' : '';
    
    $html = '<div class="notification notification--' . $type . $dismissible_class . '" id="' . $notification_id . '" role="alert">';
    
    // Icon
    if ($icon && $icon !== 'none') {
        $html .= '<div class="notification__icon"><span class="dashicons ' . esc_attr($icon) . '"></span></div>';
    }
    
    // Content
    $html .= '<div class="notification__content">';
    if ($title) {
        $html .= '<div class="notification__title">' . $title . '</div>';
    }
    $html .= '<div class="notification__message">' . wpautop(do_shortcode($content)) . '</div>';
    $html .= '</div>';
    
    // Dismiss button
    if ($dismissible) {
        $html .= '<button class="notification__dismiss" data-dismiss="' . $notification_id . '" aria-label="Schließen">&times;</button>';
    }
    
    $html .= '</div>';
    
    return $html;
}
add_shortcode('notification', 'notification_shortcode');

// Inline Notification (kleiner, für Formulare etc.)
function notification_inline_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'type' => 'info',
        'icon' => 'auto',
    ), $atts);
    
    $type = esc_attr($atts['type']);
    $icon = $atts['icon'];
    
    // Auto icon
    if ($icon === 'auto') {
        $icons = array(
            'info' => 'dashicons-info',
            'success' => 'dashicons-yes-alt',
            'warning' => 'dashicons-warning',
            'error' => 'dashicons-dismiss',
        );
        $icon = isset($icons[$type]) ? $icons[$type] : 'dashicons-info';
    }
    
    $html = '<div class="notification notification--inline notification--' . $type . '" role="alert">';
    
    if ($icon && $icon !== 'none') {
        $html .= '<span class="dashicons ' . esc_attr($icon) . '"></span> ';
    }
    
    $html .= '<span>' . esc_html($content) . '</span>';
    $html .= '</div>';
    
    return $html;
}
add_shortcode('notification_inline', 'notification_inline_shortcode');

// ============================================
// NOTIFICATION SHORTCODE
// ============================================

function notifications_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'type' => 'info', // success, error, warning, info
        'dismissible' => 'true',
        'icon' => 'auto', // auto, custom dashicon, or 'none'
    ), $atts);
    
    $type = esc_attr($atts['type']);
    $dismissible = $atts['dismissible'] === 'true';
    $icon = $atts['icon'];
    
    // Auto icon based on type
    if ($icon === 'auto') {
        $icons = array(
            'success' => 'dashicons-yes-alt',
            'error' => 'dashicons-dismiss',
            'warning' => 'dashicons-warning',
            'info' => 'dashicons-info',
        );
        $icon = isset($icons[$type]) ? $icons[$type] : 'dashicons-info';
    }
    
    $icon_html = '';
    if ($icon !== 'none') {
        $icon_html = '<span class="notification__icon dashicons ' . esc_attr($icon) . '"></span>';
    }
    
    $dismiss_html = '';
    if ($dismissible) {
        $dismiss_html = '<button class="notification__close" aria-label="Schließen">&times;</button>';
    }
    
    return '
    <div class="notification notification--' . $type . '" role="alert">
        ' . $icon_html . '
        <div class="notification__content">' . wpautop(do_shortcode($content)) . '</div>
        ' . $dismiss_html . '
    </div>';
}
add_shortcode('notifications', 'notifications_shortcode');

// ============================================
// STATS/COUNTER SHORTCODES
// ============================================

function stats_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'columns' => '4', // 2, 3, 4
        'style' => 'default', // default, minimal, card
    ), $atts);
    
    $columns = esc_attr($atts['columns']);
    $style = esc_attr($atts['style']);
    
    return '<div class="stats stats--' . $style . '" data-columns="' . $columns . '">' . do_shortcode($content) . '</div>';
}
add_shortcode('stats', 'stats_shortcode');

function stat_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'number' => '0',
        'prefix' => '',
        'suffix' => '',
        'duration' => '2000', // Animation duration in ms
        'label' => '',
        'icon' => '', // dashicon class
        'color' => '', // primary, success, error, warning, info
    ), $atts);
    
    $number = esc_attr($atts['number']);
    $prefix = esc_html($atts['prefix']);
    $suffix = esc_html($atts['suffix']);
    $duration = esc_attr($atts['duration']);
    $label = esc_html($atts['label']);
    $icon = esc_attr($atts['icon']);
    $color = $atts['color'] ? ' stat--' . esc_attr($atts['color']) : '';
    
    // Icon HTML
    $icon_html = '';
    if ($icon) {
        $icon_html = '<div class="stat__icon"><span class="dashicons ' . $icon . '"></span></div>';
    }
    
    // Description from content
    $description = '';
    if ($content) {
        $description = '<p class="stat__description">' . wp_kses_post($content) . '</p>';
    }
    
    return '
    <div class="stat' . $color . '" data-counter>
        ' . $icon_html . '
        <div class="stat__content">
            <div class="stat__number">
                <span class="stat__prefix">' . $prefix . '</span>
                <span class="stat__value" data-target="' . $number . '" data-duration="' . $duration . '">0</span>
                <span class="stat__suffix">' . $suffix . '</span>
            </div>
            ' . ($label ? '<div class="stat__label">' . $label . '</div>' : '') . '
            ' . $description . '
        </div>
    </div>';
}
add_shortcode('stat', 'stat_shortcode');