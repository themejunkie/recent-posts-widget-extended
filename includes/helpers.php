<?php
/**
 * Various helpers used by the plugin.
 *
 * @package    Recent_Posts_Widget_Extended
 * @since      0.9.3
 * @author     Satrya
 * @copyright  Copyright (c) 2014, Satrya
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 */

/**
 * Sets up the default arguments.
 * 
 * @since  0.1
 * @return array
 */
function rpwe_get_default_args() {

	// CSS widget selector.
	$css_defaults = ".rpwe-block ul{\n}\n\n.rpwe-block li{\n}\n\n.rpwe-block a{\n}\n\n.rpwe-block h3{\n}\n\n.rpwe-thumb{\n}\n\n.rpwe-summary{\n}\n\n.rpwe-time{\n}\n\n.rpwe-alignleft{\n}\n\n.rpwe-alignright{\n}\n\n.rpwe-alignnone{\n}\n\n.rpwe-clearfix:before,\n.rpwe-clearfix:after{\ncontent: \"\";\ndisplay: table;\n}\n\n.rpwe-clearfix:after{\nclear:both;\n}\n\n.rpwe-clearfix{\nzoom: 1;\n}";

	// Default arguments.
	$defaults = array(
		'title'            => esc_html__( 'Recent Posts', 'rpwe' ),
		'title_url'        => '',

		'limit'            => 5,
		'offset'           => 0,
		'order'            => 'DESC',
		'orderby'          => 'date',
		'cat'              => '',
		'tag'              => '',
		'exclude'          => '',
		'post_type'        => 'post',
		'post_status'      => 'publish',
		'suppress_filters' => false,

		'thumb'            => true,
		'thumb_height'     => 45,
		'thumb_width'      => 45,
		'thumb_default'    => 'http://placehold.it/45x45/f0f0f0/ccc',
		'thumb_align'      => 'rpwe-alignleft',

		'excerpt'          => false,
		'length'           => 10,
		'date'             => true,
		'readmore'         => false,
		'readmore_text'    => __( 'Read More &raquo;', 'rpwe' ),
		'styles_default'   => true,

		'list_style'       => 'ul',
		'css'              => $css_defaults,
		'cssID'            => '',
		'before'           => '',
		'after'            => ''
		
	);

	// Allow plugins/themes developer to filter the default arguments.
	return apply_filters( 'rpwe_default_args', $defaults );

}

/**
 * Orderby arguments.
 *
 * @since  0.9.3
 * @return array
 */
function rpwe_get_orderby_args() {

	$orderby = array(
		'none'          => esc_attr__( 'None'         , 'rpwe' ),
		'ID'            => esc_attr__( 'Post ID'      , 'rpwe' ),
		'author'        => esc_attr__( 'Author'       , 'rpwe' ),
		'title'         => esc_attr__( 'Title'        , 'rpwe' ),
		'date'          => esc_attr__( 'Date Created' , 'rpwe' ),
		'modified'      => esc_attr__( 'Date Modified', 'rpwe' ),
		'parent'        => esc_attr__( 'Parent ID'    , 'rpwe' ),
		'rand'          => esc_attr__( 'Random'       , 'rpwe' ),
		'comment_count' => esc_attr__( 'Comment Count', 'rpwe' ),
		'menu_order'    => esc_attr__( 'Menu Order'   , 'rpwe' ),
	);

	return apply_filters( 'rpwe_orderby_args', $orderby );

}

/**
 * Order arguments.
 *
 * @since  0.9.3
 * @return array
 */
function rpwe_get_order_args() {

	$order = array(
		'ASC'  => esc_attr__( 'Ascending' , 'rpwe' ),
		'DESC' => esc_attr__( 'Descending', 'rpwe' )
	);

	return apply_filters( 'rpwe_order_args', $order );

}

/**
 * Alignment arguments.
 *
 * @since  0.9.3
 * @return array
 */
function rpwe_get_alignment_args() {

	$alignments = array(
		'rpwe-alignleft'  => esc_attr__( 'Left'  , 'rpwe' ),
		'rpwe-alignright' => esc_attr__( 'Right' , 'rpwe' ),
		'rpwe-alignnone'  => esc_attr__( 'Center', 'rpwe' )
	);

	return apply_filters( 'rpwe_alignment_args', $alignments );

}

/**
 * Print a custom excerpt.
 * Code revision in version 0.9, uses wp_trim_words function.
 *
 * @since    0.1
 * @version  0.9.3
 * @param    integer  $length
 * @return   string
 * @link     http://codex.wordpress.org/Function_Reference/get_the_excerpt
 * @link     http://codex.wordpress.org/Function_Reference/wp_trim_words
 */
function rpwe_excerpt( $length ) {
	$content = get_the_excerpt();
	$excerpt = wp_trim_words( $content, $length );

	return $excerpt;
}

/**
 * Custom Styles.
 *
 * @since  0.8
 */
function rpwe_custom_styles() {
	?>
<style>
.rpwe-block ul{list-style:none!important;margin-left:0!important;padding-left:0!important;}.rpwe-block li{border-bottom:1px solid #eee;margin-bottom:10px;padding-bottom:10px;list-style-type: none;}.rpwe-block a{display:inline!important;text-decoration:none;}.rpwe-block h3{background:none!important;clear:none;margin-bottom:0!important;margin-top:0!important;font-weight:400;font-size:12px!important;line-height:1.5em;}.rpwe-thumb{border:1px solid #EEE!important;box-shadow:none!important;margin:2px 10px 2px 0;padding:3px!important;}.rpwe-summary{font-size:12px;}.rpwe-time{color:#bbb;font-size:11px;}.rpwe-alignleft{display:inline;float:left;}.rpwe-alignright{display:inline;float:right;}.rpwe-alignnone{display:block;float:none;}.rpwe-clearfix:before,.rpwe-clearfix:after{content:"";display:table !important;}.rpwe-clearfix:after{clear:both;}.rpwe-clearfix{zoom:1;}
</style>
	<?php
}