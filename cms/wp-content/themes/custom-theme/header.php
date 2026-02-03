<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary">
        <?php esc_html_e('Zum Inhalt springen', 'customtheme'); ?>
    </a>

    <header id="masthead" class="site-header">
    <div class="container">
        <div class="site-branding">
            <a href="<?php echo esc_url(home_url('/')); ?>">
                <?php bloginfo('name'); ?>
            </a>
        </div>
        
        <nav class="main-navigation">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container' => false,
            ));
            ?>
        </nav>
        
        <!-- Theme Toggle im Header -->
        <button data-theme-toggle aria-label="Toggle theme" class="theme-toggle theme-toggle--header">
            <span class="theme-toggle__icon theme-toggle__icon--light">☀️</span>
            <span class="theme-toggle__icon theme-toggle__icon--dark">🌙</span>
        </button>
    </div>
</header>