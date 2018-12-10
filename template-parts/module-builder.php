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


			}
			if( get_row_layout() == 'grid_layout' ) {

				// check if the nested repeater field has rows of data
				if( have_rows('grid_content') ) :
				
					echo '<div class="flex-wrap">';
					// loop through the rows of data
					while ( have_rows('grid_content') ) : the_row();
						$grid = get_sub_field( 'grid' );
						$contentMod = get_sub_field( 'content_module' );
						$imageMod = get_sub_field( 'image_module' );
						$linkMod = get_sub_field( 'image_module' );
						$content = get_sub_field( 'content' );
						$image = get_sub_field( 'image' );
						$link = get_sub_field( 'link' );
	
							echo '<div class="flex ' . $grid . '">' . $content . '</div>';
					endwhile;
					echo '</div>';				
				
				endif;

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
