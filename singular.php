<?php
/**
 * The template for displaying a single page/post.
 *
 * See /core/structure/post.php and /core/structure/hooks.php
 *
 * @package checkout
 */
$layout  = get_post_meta( get_the_ID(), 'maillard_pro_radio_layouts', true );

if( $layout === 'sidebar-content' ) {
	remove_action( 'zeus_content_sidebar_wrapper', 'zeus_sidebar_primary', 20 );
	add_action( 'zeus_content_sidebar_wrapper', 'zeus_sidebar_primary', 5 );

	add_filter( 'body_class', 'maillard_sidebar_content_body_class' );
	function maillard_sidebar_content_body_class( $classes ) {

		$classes[] = 'sidebar-content';
		return $classes;

	}

}

if( $layout === 'no-sidebar' ) {
	remove_action( 'zeus_content_sidebar_wrapper', 'zeus_sidebar_primary', 20 );

	add_filter( 'body_class', 'maillard_no_sidebar_body_class' );
	function maillard_no_sidebar_body_class( $classes ) {

		$classes[] = 'no-sidebar';
		return $classes;

	}

}

zeus();
