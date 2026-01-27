<?php
/**
 * Custom Theme Functions
 * 
 * @package CustomTheme
 * @since 1.0.0
 */

if (!defined('ABSPATH')) exit;

// Theme Constants
define('CUSTOMTHEME_VERSION', '1.0.0');
define('CUSTOMTHEME_DIR', get_template_directory());
define('CUSTOMTHEME_URI', get_template_directory_uri());
define('CUSTOMTHEME_ASSETS', CUSTOMTHEME_URI . '/assets/dist');

// Require Theme Files
require_once CUSTOMTHEME_DIR . '/inc/setup.php';
require_once CUSTOMTHEME_DIR . '/inc/enqueue.php';
require_once CUSTOMTHEME_DIR . '/inc/helpers.php';