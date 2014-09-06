<?php
/**
 * Custom style for the plugin front-end.
 *
 * @package    Recent_Posts_Widget_Extended
 * @since      0.9.4
 * @author     Satrya
 * @copyright  Copyright (c) 2014, Satrya
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 */

/**
 * Custom style.
 *
 * @since  0.9.4
 */
function rpwe_style( $args = array() ) {

	// Merge the input arguments and the defaults.
	$args = wp_parse_args( $args, rpwe_get_default_args() );

	// Extract the array to allow easy use of variables.
	extract( $args );

	// Display the default style of the plugin.
	if ( $args['styles_default'] == true ) {
		rpwe_custom_styles();
	}

	// If the default style are disable then use the custom css.
	if ( $args['styles_default'] == false && ! empty( $args['css'] ) ) {
		echo '<style>' . $args['css'] . '</style>';
	}
	
}
add_action( 'rpwe_before_loop', 'rpwe_style', 1 );

/**
 * Custom Styles.
 *
 * @since  0.8
 */
function rpwe_custom_styles() {
	?>
<style>
.rpwe-block ul{list-style:none!important;margin-left:0!important;padding-left:0!important;}.rpwe-block li{border-bottom:1px solid #eee;margin-bottom:10px;padding-bottom:10px;list-style-type: none;}.rpwe-block a{display:inline!important;text-decoration:none;}.rpwe-block h3{background:none!important;clear:none;margin-bottom:0!important;margin-top:0!important;font-weight:400;font-size:12px!important;line-height:1.5em;}.rpwe-thumb{border:1px solid #EEE!important;box-shadow:none!important;margin:2px 10px 2px 0;padding:3px!important;}.rpwe-summary{font-size:12px;}.rpwe-time{color:#bbb;font-size:11px;}.rpwe-alignleft{display:inline;float:left;}.rpwe-alignright{display:inline;float:right;}.rpwe-aligncenter{display:block;margin-left: auto;margin-right: auto;}.rpwe-clearfix:before,.rpwe-clearfix:after{content:"";display:table !important;}.rpwe-clearfix:after{clear:both;}.rpwe-clearfix{zoom:1;}
</style>
	<?php
}
