<?php
/**
 * Functions which enhance the theme by hooking into WordPress.
 *
 * @package Royale_News
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function royale_news_body_classes( $classes ) {

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'royale_news_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function royale_news_pingback_header() {

	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'royale_news_pingback_header' );


if ( ! function_exists( 'royale_news_home_middle_class' ) ) {
	/**
	 * Add class to middle widget area section.
	 */
	function royale_news_home_middle_class() {

		$home_middle_class = '';

		if ( is_active_sidebar( 'sidebar-2' ) ) {

			$home_middle_class = 'middle-widget-container';
		} else {

			$home_middle_class = 'middle-widget-container-spacing';
		}

		echo esc_attr( $home_middle_class );
	}
}


if ( ! function_exists( 'royale_news_inner_container_class' ) ) {
	/**
	 * Add class to inner page content area.
	 */
	function royale_news_inner_container_class() {

		$inner_container_class = '';

		if ( royale_news_get_option( 'royale_news_enable_breadcrumb' ) === true ) {

			$inner_container_class = 'inner-page-container';
		} else {

			$inner_container_class = 'inner-page-container-spacing';
		}

		echo esc_attr( $inner_container_class );
	}
}


if ( ! function_exists( 'royale_news_home_inner_container_class' ) ) {
	/**
	 * Add class to inner page content area.
	 */
	function royale_news_home_inner_container_class() {

		$home_middle_class = '';

		if (
			is_active_sidebar( 'sidebar-2' ) &&
			royale_news_get_option( 'royale_news_enable_featured_post' ) === true
		) {

			$home_middle_class = 'middle-widget-container';
		} else {

			$home_middle_class = 'middle-widget-container-spacing';
		}

		echo esc_attr( $home_middle_class );
	}
}
