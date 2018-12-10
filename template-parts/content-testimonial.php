<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Dustin_Leer
 */

?>

<?php
	/* Create an iterator to count the posts */
	$post_count = 1;

	/* Start the Loop */
	while ( have_posts() ) : the_post();
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> data-attribute="<?php echo $post_count; ?>">
		<?php
			$img  = get_field( 'headshot' );
			$img_alt = $img['alt'];
			$img_url = $img['url'];
			$excerpt = get_the_excerpt();
			
			if ( $img ) {
				echo '<a class="img-wrap" href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
					echo '<img src="' . $img_url . '" width="' . $img['width'] . '" height="' . $img['height'] . '" alt="' . $img_alt . '" />';
				echo '</a>';
			}
		?>

		<section class="article">
			<header class="entry-header">
				<?php
				if ( is_singular() ) {
					the_title( '<h1 class="entry-title">', '</h1>' );
				} else {
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
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

					echo '<p>' . short_excerpt( $excerpt ) . '...</p>';
					echo '<a class="button" href="' . get_permalink() . '">Read More</a>';

					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'dustinleer' ),
						'after'  => '</div>',
					) );
				?>
			</div><!-- .entry-content -->

			<footer class="entry-footer">
				<?php dustinleer_entry_footer(); ?>
			</footer><!-- .entry-footer -->
		</section>
	</article><!-- #post-<?php the_ID(); ?> -->

<?php
	$post_count++;
	endwhile;
?>