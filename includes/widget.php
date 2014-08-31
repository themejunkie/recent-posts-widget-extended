<?php
/**
 * The custom recent posts widget. 
 * This widget gives total control over the output to the user.
 *
 * @package    Recent_Posts_Widget_Extended
 * @since      0.1
 * @author     Satrya
 * @copyright  Copyright (c) 2014, Satrya
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 */
class Recent_Posts_Widget_Extended extends WP_Widget {

	/**
	 * Sets up the widgets.
	 *
	 * @since 0.1
	 */
	function __construct() {

		// Set up the widget options.
		$widget_options = array(
			'classname'   => 'rpwe_widget recent-posts-extended',
			'description' => __( 'An advanced widget that gives you total control over the output of your site’s most recent Posts.', 'rpwe' )
		);

		$control_options = array(
			'width'  => 500,
			'height' => 350
		);

		// Create the widget.
		$this->WP_Widget(
			'rpwe_widget',                         // $this->id_base
			__( 'Recent Posts Extended', 'rpwe' ), // $this->name
			$widget_options,                       // $this->widget_options
			$control_options                       // $this->control_options
		);

	}

	/**
	 * Outputs the widget based on the arguments input through the widget controls.
	 *
	 * @since 0.1
	 */
	function widget( $args, $instance ) {
		extract( $args );

		// Output the theme's $before_widget wrapper.
		echo $before_widget;

		// The title filter.
		$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );

		// If both title and title url are not empty.
		if ( ! empty( $instance['title_url'] ) && ! empty( $instance['title'] ) ) {
			echo $before_title . '<a href="' . esc_url( $instance['title_url'] ) . '" title="' . esc_attr( $instance['title'] ) . '">' . $title . '</a>' . $after_title;
		// If just the title are not empty.
		} elseif ( ! empty( $instance['title'] ) ) {
			echo $before_title . $title . $after_title;
		}

		// Get the posts.
		echo rpwe_get_posts( $instance );

		// Close the theme's widget wrapper.
		echo $after_widget;

	}

	/**
	 * Updates the widget control options for the particular instance of the widget.
	 *
	 * @since 0.1
	 */
	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title']          = strip_tags( $new_instance['title'] );
		$instance['title_url']      = esc_url( $new_instance['title_url'] );
		$instance['cssID']          = sanitize_html_class( $new_instance['cssID'] );
		$instance['limit']          = (int)( $new_instance['limit'] );
		$instance['offset']         = (int)( $new_instance['offset'] );
		$instance['order']          = $new_instance['order'];
		$instance['orderby']        = $new_instance['orderby'];
		$instance['excerpt']        = $new_instance['excerpt'];
		$instance['length']         = (int)( $new_instance['length'] );
		$instance['thumb']          = $new_instance['thumb'];
		$instance['thumb_height']   = (int)( $new_instance['thumb_height'] );
		$instance['thumb_width']    = (int)( $new_instance['thumb_width'] );
		$instance['thumb_default']  = esc_url( $new_instance['thumb_default'] );
		$instance['thumb_align']    = $new_instance['thumb_align'];
		$instance['cat']            = $new_instance['cat'];
		$instance['tag']            = $new_instance['tag'];
		$instance['post_type']      = $new_instance['post_type'];
		$instance['post_status']    = $new_instance['post_status'];
		$instance['date']           = $new_instance['date'];
		$instance['readmore']       = $new_instance['readmore'];
		$instance['readmore_text']  = strip_tags( $new_instance['readmore_text'] );
		$instance['styles_default'] = $new_instance['styles_default'];
		$instance['css']            = wp_filter_nohtml_kses( $new_instance['css'] );

		return $instance;

	}

	/**
	 * Displays the widget control options in the Widgets admin screen.
	 *
	 * @since 0.1
	 */
	function form( $instance ) {

		// Merge the user-selected arguments with the defaults.
		$instance = wp_parse_args( (array) $instance, rpwe_get_default_args() );

		// Extract the array to allow easy use of variables.
		extract( $instance );

		// Loads the widget form.
		include( RPWE_INCLUDES . 'widget-form.php' );

	}

}