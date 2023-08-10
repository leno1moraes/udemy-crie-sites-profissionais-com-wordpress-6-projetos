<?php
/**
 * Default Options.
 *
 * @package Royale_News
 */

if ( ! function_exists( 'royale_news_get_option' ) ) {
	/**
	 * Get theme option.
	 *
	 * @since 1.0.0
	 *
	 * @param string $key Option key.
	 * @return mixed Option value.
	 */
	function royale_news_get_option( $key ) {

		if ( empty( $key ) ) {
			return;
		}

		$value = '';

		$default = royale_news_get_default_theme_options();

		$default_value = null;

		if ( is_array( $default ) && isset( $default[ $key ] ) ) {
			$default_value = $default[ $key ];
		}

		if ( null !== $default_value ) {
			$value = get_theme_mod( $key, $default_value );
		} else {
			$value = get_theme_mod( $key );
		}

		return $value;
	}
}

if ( ! function_exists( 'royale_news_get_default_theme_options' ) ) {

	/**
	 * Get default theme options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Default theme options.
	 */
	function royale_news_get_default_theme_options() {

		$defaults = array(
			'royale_news_logo_position'                   => 'left',
			'royale_news_site_title_font_size'            => 45,
			'royale_news_ticker_news_title'               => '',
			'royale_news_ticker_news_category'            => 0,
			'royale_news_ticker_news_no'                  => 5,
			'royale_news_enable_current_date'             => 1,
			'royale_news_enable_search_btn'               => 1,
			'royale_news_enable_breadcrumb'               => 1,
			'royale_news_copyright_text'                  => '',
			'royale_news_enable_scroll_top'               => 1,
			'royale_news_enable_featured_post'            => 0,
			'royale_news_post_single_enable_featured_img' => 1,
			'royale_news_page_single_enable_featured_img' => 1,
			'royale_news_sidebar_position'                => 'right',
			'royale_news_show_date'                       => 1,
			'royale_news_show_author'                     => 1,
			'royale_news_show_comments_no'                => 1,
			'royale_news_show_categories'                 => 1,
			'royale_news_excerpt_length'                  => 30,
			'royale_news_body_font'                       => wp_json_encode(
				array(
					'source'        => 'google',
					'font_family'   => 'Open Sans',
					'font_variants' => '400,400italic',
					'font_url'      => 'Open+Sans:ital@0;1',
					'font_weight'   => '400',
					'font_sizes'    => array(
						'desktop' => array(
							'value'           => '16',
							'unit'            => 'px',
							'unit_changeable' => 'no',
						),
						'tablet'  => array(
							'value'           => '16',
							'unit'            => 'px',
							'unit_changeable' => 'no',
						),
						'mobile'  => array(
							'value'           => '16',
							'unit'            => 'px',
							'unit_changeable' => 'no',
						),
					),
				)
			),
			'royale_news_headings_font'                   => wp_json_encode(
				array(
					'source'        => 'google',
					'font_family'   => 'Roboto Condensed',
					'font_variants' => '700,700italic',
					'font_url'      => 'Roboto+Condensed:ital,wght@0,700;1,700',
					'font_weight'   => '700',
				)
			),
		);

		return $defaults;
	}
}
