<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Royale_News
 */

?>
<div class="archive-section-content" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row clearfix archive-news-content">
		<div class="col-sm-6 gutter-right">
			<div class="news-image">
				<a href="<?php the_permalink(); ?>">
					<?php
					if ( has_post_thumbnail() ) {
						the_post_thumbnail(
							'royale-news-thumbnail-2',
							array(
								'class' => 'img-responsive',
								'alt'   => the_title_attribute(
									array(
										'echo' => false,
									)
								),
							)
						);
					} else {
						?>
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/image-1.jpg' ); ?>" class="img-responsive" alt="<?php the_title_attribute(); ?>">
						<?php
					}
					?>
					<div class="mask"></div>
				</a>
				<?php
				if ( 'post' === get_post_type() ) {
					royale_news_get_categories();
				}
				?>
			</div><!-- .news-image -->
		</div>
		<div class="col-sm-6 gutter-left">
			<div class="news-detail">
				<h4 class="news-title big-news-title">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h4><!-- .news-title -->
				<?php
				if ( 'post' === get_post_type() ) {
					?>
					<div class="entry-meta">
						<?php
						royale_news_get_date();
						royale_news_get_author();
						royale_news_get_comments_no();
						?>
					</div><!-- .entry-meta -->
					<?php
				}
				?>
				<div class="news-content">
					<?php the_excerpt(); ?>
					<a href="<?php the_permalink(); ?>" class="btn-more">
						<?php echo esc_html__( 'Read More', 'royale-news' ); ?>
					</a>
				</div><!-- .news-content -->
			</div><!-- .news-detail -->
		</div>
	</div><!-- .row.clearfix.archive-news-content -->
</div><!-- .archive-section-content #post-<?php the_ID(); ?> -->
