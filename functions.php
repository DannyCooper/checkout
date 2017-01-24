<?php
/**
 * Checkout functions and definitions
 *
 * @package checkout
 */

define( 'USE_ZEUS_CUSTOMIZER', true );

/**
 * Load zeus framework.
 */
require_once( get_template_directory() . '/zeus-framework/init.php' );

if ( ! function_exists( 'checkout_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function checkout_setup() {
		/*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Checkout, use a find and replace
         * to change 'checkout' to the name of your theme in all the template files
        */
		load_theme_textdomain( 'checkout', get_template_directory() . '/languages' );


		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );
		add_editor_style( '/assets/css/editor-styles.css' );

		/*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
        */
		add_theme_support( 'title-tag' );

		$args = array(
			'flex-height' => true,
			'width' => 1170,
			'flex-height' => true,
			'height' => 250,
			'default-text-color' => '313131',
		);
		add_theme_support( 'custom-header', $args );

		/*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
        */
		add_theme_support( 'post-thumbnails' );

		add_image_size( 'checkout-homepage-blog-thumbnail', 250, 250, true ); // 250 pixels wide by 250px high
		add_image_size( 'checkout-blog-post', 770 ); // 770 pixels wide (and unlimited height)

		/*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
        */
		add_theme_support(
			'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters(
				'zeus_custom_background_args', array(
				'default-color' => 'ffffff',
				'default-image' => '',
				)
			)
		);

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
			'menu-1' => esc_html__( 'Primary Menu', 'checkout' ),
			'menu-2' => esc_html__( 'Header Menu', 'checkout' ),
			)
		);

	}
}
add_action( 'after_setup_theme', 'checkout_setup' );


if ( ! function_exists( 'checkout_content_width' ) ) {
	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 *
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 * @global int $content_width
	 */
	function checkout_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'checkout_content_width', 1170 );
	}
	add_action( 'after_setup_theme', 'checkout_content_width', 0 );
}

/**
 * Register the widget areas this theme supports
 */
function checkout_register_sidebars() {

	zeus_register_widget_area(
		array(
		'id'          => 'sidebar-primary',
		'name'        => __( 'Primary Sidebar', 'checkout' ),
		'description' => __( 'Widgets added here are shown in the sidebar next to your content.', 'checkout' ),
		)
	);

	zeus_register_widget_area(
		array(
		'id'          => 'footer-1',
		'name'        => __( 'Footer One', 'checkout' ),
		'description' => __( 'The footer is divided into four widget areas, each spanning 25% of the layout\'s width.', 'checkout' ),
		)
	);

	zeus_register_widget_area(
		array(
		'id'          => 'footer-2',
		'name'        => __( 'Footer Two', 'checkout' ),
		'description' => __( 'The footer is divided into four widget areas, each spanning 25% of the layout\'s width.', 'checkout' ),
		)
	);

	zeus_register_widget_area(
		array(
		'id'          => 'footer-3',
		'name'        => __( 'Footer Three', 'checkout' ),
		'description' => __( 'The footer is divided into four widget areas, each spanning 25% of the layout\'s width.', 'checkout' ),
		)
	);

	zeus_register_widget_area(
		array(
		'id'          => 'footer-4',
		'name'        => __( 'Footer Four', 'checkout' ),
		'description' => __( 'The footer is divided into four widget areas, each spanning 25% of the layout\'s width.', 'checkout' ),
		)
	);

}

add_action( 'widgets_init', 'checkout_register_sidebars', 5 );

/**
 * Enqueue scripts and styles.
 */
function checkout_scripts() {
	wp_enqueue_style( 'ot-checkout-style', get_stylesheet_uri() );
	wp_enqueue_style( 'checkout-socicons', ZEUS_THEME_URI . '/assets/css/socicons.css' );

	wp_enqueue_script( 'checkout-scripts', ZEUS_THEME_URI . '/assets/js/scripts.js', array(), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'checkout_scripts' );

/**
 * Move the navigation above the header.
 */
remove_action( 'zeus_header_after', 'zeus_nav', 10 );
add_action( 'zeus_header_before', 'zeus_nav', 10 );

/**
 * @TODO
 */
remove_action( 'zeus_sub_footer', 'zeus_footer_attribution', 15 );

/**
 * @todo
 */
require_once( get_stylesheet_directory() . '/inc/customizer.php' );
require_once( get_stylesheet_directory() . '/inc/customizer-output.php' );

/**
 * @TODO
 */
function checkout_social_output() {

	$social_websites = array(
		'facebook' => __( 'Facebook', 'checkout' ),
		'twitter' => __( 'Twitter', 'checkout' ),
		'instagram' => __( 'Instagram', 'checkout' ),
		'youtube' => __( 'YouTube', 'checkout' ),
		'pinterest' => __( 'Pinterest', 'checkout' ),
		'linkedin' => __( 'LinkedIn', 'checkout' ),
		'googleplus' => __( 'Google+', 'checkout' ),
		'rss' => __( 'RSS', 'checkout' ),
		'mail' => __( 'Contact', 'checkout' ),
	);

	echo '<div class="checkout-social-icons">';

	foreach ( $social_websites as $id => $name ) {

		if( $url = get_theme_mod( $id.'-url' ) ) {

			echo '<a href="'. esc_url( $url ) .'">
				<span class="socicon socicon-'.esc_attr( $id ).'"></span>
			</a>';

		}

	}

	echo '</div>';

}

/**
 * @todo
 */
function checkout_social_output_header() {

	if( get_theme_mod( 'social_header_display' ) !== '1' ) {
		return;
	}

	checkout_social_output();

}
add_action( 'zeus_nav_menu_after', 'checkout_social_output_header', 15 );

/**
 * @todo
 */
function checkout_social_output_footer() {

	if( get_theme_mod( 'social_footer_display' ) !== '1' ) {
		return;
	}

	checkout_social_output();

}
add_action( 'zeus_sub_footer', 'checkout_social_output_footer', 15 );

/**
 * @todo
 */
function checkout_footer_attribution( ){

	$text = __( 'Copyright &copy; %1$s <a href="%2$s">%3$s</a> &middot; Powered by  the %4$s.', 'checkout' );

	$date = date_i18n( 'Y' );
	$url = esc_url( home_url() );
	$name = get_bloginfo( 'name' );
	$attribution = '<a href="https://olympusthemes.com/checkout">Checkout Theme</a>';

	return sprintf( $text, $date, $url, $name, $attribution );

}
add_filter( 'zeus_footer_copyright', 'checkout_footer_attribution' );

/**
 * @todo
 */
function checkout_header_nav() {

	wp_nav_menu( array(
	    'theme_location' => 'menu-2',
		'menu_class' => 'zeus-nav-horizontal right',
		'fallback_cb' => 'false'
		)
	);
}
add_action( 'zeus_header', 'checkout_header_nav', 15 );


/**
 * @todo
 */
if( ! is_single() ) {
	remove_action( 'zeus_loop', 'zeus_entry_footer', 30 );
}


add_action( 'customize_preview_init', 'zeus_customizer_preview_js' );
