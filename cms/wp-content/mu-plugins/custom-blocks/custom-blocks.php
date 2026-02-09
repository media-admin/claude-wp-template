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
        'autoplay' => 'false',
        'delay' => '5000',
        'loop' => 'true',
    ), $atts);
    
    $autoplay = esc_attr($atts['autoplay']);
    $delay = esc_attr($atts['delay']);
    $loop = esc_attr($atts['loop']);
    
    $output = '<div class="hero-slider swiper" data-autoplay="' . $autoplay . '" data-delay="' . $delay . '" data-loop="' . $loop . '" style="position:relative;width:100%;max-width:100%;height:600px;overflow:hidden;">';
    $output .= '<div class="swiper-wrapper">';
    $output .= do_shortcode($content);
    $output .= '</div>';
    
    // Navigation mit inline styles
    $output .= '<div class="swiper-button-prev" style="position:absolute;top:50%;left:1rem;transform:translateY(-50%);width:50px;height:50px;background:rgba(255,255,255,0.3);border-radius:50%;z-index:10;cursor:pointer;"></div>';
    $output .= '<div class="swiper-button-next" style="position:absolute;top:50%;right:1rem;transform:translateY(-50%);width:50px;height:50px;background:rgba(255,255,255,0.3);border-radius:50%;z-index:10;cursor:pointer;"></div>';
    
    // Pagination mit inline styles
    $output .= '<div class="swiper-pagination" style="position:absolute;bottom:1rem;left:50%;transform:translateX(-50%);z-index:10;"></div>';
    
    $output .= '</div>';
    
    return $output;
}
add_shortcode('hero_slider', 'hero_slider_shortcode');

function hero_slide_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'image' => '',
        'image_mobile' => '',
        'title' => '',
        'subtitle' => '',
        'button_text' => '',
        'button_link' => '',
        'button_target' => '_self',
        'text_align' => 'center',
        'text_color' => 'white',
        'overlay' => 'true',
        'overlay_opacity' => '0.4',
    ), $atts);
    
    $image = esc_url($atts['image']);
    $image_mobile = !empty($atts['image_mobile']) ? esc_url($atts['image_mobile']) : $image;
    $title = esc_html($atts['title']);
    $subtitle = esc_html($atts['subtitle']);
    $button_text = esc_html($atts['button_text']);
    $button_link = esc_url($atts['button_link']);
    $button_target = esc_attr($atts['button_target']);
    $text_color = esc_attr($atts['text_color']);
    $show_overlay = $atts['overlay'] === 'true';
    $overlay_opacity = floatval($atts['overlay_opacity']);
    
    $output = '<div class="hero-slide swiper-slide" style="position:relative;width:100%;height:100%;">';
    
    // Background mit inline styles
    $output .= '<div class="hero-slide__background" style="position:absolute;top:0;left:0;width:100%;height:100%;z-index:0;">';
    if ($image) {
        $output .= '<picture>';
        $output .= '<source media="(min-width: 768px)" srcset="' . $image . '">';
        $output .= '<source media="(max-width: 767px)" srcset="' . $image_mobile . '">';
        $output .= '<img src="' . $image . '" alt="' . $title . '" class="hero-slide__image" style="position:absolute;top:0;left:0;width:100%;height:100%;object-fit:cover;">';
        $output .= '</picture>';
    }
    if ($show_overlay) {
        $output .= '<div class="hero-slide__overlay" style="position:absolute;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,' . $overlay_opacity . ');z-index:1;"></div>';
    }
    $output .= '</div>';
    
    // Content mit inline styles
    $output .= '<div class="hero-slide__content" style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:90%;max-width:800px;z-index:2;padding:2rem;text-align:center!important;">';
    $output .= '<div class="hero-slide__inner" style="width:100%;text-align:center!important;color:white!important;">';

    if ($subtitle) {
        $output .= '<div class="hero-slide__subtitle" style="color:white!important;font-size:1rem;margin:0 auto 0.75rem auto;text-transform:uppercase;letter-spacing:0.1em;font-weight:600;text-align:center!important;width:100%;">' . $subtitle . '</div>';
    }

    if ($title) {
        $output .= '<h2 class="hero-slide__title" style="color:white!important;font-size:2.5rem;font-weight:700;margin:0 auto 1rem auto;line-height:1.2;text-shadow:0 2px 4px rgba(0,0,0,0.5);text-align:center!important;width:100%;">' . $title . '</h2>';
    }

    if ($content) {
        $output .= '<div class="hero-slide__text" style="color:white!important;font-size:1rem;margin:0 auto 1.5rem auto;line-height:1.6;text-align:center!important;width:100%;">' . wpautop(do_shortcode($content)) . '</div>';
    }

    if ($button_text && $button_link) {
        $output .= '<div style="text-align:center!important;width:100%;"><a href="' . $button_link . '" target="' . $button_target . '" class="hero-slide__button" style="display:inline-block;padding:0.75rem 1.5rem;background:#667eea;color:white!important;text-decoration:none;border-radius:0.5rem;font-weight:600;">' . $button_text . '</a></div>';
    }

    $output .= '</div></div>'; // inner + content

    $output .= '</div>'; // slide
    
    return $output;
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

    echo '<button type="button" class="button" id="insert-timeline" style="margin-left: 5px;">
        <span class="dashicons dashicons-backup" style="margin-top: 3px;"></span> Timeline
    </button>';

    echo '<button type="button" class="button" id="insert-image-comparison" style="margin-left: 5px;">
        <span class="dashicons dashicons-image-flip-horizontal" style="margin-top: 3px;"></span> Image Comparison
    </button>';

    echo '<button type="button" class="button" id="insert-logo-carousel" style="margin-left: 5px;">
        <span class="dashicons dashicons-images-alt" style="margin-top: 3px;"></span> Logo Carousel
    </button>';

    echo '<button type="button" class="button" id="insert-team-cards" style="margin-left: 5px;">
        <span class="dashicons dashicons-groups" style="margin-top: 3px;"></span> Team Cards
    </button>';

    echo '<button type="button" class="button" id="insert-video-player" style="margin-left: 5px;">
        <span class="dashicons dashicons-video-alt3" style="margin-top: 3px;"></span> Video Player
    </button>';

    echo '<button type="button" class="button" id="insert-faq" style="margin-left: 5px;">
        <span class="dashicons dashicons-editor-help" style="margin-top: 3px;"></span> FAQ
    </button>';

    echo '<button type="button" class="button" id="insert-cpt-query" style="margin-left: 5px;">
        <span class="dashicons dashicons-database" style="margin-top: 3px;"></span> CPT Query
    </button>';

    echo '<button type="button" class="button" id="insert-spoiler" style="margin-left: 5px;">
        <span class="dashicons dashicons-hidden" style="margin-top: 3px;"></span> Spoiler
    </button>';

    echo '<button type="button" class="button" id="insert-pricing" style="margin-left: 5px;">
        <span class="dashicons dashicons-tag" style="margin-top: 3px;"></span> Pricing
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
            var shortcode = '[hero_slider autoplay="true" loop="true"]\n' +
                '[hero_slide image="https://picsum.photos/1920/800?random=1" image_mobile="https://picsum.photos/800/1200?random=1" title="Willkommen" subtitle="Ihr Partner für digitale Lösungen" button_text="Mehr erfahren" button_link="#" text_align="left" text_color="white"]\n' +
                'Entdecken Sie unsere innovativen Dienstleistungen.\n' +
                '[/hero_slide]\n' +
                '[hero_slide image="https://picsum.photos/1920/800?random=2" image_mobile="https://picsum.photos/800/1200?random=2" title="Unsere Services" subtitle="Professionell & Zuverlässig" button_text="Services ansehen" button_link="#" text_align="center"]\n' +
                'Von Webdesign bis App-Entwicklung.\n' +
                '[/hero_slide]\n' +
                '[/hero_slider]';
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

        // Timeline
        $('#insert-timeline').on('click', function(e) {
            e.preventDefault();
            var shortcode = `[timeline style="alternate"]
                [timeline_item date="2020" title="Gründung" icon="dashicons-star-filled" color="primary"]
                    Unser Unternehmen wurde mit der Vision gegründet, innovative Lösungen zu schaffen.
                [/timeline_item]
                [timeline_item date="2021" title="Erstes Produkt" icon="dashicons-products" color="success"]
                    Launch unseres ersten erfolgreichen Produkts mit über 1000 Kunden.
                [/timeline_item]
                [timeline_item date="2022" title="Expansion" icon="dashicons-admin-site-alt3" color="info"]
                    Eröffnung von Niederlassungen in 3 weiteren Ländern.
                [/timeline_item]
                [timeline_item date="2023" title="Auszeichnung" icon="dashicons-awards" color="warning"]
                    Gewinner des Innovation Awards für beste Technologie.
                [/timeline_item]
                [/timeline]`;
            insertShortcode(shortcode);
        });

        // Image Comparison
        $('#insert-image-comparison').on('click', function(e) {
            e.preventDefault();
            var shortcode = '[image_comparison before="https://picsum.photos/1200/675?random=1" after="https://picsum.photos/1200/675?random=2" before_label="Vorher" after_label="Nachher" position="50"]';
            insertShortcode(shortcode);
        });

        // Logo Carousel
        $('#insert-logo-carousel').on('click', function(e) {
            e.preventDefault();
            var shortcode = '[logo_carousel autoplay="true" speed="3000" grayscale="true"]\n' +
                '[logo_item image="https://via.placeholder.com/200x80/667eea/ffffff?text=Logo+1" alt="Partner 1" link="https://example.com"]\n' +
                '[logo_item image="https://via.placeholder.com/200x80/764ba2/ffffff?text=Logo+2" alt="Partner 2" link="https://example.com"]\n' +
                '[logo_item image="https://via.placeholder.com/200x80/f093fb/ffffff?text=Logo+3" alt="Partner 3" link="https://example.com"]\n' +
                '[logo_item image="https://via.placeholder.com/200x80/4facfe/ffffff?text=Logo+4" alt="Partner 4" link="https://example.com"]\n' +
                '[logo_item image="https://via.placeholder.com/200x80/00f2fe/ffffff?text=Logo+5" alt="Partner 5" link="https://example.com"]\n' +
                '[logo_item image="https://via.placeholder.com/200x80/43e97b/ffffff?text=Logo+6" alt="Partner 6" link="https://example.com"]\n' +
                '[/logo_carousel]';
            insertShortcode(shortcode);
        });

        // Team Cards
        $('#insert-team-cards').on('click', function(e) {
            e.preventDefault();
            var shortcode = '[team_cards columns="3" style="default"]\n' +
                '[team_member name="Max Mustermann" role="CEO & Gründer" image="https://i.pravatar.cc/400?img=12" email="max@example.com" linkedin="https://linkedin.com"]\n' +
                'Mit über 15 Jahren Erfahrung in der Tech-Branche führt Max unser Unternehmen in eine innovative Zukunft.\n' +
                '[/team_member]\n' +
                '[team_member name="Anna Schmidt" role="CTO" image="https://i.pravatar.cc/400?img=5" email="anna@example.com" linkedin="https://linkedin.com"]\n' +
                'Anna ist verantwortlich für unsere technische Strategie und leitet unser Entwicklerteam.\n' +
                '[/team_member]\n' +
                '[team_member name="Peter Müller" role="Head of Design" image="https://i.pravatar.cc/400?img=15" email="peter@example.com" twitter="https://twitter.com"]\n' +
                'Peter bringt kreative Visionen zum Leben und sorgt für außergewöhnliche User Experience.\n' +
                '[/team_member]\n' +
                '[/team_cards]';
            insertShortcode(shortcode);
        });

        // Video Player
        $('#insert-video-player').on('click', function(e) {
            e.preventDefault();
            var shortcode = '[video_player url="https://www.youtube.com/watch?v=dQw4w9WgXcQ" type="youtube" title="Video Titel" poster="https://picsum.photos/1280/720?random=1"]\n' +
                'Optional: Beschreibungstext zum Video.\n' +
                '[/video_player]';
            insertShortcode(shortcode);
        });

        // FAQ Accordion
        $('#insert-faq').on('click', function(e) {
            e.preventDefault();
            var shortcode = '[faq_accordion style="default" schema="true"]\n' +
                '[faq_item question="Wie kann ich bestellen?" open="true"]\n' +
                'Sie können ganz einfach über unseren Online-Shop bestellen. Wählen Sie Ihre Produkte aus und folgen Sie dem Checkout-Prozess.\n' +
                '[/faq_item]\n' +
                '[faq_item question="Welche Zahlungsmethoden akzeptieren Sie?"]\n' +
                'Wir akzeptieren Kreditkarten, PayPal, Sofortüberweisung und Rechnung.\n' +
                '[/faq_item]\n' +
                '[faq_item question="Wie lange dauert der Versand?"]\n' +
                'Standard-Versand dauert 3-5 Werktage. Express-Versand ist innerhalb von 1-2 Werktagen möglich.\n' +
                '[/faq_item]\n' +
                '[faq_item question="Kann ich meine Bestellung zurückgeben?"]\n' +
                'Ja, Sie haben ein 30-tägiges Rückgaberecht ab Erhalt der Ware.\n' +
                '[/faq_item]\n' +
                '[/faq_accordion]';
            insertShortcode(shortcode);
        });

        // CPT Query
        $('#insert-cpt-query').on('click', function(e) {
            e.preventDefault();
            var shortcode = '<!-- Team -->\n' +
                '[team_query number="3" columns="3" style="default"]\n\n' +
                '<!-- Projects -->\n' +
                '[projects_query number="6" columns="3"]\n\n' +
                '<!-- Testimonials -->\n' +
                '[testimonials_query number="3" columns="3" style="card"]\n\n' +
                '<!-- Services -->\n' +
                '[services_query number="-1" columns="3"]';
            insertShortcode(shortcode);
        });

        // Spoiler / Read-More
        $('#insert-spoiler').on('click', function(e) {
            e.preventDefault();
            var shortcode = '[spoiler open_text="Mehr anzeigen" close_text="Weniger anzeigen"]\n' +
                'Dieser Inhalt ist standardmäßig versteckt und wird erst angezeigt, wenn der Benutzer auf den Button klickt.\n\n' +
                'Sie können hier beliebig viel Text, Bilder, Listen und andere Inhalte einfügen.\n' +
                '[/spoiler]';
            insertShortcode(shortcode);
        });

        // Pricing Tables
        $('#insert-pricing').on('click', function(e) {
            e.preventDefault();
            var shortcode = '[pricing_tables columns="3"]\n' +
                '[pricing_table title="Starter" price="29" period="pro Monat" button_text="Jetzt starten" button_link="#"]\n' +
                '[pricing_feature icon="check"]5 Projekte[/pricing_feature]\n' +
                '[pricing_feature icon="check"]10 GB Speicher[/pricing_feature]\n' +
                '[pricing_feature icon="check"]E-Mail Support[/pricing_feature]\n' +
                '[pricing_feature icon="cross"]Telefon Support[/pricing_feature]\n' +
                '[/pricing_table]\n\n' +
                '[pricing_table title="Professional" price="79" period="pro Monat" featured="true" badge="Beliebt" button_text="Jetzt starten" button_link="#"]\n' +
                '[pricing_feature icon="check"]Unbegrenzte Projekte[/pricing_feature]\n' +
                '[pricing_feature icon="check"]100 GB Speicher[/pricing_feature]\n' +
                '[pricing_feature icon="check"]E-Mail Support[/pricing_feature]\n' +
                '[pricing_feature icon="check"]Telefon Support[/pricing_feature]\n' +
                '[pricing_feature icon="check"]Priorität Support[/pricing_feature]\n' +
                '[/pricing_table]\n\n' +
                '[pricing_table title="Enterprise" price="199" period="pro Monat" button_text="Kontakt" button_link="/kontakt"]\n' +
                '[pricing_feature icon="check"]Alles aus Professional[/pricing_feature]\n' +
                '[pricing_feature icon="check"]Unbegrenzter Speicher[/pricing_feature]\n' +
                '[pricing_feature icon="check"]24/7 Support[/pricing_feature]\n' +
                '[pricing_feature icon="check"]Dedizierter Account Manager[/pricing_feature]\n' +
                '[pricing_feature icon="check"]Custom Integrationen[/pricing_feature]\n' +
                '[/pricing_table]\n' +
                '[/pricing_tables]';
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

/**
 * Stats Container (umschließt mehrere stat Items)
 */
function stats_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'columns' => '4',
        'style' => 'default',
    ), $atts);
    
    $columns = intval($atts['columns']);
    $style = esc_attr($atts['style']);
    
    // INLINE STYLES
    $inline_style = 'display:grid!important;gap:2rem!important;margin:2rem 0!important;width:100%!important;';
    
    if ($columns == 2) {
        $inline_style .= 'grid-template-columns:repeat(2,1fr)!important;';
    } elseif ($columns == 3) {
        $inline_style .= 'grid-template-columns:repeat(3,1fr)!important;';
    } elseif ($columns == 4) {
        $inline_style .= 'grid-template-columns:repeat(4,1fr)!important;';
    } else {
        $inline_style .= 'grid-template-columns:repeat(' . $columns . ',1fr)!important;';
    }
    
    return '<div class="stats stats--' . $style . '" data-columns="' . $columns . '" style="' . $inline_style . '">' . do_shortcode($content) . '</div>';
}
add_shortcode('stats', 'stats_shortcode'); // ← Container Shortcode

/**
 * Single Stat Item
 */
function stat_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'number' => '0',
        'prefix' => '',
        'suffix' => '',
        'duration' => '2000',
        'label' => '',
        'icon' => '',
        'color' => '',
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
add_shortcode('stat', 'stat_shortcode'); // ← Einzelnes Stat Item


// ============================================
// TIMELINE SHORTCODES
// ============================================

function timeline_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'style' => 'default', // default, alternate, centered
    ), $atts);
    
    $style = esc_attr($atts['style']);
    
    return '<div class="timeline timeline--' . $style . '">' . do_shortcode($content) . '</div>';
}
add_shortcode('timeline', 'timeline_shortcode');

function timeline_item_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'date' => '',
        'title' => '',
        'icon' => '', // dashicon class
        'color' => '', // primary, success, error, warning, info
        'image' => '', // optional image URL
    ), $atts);
    
    $date = esc_html($atts['date']);
    $title = esc_html($atts['title']);
    $icon = esc_attr($atts['icon']);
    $color = $atts['color'] ? ' timeline-item--' . esc_attr($atts['color']) : '';
    $image = esc_url($atts['image']);
    
    // Icon HTML
    $icon_html = '';
    if ($icon) {
        $icon_html = '<span class="dashicons ' . $icon . '"></span>';
    } elseif (!$image) {
        // Default icon if none provided
        $icon_html = '<span class="dashicons dashicons-marker"></span>';
    }
    
    // Image HTML
    $image_html = '';
    if ($image) {
        $image_html = '<div class="timeline-item__image"><img src="' . $image . '" alt="' . $title . '"></div>';
    }
    
    return '
    <div class="timeline-item' . $color . '" data-animate="fade-in-up">
        <div class="timeline-item__marker">' . $icon_html . '</div>
        <div class="timeline-item__content">
            ' . ($date ? '<div class="timeline-item__date">' . $date . '</div>' : '') . '
            ' . ($title ? '<h3 class="timeline-item__title">' . $title . '</h3>' : '') . '
            ' . $image_html . '
            <div class="timeline-item__description">' . wpautop(do_shortcode($content)) . '</div>
        </div>
    </div>';
}
add_shortcode('timeline_item', 'timeline_item_shortcode');

// ============================================
// IMAGE COMPARISON SHORTCODE (CLEAN VERSION)
// ============================================

function image_comparison_shortcode($atts) {
    static $comparison_id = 0;
    $comparison_id++;
    
    $atts = shortcode_atts(array(
        'before' => '',
        'after' => '',
        'before_label' => 'Vorher',
        'after_label' => 'Nachher',
        'position' => '50',
        'orientation' => 'horizontal',
    ), $atts);
    
    $before = esc_url($atts['before']);
    $after = esc_url($atts['after']);
    
    if (empty($before) || empty($after)) {
        return '<p><strong>Fehler:</strong> Bitte geben Sie sowohl ein "before" als auch ein "after" Bild an.</p>';
    }
    
    $before_label = esc_html($atts['before_label']);
    $after_label = esc_html($atts['after_label']);
    $position = intval($atts['position']);
    $orientation = esc_attr($atts['orientation']);
    $unique_id = 'comparison-' . $comparison_id;
    
    ob_start();
    ?>
    <div class="image-comparison image-comparison--<?php echo $orientation; ?>" id="<?php echo $unique_id; ?>" data-position="<?php echo $position; ?>">
        <div class="image-comparison__wrapper">
            <div class="image-comparison__before">
                <img src="<?php echo $before; ?>" alt="<?php echo $before_label; ?>">
                <span class="image-comparison__label image-comparison__label--before"><?php echo $before_label; ?></span>
            </div>
            <div class="image-comparison__after">
                <img src="<?php echo $after; ?>" alt="<?php echo $after_label; ?>">
                <span class="image-comparison__label image-comparison__label--after"><?php echo $after_label; ?></span>
            </div>
            <div class="image-comparison__slider">
                <div class="image-comparison__handle">
                    <span class="image-comparison__arrow image-comparison__arrow--left">◀</span>
                    <span class="image-comparison__divider"></span>
                    <span class="image-comparison__arrow image-comparison__arrow--right">▶</span>
                </div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('image_comparison', 'image_comparison_shortcode');

// ============================================
// LOGO CAROUSEL SHORTCODE
// ============================================

function logo_carousel_shortcode($atts, $content = null) {
    static $carousel_id = 0;
    $carousel_id++;
    
    $atts = shortcode_atts(array(
        'autoplay' => 'true',
        'speed' => '3000',
        'loop' => 'true',
        'slides_per_view' => 'auto', // auto, 3, 4, 5, 6
        'grayscale' => 'true', // Logos grau, farbig bei hover
        'style' => 'default', // default, card
    ), $atts);
    
    $autoplay = esc_attr($atts['autoplay']);
    $speed = esc_attr($atts['speed']);
    $loop = esc_attr($atts['loop']);
    $slides_per_view = esc_attr($atts['slides_per_view']);
    $grayscale = esc_attr($atts['grayscale']);
    $style = esc_attr($atts['style']);
    $unique_id = 'logo-carousel-' . $carousel_id;
    
    ob_start();
    ?>
    <div class="logo-carousel logo-carousel--<?php echo $style; ?> swiper" 
         id="<?php echo $unique_id; ?>" 
         data-autoplay="<?php echo $autoplay; ?>" 
         data-speed="<?php echo $speed; ?>"
         data-loop="<?php echo $loop; ?>"
         data-slides="<?php echo $slides_per_view; ?>"
         data-grayscale="<?php echo $grayscale; ?>">
        <div class="swiper-wrapper">
            <?php echo do_shortcode($content); ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('logo_carousel', 'logo_carousel_shortcode');

function logo_item_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'image' => '',
        'alt' => '',
        'link' => '',
        'target' => '_blank',
    ), $atts);
    
    $image = esc_url($atts['image']);
    $alt = esc_attr($atts['alt']);
    $link = esc_url($atts['link']);
    $target = esc_attr($atts['target']);
    
    if (empty($image)) {
        return '';
    }
    
    ob_start();
    ?>
    <div class="swiper-slide logo-carousel__item">
        <?php if ($link) : ?>
            <a href="<?php echo $link; ?>" target="<?php echo $target; ?>" rel="noopener noreferrer" class="logo-carousel__link">
                <img src="<?php echo $image; ?>" alt="<?php echo $alt; ?>" class="logo-carousel__image">
            </a>
        <?php else : ?>
            <div class="logo-carousel__link">
                <img src="<?php echo $image; ?>" alt="<?php echo $alt; ?>" class="logo-carousel__image">
            </div>
        <?php endif; ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('logo_item', 'logo_item_shortcode');

// ============================================
// TEAM CARDS SHORTCODE
// ============================================

function team_cards_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'columns' => '3',
        'style' => 'default',
    ), $atts);
    
    $columns = intval($atts['columns']);
    $style = esc_attr($atts['style']);
    
    // INLINE STYLES
    $inline_style = 'display:grid!important;gap:2rem!important;margin:2rem 0!important;width:100%!important;';
    
    if ($columns == 2) {
        $inline_style .= 'grid-template-columns:repeat(2,1fr)!important;';
    } elseif ($columns == 3) {
        $inline_style .= 'grid-template-columns:repeat(3,1fr)!important;';
    } elseif ($columns == 4) {
        $inline_style .= 'grid-template-columns:repeat(4,1fr)!important;';
    } else {
        $inline_style .= 'grid-template-columns:repeat(' . $columns . ',1fr)!important;';
    }
    
    ob_start();
    ?>
    <div class="team-cards team-cards--<?php echo $style; ?>" 
         data-columns="<?php echo $columns; ?>" 
         style="<?php echo $inline_style; ?>">
        <?php echo do_shortcode($content); ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('team_cards', 'team_cards_shortcode');

function team_member_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'name' => '',
        'role' => '',
        'image' => '',
        'email' => '',
        'phone' => '',
        'linkedin' => '',
        'twitter' => '',
        'facebook' => '',
        'instagram' => '',
    ), $atts);
    
    $name = esc_html($atts['name']);
    $role = esc_html($atts['role']);
    $image = esc_url($atts['image']);
    $email = esc_attr($atts['email']);
    $phone = esc_attr($atts['phone']);
    $linkedin = esc_url($atts['linkedin']);
    $twitter = esc_url($atts['twitter']);
    $facebook = esc_url($atts['facebook']);
    $instagram = esc_url($atts['instagram']);
    $bio = wpautop(do_shortcode($content));
    
    // Social Links
    $social_html = '';
    if ($linkedin || $twitter || $facebook || $instagram || $email) {
        $social_html .= '<div class="team-member__social">';
        
        if ($email) {
            $social_html .= '<a href="mailto:' . $email . '" class="team-member__social-link" aria-label="Email"><span class="dashicons dashicons-email"></span></a>';
        }
        if ($linkedin) {
            $social_html .= '<a href="' . $linkedin . '" target="_blank" rel="noopener noreferrer" class="team-member__social-link" aria-label="LinkedIn"><span class="dashicons dashicons-linkedin"></span></a>';
        }
        if ($twitter) {
            $social_html .= '<a href="' . $twitter . '" target="_blank" rel="noopener noreferrer" class="team-member__social-link" aria-label="Twitter"><span class="dashicons dashicons-twitter"></span></a>';
        }
        if ($facebook) {
            $social_html .= '<a href="' . $facebook . '" target="_blank" rel="noopener noreferrer" class="team-member__social-link" aria-label="Facebook"><span class="dashicons dashicons-facebook"></span></a>';
        }
        if ($instagram) {
            $social_html .= '<a href="' . $instagram . '" target="_blank" rel="noopener noreferrer" class="team-member__social-link" aria-label="Instagram"><span class="dashicons dashicons-instagram"></span></a>';
        }
        
        $social_html .= '</div>';
    }
    
    // Phone
    $phone_html = '';
    if ($phone) {
        $phone_html = '<div class="team-member__phone"><span class="dashicons dashicons-phone"></span> ' . esc_html($phone) . '</div>';
    }
    
    ob_start();
    ?>
    <div class="team-member" data-animate="fade-in-up">
        <?php if ($image) : ?>
            <div class="team-member__image-wrapper">
                <img src="<?php echo $image; ?>" alt="<?php echo $name; ?>" class="team-member__image">
                <?php if ($social_html) : ?>
                    <div class="team-member__overlay">
                        <?php echo $social_html; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        
        <div class="team-member__content">
            <?php if ($name) : ?>
                <h3 class="team-member__name"><?php echo $name; ?></h3>
            <?php endif; ?>
            
            <?php if ($role) : ?>
                <div class="team-member__role"><?php echo $role; ?></div>
            <?php endif; ?>
            
            <?php if ($bio) : ?>
                <div class="team-member__bio"><?php echo $bio; ?></div>
            <?php endif; ?>
            
            <?php echo $phone_html; ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('team_member', 'team_member_shortcode');

// ============================================
// VIDEO PLAYER SHORTCODE
// ============================================

function video_player_shortcode($atts, $content = null) {
    static $player_id = 0;
    $player_id++;
    
    $atts = shortcode_atts(array(
        'url' => '',
        'type' => 'youtube', // youtube, vimeo, self-hosted
        'poster' => '', // Thumbnail image
        'title' => '',
        'autoplay' => 'false',
        'controls' => 'true',
        'muted' => 'false',
        'loop' => 'false',
        'aspect_ratio' => '16:9', // 16:9, 4:3, 1:1, 21:9
    ), $atts);
    
    $url = esc_url($atts['url']);
    $type = esc_attr($atts['type']);
    $poster = esc_url($atts['poster']);
    $title = esc_html($atts['title']);
    $autoplay = $atts['autoplay'] === 'true' ? '1' : '0';
    $controls = $atts['controls'] === 'true' ? '1' : '0';
    $muted = $atts['muted'] === 'true' ? '1' : '0';
    $loop = $atts['loop'] === 'true' ? '1' : '0';
    $aspect_ratio = esc_attr($atts['aspect_ratio']);
    $unique_id = 'video-player-' . $player_id;
    
    if (empty($url)) {
        return '<p><strong>Fehler:</strong> Bitte geben Sie eine Video-URL an.</p>';
    }
    
    // Parse video ID for YouTube/Vimeo
    $video_id = '';
    $embed_url = '';
    
    if ($type === 'youtube') {
        // Extract YouTube ID
        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $url, $matches);
        $video_id = isset($matches[1]) ? $matches[1] : '';
        
        if ($video_id) {
            $embed_url = 'https://www.youtube.com/embed/' . $video_id . '?autoplay=' . $autoplay . '&controls=' . $controls . '&mute=' . $muted . '&loop=' . $loop;
            if ($loop === '1') {
                $embed_url .= '&playlist=' . $video_id;
            }
        }
    } elseif ($type === 'vimeo') {
        // Extract Vimeo ID
        preg_match('/vimeo\.com\/([0-9]+)/i', $url, $matches);
        $video_id = isset($matches[1]) ? $matches[1] : '';
        
        if ($video_id) {
            $embed_url = 'https://player.vimeo.com/video/' . $video_id . '?autoplay=' . $autoplay . '&controls=' . $controls . '&muted=' . $muted . '&loop=' . $loop;
        }
    }
    
    // Aspect ratio class
    $ratio_class = '';
    switch ($aspect_ratio) {
        case '4:3':
            $ratio_class = 'video-player--4-3';
            break;
        case '1:1':
            $ratio_class = 'video-player--1-1';
            break;
        case '21:9':
            $ratio_class = 'video-player--21-9';
            break;
        default:
            $ratio_class = 'video-player--16-9';
    }
    
    ob_start();
    ?>
    <div class="video-player <?php echo $ratio_class; ?>" id="<?php echo $unique_id; ?>" data-type="<?php echo $type; ?>">
        <?php if ($title) : ?>
            <div class="video-player__header">
                <h3 class="video-player__title"><?php echo $title; ?></h3>
            </div>
        <?php endif; ?>
        
        <div class="video-player__wrapper">
            <?php if ($type === 'self-hosted') : ?>
                <!-- Self-hosted HTML5 Video -->
                <video class="video-player__video" 
                       <?php echo $controls === '1' ? 'controls' : ''; ?>
                       <?php echo $autoplay === '1' ? 'autoplay' : ''; ?>
                       <?php echo $muted === '1' ? 'muted' : ''; ?>
                       <?php echo $loop === '1' ? 'loop' : ''; ?>
                       <?php echo $poster ? 'poster="' . $poster . '"' : ''; ?>
                       playsinline>
                    <source src="<?php echo $url; ?>" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            <?php elseif ($embed_url) : ?>
                <!-- YouTube/Vimeo Embed -->
                <?php if ($poster && $autoplay === '0') : ?>
                    <!-- Custom Thumbnail with Play Button -->
                    <div class="video-player__thumbnail" data-video-url="<?php echo esc_attr($embed_url); ?>">
                        <img src="<?php echo $poster; ?>" alt="<?php echo $title; ?>" class="video-player__poster">
                        <button class="video-player__play-button" aria-label="Play video">
                            <svg width="80" height="80" viewBox="0 0 80 80" fill="none">
                                <circle cx="40" cy="40" r="40" fill="rgba(255,255,255,0.9)"/>
                                <path d="M32 25L55 40L32 55V25Z" fill="#667eea"/>
                            </svg>
                        </button>
                    </div>
                <?php else : ?>
                    <!-- Direct Embed -->
                    <iframe class="video-player__iframe"
                            src="<?php echo $embed_url; ?>"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                    </iframe>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        
        <?php if ($content) : ?>
            <div class="video-player__description">
                <?php echo wpautop(do_shortcode($content)); ?>
            </div>
        <?php endif; ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('video_player', 'video_player_shortcode');

// ============================================
// FAQ ACCORDION SHORTCODES
// ============================================

/**
 * FAQ Accordion Shortcode
 * 
 * Usage: [faq_accordion category="general" limit="10"]
 */
function faq_accordion_shortcode($atts) {
    $atts = shortcode_atts(array(
        'category' => '',
        'limit' => '-1',
        'style' => 'default',
    ), $atts);
    
    $args = array(
        'post_type' => 'faq',
        'posts_per_page' => intval($atts['limit']),
        'orderby' => 'meta_value_num',
        'meta_key' => 'display_order',
        'order' => 'ASC',
        'post_status' => 'publish',
    );
    
    if (!empty($atts['category'])) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'faq_category',
                'field' => 'slug',
                'terms' => $atts['category'],
            ),
        );
    }
    
    $faqs = new WP_Query($args);
    
    if (!$faqs->have_posts()) {
        return '<p>Keine FAQs gefunden.</p>';
    }
    
    $output = '<div class="faq-accordion faq-accordion--' . esc_attr($atts['style']) . '">';
    
    $index = 0;
    while ($faqs->have_posts()) {
        $faqs->the_post();
        $question = get_the_title();
        $answer = get_field('answer');
        $is_first = $index === 0;
        
        $output .= '<div class="faq-item' . ($is_first ? ' is-active' : '') . '">';
        $output .= '<button class="faq-question" aria-expanded="' . ($is_first ? 'true' : 'false') . '">';
        $output .= '<span class="faq-question__text">' . esc_html($question) . '</span>';
        $output .= '<span class="faq-question__icon">';
        $output .= '<svg width="20" height="20" viewBox="0 0 20 20" fill="none">';
        $output .= '<path d="M5 7.5L10 12.5L15 7.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>';
        $output .= '</svg>';
        $output .= '</span>';
        $output .= '</button>';
        $output .= '<div class="faq-answer"' . ($is_first ? ' style="display:block;"' : '') . '>';
        $output .= '<div class="faq-answer__content">' . wp_kses_post($answer) . '</div>';
        $output .= '</div>';
        $output .= '</div>';
        
        $index++;
    }
    
    $output .= '</div>';
    
    wp_reset_postdata();
    
    return $output;
}
add_shortcode('faq_accordion', 'faq_accordion_shortcode');

// ============================================
// TEAM QUERY SHORTCODE
// ============================================

function team_query_shortcode($atts) {
    $atts = shortcode_atts(array(
        'number' => 3,
        'columns' => 3,
        'order' => 'ASC',
        'orderby' => 'menu_order',
        'style' => 'default',
    ), $atts);
    
    $number = intval($atts['number']);
    $columns = intval($atts['columns']);
    $order = esc_attr($atts['order']);
    $orderby = esc_attr($atts['orderby']);
    $style = esc_attr($atts['style']);
    
    // Query arguments
    $args = array(
        'post_type' => 'team',
        'posts_per_page' => $number,
        'order' => $order,
        'orderby' => $orderby,
        'post_status' => 'publish',
    );
    
    // If ordering by custom field (display_order)
    if ($orderby === 'display_order') {
        $args['orderby'] = 'meta_value_num';
        $args['meta_key'] = 'display_order';
    }
    
    $team_query = new WP_Query($args);
    
    if (!$team_query->have_posts()) {
        return '<p>Keine Team-Mitglieder gefunden.</p>';
    }
    
    // INLINE STYLES für garantiertes Grid
    $inline_style = 'display:grid!important;gap:2rem!important;margin:2rem 0!important;width:100%!important;';
    
    if ($columns == 2) {
        $inline_style .= 'grid-template-columns:repeat(2,1fr)!important;';
    } elseif ($columns == 3) {
        $inline_style .= 'grid-template-columns:repeat(3,1fr)!important;';
    } elseif ($columns == 4) {
        $inline_style .= 'grid-template-columns:repeat(4,1fr)!important;';
    } else {
        $inline_style .= 'grid-template-columns:repeat(' . $columns . ',1fr)!important;';
    }
    
    ob_start();
    ?>
    <div class="team-cards team-cards--<?php echo $style; ?>" 
         data-columns="<?php echo $columns; ?>" 
         style="<?php echo $inline_style; ?>">
        <?php while ($team_query->have_posts()) : $team_query->the_post(); ?>
            <?php
            $role = get_field('role');
            $email = get_field('email');
            $phone = get_field('phone');
            $social = get_field('social_media');
            $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'medium');
            ?>
            
            <div class="team-member" data-animate="fade-in-up">
                <?php if ($thumbnail) : ?>
                    <div class="team-member__image-wrapper">
                        <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php the_title(); ?>" class="team-member__image">
                        
                        <?php if ($social || $email) : ?>
                            <div class="team-member__overlay">
                                <div class="team-member__social">
                                    <?php if ($email) : ?>
                                        <a href="mailto:<?php echo esc_attr($email); ?>" class="team-member__social-link" aria-label="Email">
                                            <span class="dashicons dashicons-email"></span>
                                        </a>
                                    <?php endif; ?>
                                    
                                    <?php if ($social && !empty($social['linkedin'])) : ?>
                                        <a href="<?php echo esc_url($social['linkedin']); ?>" target="_blank" rel="noopener noreferrer" class="team-member__social-link" aria-label="LinkedIn">
                                            <span class="dashicons dashicons-linkedin"></span>
                                        </a>
                                    <?php endif; ?>
                                    
                                    <?php if ($social && !empty($social['twitter'])) : ?>
                                        <a href="<?php echo esc_url($social['twitter']); ?>" target="_blank" rel="noopener noreferrer" class="team-member__social-link" aria-label="Twitter">
                                            <span class="dashicons dashicons-twitter"></span>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                
                <div class="team-member__content">
                    <h3 class="team-member__name"><?php the_title(); ?></h3>
                    
                    <?php if ($role) : ?>
                        <div class="team-member__role"><?php echo esc_html($role); ?></div>
                    <?php endif; ?>
                    
                    <?php if (has_excerpt()) : ?>
                        <div class="team-member__bio">
                            <?php the_excerpt(); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($phone) : ?>
                        <div class="team-member__phone">
                            <span class="dashicons dashicons-phone"></span> <?php echo esc_html($phone); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
    <?php
    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode('team_query', 'team_query_shortcode');

// ============================================
// PROJECTS QUERY SHORTCODE
// ============================================

function projects_query_shortcode($atts) {
    $atts = shortcode_atts(array(
        'number' => 6,
        'columns' => 3,
        'category' => '', // Project category slug
        'order' => 'DESC',
        'orderby' => 'date',
    ), $atts);
    
    $number = intval($atts['number']);
    $columns = esc_attr($atts['columns']);
    $category = sanitize_text_field($atts['category']);
    $order = esc_attr($atts['order']);
    $orderby = esc_attr($atts['orderby']);
    
    $args = array(
        'post_type' => 'projects',
        'posts_per_page' => $number,
        'order' => $order,
        'orderby' => $orderby,
        'post_status' => 'publish',
    );
    
    // Filter by category
    if (!empty($category)) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'project_category',
                'field' => 'slug',
                'terms' => $category,
            ),
        );
    }
    
    $projects_query = new WP_Query($args);
    
    if (!$projects_query->have_posts()) {
        return '<p>Keine Projekte gefunden.</p>';
    }
    
    ob_start();
    ?>
    <div class="projects-grid" data-columns="<?php echo $columns; ?>">
        <?php while ($projects_query->have_posts()) : $projects_query->the_post(); ?>
            <?php
            $client = get_field('client_name');
            $year = get_field('project_year');
            $url = get_field('project_url');
            $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'large');
            $categories = get_the_terms(get_the_ID(), 'project_category');
            ?>
            
            <div class="project-card" data-animate="fade-in-up">
                <?php if ($thumbnail) : ?>
                    <div class="project-card__image">
                        <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php the_title(); ?>">
                        <div class="project-card__overlay">
                            <a href="<?php the_permalink(); ?>" class="project-card__link">
                                <span class="dashicons dashicons-visibility"></span>
                                Details ansehen
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
                
                <div class="project-card__content">
                    <?php if ($categories) : ?>
                        <div class="project-card__categories">
                            <?php foreach ($categories as $cat) : ?>
                                <span class="project-card__category"><?php echo esc_html($cat->name); ?></span>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    
                    <h3 class="project-card__title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>
                    
                    <?php if ($client || $year) : ?>
                        <div class="project-card__meta">
                            <?php if ($client) : ?>
                                <span><?php echo esc_html($client); ?></span>
                            <?php endif; ?>
                            
                            <?php if ($client && $year) : ?>
                                <span>·</span>
                            <?php endif; ?>
                            
                            <?php if ($year) : ?>
                                <span><?php echo esc_html($year); ?></span>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (has_excerpt()) : ?>
                        <div class="project-card__excerpt">
                            <?php the_excerpt(); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($url) : ?>
                        <a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener noreferrer" class="project-card__url">
                            <span class="dashicons dashicons-external"></span> Live ansehen
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
    <?php
    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode('projects_query', 'projects_query_shortcode');

// ============================================
// TESTIMONIALS QUERY SHORTCODE
// ============================================

function testimonials_query_shortcode($atts) {
    $atts = shortcode_atts(array(
        'number' => 3,
        'columns' => 3,
        'style' => 'card',
        'featured_only' => 'false',
        'slider' => 'false',
    ), $atts);
    
    $number = intval($atts['number']);
    $columns = esc_attr($atts['columns']);
    $style = esc_attr($atts['style']);
    $featured_only = $atts['featured_only'] === 'true';
    $slider = $atts['slider'] === 'true';
    
    $args = array(
        'post_type' => 'testimonials',
        'posts_per_page' => $number,
        'order' => 'DESC',
        'orderby' => 'date',
        'post_status' => 'publish',
    );
    
    // Filter featured only
    if ($featured_only) {
        $args['meta_query'] = array(
            array(
                'key' => 'featured',
                'value' => '1',
                'compare' => '=',
            ),
        );
    }
    
    $testimonials_query = new WP_Query($args);
    
    if (!$testimonials_query->have_posts()) {
        return '<p>Keine Testimonials gefunden.</p>';
    }
    
    $wrapper_class = $slider ? 'testimonials testimonials--slider testimonials--' . $style . ' swiper' : 'testimonials testimonials--' . $style;
    $item_class = $slider ? 'swiper-slide testimonial' : 'testimonial';
    
    ob_start();
    ?>
    <div class="<?php echo $wrapper_class; ?>" data-columns="<?php echo $columns; ?>" <?php if ($slider) echo 'data-autoplay="true"'; ?>>
        <div class="<?php echo $slider ? 'swiper-wrapper' : ''; ?>">
            <?php while ($testimonials_query->have_posts()) : $testimonials_query->the_post(); ?>
                <?php
                $company = get_field('company');
                $role = get_field('role');
                $rating = get_field('rating');
                $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');
                ?>
                
                <div class="<?php echo $item_class; ?>" data-animate="fade-in-up">
                    <?php if ($rating) : ?>
                        <div class="testimonial__rating">
                            <?php for ($i = 1; $i <= 5; $i++) : ?>
                                <span class="star <?php echo $i <= $rating ? 'star--filled' : 'star--empty'; ?>">
                                    <?php echo $i <= $rating ? '★' : '☆'; ?>
                                </span>
                            <?php endfor; ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="testimonial__quote">
                        <?php the_content(); ?>
                    </div>
                    
                    <div class="testimonial__footer">
                        <?php if ($thumbnail) : ?>
                            <div class="testimonial__image">
                                <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php the_title(); ?>">
                            </div>
                        <?php endif; ?>
                        
                        <div class="testimonial__meta">
                            <div class="testimonial__name"><?php the_title(); ?></div>
                            <?php if ($role || $company) : ?>
                                <div class="testimonial__role">
                                    <?php 
                                    $meta_parts = array_filter(array($role, $company));
                                    echo implode(' · ', $meta_parts);
                                    ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        
        <?php if ($slider) : ?>
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
        <?php endif; ?>
    </div>
    <?php
    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode('testimonials_query', 'testimonials_query_shortcode');

// ============================================
// SERVICES QUERY SHORTCODE
// ============================================

function services_query_shortcode($atts) {
    $atts = shortcode_atts(array(
        'number' => -1,
        'columns' => 3,
        'order' => 'ASC',
        'orderby' => 'menu_order',
    ), $atts);
    
    $number = intval($atts['number']);
    $columns = esc_attr($atts['columns']);
    $order = esc_attr($atts['order']);
    $orderby = esc_attr($atts['orderby']);
    
    $args = array(
        'post_type' => 'services',
        'posts_per_page' => $number,
        'order' => $order,
        'orderby' => $orderby,
        'post_status' => 'publish',
    );
    
    $services_query = new WP_Query($args);
    
    if (!$services_query->have_posts()) {
        return '<p>Keine Services gefunden.</p>';
    }
    
    ob_start();
    ?>
    <div class="services-grid" data-columns="<?php echo $columns; ?>">
        <?php while ($services_query->have_posts()) : $services_query->the_post(); ?>
            <?php
            $icon = get_field('icon');
            $price = get_field('price');
            $features = get_field('features');
            $cta = get_field('cta');
            $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'medium');
            ?>
            
            <div class="service-card" data-animate="fade-in-up">
                <?php if ($icon) : ?>
                    <div class="service-card__icon">
                        <span class="dashicons <?php echo esc_attr($icon); ?>"></span>
                    </div>
                <?php endif; ?>
                
                <h3 class="service-card__title"><?php the_title(); ?></h3>
                
                <?php if ($price) : ?>
                    <div class="service-card__price"><?php echo esc_html($price); ?></div>
                <?php endif; ?>
                
                <?php if (has_excerpt()) : ?>
                    <div class="service-card__excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                <?php endif; ?>
                
                <?php if ($features) : ?>
                    <ul class="service-card__features">
                        <?php foreach ($features as $feature) : ?>
                            <li><?php echo esc_html($feature['text']); ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                
                <?php if ($cta && !empty($cta['link'])) : ?>
                    <a href="<?php echo esc_url($cta['link']['url']); ?>" 
                       class="service-card__cta button button--primary"
                       <?php echo !empty($cta['link']['target']) ? 'target="' . esc_attr($cta['link']['target']) . '"' : ''; ?>>
                        <?php echo esc_html($cta['text']); ?>
                    </a>
                <?php else : ?>
                    <a href="<?php the_permalink(); ?>" class="service-card__cta button button--primary">
                        Mehr erfahren
                    </a>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    </div>
    <?php
    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode('services_query', 'services_query_shortcode');

// ============================================
// SPOILER/READ-MORE SHORTCODE
// ============================================

function spoiler_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'open_text' => 'Mehr anzeigen',
        'close_text' => 'Weniger anzeigen',
        'open' => 'false',
        'style' => 'default',
        'icon' => 'true',
    ), $atts);
    
    $open_text = esc_html($atts['open_text']);
    $close_text = esc_html($atts['close_text']);
    $is_open = $atts['open'] === 'true';
    $style = esc_attr($atts['style']);
    $show_icon = $atts['icon'] === 'true';
    
    $unique_id = 'spoiler-' . uniqid();
    $open_class = $is_open ? ' is-open' : '';
    $display = $is_open ? 'block' : 'none';
    $button_text = $is_open ? $close_text : $open_text;
    
    $output = '<div class="spoiler spoiler--' . $style . $open_class . '" id="' . $unique_id . '">';
    $output .= '<button class="spoiler__toggle" ';
    $output .= 'data-open-text="' . esc_attr($open_text) . '" ';
    $output .= 'data-close-text="' . esc_attr($close_text) . '" ';
    $output .= 'aria-expanded="' . ($is_open ? 'true' : 'false') . '">';
    $output .= '<span class="spoiler__button-text">' . $button_text . '</span>';
    
    if ($show_icon) {
        $output .= '<span class="spoiler__icon">';
        $output .= '<svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">';
        $output .= '<path d="M8 4l4 4-4 4V4z"/>';
        $output .= '</svg>';
        $output .= '</span>';
    }
    
    $output .= '</button>';
    $output .= '<div class="spoiler__content" style="display: ' . $display . ';">';
    $output .= wpautop(do_shortcode($content));
    $output .= '</div>';
    $output .= '</div>';
    
    return $output;
}
add_shortcode('spoiler', 'spoiler_shortcode');

function read_more_shortcode($atts, $content = null) {
    $defaults = array(
        'open_text' => 'Weiterlesen',
        'close_text' => 'Weniger anzeigen',
        'open' => 'false',
        'style' => 'minimal',
        'icon' => 'true',
    );
    
    $atts = shortcode_atts($defaults, $atts);
    
    return spoiler_shortcode($atts, $content);
}
add_shortcode('read_more', 'read_more_shortcode');

// ============================================
// PRICING TABLES SHORTCODE
// ============================================

function pricing_tables_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'columns' => '3',
        'style' => 'default',
    ), $atts);
    
    $columns = intval($atts['columns']);
    $style = esc_attr($atts['style']);
    
    // INLINE STYLES
    $inline_style = 'display:grid!important;gap:2rem!important;margin:4rem 0!important;width:100%!important;align-items:stretch!important;';
    
    if ($columns == 2) {
        $inline_style .= 'grid-template-columns:repeat(2,1fr)!important;';
    } elseif ($columns == 3) {
        $inline_style .= 'grid-template-columns:repeat(3,1fr)!important;';
    } elseif ($columns == 4) {
        $inline_style .= 'grid-template-columns:repeat(4,1fr)!important;';
    } else {
        $inline_style .= 'grid-template-columns:repeat(' . $columns . ',1fr)!important;';
    }
    
    return '<div class="pricing-tables pricing-tables--' . $style . '" data-columns="' . $columns . '" style="' . $inline_style . '">' . do_shortcode($content) . '</div>';
}
add_shortcode('pricing_tables', 'pricing_tables_shortcode');

function pricing_table_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'title' => '',
        'price' => '',
        'currency' => '€',
        'period' => 'pro Monat',
        'featured' => 'false',
        'button_text' => 'Jetzt starten',
        'button_link' => '#',
        'button_target' => '_self',
        'badge' => '', // e.g. "Beliebt", "Empfohlen"
        'description' => '',
    ), $atts);
    
    $title = esc_html($atts['title']);
    $price = esc_html($atts['price']);
    $currency = esc_html($atts['currency']);
    $period = esc_html($atts['period']);
    $featured = $atts['featured'] === 'true';
    $button_text = esc_html($atts['button_text']);
    $button_link = esc_url($atts['button_link']);
    $button_target = esc_attr($atts['button_target']);
    $badge = esc_html($atts['badge']);
    $description = esc_html($atts['description']);
    
    $featured_class = $featured ? ' pricing-table--featured' : '';
    
    ob_start();
    ?>
    <div class="pricing-table<?php echo $featured_class; ?>" data-animate="fade-in-up">
        <?php if ($badge) : ?>
            <div class="pricing-table__badge"><?php echo $badge; ?></div>
        <?php endif; ?>
        
        <div class="pricing-table__header">
            <?php if ($title) : ?>
                <h3 class="pricing-table__title"><?php echo $title; ?></h3>
            <?php endif; ?>
            
            <?php if ($description) : ?>
                <p class="pricing-table__description"><?php echo $description; ?></p>
            <?php endif; ?>
        </div>
        
        <div class="pricing-table__price">
            <span class="pricing-table__currency"><?php echo $currency; ?></span>
            <span class="pricing-table__amount"><?php echo $price; ?></span>
            <?php if ($period) : ?>
                <span class="pricing-table__period"><?php echo $period; ?></span>
            <?php endif; ?>
        </div>
        
        <div class="pricing-table__features">
            <?php echo wpautop(do_shortcode($content)); ?>
        </div>
        
        <div class="pricing-table__footer">
            <a href="<?php echo $button_link; ?>" 
               class="pricing-table__button button button--primary" 
               target="<?php echo $button_target; ?>">
                <?php echo $button_text; ?>
            </a>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('pricing_table', 'pricing_table_shortcode');

// Helper shortcode for feature lists
function pricing_feature_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'icon' => 'check', // check, cross, info
        'highlight' => 'false',
    ), $atts);
    
    $icon = esc_attr($atts['icon']);
    $highlight = $atts['highlight'] === 'true' ? ' pricing-feature--highlight' : '';
    
    $icon_html = '';
    switch ($icon) {
        case 'check':
            $icon_html = '<span class="pricing-feature__icon pricing-feature__icon--check">✓</span>';
            break;
        case 'cross':
            $icon_html = '<span class="pricing-feature__icon pricing-feature__icon--cross">✗</span>';
            break;
        case 'info':
            $icon_html = '<span class="pricing-feature__icon pricing-feature__icon--info">i</span>';
            break;
    }
    
    return '<div class="pricing-feature' . $highlight . '">' . $icon_html . '<span>' . esc_html($content) . '</span></div>';
}
add_shortcode('pricing_feature', 'pricing_feature_shortcode');

// ============================================
// WOOCOMMERCE SHORTCODES
// ============================================

/**
 * Products Grid Shortcode
 */
function products_grid_shortcode($atts) {
    $atts = shortcode_atts(array(
        'columns' => '3',
        'limit' => '8',
        'category' => '',
        'featured' => '',
        'sale' => '',
        'orderby' => 'date',
    ), $atts);
    
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => intval($atts['limit']),
        'orderby' => $atts['orderby'],
    );
    
    if ($atts['category']) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => $atts['category'],
            ),
        );
    }
    
    if ($atts['featured'] === 'true') {
        $args['tax_query'][] = array(
            'taxonomy' => 'product_visibility',
            'field' => 'name',
            'terms' => 'featured',
        );
    }
    
    if ($atts['sale'] === 'true') {
        $args['meta_query'] = array(
            array(
                'key' => '_sale_price',
                'value' => 0,
                'compare' => '>',
                'type' => 'NUMERIC',
            ),
        );
    }
    
    $products = new WP_Query($args);
    
    ob_start();
    
    if ($products->have_posts()) {
        echo '<ul class="products columns-' . esc_attr($atts['columns']) . '">';
        
        while ($products->have_posts()) {
            $products->the_post();
            wc_get_template_part('content', 'product');
        }
        
        echo '</ul>';
        
        wp_reset_postdata();
    }
    
    return ob_get_clean();
}
add_shortcode('products_grid', 'products_grid_shortcode');