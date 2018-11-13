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
					echo '<img class="hero-image" src="' . $img['sizes']['large'] . '" alt="' . $img['alt'] . '" />';
					echo '<section class="hero-secondary"></section>';
					echo '<section class="hero-content">';
					echo '<h1 class="title">' . $header . '</h1>';
					echo '<p class="sub-title">' . $content . '</p>';
					echo '<a class="hero-cta cta" href="' . $link['url'] . '" target="' . $link['target'] . '">' . $link['title'] . '</a>';
					echo '</section>';
				echo '</section>';
			echo '</div>';
        }

	}

} else {

}

?>
