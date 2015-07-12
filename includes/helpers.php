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