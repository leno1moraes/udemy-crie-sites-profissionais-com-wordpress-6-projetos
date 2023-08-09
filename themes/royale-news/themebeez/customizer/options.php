<?php
/**
 * Theme's all customize sections and settings.
 *
 * @since 1.0.0
 *
 * @package Royale_News
 */

/**
 * Load customize helper functions.
 */
require get_template_directory() . '/themebeez/customizer/customizer-choices.php';

$default = royale_news_get_default_theme_options();

$wp_customize->add_panel(
	'royale_news_options',
	array(
		'title'       => esc_html__( 'Theme Options', 'royale-news' ),
		'description' => esc_html__( 'Royale News Customization Options', 'royale-news' ),
		'priority'    => 10,
	)
);

// Site Title Font Size.
$wp_customize->add_setting(
	'royale_news_site_title_font_size',
	array(
		'sanitize_callback' => 'royale_news_sanitize_number_absint',
		'default'           => $default['royale_news_site_title_font_size'],
	)
);

$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'royale_news_site_title_font_size',
		array(
			'label'    => esc_html__( 'Site Title Font Size', 'royale-news' ),
			'section'  => 'title_tagline',
			'settings' => 'royale_news_site_title_font_size',
			'type'     => 'number',
		)
	)
);

// Logo Position Options.
$wp_customize->add_setting(
	'royale_news_logo_position',
	array(
		'sanitize_callback' => 'royale_news_sanitize_select',
		'default'           => $default['royale_news_logo_position'],
	)
);

$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'royale_news_logo_position',
		array(
			'label'       => esc_html__( 'Logo Position', 'royale-news' ),
			'description' => esc_html__( 'If logo is placed at center, then the header advertisement area will be disabled.', 'royale-news' ),
			'section'     => 'title_tagline',
			'settings'    => 'royale_news_logo_position',
			'type'        => 'select',
			'choices'     => royale_news_logo_align_choices(),
		)
	)
);


/**
 * ------------------------------------------------
 * Top Header Options
 * ------------------------------------------------
 */

// Ticker News Options.
$wp_customize->add_section(
	'royale_news_ticker_news_options',
	array(
		'priority'    => 20,
		'title'       => esc_html__( 'Ticker News Options', 'royale-news' ),
		'description' => esc_html__( 'Configure Ticker News', 'royale-news' ),
		'panel'       => 'royale_news_options',
	)
);

$wp_customize->add_setting(
	'royale_news_ticker_news_title',
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'default'           => $default['royale_news_ticker_news_title'],
	)
);

$wp_customize->add_control(
	'royale_news_ticker_news_title',
	array(
		'label'    => esc_html__( 'Ticker News Title', 'royale-news' ),
		'section'  => 'royale_news_ticker_news_options',
		'settings' => 'royale_news_ticker_news_title',
		'type'     => 'text',
	)
);

$wp_customize->add_setting(
	'royale_news_ticker_news_category',
	array(
		'sanitize_callback' => 'royale_news_sanitize_choices',
	)
);

$wp_customize->add_control(
	new Royale_News_Dropdown_Multiple_Chooser(
		$wp_customize,
		'royale_news_ticker_news_category',
		array(
			'label'    => esc_html__( 'Choose Category', 'royale-news' ),
			'section'  => 'royale_news_ticker_news_options',
			'settings' => 'royale_news_ticker_news_category',
			'choices'  => royale_news_categories_choices(),
		)
	)
);

$wp_customize->add_setting(
	'royale_news_ticker_news_no',
	array(
		'sanitize_callback' => 'royale_news_sanitize_number_absint',
		'default'           => $default['royale_news_ticker_news_no'],
	)
);

$wp_customize->add_control(
	'royale_news_ticker_news_no',
	array(
		'label'    => esc_html__( 'No of Posts', 'royale-news' ),
		'section'  => 'royale_news_ticker_news_options',
		'settings' => 'royale_news_ticker_news_no',
		'type'     => 'number',
	)
);


// Current Date Options.
$wp_customize->add_section(
	'royale_news_current_date_options',
	array(
		'priority'    => 20,
		'title'       => esc_html__( 'Current Date Option', 'royale-news' ),
		'description' => esc_html__( 'Configure Current Date', 'royale-news' ),
		'panel'       => 'royale_news_options',
	)
);

$wp_customize->add_setting(
	'royale_news_enable_current_date',
	array(
		'sanitize_callback' => 'royale_news_sanitize_checkbox',
		'default'           => $default['royale_news_enable_current_date'],
	)
);

$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'royale_news_enable_current_date',
		array(
			'label'    => esc_html__( 'Show Current Date', 'royale-news' ),
			'section'  => 'royale_news_current_date_options',
			'settings' => 'royale_news_enable_current_date',
			'type'     => 'checkbox',
		)
	)
);

// Search Button Options.
$wp_customize->add_section(
	'royale_news_search_btn_options',
	array(
		'priority'    => 20,
		'title'       => esc_html__( 'Search Button Option', 'royale-news' ),
		'description' => esc_html__( 'Configure Search Button', 'royale-news' ),
		'panel'       => 'royale_news_options',
	)
);

$wp_customize->add_setting(
	'royale_news_enable_search_btn',
	array(
		'sanitize_callback' => 'royale_news_sanitize_checkbox',
		'default'           => $default['royale_news_enable_search_btn'],
	)
);

$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'royale_news_enable_search_btn',
		array(
			'label'    => esc_html__( 'Show Search Button', 'royale-news' ),
			'section'  => 'royale_news_search_btn_options',
			'settings' => 'royale_news_enable_search_btn',
			'type'     => 'checkbox',
		)
	)
);



/**
 * -----------------------------------------
 * Footer Option
 * -----------------------------------------
 */
$wp_customize->add_section(
	'royale_news_copyright_options',
	array(
		'priority'    => 20,
		'title'       => esc_html__( 'Copyright Text Option', 'royale-news' ),
		'description' => esc_html__( 'Configure Copyright Text', 'royale-news' ),
		'panel'       => 'royale_news_options',
	)
);

// Copyright Text.
$wp_customize->add_setting(
	'royale_news_copyright_text',
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'default'           => $default['royale_news_copyright_text'],
	)
);
$wp_customize->add_control(
	'royale_news_copyright_text',
	array(
		'label'       => esc_html__( 'Copyright Text', 'royale-news' ),
		'description' => esc_html__( 'Insert copyright text', 'royale-news' ),
		'section'     => 'royale_news_copyright_options',
		'settings'    => 'royale_news_copyright_text',
		'type'        => 'text',
	)
);

// Scroll Top Options.
$wp_customize->add_section(
	'royale_news_scroll_top_options',
	array(
		'priority'    => 20,
		'title'       => esc_html__( 'Scroll Top Button Option', 'royale-news' ),
		'description' => esc_html__( 'Configure Scroll Top Button', 'royale-news' ),
		'panel'       => 'royale_news_options',
	)
);

$wp_customize->add_setting(
	'royale_news_enable_scroll_top',
	array(
		'sanitize_callback' => 'royale_news_sanitize_checkbox',
		'default'           => $default['royale_news_enable_scroll_top'],
	)
);

$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'royale_news_enable_scroll_top',
		array(
			'label'    => esc_html__( 'Show Scroll Top Button', 'royale-news' ),
			'section'  => 'royale_news_scroll_top_options',
			'settings' => 'royale_news_enable_scroll_top',
			'type'     => 'checkbox',
		)
	)
);

/**
 * -----------------------------------------
 * BreadCrumb Option
 * -----------------------------------------
 */
$wp_customize->add_section(
	'royale_news_breadcrumb_option',
	array(
		'priority'    => 20,
		'title'       => esc_html__( 'Breadcrumb Option', 'royale-news' ),
		'description' => esc_html__( 'Configure Breadcrumb', 'royale-news' ),
		'panel'       => 'royale_news_options',
	)
);

$wp_customize->add_setting(
	'royale_news_enable_breadcrumb',
	array(
		'sanitize_callback' => 'royale_news_sanitize_checkbox',
		'default'           => $default['royale_news_enable_breadcrumb'],
	)
);

$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'royale_news_enable_breadcrumb',
		array(
			'label'    => esc_html__( 'Show Breadcrumb', 'royale-news' ),
			'section'  => 'royale_news_breadcrumb_option',
			'settings' => 'royale_news_enable_breadcrumb',
			'type'     => 'checkbox',
		)
	)
);


/**
 * -----------------------------------------
 * Blog Page Option
 * -----------------------------------------
 */
$wp_customize->add_section(
	'royale_news_blogpage_option',
	array(
		'priority'    => 20,
		'title'       => esc_html__( 'Blog Page Option', 'royale-news' ),
		'description' => esc_html__( 'Configure Blog page', 'royale-news' ),
		'panel'       => 'royale_news_options',
	)
);

$wp_customize->add_setting(
	'royale_news_enable_featured_post',
	array(
		'sanitize_callback' => 'royale_news_sanitize_checkbox',
		'default'           => $default['royale_news_enable_featured_post'],
	)
);

$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'royale_news_enable_featured_post',
		array(
			'label'    => esc_html__( 'Show Featured Posts', 'royale-news' ),
			'section'  => 'royale_news_blogpage_option',
			'settings' => 'royale_news_enable_featured_post',
			'type'     => 'checkbox',
		)
	)
);


/**
 * -----------------------------------------
 * Post Single Option
 * -----------------------------------------
 */
$wp_customize->add_section(
	'royale_news_post_single_option',
	array(
		'priority'    => 20,
		'title'       => esc_html__( 'Post Single Options', 'royale-news' ),
		'description' => esc_html__( 'Configure post single', 'royale-news' ),
		'panel'       => 'royale_news_options',
	)
);

$wp_customize->add_setting(
	'royale_news_post_single_enable_featured_img',
	array(
		'sanitize_callback' => 'royale_news_sanitize_checkbox',
		'default'           => $default['royale_news_post_single_enable_featured_img'],
	)
);

$wp_customize->add_control(
	'royale_news_post_single_enable_featured_img',
	array(
		'label'   => esc_html__( 'Display Featured Image', 'royale-news' ),
		'section' => 'royale_news_post_single_option',
		'type'    => 'checkbox',
	)
);


/**
 * -----------------------------------------
 * Page Single Option
 * -----------------------------------------
 */
$wp_customize->add_section(
	'royale_news_page_single_option',
	array(
		'priority'    => 20,
		'title'       => esc_html__( 'Page Single Options', 'royale-news' ),
		'description' => esc_html__( 'Configure page single', 'royale-news' ),
		'panel'       => 'royale_news_options',
	)
);

$wp_customize->add_setting(
	'royale_news_page_single_enable_featured_img',
	array(
		'sanitize_callback' => 'royale_news_sanitize_checkbox',
		'default'           => $default['royale_news_page_single_enable_featured_img'],
	)
);

$wp_customize->add_control(
	'royale_news_page_single_enable_featured_img',
	array(
		'label'   => esc_html__( 'Display Featured Image', 'royale-news' ),
		'section' => 'royale_news_page_single_option',
		'type'    => 'checkbox',
	)
);



/**
 * -----------------------------------------
 * Theme Sidebar Option
 * -----------------------------------------
 */
$wp_customize->add_section(
	'royale_news_sidebar_section',
	array(
		'priority'    => 20,
		'title'       => esc_html__( 'Sidebar Option', 'royale-news' ),
		'description' => esc_html__( 'Configure Sidebar Position', 'royale-news' ),
		'panel'       => 'royale_news_options',
	)
);

$wp_customize->add_setting(
	'royale_news_sidebar_position',
	array(
		'sanitize_callback' => 'royale_news_sanitize_select',
		'default'           => $default['royale_news_sidebar_position'],
	)
);

$wp_customize->add_control(
	'royale_news_sidebar_position',
	array(
		'label'       => esc_html__( 'Sidebar Position', 'royale-news' ),
		'description' => esc_html__( 'Select Sidebar Postion. Select none to hide sidebar.', 'royale-news' ),
		'section'     => 'royale_news_sidebar_section',
		'settings'    => 'royale_news_sidebar_position',
		'type'        => 'radio',
		'choices'     => royale_news_sidebar_choices(),
	)
);


/**
 * -----------------------------------------
 * Theme Meta Option
 * -----------------------------------------
 */
$wp_customize->add_section(
	'royale_news_meta_options',
	array(
		'priority' => 20,
		'title'    => esc_html__( 'Post Meta Options', 'royale-news' ),
		'panel'    => 'royale_news_options',
	)
);

// Enable Post Date.
$wp_customize->add_setting(
	'royale_news_show_date',
	array(
		'sanitize_callback' => 'royale_news_sanitize_checkbox',
		'default'           => $default['royale_news_show_date'],
	)
);

$wp_customize->add_control(
	'royale_news_show_date',
	array(
		'label'   => esc_html__( 'Enable Post Date', 'royale-news' ),
		'section' => 'royale_news_meta_options',
		'type'    => 'checkbox',
	)
);

// Enable Author Name.
$wp_customize->add_setting(
	'royale_news_show_author',
	array(
		'sanitize_callback' => 'royale_news_sanitize_checkbox',
		'default'           => $default['royale_news_show_author'],
	)
);

$wp_customize->add_control(
	'royale_news_show_author',
	array(
		'label'   => esc_html__( 'Enable Author Name', 'royale-news' ),
		'section' => 'royale_news_meta_options',
		'type'    => 'checkbox',
	)
);

// Enable Comments No.
$wp_customize->add_setting(
	'royale_news_show_comments_no',
	array(
		'sanitize_callback' => 'royale_news_sanitize_checkbox',
		'default'           => $default['royale_news_show_comments_no'],
	)
);

$wp_customize->add_control(
	'royale_news_show_comments_no',
	array(
		'label'   => esc_html__( 'Enable Comments Number', 'royale-news' ),
		'section' => 'royale_news_meta_options',
		'type'    => 'checkbox',
	)
);

// Enable Categories.
$wp_customize->add_setting(
	'royale_news_show_categories',
	array(
		'sanitize_callback' => 'royale_news_sanitize_checkbox',
		'default'           => $default['royale_news_show_categories'],
	)
);

$wp_customize->add_control(
	'royale_news_show_categories',
	array(
		'label'   => esc_html__( 'Enable Categories', 'royale-news' ),
		'section' => 'royale_news_meta_options',
		'type'    => 'checkbox',
	)
);


/**
 * -----------------------------------------
 * Excerpt Option
 * -----------------------------------------
 */
$wp_customize->add_section(
	'royale_news_excerpt_options',
	array(
		'priority' => 20,
		'title'    => esc_html__( 'Excerpt', 'royale-news' ),
		'panel'    => 'royale_news_options',
	)
);

$wp_customize->add_setting(
	'royale_news_excerpt_length',
	array(
		'sanitize_callback' => 'royale_news_sanitize_number_absint',
		'default'           => $default['royale_news_excerpt_length'],
	)
);

$wp_customize->add_control(
	'royale_news_excerpt_length',
	array(
		'label'    => esc_html__( 'Excerpt Length', 'royale-news' ),
		'section'  => 'royale_news_excerpt_options',
		'settings' => 'royale_news_excerpt_length',
		'type'     => 'number',
	)
);



/**
 * -----------------------------------------
 * Typography section and settings.
 * -----------------------------------------
 */
$wp_customize->add_section(
	'royale_news_typography_section',
	array(
		'priority' => 20,
		'title'    => esc_html__( 'Typography', 'royale-news' ),
		'panel'    => 'royale_news_options',
	)
);

$wp_customize->add_setting(
	'royale_news_body_font',
	array(
		'default'           => $default['royale_news_body_font'],
		'sanitize_callback' => 'royale_news_sanitize_font',
	)
);

$wp_customize->add_control(
	new Royale_News_Customize_Typography_Control(
		$wp_customize,
		'royale_news_body_font',
		array(
			'label'   => esc_html__( 'Body Font', 'royale-news' ),
			'section' => 'royale_news_typography_section',
		)
	)
);

$wp_customize->add_setting(
	'royale_news_headings_font',
	array(
		'default'           => $default['royale_news_headings_font'],
		'sanitize_callback' => 'royale_news_sanitize_font',
	)
);

$wp_customize->add_control(
	new Royale_News_Customize_Typography_Control(
		$wp_customize,
		'royale_news_headings_font',
		array(
			'label'   => esc_html__( 'Headings Font', 'royale-news' ),
			'section' => 'royale_news_typography_section',
		)
	)
);
