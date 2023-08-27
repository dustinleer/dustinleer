<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Dustin_Leer
 */


if ( ! function_exists( 'dustinleer_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function dustinleer_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		/* translators: %s: post date. */
		'<i class="far fa-calendar-alt"></i> ' . esc_html_x( 'Posted on %s', 'post date', 'dustinleer' ),
		'<span>' . $time_string . '</span>'
	);

	$authorName = get_the_author_meta('user_firstname');
	$authorID = get_the_author_meta( 'ID' );
	$authorImg = get_avatar_url( $authorID );

	$byline = sprintf(
		/* translators: %s: post author. */
		esc_html_x( 'Written by %s', 'post author', 'dustinleer' ),
		'<span class="author vcard"><strong class="author-name">' . esc_html( get_the_author() ) . '</strong></span><img class="post-avatar" alt="Author avatar of ' . esc_html( get_the_author() ) . '" src="' . ($authorImg) . '" />'
	);

	// echo '<span class="meta-author"> ' . $byline . '</span>'; // WPCS: XSS OK.
	$comments = get_comments_number();
	if ( $comments == '0') {
		$comments = 'There are no comments<span class="ico">😞</span>';
	} else if ( $comments <= '1' ) {
		$comments = $comments . ' Reader has commented<span class="ico">👏🏻</span>';
	} else {
		$comments = $comments . ' Readers have commented<span class="ico">👏🏻</span>';
	}

	echo '<div class="entry-meta">';
		echo '<div class="meta-wrap">';
			echo '<div class="meta-date">';
				echo '<span class="meta-wrap">' . $posted_on . '</span>';
			echo '</div>';
			echo '<div class="meta-comments">';
				echo '<i class="fas fa-comments"></i>';
				echo '<a href="' . esc_url( get_permalink() ) . '#comments">' . $comments . '</a>';
			echo '</div>';
		echo '</div>';
		echo '<div class="meta-author">' . $byline . '</div>';
	echo '</div><!-- .entry-meta -->';
}
endif;

// Add alt tag to WordPress Gravatar images

function dustinleer_gravatar_alt($dustinleerGravatar) {
	if (have_comments()) {
		$alt = get_comment_author();
	}
	else {
		$alt = get_the_author_meta('display_name');
	}
	$dustinleerGravatar = str_replace('alt=\'\'', 'alt=\'Author avatar for ' . $alt . '\'', $dustinleerGravatar);
	return $dustinleerGravatar;
}
add_filter('get_avatar', 'dustinleer_gravatar_alt');

if ( ! function_exists( 'dustinleer_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function dustinleer_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'dustinleer' ) );
		if ( $categories_list && dustinleer_categorized_blog() ) {
			/* translators: 1: list of categories. */
			printf( '<i class="fas fa-archive"></i><span class="cat-links">' . esc_html__( '%1$s', 'dustinleer' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'dustinleer' ) );
		if ( $tags_list ) {
			/* translators: 1: list of tags. */
			printf( '<i class="fas fa-tags"></i><span class="tags-links">' . esc_html__( '%1$s', 'dustinleer' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link(
			sprintf(
				wp_kses(
					/* translators: %s: post title */
					__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'dustinleer' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			)
		);
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Edit <span class="screen-reader-text">%s</span>', 'dustinleer' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function dustinleer_categorized_blog() {
	$all_the_cool_cats = get_transient( 'dustinleer_categories' );
	if ( false === $all_the_cool_cats ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'dustinleer_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 || is_preview() ) {
		// This blog has more than 1 category so dustinleer_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so dustinleer_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in dustinleer_categorized_blog.
 */
function dustinleer_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'dustinleer_categories' );
}
add_action( 'edit_category', 'dustinleer_category_transient_flusher' );
add_action( 'save_post',     'dustinleer_category_transient_flusher' );
