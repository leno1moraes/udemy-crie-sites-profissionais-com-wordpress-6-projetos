<?php
/**
 * Definitions of theme's template hooks.
 *
 * @package Royale_News
 */

if ( ! function_exists( 'royale_news_doctype_action' ) ) {
	/**
	 * Doctype declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function royale_news_doctype_action() {
		?>
		<!doctype html>
		<html <?php language_attributes(); ?>>
		<?php
	}
}
add_action( 'royale_news_doctype', 'royale_news_doctype_action', 10 );


if ( ! function_exists( 'royale_news_head_action' ) ) {
	/**
	 * Head declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function royale_news_head_action() {
		?>
		<head>
			<meta charset="<?php bloginfo( 'charset' ); ?>">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="profile" href="http://gmpg.org/xfn/11">
			<?php wp_head(); ?>
		</head>
		<?php
	}
}
add_action( 'royale_news_head', 'royale_news_head_action', 10 );


if ( ! function_exists( 'royale_news_body_before_action' ) ) {
	/**
	 * Body Before declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function royale_news_body_before_action() {
		?>
		<body <?php body_class(); ?>>
			<?php
			if ( function_exists( 'wp_body_open' ) ) {
				wp_body_open();
			}
			?>
			<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'royale-news' ); ?></a>
			<?php
			if ( get_background_image() ) {
				?>
				<div class="main-wrapper">
				<?php
			}
	}
}
add_action( 'royale_news_body_before', 'royale_news_body_before_action', 10 );


if ( ! function_exists( 'royale_news_header_before_action' ) ) {
	/**
	 * Header Before declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function royale_news_header_before_action() {

		if ( has_header_image() ) {
			?>
			<header class="header" style="background-image: url(<?php header_image(); ?>); background-size: cover; background-position: center;" >
			<?php
		} else {
			?>
			<header class="header">
			<?php
		}
	}
}
add_action( 'royale_news_header_before', 'royale_news_header_before_action', 10 );


if ( ! function_exists( 'royale_news_top_header_before_action' ) ) {
	/**
	 * Top Header Before declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function royale_news_top_header_before_action() {
		?>
		<div class="top-header">
		<div class="container">
		<div class="row clearfix">
		<?php
	}
}
add_action( 'royale_news_top_header_before', 'royale_news_top_header_before_action', 10 );


if ( ! function_exists( 'royale_news_ticker_action' ) ) {
	/**
	 * Ticker News of the theme.
	 *
	 * @since 1.0.0
	 */
	function royale_news_ticker_action() {
		?>
		<div class="col-md-8">
			<?php
			$ticker_title    = royale_news_get_option( 'royale_news_ticker_news_title' );
			$ticker_category = royale_news_get_option( 'royale_news_ticker_news_category' );
			$ticker_no       = royale_news_get_option( 'royale_news_ticker_news_no' );

			$ticker_args = array(
				'posts_per_page' => absint( $ticker_no ),
				'cat'            => $ticker_category,
				'post_type'      => 'post',
				'post_status'    => 'publish',
			);

			$ticker_query = new WP_Query( $ticker_args );

			if ( $ticker_query->have_posts() ) {

				$ticker_content_class = 'col-xs-9 col-sm-9';
				?>
				<div class="row clearfix ticker-news-section">
					<?php
					if ( ! empty( $ticker_title ) ) {
						?>
						<div class="col-xs-3 col-sm-3">
							<div class="ticker-title-container">
								<h5 class="ticker-title">
									<?php
										echo esc_html( $ticker_title );
									?>
								</h5><!-- .ticker-title -->
							</div><!-- .ticker-title-container -->								
						</div><!-- .col-xs-3.col-sm-3 -->
						<?php
					} else {
						$ticker_content_class = 'col-xs-12 col-sm-12';
					}
					?>
					<div class="<?php echo esc_attr( $ticker_content_class ); ?>">
						<div class="ticker-detail-container">
							<div class="owl-carousel ticker-news-carousel">
								<?php
								while ( $ticker_query->have_posts() ) {
									$ticker_query->the_post();
									?>
									<div class="item">
										<h5 class="ticker-news">
											<a href="<?php the_permalink(); ?>">
												<?php the_title(); ?>
											</a>
										</h5><!-- .ticker-news -->
									</div><!-- .item -->
									<?php
								}
								wp_reset_postdata();
								?>
							</div><!-- .owl-carousel.ticker-news-carousel -->
						</div><!-- .ticker-detail-container -->
					</div><!-- .col-xs-9.col-sm-9 -->
				</div><!-- .row.clearfix.ticker-news-section -->
				<?php
			}
			?>
		</div><!-- .col-md-8 -->
		<?php
	}
}
add_action( 'royale_news_ticker', 'royale_news_ticker_action', 10 );


if ( ! function_exists( 'royale_news_before_current_date_action' ) ) {
	/**
	 * Before Current Date declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function royale_news_before_current_date_action() {
		?>
		<div class="col-md-4 hidden-sm hidden-xs">
		<div class="clearfix">
		<?php
	}
}
add_action( 'royale_news_before_current_date', 'royale_news_before_current_date_action', 10 );


if ( ! function_exists( 'royale_news_current_date_action' ) ) {
	/**
	 * Current Date declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function royale_news_current_date_action() {

		$show_date = royale_news_get_option( 'royale_news_enable_current_date' );

		if ( true === $show_date || 1 === $show_date ) {
			?>
			<div class="current-date-container">
				<h5 class="current-date">
					<?php
					$current_date = date_i18n( get_option( 'date_format' ) );
					echo esc_html( $current_date );
					?>
				</h5><!-- .current-date -->
			</div><!-- .current-date-container -->
			<?php
		}
	}
}
add_action( 'royale_news_current_date', 'royale_news_current_date_action', 10 );


if ( ! function_exists( 'royale_news_social_menu_action' ) ) {
	/**
	 * Social Menu declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function royale_news_social_menu_action() {
		?>
		<div class="social-menu-container">
			<?php
			if ( has_nav_menu( 'social' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'social',
						'menu_class'     => 'social-menu clearfix',
					)
				);
			}
			?>
		</div><!-- .social-menu-container -->
		<?php
	}
}
add_action( 'royale_news_social_menu', 'royale_news_social_menu_action', 10 );


if ( ! function_exists( 'royale_news_after_social_menu_action' ) ) {
	/**
	 * Before Current Date declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function royale_news_after_social_menu_action() {
		?>
		</div><!-- .clearfix -->
		</div><!-- .col-md-4.hidden-sm.hidden-xs -->
		<?php
	}
}
add_action( 'royale_news_after_social_menu', 'royale_news_after_social_menu_action', 10 );


if ( ! function_exists( 'royale_news_top_header_after_action' ) ) {
	/**
	 * Top Header After declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function royale_news_top_header_after_action() {
		?>
		</div><!-- .row.clearfix -->
		</div><!-- .container -->
		</div><!-- .top-header -->
		<?php
	}
}
add_action( 'royale_news_top_header_after', 'royale_news_top_header_after_action', 10 );


if ( ! function_exists( 'royale_news_middle_header_before_action' ) ) {
	/**
	 * Middle Header Before declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function royale_news_middle_header_before_action() {
		?>
		<div class="middle-header">
		<div class="container">
		<div class="row clearfix">
		<?php
	}
}
add_action( 'royale_news_middle_header_before', 'royale_news_middle_header_before_action', 10 );


if ( ! function_exists( 'royale_news_logo_action' ) ) {
	/**
	 * Logo declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function royale_news_logo_action() {

		$logo_position        = royale_news_get_option( 'royale_news_logo_position' );
		$logo_container_class = null;
		$logo_align           = null;

		if ( 'center' !== $logo_position ) {
			$logo_container_class = 'col-md-4';
		} else {
			$logo_container_class = 'col-md-12';
			$logo_align           = 'text-center';
		}
		?>
		<div class="<?php echo esc_attr( $logo_container_class ); ?>">
			<?php
			if ( has_custom_logo() ) {
				?>
				<div class="site-info <?php echo esc_attr( $logo_align ); ?>">
					<?php the_custom_logo(); ?>
				</div>
				<?php
			} else {
				?>
				<div class="site-info <?php echo esc_attr( $logo_align ); ?>">
					<h1 class="site-title">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<?php bloginfo( 'name' ); ?>
						</a>
					</h1><!-- .site-title -->
					<h5 class="site-description">
						<?php echo esc_html( get_bloginfo( 'description' ) ); ?>
					</h5><!-- .site-description -->
				</div><!-- .site-info -->
				<?php
			}
			?>
		</div><!-- .col-md-4 -->
		<?php
	}
}
add_action( 'royale_news_logo', 'royale_news_logo_action', 10 );


if ( ! function_exists( 'royale_news_middle_header_after_action' ) ) {
	/**
	 * Middle Header After declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function royale_news_middle_header_after_action() {
		?>
		</div><!-- .row.clearfix -->
		</div><!-- .container -->
		</div><!-- .middle-header -->
		<?php
	}
}
add_action( 'royale_news_middle_header_after', 'royale_news_middle_header_after_action', 10 );


if ( ! function_exists( 'royale_news_bottom_header_before_action' ) ) {
	/**
	 * Bottom Header Before declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function royale_news_bottom_header_before_action() {
		?>
		<div class="bottom-header">
		<div class="container">
		<div class="row clearfix">
		<?php
	}
}
add_action( 'royale_news_bottom_header_before', 'royale_news_bottom_header_before_action', 10 );


if ( ! function_exists( 'royale_news_main_menu_action' ) ) {
	/**
	 * Main Menu declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function royale_news_main_menu_action() {
		?>
		<div class="col-md-10">
			<div class="menu-container clearfix">
				<nav id="site-navigation" class="main-navigation" role="navigation">
					<?php
					wp_nav_menu(
						array(
							'theme_location'  => 'primary',
							'menu_id'         => 'primary-menu',
							'menu_class'      => 'primary-menu',
							'container'       => 'div',
							'container_class' => 'primary-menu-container',
							'fallback_cb'     => 'royale_news_primary_navigation_fallback',
						)
					);
					?>
				</nav><!-- #site-navigation -->
			</div><!-- .menu-container.clearfix -->
		</div><!-- .col-md-10 -->
		<?php
	}
}
add_action( 'royale_news_main_menu', 'royale_news_main_menu_action', 10 );


if ( ! function_exists( 'royale_news_search_action' ) ) {
	/**
	 * Header Ad declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function royale_news_search_action() {

		$show_search_btn = royale_news_get_option( 'royale_news_enable_search_btn' );

		if ( true === $show_search_btn || 1 === $show_search_btn ) {
			?>
			<div class="col-md-2 hidden-xs hidden-sm">
				<div class="search-container pull-right">
					<div class="search-icon">
						<i class="fa fa-search"></i><!-- .fa.fa-search -->
					</div><!-- .search-icon -->
				</div><!-- .search-container.pull-right -->
			</div><!-- .col-md-2.hidden-xs.hidden-sm -->
			<div class="col-md-12 search-form-main-container">
				<div class="search-form-container">
					<?php get_search_form(); ?>
				</div><!-- .search-form-container -->				
			</div><!-- .col-md-12 -->
			<?php
		}
	}
}
add_action( 'royale_news_search', 'royale_news_search_action', 10 );


if ( ! function_exists( 'royale_news_bottom_header_after_action' ) ) {
	/**
	 * Bottom Header After declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function royale_news_bottom_header_after_action() {
		?>
		</div><!-- .row.clearfix -->
		</div><!-- .container -->
		</div><!-- .bottom-header -->
		<?php
	}
}
add_action( 'royale_news_bottom_header_after', 'royale_news_bottom_header_after_action', 10 );


if ( ! function_exists( 'royale_news_header_ad_action' ) ) {
	/**
	 * Header Ad declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function royale_news_header_ad_action() {

		$logo_position = royale_news_get_option( 'royale_news_logo_position' );

		if ( 'center' !== $logo_position ) {
			?>
			<div class="col-md-8 hidden-xs hidden-sm">
				<div class="header-ad">
					<?php
					if ( is_active_sidebar( 'sidebar-5' ) ) {
						dynamic_sidebar( 'sidebar-5' );
					}
					?>
				</div><!-- .header-ad -->
			</div><!-- .col-md-7.hidden-xs.hidden-sm -->
			<?php
		}
	}
}
add_action( 'royale_news_header_ad', 'royale_news_header_ad_action', 10 );


if ( ! function_exists( 'royale_news_header_after_action' ) ) {
	/**
	 * Header After Hook declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function royale_news_header_after_action() {
		?>
		</header><!-- .header -->
		<?php
	}
}
add_action( 'royale_news_header_after', 'royale_news_header_after_action', 10 );

if ( ! function_exists( 'royale_news_content_wrapper_start_action' ) ) {
	/**
	 * Content wrapper start hook declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function royale_news_content_wrapper_start_action() {
		?>
		<div id="content" class="site-content">
		<?php
	}
}
add_action( 'royale_news_content_wrapper_start', 'royale_news_content_wrapper_start_action', 10 );


if ( ! function_exists( 'royale_news_content_wrapper_end_action' ) ) {
	/**
	 * Content wrapper end hook declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function royale_news_content_wrapper_end_action() {
		?>
		</div>
		<?php
	}
}
add_action( 'royale_news_content_wrapper_end', 'royale_news_content_wrapper_end_action', 10 );


if ( ! function_exists( 'royale_news_breadcrumb_action' ) ) {
	/**
	 * Breadcrumb declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function royale_news_breadcrumb_action() {

		$enable_breadcrumb = royale_news_get_option( 'royale_news_enable_breadcrumb' );

		if ( 1 === $enable_breadcrumb || true === $enable_breadcrumb ) {
			?>
			<div class="container">
				<div class="row clearfix">
					<div class="col-md-12">
						<div class="breadcrumb clearfix">
							<?php
							$breadcrumb_args = array(
								'show_browse'   => false,
								'separator'     => '&nbsp;',
								'post_taxonomy' => array(
									'post' => 'category',
								),
							);
							royale_news_breadcrumb_trail( $breadcrumb_args );
							?>
						</div><!-- .breadcrumb.clearfix -->
					</div><!-- .col-md-12 -->
				</div><!-- .row.clearfix -->
			</div><!-- .container -->
			<?php
		}
	}
}
add_action( 'royale_news_breadcrumb', 'royale_news_breadcrumb_action', 10 );


if ( ! function_exists( 'royale_news_pagination_action' ) ) {
	/**
	 * Pagination declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function royale_news_pagination_action() {
		?>
		<div class="col-sm-12">
			<?php
			the_posts_pagination(
				array(
					'mid_size'  => 2,
					'prev_text' => esc_html__( '&laquo;', 'royale-news' ),
					'next_text' => esc_html__( '&raquo;', 'royale-news' ),
				)
			);
			?>
		</div><!-- .col-sm-12 -->
		<?php
	}
}
add_action( 'royale_news_pagination', 'royale_news_pagination_action', 10 );


if ( ! function_exists( 'royale_news_post_navigation_action' ) ) {
	/**
	 * Post Navigation declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function royale_news_post_navigation_action() {
		?>
		<div class="col-sm-12">
			<?php the_post_navigation(); ?>
		</div><!-- .col-sm-12 -->
		<?php
	}
}
add_action( 'royale_news_post_navigation', 'royale_news_post_navigation_action', 10 );


if ( ! function_exists( 'royale_news_footer_before_action' ) ) {
	/**
	 * Footer Before declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function royale_news_footer_before_action() {
		?>
		<footer class="footer">
		<div class="container">
		<?php
	}
}
add_action( 'royale_news_footer_before', 'royale_news_footer_before_action', 10 );


if ( ! function_exists( 'royale_news_top_footer_action' ) ) {
	/**
	 * Top Footer declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function royale_news_top_footer_action() {
		?>
		<div class="row clearfix top-footer">
			<?php
			if ( is_active_sidebar( 'sidebar-4' ) ) {
				dynamic_sidebar( 'sidebar-4' );
			}
			?>
		</div><!-- .row.clearfix.top-footer -->
		<?php
	}
}
add_action( 'royale_news_top_footer', 'royale_news_top_footer_action', 10 );


if ( ! function_exists( 'royale_news_bottom_footer_before_action' ) ) {
	/**
	 * Bottom Footer Before declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function royale_news_bottom_footer_before_action() {
		?>
		<div class="row clearfix bottom-footer">
		<?php
	}
}
add_action( 'royale_news_bottom_footer_before', 'royale_news_bottom_footer_before_action', 10 );


if ( ! function_exists( 'royale_news_copyright_action' ) ) {
	/**
	 * Copyright Text declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function royale_news_copyright_action() {

		$copyright_text = royale_news_get_option( 'royale_news_copyright_text' );
		?>
		<div class="col-md-6">
			<div class="copyright-container">
				<?php
				if ( ! empty( $copyright_text ) ) {
					?>
					<h5 class="copyright-text">
						<?php
						printf(
							/* translators: 1: copyright text, 2: theme name, 3: theme URL */
							esc_html__( '%1$s %2$s by %3$s', 'royale-news' ),
							$copyright_text, // phpcs:ignore
							'Royale News',
							'<a href="' . esc_url( 'https://themebeez.com' ) . '" rel="designer">Themebeez</a>'
						);
						?>
					</h5><!-- .copyright-text -->
					<?php
				} else {
					?>
					<h5 class="copyright-text">
						<?php
						/* translators: 1: theme name, 2: theme URL */
						printf( esc_html__( '%1$s by %2$s', 'royale-news' ), 'Royale News', '<a href="' . esc_url( 'https://themebeez.com' ) . '" rel="designer">Themebeez</a>' );
						?>
					</h5><!-- .copyright-text -->
					<?php
				}
				?>
			</div><!-- .copyright-container -->
		</div><!-- .col-md-6 -->
		<?php
	}
}
add_action( 'royale_news_copyright', 'royale_news_copyright_action', 10 );


if ( ! function_exists( 'royale_news_footer_menu_action' ) ) {
	/**
	 * Footer Menu declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function royale_news_footer_menu_action() {
		?>
		<div class="col-md-6">
			<div class="footer-menu-container">
				<?php
				if ( has_nav_menu( 'footer' ) ) {
					wp_nav_menu(
						array(
							'theme_location' => 'footer',
							'menu_class'     => 'footer-menu clearfix',
						)
					);
				}
				?>
			</div><!-- .footer-menu-container -->
		</div><!-- .col-md-6 -->
		<?php
	}
}
add_action( 'royale_news_footer_menu', 'royale_news_footer_menu_action', 10 );


if ( ! function_exists( 'royale_news_bottom_footer_after_action' ) ) {
	/**
	 * Bottom Footer After declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function royale_news_bottom_footer_after_action() {
		?>
		</div><!-- .row.clearfix.bottom-footer -->
		<?php
	}
}
add_action( 'royale_news_bottom_footer_after', 'royale_news_bottom_footer_after_action', 10 );


if ( ! function_exists( 'royale_news_footer_after_action' ) ) {
	/**
	 * Footer After declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function royale_news_footer_after_action() {
		?>
		</div><!-- .container -->
		</footer><!-- .footer -->
		<?php
	}
}
add_action( 'royale_news_footer_after', 'royale_news_footer_after_action', 10 );


if ( ! function_exists( 'royale_news_scroll_top_action' ) ) {
	/**
	 * Scroll Top Declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function royale_news_scroll_top_action() {

		$show_scroll_top = royale_news_get_option( 'royale_news_enable_scroll_top' );

		if ( true === $show_scroll_top || 1 === $show_scroll_top ) {
			?>
			<div class="scroll-top" id="scroll-top">
				<i class="fa fa-long-arrow-up"></i><!-- .fa.fa-long-arrow.up -->
			</div><!-- .scroll-top#scroll-top -->
			<?php
		}
	}
}
add_action( 'royale_news_scroll_top', 'royale_news_scroll_top_action', 10 );


if ( ! function_exists( 'royale_news_footer_action' ) ) {
	/**
	 * Footer Declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function royale_news_footer_action() {

		wp_footer();
		if ( get_background_image() ) {
			?>
			</div>
			<?php
		}
		?>
		</body>
		</html>
		<?php
	}
}
add_action( 'royale_news_footer', 'royale_news_footer_action', 10 );
