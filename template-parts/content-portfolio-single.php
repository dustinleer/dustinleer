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
	$excerpt = get_the_excerpt();
	
	if ( $img ) {
		echo '<img class="content-img" src="' . $img_url . '" width="' . $img['1'] . '" height="' . $img['2'] . '" alt="' . $img_alt . '" />';
	}
?>

	<div class="entry-content">
        <?php

            $services_title = get_field( 'services_title' );
            $services = get_field( 'services' );
            
            echo '<div>';
                echo '<h3 class="services">' . $services_title . '</h3>';
                echo '<p>';
                    if( count($services)){
                        foreach($services as $s=>$service){
                            if($s) echo ', ';
                            echo $service;
                        }
                    }
                echo '</p>';
            echo '</div>';

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
    
    <?php

            // check if the flexible content field has rows of data
            if( have_rows('portfolio_modules') ){
                
                // loop through the rows of data
                while ( have_rows('portfolio_modules') ) {
                the_row();
                
                if( get_row_layout() == 'gallery' ) {

                    
                    $images = get_sub_field( 'image_gallery' );
                    $size = 'full'; // (thumbnail, medium, large, full or custom size)
                    
                    if( $images ) {
                        echo '<div class="gallery">';
                            echo '<ul>';
                                foreach( $images as $image ) {
                                    echo '<li>';
										echo '<a class="img-box" data-fancybox="gallery" data-caption="' . $image['alt'] . '" href="'. $image['url'] .'" style="background-image: url('. $image['url'] .') ;">';
                                        // echo wp_get_attachment_image( $image['ID'], $size );
                                            echo '<img src="' . $image['sizes']['large'] . '" alt="' . $image['alt'] . '" />';
                                        echo '</a>';
                                    echo '</li>';
                                }
                            echo '</ul>';
                        echo '</div>';
                    }
                    
                } if ( get_row_layout() == 'content' ) {
                    $content = get_sub_field( 'additional_content' );
                    echo $content;
                }

            }

        } else {

            // no layouts found

        }

        

    ?>

	<footer class="entry-footer">
		<?php dustinleer_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
