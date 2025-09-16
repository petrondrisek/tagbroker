<?php
/**
 * tagbroker functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package tagbroker
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'tagbroker_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function tagbroker_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on tagbroker, use a find and replace
		 * to change 'tagbroker' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'tagbroker', get_template_directory() . '/languages' );

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
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'tagbroker' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'tagbroker_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'tagbroker_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function tagbroker_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'tagbroker_content_width', 640 );
}
add_action( 'after_setup_theme', 'tagbroker_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function tagbroker_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'tagbroker' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'tagbroker' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'tagbroker_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function tagbroker_scripts() {
	wp_enqueue_style( 'tagbroker-style', get_template_directory_uri() . '/style.min.css', array(), _S_VERSION );
	wp_style_add_data( 'tagbroker-style', 'rtl', 'replace' );

	wp_enqueue_script( 'tagbroker-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	wp_enqueue_style( 'boostrap-style', get_template_directory_uri() . '/bootstrap/css/bootstrap.min.css');
	wp_enqueue_script( 'boostrap-script', get_template_directory_uri() . '/bootstrap/js/bootstrap.bundle.min.js', array('jquery'));

	wp_enqueue_style( 'template-style', get_template_directory_uri() . '/theme.css');
	wp_enqueue_script( 'template-script', get_template_directory_uri() . '/js/theme.js');

	wp_enqueue_script( 'jquery-counterup', get_template_directory_uri() . '/js/jquery.counterup.min.js', array('jquery'));
	wp_enqueue_script( 'jquery-waypoints', 'https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.0/jquery.waypoints.min.js', array('jquery'));

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'tagbroker_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

function sanitize_custom_option($input){
	return filter_var($input, FILTER_SANITIZE_STRING);
}

function tagbroker_customizer( $wp_customize ){
	$wp_customize->add_section('tagbroker_settings', array(
		'title'=> __('Nastavení šablony', 'tagbroker'),
		'priority' => 1
	));

	//Header - Popisek
	$wp_customize->add_setting('tagbroker_description_setting', array(
		'default'=>'',
		'sanitize_callback'=>'sanitize_custom_option'
	));

	$wp_customize->add_control('tagbroker_description_control', array(
		'label'=>__('Popisek pod logem', 'tagbroker'),
		'type'=>'textarea',
		'section'=>'tagbroker_settings',
		'settings'=>'tagbroker_description_setting'
	) );

	//Slider
	for($i = 0; $i < 8; $i++){
		$wp_customize->add_setting('tagbroker_header_settings_slider_'.$i.'_img', array(
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'absint'
		));
		$wp_customize->add_setting('tagbroker_header_settings_slider_'.$i.'_text', array(
			'default'=>'',
			'sanitize_callback'=>'sanitize_custom_option'
		));
		$wp_customize->add_setting('tagbroker_header_settings_slider_'.$i.'_button_href', array(
			'default'=>'',
			'sanitize_callback'=>'sanitize_custom_option'
		));
		$wp_customize->add_setting('tagbroker_header_settings_slider_'.$i.'_button_text', array(
			'default'=>'',
			'sanitize_callback'=>'sanitize_custom_option'
		));

		$wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'tagbroker_header_settings_slider_'.$i.'_img_control', array(
			'label'=>__('Slider '.$i.' - Obrázek', 'tagbroker'),
			'section' => 'image',
			'mime_type' => 'image',
			'section'=>'tagbroker_settings',
			'settings'=>'tagbroker_header_settings_slider_'.$i.'_img'
		)));
		$wp_customize->add_control('tagbroker_header_settings_slider_'.$i.'_text_control', array(
			'label'=>__('Slider '.$i.' - Text', 'tagbroker'),
			'type'=>'textarea',
			'section'=>'tagbroker_settings',
			'settings'=>'tagbroker_header_settings_slider_'.$i.'_text'
		) );
		$wp_customize->add_control('tagbroker_header_settings_slider_'.$i.'_button_href_control', array(
			'label'=>__('Slider '.$i.' - Tlačítko odkaz', 'tagbroker'),
			'type'=>'input',
			'section'=>'tagbroker_settings',
			'settings'=>'tagbroker_header_settings_slider_'.$i.'_button_href'
		) );
		$wp_customize->add_control('tagbroker_header_settings_slider_'.$i.'_button_text_control', array(
			'label'=>__('Slider '.$i.' - Tlačítko text', 'tagbroker'),
			'type'=>'input',
			'section'=>'tagbroker_settings',
			'settings'=>'tagbroker_header_settings_slider_'.$i.'_button_text'
		) );
	}

}
add_action('customize_register', 'tagbroker_customizer');
