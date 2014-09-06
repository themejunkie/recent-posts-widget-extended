<?php
/**
 * Various functions used by the plugin.
 *
 * @package    Recent_Posts_Widget_Extended
 * @since      0.9.4
 * @author     Satrya
 * @copyright  Copyright (c) 2014, Satrya
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 */

/**
 * Sets up the default arguments.
 * 
 * @since  0.9.4
 */
function rpwe_get_default_args() {

	$css_defaults = ".rpwe-block ul{\nlist-style: none !important;\nmargin-left: 0 !important;\npadding-left: 0 !important;\n}\n\n.rpwe-block li{\nborder-bottom: 1px solid #eee;\nmargin-bottom: 10px;\npadding-bottom: 10px;\nlist-style-type: none;\n}\n\n.rpwe-block a{\ndisplay: inline !important;\ntext-decoration: none;\n}\n\n.rpwe-block h3{\nbackground: none !important;\nclear: none;\nmargin-bottom: 0 !important;\nmargin-top: 0 !important;\nfont-weight: 400;\nfont-size: 12px !important;\nline-height: 1.5em;\n}\n\n.rpwe-thumb{\nborder: 1px solid #eee !important;\nbox-shadow: none !important;\nmargin: 2px 10px 2px 0;\npadding: 3px !important;\n}\n\n.rpwe-summary{\nfont-size: 12px;\n}\n\n.rpwe-time{\ncolor: #bbb;\nfont-size: 11px;\n}\n\n.rpwe-alignleft{\ndisplay: inline;\nfloat: left;\n}\n\n.rpwe-alignright{\ndisplay: inline;\nfloat: right;\n}\n\n.rpwe-aligncenter{\ndisplay: block;\nmargin-left: auto;\nmargin-right: auto;\n}\n\n.rpwe-clearfix:before,\n.rpwe-clearfix:after{\ncontent: \"\";\ndisplay: table !important;\n}\n\n.rpwe-clearfix:after{\nclear: both;\n}\n\n.rpwe-clearfix{\nzoom: 1;\n}\n";

	$defaults = array(
		'title'             => esc_attr__( 'Recent Posts', 'rpwe' ),
		'title_url'         => '',

		'limit'            => 5,
		'offset'           => 0,
		'order'            => 'DESC',
		'orderby'          => 'date',
		'cat'              => '',
		'tag'              => '',
		'taxonomy'         => '',
		'post_type'        => 'post',
		'post_status'      => 'publish',
		'ignore_sticky'    => 1,

		'excerpt'          => false,
		'length'           => 10,
		'thumb'            => true,
		'thumb_height'     => 45,
		'thumb_width'      => 45,
		'thumb_default'    => 'http://placehold.it/45x45/f0f0f0/ccc',
		'thumb_align'      => 'rpwe-alignleft',
		'date'             => true,
		'readmore'         => false,
		'readmore_text'    => __( 'Read More &raquo;', 'rpwe' ),

		'styles_default'   => true,
		'css'              => $css_defaults,
		'cssID'            => '',
		'before'           => '',
		'after'            => ''
	);

	// Allow plugins/themes developer to filter the default arguments.
	return apply_filters( 'rpwe_default_args', $defaults );

}

/**
 * Outputs the recent posts.
 * 
 * @since  0.9.4
 */
function rpwe_recent_posts( $args = array() ) {
	echo rpwe_get_recent_posts( $args );
}

/**
 * Generates the posts markup.
 *
 * @since  0.9.4
 * @param  array  $args
 * @return string|array The HTML for the random posts.
 */
function rpwe_get_recent_posts( $args = array() ) {

	// Set up a default, empty variable.
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
	$posts = rpwe_get_posts( $args );
	
	if ( $posts->have_posts() ) :

		$html = '<div ' . ( ! empty( $args['cssID'] ) ? 'id="' . sanitize_html_class( $args['cssID'] ) . '"' : '' ) . ' class="rpwe-block rpwe-recent-' . sanitize_html_class( $args['post_type'] ) . '">';

			$html .= '<ul class="rpwe-ul">';

				while ( $posts->have_posts() ) : $posts->the_post();

					$html .= '<li class="rpwe-li rpwe-clearfix">';

						if ( $args['thumb'] ) :

							// Check if post has post thumbnail.
							if ( has_post_thumbnail() ) :
								$html .= '<a href="' . get_permalink() . '"  rel="bookmark">';
									$html .= get_the_post_thumbnail( get_the_ID(),
										array( $args['thumb_width'], $args['thumb_height'], true ),
										array( 
											'class' => $args['thumb_align'] . ' rpwe-thumb the-post-thumbnail',
											'alt'   => esc_attr( get_the_title() )
										)
									);
								$html .= '</a>';

							// If no post thumbnail found, check if Get The Image plugin exist and display the image.
							elseif ( function_exists( 'get_the_image' ) ) :
								$html .= get_the_image( array( 
									'height'        => $args['thumb_height'],
									'width'         => $args['thumb_width'],
									'size'          => 'rpwe-thumbnail',
									'image_class'   => $args['thumb_align'] . ' rpwe-thumb get-the-image',
									'image_scan'    => true,
									'default_image' => $args['thumb_default']
								) );

							// Display default image.
							elseif ( ! empty( $args['thumb_default'] ) ) :
								$html .= sprintf( '<a href="%1$s" rel="bookmark"><img class="%2$s rpwe-thumb rpwe-default-thumb" src="%3$s" alt="%4$s" width="%5$s" height="%6$s"></a>',
									esc_url( get_permalink() ),
									$args['thumb_align'],
									$args['thumb_default'],
									esc_attr( get_the_title() ),
									$args['thumb_width'],
									$args['thumb_height']
								);

							endif;

						endif;

						$html .= '<h3 class="rpwe-title"><a href="' . esc_url( get_permalink() ) . '" title="' . sprintf( esc_attr__( 'Permalink to %s', 'rpwe' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark">' . esc_attr( get_the_title() ) . '</a></h3>';

						if ( $args['date'] ) :
							$html .= '<time class="rpwe-time published" datetime="' . esc_html( get_the_date( 'c' ) ) . '">' . esc_html( get_the_date() ) . '</time>';
						endif;

						if ( $args['excerpt'] ) :
							$html .= '<div class="rpwe-summary">';
								$html .= wp_trim_words( apply_filters( 'rpwe_excerpt', get_the_excerpt() ), $args['length'], ' &hellip;' );
								if ( $args['readmore'] ) :
									$html .= '<a href="' . esc_url( get_permalink() ) . '" class="more-link">' . $args['readmore_text'] . '</a>';
								endif;
							$html .= '</div>';
						endif;

					$html .= '</li>';

				endwhile;

			$html .= '</ul>';

		$html .= '</div><!-- Generated by http://wordpress.org/plugins/recent-posts-widget-extended/ -->';

	endif;

	// Restore original Post Data.
	wp_reset_postdata();

	// Allow devs to hook in stuff after the loop.
	do_action( 'rpwe_after_loop' );
	
	// Return the  posts markup.
	return $args['before'] . apply_filters( 'rpwe_markup', $html ) . $args['after'];

}

/**
 * The posts query.
 *
 * @since  0.0.1
 * @param  array  $args
 * @return array
 */
function rpwe_get_posts( $args = array() ) {

	/**
	 * Taxonomy query.
	 * Prop Miniloop plugin by Kailey Lampert.
	 */
	parse_str( $args['taxonomy'], $taxes );
	$tax_query = array();
	foreach( array_keys( $taxes ) as $k => $slug ) {
		$ids = explode( ',', $taxes[$slug] );
		$tax_query[] = array(
			'taxonomy' => $slug,
			'field'    => 'id',
			'terms'    => $ids,
			'operator' => 'IN' 
		);
	};

	// Array categories
	if ( $args['cat'] && ! is_array( $args['cat'] ) ) {
		$args['cat'] = explode( ',', $args['cat'] ); 
	} else {
		$args['cat'] = NULL;
	}

	// Array tags
	if ( $args['tag'] && ! is_array( $args['tag'] ) ) {
		$args['tag'] = explode( ',', $args['tag'] ); 
	} else {
		$args['tag'] = NULL;
	}

	// Query arguments.
	$query = array(
		'offset'              => $args['offset'],
		'posts_per_page'      => $args['limit'],
		'orderby'             => $args['orderby'],
		'order'               => $args['order'],
		'post_type'           => $args['post_type'],
		'post_status'         => $args['post_status'],
		'ignore_sticky_posts' => $args['ignore_sticky'],
		'category__in'        => $args['cat'],
		'tag__in'             => $args['tag'],
		'tax_query'           => $tax_query,
	);

	// Allow plugins/themes developer to filter the default query.
	$query = apply_filters( 'rpwe_default_query_arguments', $query );

	// Perform the query.
	$posts = new WP_Query( $query );
	
	return $posts;

}