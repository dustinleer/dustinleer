<?php
/**
 * Template part for displaying ACF Hero Module
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Dustin_Leer
 */

?>

<?php

global $post;

if ( is_blog() ) { 

	// set the post ID that you want to use and use it in all
	// of the function calls where it is needed
	// and make sure it's an integer value
	$post_id = intval( get_option( 'page_for_posts' ) );

	if( have_rows( 'page_modules', $post_id ) ) {

		// loop through the rows of data
		while ( have_rows( 'page_modules', $post_id ) ) {
			the_row();

			if( get_row_layout() == 'pm_hero' ) {

				// vars
				$img = get_sub_field( 'pm_hero_image', get_option('page_for_posts') );
				$img_testimonial = get_field('testimonial_hero', 'option');
				$feat_img = get_field( 'header_image' );
				$img_portfolio = get_field('portfolio_hero', 'option');

				// var_dump($feat_img);

				if ( is_single() ) {
					$featured_img = get_the_post_thumbnail_url( $post->post_id, 'full', get_option('page_for_posts') );
				} else if ( is_post_type_archive( 'testimonial' ) ) {
					$featured_img = $img_testimonial['url'];
				} else if ( is_singular( 'testimonial' ) ) {
					$featured_img = $feat_img['url'];
				}else if ( is_post_type_archive( 'portfolio' ) ) {
					$featured_img = $img_portfolio['url'];
				} else {
					$featured_img = get_the_post_thumbnail_url( $post_id, 'full', get_option('page_for_posts') );
				}

				if ( is_singular( 'testimonial' ) ) {
					// Defaults to global hero image
					$featured_img = $img_testimonial['url'];
				} else if ( is_singular( 'portfolio' ) ) {
					// Defaults to global hero image
					// $featured_img = $img_portfolio['url'];
				}
				
				
				// $url = $img['url'];
				// $title = $img['title'];
				// $alt = $img['alt'];
				// $caption = $img['caption'];

				$header = get_sub_field( 'pm_hero_header', get_option('page_for_posts') );
				$content = get_sub_field( 'pm_hero_content', get_option('page_for_posts') );
				$link = get_sub_field( 'pm_hero_link', get_option('page_for_posts') );
				$img_bg = '';

				if ( $featured_img ) {
					echo '<div class="hero-wrapper featured-img">';
				} else {
					echo '<div class="hero-wrapper">';
				}
					if ( $img_bg ) {
						echo '<section class="hero" style="background-image: url('. $img_bg["url"] .')">';
					} else {
						echo '<section class="hero no-image-uploaded" style="background-image: url('. $featured_img .')">';
					}
						
						echo '<div class="hero-content-wrapper">';
						if ( $img_bg ) {
							echo '<img class="hero-image" src="' . $img['sizes']['large'] . '" alt="' . $img['alt'] . '" />';
						}

							echo '<section class="hero-content">';
								if ( is_single() ) {
									$title = get_the_title( $post->post_id );
								} else if ( is_tag() ) {
									$title = single_tag_title( 'Posts on: ', false );
								} else if ( is_post_type_archive() ) {
									$title = post_type_archive_title( '', false );
								} else if ( is_archive() ) {
									$title = single_cat_title( 'Posts on: ', false );
								} else {
									$title = get_the_title( $post_id );
								}
								echo '<h1 class="title">' . $title . '</h1>';
								
								if ( is_single() ) {
								} else if ( is_archive() && is_post_type_archive( 'testimonial' ) ) {
									$content = get_field('testimonial_content', 'option');
									echo '<p class="sub-title">' . $content . '</p>';
								} else if ( is_archive() && is_post_type_archive( 'portfolio' ) ) {
									$content = get_field('portfolio_content', 'option');
									echo '<p class="sub-title">' . $content . '</p>';
								} else if ( is_archive() || is_tag() ) {
									$content = get_field('generic_content', 'option');
									$addition_content = single_cat_title( '', false );
									echo '<p class="sub-title">' . $content . ' <span class="standout">&ldquo;' . $addition_content . '&rdquo;</span>.</p>';
								} else {
									echo '<p class="sub-title">' . $content . '</p>';
								}

								if ( $link ) {
									echo '<a class="hero-cta cta" href="' . $link['url'] . '" target="' . $link['target'] . '">' . $link['title'] . '</a>';
								}
							echo '</section>';
						echo '</div>';

					echo '</section>';
				echo '</div>';
			}

		}

	}
} else {
	// check if the flexible content field has rows of data
	if( have_rows( 'page_modules' ) ) {

		// loop through the rows of data
		while ( have_rows( 'page_modules' ) ) {
			the_row();

			if( get_row_layout() == 'pm_hero' ) {

				// vars
				$img = get_sub_field( 'pm_hero_image' );
				$img_bg = get_sub_field( 'pm_background_image' );
				$featured_img = get_the_post_thumbnail_url( $post, 'full' );

				$header = get_sub_field( 'pm_hero_header' );
				$content = get_sub_field( 'pm_hero_content' );
				$link = get_sub_field( 'pm_hero_link' );

				if ( $featured_img ) {
					echo '<div class="hero-wrapper featured-img">';
				} else {
					echo '<div class="hero-wrapper">';
				}

					if ( $img_bg ) {
						echo '<section class="hero" style="background-image: url('. $img_bg["url"] .')">';
					} else {
						// echo '<section class="hero no-image-uploaded" style="background-image: url(/wp-content/themes/dustinleer/assets/img/node-mesh-header.svg)">';
						echo '<section class="hero no-image-uploaded" style="background-image: url('. $featured_img .')">';
					}
						
						echo '<div class="hero-content-wrapper">';
						if ( $img_bg ) {
							echo '<img class="hero-image" src="' . $img['sizes']['large'] . '" alt="' . $img['alt'] . '" />';
						}
							
							echo '<section class="hero-content">';
								if ( $header ) {	
									echo '<h1 class="title">' . $header . '</h1>';
								}
								if ( $content ) {
									echo '<p class="sub-title">' . $content . '</p>';
								}
								if ( $link ) {
									echo '<a class="hero-cta cta" href="' . $link['url'] . '" target="' . $link['target'] . '">' . $link['title'] . '</a>';
								}
							echo '</section>';
						echo '</div>';

					echo '</section>';
				echo '</div>';
			}

		}
	} else {
		echo '<div class="hero-wrapper">';
			echo '<section class="hero" style="background-image: url(/wp-content/themes/dustinleer/assets/img/node-mesh-header.svg);">';
				echo '<div class="hero-content-wrapper">';
					echo '<img class="hero-image" src="/wp-content/uploads/2018/11/hero-dustin-leer-color.png" alt="" />';
					
					echo '<section class="hero-content">';

						if ( is_search() ) {
							echo '<h1 class="title">';
								/* translators: %s: search query. */
								printf( esc_html__( 'Search Results for: %s', 'dustinleer' ), '<span>&ldquo;' . get_search_query() . '&rdquo;</span>' );
							echo '</h1>';
						} else if ( is_404() ) {
							echo '<h1 class="title">';
								esc_html_e( 'UH OH! That there is a 404 error! 🤷🏻‍♂️', 'dustinleer' );
							echo '</h1>';
							echo '<p class="sub-title">';
								esc_html_e( 'Some sort of internet spirit must have taken this page!', "dustinleer" );
							echo '</p>';
						}
						
					echo '</section>';
				echo '</div>';

			echo '</section>';
		echo '</div>';
	}
}

?>
