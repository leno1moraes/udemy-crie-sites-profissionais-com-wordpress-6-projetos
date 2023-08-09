<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Royale_News
 */

?>
<section class="no-results not-found">
	<header class="none-section-info clearfix">
		<h3 class="none-title"><?php esc_html_e( 'Nothing Found', 'royale-news' ); ?></h3>
	</header><!-- .page-header -->
	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) {
			?>
			<p>
				<?php
				printf(
					wp_kses(
						/* translators: 1: link to WP admin new post page. */
						__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'royale-news' ),
						array(
							'a' => array(
								'href' => array(),
							),
						)
					),
					esc_url( admin_url( 'post-new.php' ) )
				);
				?>
			</p>
			<?php
		} elseif ( is_search() ) {
			?>
			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'royale-news' ); ?></p>
			<?php
			get_search_form();
		} else {
			?>
			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'royale-news' ); ?></p>
			<?php
			get_search_form();
		}
		?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
