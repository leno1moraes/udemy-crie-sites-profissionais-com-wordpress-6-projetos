<?php
/**
 * Register widgets, and widget areas.
 *
 * @since 1.0.0
 *
 * @package Royale_News
 */

/**
 * Load widget classes.
 */
require get_template_directory() . '/themebeez/widgets/class-royale-news-bottom-widget-layout-one.php';
require get_template_directory() . '/themebeez/widgets/class-royale-news-bottom-widget-layout-two.php';
require get_template_directory() . '/themebeez/widgets/class-royale-news-widget-layout-one.php';
require get_template_directory() . '/themebeez/widgets/class-royale-news-widget-layout-two.php';
require get_template_directory() . '/themebeez/widgets/class-royale-news-sidebar-widget-one.php';
require get_template_directory() . '/themebeez/widgets/class-royale-news-sidebar-widget-two.php';
require get_template_directory() . '/themebeez/widgets/class-royale-news-slider-featured-posts.php';
require get_template_directory() . '/themebeez/widgets/class-royale-news-main-featured-posts.php';
require get_template_directory() . '/themebeez/widgets/class-royale-news-main-featured-posts-two.php';

if ( ! function_exists( 'royale_news_register_widgets' ) ) {
	/**
	 * Register widgets.
	 *
	 * @see https://codex.wordpress.org/Function_Reference/register_sidebar
	 */
	function royale_news_register_widgets() {

		/**
		 * Bottom Widget One Register.
		 */
		register_widget( 'Royale_News_Bottom_Widget_Layout_One' );

		/**
		 * Bottom Widget Two Register.
		 */
		register_widget( 'Royale_News_Bottom_Widget_Layout_Two' );

		/**
		 * Main Highlight Widget Register.
		 */
		register_widget( 'Royale_News_Main_Featured_Posts' );

		/**
		 * Main Highlight With Slider Widget Register.
		 */
		register_widget( 'Royale_News_Main_Featured_Posts_Two' );

		/**
		 * Slider Highlight Widget Register.
		 */
		register_widget( 'Royale_News_Slider_Featured_Posts' );

		/**
		 * Register Sidebar Widget One
		 */
		register_widget( 'Royale_News_Sidebar_Widget_One' );

		/**
		 * Register Sidebar Widget Two
		 */
		register_widget( 'Royale_News_Sidebar_Widget_Two' );

		/**
		 * Register News Widget One
		 */
		register_widget( 'Royale_News_Widget_Layout_One' );

		/**
		 * Register News Widget Two
		 */
		register_widget( 'Royale_News_Widget_Layout_Two' );
	}
}
add_action( 'widgets_init', 'royale_news_register_widgets' );
