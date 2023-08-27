<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Dustin_Leer
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="wrapper">

                <a class="back" href="/testimonial/">View All Testimonials</a>

				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content-testimonial-single', get_post_format() );

                    
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
                    
				endwhile; // End of the loop.
				?>

			</div>
            <?php the_post_navigation(); ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();