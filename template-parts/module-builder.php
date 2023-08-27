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

			// if( get_row_layout() == 'pm_hero' ) {

			// 	// vars
			// 	$img = get_sub_field( 'pm_hero_image' );
			// 	// $url = $img['url'];
			// 	// $title = $img['title'];
			// 	// $alt = $img['alt'];
			// 	// $caption = $img['caption'];

			// 	$header = get_sub_field( 'pm_hero_header' );
			// 	$content = get_sub_field( 'pm_hero_content' );
			// 	$link = get_sub_field( 'pm_hero_link' );


			// 	echo '<section class="hero" style="background-image: url('. $img["url"] .');">';
			// 		echo '<img src="' . $img['sizes']['large'] . '" alt="' . $img['alt'] . '" />';
			// 		echo $header;
			// 		echo $content;
			// 		echo '<a class="hero-cta cta" href="' . $link['url'] . '" target="' . $link['target'] . '">' . $link['title'] . '</a>';
			// 	echo '</section>';


			// }
			if( get_row_layout() == 'grid_layout' ) {

				// check if the nested repeater field has rows of data
				if( have_rows('grid_content') ) :
				
					echo '<div class="flex-wrap">';
					// loop through the rows of data
					while ( have_rows('grid_content') ) : the_row();
						$grid = get_sub_field( 'grid' );
						$contentMod = get_sub_field( 'content_module' );
						$imageMod = get_sub_field( 'image_module' );
						$linkMod = get_sub_field( 'link_module' );
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

	// check if the flexible content field has rows of data
	if ( have_rows( 'home_modules' ) ) { 

		// loop through the rows of data
		while ( have_rows( 'home_modules' ) ) {
			the_row();
			
			// CONTENT MODULE
			if( get_row_layout() == 'content' ) {

				// check if the nested repeater field has rows of data
				if( have_rows('content_section') ) {
				
					echo '<div class="flex-wrap intro">';
					
					/* Create an iterator to count the posts */
					$post_count = 1;
					
					// loop through the rows of data
					while ( have_rows('content_section') ) {
						the_row();
						$image = get_sub_field( 'image' );
						$header = get_sub_field( 'header' );
						$content = get_sub_field( 'content' );

						echo '<div class="flex full" data-attribute="' . $post_count . '">';
							echo '<div class="flex img">';
								echo '<img src="' . $image['sizes']['medium_large'] . '" alt="' . $image['alt'] . '" />';
							echo '</div>';
							echo '<div class="flex content">';
								echo '<h2 class="header">' . $header . '</h2>';
								echo '<p>' .$content . '</p>';
							echo '</div>';
						echo '</div>';
					$post_count++;
					}
					
					echo '</div>';

				}

			} else if( get_row_layout() == 'portfolio_post_selector' ) {
				// vars
				$posts = get_sub_field( 'portfolio_posts' );

				if( $posts ) {
					echo '<div class="flex-wrap portfolio">';
						echo '<div class="flex full">';
							foreach( $posts as $post ) { // variable must be called $post (IMPORTANT)
								setup_postdata( $post );
								echo '<div class="flex half">';
									
									$title = get_the_title();
									$content = wp_trim_words( get_the_content(), 10);
									$link = get_permalink( $post->ID );

									echo '<a class="cover-link" href="' . esc_url( get_permalink() ) . '">';
										the_post_thumbnail( 'large' );
									echo '</a>';
									echo '<h3 class="pre-title">' . $title . '</h3>';
									echo '<p>'. $content .'</p>';
									echo '<a class="button" href="' . $link .'">View Project</a>';
								echo '</div>';
							}
						echo '</div>';
					echo '</div>';
					wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly
				} else {
					// echo 'no posts';
					$posts = new WP_Query( array(
						'post_type'      	=> 'Portfolio',
						'post_status' 		=> 'publish',
						'order' 			=> 'DESC',
						'posts_per_page' 	=> '2',
					));

					echo '<div class="flex-wrap portfolio">';
						echo '<div class="flex full">';
							while ( $posts->have_posts() ) : $posts->the_post();
							echo '<div class="flex half">';
								
								$title = get_the_title();
								$content = wp_trim_words( get_the_content(), 10);
								$link = get_permalink( $post->ID );

								echo '<a class="cover-link" href="' . esc_url( get_permalink() ) . '">';
									the_post_thumbnail( 'large' );
								echo '</a>';
								echo '<h3 class="pre-title">' . $title . '</h3>';
								echo '<p>'. $content .'</p>';
								echo '<a class="button" href="' . $link .'">View Project</a>';
							echo '</div>';
							endwhile;
							wp_reset_query();
						echo '</div>';
					echo '</div>';
				}
			} else if( get_row_layout() == 'blog_post_selector' ) {
				// vars
				$posts = get_sub_field( 'blog_posts' );

				if( $posts ) {
					echo '<div class="flex-wrap blog">';
						echo '<div class="flex full">';
							foreach( $posts as $post ) { // variable must be called $post (IMPORTANT)
								setup_postdata( $post );

								$title = get_the_title();
								$content = wp_trim_words( get_the_content(), 15);
								$link = get_permalink( $post->ID );
								$url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );


								echo '<div class="flex half" style="background: url(' . $url . '); 	background-repeat: no-repeat; background-size: cover; background-position: center;">';
									the_post_thumbnail( 'large', array('class' => 'visuallyhidden') );
									echo '<div class="post-inner">';
										echo '<h3><a href="' . esc_url( get_permalink() ) . '">' . $title . '</a></h3>';
										echo '<p>'. $content .'</p>';
										echo '<a class="button pink" href="' . $link .'">Read More</a>';
									echo '</div>';
								echo '</div>';
							}
						echo '</div>';
					echo '</div>';
					wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly
				} else {
					// This is if there are no selected feature posts
					$posts = get_posts( array(
						'post_type'      	=> 'post',
						'post_status' 		=> 'publish',
						'order' 			=> 'DESC',
						'posts_per_page' 	=> '2',
					) );

					if ( $posts ) {
						echo '<div class="flex-wrap blog">';
							echo '<div class="flex full">';
							while  ( have_posts() ) { the_post();
								foreach ( $posts as $post ) {
								setup_postdata( $post );
									
									$title = get_the_title();
									$content = wp_trim_words( get_the_content(), 20);
									$link = get_permalink( $post->ID );
									$url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );

									echo '<div class="flex half" style="background: url(' . $url . '); 	background-repeat: no-repeat; background-size: cover; background-position: center;">';
											the_post_thumbnail( 'large', array('class' => 'visuallyhidden') );
											echo '<div class="post-inner">';
												echo '<h3><a href="' . esc_url( get_permalink() ) . '">' . $title . '</a></h3>';
												echo '<p>'. $content .'</p>';
												echo '<a class="button pink" href="' . $link .'">Read More</a>';
											echo '</div>';
									echo '</div>';;
								}
							}
							echo '</div>';
						echo '</div>';
						wp_reset_postdata();
					}
				}
			}
		}
	}

?>
