<?php
/**
 * Plugin Name: Media Lab Core Plugin
 * Plugin URI: https://www.media-lab.at
 * Description: Core functionality for agency websites - Custom Post Types, ACF Fields, and Shortcodes
 * Version: 1.0.0
 * Author: Media Lab Tritremmel GmbH
 * Author URI: https://www.media-lab.at
 * License: GPL v2 or later
 * Text Domain: agency-core
 * 
 * This plugin provides core business functionality that persists across theme changes.
 * Separates business logic from presentation layer.
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Define plugin constants
define('AGENCY_CORE_VERSION', '1.0.0');
define('AGENCY_CORE_PATH', plugin_dir_path(__FILE__));
define('AGENCY_CORE_URL', plugin_dir_url(__FILE__));
define('AGENCY_CORE_FILE', __FILE__);

/**
 * Main Agency Core Class
 */
class Agency_Core {
    
    /**
     * Single instance
     */
    private static $instance = null;
    
    /**
     * Get instance
     */
    public static function instance() {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /**
     * Constructor
     */
    private function __construct() {
        $this->includes();
        $this->init_hooks();
    }
    
    /**
     * Include required files
     */
    private function includes() {
        require_once AGENCY_CORE_PATH . 'inc/custom-post-types.php';
        require_once AGENCY_CORE_PATH . 'inc/acf-fields.php';
        require_once AGENCY_CORE_PATH . 'inc/shortcodes.php';
        require_once AGENCY_CORE_PATH . 'inc/admin.php';
    }
    
    /**
     * Initialize hooks
     */
    private function init_hooks() {
        add_action('init', array($this, 'load_textdomain'));
        add_action('admin_notices', array($this, 'check_dependencies'));
    }
    
    /**
     * Load plugin textdomain
     */
    public function load_textdomain() {
        load_plugin_textdomain('agency-core', false, dirname(plugin_basename(__FILE__)) . '/languages/');
    }
    
    /**
     * Check for required dependencies
     */
    public function check_dependencies() {
        // Check for ACF
        if (!class_exists('ACF')) {
            echo '<div class="notice notice-warning"><p><strong>Agency Core:</strong> Advanced Custom Fields plugin is recommended for full functionality.</p></div>';
        }
    }
    
    /**
     * Get plugin version
     */
    public function get_version() {
        return AGENCY_CORE_VERSION;
    }
}

/**
 * Initialize the plugin
 */
function agency_core() {
    return Agency_Core::instance();
}

// Start the plugin
agency_core();

/**
 * Activation hook
 */
register_activation_hook(__FILE__, function() {
    // Flush rewrite rules on activation
    flush_rewrite_rules();
    
    // Set activation flag
    set_transient('agency_core_activated', true, 30);
});

/**
 * Deactivation hook
 */
register_deactivation_hook(__FILE__, function() {
    // Flush rewrite rules on deactivation
    flush_rewrite_rules();
});

/**
 * Activation notice
 */
add_action('admin_notices', function() {
    if (get_transient('agency_core_activated')) {
        delete_transient('agency_core_activated');
        echo '<div class="notice notice-success is-dismissible"><p><strong>Agency Core</strong> activated successfully!</p></div>';
    }
});