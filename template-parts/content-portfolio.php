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

	$img_port = get_field( 'hero_image' );
    $featured_img = get_the_post_thumbnail_url( $post, 'full' );
    $excerpt = get_the_excerpt();

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> data-attribute="<?php echo $post_count; ?>">
                            
    <?php
        echo '<section class="left" style="background-image: url('. $featured_img .')">';
            echo '<a class="cover-link" href="' . esc_url( get_permalink() ) . '">';
                echo '<img class="" src="' . $featured_img . '" />';
            echo '</a>';
        echo '</section>';
    ?>

    <section class="right">
        <div class="right-inner">
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
                    // the_content( sprintf(
                    //     wp_kses(
                    //         /* translators: %s: Name of current post. Only visible to screen readers */
                    //         __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'dustinleer' ),
                    //         array(
                    //             'span' => array(
                    //                 'class' => array(),
                    //             ),
                    //         )
                    //     ),
                    //     get_the_title()
                    // ) );

                    echo '<p>' . short_excerpt( $excerpt ) . '...</p>';
                    echo '<a class="button" href="' . get_permalink() . '">View Project</a>';

                    wp_link_pages( array(
                        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'dustinleer' ),
                        'after'  => '</div>',
                    ) );
                ?>
            </div><!-- .entry-content -->

            <footer class="entry-footer">
                <?php dustinleer_entry_footer(); ?>
            </footer><!-- .entry-footer -->
        </div>
    </section>
</article><!-- #post-<?php the_ID(); ?> -->

<?php
    $post_count++;
    endwhile;
?>
