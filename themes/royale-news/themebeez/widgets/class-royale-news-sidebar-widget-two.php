<?php
/**
 * Widget class definition for RN: Main Featured Posts With Slider.
 *
 * @since 1.0.0
 *
 * @package RN: Social Widget
 */

if ( ! class_exists( 'Royale_News_Sidebar_Widget_Two' ) ) {
	/**
	 * Widget class - Royale_News_Sidebar_Widget_Two.
	 *
	 * @since 1.0.0
	 *
	 * @package Royale_News
	 */
	class Royale_News_Sidebar_Widget_Two extends WP_Widget {
		/**
		 * Define id, name and description of the widget.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			$opts = array(
				'classname'   => 'royale-news-social-widget',
				'description' => esc_html__( 'Social Links Widget. Place it in "Sidebar".', 'royale-news' ),
			);

			parent::__construct( 'royale-news-social-widget', esc_html__( 'RN: Social Widget', 'royale-news' ), $opts );
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

			$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

			$facebook  = ! empty( $instance['facebook'] ) ? $instance['facebook'] : '';
			$twitter   = ! empty( $instance['twitter'] ) ? $instance['twitter'] : '';
			$instagram = ! empty( $instance['instagram'] ) ? $instance['instagram'] : '';
			$linkedin  = ! empty( $instance['linkedin'] ) ? $instance['linkedin'] : '';
			$youtube   = ! empty( $instance['youtube'] ) ? $instance['youtube'] : '';

			echo $args['before_widget']; // phpcs:ignore

			if ( ! empty( $title ) ) {
				echo $args['before_title']; // phpcs:ignore
				echo esc_html( $title );
				echo $args['after_title']; // phpcs:ignore
			}
			?>
			<div class="widget-social-links">
				<ul class="social-links-list">
					<?php
					if ( ! empty( $facebook ) ) {
						?>
						<li class="facebook-link">
							<a href="<?php echo esc_attr( esc_url( $facebook ) ); ?>" class="clearfix">
								<?php esc_html_e( 'Facebook', 'royale-news' ); ?>
								<span class="social-icon">
									<i class="fa fa-facebook"></i>
								</span>                        		
							</a>
						</li>
						<?php
					}

					if ( ! empty( $twitter ) ) {
						?>
						<li class="twitter-link">
							<a href="<?php echo esc_attr( esc_url( $twitter ) ); ?>" class="clearfix">
								<?php esc_html_e( 'Twitter', 'royale-news' ); ?>
								<span class="social-icon">
									<i class="fa fa-twitter"></i>
								</span>
							</a>
						</li>
						<?php
					}

					if ( ! empty( $instagram ) ) {
						?>
						<li class="instagram-link">
							<a href="<?php echo esc_attr( esc_url( $instagram ) ); ?>" class="clearfix">
								<?php esc_html_e( 'Instagram', 'royale-news' ); ?>
								<span class="social-icon">
									<i class="fa fa-instagram"></i>
								</span>
							</a>
						</li>
						<?php
					}

					if ( ! empty( $linkedin ) ) {
						?>
						<li class="linkedin-link">
							<a href="<?php echo esc_attr( esc_url( $linkedin ) ); ?>" class="clearfix">
								<?php esc_html_e( 'Linked In', 'royale-news' ); ?>
								<span class="social-icon">
									<i class="fa fa-linkedin"></i>
								</span>
							</a>
						</li>
						<?php
					}

					if ( ! empty( $youtube ) ) {
						?>
						<li class="youtube-link">
							<a href="<?php echo esc_attr( esc_url( $youtube ) ); ?>" class="clearfix">
								<?php esc_html_e( 'Youtube', 'royale-news' ); ?>
								<span class="social-icon">
									<i class="fa fa-youtube-play"></i>
								</span>
							</a>
						</li>
						<?php
					}
					?>
				</ul>
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

			$instance['title']     = isset( $new_instance['title'] ) ? sanitize_text_field( $new_instance['title'] ) : '';
			$instance['facebook']  = isset( $new_instance['facebook'] ) ? esc_url_raw( $new_instance['facebook'] ) : '';
			$instance['twitter']   = isset( $new_instance['twitter'] ) ? esc_url_raw( $new_instance['twitter'] ) : '';
			$instance['instagram'] = isset( $new_instance['instagram'] ) ? esc_url_raw( $new_instance['instagram'] ) : '';
			$instance['linkedin']  = isset( $new_instance['linkedin'] ) ? esc_url_raw( $new_instance['linkedin'] ) : '';
			$instance['youtube']   = isset( $new_instance['youtube'] ) ? esc_url_raw( $new_instance['youtube'] ) : '';

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

			$instance = wp_parse_args(
				(array) $instance,
				array(
					'title'     => '',
					'facebook'  => '',
					'twitter'   => '',
					'instagram' => '',
					'linkedin'  => '',
					'youtube'   => '',
				)
			);
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
					<strong><?php esc_html_e( 'Title: ', 'royale-news' ); ?></strong>
				</label>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>">
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>">
					<strong><?php esc_html_e( 'Facebook Link:', 'royale-news' ); ?></strong>
				</label>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'facebook' ) ); ?>" value="<?php echo esc_attr( $instance['facebook'] ); ?>">
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>">
					<strong><?php esc_html_e( 'Twitter Link:', 'royale-news' ); ?></strong>
				</label>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'twitter' ) ); ?>" value="<?php echo esc_attr( $instance['twitter'] ); ?>">
			</p> 

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'instagram' ) ); ?>">
					<strong><?php esc_html_e( 'Instagram Link:', 'royale-news' ); ?></strong>
				</label>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'instagram' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'instagram' ) ); ?>" value="<?php echo esc_attr( $instance['instagram'] ); ?>">
			</p> 

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'linkedin' ) ); ?>">
					<strong><?php esc_html_e( 'linkedin Link:', 'royale-news' ); ?></strong>
				</label>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'linkedin' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'linkedin' ) ); ?>" value="<?php echo esc_attr( $instance['linkedin'] ); ?>">
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'youtube' ) ); ?>">
					<strong><?php esc_html_e( 'Youtube Link:', 'royale-news' ); ?></strong>
				</label>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'youtube' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'youtube' ) ); ?>" value="<?php echo esc_attr( $instance['youtube'] ); ?>">
			</p>           
			<?php
		}
	}
}
