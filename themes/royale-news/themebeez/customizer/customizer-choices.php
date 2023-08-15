<?php
/**
 * Collection of helper functions for customize.
 *
 * @since 1.0.0
 *
 * @package Royale_News
 */

if ( ! function_exists( 'royale_news_categories_choices' ) ) {
	/**
	 * Generates array of category terms. Value is term slug and label is the term name.
	 *
	 * @since 1.0.0
	 *
	 * @return array $dropdown
	 */
	function royale_news_categories_choices() {

		$category_terms = get_terms( 'category' );

		$post_categories = array();

		if ( $category_terms ) {
			foreach ( $category_terms as $category_term ) {
				$post_categories[ $category_term->term_id ] = $category_term->name;
			}
		}

		return $post_categories;
	}
}


/*
 * Definition of sidebar position array
 */
if ( ! function_exists( 'royale_news_sidebar_choices' ) ) {
	/**
	 * Generates array choices for sidebar positions.
	 *
	 * @since 1.0.0
	 */
	function royale_news_sidebar_choices() {

		return array(
			'left'  => esc_html__( 'Left', 'royale-news' ),
			'right' => esc_html__( 'Right', 'royale-news' ),
			'none'  => esc_html__( 'None', 'royale-news' ),
		);
	}
}


if ( ! function_exists( 'royale_news_logo_align_choices' ) ) {
	/**
	 * Generates array choices for logo alignment.
	 *
	 * @since 1.0.0
	 */
	function royale_news_logo_align_choices() {

		return array(
			'left'   => esc_html__( 'Left', 'royale-news' ),
			'center' => esc_html__( 'Center', 'royale-news' ),
		);
	}
}
