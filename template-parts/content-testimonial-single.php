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
<?php
	$img  = get_field( 'headshot' );
	$img_alt = $img['alt'];
	$img_url = $img['url'];

	$work_title = get_field( 'job_title' );
	$work_link_array = get_field( 'link' );
	$link = $work_link_array['url'];
	$title = $work_link_array['title'];
	$target = $work_link_array['target'];

	$excerpt = get_the_excerpt();
	
	if ( $img ) {
		echo '<img class="content-img" src="' . $img_url . '" width="' . $img['width'] . '" height="' . $img['height'] . '" alt="' . $img_alt . '" />';
	}
?>
	<header class="entry-header">
		<?php
		if ( is_singular() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
		} else {
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		}

		if ( $work_link_array ) {
			echo '<a class="dark" href="' . $link . '" target="' . $target . '">' . $title . '</a>';
		}

		if ( 'post' === get_post_type() ) { ?>
		<div class="entry-meta">
			<?php dustinleer_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		} ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
        <?php

			the_content( sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'dustinleer' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'dustinleer' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php dustinleer_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
