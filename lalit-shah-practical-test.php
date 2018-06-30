<?php

/**
 * Plugin Name: Lalit Shah - Practical Test
 * Description: Practical Test for Lalit Shah
 * Version: 1.0.0
 * Author: Lalit Shah
 * Text Domain: lspt
 * Domain Path: languages
 * 
 * @package Lalit Shah - Practical Test
 * @category Core
 * @author Lalit Shah
 */
// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;

/**
 * Basic plugin definitions
 * 
 * @package Lalit Shah - Practical Test
 * @since 1.0.0
 */
if (!defined('LSPT_PLUGIN_VERSION')) {
    define('LSPT_PLUGIN_VERSION', '1.0.0'); //Plugin version number
}
if (!defined('LSPT_DIR')) {
    define('LSPT_DIR', dirname(__FILE__)); // plugin dir
}
if (!defined('LSPT_URL')) {
    define('LSPT_URL', plugin_dir_url(__FILE__)); // plugin url
}
if (!defined('LSPT_INC_DIR')) {
    define('LSPT_INC_DIR', LSPT_DIR . '/includes'); // Plugin include dir
}
if (!defined('LSPT_INC_URL')) {
    define('LSPT_INC_URL', LSPT_URL . 'includes'); // Plugin include url
}
if (!defined('LSPT_ADMIN_DIR')) {
    define('LSPT_ADMIN_DIR', LSPT_INC_DIR . '/admin'); // plugin admin dir
}
if (!defined('LSPT_PLUGIN_BASENAME')) {
    define('LSPT_PLUGIN_BASENAME', basename(LSPT_DIR)); //Plugin base name
}
if (!defined('LSPT_META_PREFIX')) {
    define('LSPT_META_PREFIX', '_lspt_'); // meta data box prefix
}
if( !defined( 'LSPT_POST_TYPE' ) ) {
    define( 'LSPT_POST_TYPE', 'customers' ); // custom post type voucher templates
}
if( !defined( 'LSPT_DATE_TIME_API_KEY' ) ) {
    define( 'LSPT_DATE_TIME_API_KEY', 'SL6HA690APOX' );
}
if( !defined( 'LSPT_DATE_TIME_API_URI' ) ) {
    define( 'LSPT_DATE_TIME_API_URI', 'http://api.timezonedb.com/v2/list-time-zone' );
}

//Post type to handle custom post type
require_once( LSPT_INC_DIR . '/lspt-post-type.php' );

/**
 * Activation Hook
 * 
 * Register plugin activation hook.
 * 
 * @package Lalit Shah - Practical Test
 * @since 1.0.0
 */
register_activation_hook(__FILE__, 'lspt_install');

/**
 * Plugin Setup (On Activation)
 * 
 * Does the initial setup,
 * stest default values for the plugin options.
 * 
 * @package Lalit Shah - Practical Test
 * @since 1.0.0
 */
function lspt_install() {

    global $wpdb;

    lspt_register_post_type();
}

/**
 * Deactivation Hook
 * 
 * Register plugin deactivation hook.
 * 
 * @package Lalit Shah - Practical Test
 *  @since 1.0.0
 */
register_deactivation_hook(__FILE__, 'lspt_uninstall');

/**
 * Plugin Setup (On Deactivation)
 * 
 * @package Lalit Shah - Practical Test
 * @since 1.0.0
 */
function lspt_uninstall() {

    global $wpdb;
}

/**
 * Load Text Domain
 * 
 * This gets the plugin ready for translation.
 * 
 * @package Lalit Shah - Practical Test
 * @since 1.0.0
 */
function lspt_load_text_domain() {

    // Set filter for plugin's languages directory
    $lspt_lang_dir = dirname(plugin_basename(__FILE__)) . '/languages/';
    $lspt_lang_dir = apply_filters('lspt_languages_directory', $lspt_lang_dir);

    // Traditional WordPress plugin locale filter
    $locale = apply_filters('plugin_locale', get_locale(), 'lspt');
    $mofile = sprintf('%1$s-%2$s.mo', 'lspt', $locale);

    // Setup paths to current locale file
    $mofile_local = $lspt_lang_dir . $mofile;
    $mofile_global = WP_LANG_DIR . '/' . LSPT_PLUGIN_BASENAME . '/' . $mofile;

    if (file_exists($mofile_global)) { // Look in global /wp-content/languages/wildprog-woo-cat-discount folder
        load_textdomain('lspt', $mofile_global);
    } elseif (file_exists($mofile_local)) { // Look in local /wp-content/plugins/wildprog-woo-cat-discount/languages/ folder
        load_textdomain('lspt', $mofile_local);
    } else { // Load the default language files
        load_plugin_textdomain('lspt', false, $lspt_lang_dir);
    }
}

// Add action to load plugin
add_action('plugins_loaded', 'lspt_plugin_loaded');

/**
 * Load Plugin
 * 
 * Handles to load plugin after
 * dependent plugin is loaded
 * successfully
 * 
 * @package Lalit Shah - Practical Test
 * @since 1.0.0
 */
function lspt_plugin_loaded() {

    // load first plugin text domain
    lspt_load_text_domain();
}

// Global variables
global $lspt_shortcode, $lspt_scripts, $lspt_model, $lspt_public, $lspt_admin;

//Shortcodes class for handling shortcodes
require_once( LSPT_INC_DIR . '/class-lspt-shortcodes.php' );
$lspt_shortcode = new LSPT_Shortcodes();
$lspt_shortcode->add_hooks();

// Script class handles most of script functionalitiC:\Users\PC-19\Downloadses of plugin
include_once(LSPT_INC_DIR . '/class-lspt-scripts.php');
$lspt_scripts = new LSPT_Scripts();
$lspt_scripts->add_hooks();

// Model class handles most of model functionalities of plugin
include_once(LSPT_INC_DIR . '/class-lspt-model.php');
$lspt_model = new LSPT_Model();

include_once(LSPT_INC_DIR . '/class-lspt-public.php');
$lspt_public = new LSPT_Public();
$lspt_public->add_hooks();

// Admin class handles most of admin panel functionalities of plugin
include_once(LSPT_ADMIN_DIR . '/class-lspt-admin.php');
$lspt_admin = new LSPT_Admin();
$lspt_admin->add_hooks();

?>