<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Royale_News
 */

get_header();
$royale_news_sidebar_position = royale_news_get_option( 'royale_news_sidebar_position' );

$primary_container_class = '';

if ( 'left' === $royale_news_sidebar_position || 'right' === $royale_news_sidebar_position ) {
	$primary_container_class = 'royale-news-sidebar-position-' . $royale_news_sidebar_position;
}
?>
<div id="primary" class="content-area <?php royale_news_home_inner_container_class(); ?> <?php echo esc_attr( $primary_container_class ); ?>">
	<main id="main" class="site-main">
		<?php

		$royale_news_enable_feature = royale_news_get_option( 'royale_news_enable_featured_post' );

		if (
			is_active_sidebar( 'sidebar-2' ) &&
			( true === $royale_news_enable_feature || 1 === $royale_news_enable_feature )
		) {
			?>
			<div class="featured-widget-container">
				<div class="container">
				<?php dynamic_sidebar( 'sidebar-2' ); ?>
				</div><!-- .container -->
			</div>
			<?php
		}
		?>
		<div class="container">
			<div class="row">
				<?php
				if (
					'none' === $royale_news_sidebar_position ||
					! is_active_sidebar( 'sidebar-1' )
				) {
					$class = 'col-md-12';
				} else {
					$class = 'col-md-8 sticky-section';
				}

				if ( 'left' === $royale_news_sidebar_position ) {
					get_sidebar();
				}
				?>
				<div class="<?php echo esc_attr( $class ); ?>">
					<div class="row">
						<?php
						if ( have_posts() ) {
							?>
							<div class="col-md-12">
								<?php
								/* Start the Loop */
								while ( have_posts() ) {

									the_post();

									/*
										* Include the Post-Format-specific template for the content.
										* If you want to override this in a child theme, then include a file
										* called content-___.php (where ___ is the Post Format name) and that will be used instead.
										*/
									get_template_part( 'template-parts/content', get_post_format() );

								}
								?>
							</div><!-- .col-md-12 -->
							<?php
							/**
							 * Hook - royale_news_pagination.
							 *
							 * @hooked royale_news_pagination_action - 10
							 */
							do_action( 'royale_news_pagination' );
						} else {
							?>
							<div class="col-md-12">
								<?php get_template_part( 'template-parts/content', 'none' ); ?>
							</div>
							<?php
						}
						?>
					</div><!-- .row.clearfix.news-section -->
				</div><!-- .esc_attr( $class ) -->

				<?php
				if ( 'right' === $royale_news_sidebar_position ) {
					get_sidebar();
				}
				?>
			</div><!-- .row.section -->
		</div><!-- .container -->
	</main><!-- .main-container -->
</div>
<?php
get_footer();
