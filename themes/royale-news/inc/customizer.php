<?php
/**
 * Royale News Theme Customizer
 *
 * @package Royale_News
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function royale_news_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Dropdown Category Taxonomy Control Class.
	require_once trailingslashit( get_template_directory() ) . '/themebeez/customizer/controls/class-royale-news-dropdown-taxonomies-control.php';

	// Dropdown Multiple Select Control Class.
	require_once trailingslashit( get_template_directory() ) . '/themebeez/customizer/controls/class-royale-news-dropdown-multiple-chooser.php';

	// Sanitization Callback.
	require_once trailingslashit( get_template_directory() ) . '/themebeez/customizer/sanitize.php';

	// Active callbacks.
	require_once trailingslashit( get_template_directory() ) . '/themebeez/customizer/active-callback.php';

	// Upspell.
	require_once trailingslashit( get_template_directory() ) . '/themebeez/customizer/upsell.php';

	$wp_customize->register_section_type( 'Royale_News_Customize_Section_Upsell' );

	// Typography Control.
	require get_template_directory() . '/themebeez/customizer/controls/typography/class-royale-news-customize-typography-control.php';
	$wp_customize->register_section_type( 'Royale_News_Customize_Typography_Control' );

	// Customization Options.
	require_once trailingslashit( get_template_directory() ) . '/themebeez/customizer/options.php';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'royale_news_customize_partial_blogname',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'royale_news_customize_partial_blogdescription',
			)
		);
	}

	// Register sections.
	$wp_customize->add_section(
		new Royale_News_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell',
			array(
				'title'    => esc_html__( 'Royale News Pro', 'royale-news' ),
				'pro_text' => esc_html__( 'Upgrade to Pro', 'royale-news' ),
				'pro_url'  => 'https://themebeez.com/themes/royale-news-pro/',
				'priority' => 1,
			)
		)
	);

}
add_action( 'customize_register', 'royale_news_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function royale_news_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function royale_news_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function royale_news_customize_preview_js() {
	wp_enqueue_script( 'royale-news-customizer', get_template_directory_uri() . '/themebeez/customizer/assets/js/customizer.js', array( 'customize-preview' ), ROYALE_NEWS_VERSION, true );
}
add_action( 'customize_preview_init', 'royale_news_customize_preview_js' );

/**
 * Enqueue scripts for customizer
 */
function royale_news_customizer_js() {

	wp_enqueue_style(
		'chosen',
		get_template_directory_uri() . '/themebeez/customizer/assets/css/chosen.css',
		array(),
		'1.8.3',
		'all'
	);

	wp_enqueue_style(
		'royale-news-customizer-style',
		get_template_directory_uri() . '/themebeez/customizer/assets/css/customizer-style.css',
		array(),
		ROYALE_NEWS_VERSION,
		'all'
	);

	wp_enqueue_script(
		'chosen',
		get_template_directory_uri() . '/themebeez/customizer/assets/js/chosen.js',
		array( 'jquery' ),
		'1.8.3',
		true
	);

	wp_enqueue_script(
		'royale-news-customizer-script',
		get_template_directory_uri() . '/themebeez/customizer/assets/js/customizer-script.js',
		array( 'jquery' ),
		ROYALE_NEWS_VERSION,
		true
	);
}
add_action( 'customize_controls_enqueue_scripts', 'royale_news_customizer_js' );


if ( ! function_exists( 'royale_news_get_customize_responsive_icon_desktop' ) ) {
	/**
	 * Renders desktop device switcher.
	 *
	 * @since 1.0.0
	 */
	function royale_news_get_customize_responsive_icon_desktop() {
		?>
		<li class="desktop">
			<button type="button" class="preview-desktop active" data-device="desktop">
				<?php
				echo apply_filters( // phpcs:ignore
					'royale_news_filter_responsive_icon_desktop',
					'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M4 5v11h16V5H4zm-2-.993C2 3.451 2.455 3 2.992 3h18.016c.548 0 .992.449.992 1.007V18H2V4.007zM1 19h22v2H1v-2z"/></svg>'
				);
				?>
			</button>
		</li>
		<?php
	}
}


if ( ! function_exists( 'royale_news_get_customize_responsive_icon_tablet' ) ) {
	/**
	 * Renders tablet device switcher.
	 *
	 * @since 1.0.0
	 */
	function royale_news_get_customize_responsive_icon_tablet() {
		?>
		<li class="tablet">
			<button type="button" class="preview-tablet" data-device="tablet">
				<?php
				echo apply_filters( // phpcs:ignore
					'royale_news_filter_responsive_icon_tablet',
					'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M6 4v16h12V4H6zM5 2h14a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1zm7 15a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/></svg>'
				);
				?>
			</button>
		</li>
		<?php
	}
}


if ( ! function_exists( 'royale_news_get_customize_responsive_icon_mobile' ) ) {
	/**
	 * Renders mobile device switcher.
	 *
	 * @since 1.0.0
	 */
	function royale_news_get_customize_responsive_icon_mobile() {
		?>
		<li class="tablet">
			<button type="button" class="preview-mobile" data-device="mobile">
				<?php
				echo apply_filters( // phpcs:ignore
					'royale_news_filter_responsive_icon_mobile',
					'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M7 4v16h10V4H7zM6 2h12a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1zm6 15a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/></svg>'
				);
				?>
			</button>
		</li>
		<?php
	}
}
