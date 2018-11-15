<?php
/**
 * Dustin Leer functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Dustin_Leer
 */

if ( ! function_exists( 'dustinleer_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function dustinleer_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Dustin Leer, use a find and replace
	 * to change 'dustinleer' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'dustinleer', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'dustinleer' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'dustinleer_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
	
	// Add theme support for custom logo.
	add_theme_support( 'custom-logo', array(
		'flex-width' 	=> true,
		'header-text' 	=> array( 'site-title', 'site-description' ),
	) );

}
endif;
add_action( 'after_setup_theme', 'dustinleer_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function dustinleer_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'dustinleer_content_width', 640 );
}
add_action( 'after_setup_theme', 'dustinleer_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function dustinleer_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'dustinleer' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'dustinleer' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'dustinleer_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function dustinleer_scripts() {
	wp_enqueue_style( 'dustinleer-style', get_template_directory_uri() . '/style.min.css', false );
	
	wp_enqueue_style('google-fonts', '//fonts.googleapis.com/css?family=Montserrat:400,700');

	wp_enqueue_script( 'dustinleer-main-scripts', get_template_directory_uri() . '/assets/js/main.min.js', array(), '20151215', true );

	wp_enqueue_script( 'dustinleer-vendor-scripts', get_template_directory_uri() . '/assets/js/vendor.min.js', array(), '20151215', true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'dustinleer_scripts' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function dustinleer_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'dustinleer_pingback_header' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Additional features to allow styling of the templates.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


/**
 * Add ACF Options
 */
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'theme-general-settings',
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-settings',
	));
	
}

function siteBrand( $html ) {
	// grab the site name as set in customizer options
	$site = get_bloginfo( 'name' );

	// Wrap the site name in an H1 if on home, in a paragraph tag if not.
	is_front_page() ? $title = '<h1>' . $site . '</h1>' : $title = '<p>' . $site . '</p>';
	
	// Grab the home URL
	$home = esc_url(home_url('/'));
	
	// Class for the link
	$class = 'navbar-brand';
	
	// Set anchor content to $title
	$content = $title;
	
	// Check if there is a custom logo set in customizer options...
	if ( has_custom_logo() ) {
		// get the URL to the logo
		$logo    = wp_get_attachment_image( get_theme_mod( 'custom_logo' ), 'full', false, array(
			'class'    => 'brand-logo img-responsive',
			'itemprop' => 'logo',
			'header-text' 	=> array( 'site-title', 'site-description' ),
		));
	
		// we have a logo, so let's update the $content variable
		$content = $logo;
	
		// include the site name markup, hidden with screen reader friendly styles
		// $content .= '<span class="sr-only">' . $title . '</span>';
	}
	
	// construct the final html
	$html = sprintf( '<a href="%1$s" class="%2$s" rel="home" itemprop="url">%3$s</a>', $home, $class, $content );
	
	// return the result to the front end
	return $html;
}
add_filter( 'get_custom_logo', 'siteBrand' );

function is_blog () {
	if ( (is_archive()) || (is_author()) || (is_category()) || (is_home()) || (is_single()) || (is_tag()) ) {
		return true;
	}
	else {
		return false; 
	}
}
