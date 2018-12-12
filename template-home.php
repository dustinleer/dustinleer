<?php
/**
 * Template Name: Home
 *
 * The template for the Homepage
 *
 * @package Dustin_Leer
 * @since 1.0
 */
get_header();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php if ( have_rows( 'home_modules' ) ) {
			echo '<div class="full-background">';
			//ACF Page Builder
			get_template_part( 'template-parts/module', 'builder' );
			echo '</div>';
		} else {
			echo '<div class="wrapper">';
			while ( have_posts() ) : the_post();
			
				get_template_part( 'template-parts/content', 'page' );
				
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			
			endwhile; // End of the loop.
			echo '</div>';
		} ?>
	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
