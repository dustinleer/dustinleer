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

// check if the flexible content field has rows of data
if( have_rows( 'page_modules' ) ) {

	 // loop through the rows of data
	while ( have_rows( 'page_modules' ) ) {
		the_row();

		if( get_row_layout() == 'hero' ) {

			// vars
			$img = get_sub_field( 'pm_hero_image' );
			// $url = $img['url'];
			// $title = $img['title'];
			// $alt = $img['alt'];
			// $caption = $img['caption'];

			$header = get_sub_field( 'pm_hero_header' );
			$content = get_sub_field( 'pm_hero_content' );
			$link = get_sub_field( 'pm_hero_link' );


			echo '<section class="hero" style="background-image: url('. $img["url"] .');">';
				echo '<img src="' . $img['sizes']['large'] . '" alt="' . $img['alt'] . '" />';
				echo $header;
				echo $content;
				echo '<a class="hero-cta cta" href="' . $link['url'] . '" target="' . $link['target'] . '">' . $link['title'] . '</a>';
			echo '</section>';


		} elseif( get_row_layout() == 'download' ) {

			$file = get_sub_field( 'file' );

		}

	}

} else {

	while ( have_posts() ) {
		the_post();

		get_template_part( 'template-parts/content', 'page' );

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}

	} // End of the loop.

}

?>
