<?php
/**
 * Widget class definition for RN: Recent Posts.
 *
 * @since 1.0.0
 *
 * @package Royale_News
 */

if ( ! class_exists( 'Royale_News_Sidebar_Widget_One' ) ) {
	/**
	 * Widget class - Royale_News_Sidebar_Widget_One.
	 *
	 * @since 1.0.0
	 *
	 * @package Royale_News
	 */
	class Royale_News_Sidebar_Widget_One extends WP_Widget {
		/**
		 * Define id, name and description of the widget.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			parent::__construct(
				'royale-news-sidebar-widget-one',
				esc_html__( 'RN: Recent Posts', 'royale-news' ),
				array(
					'classname'   => 'royale-news-recent-posts recent-posts',
					'description' => esc_html__( 'Displays posts. Place it in "Sidebar" or "Footer Widget Area".', 'royale-news' ),
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

			$title   = apply_filters( 'widget_title', ! empty( $instance['title'] ) ? $instance['title'] : '', $instance, $this->id_base );
			$cat     = ! empty( $instance['cat'] ) ? $instance['cat'] : 0;
			$post_no = ! empty( $instance['post_no'] ) ? $instance['post_no'] : 6;

			echo $args['before_widget']; // phpcs:ignore

			if ( ! empty( $title ) ) {
				echo $args['before_title']; // phpcs:ignore
				echo esc_html( $title );
				echo $args['after_title']; // phpcs:ignore
			}

			$arguments_one = array(
				'cat'            => absint( $cat ),
				'posts_per_page' => absint( $post_no ),
			);

			$query_one = new WP_Query( $arguments_one );
			if ( $query_one->have_posts() ) {
				?>
				<div class="widget-content clearfix">
					<?php
					$i = 0;
					while ( $query_one->have_posts() ) {
						$query_one->the_post();
						if ( 0 === $i % 2 ) {
							?>
							<div class="clearfix visible-xs"></div>
							<?php
						}
						?>
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="row small-news-container">
								<div class="clearfix small-news-content">	
									<div class="small-thumbnail">
										<a href="<?php the_permalink(); ?>">
											<?php
											if ( has_post_thumbnail() ) {
												the_post_thumbnail(
													'royale-news-thumbnail-1',
													array(
														'class' => 'img-responsive',
													)
												);
											} else {
												?>
												<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/image-3.jpg' ); ?>" class="img-responsive" alt="<?php the_title_attribute(); ?>">
												<?php
											}
											?>
											<div class="mask"></div><!-- .mask -->
										</a>
									</div><!-- .small-thumbnail -->
									<div class="news-detail">
										<h5 class="news-title">
											<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
										</h5><!-- .news-title -->
										<div class="entry-meta">
											<?php
											royale_news_get_date();
											royale_news_get_comments_no();
											?>
										</div><!-- .entry-meta -->
									</div><!-- .news-detail -->
								</div><!-- .clearfix.small-news-content -->
							</div><!-- .small-news-container -->
						</div>
						<?php
						$i++;
					}
					wp_reset_postdata();
					?>
				</div>
				<?php
			}
			echo $args['after_widget']; // phpcs:ignore
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

			$instance['title']   = isset( $new_instance['title'] ) ? sanitize_text_field( $new_instance['title'] ) : '';
			$instance['cat']     = isset( $new_instance['cat'] ) ? absint( $new_instance['cat'] ) : 0;
			$instance['post_no'] = isset( $new_instance['post_no'] ) ? absint( $new_instance['post_no'] ) : 6;

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

			$title   = ! empty( $instance['title'] ) ? $instance['title'] : '';
			$cat     = ! empty( $instance['cat'] ) ? $instance['cat'] : 0;
			$post_no = ! empty( $instance['post_no'] ) ? $instance['post_no'] : 6;
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
					<strong><?php echo esc_html__( 'Title: ', 'royale-news' ); ?></strong>
				</label>
				<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>" class="widefat">
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'cat' ) ); ?>">
					<strong><?php echo esc_html__( 'Select Category: ', 'royale-news' ); ?></strong>
				</label>
				<?php
				$cat_args = array(
					'orderby'         => 'name',
					'hide_empty'      => 0,
					'id'              => $this->get_field_id( 'cat' ),
					'name'            => $this->get_field_name( 'cat' ),
					'class'           => 'widefat',
					'taxonomy'        => 'category',
					'selected'        => absint( $cat ),
					'show_option_all' => esc_html__( 'Show Recent Posts', 'royale-news' ),
				);
				wp_dropdown_categories( $cat_args );
				?>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'post_no' ) ); ?>">
					<strong><?php echo esc_html__( 'Post No: ', 'royale-news' ); ?></strong>
				</label>
				<input type="number" id="<?php echo esc_attr( $this->get_field_id( 'post_no' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_no' ) ); ?>" value="<?php echo esc_attr( $post_no ); ?>" class="widefat">
			</p>
			<?php
		}
	}
}
