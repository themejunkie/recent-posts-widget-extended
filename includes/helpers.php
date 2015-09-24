<?php
/**
 * Function helper
 *
 * @package    Recent_Posts_Widget_Extended
 * @since      0.9.9.1
 * @author     Satrya
 * @copyright  Copyright (c) 2015, Satrya
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 */

/**
 * Display list of tags for widget.
 *
 * @since  0.9.9.1
 */
function rpwe_tags_list() {

	// Arguments
	$args = array(
		'number' => 99
	);

	// Allow dev to filter the arguments
	$args = apply_filters( 'rpwe_tags_list_args', $args );

	// Get the tags
	$tags = get_terms( 'post_tag', $args );

	return $tags;
}

/**
 * Display list of categories for widget.
 *
 * @since  0.9.9.1
 */
function rpwe_cats_list() {

	// Arguments
	$args = array(
		'number' => 99
	);

	// Allow dev to filter the arguments
	$args = apply_filters( 'rpwe_cats_list_args', $args );

	// Get the cats
	$cats = get_terms( 'category', $args );

	return $cats;
}

/**
 * Add 'first' and 'last' class
 *
 * @since  1.0.0
 */
function rpwe_get_first_last_class( $query = '' ) {

	// Set up empty variable.
	$class = '';

	// Get the 'first' and 'last' class.
	if ( 0 == $query->current_post ) {
		$class = 'rpwe-first ';
	} elseif ( ( $query->current_post + 1 ) == $query->post_count ) {
		$class = 'rpwe-last ';
	}

	return $class;

}