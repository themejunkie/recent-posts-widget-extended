<?php
/**
 * Plugin Name:  Recent Posts Widget Extended
 * Plugin URI:   http://wordpress.org/plugins/recent-posts-widget-extended/
 * Description:  Enables advanced widget that gives you total control over the output of your site’s most recent Posts.
 * Version:      0.9
 * Author:       Satrya
 * Author URI:   http://themephe.com/
 * Author Email: satrya@themephe.com
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
 * @author    Satrya
 * @copyright Copyright (c) 2013, Satrya & ThemePhe
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
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

		add_action( 'admin_enqueue_scripts', array( &$this, 'admin_style' ) );

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
	 * Register custom style for the widget settings.
	 *
	 * @since 0.8
	 */
	function admin_style() {
		wp_enqueue_style( 'rpwe-admin-style', RPWE_URI . 'includes/admin.css' );
	}

}

new RPW_Extended;
endif;
?>