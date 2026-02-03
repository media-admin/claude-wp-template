<?php
/**
 * Custom Block Patterns
 */

if (!defined('ABSPATH')) {
    exit;
}

// Register Pattern Category
add_action('init', 'register_custom_pattern_category');
function register_custom_pattern_category() {
    register_block_pattern_category('custom-components', array(
        'label' => __('Custom Components', 'custom-theme'),
    ));
}

// Testimonials Grid Pattern (3 Spalten)
add_action('init', 'register_testimonials_patterns');
function register_testimonials_patterns() {
    
    // Pattern 1: Grid 3 Spalten
    register_block_pattern('custom-theme/testimonials-grid', array(
        'title'       => __('Testimonials Grid (3 Spalten)', 'custom-theme'),
        'description' => __('Grid mit 3 Testimonials - Standard Card Style', 'custom-theme'),
        'categories'  => array('custom-components'),
        'content'     => '<!-- wp:shortcode -->
[testimonials columns="3" style="card"]
  [testimonial name="Max Mustermann" role="CEO" company="Firma GmbH" image="https://i.pravatar.cc/150?img=1" rating="5"]
    Hervorragende Arbeit! Das Team hat unsere Erwartungen übertroffen. Die Zusammenarbeit war professionell und zuverlässig.
  [/testimonial]
  [testimonial name="Anna Schmidt" role="Marketing Manager" company="StartUp AG" image="https://i.pravatar.cc/150?img=5" rating="5"]
    Professionell, schnell und kreativ. Absolut empfehlenswert! Tolle Ergebnisse in kurzer Zeit.
  [/testimonial]
  [testimonial name="Peter Müller" role="Geschäftsführer" company="Müller & Co" image="https://i.pravatar.cc/150?img=12" rating="5"]
    Beste Entscheidung für unser Projekt. Vielen Dank für die großartige Zusammenarbeit!
  [/testimonial]
[/testimonials]
<!-- /wp:shortcode -->',
    ));
    
    // Pattern 2: Grid 2 Spalten
    register_block_pattern('custom-theme/testimonials-grid-2', array(
        'title'       => __('Testimonials Grid (2 Spalten)', 'custom-theme'),
        'description' => __('Grid mit 2 Testimonials', 'custom-theme'),
        'categories'  => array('custom-components'),
        'content'     => '<!-- wp:shortcode -->
[testimonials columns="2" style="card"]
  [testimonial name="Sarah Weber" role="Online-Shop Betreiberin" image="https://i.pravatar.cc/150?img=9" rating="5"]
    Sehr gute Qualität und faire Preise. Die Zusammenarbeit war unkompliziert und das Ergebnis überzeugt auf ganzer Linie.
  [/testimonial]
  [testimonial name="Laura Becker" role="Gründerin" company="StartUp Hero" image="https://i.pravatar.cc/150?img=10" rating="5"]
    Eine absolute Empfehlung! Das Team hat nicht nur technisch überzeugt, sondern auch strategisch beraten.
  [/testimonial]
[/testimonials]
<!-- /wp:shortcode -->',
    ));
    
    // Pattern 3: Slider mit Autoplay
    register_block_pattern('custom-theme/testimonials-slider', array(
        'title'       => __('Testimonials Slider', 'custom-theme'),
        'description' => __('Testimonials als Slider mit Autoplay', 'custom-theme'),
        'categories'  => array('custom-components'),
        'content'     => '<!-- wp:shortcode -->
[testimonials slider="true" autoplay="true"]
  [testimonial name="Christina Braun" role="Head of Digital" company="Innovation Labs" image="https://i.pravatar.cc/150?img=20" rating="5"]
    Herausragende Arbeit! Das Team hat unsere Vision perfekt umgesetzt und dabei kreative Lösungen für komplexe Herausforderungen gefunden.
  [/testimonial]
  [testimonial name="Daniel Krause" role="CTO" company="Tech Ventures" image="https://i.pravatar.cc/150?img=33" rating="5"]
    Technisch versiert, kreativ und zuverlässig. Die Kommunikation war transparent und wir wurden stets auf dem Laufenden gehalten.
  [/testimonial]
  [testimonial name="Maria Schneider" role="Produktmanagerin" company="Digital Solutions" image="https://i.pravatar.cc/150?img=45" rating="5"]
    Ich kann das Team nur wärmstens empfehlen. Professionell, schnell und immer mit einem offenen Ohr für unsere Anliegen.
  [/testimonial]
  [testimonial name="Alexander Wolf" role="Gründer & CEO" company="Wolf Digital" image="https://i.pravatar.cc/150?img=52" rating="5"]
    Von der ersten Beratung bis zum Launch - alles perfekt! Das Projekt wurde sogar früher als geplant fertiggestellt.
  [/testimonial]
[/testimonials]
<!-- /wp:shortcode -->',
    ));
    
    // Pattern 4: Quote Style (Zentriert)
    register_block_pattern('custom-theme/testimonials-quote', array(
        'title'       => __('Testimonials Quote Style', 'custom-theme'),
        'description' => __('Zentrierte Testimonials im Quote-Stil (2 Spalten)', 'custom-theme'),
        'categories'  => array('custom-components'),
        'content'     => '<!-- wp:shortcode -->
[testimonials columns="2" style="quote"]
  [testimonial name="Thomas Klein" role="Marketing Director" company="BigCorp International" image="https://i.pravatar.cc/150?img=15" rating="5"]
    Professionelle Umsetzung auf höchstem Niveau. Die Zusammenarbeit mit dem Team war von Anfang an unkompliziert und zielführend.
  [/testimonial]
  [testimonial name="Julia Hoffmann" role="E-Commerce Manager" company="Shop Masters" image="https://i.pravatar.cc/150?img=25" rating="5"]
    Exzellente Beratung und technische Umsetzung. Wir sind sehr glücklich mit dem Ergebnis und der langfristigen Betreuung.
  [/testimonial]
[/testimonials]
<!-- /wp:shortcode -->',
    ));
    
    // Pattern 5: Minimal Style
    register_block_pattern('custom-theme/testimonials-minimal', array(
        'title'       => __('Testimonials Minimal', 'custom-theme'),
        'description' => __('Minimalistischer Stil ohne Card-Background', 'custom-theme'),
        'categories'  => array('custom-components'),
        'content'     => '<!-- wp:shortcode -->
[testimonials columns="1" style="minimal"]
  [testimonial name="Michael Wagner" role="Projektmanager" company="Agentur Plus"]
    Schnelle Reaktionszeiten und flexible Anpassungen. Das hat uns sehr geholfen, unser Projekt termingerecht zu launchen.
  [/testimonial]
  [testimonial name="Sophie Lang" role="Freelancerin"]
    Tolle Zusammenarbeit und faire Konditionen. Ich arbeite gerne mit dem Team zusammen.
  [/testimonial]
  [testimonial name="Robert Fischer" role="Geschäftsführer" company="Fischer Consulting GmbH"]
    Top Service und exzellente Qualität. Absolut empfehlenswert für jeden, der professionelle Unterstützung sucht.
  [/testimonial]
[/testimonials]
<!-- /wp:shortcode -->',
    ));
    
    // Pattern 6: 4 Spalten (kompakt)
    register_block_pattern('custom-theme/testimonials-4-columns', array(
        'title'       => __('Testimonials 4 Spalten (kompakt)', 'custom-theme'),
        'description' => __('Kompakte Testimonials in 4 Spalten', 'custom-theme'),
        'categories'  => array('custom-components'),
        'content'     => '<!-- wp:shortcode -->
[testimonials columns="4" style="card"]
  [testimonial name="Nina Bauer" role="Designerin" image="https://i.pravatar.cc/150?img=23" rating="5"]
    Tolle Arbeit!
  [/testimonial]
  [testimonial name="Felix Richter" role="Berater" image="https://i.pravatar.cc/150?img=59" rating="5"]
    Top Service!
  [/testimonial]
  [testimonial name="Tim Neumann" role="Entwickler" image="https://i.pravatar.cc/150?img=68" rating="5"]
    Sehr empfehlenswert!
  [/testimonial]
  [testimonial name="Emma Koch" role="Freelancerin" image="https://i.pravatar.cc/150?img=44" rating="4"]
    Super Team!
  [/testimonial]
[/testimonials]
<!-- /wp:shortcode -->',
    ));
}

// Tabs Patterns
register_block_pattern('custom-theme/tabs-default', array(
    'title'       => __('Tabs - Standard', 'custom-theme'),
    'description' => __('Standard Tabs mit 3 Tabs', 'custom-theme'),
    'categories'  => array('custom-components'),
    'content'     => '<!-- wp:shortcode -->
[tabs style="default"]
  [tab title="Übersicht" active="true"]
    <h3>Willkommen</h3>
    <p>Dies ist die Übersicht mit den wichtigsten Informationen.</p>
  [/tab]
  [tab title="Features"]
    <h3>Unsere Features</h3>
    <ul>
      <li>Feature 1: Beschreibung</li>
      <li>Feature 2: Beschreibung</li>
      <li>Feature 3: Beschreibung</li>
    </ul>
  [/tab]
  [tab title="Preise"]
    <h3>Preisübersicht</h3>
    <p>Hier finden Sie unsere transparente Preisgestaltung.</p>
  [/tab]
[/tabs]
<!-- /wp:shortcode -->',
));

register_block_pattern('custom-theme/tabs-pills', array(
    'title'       => __('Tabs - Pills Style', 'custom-theme'),
    'description' => __('Tabs mit Pill-Buttons', 'custom-theme'),
    'categories'  => array('custom-components'),
    'content'     => '<!-- wp:shortcode -->
[tabs style="pills"]
  [tab title="🎯 Mission" active="true"]
    Unsere Mission ist es, innovative Lösungen zu schaffen.
  [/tab]
  [tab title="👁️ Vision"]
    Wir streben danach, führend in unserer Branche zu werden.
  [/tab]
  [tab title="💎 Werte"]
    Qualität, Transparenz und Kundenzufriedenheit stehen im Mittelpunkt.
  [/tab]
[/tabs]
<!-- /wp:shortcode -->',
));

register_block_pattern('custom-theme/tabs-underline', array(
    'title'       => __('Tabs - Underline Style', 'custom-theme'),
    'description' => __('Minimalistischer Underline-Stil', 'custom-theme'),
    'categories'  => array('custom-components'),
    'content'     => '<!-- wp:shortcode -->
[tabs style="underline"]
  [tab title="Beschreibung" active="true"]
    Detaillierte Produktbeschreibung...
  [/tab]
  [tab title="Spezifikationen"]
    Technische Details und Spezifikationen...
  [/tab]
  [tab title="Bewertungen"]
    Kundenbewertungen und Erfahrungen...
  [/tab]
  [tab title="FAQ"]
    Häufig gestellte Fragen...
  [/tab]
[/tabs]
<!-- /wp:shortcode -->',
));

// Notification Patterns
register_block_pattern('custom-theme/notification-info', array(
    'title'       => __('Notification - Info', 'custom-theme'),
    'description' => __('Info-Benachrichtigung', 'custom-theme'),
    'categories'  => array('custom-components'),
    'content'     => '<!-- wp:shortcode -->
[notification type="info" title="Information" dismissible="true"]
Dies ist eine wichtige Information für Ihre Besucher. Sie können hier Updates, Hinweise oder andere relevante Informationen anzeigen.
[/notification]
<!-- /wp:shortcode -->',
));

register_block_pattern('custom-theme/notification-success', array(
    'title'       => __('Notification - Erfolg', 'custom-theme'),
    'description' => __('Erfolgs-Benachrichtigung', 'custom-theme'),
    'categories'  => array('custom-components'),
    'content'     => '<!-- wp:shortcode -->
[notification type="success" title="Erfolgreich!" dismissible="true"]
Ihre Aktion wurde erfolgreich durchgeführt. Vielen Dank!
[/notification]
<!-- /wp:shortcode -->',
));

register_block_pattern('custom-theme/notification-warning', array(
    'title'       => __('Notification - Warnung', 'custom-theme'),
    'description' => __('Warnungs-Benachrichtigung', 'custom-theme'),
    'categories'  => array('custom-components'),
    'content'     => '<!-- wp:shortcode -->
[notification type="warning" title="Achtung!" dismissible="true"]
Bitte beachten Sie diese wichtige Warnung. Es könnte Auswirkungen auf Ihre Nutzung haben.
[/notification]
<!-- /wp:shortcode -->',
));

register_block_pattern('custom-theme/notification-error', array(
    'title'       => __('Notification - Fehler', 'custom-theme'),
    'description'  => __('Fehler-Benachrichtigung', 'custom-theme'),
    'categories'  => array('custom-components'),
    'content'     => '<!-- wp:shortcode -->
[notification type="error" title="Fehler!" dismissible="true"]
Es ist ein Fehler aufgetreten. Bitte versuchen Sie es erneut oder kontaktieren Sie den Support.
[/notification]
<!-- /wp:shortcode -->',
));

register_block_pattern('custom-theme/notification-inline', array(
    'title'       => __('Notification - Inline', 'custom-theme'),
    'description' => __('Kleine Inline-Benachrichtigungen', 'custom-theme'),
    'categories'  => array('custom-components'),
    'content'     => '<!-- wp:shortcode -->
[notification_inline type="info"]Hinweis: Dies ist eine Inline-Nachricht[/notification_inline]

[notification_inline type="success"]Erfolgreich gespeichert![/notification_inline]

[notification_inline type="warning"]Achtung: Änderungen noch nicht gespeichert[/notification_inline]

[notification_inline type="error"]Fehler beim Laden[/notification_inline]
<!-- /wp:shortcode -->',
));

// Notifications Patterns
register_block_pattern('custom-theme/notification-success', array(
    'title'       => __('Notification - Success', 'custom-theme'),
    'description' => __('Erfolgs-Benachrichtigung', 'custom-theme'),
    'categories'  => array('custom-components'),
    'content'     => '<!-- wp:shortcode -->
[notification type="success"]
<strong>Erfolgreich!</strong> Ihre Änderungen wurden gespeichert.
[/notification]
<!-- /wp:shortcode -->',
));

register_block_pattern('custom-theme/notification-error', array(
    'title'       => __('Notification - Error', 'custom-theme'),
    'description' => __('Fehler-Benachrichtigung', 'custom-theme'),
    'categories'  => array('custom-components'),
    'content'     => '<!-- wp:shortcode -->
[notification type="error"]
<strong>Fehler!</strong> Etwas ist schiefgelaufen. Bitte versuchen Sie es erneut.
[/notification]
<!-- /wp:shortcode -->',
));

register_block_pattern('custom-theme/notification-warning', array(
    'title'       => __('Notification - Warning', 'custom-theme'),
    'description' => __('Warnung', 'custom-theme'),
    'categories'  => array('custom-components'),
    'content'     => '<!-- wp:shortcode -->
[notification type="warning"]
<strong>Achtung!</strong> Diese Aktion kann nicht rückgängig gemacht werden.
[/notification]
<!-- /wp:shortcode -->',
));

register_block_pattern('custom-theme/notification-info', array(
    'title'       => __('Notification - Info', 'custom-theme'),
    'description' => __('Info-Benachrichtigung', 'custom-theme'),
    'categories'  => array('custom-components'),
    'content'     => '<!-- wp:shortcode -->
[notification type="info"]
<strong>Information:</strong> Diese Website verwendet Cookies für ein besseres Nutzererlebnis.
[/notification]
<!-- /wp:shortcode -->',
));

// Stats Patterns
register_block_pattern('custom-theme/stats-default', array(
    'title'       => __('Stats - 4 Spalten', 'custom-theme'),
    'description' => __('Standard Stats mit 4 Spalten', 'custom-theme'),
    'categories'  => array('custom-components'),
    'content'     => '<!-- wp:shortcode -->
[stats columns="4" style="default"]
  [stat number="1000" suffix="+" label="Kunden" color="primary"]
    Zufriedene Kunden weltweit
  [/stat]
  [stat number="250" suffix="+" label="Projekte" color="success"]
    Erfolgreich abgeschlossen
  [/stat]
  [stat number="15" label="Jahre" color="info"]
    Erfahrung im Markt
  [/stat]
  [stat number="98" suffix="%" label="Zufriedenheit" color="warning"]
    Kundenzufriedenheit
  [/stat]
[/stats]
<!-- /wp:shortcode -->',
));

register_block_pattern('custom-theme/stats-card', array(
    'title'       => __('Stats - Card Style', 'custom-theme'),
    'description' => __('Stats mit Card-Design und Icons', 'custom-theme'),
    'categories'  => array('custom-components'),
    'content'     => '<!-- wp:shortcode -->
[stats columns="3" style="card"]
  [stat number="500" suffix="+" label="Downloads" icon="dashicons-download" color="primary"]
    Pro Monat
  [/stat]
  [stat number="24" suffix="/7" label="Support" icon="dashicons-sos" color="success"]
    Immer für Sie da
  [/stat]
  [stat number="99.9" suffix="%" label="Uptime" icon="dashicons-cloud" color="info"]
    Garantierte Verfügbarkeit
  [/stat]
[/stats]
<!-- /wp:shortcode -->',
));

register_block_pattern('custom-theme/stats-minimal', array(
    'title'       => __('Stats - Minimal', 'custom-theme'),
    'description' => __('Minimalistischer Stats-Stil', 'custom-theme'),
    'categories'  => array('custom-components'),
    'content'     => '<!-- wp:shortcode -->
[stats columns="3" style="minimal"]
  [stat number="10000" prefix="€" label="Umsatz"]
    Durchschnittlich pro Kunde
  [/stat]
  [stat number="4.9" suffix="/5" label="Bewertung"]
    Bei Google Reviews
  [/stat]
  [stat number="50" suffix="+" label="Team"]
    Experten für Sie
  [/stat]
[/stats]
<!-- /wp:shortcode -->',
));

register_block_pattern('custom-theme/stats-company', array(
    'title'       => __('Stats - Company Overview', 'custom-theme'),
    'description' => __('Firmenstatistiken mit Icons', 'custom-theme'),
    'categories'  => array('custom-components'),
    'content'     => '<!-- wp:shortcode -->
[stats columns="4" style="card"]
  [stat number="2500" suffix="+" label="Aktive Nutzer" icon="dashicons-groups" color="primary"]
    Weltweit aktiv
  [/stat]
  [stat number="150" label="Mitarbeiter" icon="dashicons-businessperson" color="success"]
    In 5 Ländern
  [/stat]
  [stat number="45" suffix="M" prefix="€" label="Umsatz" icon="dashicons-chart-line" color="info"]
    Im Jahr 2025
  [/stat]
  [stat number="12" label="Auszeichnungen" icon="dashicons-awards" color="warning"]
    Branchenpreise
  [/stat]
[/stats]
<!-- /wp:shortcode -->',
));