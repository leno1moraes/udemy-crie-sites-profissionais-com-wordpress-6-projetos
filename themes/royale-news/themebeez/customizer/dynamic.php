<?php
/**
 * Dynamic Options hook.
 *
 * This file contains option values from customizer
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Royale_News
 */

if ( ! function_exists( 'royale_news_dynamic_options' ) ) {
	/**
	 * Renders dynamic CSS.
	 *
	 * @since 1.0.0
	 */
	function royale_news_dynamic_options() {

		$site_title_font = royale_news_get_option( 'royale_news_site_title_font_size' );

		$body_font = royale_news_get_option( 'royale_news_body_font' );
		$body_font = json_decode( $body_font, true );

		$headings_font = royale_news_get_option( 'royale_news_headings_font' );
		$headings_font = json_decode( $headings_font, true );
		?>               
		<style>
			.site-title, .site-title a {
				font-size: <?php echo esc_attr( $site_title_font ); ?>px;
			}
			<?php
			if ( $body_font ) {
				?>
				body {
					<?php
					if (
						isset( $body_font['font_family'] ) &&
						! empty( $body_font['font_family'] )
					) {
						?>
						font-family: <?php echo esc_attr( $body_font['font_family'] ); ?>;
						<?php
					}
					if (
						isset( $body_font['font_weight'] ) &&
						! empty( $body_font['font_weight'] )
					) {
						?>
						font-weight: <?php echo esc_attr( $body_font['font_weight'] ); ?>;
						<?php
					}

					if (
						isset( $body_font['font_sizes']['desktop']['value'] ) &&
						! empty( $body_font['font_sizes']['desktop']['value'] )
					) {
						$desktop_font_size      = $body_font['font_sizes']['desktop']['value'];
						$desktop_font_size_unit = ( isset( $body_font['font_sizes']['desktop']['unit'] ) && ! empty( $body_font['font_sizes']['desktop']['unit'] ) ) ? $body_font['font_sizes']['desktop']['unit'] : 'px';
						?>
						font-size: <?php echo esc_attr( $desktop_font_size ) . esc_attr( $desktop_font_size_unit ); ?>;
						<?php
					}
					?>
				}
				<?php
				if (
					isset( $body_font['font_sizes']['desktop']['value'] ) &&
					! empty( $body_font['font_sizes']['desktop']['value'] )
				) {
					?>
					.widget_tag_cloud .tagcloud .tag-cloud-link {
						font-size: <?php echo esc_attr( $desktop_font_size ) . esc_attr( $desktop_font_size_unit ); ?> !important;
					}
					<?php
				}
				if (
					isset( $body_font['font_sizes']['tablet']['value'] ) &&
					! empty( $body_font['font_sizes']['tablet']['value'] )
				) {
					$tablet_font_size      = $body_font['font_sizes']['tablet']['value'];
					$tablet_font_size_unit = ( isset( $body_font['font_sizes']['tablet']['unit'] ) && ! empty( $body_font['font_sizes']['tablet']['unit'] ) ) ? $body_font['font_sizes']['tablet']['unit'] : 'px';
					?>
					@media (max-width: 768px) {
						body {
							font-size: <?php echo esc_attr( $tablet_font_size ) . esc_attr( $tablet_font_size_unit ); ?>;
						}
						.widget_tag_cloud .tagcloud .tag-cloud-link {
							font-size: <?php echo esc_attr( $tablet_font_size ) . esc_attr( $tablet_font_size_unit ); ?> !important;
						}
					}
					<?php
				}

				if (
					isset( $body_font['font_sizes']['mobile']['value'] ) &&
					! empty( $body_font['font_sizes']['mobile']['value'] )
				) {
					$mobile_font_size      = $body_font['font_sizes']['mobile']['value'];
					$mobile_font_size_unit = ( isset( $body_font['font_sizes']['mobile']['unit'] ) && ! empty( $body_font['font_sizes']['mobile']['unit'] ) ) ? $body_font['font_sizes']['mobile']['unit'] : 'px';
					?>
					@media (max-width: 567px) {
						body {
							font-size: <?php echo esc_attr( $mobile_font_size ) . esc_attr( $mobile_font_size_unit ); ?>;
						}
						.widget_tag_cloud .tagcloud .tag-cloud-link {
							font-size: <?php echo esc_attr( $mobile_font_size ) . esc_attr( $mobile_font_size_unit ); ?> !important;
						}
					}
					<?php
				}
			}

			if ( $headings_font ) {
				?>
				h1, h2, h3, h4, h5, h6, .section-title, .sidebar .widget-title {
					<?php
					if (
						isset( $headings_font['font_family'] ) &&
						! empty( $headings_font['font_family'] )
					) {
						?>
						font-family: <?php echo esc_attr( $headings_font['font_family'] ); ?>;
						<?php
					}
					if (
						isset( $headings_font['font_weight'] ) &&
						! empty( $headings_font['font_weight'] )
					) {
						?>
						font-weight: <?php echo esc_attr( $headings_font['font_weight'] ); ?>;
						<?php
					}
					?>
				}
				<?php
			}
			?>
		</style>
		<?php
	}
}
add_action( 'wp_head', 'royale_news_dynamic_options' );
