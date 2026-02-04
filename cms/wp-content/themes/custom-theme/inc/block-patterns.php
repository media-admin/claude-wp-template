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

// Timeline Patterns
register_block_pattern('custom-theme/timeline-company', array(
    'title'       => __('Timeline - Firmengeschichte', 'custom-theme'),
    'description' => __('Timeline für Unternehmensgeschichte', 'custom-theme'),
    'categories'  => array('custom-components'),
    'content'     => '<!-- wp:shortcode -->
[timeline style="alternate"]
  [timeline_item date="2020" title="Gründung" icon="dashicons-star-filled" color="primary"]
    Unser Unternehmen wurde mit der Vision gegründet, innovative Lösungen für moderne Herausforderungen zu schaffen.
  [/timeline_item]
  [timeline_item date="2021" title="Erstes Produkt" icon="dashicons-products" color="success"]
    Launch unseres ersten erfolgreichen Produkts mit über 1000 zufriedenen Kunden im ersten Jahr.
  [/timeline_item]
  [timeline_item date="2022" title="Internationale Expansion" icon="dashicons-admin-site-alt3" color="info"]
    Eröffnung von Niederlassungen in 3 weiteren Ländern und Aufbau eines globalen Teams.
  [/timeline_item]
  [timeline_item date="2023" title="Innovation Award" icon="dashicons-awards" color="warning"]
    Gewinner des prestigeträchtigen Innovation Awards für beste Technologie in unserer Branche.
  [/timeline_item]
  [timeline_item date="2024" title="Heute" icon="dashicons-chart-line" color="primary"]
    Mit über 5000 Kunden und 100+ Mitarbeitern sind wir Marktführer in unserem Segment.
  [/timeline_item]
[/timeline]
<!-- /wp:shortcode -->',
));

register_block_pattern('custom-theme/timeline-project', array(
    'title'       => __('Timeline - Projektverlauf', 'custom-theme'),
    'description' => __('Timeline für Projektphasen', 'custom-theme'),
    'categories'  => array('custom-components'),
    'content'     => '<!-- wp:shortcode -->
[timeline style="centered"]
  [timeline_item date="Phase 1" title="Analyse" icon="dashicons-search" color="info"]
    <strong>Dauer:</strong> 2 Wochen
    
    - Anforderungsanalyse
    - Stakeholder-Interviews
    - Marktforschung
  [/timeline_item]
  [timeline_item date="Phase 2" title="Konzeption" icon="dashicons-lightbulb" color="primary"]
    <strong>Dauer:</strong> 3 Wochen
    
    - Strategie-Entwicklung
    - Wireframes & Prototypen
    - Design-System
  [/timeline_item]
  [timeline_item date="Phase 3" title="Umsetzung" icon="dashicons-admin-tools" color="warning"]
    <strong>Dauer:</strong> 8 Wochen
    
    - Frontend-Entwicklung
    - Backend-Integration
    - Testing & QA
  [/timeline_item]
  [timeline_item date="Phase 4" title="Launch" icon="dashicons-rocket" color="success"]
    <strong>Dauer:</strong> 1 Woche
    
    - Deployment
    - Monitoring
    - Support & Wartung
  [/timeline_item]
[/timeline]
<!-- /wp:shortcode -->',
));

register_block_pattern('custom-theme/timeline-career', array(
    'title'       => __('Timeline - Karriereweg', 'custom-theme'),
    'description' => __('Timeline für Lebenslauf/Karriere', 'custom-theme'),
    'categories'  => array('custom-components'),
    'content'     => '<!-- wp:shortcode -->
[timeline style="alternate"]
  [timeline_item date="2015 - 2019" title="Studium" icon="dashicons-welcome-learn-more" color="info"]
    <strong>Bachelor of Science</strong>
    
    Informatik an der Technischen Universität München. Schwerpunkt: Web-Entwicklung & UX Design.
  [/timeline_item]
  [timeline_item date="2019 - 2021" title="Junior Developer" icon="dashicons-editor-code" color="primary"]
    <strong>Tech Startup GmbH</strong>
    
    Entwicklung von Web-Applikationen mit React und Node.js. Erste Erfahrungen im agilen Projektmanagement.
  [/timeline_item]
  [timeline_item date="2021 - 2023" title="Senior Developer" icon="dashicons-admin-generic" color="success"]
    <strong>Digital Agency AG</strong>
    
    Lead Developer für große Enterprise-Projekte. Mentoring von Junior-Entwicklern und Code-Reviews.
  [/timeline_item]
  [timeline_item date="2023 - Heute" title="Tech Lead" icon="dashicons-groups" color="warning"]
    <strong>Innovation Labs</strong>
    
    Technische Leitung eines 15-köpfigen Entwicklerteams. Verantwortung für Architektur-Entscheidungen.
  [/timeline_item]
[/timeline]
<!-- /wp:shortcode -->',
));

register_block_pattern('custom-theme/timeline-with-images', array(
    'title'       => __('Timeline - Mit Bildern', 'custom-theme'),
    'description' => __('Timeline mit Bildern für jeden Meilenstein', 'custom-theme'),
    'categories'  => array('custom-components'),
    'content'     => '<!-- wp:shortcode -->
[timeline style="alternate"]
  [timeline_item date="Januar 2024" title="Kick-Off Meeting" icon="dashicons-megaphone" color="primary" image="https://picsum.photos/800/400?random=1"]
    Erfolgreicher Start des Projekts mit allen Stakeholdern. Definition der Projektziele und Roadmap.
  [/timeline_item]
  [timeline_item date="März 2024" title="Design Sprint" icon="dashicons-art" color="info" image="https://picsum.photos/800/400?random=2"]
    Intensive Design-Phase mit User Research, Wireframes und finalen Mockups.
  [/timeline_item]
  [timeline_item date="Juni 2024" title="Beta Launch" icon="dashicons-rocket" color="success" image="https://picsum.photos/800/400?random=3"]
    Erfolgreicher Beta-Launch mit ausgewählten Testern. Sehr positives Feedback!
  [/timeline_item]
[/timeline]
<!-- /wp:shortcode -->',
));

// Image Comparison Patterns
register_block_pattern('custom-theme/image-comparison-horizontal', array(
    'title'       => __('Image Comparison - Horizontal', 'custom-theme'),
    'description' => __('Vorher/Nachher Vergleich horizontal', 'custom-theme'),
    'categories'  => array('custom-components'),
    'content'     => '<!-- wp:shortcode -->
[image_comparison before="https://picsum.photos/1200/675?random=10&grayscale" after="https://picsum.photos/1200/675?random=10" before_label="Vorher" after_label="Nachher" position="50" orientation="horizontal"]
<!-- /wp:shortcode -->',
));

register_block_pattern('custom-theme/image-comparison-vertical', array(
    'title'       => __('Image Comparison - Vertical', 'custom-theme'),
    'description' => __('Vorher/Nachher Vergleich vertikal', 'custom-theme'),
    'categories'  => array('custom-components'),
    'content'     => '<!-- wp:shortcode -->
[image_comparison before="https://picsum.photos/800/1200?random=20&grayscale" after="https://picsum.photos/800/1200?random=20" before_label="Vorher" after_label="Nachher" position="50" orientation="vertical"]
<!-- /wp:shortcode -->',
));

register_block_pattern('custom-theme/image-comparison-renovation', array(
    'title'       => __('Image Comparison - Renovation Example', 'custom-theme'),
    'description' => __('Beispiel für Renovierung/Umbau', 'custom-theme'),
    'categories'  => array('custom-components'),
    'content'     => '<!-- wp:heading -->
<h2>Unsere Renovierung</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Sehen Sie selbst, wie wir aus einem alten Raum etwas Neues geschaffen haben. Bewegen Sie den Slider, um den Unterschied zu sehen.</p>
<!-- /wp:paragraph -->

<!-- wp:shortcode -->
[image_comparison before="https://picsum.photos/1200/675?random=30&blur=2" after="https://picsum.photos/1200/675?random=30" before_label="Alt" after_label="Neu" position="50"]
<!-- /wp:shortcode -->',
));

// Logo Carousel Patterns
register_block_pattern('custom-theme/logo-carousel-partners', array(
    'title'       => __('Logo Carousel - Partner', 'custom-theme'),
    'description' => __('Partner-Logos mit Autoplay', 'custom-theme'),
    'categories'  => array('custom-components'),
    'content'     => '<!-- wp:heading {"textAlign":"center"} -->
<h2 class="has-text-align-center">Unsere Partner</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Vertrauen von führenden Unternehmen weltweit</p>
<!-- /wp:paragraph -->

<!-- wp:shortcode -->
[logo_carousel autoplay="true" speed="3000" grayscale="true"]
[logo_item image="https://via.placeholder.com/200x80/667eea/ffffff?text=Partner+1" alt="Partner 1" link="https://example.com"]
[logo_item image="https://via.placeholder.com/200x80/764ba2/ffffff?text=Partner+2" alt="Partner 2" link="https://example.com"]
[logo_item image="https://via.placeholder.com/200x80/f093fb/ffffff?text=Partner+3" alt="Partner 3" link="https://example.com"]
[logo_item image="https://via.placeholder.com/200x80/4facfe/ffffff?text=Partner+4" alt="Partner 4" link="https://example.com"]
[logo_item image="https://via.placeholder.com/200x80/00f2fe/ffffff?text=Partner+5" alt="Partner 5" link="https://example.com"]
[logo_item image="https://via.placeholder.com/200x80/43e97b/ffffff?text=Partner+6" alt="Partner 6" link="https://example.com"]
[/logo_carousel]
<!-- /wp:shortcode -->',
));

register_block_pattern('custom-theme/logo-carousel-clients', array(
    'title'       => __('Logo Carousel - Kunden (Card Style)', 'custom-theme'),
    'description' => __('Kunden-Logos im Card-Design', 'custom-theme'),
    'categories'  => array('custom-components'),
    'content'     => '<!-- wp:heading {"textAlign":"center"} -->
<h2 class="has-text-align-center">Unsere Kunden</h2>
<!-- /wp:heading -->

<!-- wp:shortcode -->
[logo_carousel autoplay="true" speed="4000" style="card" grayscale="true"]
[logo_item image="https://via.placeholder.com/200x80/667eea/ffffff?text=Client+1" alt="Kunde 1"]
[logo_item image="https://via.placeholder.com/200x80/764ba2/ffffff?text=Client+2" alt="Kunde 2"]
[logo_item image="https://via.placeholder.com/200x80/f093fb/ffffff?text=Client+3" alt="Kunde 3"]
[logo_item image="https://via.placeholder.com/200x80/4facfe/ffffff?text=Client+4" alt="Kunde 4"]
[logo_item image="https://via.placeholder.com/200x80/00f2fe/ffffff?text=Client+5" alt="Kunde 5"]
[/logo_carousel]
<!-- /wp:shortcode -->',
));

register_block_pattern('custom-theme/logo-carousel-sponsors', array(
    'title'       => __('Logo Carousel - Sponsoren (Color)', 'custom-theme'),
    'description' => __('Sponsoren-Logos in Farbe', 'custom-theme'),
    'categories'  => array('custom-components'),
    'content'     => '<!-- wp:heading {"textAlign":"center"} -->
<h2 class="has-text-align-center">Unsere Sponsoren</h2>
<!-- /wp:heading -->

<!-- wp:shortcode -->
[logo_carousel autoplay="true" speed="2500" grayscale="false" slides_per_view="4"]
[logo_item image="https://via.placeholder.com/200x80/667eea/ffffff?text=Sponsor+1" alt="Sponsor 1" link="https://example.com"]
[logo_item image="https://via.placeholder.com/200x80/764ba2/ffffff?text=Sponsor+2" alt="Sponsor 2" link="https://example.com"]
[logo_item image="https://via.placeholder.com/200x80/f093fb/ffffff?text=Sponsor+3" alt="Sponsor 3" link="https://example.com"]
[logo_item image="https://via.placeholder.com/200x80/4facfe/ffffff?text=Sponsor+4" alt="Sponsor 4" link="https://example.com"]
[/logo_carousel]
<!-- /wp:shortcode -->',
));

// Team Cards Patterns
register_block_pattern('custom-theme/team-cards-leadership', array(
    'title'       => __('Team Cards - Leadership', 'custom-theme'),
    'description' => __('Führungsteam mit 3 Mitgliedern', 'custom-theme'),
    'categories'  => array('custom-components'),
    'content'     => '<!-- wp:heading {"textAlign":"center"} -->
<h2 class="has-text-align-center">Unser Führungsteam</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Lernen Sie die Menschen kennen, die unser Unternehmen leiten</p>
<!-- /wp:paragraph -->

<!-- wp:shortcode -->
[team_cards columns="3" style="default"]
[team_member name="Max Mustermann" role="CEO & Gründer" image="https://i.pravatar.cc/400?img=12" email="max@example.com" linkedin="https://linkedin.com" phone="+49 123 456789"]
Mit über 15 Jahren Erfahrung in der Tech-Branche führt Max unser Unternehmen in eine innovative Zukunft.
[/team_member]
[team_member name="Anna Schmidt" role="Chief Technology Officer" image="https://i.pravatar.cc/400?img=5" email="anna@example.com" linkedin="https://linkedin.com"]
Anna ist verantwortlich für unsere technische Strategie und leitet unser 20-köpfiges Entwicklerteam.
[/team_member]
[team_member name="Peter Müller" role="Head of Design" image="https://i.pravatar.cc/400?img=15" email="peter@example.com" twitter="https://twitter.com" instagram="https://instagram.com"]
Peter bringt kreative Visionen zum Leben und sorgt für außergewöhnliche User Experience.
[/team_member]
[/team_cards]
<!-- /wp:shortcode -->',
));

register_block_pattern('custom-theme/team-cards-full-team', array(
    'title'       => __('Team Cards - Vollständiges Team (4 Spalten)', 'custom-theme'),
    'description' => __('Großes Team im Card-Style', 'custom-theme'),
    'categories'  => array('custom-components'),
    'content'     => '<!-- wp:heading {"textAlign":"center"} -->
<h2 class="has-text-align-center">Unser Team</h2>
<!-- /wp:heading -->

<!-- wp:shortcode -->
[team_cards columns="4" style="card"]
[team_member name="Sarah Weber" role="Marketing Manager" image="https://i.pravatar.cc/400?img=9" email="sarah@example.com" linkedin="https://linkedin.com"]
Expertin für digitales Marketing und Brand Strategy.
[/team_member]
[team_member name="Tom Klein" role="Senior Developer" image="https://i.pravatar.cc/400?img=33" email="tom@example.com" linkedin="https://linkedin.com"]
Full-Stack Entwickler mit Fokus auf React und Node.js.
[/team_member]
[team_member name="Lisa Hoffmann" role="UX Designer" image="https://i.pravatar.cc/400?img=25" email="lisa@example.com" instagram="https://instagram.com"]
Spezialisiert auf User Research und Interface Design.
[/team_member]
[team_member name="Michael Wagner" role="Project Manager" image="https://i.pravatar.cc/400?img=68" email="michael@example.com" linkedin="https://linkedin.com"]
Agile Coach und erfahrener Projektleiter.
[/team_member]
[/team_cards]
<!-- /wp:shortcode -->',
));

register_block_pattern('custom-theme/team-cards-minimal', array(
    'title'       => __('Team Cards - Minimal (Rund)', 'custom-theme'),
    'description' => __('Minimalistisches Team-Layout mit runden Bildern', 'custom-theme'),
    'categories'  => array('custom-components'),
    'content'     => '<!-- wp:heading {"textAlign":"center"} -->
<h2 class="has-text-align-center">Meet the Team</h2>
<!-- /wp:heading -->

<!-- wp:shortcode -->
[team_cards columns="4" style="minimal"]
[team_member name="Julia Becker" role="Designer" image="https://i.pravatar.cc/400?img=10" linkedin="https://linkedin.com"]
[/team_member]
[team_member name="David Koch" role="Developer" image="https://i.pravatar.cc/400?img=52" linkedin="https://linkedin.com"]
[/team_member]
[team_member name="Emma Schneider" role="Consultant" image="https://i.pravatar.cc/400?img=44" linkedin="https://linkedin.com"]
[/team_member]
[team_member name="Felix Richter" role="Analyst" image="https://i.pravatar.cc/400?img=59" linkedin="https://linkedin.com"]
[/team_member]
[/team_cards]
<!-- /wp:shortcode -->',
));

register_block_pattern('custom-theme/team-cards-founders', array(
    'title'       => __('Team Cards - Gründer (2 Spalten)', 'custom-theme'),
    'description' => __('Gründer-Duo mit ausführlichen Infos', 'custom-theme'),
    'categories'  => array('custom-components'),
    'content'     => '<!-- wp:heading {"textAlign":"center"} -->
<h2 class="has-text-align-center">Unsere Gründer</h2>
<!-- /wp:heading -->

<!-- wp:shortcode -->
[team_cards columns="2" style="card"]
[team_member name="Laura Bauer" role="Co-Founder & CEO" image="https://i.pravatar.cc/400?img=20" email="laura@example.com" linkedin="https://linkedin.com" twitter="https://twitter.com" phone="+49 123 456789"]
Laura hat das Unternehmen 2020 mitgegründet und bringt über 10 Jahre Erfahrung in der Startup-Welt mit. Ihre Vision: Technologie zugänglich für alle zu machen.
[/team_member]
[team_member name="Daniel Krause" role="Co-Founder & CTO" image="https://i.pravatar.cc/400?img=33" email="daniel@example.com" linkedin="https://linkedin.com" github="https://github.com"]
Daniel ist der technische Kopf hinter unserem Produkt. Als erfahrener Software-Architekt hat er mehrere erfolgreiche Projekte geleitet.
[/team_member]
[/team_cards]
<!-- /wp:shortcode -->',
));

// Video Player Patterns
register_block_pattern('custom-theme/video-player-youtube', array(
    'title'       => __('Video Player - YouTube', 'custom-theme'),
    'description' => __('YouTube Video mit Custom Thumbnail', 'custom-theme'),
    'categories'  => array('custom-components'),
    'content'     => '<!-- wp:shortcode -->
[video_player url="https://www.youtube.com/watch?v=dQw4w9WgXcQ" type="youtube" title="Demo Video" poster="https://picsum.photos/1280/720?random=1" aspect_ratio="16:9"]
Dies ist ein Beispiel-Video. Klicken Sie auf den Play-Button, um das Video zu starten.
[/video_player]
<!-- /wp:shortcode -->',
));

register_block_pattern('custom-theme/video-player-vimeo', array(
    'title'       => __('Video Player - Vimeo', 'custom-theme'),
    'description' => __('Vimeo Video Player', 'custom-theme'),
    'categories'  => array('custom-components'),
    'content'     => '<!-- wp:shortcode -->
[video_player url="https://vimeo.com/148751763" type="vimeo" title="Vimeo Demo" aspect_ratio="16:9"]
Hochwertiges Video von Vimeo.
[/video_player]
<!-- /wp:shortcode -->',
));

register_block_pattern('custom-theme/video-player-embedded', array(
    'title'       => __('Video Player - Auto-Embed', 'custom-theme'),
    'description' => __('Video ohne Thumbnail (Auto-Start)', 'custom-theme'),
    'categories'  => array('custom-components'),
    'content'     => '<!-- wp:shortcode -->
[video_player url="https://www.youtube.com/watch?v=dQw4w9WgXcQ" type="youtube" title="Embedded Video" autoplay="false" controls="true"]
[/video_player]
<!-- /wp:shortcode -->',
));

register_block_pattern('custom-theme/video-player-self-hosted', array(
    'title'       => __('Video Player - Self-Hosted', 'custom-theme'),
    'description' => __('Selbst gehostetes MP4 Video', 'custom-theme'),
    'categories'  => array('custom-components'),
    'content'     => '<!-- wp:shortcode -->
[video_player url="https://example.com/video.mp4" type="self-hosted" title="Unser Showreel" poster="https://picsum.photos/1280/720?random=5" controls="true"]
Unser neuestes Showreel zeigt unsere besten Projekte aus 2024.
[/video_player]
<!-- /wp:shortcode -->',
));

// FAQ Patterns
register_block_pattern('custom-theme/faq-general', array(
    'title'       => __('FAQ - Allgemein', 'custom-theme'),
    'description' => __('Allgemeine FAQs mit Schema.org Markup', 'custom-theme'),
    'categories'  => array('custom-components'),
    'content'     => '<!-- wp:heading {"textAlign":"center"} -->
<h2 class="has-text-align-center">Häufig gestellte Fragen</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Finden Sie Antworten auf die wichtigsten Fragen</p>
<!-- /wp:paragraph -->

<!-- wp:shortcode -->
[faq_accordion style="default" schema="true"]
[faq_item question="Wie kann ich bestellen?" open="true"]
Sie können ganz einfach über unseren Online-Shop bestellen. Wählen Sie Ihre Produkte aus, legen Sie sie in den Warenkorb und folgen Sie dem Checkout-Prozess.
[/faq_item]
[faq_item question="Welche Zahlungsmethoden akzeptieren Sie?"]
Wir akzeptieren folgende Zahlungsmethoden:
- Kreditkarten (Visa, Mastercard, American Express)
- PayPal
- Sofortüberweisung
- Rechnung (nach Prüfung)
[/faq_item]
[faq_item question="Wie lange dauert der Versand?"]
Standard-Versand dauert 3-5 Werktage innerhalb Deutschlands. Express-Versand ist innerhalb von 1-2 Werktagen möglich.
[/faq_item]
[faq_item question="Kann ich meine Bestellung zurückgeben?"]
Ja, Sie haben ein 30-tägiges Rückgaberecht ab Erhalt der Ware. Die Ware muss unbenutzt und in Originalverpackung sein.
[/faq_item]
[faq_item question="Bieten Sie internationalen Versand an?"]
Ja, wir versenden weltweit. Die Versandkosten und -zeiten variieren je nach Zielland.
[/faq_item]
[/faq_accordion]
<!-- /wp:shortcode -->',
));

register_block_pattern('custom-theme/faq-bordered', array(
    'title'       => __('FAQ - Bordered Style', 'custom-theme'),
    'description' => __('FAQ mit Rahmen-Design', 'custom-theme'),
    'categories'  => array('custom-components'),
    'content'     => '<!-- wp:heading -->
<h2>Technischer Support</h2>
<!-- /wp:heading -->

<!-- wp:shortcode -->
[faq_accordion style="bordered" schema="true"]
[faq_item question="Wie installiere ich das Produkt?" category="Installation"]
Eine detaillierte Installationsanleitung finden Sie in der mitgelieferten Dokumentation. Bei Fragen steht Ihnen unser Support-Team zur Verfügung.
[/faq_item]
[faq_item question="Welche Systemanforderungen gibt es?" category="Technisch"]
Minimale Anforderungen:
- Windows 10 oder macOS 11
- 8 GB RAM
- 500 MB freier Speicherplatz
[/faq_item]
[faq_item question="Gibt es eine kostenlose Testversion?" category="Lizenz"]
Ja, Sie können unsere Software 14 Tage kostenlos testen. Keine Kreditkarte erforderlich.
[/faq_item]
[/faq_accordion]
<!-- /wp:shortcode -->',
));

register_block_pattern('custom-theme/faq-minimal', array(
    'title'       => __('FAQ - Minimal Style', 'custom-theme'),
    'description' => __('Minimalistisches FAQ-Design', 'custom-theme'),
    'categories'  => array('custom-components'),
    'content'     => '<!-- wp:shortcode -->
[faq_accordion style="minimal" allow_multiple="true"]
[faq_item question="Was ist im Preis enthalten?"]
Der Preis beinhaltet alle Grundfunktionen, kostenlosen Support und regelmäßige Updates.
[/faq_item]
[faq_item question="Kann ich jederzeit kündigen?"]
Ja, Sie können monatlich kündigen. Es gibt keine versteckten Gebühren oder Kündigungsfristen.
[/faq_item]
[faq_item question="Gibt es Mengenrabatte?"]
Ja, ab 5 Lizenzen bieten wir gestaffelte Rabatte an. Kontaktieren Sie uns für ein individuelles Angebot.
[/faq_item]
[/faq_accordion]
<!-- /wp:shortcode -->',
));

register_block_pattern('custom-theme/faq-categories', array(
    'title'       => __('FAQ - Mit Kategorien', 'custom-theme'),
    'description' => __('FAQ mit Kategorie-Tags', 'custom-theme'),
    'categories'  => array('custom-components'),
    'content'     => '<!-- wp:shortcode -->
[faq_accordion style="default"]
[faq_item question="Wie erstelle ich ein Konto?" category="Erste Schritte"]
Klicken Sie auf "Registrieren" und folgen Sie den Anweisungen. Die Registrierung dauert nur wenige Minuten.
[/faq_item]
[faq_item question="Wie sichere ich meine Daten?" category="Sicherheit"]
Ihre Daten werden mit SSL-Verschlüsselung übertragen und auf sicheren Servern in Deutschland gespeichert.
[/faq_item]
[faq_item question="Kann ich meine Daten exportieren?" category="Daten"]
Ja, Sie können jederzeit alle Ihre Daten im CSV- oder JSON-Format exportieren.
[/faq_item]
[faq_item question="Wie funktioniert die Zwei-Faktor-Authentifizierung?" category="Sicherheit"]
Sie können 2FA in den Einstellungen aktivieren. Wir unterstützen Authenticator-Apps wie Google Authenticator.
[/faq_item]
[/faq_accordion]
<!-- /wp:shortcode -->',
));

// Contact Form Patterns
register_block_pattern('custom-theme/contact-form-simple', array(
    'title'       => __('Contact Form - Simple', 'custom-theme'),
    'description' => __('Einfaches Kontaktformular', 'custom-theme'),
    'categories'  => array('custom-components'),
    'content'     => '<!-- wp:heading -->
<h2>Kontaktieren Sie uns</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Haben Sie Fragen? Füllen Sie das Formular aus und wir melden uns bei Ihnen.</p>
<!-- /wp:paragraph -->

<!-- wp:shortcode -->
[contact-form-7 id="YOUR_FORM_ID"]
<!-- /wp:shortcode -->',
));

register_block_pattern('custom-theme/contact-form-card', array(
    'title'       => __('Contact Form - Card Style', 'custom-theme'),
    'description' => __('Kontaktformular im Card-Design', 'custom-theme'),
    'categories'  => array('custom-components'),
    'content'     => '<!-- wp:group {"className":"wpcf7-card"} -->
<div class="wp-block-group wpcf7-card">

<!-- wp:heading {"textAlign":"center"} -->
<h2 class="has-text-align-center">Schreiben Sie uns</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Wir freuen uns auf Ihre Nachricht!</p>
<!-- /wp:paragraph -->

<!-- wp:shortcode -->
[contact-form-7 id="YOUR_FORM_ID"]
<!-- /wp:shortcode -->

</div>
<!-- /wp:group -->',
));

register_block_pattern('custom-theme/contact-form-two-column', array(
    'title'       => __('Contact Form - Two Column Layout', 'custom-theme'),
    'description' => __('Kontaktformular mit Infos daneben', 'custom-theme'),
    'categories'  => array('custom-components'),
    'content'     => '<!-- wp:columns -->
<div class="wp-block-columns">

<!-- wp:column -->
<div class="wp-block-column">

<!-- wp:heading -->
<h2>Kontaktinformationen</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><strong>📧 E-Mail:</strong><br>info@example.com</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><strong>📞 Telefon:</strong><br>+49 123 456789</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><strong>📍 Adresse:</strong><br>Musterstraße 123<br>12345 Musterstadt</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><strong>🕐 Öffnungszeiten:</strong><br>Mo-Fr: 9:00 - 18:00 Uhr</p>
<!-- /wp:paragraph -->

</div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column">

<!-- wp:heading -->
<h2>Kontaktformular</h2>
<!-- /wp:heading -->

<!-- wp:shortcode -->
[contact-form-7 id="YOUR_FORM_ID"]
<!-- /wp:shortcode -->

</div>
<!-- /wp:column -->

</div>
<!-- /wp:columns -->',
));

register_block_pattern('custom-theme/newsletter-form', array(
    'title'       => __('Newsletter Form - Inline', 'custom-theme'),
    'description' => __('Inline Newsletter-Anmeldung', 'custom-theme'),
    'categories'  => array('custom-components'),
    'content'     => '<!-- wp:group {"className":"wpcf7-card","style":{"spacing":{"padding":{"top":"3rem","bottom":"3rem","left":"2rem","right":"2rem"}}}} -->
<div class="wp-block-group wpcf7-card" style="padding-top:3rem;padding-bottom:3rem;padding-left:2rem;padding-right:2rem">

<!-- wp:heading {"textAlign":"center"} -->
<h2 class="has-text-align-center">Newsletter abonnieren</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Bleiben Sie auf dem Laufenden mit unseren neuesten Updates</p>
<!-- /wp:paragraph -->

<!-- wp:shortcode -->
[contact-form-7 id="YOUR_FORM_ID" html_class="wpcf7-form-inline"]
<!-- /wp:shortcode -->

</div>
<!-- /wp:group -->',
));

// CPT Query Patterns
register_block_pattern('custom-theme/team-query-section', array(
    'title'       => __('Team Section (Dynamic)', 'custom-theme'),
    'description' => __('Dynamische Team-Ausgabe aus CPT', 'custom-theme'),
    'categories'  => array('custom-components'),
    'content'     => '<!-- wp:heading {"textAlign":"center"} -->
<h2 class="has-text-align-center">Unser Team</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Lernen Sie die Menschen kennen, die unser Unternehmen vorantreiben</p>
<!-- /wp:paragraph -->

<!-- wp:shortcode -->
[team_query number="6" columns="3" style="card" orderby="display_order"]
<!-- /wp:shortcode -->',
));

register_block_pattern('custom-theme/projects-query-section', array(
    'title'       => __('Projects Section (Dynamic)', 'custom-theme'),
    'description' => __('Dynamische Projekt-Ausgabe aus CPT', 'custom-theme'),
    'categories'  => array('custom-components'),
    'content'     => '<!-- wp:heading {"textAlign":"center"} -->
<h2 class="has-text-align-center">Unsere Projekte</h2>
<!-- /wp:heading -->

<!-- wp:shortcode -->
[projects_query number="6" columns="3"]
<!-- /wp:shortcode -->',
));

register_block_pattern('custom-theme/testimonials-query-slider', array(
    'title'       => __('Testimonials Slider (Dynamic)', 'custom-theme'),
    'description' => __('Dynamische Testimonials als Slider', 'custom-theme'),
    'categories'  => array('custom-components'),
    'content'     => '<!-- wp:heading {"textAlign":"center"} -->
<h2 class="has-text-align-center">Was unsere Kunden sagen</h2>
<!-- /wp:heading -->

<!-- wp:shortcode -->
[testimonials_query number="5" slider="true" style="card"]
<!-- /wp:shortcode -->',
));

register_block_pattern('custom-theme/services-query-section', array(
    'title'       => __('Services Section (Dynamic)', 'custom-theme'),
    'description' => __('Dynamische Service-Ausgabe aus CPT', 'custom-theme'),
    'categories'  => array('custom-components'),
    'content'     => '<!-- wp:heading {"textAlign":"center"} -->
<h2 class="has-text-align-center">Unsere Dienstleistungen</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Entdecken Sie unser vollständiges Service-Portfolio</p>
<!-- /wp:paragraph -->

<!-- wp:shortcode -->
[services_query number="-1" columns="3"]
<!-- /wp:shortcode -->',
));