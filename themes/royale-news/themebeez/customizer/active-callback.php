<?php
/**
 * Collection of active callback functions.
 *
 * @since 2.2.1
 *
 * @package Royale_News
 */

if ( ! function_exists( 'royale_news_is_google_fonts_disabled' ) ) {
	/**
	 * Checks if default Google font enqueue is disabled.
	 *
	 * @since 1.0.0
	 *
	 * @param  object $control WP Customize Control.
	 * @return boolean
	 */
	function royale_news_is_google_fonts_disabled( $control ) {

		return $control->manager->get_setting( 'royale_news_disable_google_fonts' )->value();
	}
}
