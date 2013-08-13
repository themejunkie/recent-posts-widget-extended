<?php

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

class rpwe_widget extends WP_Widget {

	/**
	 * Widget setup
	 */
	function rpwe_widget() {

		$widget_ops = array(
			'classname'		=> 'rpwe_widget recent-posts-extended',
			'description'	=> __( 'Advanced recent posts widget.', 'rpwe' )
		);

		$control_ops = array(
			'width'		=> 800,
			'height'	=> 350,
			'id_base'	=> 'rpwe_widget'
		);

		$this->WP_Widget( 'rpwe_widget', __( '&raquo; Recent Posts Widget Extended', 'rpwe' ), $widget_ops, $control_ops );

	}

	/**
	 * Display widget
	 */
	function widget( $args, $instance ) {
		extract( $args, EXTR_SKIP );

		$title 			= apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$cssID 			= $instance['cssID'];
		$limit 			= $instance['limit'];
		$excerpt 		= $instance['excerpt'];
		$length 		= (int)( $instance['length'] );
		$thumb 			= $instance['thumb'];
		$thumb_height 	= (int)( $instance['thumb_height'] );
		$thumb_width 	= (int)( $instance['thumb_width'] );
		$cat 			= $instance['cat'];
		$post_type 		= $instance['post_type'];
		$date 			= $instance['date'];
		$style 			= $instance['style'];
		$css 			= wp_filter_nohtml_kses( $instance['css'] );

		echo $before_widget;

		if ( $css )
			echo '<style>' . $css . '</style>';

		if ( !empty( $title ) )
			echo $before_title . $title . $after_title;

		global $post;

			$args = array(
				'numberposts'	=> $limit,
				'cat'			=> $cat,
				'post_type'		=> $post_type
			);

			$default_args 		= apply_filters( 'rpwe_default_query_arguments', $args ); // Allow developer to filter the query.
			$rpwewidget 		= get_posts( $default_args );

		?>

		<div <?php echo( ! empty( $cssID ) ? 'id="' . $cssID . '"' : '' ); ?> class="rpwe-block">

			<ul class="rpwe-ul">

				<?php foreach ( $rpwewidget as $post ) : setup_postdata($post); ?>

					<li class="rpwe-clearfix clearfix cl">

						<?php if ( has_post_thumbnail() && $thumb == true ) { ?>

							<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'rpwe' ), the_title_attribute('echo=0' ) ); ?>" rel="bookmark">
								<?php
								if ( current_theme_supports( 'get-the-image' ) )
									get_the_image( array( 'meta_key' => 'Thumbnail', 'height' => $thumb_height, 'width' => $thumb_width, 'image_class' => 'rpwe-alignleft', 'link_to_post' => false ) );
								else
									the_post_thumbnail( array( $thumb_height, $thumb_width ), array( 'class' => 'rpwe-alignleft', 'alt' => esc_attr(get_the_title() ), 'title' => esc_attr( get_the_title() ) ) );
								?>
							</a>

						<?php } ?>

						<h3 class="rpwe-title">
							<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'rpwe' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
						</h3>

						<?php if ( $date == true ) { ?>
							<span class="rpwe-time"><?php echo human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) . __( ' ago', 'rpwe' ); ?></span>
						<?php } ?>

						<?php if ( $excerpt == true ) { ?>
							<div class="rpwe-summary"><?php echo rpwe_excerpt( $length ); ?></div>
						<?php } ?>

					</li>

				<?php endforeach; wp_reset_postdata(); ?>

			</ul>

		</div><!-- .rpwe-block - http://wordpress.org/extend/plugins/recent-posts-widget-extended/ -->

		<?php

		echo $after_widget;

	}

	/**
	 * Update widget
	 */
	function update( $new_instance, $old_instance ) {

		$instance 					= $old_instance;
		$instance['title'] 			= strip_tags( $new_instance['title'] );
		$instance['cssID'] 			= sanitize_html_class( $new_instance['cssID'] );
		$instance['limit'] 			= (int)( $new_instance['limit'] );
		$instance['excerpt'] 		= $new_instance['excerpt'];
		$instance['length'] 		= (int)( $new_instance['length'] );
		$instance['thumb'] 			= $new_instance['thumb'];
		$instance['thumb_height'] 	= (int)( $new_instance['thumb_height'] );
		$instance['thumb_width'] 	= (int)( $new_instance['thumb_width'] );
		$instance['cat'] 			= $new_instance['cat'];
		$instance['post_type'] 		= $new_instance['post_type'];
		$instance['date'] 			= $new_instance['date'];
		$instance['style'] 			= $new_instance['style'];
		$instance['css'] 			= wp_filter_nohtml_kses( $new_instance['css'] );

		return $instance;

	}

	/**
	 * Widget setting
	 */
	function form( $instance ) {

		$css_defaults = ".rpwe-block ul{\n}\n\n.rpwe-block li{\n}\n\n.rpwe-block a{\n}\n\n.rpwe-block h3{\n}\n\nimg.rpwe-alignleft{\n}\n\n.rpwe-summary{\n}\n\n.rpwe-time{\n}";

		/* Set up some default widget settings. */
		$defaults = array(
			'title' 		=> '',
			'cssID' 		=> '',
			'limit' 		=> 5,
			'excerpt' 		=> '',
			'length' 		=> 10,
			'thumb' 		=> true,
			'thumb_height' 	=> 45,
			'thumb_width' 	=> 45,
			'cat' 			=> '',
			'post_type' 	=> '',
			'date' 			=> true,
			'style' 		=> true,
			'css' 			=> $css_defaults
		);

		$instance 		= wp_parse_args( (array)$instance, $defaults );
		$title 			= strip_tags( $instance['title'] );
		$cssID 			= sanitize_html_class( $instance['cssID'] );
		$limit 			= (int)( $instance['limit'] );
		$excerpt 		= $instance['excerpt'];
		$length 		= (int)($instance['length']);
		$thumb 			= $instance['thumb'];
		$thumb_height 	= (int)( $instance['thumb_height'] );
		$thumb_width 	= (int)( $instance['thumb_width'] );
		$cat 			= $instance['cat'];
		$post_type 		= $instance['post_type'];
		$date 			= $instance['date'];
		$style 			= $instance['style'];
		$css 			= wp_filter_nohtml_kses( $instance['css'] );

		?>

		<div class="rpwe-columns-3">

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'rpwe' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo $title; ?>"/>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'cssID' ) ); ?>"><?php _e( 'Widget CSS ID:', 'rpwe' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('cssID')); ?>" name="<?php echo esc_attr($this->get_field_name('cssID')); ?>" type="text" value="<?php echo $cssID; ?>"/>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>"><?php _e( 'Limit:', 'rpwe' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'limit' ) ); ?>" type="text" value="<?php echo $limit; ?>"/>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'length' ) ); ?>"><?php _e( 'Excerpt Length:', 'rpwe' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'length' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'length' ) ); ?>" type="text" value="<?php echo $length; ?>"/>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'css' ) ); ?>"><?php _e( 'CSS:', 'rpwe' ); ?></label>
				<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'css' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'css' ) ); ?>" style="height:100px;"><?php echo $css; ?></textarea>
				<small><?php _e( 'Please create your own custom css for this widget if you turn off the default styles.', 'rpwe' ); ?></small>
			</p>

		</div>
		
		<div class="rpwe-columns-3">

			<?php if ( current_theme_supports( 'post-thumbnails' ) ) { ?>
				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( 'thumb_height' ) ); ?>"><?php _e( 'Thumbnail Size (height x width):', 'rpwe' ); ?></label>
					<input class= "small-input" id="<?php echo esc_attr( $this->get_field_id( 'thumb_height' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'thumb_height' ) ); ?>" type="text" value="<?php echo $thumb_height; ?>"/>
					<input class="small-input" id="<?php echo esc_attr( $this->get_field_id( 'thumb_width' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'thumb_width' ) ); ?>" type="text" value="<?php echo $thumb_width; ?>"/>
				</p>

			<?php } ?>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'cat' ) ); ?>"><?php _e( 'Limit to Category: ', 'rpwe' ); ?></label>
				<?php wp_category_checklist(); ?>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'post_type' ) ); ?>"><?php _e( 'Choose the Post Type: ', 'rpwe' ); ?></label>
				<?php /* pros Justin Tadlock - http://themehybrid.com/ */ ?>
				<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'post_type' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_type' ) ); ?>">
					<?php foreach ( get_post_types( '', 'objects' ) as $post_type ) { ?>
						<option value="<?php echo esc_attr( $post_type->name ); ?>" <?php selected( $instance['post_type'], $post_type->name ); ?>><?php echo esc_html( $post_type->labels->singular_name ); ?></option>
					<?php } ?>
				</select>
			</p>

		</div>

		<div class="rpwe-columns-3 rpwe-column-last">

			<p>
				<label class="input-checkbox" for="<?php echo esc_attr( $this->get_field_id( 'style' ) ); ?>"><?php _e( 'Use Default Style', 'rpwe' ); ?></label>
				<input id="<?php echo esc_attr( $this->get_field_id( 'style' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'style' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $style ); ?> />&nbsp;
			</p>
			<p>
				<label class="input-checkbox" for="<?php echo esc_attr( $this->get_field_id( 'thumb' ) ); ?>"><?php _e( 'Display Thumbnail?', 'rpwe' ); ?></label>
				<input id="<?php echo esc_attr( $this->get_field_id( 'thumb' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'thumb' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $thumb ); ?> />&nbsp;
			</p>
			<p>
				<label class="input-checkbox" for="<?php echo esc_attr( $this->get_field_id( 'date' ) ); ?>"><?php _e( 'Display Date?', 'rpwe' ); ?></label>
				<input id="<?php echo esc_attr( $this->get_field_id( 'date' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'date' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $date ); ?> />&nbsp;
			</p>
			<p>
				<label class="input-checkbox" for="<?php echo esc_attr( $this->get_field_id( 'excerpt' ) ); ?>"><?php _e( 'Display Excerpt?', 'rpwe' ); ?></label>
				<input id="<?php echo esc_attr( $this->get_field_id( 'excerpt' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'excerpt' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $excerpt ); ?> />&nbsp;
			</p>

		</div>

		<div class="clear"></div>

	<?php
	}

}

/**
 * Register widget.
 *
 * @since 0.1
 */
function rpwe_register_widget() {
	register_widget( 'rpwe_widget' );
}
add_action( 'widgets_init', 'rpwe_register_widget' );

/**
 * Print a custom excerpt.
 * http://bavotasan.com/2009/limiting-the-number-of-words-in-your-excerpt-or-content-in-wordpress/
 *
 * @since 0.1
 */
function rpwe_excerpt( $length ) {

	$excerpt = explode(' ', get_the_excerpt(), $length);
	if (count($excerpt) >= $length) {
		array_pop($excerpt);
		$excerpt = implode(" ", $excerpt) . '&hellip;';
	} else {
		$excerpt = implode(" ", $excerpt);
	}
	$excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);

	return $excerpt;

}

/**
 * Remove default style.
 *
 * @since 0.8
 */
// function rpwe_remove_default_style( $args ) {
// 	global $wp_registered_widgets;
// 	$var = get_option( 'widget_rpwe_widget' );
// 	print_r($wp_registered_widgets);
// }
// function rpwe_dequeue_styles( $widget, $args, $instance ) {
// 	if( $instance['style'] )
// 		echo 'test';
// }
// add_action( 'init', 'rpwe_dequeue_styles' );
?>