<?php
/**
 * Plugin Name: Agency Core
 * Plugin URI: https://your-agency.com
 * Description: Core functionality for agency websites - Custom Post Types, ACF Fields, and Shortcodes
 * Version: 1.0.0
 * Author: Your Agency
 * Author URI: https://your-agency.com
 * License: GPL v2 or later
 * Text Domain: agency-core
 */

if (!defined('ABSPATH')) {
    exit;
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
        require_once AGENCY_CORE_PATH . 'inc/ajax-search.php';
        require_once AGENCY_CORE_PATH . 'inc/ajax-load-more.php';
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
 * 
 * Returns the main instance of Agency Core
 */
function agency_core() {
    return Agency_Core::instance();
}

// Initialize Agency Core
agency_core();

/**
 * Register Google Maps Post Type
 */
function agency_core_register_maps_cpt() {
    $labels = array(
        'name'                  => _x('Maps', 'Post Type General Name', 'agency-core'),
        'singular_name'         => _x('Map', 'Post Type Singular Name', 'agency-core'),
        'menu_name'             => __('Google Maps', 'agency-core'),
        'name_admin_bar'        => __('Map', 'agency-core'),
        'all_items'             => __('All Maps', 'agency-core'),
        'add_new_item'          => __('Add New Map', 'agency-core'),
        'add_new'               => __('Add New', 'agency-core'),
        'new_item'              => __('New Map', 'agency-core'),
        'edit_item'             => __('Edit Map', 'agency-core'),
        'update_item'           => __('Update Map', 'agency-core'),
        'view_item'             => __('View Map', 'agency-core'),
        'search_items'          => __('Search Map', 'agency-core'),
        'not_found'             => __('Not found', 'agency-core'),
        'not_found_in_trash'    => __('Not found in Trash', 'agency-core'),
    );
    
    $args = array(
        'label'                 => __('Map', 'agency-core'),
        'description'           => __('Google Maps Locations', 'agency-core'),
        'labels'                => $labels,
        'supports'              => array('title'),
        'hierarchical'          => false,
        'public'                => false,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 27,
        'menu_icon'             => 'dashicons-location-alt',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => false,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
    );
    
    register_post_type('gmap', $args);
}
add_action('init', 'agency_core_register_maps_cpt', 0);