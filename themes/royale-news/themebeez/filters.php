<?php
/**
 * Modifications of WordPress filter actions.
 *
 * @since 1.0.0
 *
 * @package Royale_News
 */

if ( ! function_exists( 'royale_news_search_form' ) ) {
	/**
	 * Search form of the theme.
	 *
	 * @since 1.0.0
	 */
	function royale_news_search_form() {

		return '<form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '" ><div class="input-group stylish-input-group"><label class="screen-reader-text" for="s">' . esc_html__( 'Search for:', 'royale-news' ) . '</label><input type="text" value="' . get_search_query() . '" name="s" class="form-control" /><span class="input-group-addon"><button type="submit" id="searchsubmit" value="' . esc_attr__( 'Search', 'royale-news' ) . '"><i class="fa fa-search"></i></button></span></div></form>';
	}
}
add_filter( 'get_search_form', 'royale_news_search_form', 20 );


if ( ! function_exists( 'royale_news_excerpt_more' ) ) {
	/**
	 * Trailing text for post excerpts.
	 *
	 * @param string $more The string shown within the more link.
	 * @return string
	 */
	function royale_news_excerpt_more( $more ) {

		if ( is_admin() ) {

			return $more;
		}
		return '';
	}
}
add_filter( 'excerpt_more', 'royale_news_excerpt_more' );


if ( ! function_exists( 'royale_news_excerpt_length' ) ) {
	/**
	 * Set the length of post excerpt.
	 *
	 * @since 1.0.0
	 *
	 * @param int $length Length of post excerpt.
	 * @return int
	 */
	function royale_news_excerpt_length( $length ) {

		if ( is_admin() ) {
			return $length;
		}

		$excerpt_length = royale_news_get_option( 'royale_news_excerpt_length' );

		if ( absint( $excerpt_length ) > 0 ) {
			$length = absint( $excerpt_length );
		}

		return apply_filters( 'royale_news_excerpt_length', $length );
	}
}
add_filter( 'excerpt_length', 'royale_news_excerpt_length' );



if ( ! function_exists( 'royale_news_comment_form_fields' ) ) {
	/**
	 * Add custom style of form field.
	 *
	 * @since 1.0.0
	 *
	 * @param array $fields Comment form fields.
	 */
	function royale_news_comment_form_fileds( $fields ) {

		$commenter = wp_get_current_commenter();
		$req       = get_option( 'require_name_email' );
		$aria_req  = ( $req ? " aria-required='true'" : '' );
		$html5     = current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;

		$fields = array(
			'author' => '<div class="form-group"><label for="author">' . esc_html__( 'Full Name *', 'royale-news' ) . '</label><input class="form-input" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . ' /></div>' . ( $req ? '<span class="required"></span>' : '' ),
			'email'  => '<div class="form-group"><label for="email">' . esc_html__( 'Email Address *', 'royale-news' ) . '</label><input class="form-input" id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_email'] ) . '" ' . $aria_req . ' /></div>' . ( $req ? '<span class="required"></span>' : '' ),

			'url'    => '<div class="form-group"><label for="url">' . esc_html__( 'Website', 'royale-news' ) . '</label><input class="form-input" id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" /></div>',
		);

		return $fields;
	}
}
add_filter( 'comment_form_default_fields', 'royale_news_comment_form_fileds' );



if ( ! function_exists( 'royale_news_comment_form' ) ) {
	/**
	 * Add custom default values of form.
	 *
	 * @since 1.0.0
	 *
	 * @param array $args Comment form parameters.
	 */
	function royale_news_comment_form( $args ) {

		$args['class_form']           = esc_attr__( 'comment_news comment-form', 'royale-news' );
		$args['title_reply']          = esc_html__( 'Leave comment', 'royale-news' );
		$args['title_reply_before']   = '<h3 class="reply-title">';
		$args['title_reply_after']    = '</h3>';
		$args['comment_notes_before'] = '<p>' . esc_html__( 'Your email address will not be published. Required fields are marked with *.', 'royale-news' ) . '</p>';
		$args['comment_field']        = '<div class="form-group"><label for="comment">' . esc_html__( 'Comment', 'royale-news' ) . '</label><textarea id="comment" name="comment" rows="5" aria-required="true"></textarea></div>';
		$args['class_submit']         = esc_attr__( 'btn btn-default submit-btn', 'royale-news' );
		$args['label_submit']         = esc_attr__( 'Post A Comment', 'royale-news' );

		return $args;
	}
}
add_filter( 'comment_form_defaults', 'royale_news_comment_form' );
