<?php
/**
 * Widget class definition for RN: Main Featured Posts With Slider.
 *
 * @since 1.0.0
 *
 * @package Royale_News
 */

if ( ! class_exists( 'Royale_News_Main_Featured_Posts_Two' ) ) {
	/**
	 * Widget class - Royale_News_Main_Featured_Posts_Two.
	 *
	 * @since 1.0.0
	 *
	 * @package Royale_News
	 */
	class Royale_News_Main_Featured_Posts_Two extends WP_Widget {

		/**
		 * Define id, name and description of the widget.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			parent::__construct(
				'royale-news-main-highlight-two',
				esc_html__( 'RN: Main Featured Posts With Slider', 'royale-news' ),
				array(
					'classname'   => '',
					'description' => esc_html__( 'Displays featured posts with layout similar to "RN: Main Featured Posts" widget but with slider. Place it in "Featured Posts Widget Area" widget area.', 'royale-news' ),
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

			$cat_1          = ! empty( $instance['cat_1'] ) ? $instance['cat_1'] : 0;
			$slider_post_no = ! empty( $instance['slider_post_no'] ) ? $instance['slider_post_no'] : 3;
			$cat_2          = ! empty( $instance['cat_2'] ) ? $instance['cat_2'] : 0;
			$cat_3          = ! empty( $instance['cat_3'] ) ? $instance['cat_3'] : 0;
			?>
			<div class="row clearfix highlight-section">
				<?php
				$left_args = array(
					'cat'            => absint( $cat_1 ),
					'posts_per_page' => absint( $slider_post_no ),
					'post__not_in'   => get_option( 'sticky_posts' ),
					'post_type'      => 'post',
				);

				$left_query = new WP_Query( $left_args );

				if ( $left_query->have_posts() ) {
					?>
					<div class="col-md-8 gutter-right">
						<div class="highlight-left">
							<div class="owl-carousel highlight-left-carousel">
								<?php
								while ( $left_query->have_posts() ) {

									$left_query->the_post();

									$thumbnail_image = '';

									if ( has_post_thumbnail() ) {

										$thumbnail_image = get_the_post_thumbnail_url( get_the_ID(), 'royale-news-thumbnail-4' );
									} else {

										$thumbnail_image = get_template_directory_uri() . '/assets/images/image-1.jpg';
									}
									?>
									<div class="item">
										<a href="<?php the_permalink(); ?>">
											<div class="highlight-fimg" style="background-image: url( <?php echo esc_url( $thumbnail_image ); ?> );">
												<div class="mask"></div><!-- .mask --></a>
											</div>
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
									</div><!-- .item -->
									<?php
								}
								wp_reset_postdata();
								?>
							</div><!-- .owl-carousel.highlight-left-carousel -->
						</div><!-- .highlight-left -->
					</div><!-- .gutter-right -->
					<?php
				}
				?>
				<div class="col-md-4 gutter-left">
					<?php
					$right_top_args = array(
						'cat'            => absint( $cat_2 ),
						'posts_per_page' => 1,
						'post__not_in'   => get_option( 'sticky_posts' ),
					);

					$right_top_query = new WP_Query( $right_top_args );

					if ( $right_top_query->have_posts() ) {

						while ( $right_top_query->have_posts() ) {

							$right_top_query->the_post();

							$thumbnail_image = '';

							if ( has_post_thumbnail() ) {

								$thumbnail_image = get_the_post_thumbnail_url( get_the_ID(), 'royale-news-thumbnail-4' );
							} else {

								$thumbnail_image = get_template_directory_uri() . '/assets/images/image-1.jpg';
							}
							?>
							<div class="highlight-right highlight-right-top" style="background-image: url( <?php echo esc_url( $thumbnail_image ); ?> );">
								<a href="<?php the_permalink(); ?>">
									<div class="mask"></div><!-- .mask -->
								</a>
								<?php royale_news_get_categories(); ?>
								<div class="highlight-info">
									<h4 class="news-title">
										<a href="<?php the_permalink(); ?>">
											<?php the_title(); ?>
										</a>
									</h4><!-- .news-title -->
									<div class="entry-meta">
										<?php
										royale_news_get_date();
										royale_news_get_author();
										royale_news_get_comments_no();
										?>
									</div><!-- .entry-meta -->
								</div><!-- .highlight-info -->
							</div><!-- .highlight-right.highlight-right-top -->
							<?php
						}
						wp_reset_postdata();
					}

					$right_bottom_args  = array(
						'cat'            => absint( $cat_3 ),
						'posts_per_page' => 1,
						'post__not_in'   => get_option( 'sticky_posts' ),
					);
					$right_bottom_query = new WP_Query( $right_bottom_args );

					if ( $right_bottom_query->have_posts() ) {

						while ( $right_bottom_query->have_posts() ) {

							$right_bottom_query->the_post();

							$thumbnail_image = '';

							if ( has_post_thumbnail() ) {

								$thumbnail_image = get_the_post_thumbnail_url( get_the_ID(), 'royale-news-thumbnail-4' );
							} else {

								$thumbnail_image = get_template_directory_uri() . '/assets/images/image-1.jpg';
							}
							?>
							<div class="highlight-right highlight-right-bottom" style="background-image: url( <?php echo esc_url( $thumbnail_image ); ?> );">
								<a href="<?php the_permalink(); ?>">
									<div class="mask"></div><!-- .mask -->
								</a>
								<?php royale_news_get_categories(); ?>
								<div class="highlight-info">
									<h4 class="news-title">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</h4><!-- .news-title -->
									<div class="entry-meta">
										<?php
										royale_news_get_date();
										royale_news_get_author();
										royale_news_get_comments_no();
										?>
									</div><!-- .entry-meta -->
								</div><!-- .highlight-info -->
							</div><!-- .highlight-right.highlight-right-bottom -->
							<?php
						}
						wp_reset_postdata();
					}
					?>
				</div><!-- .gutter-left -->
			</div><!-- .row.clearfix.section.highlight-section -->
			<?php
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

			$instance['cat_1']          = isset( $new_instance['cat_1'] ) ? absint( $new_instance['cat_1'] ) : 0;
			$instance['slider_post_no'] = isset( $new_instance['slider_post_no'] ) ? absint( $new_instance['slider_post_no'] ) : 3;
			$instance['cat_2']          = isset( $new_instance['cat_2'] ) ? absint( $new_instance['cat_2'] ) : 0;
			$instance['cat_3']          = isset( $new_instance['cat_3'] ) ? absint( $new_instance['cat_3'] ) : 0;

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

			$cat_1          = ! empty( $instance['cat_1'] ) ? $instance['cat_1'] : 0;
			$slider_post_no = ! empty( $instance['slider_post_no'] ) ? $instance['slider_post_no'] : 3;
			$cat_2          = ! empty( $instance['cat_2'] ) ? $instance['cat_2'] : 0;
			$cat_3          = ! empty( $instance['cat_3'] ) ? $instance['cat_3'] : 0;
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'cat_1' ) ); ?>">
					<?php echo esc_html__( 'Left Highlight:', 'royale-news' ); ?>
				</label>
				<br>
				<?php
				$cat_args_1 = array(
					'orderby'         => 'name',
					'hide_empty'      => 0,
					'id'              => $this->get_field_id( 'cat_1' ),
					'name'            => $this->get_field_name( 'cat_1' ),
					'class'           => 'widefat',
					'taxonomy'        => 'category',
					'selected'        => absint( $cat_1 ),
					'show_option_all' => esc_html__( 'Show Recent Posts', 'royale-news' ),
				);
				wp_dropdown_categories( $cat_args_1 );
				?>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'slider_post_no' ) ); ?>">
					<strong><?php echo esc_html__( 'Slider Post No: ', 'royale-news' ); ?></strong>
				</label>
				<input type="number" id="<?php echo esc_attr( $this->get_field_id( 'slider_post_no' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'slider_post_no' ) ); ?>" value="<?php echo esc_attr( $slider_post_no ); ?>" class="widefat">
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'cat_2' ) ); ?>">
					<?php echo esc_html__( 'Right Top Highlight:', 'royale-news' ); ?>
				</label>
				<?php
				$cat_args_2 = array(
					'orderby'         => 'name',
					'hide_empty'      => 0,
					'id'              => $this->get_field_id( 'cat_2' ),
					'name'            => $this->get_field_name( 'cat_2' ),
					'class'           => 'widefat',
					'taxonomy'        => 'category',
					'selected'        => absint( $cat_2 ),
					'show_option_all' => esc_html__( 'Show Recent Posts', 'royale-news' ),
				);
				wp_dropdown_categories( $cat_args_2 );
				?>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'cat_3' ) ); ?>">
					<?php echo esc_html__( 'Right Bottom Highlight:', 'royale-news' ); ?>
				</label>
				<br>
				<?php
				$cat_args_3 = array(
					'orderby'         => 'name',
					'hide_empty'      => 0,
					'id'              => $this->get_field_id( 'cat_3' ),
					'name'            => $this->get_field_name( 'cat_3' ),
					'class'           => 'widefat',
					'taxonomy'        => 'category',
					'selected'        => absint( $cat_3 ),
					'show_option_all' => esc_html__( 'Show Recent Posts', 'royale-news' ),
				);
				wp_dropdown_categories( $cat_args_3 );
				?>
			</p>
			<?php
		}
	}
}
