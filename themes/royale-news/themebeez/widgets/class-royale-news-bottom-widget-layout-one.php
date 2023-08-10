<?php
/**
 * Widget class definition for RN: Bottom News Layout One.
 *
 * @since 1.0.0
 *
 * @package Royale_News
 */

if ( ! class_exists( 'Royale_News_Bottom_Widget_Layout_One' ) ) {
	/**
	 * Widget class - Royale_News_Bottom_Widget_Layout_One.
	 *
	 * @since 1.0.0
	 *
	 * @package Royale_News
	 */
	class Royale_News_Bottom_Widget_Layout_One extends WP_Widget {
		/**
		 * Define id, name and description of the widget.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			parent::__construct(
				'royale-news-bottom-news-widget-one',
				esc_html__( 'RN: Bottom News Layout One', 'royale-news' ),
				array(
					'classname'   => 'bottom-news-section-one',
					'description' => esc_html__( 'Bottom News Layout One. Place it within "FrontPage Bottom Widget Area"', 'royale-news' ),
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
			$post_no = ! empty( $instance['post_no'] ) ? $instance['post_no'] : 5;
			echo $args['before_widget']; // phpcs:ignore
			?>
			<div class="news-widget-container">
				<div class="news-section-info clearfix">
					<?php
					if ( ! empty( $title ) ) {
						echo $args['before_title']; // phpcs:ignore
						echo esc_html( $title );
						echo $args['after_title']; // phpcs:ignore
					}
					?>
				</div>
				<?php
				$news_args = array(
					'cat'            => $cat,
					'posts_per_page' => absint( $post_no ),
				);

				$news_query = new WP_Query( $news_args );

				if ( $news_query->have_posts() ) {
					?>
					<div class="bottom-news-content news-section-content">
						<div class="row clearfix">
							<?php
							$i = 0;
							while ( $news_query->have_posts() ) {
								$news_query->the_post();
								if ( 0 === $i % 3 && $i > 0 ) {
									?>
									<div class="row clearfix visible-lg visible-md hidden-sm hidden-xs"></div>
									<?php
								}

								if ( 0 === $i % 2 && $i > 0 ) {
									?>
									<div class="row clearfix visible-sm visible-xs hidden-md hidden-lg"></div>
									<?php
								}
								?>
								<div class="col-md-4 col-sm-6">
									<div class="clearfix small-news-content">
										<div class="small-thumbnail">
											<a href="<?php the_permalink(); ?>">
												<?php
												if ( has_post_thumbnail() ) {
													the_post_thumbnail( 'royale-news-thumbnail-1', array( 'class' => 'img-responsive' ) );
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
											<h5 class="news-title small-news-title">
												<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
											</h5><!-- .news-title -->
											<div class="entry-meta">
												<?php royale_news_get_date(); ?>
												<?php royale_news_get_comments_no(); ?>    
											</div><!-- .entry-meta -->
										</div><!-- .news-detail -->
									</div><!-- .clearfix.small-news-content -->
								</div>
								<?php
								$i++;
							}
							wp_reset_postdata();
							?>
						</div>
					</div>
					<?php
				}
				?>
			</div>
			<?php
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
				'title'   => '',
				'cat'     => array(),
				'post_no' => 5,
			);
			$instance = wp_parse_args( (array) $instance, $defaults );
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><strong><?php echo esc_html__( 'Title: ', 'royale-news' ); ?></strong></label>
				<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat">
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'cat' ) ); ?>"><strong><?php echo esc_html__( 'Select Category:', 'royale-news' ); ?></strong></label>
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
								echo wp_kses_post( get_cat_name( $cat ) );
							}
							?>
						<br>
						<?php
					}
					?>
				</span>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'post_no' ) ); ?>"><strong><?php echo esc_html__( 'Post No: ', 'royale-news' ); ?></strong></label>
				<input type="number" id="<?php echo esc_attr( $this->get_field_id( 'post_no' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_no' ) ); ?>" value="<?php echo esc_attr( $instance['post_no'] ); ?>" class="widefat">
			</p>
			<?php
		}
	}
}
