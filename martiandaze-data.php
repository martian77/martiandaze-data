<?php

/*
Plugin Name: Martiandaze Data
Plugin URI:  http://martiandaze.net
Description: Provide data requirements.
Version:     0.0.4
Author:      Eleanor Martin
Author URI:  http://martiandaze.net
*/

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

// Define the plugin file location.
if ( ! defined( 'MD_PLUGIN_FILE' ) ) {
  define( 'MD_PLUGIN_FILE', __FILE__ );
}

// Define the translation domain.
if ( ! defined( 'MD_TRANSLATE_DOMAIN' ) ) {
  define( 'MD_TRANSLATE_DOMAIN', 'plugin-template' );
}

// Include the main plugin class.
if ( ! class_exists( 'MD\Main' ) ) {
  include_once dirname( __FILE__ ) . '/includes/main.php';
}

// Initialise the main plugin class on init.
add_action( 'init', function() {
    MD\Main::get_instance();
  }
);

/**
 * Checks module dependencies.
 *
 * @since 0.0.1
 * @return void
 */
function md_activate_plugin()
{
  $module_dependencies = [
    // Put any dependencies in here.
    // 'classname' => 'Module display title',
    // e.g. 'acf' => 'Advanced Custom Fields',
  ];

  foreach ( $module_dependencies as $classname => $title ) {
    if ( ! class_exists( $classname ) ) {
      deactivate_plugins( plugin_basename( __FILE__ ) );
      wp_die( sprintf( __( 'Please install and activate %s.', MD_TRANSLATE_DOMAIN ), $title ) );
    }
  }
}

register_activation_hook( __FILE__, 'md_activate_plugin' );

/**
 * Cleans up the database on uninstall.
 *
 * @since 0.0.2
 * @return void
 */
function md_uninstall_plugin()
{
  global $wpdb;
  $option_name = MD_PLUGIN_SHORTNAME . '_%';
  $wpdb->query( "DELETE FROM {$wpdb->prefix}options WHERE option_name LIKE '{$option_name}';");
}

register_uninstall_hook( __FILE__, 'md_uninstall_plugin' );
