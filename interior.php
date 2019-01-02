<?php
/**
* Template Name: Interior
 *
 * The template for displaying all interior pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Dustin_Leer
 */

get_header();

    if( have_rows( 'page_modules' ) ) {
        while ( have_rows( 'page_modules' ) ) {
            the_row();
            if( get_row_layout() == 'grid_layout' ) {
                if( have_rows('grid_content') ) {			
					
					// loop through the rows of data
					while ( have_rows('grid_content') ) {
                        the_row();

                        $grid = get_sub_field( 'grid' );
                        $last = get_sub_field( 'last' );
                        $content = get_sub_field( 'grid_content' );
                        if ( $grid ) {
                            $grid = 'grid';
                        }
                    }
                }
            }
        }
    }
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
            <?php
                echo '<div class="wrapper ' . $grid. '">';

                    while ( have_posts() ) : the_post();    
                        //ACF Page Builder
                        get_template_part( 'template-parts/module', 'builder' );
				    endwhile; // End of the loop.

                echo '</div>';

                // write conditional for this below

                echo '<div class="wrapper">';
                    while ( have_posts() ) : the_post();                        
                        get_template_part( 'template-parts/content', 'page' );
                    
                        // If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;
                        
				    endwhile; // End of the loop.
			
                echo '</div>';
            ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
// get_sidebar();
get_footer();
