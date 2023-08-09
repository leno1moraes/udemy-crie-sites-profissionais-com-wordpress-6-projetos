<?php
/**
 * Collection of theme's helper functions.
 *
 * @package Royale_News
 */

if ( ! function_exists( 'royale_news_primary_navigation_fallback' ) ) {

	/**
	 * Fallback for primary navigation.
	 *
	 * @since 1.0.0
	 */
	function royale_news_primary_navigation_fallback() {
		?>
		<div class="primary-menu-container">
			<ul id="primary-menu" class="primary-menu">
				<li>
					<a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>" title="<?php esc_attr_e( 'Add Menu', 'royale-news' ); ?>">
						<?php
							esc_html_e( 'Add a menu', 'royale-news' );
						?>
					</a>
				</li>
			</ul>
		</div>
		<?php
	}
}



/*
 * Hook - Plugin Recommendation
 */
if ( ! function_exists( 'royale_news_recommended_plugins' ) ) {
	/**
	 * Recommend plugins.
	 *
	 * @since 1.0.0
	 */
	function royale_news_recommended_plugins() {

		$plugins = array(
			array(
				'name'     => 'Themebeez Toolkit',
				'slug'     => 'themebeez-toolkit',
				'required' => false,
			),
		);

		tgmpa( $plugins );
	}
}
add_action( 'tgmpa_register', 'royale_news_recommended_plugins' );


if ( ! function_exists( 'royale_news_recursive_parse_args' ) ) {
	/**
	 * Recursively merge two arrays.
	 *
	 * @since 2.2.1
	 *
	 * @param array $args Target array.
	 * @param array $defaults Default array.
	 */
	function royale_news_recursive_parse_args( $args, $defaults ) {

		$new_args = (array) $defaults;

		foreach ( $args as $key => $value ) {

			if ( is_array( $value ) && isset( $new_args[ $key ] ) ) {

				$new_args[ $key ] = royale_news_recursive_parse_args( $value, $new_args[ $key ] );
			} else {

				$new_args[ $key ] = $value;
			}
		}

		return $new_args;
	}
}


if ( ! function_exists( 'royale_news_has_google_fonts' ) ) {
	/**
	 * Checks if Google font is used.
	 *
	 * @since 2.2.1
	 */
	function royale_news_has_google_fonts() {

		$body_font = royale_news_get_option( 'royale_news_body_font' );
		$body_font = json_decode( $body_font, true );

		$headings_font = royale_news_get_option( 'royale_news_headings_font' );
		$headings_font = json_decode( $headings_font, true );

		return ( 'google' === $body_font['source'] || 'google' === $headings_font['source'] ) ? true : false;
	}
}


if ( ! function_exists( 'royale_news_google_fonts_urls' ) ) {
	/**
	 * Returns the array of Google fonts URL.
	 *
	 * @since 2.2.1
	 *
	 * @return array $fonts_urls Fonts URLs.
	 */
	function royale_news_google_fonts_urls() {

		if ( ! royale_news_has_google_fonts() ) {
			return false;
		}

		$fonts_urls = array();

		$body_font = royale_news_get_option( 'royale_news_body_font' );
		$body_font = json_decode( $body_font, true );

		$headings_font = royale_news_get_option( 'royale_news_headings_font' );
		$headings_font = json_decode( $headings_font, true );

		if ( 'google' === $body_font['source'] ) {
			$fonts_urls[] = $body_font['font_url'];
		}

		if ( 'google' === $headings_font['source'] ) {
			$fonts_urls[] = $headings_font['font_url'];
		}

		return $fonts_urls;
	}
}


if ( ! function_exists( 'royale_news_render_google_fonts_header' ) ) {
	/**
	 * Renders <link> tags for Google fonts embedd in the <head> tag.
	 *
	 * @since 2.2.1
	 */
	function royale_news_render_google_fonts_header() {

		if ( ! royale_news_has_google_fonts() ) {
			return;
		}
		?>
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
		<?php
	}

	add_action( 'wp_head', 'royale_news_render_google_fonts_header', 5 );
}


if ( ! function_exists( 'royale_news_get_google_fonts_url' ) ) {
	/**
	 * Returns the URL of Google fonts.
	 *
	 * @since 2.2.1
	 *
	 * @return string $google_fonts_url Google Fonts URL.
	 */
	function royale_news_get_google_fonts_url() {

		$google_fonts_urls = royale_news_google_fonts_urls();

		if ( empty( $google_fonts_urls ) ) {

			return false;
		}

		$google_fonts_url = add_query_arg(
			array(
				'family'  => implode( '&family=', $google_fonts_urls ),
				'display' => 'swap',
			),
			'https://fonts.googleapis.com/css2'
		);

		return esc_url( $google_fonts_url );
	}
}
