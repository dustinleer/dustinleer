<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Dustin_Leer
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="me" href="https://techhub.social/@leerdustin"/>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'dustinleer' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="wrapper">
			<div class="site-branding">
				<?php if ( get_theme_mod( 'logo' ) ) { ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" id="site-logo" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
				
						<img src="<?php echo get_theme_mod( 'logo' ); ?>" class="custom-logo" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
				
					</a>
				
				<?php } else { ?>
							
					<hgroup>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<p class="site-description"><?php bloginfo( 'description' ); ?></p>
					</hgroup>
				<?php } ?>
				
				
			</div><!-- .site-branding -->

			<nav id="site-navigation" class="main-navigation" role="navigation">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'dustinleer' ); ?></button>
				<?php
					wp_nav_menu( array(
						'theme_location'  => 'menu-1',
						'container_class' => 'menu',
						'container_id'	  => 'primary-menu',
						'menu_class'	  => 'nav-menu',
					) );
				?>
			</nav><!-- #site-navigation -->
		</div>

		<?php get_template_part( 'template-parts/module', 'hero' ); ?>

	</header><!-- #masthead -->

	<div id="content" class="site-content">
		
