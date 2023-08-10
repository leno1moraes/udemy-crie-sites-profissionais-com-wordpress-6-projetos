<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Royale_News
 */

get_header();

/**
* Hook - royale_news_breadcrumb.
*
* @hooked royale_news_breadcrumb_action - 10
*/
do_action( 'royale_news_breadcrumb' );

$royale_news_sidebar_position = royale_news_get_option( 'royale_news_sidebar_position' );

$primary_container_class = '';

if ( 'left' === $royale_news_sidebar_position || 'right' === $royale_news_sidebar_position ) {
	$primary_container_class = 'royale-news-sidebar-position-' . $royale_news_sidebar_position;
}
?>
<div id="primary" class="content-area <?php royale_news_inner_container_class(); ?> <?php echo esc_attr( $primary_container_class ); ?>">
	<main id="main" class="site-main">
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
					<div class="row clearfix news-section news-section-three">
						<div class="col-md-12">
							<div class="news-section-info clearfix">
								<?php the_archive_title( '<h3 class="section-title">', '</h3>' ); ?>									
							</div><!-- .news-section-info -->
							<div class="archive-description news-section">
								<?php the_archive_description( '<p>', '</p>' ); ?>
							</div><!-- .archive-description -->
						</div>
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
							</div>
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
					</div><!--.row.clearfix.news-section.news-section-three-->
				</div>
				<?php
				if ( 'right' === $royale_news_sidebar_position ) {
					get_sidebar();
				}
				?>
			</div><!-- .row.section -->
		</div><!-- .container -->
	</main><!-- .main-container -->
</div><!-- #primary.content-area -->
<?php
get_footer();
