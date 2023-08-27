<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Dustin_Leer
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
        <?php
			// Variables
			$featured = get_the_post_thumbnail_url( $post, 'full' );
            $authorID = get_the_author_meta( 'ID' );
            $authorImg = get_avatar_url( $authorID );
			$comments = get_comments_number();
            
            if ( $comments == '0') {
                $comments = 'There are no comments<span class="ico">😞</span>';
            } else {
                $comments = $comments . ' Readers have commented<span class="ico">👏🏻</span>';
            }

			echo '<div class="blog-post-featured" style="background-image: url(' . $featured . ');">';
                echo '<a class="cover-link" href="' . esc_url( get_permalink() ) . '">';    
                    echo get_the_post_thumbnail( $post, 'full', array( 'class' => 'center hidden' ) );
                echo '</a>';
			echo '</div>';


            
			if ( is_singular() ) {
                the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
                the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}
            
			if ( 'post' === get_post_type() ) {
				echo dustinleer_posted_on();
			}
		?>
	</header><!-- .entry-header -->

	<div class="entry-content">
        <?php
            $content = wp_trim_words( get_the_content() , '55' );
            echo apply_filters('the_content', $content);
			echo '<a class="button" href="' . get_permalink() . '">Read More</a>';

			// the_content( sprintf(
			// 	wp_kses(
			// 		/* translators: %s: Name of current post. Only visible to screen readers */
			// 		__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'dustinleer' ),
			// 		array(
			// 			'span' => array(
			// 				'class' => array(),
			// 			),
			// 		)
			// 	),
			// 	get_the_title()
			// ) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'dustinleer' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php // dustinleer_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
