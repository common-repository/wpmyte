<?php
/**
 * The main file of the Schema Glue for Yoast & The Events Calendar by WP Munich plugin
 *
 * @package wpmyte
 * @version 1.2.0
 *
 * Plugin Name: Schema Glue for Yoast & The Events Calendar by WP Munich
 * Plugin URI: 
 * Description: This plugin disables the schema output of the The Events Calendar plugin and injects it into the Yoast SEO generated schema.
 * Author: WP Munich
 * Author URI: https://www.wp-munich.com
 * Version: 1.2.0
 * Text Domain: wpmyte
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! defined( 'WPMYTE_PLUGIN_SLUG' ) ) {
	define( 'WPMYTE_PLUGIN_SLUG', 'wpmyte' );
}

if ( ! defined( 'WPMYTE_PLUGIN_VERSION' ) ) {
	define( 'WPMYTE_PLUGIN_VERSION', '1.2.0' );
}

if ( ! defined( 'WPMYTE_PLUGIN_NAME' ) ) {
	define( 'WPMYTE_PLUGIN_NAME', __( 'Schema Glue for Yoast & The Events Calendar by WP Munich', 'wpmyte' ) );
}

if ( ! defined( 'WPMYTE_PLUGIN_URL' ) ) {
	define( 'WPMYTE_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'WPMYTE_PLUGIN_PATH' ) ) {
	define( 'WPMYTE_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
}

/**
 * Custom autoloader function for plugin classes.
 * Autoloader and architecture below heavily inspired by WP Rig.
 * Thank you guys for your awesome work!
 *
 * Changes were made to fit the boilerplates needs (e.g. change namespaces and function names).
 *
 * @access private
 * @see https://github.com/wprig/wprig
 * @param string $class_name Class name to load.
 * @return bool True if the class was loaded, false otherwise.
 */
function wpmyte_autoload( $class_name ) {
	$namespace = 'wpmyte';

	if ( strpos( $class_name, $namespace . '\\' ) !== 0 ) {
		return false;
	}

	$parts = explode( '\\', substr( $class_name, strlen( $namespace . '\\' ) ) );
	$path  = WPMYTE_PLUGIN_PATH . 'inc';

	foreach ( $parts as $part ) {
		$path .= '/' . $part;
	}

	$path .= '.php';

	if ( ! file_exists( $path ) ) {
		return false;

	}

	require_once $path;

	return true;
}
spl_autoload_register( 'wpmyte_autoload' );

// Load the `wp_wpmyte()` entry point function.
require WPMYTE_PLUGIN_PATH . 'inc/functions.php';

// Initialize the plugin.
call_user_func( 'wpmyte\wp_wpmyte' );
