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

if (is_blog()) { 

	// set the post ID that you want to use and use it in all
	// of the function calls where it is needed
	// and make sure it's an integer value
	$post_id = intval(get_option('page_for_posts'));

	if( have_rows( 'page_modules', $post_id ) ) {

		// loop through the rows of data
		while ( have_rows( 'page_modules', $post_id ) ) {
			the_row();

			if( get_row_layout() == 'pm_hero' ) {

				// vars
				$img = get_sub_field( 'pm_hero_image', get_option('page_for_posts') );
				// $url = $img['url'];
				// $title = $img['title'];
				// $alt = $img['alt'];
				// $caption = $img['caption'];

				$header = get_sub_field( 'pm_hero_header', get_option('page_for_posts') );
				$content = get_sub_field( 'pm_hero_content', get_option('page_for_posts') );
				$link = get_sub_field( 'pm_hero_link', get_option('page_for_posts') );

				echo '<div class="hero-wrapper">';
					echo '<section class="hero">'; /*style="background-image: url('. $img["url"] .');">';*/
						
						echo '<div class="hero-content-wrapper">';
							echo '<img class="hero-image" src="' . $img['sizes']['large'] . '" alt="' . $img['alt'] . '" />';
							
							echo '<section class="hero-content">';
								$title = wp_title( '', false, 'right' );
								echo '<h1 class="title">' . $title . '</h1>';
								if ( is_home() && ! is_front_page() && $content ) {
									echo '<p class="sub-title">' . $content . '</p>';
								} else if (is_single()) {

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
				// $url = $img['url'];
				// $title = $img['title'];
				// $alt = $img['alt'];
				// $caption = $img['caption'];

				$header = get_sub_field( 'pm_hero_header' );
				$content = get_sub_field( 'pm_hero_content' );
				$link = get_sub_field( 'pm_hero_link' );

				echo '<div class="hero-wrapper">';
					echo '<section class="hero">'; /*style="background-image: url('. $img["url"] .');">';*/
						
						echo '<div class="hero-content-wrapper">';
							echo '<img class="hero-image" src="' . $img['sizes']['large'] . '" alt="' . $img['alt'] . '" />';
							
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
			echo '<section class="hero">'; /*style="background-image: url('. $img["url"] .');">';*/
				
				echo '<div class="hero-content-wrapper">';
					echo '<img class="hero-image" src="/wp-content/uploads/2018/11/hero-dustin-leer-color.png" alt="" />';
					
					echo '<section class="hero-content">';

						if ( is_search() ) {
							echo '<h1 class="title">';
								/* translators: %s: search query. */
								printf( esc_html__( 'Search Results for: %s', 'dustinleer' ), '<span>' . get_search_query() . '</span>' );
							echo '</h1>';
						} else if ( is_404() ) {
							echo '<h1 class="title">';
								esc_html_e( 'Oops! That page can&rsquo;t be found!', 'dustinleer' );
							echo '</h1>';
						}
						
					echo '</section>';
				echo '</div>';

			echo '</section>';
		echo '</div>';
	}
}

?>
