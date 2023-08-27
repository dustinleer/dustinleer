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
	/* Start the Loop */
	while ( have_posts() ) : the_post();
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php
			$img  = get_field( 'link_tree_profile' );
			$img_alt = $img['alt'];
			$img_url = $img['url'];

			$link_array = get_field( 'link_tree_profile_link' );
			$link = $link_array['url'];
			$title = $link_array['title'];
			$target = $link_array['target'];	
        ?>

        <section class="article">
            <header class="entry-header">
                <?php
                    if ( $img ) {
                        echo '<a class="img-wrap" href="' . $img_url . '" rel="bookmark">';
                            echo '<img src="' . $img_url . '" width="' . $img['width'] . '" height="' . $img['height'] . '" alt="' . $img_alt . '" />';
                        echo '</a>';
                    }

                    if ( is_singular() ) {
                        the_title( '<h1 class="entry-title visuallyhidden">', '</h1>' );
                    } else {
                        the_title( '<h2 class="entry-title visuallyhidden"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                    }

                    if ( $link_array ) {
                        echo '<a class="instagram-profile" href="' . $link . '" target="' . $target . '">' . $title . '</a>';
                    }

                    if ( 'post' === get_post_type() ) { ?>
                    <div class="entry-meta">
                        <?php dustinleer_posted_on(); ?>
                    </div><!-- .entry-meta -->
                    <?php
                    }
                ?>
			</header><!-- .entry-header -->

			<div class="entry-content">
                <?php

                    if( have_rows('link_tree_links') ) {

                        while( have_rows('link_tree_links') ) {
                            the_row(); 

                            // vars
                            $links_array = get_sub_field( 'link' );
                            $link = $links_array['url'];
                            $title = $links_array['title'];
                            $target = $links_array['target'];

                            if( $links_array ) {
                                echo '<a class="button linktree" href="' . $link . '" target="' .$target. '">' . $title . '</a>';
                            }
                        }
                    }

					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'dustinleer' ),
						'after'  => '</div>',
					) );
				?>
			</div><!-- .entry-content -->

			<footer class="entry-footer">
                <?php
                    if( have_rows('social_links') ) {

                        while( have_rows('social_links') ) {
                            the_row(); 

                            // vars
                            $links_array = get_sub_field( 'social_link' );
                            $link = $links_array['url'];
                            $title = strtolower($links_array['title']);
                            $target = $links_array['target'];

                            if( $links_array ) {
                                echo '<a class="social ' . $title . '" href="' . $link . '" target="' .$target. '">';
                                    echo '<i class="fab fa-' . $title . '" title="' . $title . '"></i>';
                                    echo '<span class="visuallyhidden">' . $title . '</span>';
                                echo '</a>';
                            }
                        }
                    }
                    dustinleer_entry_footer();

                ?>
			</footer><!-- .entry-footer -->
		</section>
	</article><!-- #post-<?php the_ID(); ?> -->

<?php
	endwhile;
?>