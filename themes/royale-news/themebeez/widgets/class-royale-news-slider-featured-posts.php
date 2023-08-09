<?php
/**
 * Widget class definition for RN: Slider Featured Posts.
 *
 * @since 1.0.0
 *
 * @package Royale_News
 */

if ( ! class_exists( 'Royale_News_Slider_Featured_Posts' ) ) {
	/**
	 * Widget class - Royale_News_Slider_Featured_Posts.
	 *
	 * @since 1.0.0
	 *
	 * @package Royale_News
	 */
	class Royale_News_Slider_Featured_Posts extends WP_Widget {

		/**
		 * Define id, name and description of the widget.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			parent::__construct(
				'royale-news-slider-highlight',
				esc_html__( 'RN: Slider Featured Posts', 'royale-news' ),
				array(
					'classname'   => '',
					'description' => esc_html__( 'Displays posts as featured posts in Slider. Place it in "Featured Posts Wiget Area" widget area. It only works in the widget area.', 'royale-news' ),
				)
			);
		}

		/**
		 * Renders widget at the frontend.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args Provides the HTML you can use to display the widget title class and widget content class.
		 * @param array $instance The settings for the instance of the widget..
		 */
		public function widget( $args, $instance ) {

			$cat     = ! empty( $instance['cat'] ) ? $instance['cat'] : '';
			$post_no = ! empty( $instance['post_no'] ) ? $instance['post_no'] : 5;

			$slider_arguments = array(
				'cat'            => $cat,
				'posts_per_page' => absint( $post_no ),
				'post_type'      => 'post',
				'post__not_in'   => get_option( 'sticky_posts' ),
			);

			$slider_query = new WP_Query( $slider_arguments );

			if ( $slider_query->have_posts() ) {
				?>
				<div class="row clearfix highlight-section">
					<div class="col-sm-12">
						<div class="owl-carousel highlight-carousel">
							<?php
							while ( $slider_query->have_posts() ) {

								$slider_query->the_post();

								$thumbnail_image = '';

								if ( has_post_thumbnail() ) {

									$thumbnail_image = get_the_post_thumbnail_url( get_the_ID(), 'royale-news-thumbnail-4' );
								} else {

									$thumbnail_image = get_template_directory_uri() . '/assets/images/image-1.jpg';
								}
								?>
								<div class="item">
									<div class="news-highlight-content" style="background-image: url( <?php echo esc_url( $thumbnail_image ); ?> );">
										<a href="<?php the_permalink(); ?>">
											<div class="mask"></div><!-- .mask -->
										</a>
										<?php royale_news_get_categories(); ?>
										<div class="highlight-info">
											<h3 class="news-title">
												<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
											</h3><!-- .news-title -->
											<div class="entry-meta">
												<?php
												royale_news_get_date();
												royale_news_get_author();
												royale_news_get_comments_no();
												?>
											</div><!-- .entry-meta -->
										</div><!-- .highlight-info -->
									</div><!-- .news-highlight-content -->
								</div><!-- .item -->
								<?php
							}
							wp_reset_postdata();
							?>
						</div><!-- .owl-carousel.highlight-carousel -->
					</div>
				</div><!-- .row.clearfix.section.highlight-section -->
				<?php
			}
		}

		/**
		 * Sanitizes and saves the instance of the widget.
		 *
		 * @since 1.0.0
		 *
		 * @param array $new_instance The settings for the new instance of the widget.
		 * @param array $old_instance The settings for the old instance of the widget.
		 * @return array Sanitized instance of the widget.
		 */
		public function update( $new_instance, $old_instance ) {

			$instance = $old_instance;

			$instance['cat']     = isset( $new_instance['cat'] ) ? $new_instance['cat'] : array();
			$instance['post_no'] = isset( $new_instance['post_no'] ) ? absint( $new_instance['post_no'] ) : 5;

			return $instance;
		}

		/**
		 * Adds setting fields to the widget and renders them in the form.
		 *
		 * @since 1.0.0
		 *
		 * @param array $instance The settings for the instance of the widget..
		 */
		public function form( $instance ) {

			$defaults = array(
				'cat'     => array(),
				'post_no' => 5,
			);

			$instance = wp_parse_args( (array) $instance, $defaults );
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'cat' ) ); ?>">
					<strong><?php echo esc_html__( 'Select Category: ', 'royale-news' ); ?></strong>
				</label>
				<span class="widget_multicheck">
				<br>
				<?php
				$categories = get_terms(
					array( 'category' ),
					array(
						'fields' => 'ids',
					)
				);

				array_unshift( $categories, 0 );

				foreach ( $categories as $cat ) {
					?>
					<input
						id="<?php echo esc_attr( $this->get_field_id( 'cat' ) . $cat ); ?>"
						name="<?php echo esc_attr( $this->get_field_name( 'cat' ) ); ?>[]"
						type="checkbox"
						value="<?php echo esc_attr( $cat ); ?>"
						<?php
						if ( ! empty( $instance['cat'] ) ) {
							foreach ( $instance['cat'] as $checked ) {
								checked( $checked, $cat, true );
							}
						}
						?>
					>
					<?php
					if ( 0 === $cat ) {
						echo esc_html__( 'Latest Posts', 'royale-news' );
					} else {
						echo esc_html( get_cat_name( $cat ) );
					}
					?>
					<br>
					<?php
				}
				?>
				</span>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'post_no' ) ); ?>">
					<strong><?php echo esc_html__( 'Post No: ', 'royale-news' ); ?></strong>
				</label>
				<input type="number" id="<?php echo esc_attr( $this->get_field_id( 'post_no' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_no' ) ); ?>" value="<?php echo esc_attr( $instance['post_no'] ); ?>" class="widefat">
			</p>
			<?php
		}
	}
}
