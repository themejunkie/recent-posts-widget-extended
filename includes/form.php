<?php
/**
 * Widget forms.
 *
 * @package    Recent_Posts_Widget_Extended
 * @since      0.9.4
 * @author     Satrya
 * @copyright  Copyright (c) 2014, Satrya
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 */
?>

<div class="rpwe-columns-3">

	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>">
			<?php _e( 'Title', 'recent-posts-widget-extended' ); ?>
		</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'title_url' ); ?>">
			<?php _e( 'Title URL', 'recent-posts-widget-extended' ); ?>
		</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title_url' ); ?>" name="<?php echo $this->get_field_name( 'title_url' ); ?>" type="text" value="<?php echo esc_url( $instance['title_url'] ); ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'cssID' ); ?>">
			<?php _e( 'CSS ID', 'recent-posts-widget-extended' ); ?>
		</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'cssID' ); ?>" name="<?php echo $this->get_field_name( 'cssID' ); ?>" type="text" value="<?php echo sanitize_html_class( $instance['cssID'] ); ?>"/>
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'css_class' ); ?>">
			<?php _e( 'CSS Class', 'recent-posts-widget-extended' ); ?>
		</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'css_class' ); ?>" name="<?php echo $this->get_field_name( 'css_class' ); ?>" type="text" value="<?php echo sanitize_html_class( $instance['css_class'] ); ?>"/>
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'before' ); ?>">
			<?php _e( 'HTML or text before the recent posts', 'recent-posts-widget-extended' );?>
		</label>
		<textarea class="widefat" id="<?php echo $this->get_field_id( 'before' ); ?>" name="<?php echo $this->get_field_name( 'before' ); ?>" rows="5"><?php echo htmlspecialchars( stripslashes( $instance['before'] ) ); ?></textarea>
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'after' ); ?>">
			<?php _e( 'HTML or text after the recent posts', 'recent-posts-widget-extended' );?>
		</label>
		<textarea class="widefat" id="<?php echo $this->get_field_id( 'after' ); ?>" name="<?php echo $this->get_field_name( 'after' ); ?>" rows="5"><?php echo htmlspecialchars( stripslashes( $instance['after'] ) ); ?></textarea>
	</p>

</div>

<div class="rpwe-columns-3">

	<p>
		<input class="checkbox" type="checkbox" <?php checked( $instance['ignore_sticky'], 1 ); ?> id="<?php echo $this->get_field_id( 'ignore_sticky' ); ?>" name="<?php echo $this->get_field_name( 'ignore_sticky' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'ignore_sticky' ); ?>">
			<?php _e( 'Ignore sticky posts', 'recent-posts-widget-extended' ); ?>
		</label>
	</p>

	<p>
		<input class="checkbox" type="checkbox" <?php checked( $instance['exclude_current'], 1 ); ?> id="<?php echo $this->get_field_id( 'exclude_current' ); ?>" name="<?php echo $this->get_field_name( 'exclude_current' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'exclude_current' ); ?>">
			<?php _e( 'Exclude current post', 'recent-posts-widget-extended' ); ?>
		</label>
	</p>

	<div class="rpwe-multiple-check-form">
		<label>
			<?php _e( 'Post Types', 'recent-posts-widget-extended' ); ?>
		</label>
		<ul>
			<?php foreach ( get_post_types( array( 'public' => true ), 'objects' ) as $type ) : ?>
				<li>
					<input type="checkbox" value="<?php echo esc_attr( $type->name ); ?>" id="<?php echo $this->get_field_id( 'post_type' ) . '-' . $type->name; ?>" name="<?php echo $this->get_field_name( 'post_type' ); ?>[]" <?php checked( is_array( $instance['post_type'] ) && in_array( $type->name, $instance['post_type'] ) ); ?> />
					<label for="<?php echo $this->get_field_id( 'post_type' ) . '-' . $type->name; ?>">
						<?php echo esc_html( $type->labels->name ); ?>
					</label>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>

	<p>
		<label for="<?php echo $this->get_field_id( 'post_status' ); ?>">
			<?php _e( 'Post Status', 'recent-posts-widget-extended' ); ?>
		</label>
		<select class="widefat" id="<?php echo $this->get_field_id( 'post_status' ); ?>" name="<?php echo $this->get_field_name( 'post_status' ); ?>" style="width:100%;">
			<?php foreach ( get_available_post_statuses() as $status_value => $status_label ) { ?>
				<option value="<?php echo esc_attr( $status_label ); ?>" <?php selected( $instance['post_status'], $status_label ); ?>><?php echo esc_html( ucfirst( $status_label ) ); ?></option>
			<?php } ?>
		</select>
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'order' ); ?>">
			<?php _e( 'Order', 'recent-posts-widget-extended' ); ?>
		</label>
		<select class="widefat" id="<?php echo $this->get_field_id( 'order' ); ?>" name="<?php echo $this->get_field_name( 'order' ); ?>" style="width:100%;">
			<option value="DESC" <?php selected( $instance['order'], 'DESC' ); ?>><?php _e( 'Descending', 'rpwe' ) ?></option>
			<option value="ASC" <?php selected( $instance['order'], 'ASC' ); ?>><?php _e( 'Ascending', 'rpwe' ) ?></option>
		</select>
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'orderby' ); ?>">
			<?php _e( 'Orderby', 'recent-posts-widget-extended' ); ?>
		</label>
		<select class="widefat" id="<?php echo $this->get_field_id( 'orderby' ); ?>" name="<?php echo $this->get_field_name( 'orderby' ); ?>" style="width:100%;">
			<option value="ID" <?php selected( $instance['orderby'], 'ID' ); ?>><?php _e( 'ID', 'rpwe' ) ?></option>
			<option value="author" <?php selected( $instance['orderby'], 'author' ); ?>><?php _e( 'Author', 'rpwe' ) ?></option>
			<option value="title" <?php selected( $instance['orderby'], 'title' ); ?>><?php _e( 'Title', 'rpwe' ) ?></option>
			<option value="date" <?php selected( $instance['orderby'], 'date' ); ?>><?php _e( 'Date', 'rpwe' ) ?></option>
			<option value="modified" <?php selected( $instance['orderby'], 'modified' ); ?>><?php _e( 'Modified', 'rpwe' ) ?></option>
			<option value="rand" <?php selected( $instance['orderby'], 'rand' ); ?>><?php _e( 'Random', 'rpwe' ) ?></option>
			<option value="comment_count" <?php selected( $instance['orderby'], 'comment_count' ); ?>><?php _e( 'Comment Count', 'rpwe' ) ?></option>
			<option value="menu_order" <?php selected( $instance['orderby'], 'menu_order' ); ?>><?php _e( 'Menu Order', 'rpwe' ) ?></option>
		</select>
	</p>

	<div class="rpwe-multiple-check-form">
		<label>
			<?php _e( 'Limit to Category', 'recent-posts-widget-extended' ); ?>
		</label>
		<ul>
			<?php foreach ( rpwe_cats_list() as $category ) : ?>
				<li>
					<input type="checkbox" value="<?php echo (int) $category->term_id; ?>" id="<?php echo $this->get_field_id( 'cat' ) . '-' . (int) $category->term_id; ?>" name="<?php echo $this->get_field_name( 'cat' ); ?>[]" <?php checked( is_array( $instance['cat'] ) && in_array( $category->term_id, $instance['cat'] ) ); ?> />
					<label for="<?php echo $this->get_field_id( 'cat' ) . '-' . (int) $category->term_id; ?>">
						<?php echo esc_html( $category->name ); ?>
					</label>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>

	<div class="rpwe-multiple-check-form">
		<label>
			<?php _e( 'Limit to Tag', 'recent-posts-widget-extended' ); ?>
		</label>
		<ul>
			<?php foreach ( rpwe_tags_list() as $post_tag ) : ?>
				<li>
					<input type="checkbox" value="<?php echo (int) $post_tag->term_id; ?>" id="<?php echo $this->get_field_id( 'tag' ) . '-' . (int) $post_tag->term_id; ?>" name="<?php echo $this->get_field_name( 'tag' ); ?>[]" <?php checked( is_array( $instance['tag'] ) && in_array( $post_tag->term_id, $instance['tag'] ) ); ?> />
					<label for="<?php echo $this->get_field_id( 'tag' ) . '-' . (int) $post_tag->term_id; ?>">
						<?php echo esc_html( $post_tag->name ); ?>
					</label>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>

	<p>
		<label for="<?php echo $this->get_field_id( 'taxonomy' ); ?>">
			<?php _e( 'Limit to Taxonomy', 'recent-posts-widget-extended' ); ?>
		</label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'taxonomy' ); ?>" name="<?php echo $this->get_field_name( 'taxonomy' ); ?>" value="<?php echo esc_attr( $instance['taxonomy'] ); ?>" />
		<small><?php _e( 'Ex: category=1,2,4&amp;post_tag=6,12', 'rpwe' );?><br />
		<?php _e( 'Available: ', 'rpwe' ); echo implode( ', ', get_taxonomies( array( 'public' => true ) ) ); ?></small>
	</p>

</div>

<div class="rpwe-columns-3 rpwe-column-last">

	<p>
		<label for="<?php echo $this->get_field_id( 'limit' ); ?>">
			<?php _e( 'Number of posts to show', 'recent-posts-widget-extended' ); ?>
		</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'limit' ); ?>" name="<?php echo $this->get_field_name( 'limit' ); ?>" type="number" step="1" min="-1" value="<?php echo (int)( $instance['limit'] ); ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'offset' ); ?>">
			<?php _e( 'Offset', 'recent-posts-widget-extended' ); ?>
		</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'offset' ); ?>" name="<?php echo $this->get_field_name( 'offset' ); ?>" type="number" step="1" min="0" value="<?php echo (int)( $instance['offset'] ); ?>" />
		<small><?php _e( 'The number of posts to skip', 'recent-posts-widget-extended' ); ?></small>
	</p>

	<?php if ( current_theme_supports( 'post-thumbnails' ) ) { ?>

		<p>
			<input id="<?php echo $this->get_field_id( 'thumb' ); ?>" name="<?php echo $this->get_field_name( 'thumb' ); ?>" type="checkbox" <?php checked( $instance['thumb'] ); ?> />
			<label for="<?php echo $this->get_field_id( 'thumb' ); ?>">
				<?php _e( 'Display Thumbnail', 'recent-posts-widget-extended' ); ?>
			</label>
		</p>

		<p>
			<label class="rpwe-block" for="<?php echo $this->get_field_id( 'thumb_height' ); ?>">
				<?php _e( 'Thumbnail (height,width,align)', 'recent-posts-widget-extended' ); ?>
			</label>
			<input class= "small-input" id="<?php echo $this->get_field_id( 'thumb_height' ); ?>" name="<?php echo $this->get_field_name( 'thumb_height' ); ?>" type="number" step="1" min="0" value="<?php echo (int)( $instance['thumb_height'] ); ?>" />
			<input class="small-input" id="<?php echo $this->get_field_id( 'thumb_width' ); ?>" name="<?php echo $this->get_field_name( 'thumb_width' ); ?>" type="number" step="1" min="0" value="<?php echo (int)( $instance['thumb_width'] ); ?>"/>
			<select class="small-input" id="<?php echo $this->get_field_id( 'thumb_align' ); ?>" name="<?php echo $this->get_field_name( 'thumb_align' ); ?>">
				<option value="rpwe-alignleft" <?php selected( $instance['thumb_align'], 'rpwe-alignleft' ); ?>><?php _e( 'Left', 'recent-posts-widget-extended' ) ?></option>
				<option value="rpwe-alignright" <?php selected( $instance['thumb_align'], 'rpwe-alignright' ); ?>><?php _e( 'Right', 'recent-posts-widget-extended' ) ?></option>
				<option value="rpwe-aligncenter" <?php selected( $instance['thumb_align'], 'rpwe-aligncenter' ); ?>><?php _e( 'Center', 'recent-posts-widget-extended' ) ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'thumb_default' ); ?>">
				<?php _e( 'Default Thumbnail', 'recent-posts-widget-extended' ); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'thumb_default' ); ?>" name="<?php echo $this->get_field_name( 'thumb_default' ); ?>" type="text" value="<?php echo $instance['thumb_default']; ?>"/>
			<small><?php _e( 'Leave it blank to disable.', 'recent-posts-widget-extended' ); ?></small>
		</p>

	<?php } ?>

	<p>
		<input id="<?php echo $this->get_field_id( 'excerpt' ); ?>" name="<?php echo $this->get_field_name( 'excerpt' ); ?>" type="checkbox" <?php checked( $instance['excerpt'] ); ?> />
		<label for="<?php echo $this->get_field_id( 'excerpt' ); ?>">
			<?php _e( 'Display Excerpt', 'recent-posts-widget-extended' ); ?>
		</label>
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'length' ); ?>">
			<?php _e( 'Excerpt Length', 'recent-posts-widget-extended' ); ?>
		</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'length' ); ?>" name="<?php echo $this->get_field_name( 'length' ); ?>" type="number" step="1" min="0" value="<?php echo (int)( $instance['length'] ); ?>" />
	</p>

	<p>
		<input id="<?php echo $this->get_field_id( 'readmore' ); ?>" name="<?php echo $this->get_field_name( 'readmore' ); ?>" type="checkbox" <?php checked( $instance['readmore'] ); ?> />
		<label for="<?php echo $this->get_field_id( 'readmore' ); ?>">
			<?php _e( 'Display Readmore', 'recent-posts-widget-extended' ); ?>
		</label>
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'readmore_text' ); ?>">
			<?php _e( 'Readmore Text', 'recent-posts-widget-extended' ); ?>
		</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'readmore_text' ); ?>" name="<?php echo $this->get_field_name( 'readmore_text' ); ?>" type="text" value="<?php echo strip_tags( $instance['readmore_text'] ); ?>" />
	</p>
	
	<p>
		<input id="<?php echo $this->get_field_id( 'comment_count' ); ?>" name="<?php echo $this->get_field_name( 'comment_count' ); ?>" type="checkbox" <?php checked( $instance['comment_count'] ); ?> />
		<label for="<?php echo $this->get_field_id( 'comment_count' ); ?>">
			<?php _e( 'Display Comment Count', 'recent-posts-widget-extended' ); ?>
		</label>
	</p>

	<p>
		<input id="<?php echo $this->get_field_id( 'date' ); ?>" name="<?php echo $this->get_field_name( 'date' ); ?>" type="checkbox" <?php checked( $instance['date'] ); ?> />
		<label for="<?php echo $this->get_field_id( 'date' ); ?>">
			<?php _e( 'Display Date', 'recent-posts-widget-extended' ); ?>
		</label>
	</p>
	
	<p>
		<input id="<?php echo $this->get_field_id( 'date_modified' ); ?>" name="<?php echo $this->get_field_name( 'date_modified' ); ?>" type="checkbox" <?php checked( $instance['date_modified'] ); ?> />
		<label for="<?php echo $this->get_field_id( 'date_modified' ); ?>">
			<?php _e( 'Display Modification Date', 'recent-posts-widget-extended' ); ?>
		</label>
	</p>
	
	<p>
		<input id="<?php echo $this->get_field_id( 'date_relative' ); ?>" name="<?php echo $this->get_field_name( 'date_relative' ); ?>" type="checkbox" <?php checked( $instance['date_relative'] ); ?> />
		<label for="<?php echo $this->get_field_id( 'date_relative' ); ?>">
			<?php _e( 'Use Relative Date. eg: 5 days ago', 'recent-posts-widget-extended' ); ?>
		</label>
	</p>
	

</div>

<div class="clear"></div>

<p>
	<input id="<?php echo $this->get_field_id( 'styles_default' ); ?>" name="<?php echo $this->get_field_name( 'styles_default' ); ?>" type="checkbox" <?php checked( $instance['styles_default'] ); ?> />
	<label for="<?php echo $this->get_field_id( 'styles_default' ); ?>">
		<?php _e( 'Use Default Styles', 'recent-posts-widget-extended' ); ?>
	</label>
</p>

<p>
	<label for="<?php echo $this->get_field_id( 'css' ); ?>">
		<?php _e( 'Custom CSS', 'recent-posts-widget-extended' ); ?>
	</label>
	<textarea class="widefat" id="<?php echo $this->get_field_id( 'css' ); ?>" name="<?php echo $this->get_field_name( 'css' ); ?>" style="height:180px;"><?php echo $instance['css']; ?></textarea>
	<small><?php _e( 'If you turn off the default styles, you can use these css code to customize the recent posts style.', 'recent-posts-widget-extended' ); ?></small>
</p>
