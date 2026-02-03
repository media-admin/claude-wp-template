<?php
/**
 * MU-Plugin Loader
 * 
 * Loads plugins from subdirectories in mu-plugins
 * 
 * @package CustomTheme
 */

if (!defined('ABSPATH')) {
    exit;
}

// Load custom-functionality plugin
$custom_func_file = WPMU_PLUGIN_DIR . '/custom-functionality/custom-functionality.php';
if (file_exists($custom_func_file)) {
    require_once $custom_func_file;
}

// Load custom-blocks plugin (Shortcodes)
$custom_blocks_file = WPMU_PLUGIN_DIR . '/custom-blocks/custom-blocks.php';
if (file_exists($custom_blocks_file)) {
    require_once $custom_blocks_file;
}