<?php
/*
Plugin Name: Recent Posts Widget Extended
Plugin URI: http://wordpress.org/extend/plugins/recent-posts-widget-extended/
Description: Enables recent posts widget with advanced settings.
Version: 0.3
Author: Marga Satrya
Author URI: http://tokokoo.com
Author Email: satrya@tokokoo.com
License: GPLv2
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'RPW_Extended' ) ) :

class RPW_Extended {

	/**
	 * PHP5 constructor method.
	 *
	 * @since 0.1
	 */
	public function __construct() {

		add_action( 'plugins_loaded', array( &$this, 'constants' ), 1 );

		add_action( 'plugins_loaded', array( &$this, 'i18n' ), 2 );

		add_action( 'plugins_loaded', array( &$this, 'includes' ), 3 );

		add_action( 'init', array( &$this, 'init' ) );

	}

	/**
	 * Defines constants used by the plugin.
	 *
	 * @since 0.1
	 */
	public function constants() {

		define( 'RPWE_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );

		define( 'RPWE_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );

		define( 'RPWE_INCLUDES', RPWE_DIR . trailingslashit( 'includes' ) );

	}

	/**
	 * Loads the translation files.
	 *
	 * @since 0.1
	 */
	public function i18n() {

		/* Load the translation of the plugin. */
		load_plugin_textdomain( 'rpwe', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

	}

	/**
	 * Loads the initial files needed by the plugin.
	 *
	 * @since 0.1
	 */
	public function includes() {

		require_once( RPWE_INCLUDES . 'widget-recent-posts-extended.php' );
	}

	/**
	 * Register custom style for the widget.
	 *
	 * @since 0.1
	 */
	function init() {
		
		if( ! is_admin() ) {

			wp_enqueue_style( 'rpwe-style', RPWE_URI . 'rpwe.css' );

		}

	}

}

new RPW_Extended;

endif;
?>