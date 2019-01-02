<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Dustin_Leer
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer <?php if (!is_front_page()) { echo 'no-testimonial'; }?>" role="contentinfo">
		<?php if (is_front_page()) { ?>
			<section class="testimonial-container">
				<div class="testimonials wrapper">
					<?php 

					$posts = get_field('testimonial_selector', 'option');

						if( $posts ) {
							foreach( $posts as $post): // variable must be called $post (IMPORTANT)
								setup_postdata($post);
								$img  = get_field( 'headshot' );
								$img_alt = $img['alt'];
								$img_url = $img['url'];
								
								$work_title = get_field( 'job_title' );
								$work_link_array = get_field( 'link' );
								$link = $work_link_array['url'];
								$title = $work_link_array['title'];
								$target = $work_link_array['target'];
								$excerpt = get_the_excerpt();
								
								$content = get_the_content();
								
								echo '<div class="testimonial">';
									// var_dump(get_the_ID());
									echo '<div class="bubble">';
										// echo wp_trim_words( $content , '18' ); 
										echo '<p>' . custom_short_excerpt($excerpt) . '...</p>';
										echo '<a href="' . get_permalink() . '">Read More</a>';
									echo '</div>';

									if ( $img ) {
										echo '<a href="/testimonial/">';
											echo '<img src="' . $img_url . '" width="' . $img['width'] . '" height="' . $img['height'] . '" alt="' . $img_alt . '" />';
										echo '</a>';
									}

									echo '<h3>' . get_the_title() . '</h3>';

									if ( $work_link_array ) {
										echo '<a class="dark" href="' . $link . '" target="' . $target . '">' . $title . '</a>';
									}
								echo '</div>';
							endforeach;
							wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly
						} else {	
							/**
							 * Setup query to show the 'testimonial' post type with all posts filtered by ‘home’ category.
							 * Output is linked title with featured image and excerpt.
							 */

							$ids = get_field( 'testimonial_selector', false, false );
							$args = array(  
								'post_type' 		=> 'testimonial',
								'posts_per_page' 	=> 3,
								'post__in'			=> $ids,
								'post_status'		=> 'any',
								'orderby'        	=> 'post__in',
								// 'post_status' 		=> 'publish',
							);
							$loop = new WP_Query( $args ); 
							
							while ( $loop->have_posts() ) : $loop->the_post(); 
								
								$img_id  = get_post_thumbnail_id( $post->ID );
								$img     = wp_get_attachment_image_src( $img_id, 'full', false, '' ); 
								$img_alt = get_post_meta( $img_id, '_wp_attachment_image_alt', true );
								$img_url = $img[0];
								
								$work_title = get_field( 'job_title' );
								$work_link_array = get_field( 'link' );
								$link = $work_link_array['url'];
								$title = $work_link_array['title'];
								$target = $work_link_array['target'];
								$excerpt = get_the_excerpt();
								$content = get_the_content();
								
								echo '<div class="testimonial">';
									// var_dump(get_the_ID());
									echo '<div class="bubble">';
										// echo wp_trim_words( $content , '18' ); 
										echo '<p>' . custom_short_excerpt( $excerpt ) . '...</p>';
										echo '<a href="' . get_permalink() . '">Read More</a>';
									echo '</div>';
									
									if ( $img ) {
										echo '<a href="/testimonial/">';
											echo '<img src="' . $img_url . '" width="' . $img['1'] . '" height="' . $img['2'] . '" alt="' . $img_alt . '" />';
										echo '</a>';
									}

									echo '<h3>' . get_the_title() . '</h3>';

									if ( $work_link_array ) {
										echo '<a class="dark" href="' . $link . '" target="' . $target . '">' . $title . '</a>';
									}
								echo '</div>';
							endwhile;

							wp_reset_postdata(); 
						}
					?>

				</div>
			</section>
		<?php } ?>
		
		<section class="site-info wrapper">
			<div class="copyright">
				Copyright &copy; <?php echo date("Y"); ?><span class="sep"> | </span> <a href="/">dustinleer.com</a> <span class="sep"> | </span>All manner of riff raff will be tarred and feathered.
			</div>
			
			<?php dustinleer_social_icons(); ?>
		</section>

		<section class="site-info wrapper">
			<div class="policy">
				<?php
					// wp_nav_menu( array( 'theme_location' => 'secondary' ) );
					wp_nav_menu( array(
						'theme_location'  => 'secondary',
						'container_class' => 'menu',
						'container_id'	  => 'footer',
						'menu_class'	  => 'nav-menu',
					) );
				?>
			</div>
		</section><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
