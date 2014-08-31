<?php
/**
 * Widget form.
 *
 * @package    Recent_Posts_Widget_Extended
 * @since      0.9.3
 * @author     Satrya
 * @copyright  Copyright (c) 2014, Satrya
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 */
?>

<div class="rpwe-widget-content">
	
	<div class="rpwetabs cl" id="<?php echo $this->get_field_id( 'rpwetabs' ); ?>">
		
		<ul class="rpwe-tabs-nav" id="<?php echo $this->get_field_id( 'rpwetabs-nav' ); ?>">
			<li><a href="#<?php echo $this->get_field_id( 'general' ); ?>"><?php _e( 'General', 'rpwe' ); ?></a></li>
			<li><a href="#<?php echo $this->get_field_id( 'posts' ); ?>"><?php _e( 'Posts', 'rpwe' ); ?></a></li>
			<?php if ( current_theme_supports( 'post-thumbnails' ) ) { ?>
				<li><a href="#<?php echo $this->get_field_id( 'thumbnail' ); ?>"><?php _e( 'Thumbnail', 'rpwe' ); ?></a></li>
			<?php } ?>
			<li><a href="#<?php echo $this->get_field_id( 'excerpt' ); ?>"><?php _e( 'Excerpt', 'rpwe' ); ?></a></li>
			<li><a href="#<?php echo $this->get_field_id( 'meta' ); ?>"><?php _e( 'Post Meta', 'rpwe' ); ?></a></li>
			<li><a href="#<?php echo $this->get_field_id( 'css' ); ?>"><?php _e( 'CSS', 'rpwe' ); ?></a></li>
		</ul><!-- .rpwe-tabs-nav -->

		<div class="rpwe-tabs-content">

			<div id="<?php echo $this->get_field_id( 'general' ); ?>" class="rpwe-content tabs-panel">

				<p>
					<label for="<?php echo $this->get_field_id( 'title' ); ?>">
						<?php _e( 'Title', 'rpwe' ); ?>
					</label>
					<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
					<small class="desc"><?php _e( 'The widget title, leave it blank to disable.', 'rpwe' ); ?></small>
				</p>

				<p>
					<label for="<?php echo $this->get_field_id( 'title_url' ); ?>">
						<?php _e( 'Title URL', 'rpwe' ); ?>
					</label>
					<input class="widefat" id="<?php echo $this->get_field_id( 'title_url' ); ?>" name="<?php echo $this->get_field_name( 'title_url' ); ?>" type="text" value="<?php echo esc_url( $instance['title_url'] ); ?>" placeholder="<?php echo esc_attr( 'http://' ); ?>" />
					<small class="desc"><?php _e( 'The widget title url, you can use it to put the archive url. Leave it blank to disable.', 'rpwe' ); ?></small>
				</p>

			</div><!-- #<?php echo $this->get_field_id( 'general' ); ?> -->

			<div id="<?php echo $this->get_field_id( 'posts' ); ?>" class="rpwe-content tabs-panel">

				<p>
					<label for="<?php echo $this->get_field_id( 'limit' ); ?>">
						<?php _e( 'Limit', 'rpwe' ); ?>
					</label>
					<input class="input-sm" id="<?php echo $this->get_field_id( 'limit' ); ?>" name="<?php echo $this->get_field_name( 'limit' ); ?>" type="number" min="0" value="<?php echo (int) $instance['limit']; ?>" size="5" />
					<small class="desc"><?php _e( 'The number of posts to show.', 'rpwe' ); ?></small>
				</p>

				<p>
					<label for="<?php echo $this->get_field_id( 'offset' ); ?>">
						<?php _e( 'Offset', 'rpwe' ); ?>
					</label>
					<input class="input-sm" id="<?php echo $this->get_field_id( 'offset' ); ?>" name="<?php echo $this->get_field_name( 'offset' ); ?>" type="number" min="0" value="<?php echo (int) $instance['offset']; ?>" />
					<small class="desc"><?php _e( 'The number of posts to skip.', 'rpwe' ); ?></small>
				</p>

				<p>
					<label for="<?php echo $this->get_field_id( 'post_type' ); ?>">
						<?php _e( 'Post Type', 'rpwe' ); ?>
					</label>
					<select class="select-sm" id="<?php echo $this->get_field_id( 'post_type' ); ?>" name="<?php echo $this->get_field_name( 'post_type' ); ?>">
						<?php foreach ( get_post_types( array( 'public' => true ), 'objects' ) as $post_type ) { ?>
							<option value="<?php echo esc_attr( $post_type->name ); ?>" <?php selected( $instance['post_type'], $post_type->name ); ?>><?php echo esc_html( $post_type->labels->singular_name ); ?></option>
						<?php } ?>
					</select>
					<small class="desc"><?php _e( 'Choose which post type you want to use.', 'rpwe' ); ?></small>
				</p>

				<p>
					<label for="<?php echo $this->get_field_id( 'post_status' ); ?>">
						<?php _e( 'Post Status', 'rpwe' ); ?>
					</label>
					<select class="select-sm" id="<?php echo $this->get_field_id( 'post_status' ); ?>" name="<?php echo $this->get_field_name( 'post_status' ); ?>">
						<?php foreach ( get_available_post_statuses() as $status_value => $status_label ) { ?>
							<option value="<?php echo esc_attr( $status_value ); ?>" <?php selected( $instance['post_status'], $status_value ); ?>><?php echo esc_html( $status_label ); ?></option>
						<?php } ?>
					</select>
					<small class="desc"><?php _e( 'The posts status.', 'rpwe' ); ?></small>
				</p>

				<p>
					<label for="<?php echo $this->get_field_id( 'order' ); ?>">
						<?php _e( 'Order:', 'rpwe' ); ?>
					</label>
					<select class="select-sm" id="<?php echo $this->get_field_id( 'order' ); ?>" name="<?php echo $this->get_field_name( 'order' ); ?>">
						<?php foreach ( rpwe_get_order_args() as $order_value => $order_label ) { ?>
							<option value="<?php echo esc_attr( $order_value ); ?>" <?php selected( $instance['order'], $order_value ); ?>><?php echo esc_html( $order_label ); ?></option>
						<?php } ?>
					</select>
					<small class="desc"><?php _e( 'Ascending or descending order.', 'rpwe' ); ?></small>
				</p>

				<p>
					<label for="<?php echo $this->get_field_id( 'orderby' ); ?>">
						<?php _e( 'Orderby:', 'rpwe' ); ?>
					</label>
					<select class="select-sm" id="<?php echo $this->get_field_id( 'orderby' ); ?>" name="<?php echo $this->get_field_name( 'orderby' ); ?>">
						<?php foreach ( rpwe_get_orderby_args() as $orderby_value => $orderby_label ) { ?>
							<option value="<?php echo esc_attr( $orderby_value ); ?>" <?php selected( $instance['orderby'], $orderby_value ); ?>><?php echo esc_html( $orderby_label ); ?></option>
						<?php } ?>
					</select>
					<small class="desc"><?php _e( 'Sort retrieved posts.', 'rpwe' ); ?></small>
				</p>

			</div><!-- #<?php echo $this->get_field_id( 'posts' ); ?> -->
			
			<?php if ( current_theme_supports( 'post-thumbnails' ) ) { ?>
			<div id="<?php echo $this->get_field_id( 'thumbnail' ); ?>" class="rpwe-content tabs-panel">

				<p>
					<input id="<?php echo $this->get_field_id( 'thumb' ); ?>" name="<?php echo $this->get_field_name( 'thumb' ); ?>" type="checkbox" value="1" <?php checked( '1', $instance['thumb'] ); ?> />
					<label for="<?php echo $this->get_field_id( 'thumb' ); ?>">
						<?php _e( 'Display Thumbnail', 'rpwe' ); ?>
					</label>
				</p>

				<p>
					<label class="rpwe-block" for="<?php echo $this->get_field_id( 'thumb_height' ); ?>">
						<?php _e( 'Thumbnail (height, width, align):', 'rpwe' ); ?>
					</label>
					<input class= "small-input" id="<?php echo $this->get_field_id( 'thumb_height' ); ?>" name="<?php echo $this->get_field_name( 'thumb_height' ); ?>" type="text" value="<?php echo (int) $instance['thumb_height']; ?>"/>
					<input class="small-input" id="<?php echo $this->get_field_id( 'thumb_width' ); ?>" name="<?php echo $this->get_field_name( 'thumb_width' ); ?>" type="text" value="<?php echo (int) $instance['thumb_width']; ?>"/>
					<select class="small-input" id="<?php echo $this->get_field_id( 'thumb_align' ); ?>" name="<?php echo $this->get_field_name( 'thumb_align' ); ?>">
						<?php foreach ( rpwe_get_alignment_args() as $align_value => $align_label ) { ?>
							<option value="<?php echo esc_attr( $align_value ); ?>" <?php selected( $instance['thumb_align'], $align_value ); ?>><?php echo esc_html( $align_label ); ?></option>
						<?php } ?>
					</select>
				</p>

				<p>
					<label for="<?php echo $this->get_field_id( 'thumb_default' ); ?>">
						<?php _e( 'Default Thumbnail:', 'rpwe' ); ?>
					</label>
					<input class="widefat" id="<?php echo $this->get_field_id( 'thumb_default' ); ?>" name="<?php echo $this->get_field_name( 'thumb_default' ); ?>" type="text" value="<?php echo esc_url( $instance['thumb_default'] ); ?>"/>
					<small><?php _e( 'Leave it blank to disable.', 'rpwe' ); ?></small>
				</p>

			</div><!-- #<?php echo $this->get_field_id( 'thumbnail' ); ?> -->
			<?php } ?>

			<div id="<?php echo $this->get_field_id( 'excerpt' ); ?>" class="rpwe-content tabs-panel">
				
				<p>
					<input id="<?php echo $this->get_field_id( 'excerpt' ); ?>" name="<?php echo $this->get_field_name( 'excerpt' ); ?>" type="checkbox" value="1" <?php checked( '1', $instance['excerpt'] ); ?> />
					<label for="<?php echo $this->get_field_id( 'excerpt' ); ?>">
						<?php _e( 'Display Excerpt', 'rpwe' ); ?>
					</label>
				</p>

				<p>
					<label for="<?php echo $this->get_field_id( 'length' ); ?>">
						<?php _e( 'Excerpt Length:', 'rpwe' ); ?>
					</label>
					<input class="widefat" id="<?php echo $this->get_field_id( 'length' ); ?>" name="<?php echo $this->get_field_name( 'length' ); ?>" type="text" value="<?php echo (int) $instance['length']; ?>"/>
				</p>

				<p>
					<input id="<?php echo $this->get_field_id( 'readmore' ); ?>" name="<?php echo $this->get_field_name( 'readmore' ); ?>" type="checkbox" value="1" <?php checked( '1', $instance['readmore'] ); ?> />
					<label for="<?php echo $this->get_field_id( 'readmore' ); ?>">
						<?php _e( 'Display Readmore', 'rpwe' ); ?>
					</label>
				</p>

				<p>
					<label for="<?php echo $this->get_field_id( 'readmore_text' ); ?>">
						<?php _e( 'Readmore Text:', 'rpwe' ); ?>
					</label>
					<input class="widefat" id="<?php echo $this->get_field_id( 'readmore_text' ); ?>" name="<?php echo $this->get_field_name( 'readmore_text' ); ?>" type="text" value="<?php echo strip_tags( $instance['readmore_text'] ); ?>"/>
				</p>

			</div><!-- #<?php echo $this->get_field_id( 'excerpt' ); ?> -->

			<div id="<?php echo $this->get_field_id( 'meta' ); ?>" class="rpwe-content tabs-panel">
				<p>
					<input id="<?php echo $this->get_field_id( 'date' ); ?>" name="<?php echo $this->get_field_name( 'date' ); ?>" type="checkbox" value="1" <?php checked( '1', $instance['date'] ); ?> />
					<label for="<?php echo $this->get_field_id( 'date' ); ?>">
						<?php _e( 'Display Date', 'rpwe' ); ?>
					</label>
				</p>
			</div><!-- #<?php echo $this->get_field_id( 'meta' ); ?> -->
			
			<div id="<?php echo $this->get_field_id( 'css' ); ?>" class="rpwe-content tabs-panel">
				
				<p>
					<label for="<?php echo $this->get_field_id( 'cssID' ); ?>">
						<?php _e( 'CSS ID', 'rpwe' ); ?>
					</label>
					<input class="widefat" id="<?php echo $this->get_field_id( 'cssID' ); ?>" name="<?php echo $this->get_field_name( 'cssID' ); ?>" type="text" value="<?php echo sanitize_html_class( $instance['cssID'] ); ?>" />
					<small class="desc"><?php printf( __( 'Add a unique CSS ID, use the ID to have different style per widget area. %1$sRead more%2$s', 'rpwe' ), '<a href="http://wordpress.org/support/topic/different-styles-per-widget-area" target="_blank">', '</a>' ); ?></small>
				</p>

				<p>
					<input id="<?php echo $this->get_field_id( 'styles_default' ); ?>" name="<?php echo $this->get_field_name( 'styles_default' ); ?>" type="checkbox" value="1" <?php checked( '1', $instance['styles_default'] ); ?> />
					<label for="<?php echo $this->get_field_id( 'styles_default' ); ?>">
						<?php _e( 'Use Default Styles', 'rpwe' ); ?>
					</label>
					<small class="desc"><?php _e( 'The widget has a default style, if you want to add your custom style please disable it.', 'rpwe' ); ?></small>
				</p>

				<p>
					<label for="<?php echo $this->get_field_id( 'css' ); ?>">
						<?php _e( 'Custom CSS:', 'rpwe' ); ?>
					</label>
					<textarea class="widefat" id="<?php echo $this->get_field_id( 'css' ); ?>" name="<?php echo $this->get_field_name( 'css' ); ?>" cols="30" rows="9"><?php echo wp_filter_nohtml_kses( $instance['css'] ); ?></textarea>
					<small class="desc"><?php _e( 'If you turn off the default styles, please create your own style.', 'rpwe' ); ?></small>
				</p>

			</div><!-- #<?php echo $this->get_field_id( 'css' ); ?> -->

		</div><!-- .rpwe-tabs-content -->

	</div><!-- .rpwe-tabs -->

</div>