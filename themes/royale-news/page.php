<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
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
					<div class="row">
						<?php
						while ( have_posts() ) {

							the_post();

							get_template_part( 'template-parts/content', 'page' );

							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;

						} // End of the loop.
						?>
					</div><!-- .row.clearfix.news-section -->
				</div>
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
