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
	public function __construct() {

		/* Set up the widget options. */
		$widget_options = array(
			'classname'   => 'rpwe_widget recent-posts-extended',
			'description' => __( 'An advanced widget that gives you total control over the output of your site’s most recent Posts.', 'recent-posts-widget-extended' ),
			'customize_selective_refresh' => true
		);

		$control_options = array(
			'width'  => 750,
			'height' => 350
		);

		/* Create the widget. */
		parent::__construct(
			'rpwe_widget',                                                 // $this->id_base
			__( 'Recent Posts Extended', 'recent-posts-widget-extended' ), // $this->name
			$widget_options,                                               // $this->widget_options
			$control_options                                               // $this->control_options
		);

		$this->alt_option_name = 'rpwe_widget';

	}

	/**
	 * Outputs the widget based on the arguments input through the widget controls.
	 *
	 * @since 0.1
	 */
	public function widget( $args, $instance ) {
		extract( $args );

		$recent = rpwe_get_recent_posts( $instance );

		if ( $recent ) {

			// Output the theme's $before_widget wrapper.
			echo $before_widget;

			// If both title and title url is not empty, display it.
			if ( ! empty( $instance['title_url'] ) && ! empty( $instance['title'] ) ) {
				echo $before_title . '<a href="' . esc_url( $instance['title_url'] ) . '" title="' . esc_attr( $instance['title'] ) . '">' . apply_filters( 'widget_title',  $instance['title'], $instance, $this->id_base ) . '</a>' . $after_title;

			// If the title not empty, display it.
			} elseif ( ! empty( $instance['title'] ) ) {
				echo $before_title . apply_filters( 'widget_title',  $instance['title'], $instance, $this->id_base ) . $after_title;
			}

			// Get the recent posts query.
			echo $recent;

			// Close the theme's widget wrapper.
			echo $after_widget;

		}

	}

	/**
	 * Updates the widget control options for the particular instance of the widget.
	 *
	 * @since 0.1
	 */
	public function update( $new_instance, $old_instance ) {

		// Validate post_type submissions
		$name = get_post_types( array( 'public' => true ), 'names' );
		$types = array();
		foreach( $new_instance['post_type'] as $type ) {
			if ( in_array( $type, $name ) ) {
				$types[] = $type;
			}
		}
		if ( empty( $types ) ) {
			$types[] = 'post';
		}

		$instance                     = $old_instance;
		$instance['title']            = sanitize_text_field( $new_instance['title'] );
		$instance['title_url']        = esc_url_raw( $new_instance['title_url'] );

		$instance['ignore_sticky']    = isset( $new_instance['ignore_sticky'] ) ? (bool) $new_instance['ignore_sticky'] : 0;
		$instance['exclude_current']  = isset( $new_instance['exclude_current'] ) ? (bool) $new_instance['exclude_current'] : 0;
		$instance['limit']            = intval( $new_instance['limit'] );
		$instance['offset']           = intval( $new_instance['offset'] );
		$instance['order']            = stripslashes( $new_instance['order'] );
		$instance['orderby']          = stripslashes( $new_instance['orderby'] );
		$instance['post_type']        = $types;
		$instance['post_status']      = stripslashes( $new_instance['post_status'] );
		$instance['cat']              = $new_instance['cat'];
		$instance['tag']              = $new_instance['tag'];
		$instance['taxonomy']         = esc_attr( $new_instance['taxonomy'] );

		$instance['excerpt']          = isset( $new_instance['excerpt'] ) ? (bool) $new_instance['excerpt'] : false;
		$instance['length']           = intval( $new_instance['length'] );
		$instance['date']             = isset( $new_instance['date'] ) ? (bool) $new_instance['date'] : false;
		$instance['date_relative']    = isset( $new_instance['date_relative'] ) ? (bool) $new_instance['date_relative'] : false;
		$instance['date_modified']    = isset( $new_instance['date_modified'] ) ? (bool) $new_instance['date_modified'] : false;
		$instance['readmore']         = isset( $new_instance['readmore'] ) ? (bool) $new_instance['readmore'] : false;
		$instance['readmore_text']    = sanitize_text_field( $new_instance['readmore_text'] );
		$instance['comment_count']    = isset( $new_instance['comment_count'] ) ? (bool) $new_instance['comment_count'] : false;

		$instance['thumb']            = isset( $new_instance['thumb'] ) ? (bool) $new_instance['thumb'] : false;
		$instance['thumb_height']     = intval( $new_instance['thumb_height'] );
		$instance['thumb_width']      = intval( $new_instance['thumb_width'] );
		$instance['thumb_default']    = esc_url_raw( $new_instance['thumb_default'] );
		$instance['thumb_align']      = esc_attr( $new_instance['thumb_align'] );

		$instance['styles_default']   = isset( $new_instance['styles_default'] ) ? (bool) $new_instance['styles_default'] : false;
		$instance['cssID']            = sanitize_html_class( $new_instance['cssID'] );
		$instance['css_class']        = sanitize_html_class( $new_instance['css_class'] );
		$instance['css']              = $new_instance['css'];

		if ( current_user_can( 'unfiltered_html' ) ) {
			$instance['before'] = $new_instance['before'];
		} else {
			$instance['before'] = wp_kses_post( $new_instance['before'] );
		}

		if ( current_user_can( 'unfiltered_html' ) ) {
			$instance['after'] = $new_instance['after'];
		} else {
			$instance['after'] = wp_kses_post( $new_instance['after'] );
		}

		return $instance;

	}

	/**
	 * Displays the widget control options in the Widgets admin screen.
	 *
	 * @since 0.1
	 */
	public function form( $instance ) {

		// Merge the user-selected arguments with the defaults.
		$instance = wp_parse_args( (array) $instance, rpwe_get_default_args() );

		// Extract the array to allow easy use of variables.
		extract( $instance );

		// Loads the widget form.
		include( RPWE_INCLUDES . 'form.php' );

	}

}
