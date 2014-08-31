<?php
/**
 * Various functions used by the plugin.
 *
 * @package    Recent_Posts_Widget_Extended
 * @since      0.9.3
 * @author     Satrya
 * @copyright  Copyright (c) 2014, Satrya
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 */

/**
 * The posts query
 *
 * @since  0.9.3
 * @param  array  $args
 * @return string|array The HTML for the posts.
 */
function rpwe_get_posts( $args = array() ) {
	global $post;

	// Set up a default, empty $html variable.
	$html = '';

	// Get the default arguments.
	$defaults = rpwe_get_default_args();

	// Merge the input arguments and the defaults.
	$args = wp_parse_args( $args, $defaults );

	// Extract the array to allow easy use of variables.
	extract( $args );

	// Allow devs to hook in stuff before the loop.
	do_action( 'rpwe_before_loop' );
	
	// Get the posts query.
	$posts = rpwe_posts_query( $args );
	
	// CSS ID
	$css_id = ( ! empty( $args['cssID'] ) ) ? 'id="' . sanitize_html_class( $args['cssID'] ) . '"' : '';

	if ( $posts ) :

		$html = '<div ' . $css_id . ' class="rpwe-block">';

			$html .= '<' . $args['list_style'] . ' class="rpwe-ul">';

			foreach( $posts as $post ) :
				setup_postdata( $post );

				// Generate the posts list.
				$html .= '<li>' . get_the_title() . '</li>';

			endforeach;
			
			$html.= '</' . $args['list_style'] . '>';

		$html .= '</div><!-- .rpwe-block - http://wordpress.org/plugins/recent-posts-widget-extended/ -->';

	endif;

	// Restore original Post Data.
	wp_reset_postdata();

	// Allow devs to hook in stuff after the loop.
	do_action( 'rpwe_after_loop' );
	
	// Display the posts.
	if ( isset( $html ) ) {
		return $args['before'] . $html . $args['after'];
	}

}

/**
 * The posts query
 *
 * @since  0.9.3
 * @param  array  $args
 * @return array
 */
function rpwe_posts_query( $args = array() ) {
	global $post;

	// Query arguments.
	$query = array(
		'posts_per_page'   => $args['limit'],
		'post_type'        => $args['post_type'],
		'post_status'      => $args['post_status'],
		'offset'           => $args['offset'],
		'order'            => $args['order'],
		'orderby'          => $args['orderby'],
		'suppress_filters' => $args['suppress_filters'] // Set it to false to allow WPML modifying the query.
	);

	// Allow developer to filter the query.
	$query = apply_filters( 'rpwe_default_query_arguments', $query );

	// Perform the query.
	$posts = get_posts( $query );

	return $posts;

}