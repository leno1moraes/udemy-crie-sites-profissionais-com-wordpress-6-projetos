<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Royale_News
 */

if ( ! function_exists( 'royale_news_get_author' ) ) {
	/**
	 * Renders post author.
	 *
	 * @since 1.0.0
	 */
	function royale_news_get_author() {

		if ( 'post' !== get_post_type() ) {
			return;
		}

		$show_author = royale_news_get_option( 'royale_news_show_author' );

		if ( true === $show_author || 1 === $show_author ) {
			?>
			<span class="author vcard">
				<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( get_the_author() ); ?></a>
			</span>
			<?php
		}
	}
}

if ( ! function_exists( 'royale_news_get_date' ) ) {
	/**
	 * Renders posted date.
	 *
	 * @since 1.0.0
	 */
	function royale_news_get_date() {

		if ( 'post' !== get_post_type() ) {
			return;
		}

		$show_date = royale_news_get_option( 'royale_news_show_date' );

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		if ( true === $show_date || 1 === $show_date ) {
			?>
			<span class="posted-date">
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php echo $time_string; // phpcs:ignore ?></a>
			</span>
			<?php
		}
	}
}


if ( ! function_exists( 'royale_news_get_categories' ) ) {
	/**
	 * Renders post categories.
	 *
	 * @since 1.0.0
	 */
	function royale_news_get_categories() {

		if ( 'post' !== get_post_type() ) {
			return;
		}

		$show_categories = royale_news_get_option( 'royale_news_show_categories' );

		if ( true === $show_categories || 1 === $show_categories ) {

			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( ' ' );

			if ( $categories_list ) {
				?>
				<span class="cat-links"><?php echo $categories_list; // phpcs:ignore ?></span>
				<?php
			}
		}
	}
}

if ( ! function_exists( 'royale_news_get_comments_no' ) ) {
	/**
	 * Renders comments number on a post.
	 *
	 * @since 1.0.0
	 */
	function royale_news_get_comments_no() {

		if ( 'post' !== get_post_type() ) {
			return;
		}

		$show_comments_no = royale_news_get_option( 'royale_news_show_comments_no' );

		// Get_comments_number returns only a numeric value.
		$num_comments = get_comments_number();

		if ( ( true === $show_comments_no || 1 === $show_comments_no ) && comments_open() ) {
			?>
			<span class="comments-link">
				<a href="<?php the_permalink(); ?>"><?php echo esc_html( number_format_i18n( $num_comments ) ); ?></a>
			</span>
			<?php
		}
	}
}
