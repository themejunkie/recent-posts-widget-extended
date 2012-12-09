<?php

// Exit if accessed directly
if ( !defined('ABSPATH') ) exit;

class rpwe_widget extends WP_Widget {

	/**
	 * Widget setup
	 */
	function rpwe_widget() {
	
		$widget_ops = array( 
			'classname' => 'rpwe_widget', 
			'description' => __( 'Advanced recent posts widget.', 'rpwe' ) 
		);

		$control_ops = array( 
			'width' => 300, 
			'height' => 350, 
			'id_base' => 'rpwe_widget' 
		);

		$this->WP_Widget( 'rpwe_widget', __( '&raquo; Recent Posts Widget Extended', 'rpwe' ), $widget_ops, $control_ops );

	}

	/**
	 * Display widget
	 */
	function widget( $args, $instance ) {
		extract( $args, EXTR_SKIP );
 
		$title = apply_filters( 'widget_title', $instance['title'] );
		$limit = $instance['limit'];
		$excerpt = $instance['excerpt'];
		$length = (int)( $instance['length'] );
		$thumb = $instance['thumb'];
		$thumb_height = (int)( $instance['thumb_height'] );
		$thumb_width = (int)( $instance['thumb_width'] );
		$cat = $instance['cat'];
		$post_type = $instance['post_type']; 

		echo $before_widget;
 
		if (!empty( $title ))
			echo $before_title . $title . $after_title;
		
		global $post;

		if ( false === ( $rpwewidget = get_transient( 'rpwewidget_' . $widget_id ) ) ) {

			$args = array( 
				'numberposts' => $limit,
				'cat' => $cat,
				'post_type' => $post_type
			);

		    $rpwewidget = get_posts( $args );

		    set_transient( 'rpwewidget_' . $widget_id, $rpwewidget, 60*60*12 );

		} ?>

		<div class="rpwe-block">
			
			<ul>

				<?php foreach( $rpwewidget as $post ) :	setup_postdata( $post ); ?>

					<li class="rpwe-clearfix">
							
						<a href="<?php esc_url( the_permalink() ); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'rpwe' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
							<?php if( has_post_thumbnail() && $thumb == true ) the_post_thumbnail( array( $thumb_height, $thumb_width ), array( 'class' => 'rpwe-alignleft', 'alt' => get_the_title(), 'title' => get_the_title() ) ); ?>
							<h3 class="rpwe-title"><?php esc_attr( the_title() ); ?></h3>
						</a>

						<?php if( $excerpt == true ) {  ?>
							<div class="rpwe-summary"><?php echo rpwe_excerpt( $length ); ?></div>
						<?php } ?>

					</li>

				<?php endforeach; ?>

			</ul>

		</div><!-- .rpwe-block - http://wordpress.org/extend/plugins/recent-posts-widget-extended/ -->

		<?php

		echo $after_widget;
		
	}

	/**
	 * Update widget
	 */
	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title'] = esc_attr( $new_instance['title'] );
		$instance['limit'] = $new_instance['limit'];
		$instance['excerpt'] = $new_instance['excerpt'];
		$instance['length'] = (int)( $new_instance['length'] );
		$instance['thumb'] = $new_instance['thumb'];
		$instance['thumb_height'] = (int)( $new_instance['thumb_height'] );
		$instance['thumb_width'] = (int)( $new_instance['thumb_width'] );
		$instance['cat'] = $new_instance['cat'];
		$instance['post_type'] = $new_instance['post_type'];

		delete_transient( 'rpwewidget_' . $this->id );

		return $instance;

	}

	/**
	 * Widget setting
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
        $defaults = array(
            'title' => '',
            'limit' => 5,
            'excerpt' => '',
            'length' => 20,
            'thumb' => true,
            'thumb_height' => 45,
            'thumb_width' => 45,
            'cat' => '',
            'post_type' => ''
        );
        
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title = esc_attr( $instance['title'] );
		$limit = $instance['limit'];
		$excerpt = $instance['excerpt'];
		$length = (int)($instance['length']);
		$thumb = $instance['thumb'];
		$thumb_height = (int)( $instance['thumb_height'] );
		$thumb_width = (int)( $instance['thumb_width'] );
		$cat = $instance['cat'];
		$post_type = $instance['post_type'];

	?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'rpwe' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>"><?php _e( 'Limit:', 'rpwe' ); ?></label>
			<select class="widefat" name="<?php echo $this->get_field_name( 'limit' ); ?>" id="<?php echo $this->get_field_id( 'limit' ); ?>">
				<?php for ( $i=1; $i<=20; $i++ ) { ?>
					<option <?php selected( $limit, $i ) ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
				<?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'excerpt' ) ); ?>"><?php _e( 'Display excerpt?', 'rpwe' ); ?></label>
	      	<input id="<?php echo $this->get_field_id( 'excerpt' ); ?>" name="<?php echo $this->get_field_name( 'excerpt' ); ?>" type="checkbox" value="1" <?php checked( '1', $excerpt ); ?> />&nbsp;
        </p>
        <p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'length' ) ); ?>"><?php _e( 'Excerpt length:', 'rpwe' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'length' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'length' ) ); ?>" type="text" value="<?php echo $length; ?>" />
		</p>

		<?php if( current_theme_supports( 'post-thumbnails' ) ) { ?>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'thumb' ) ); ?>"><?php _e( 'Display thumbnail?', 'rpwe' ); ?></label>
		      	<input id="<?php echo $this->get_field_id( 'thumb' ); ?>" name="<?php echo $this->get_field_name( 'thumb' ); ?>" type="checkbox" value="1" <?php checked( '1', $thumb ); ?> />&nbsp;
	        </p>
	        <p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'thumb_height' ) ); ?>"><?php _e( 'Thumbnail size (height x width):', 'rpwe' ); ?></label>
				<input id="<?php echo esc_attr( $this->get_field_id( 'thumb_height' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'thumb_height' ) ); ?>" type="text" value="<?php echo $thumb_height; ?>" />
				<input id="<?php echo esc_attr( $this->get_field_id( 'thumb_width' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'thumb_width' ) ); ?>" type="text" value="<?php echo $thumb_width; ?>" />
			</p>

		<?php } ?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'cat' ) ); ?>"><?php _e( 'Limit to category: ' , 'rpwe' ); ?></label>
			<?php wp_dropdown_categories( array( 'name' => $this->get_field_name( 'cat' ), 'show_option_all' => __( 'All categories' , 'rpwe' ), 'hide_empty' => 1, 'hierarchical' => 1, 'selected' => $cat ) ); ?>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'post_type' ) ); ?>"><?php _e( 'Choose the Post Type: ' , 'rpwe' ); ?></label>
			<?php /* pros Justin Tadlock - http://themehybrid.com/ */ ?>
			<select class="widefat" id="<?php echo $this->get_field_id( 'post_type' ); ?>" name="<?php echo $this->get_field_name( 'post_type' ); ?>">
				<?php foreach ( get_post_types( '', 'objects' ) as $post_type ) { ?>
					<option value="<?php echo esc_attr( $post_type->name ); ?>" <?php selected( $instance['post_type'], $post_type->name ); ?>><?php echo esc_html( $post_type->labels->singular_name ); ?></option>
				<?php } ?>
			</select>
		</p>
		<p>
			<span style="color: #f00;">Recent Posts Widget Extended is a project by <a href="http://tokokoo.com" target="_blank">Tokokoo</a></span>
		</p>

	<?php
	}

}

/**
 * Register widget.
 *
 * @since 0.1
 */
add_action( 'widgets_init', 'rpwe_register_widget' );
function rpwe_register_widget() {

	register_widget( 'rpwe_widget' );

}

/**
 * Print a custom excerpt.
 * http://bavotasan.com/2009/limiting-the-number-of-words-in-your-excerpt-or-content-in-wordpress/
 *
 * @since 0.1
 */
function rpwe_excerpt( $length ) {

	$excerpt = explode( ' ', get_the_excerpt(), $length );
	if ( count( $excerpt )>=$length ) {
		array_pop( $excerpt );
		$excerpt = implode( " ", $excerpt ) . '&hellip;';
	} else {
		$excerpt = implode( " ", $excerpt );
	} 
		$excerpt = preg_replace( '`\[[^\]]*\]`', '', $excerpt );

	return $excerpt;

}

?>