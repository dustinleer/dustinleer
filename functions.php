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
		'secondary' => esc_html__( 'Secondary', 'dustinleer' )
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
	// CSS
	wp_enqueue_style( 'dustinleer-style', get_template_directory_uri() . '/style.min.css', false );
	wp_enqueue_style( 'fancybox-style', 'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.2/dist/jquery.fancybox.min.css' );

	// Fonts
	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Montserrat:400,700' );
	wp_enqueue_style( 'font-awesome', 'https://use.fontawesome.com/releases/v5.5.0/css/all.css' );

	// JS
	// wp_register_script('jquery', 'https://code.jquery.com/jquery-3.3.1.min.js', false, '3.3.1');
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'dustinleer-main-scripts', get_template_directory_uri() . '/assets/js/main.min.js', array(), '20151215', true );
	wp_enqueue_script( 'dustinleer-vendor-scripts', get_template_directory_uri() . '/assets/js/vendor.min.js', array(), '20151215', true );
	wp_enqueue_script( 'fancybox-script', 'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.2/dist/jquery.fancybox.min.js', array('jquery'), '3.5.2', true );

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

	// acf_add_options_sub_page(array(
	// 	'page_title' 	=> 'Theme Header Settings',
	// 	'menu_title'	=> 'Header',
	// 	'parent_slug'	=> 'theme-general-settings',
	// ));

	// acf_add_options_sub_page(array(
	// 	'page_title' 	=> 'Theme Footer Settings',
	// 	'menu_title'	=> 'Footer',
	// 	'parent_slug'	=> 'theme-general-settings',
	// ));

}

/**
 * Add Custom Logo Function for Customizer
 */
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

/**
 * Add Function to check if is_blog
 */
function is_blog () {
	if ( (is_archive()) || (is_author()) || (is_category()) || (is_home()) || (is_single()) || (is_tag()) ) {
		return true;
	}
	else {
		return false;
	}
}

/**
 * Adds Social Media Array for Customizer
 */
function dustinleer_social_array() {

	$social_sites = array(
		'facebook'      => 'facebook_profile',
		'twitter'       => 'twitter_profile',
		'linkedin'      => 'linkedin_profile',
		'youtube'       => 'youtube_profile',
		'instagram'     => 'instagram_profile',
		'github'        => 'github_profile',
		'codepen'       => 'codepen_profile',
		'dribbble'      => 'dribbble_profile',
		// 'spotify'       => 'spotify_profile',
		// 'google-plus'   => 'googleplus_profile',
		// 'pinterest'     => 'pinterest_profile',
		// 'vimeo'         => 'vimeo_profile',
		// 'tumblr'        => 'tumblr_profile',
		// 'flickr'        => 'flickr_profile',
		// 'rss'           => 'rss_profile',
		// 'reddit'        => 'reddit_profile',
		// 'soundcloud'    => 'soundcloud_profile',
		// 'vine'          => 'vine_profile',
		// 'yahoo'         => 'yahoo_profile',
		// 'behance'       => 'behance_profile',
		// 'delicious'     => 'delicious_profile',
		// 'stumbleupon'   => 'stumbleupon_profile',
		// 'deviantart'    => 'deviantart_profile',
		// 'digg'          => 'digg_profile',
		// 'hacker-news'   => 'hacker-news_profile',
		// 'steam'         => 'steam_profile',
		// 'vk'            => 'vk_profile',
		// 'weibo'         => 'weibo_profile',
		// 'tencent-weibo' => 'tencent_weibo_profile',
		// '500px'         => '500px_profile',
		// 'foursquare'    => 'foursquare_profile',
		// 'slack'         => 'slack_profile',
		// 'slideshare'    => 'slideshare_profile',
		// 'qq'            => 'qq_profile',
		// 'whatsapp'      => 'whatsapp_profile',
		// 'skype'         => 'skype_profile',
		// 'wechat'        => 'wechat_profile',
		// 'xing'          => 'xing_profile',
		// 'paypal'        => 'paypal_profile',
		'email-form'    => 'email_form_profile'
	);

	return apply_filters( 'dustinleer_social_array_filter', $social_sites );
}

/**
 * Adds Social Media Function for Call
 */
function dustinleer_social_icons() {

	$social_sites = dustinleer_social_array();

	foreach ( $social_sites as $social_site => $profile ) {

		if ( strlen( get_theme_mod( $social_site ) ) > 0 ) {
			$active_sites[ $social_site ] = $social_site;
		}
	}

	if ( ! empty( $active_sites ) ) {

		echo '<ul class="social-media-icons">';
		foreach ( $active_sites as $key => $active_site ) {
        	$class = 'fab fa-' . $active_site; ?>
		 	<li>
				<a class="<?php echo esc_attr( $active_site ); ?>" target="_blank" href="<?php echo esc_url( get_theme_mod( $key ) ); ?>">
					<i class="<?php echo esc_attr( $class ); ?>" title="<?php echo esc_attr( $active_site ); ?>"></i>
				</a>
			</li>
		<?php }
		echo "</ul>";
	}
}

/**
 * Adds SVG upload functionality
*/
function cc_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

/**
 * Register Testimonial Custom Post Type
 */
function testimonial() {

	$labels = array(
		'name'                  => _x( 'Testimonials', 'Post Type General Name', 'testimonial' ),
		'singular_name'         => _x( 'Testimonial', 'Post Type Singular Name', 'testimonial' ),
		'menu_name'             => __( 'Testimonials', 'testimonial' ),
		'name_admin_bar'        => __( 'Testimonial', 'testimonial' ),
		'archives'              => __( 'Testimonial Archives', 'testimonial' ),
		'attributes'            => __( 'Testimonial Attributes', 'testimonial' ),
		'parent_item_colon'     => __( 'Parent Testimonial:', 'testimonial' ),
		'all_items'             => __( 'All Testimonials', 'testimonial' ),
		'add_new_item'          => __( 'Add New Testimonial', 'testimonial' ),
		'add_new'               => __( 'Add New', 'testimonial' ),
		'new_item'              => __( 'New Testimonial', 'testimonial' ),
		'edit_item'             => __( 'Edit Testimonial', 'testimonial' ),
		'update_item'           => __( 'Update Testimonial', 'testimonial' ),
		'view_item'             => __( 'View Testimonial', 'testimonial' ),
		'view_items'            => __( 'View Testimonials', 'testimonial' ),
		'search_items'          => __( 'Search Testimonial', 'testimonial' ),
		'not_found'             => __( 'Not found', 'testimonial' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'testimonial' ),
		'featured_image'        => __( 'Featured Image', 'testimonial' ),
		'set_featured_image'    => __( 'Set featured image', 'testimonial' ),
		'remove_featured_image' => __( 'Remove featured image', 'testimonial' ),
		'use_featured_image'    => __( 'Use as featured image', 'testimonial' ),
		'insert_into_item'      => __( 'Insert into testimonial', 'testimonial' ),
		'uploaded_to_this_item' => __( 'Uploaded to this testimonial', 'testimonial' ),
		'items_list'            => __( 'Testimonials list', 'testimonial' ),
		'items_list_navigation' => __( 'Testimonials list navigation', 'testimonial' ),
		'filter_items_list'     => __( 'Filter testimonials list', 'testimonial' ),
	);
	$args = array(
		'label'                 => __( 'Testimonial', 'testimonial' ),
		'description'           => __( 'A post type for testimonials', 'testimonial' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'trackbacks', 'revisions' ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-testimonial',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
	);
	register_post_type( 'testimonial', $args );

}
add_action( 'init', 'testimonial', 0 );

// Register Custom Post Type
function portfolio() {

	$labels = array(
		'name'                  => _x( 'Portfolio', 'Post Type General Name', 'portfolio' ),
		'singular_name'         => _x( 'Portfolio', 'Post Type Singular Name', 'portfolio' ),
		'menu_name'             => __( 'Portfolio', 'portfolio' ),
		'name_admin_bar'        => __( 'Portfolio', 'portfolio' ),
		'archives'              => __( 'Portfolio Archives', 'portfolio' ),
		'attributes'            => __( 'Portfolio Attributes', 'portfolio' ),
		'parent_item_colon'     => __( 'Parent Portfolio:', 'portfolio' ),
		'all_items'             => __( 'All Portfolio Items', 'portfolio' ),
		'add_new_item'          => __( 'Add New Portfolio Item', 'portfolio' ),
		'add_new'               => __( 'Add New', 'portfolio' ),
		'new_item'              => __( 'New Portfolio Item', 'portfolio' ),
		'edit_item'             => __( 'Edit Portfolio Item', 'portfolio' ),
		'update_item'           => __( 'Update Portfolio Item', 'portfolio' ),
		'view_item'             => __( 'View Portfolio Item', 'portfolio' ),
		'view_items'            => __( 'View Portfolio Items', 'portfolio' ),
		'search_items'          => __( 'Search Portfolio Item', 'portfolio' ),
		'not_found'             => __( 'Not found', 'portfolio' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'portfolio' ),
		'featured_image'        => __( 'Featured Image', 'portfolio' ),
		'set_featured_image'    => __( 'Set featured image', 'portfolio' ),
		'remove_featured_image' => __( 'Remove featured image', 'portfolio' ),
		'use_featured_image'    => __( 'Use as featured image', 'portfolio' ),
		'insert_into_item'      => __( 'Insert into portfolio item', 'portfolio' ),
		'uploaded_to_this_item' => __( 'Uploaded to this portfolio item', 'portfolio' ),
		'items_list'            => __( 'Portfolio Items list', 'portfolio' ),
		'items_list_navigation' => __( 'Portfolio Items list navigation', 'portfolio' ),
		'filter_items_list'     => __( 'Filter portfolio list', 'portfolio' ),
	);
	$args = array(
		'label'                 => __( 'Portfolio', 'portfolio' ),
		'description'           => __( 'A post type for portfolio pieces', 'portfolio' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'trackbacks', 'revisions' ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-images-alt2',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
	);
	register_post_type( 'portfolio', $args );

}
add_action( 'init', 'portfolio', 0 );

// Code for themes
add_action( 'after_switch_theme', 'flush_rewrite_rules' );

// Code for plugins
register_deactivation_hook( __FILE__, 'flush_rewrite_rules' );
register_activation_hook( __FILE__, 'myplugin_flush_rewrites' );
function myplugin_flush_rewrites() {
	// call your CPT registration function here (it should also be hooked into 'init')
	myplugin_custom_post_types_registration();
	flush_rewrite_rules();
}

/**
 * Limit excerpt to a number of characters without cutting last word
 *
 * @param string $excerpt
 * @return string
 */
function custom_short_excerpt( $excerpt ){
	$limit = 100;

	if ( strlen( $excerpt ) > $limit ) {
		return substr( $excerpt, 0, strpos( $excerpt, ' ', $limit ) );
	}

	return $excerpt;
}
add_filter('the_excerpt', 'custom_short_excerpt');

function short_excerpt( $excerpt ){
	$limit = 140;

	if ( strlen( $excerpt ) > $limit ) {
		return substr( $excerpt, 0, strpos( $excerpt, ' ', $limit) );
	}

	return $excerpt;
}
add_filter('the_excerpt', 'short_excerpt');

function longer_excerpts( $excerpt ) {
	$limit = 500;

	if ( strlen( $excerpt ) > $limit ) {
		return substr( $excerpt, 0, strpos( $excerpt, ' ', $limit ) );
	}

	return $excerpt;
}
// "999" priority makes this run last of all the functions hooked to this filter, meaning it overrides them
add_filter( 'excerpt_length', 'longer_excerpts', 999 );


function testimonial_archive_template_query( $query ) {

    /* only proceed on the front end */
    if( is_admin() ) {
	    return;
    }

    /* only on the person post archive for the main query */
    if ( $query->is_post_type_archive( 'testimonial' ) && $query->is_main_query() ) {

        $query->set( 'posts_per_page', -1 );
        $query->set( 'orderby', 'rand' );

    }

}
add_action( 'pre_get_posts', 'testimonial_archive_template_query' );

function portfolio_archive_template_query( $query ) {

    /* only proceed on the front end */
    if( is_admin() ) {
	    return;
    }

    /* only on the person post archive for the main query */
    if ( $query->is_post_type_archive( 'portfolio' ) && $query->is_main_query() ) {

		// $taxquery = array(
		// 	array(
		// 		'post_per_page' => -1,
		// 		'order'			=> DESC;
		// 	)
		// );
		// $query->set( 'tax_query', $taxquery );

        $query->set( 'posts_per_page', -1 );
        // $query->set( 'orderby', 'rand' );

    }

}
add_action( 'pre_get_posts', 'portfolio_archive_template_query' );

// Adds Body class of page slug
function add_slug_body_class( $classes ) {
	global $post;

	if ( isset( $post ) ) {
		$classes[] = $post->post_type . '-' . $post->post_name;
	}

	return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );

// Custom Reply for comments
// function dustinleer_comment_reply_text( $link ) {
// 	$link = str_replace( 'Reply', 'Respond<i class="fas fa-reply"></i>', $link );
// 	return $link;
// }
// add_filter( 'comment_reply_link', 'dustinleer_comment_reply_text' );


//Exclude pages from WordPress Search
if (!is_admin()) {
	function wpb_search_filter($query) {
		if ($query->is_search) {
			$query->set('post_type', 'post');
		}
		return $query;
	}
	add_filter('pre_get_posts','wpb_search_filter');
}

function remove_from_admin_bar($wp_admin_bar) {
    /*
     * Placing items in here will only remove them from admin bar
     * when viewing the fronte end of the site
    */
    if ( ! is_admin() ) {
        // Example of removing item generated by plugin. Full ID is #wp-admin-bar-si_menu
        $wp_admin_bar->remove_node('si_menu');

        // WordPress Core Items (uncomment to remove)
        // You can do other items by looking at the id of the html element
        $wp_admin_bar->remove_node('updates');
        $wp_admin_bar->remove_node('comments');
        $wp_admin_bar->remove_node('new-content');
        $wp_admin_bar->remove_node('wp-logo');
        $wp_admin_bar->remove_node('stats');
        $wp_admin_bar->remove_node('monsterinsights_frontend_button');
        $wp_admin_bar->remove_node('search');
        //$wp_admin_bar->remove_node('customize');
    }

    /*
     * Items placed outside the if statement will remove it from both the frontend
     * and backend of the site
     */
    $wp_admin_bar->remove_node('wp-logo');
}
add_action('admin_bar_menu', 'remove_from_admin_bar', 999);
