<?php
/**
 * Plugin Name:  Recent Posts Widget Extended
 * Plugin URI:   http://satrya.me/wordpress-plugins/recent-posts-widget-extended/
 * Description:  Enables advanced widget that gives you total control over the output of your site’s most recent Posts.
 * Version:      0.9.3
 * Author:       Satrya
 * Author URI:   http://satrya.me/
 * Author Email: satrya@satrya.me
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
 * General Public License as published by the Free Software Foundation; either version 2 of the License, 
 * or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * You should have received a copy of the GNU General Public License along with this program; if not, write 
 * to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 *
 * @package    Recent_Posts_Widget_Extended
 * @since      0.1
 * @author     Satrya
 * @copyright  Copyright (c) 2014, Satrya
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class RPW_Extended {

	/**
	 * PHP5 constructor method.
	 *
	 * @since  0.1
	 */
	public function __construct() {

		// Set the constants needed by the plugin.
		add_action( 'plugins_loaded', array( &$this, 'constants' ), 1 );

		// Internationalize the text strings used.
		add_action( 'plugins_loaded', array( &$this, 'i18n' ), 2 );

		// Load the functions files.
		add_action( 'plugins_loaded', array( &$this, 'includes' ), 3 );

		// Load the admin style and script.
		add_action( 'admin_enqueue_scripts', array( &$this, 'admin_scripts' ) );

		// Register widget.
		add_action( 'widgets_init', array( &$this, 'register_widget' ) );

	}

	/**
	 * Defines constants used by the plugin.
	 *
	 * @since  0.1
	 */
	public function constants() {

		// Set constant path to the plugin directory.
		define( 'RPWE_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );

		// Set the constant path to the plugin directory URI.
		define( 'RPWE_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );

		// Set the constant path to the includes directory.
		define( 'RPWE_INCLUDES', RPWE_DIR . trailingslashit( 'includes' ) );

		// Set the constant path to the assets directory.
		define( 'RPWE_ASSETS', RPWE_URI . trailingslashit( 'assets' ) );

	}

	/**
	 * Loads the translation files.
	 *
	 * @since  0.1
	 */
	public function i18n() {
		load_plugin_textdomain( 'rpwe', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	/**
	 * Loads the initial files needed by the plugin.
	 *
	 * @since  0.1
	 */
	public function includes() {

		// Loads the helpers function.
		require_once( RPWE_INCLUDES . 'helpers.php' );

		// Loads the custom functions.
		require_once( RPWE_INCLUDES . 'functions.php' );

		// Loads the widget.
		require_once( RPWE_INCLUDES . 'widget.php' );

	}

	/**
	 * Register custom style for the widget settings.
	 *
	 * @since  0.8
	 */
	function admin_scripts() {

		// Loads the widget style.
		wp_enqueue_style( 'rpwe-admin-style', trailingslashit( RPWE_ASSETS ) . 'css/rpwe-admin.css', null, null );

		// Loads the widget script.
		wp_enqueue_script( 'rpwe-admin-scripts', trailingslashit( RPWE_ASSETS ) . 'js/rpwe-admin.js', array( 'jquery', 'jquery-ui-tabs' ), '1.0.0', true );

	}

	/**
	 * Register the widget.
	 *
	 * @since  0.9.1
	 */
	function register_widget() {
		register_widget( 'Recent_Posts_Widget_Extended' );
	}

}

new RPW_Extended;