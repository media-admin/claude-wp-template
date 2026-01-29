<?php
/**
 * Template Name: Homepage
 *
 * @package CustomTheme
 */

get_header();
?>

<main id="primary" class="site-main">
    
    <?php
    // Hero Section
    get_template_part('template-parts/components/hero');
    ?>
    
    <!-- Features Section -->
    <section class="features section-padding">
        <div class="container">
            <header class="section-header">
                <h2>Unsere Features</h2>
                <p>Was uns auszeichnet</p>
            </header>
            
            <div class="card-grid">
                <?php
                // Beispiel mit ACF Repeater oder Manual
                $features = array(
                    array(
                        'title' => 'Feature 1',
                        'description' => 'Beschreibung Feature 1',
                        'image' => 123, // Image ID
                    ),
                    array(
                        'title' => 'Feature 2',
                        'description' => 'Beschreibung Feature 2',
                        'image' => 124,
                    ),
                );
                
                foreach ($features as $feature) :
                    get_template_part('template-parts/components/card', null, $feature);
                endforeach;
                ?>
            </div>
        </div>
    </section>
    
    <!-- CTA Section -->
    <section class="cta section-padding bg-primary">
        <div class="container text-center">
            <h2>Bereit loszulegen?</h2>
            <p>Kontaktieren Sie uns noch heute</p>
            <a href="<?php echo esc_url(home_url('/kontakt')); ?>" class="btn btn-outline">
                Jetzt Kontakt aufnehmen
            </a>
        </div>
    </section>
    
</main>

<?php
get_footer();