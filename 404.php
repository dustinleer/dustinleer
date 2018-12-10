<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Dustin_Leer
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="wrapper">

				<section class="error-404 not-found">
					<?php /*
					<header class="page-header">
						<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'dustinleer' ); ?></h1>
					</header><!-- .page-header -->
					*/ ?>
					
					<div class="page-content">
						<p>Since nothing could be found, you can try searching for it or going back to the <a href="/">hompage</a>.</p>

						<?php
							get_search_form();

							// the_widget( 'WP_Widget_Recent_Posts' );
						?>

					</div><!-- .page-content -->
				</section><!-- .error-404 -->
				
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
