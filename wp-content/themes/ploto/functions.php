<?php
/**
 * Ploto functions and definitions
 *
 * @link    https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Ploto
 */
 
if ( ! function_exists( 'ploto_theme_setup' ) ) :
function ploto_theme_setup() {
	
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Ploto, use a find and replace
	 * to change 'Ploto' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'ploto' );
	
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	
	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	
	add_theme_support( 'custom-header' );
	
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary_menu' => esc_html__( 'Primary Menu', 'ploto' )
	) );
	
	//Add selective refresh for sidebar widget
	add_theme_support( 'customize-selective-refresh-widgets' );
	
	// woocommerce support
	add_theme_support( 'woocommerce' );
	
	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support('custom-logo');
	
	/**
	 * Custom background support.
	 */
	add_theme_support( 'custom-background', apply_filters( 'ploto_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
	
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
	
	/**
	 * Set default content width.
	 */
	if ( ! isset( $content_width ) ) {
		$content_width = 800;
	}	
}
endif;
add_action( 'after_setup_theme', 'ploto_theme_setup' );

/**
 * Enqueue scripts and styles.
 */
function ploto_scripts() {
	
	/**
	 * Styles.
	 */
	// Owl Crousel	
	wp_enqueue_style('owl-carousel-min',get_template_directory_uri().'/assets/vendors/css/owl.carousel.min.css');
	
	// Font Awesome
	wp_enqueue_style('all-css',get_template_directory_uri().'/assets/vendors/css/all.min.css');
	
	// Animate
	wp_enqueue_style('animate',get_template_directory_uri().'/assets/vendors/css/animate.css');

	// Fancybox
	wp_enqueue_style('Fancybox',get_template_directory_uri().'/assets/vendors/css/jquery.fancybox.min.css');
	
	// aos
	wp_enqueue_style('aos',get_template_directory_uri().'/assets/vendors/css/aos.min.css');
	
	// Ploto Core
	wp_enqueue_style('ploto-core',get_template_directory_uri().'/assets/css/core.css');

	// Ploto Theme
	wp_enqueue_style('ploto-theme', get_template_directory_uri() . '/assets/css/themes.css');
	
	// Ploto WooCommerce
	wp_enqueue_style('ploto-woocommerce',get_template_directory_uri().'/assets/css/woo-styles.css');
	
	// Ploto Style
	wp_enqueue_style( 'ploto-style', get_stylesheet_uri() );
	
	// Masonry
	wp_enqueue_script( 'masonry' );

	// imagesloaded
	wp_enqueue_script( 'imagesloaded' );
	
	// Owl Crousel
	wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/assets/vendors/js/owl.carousel.js', array('jquery'), true);
	
	// Wow
	wp_enqueue_script('wow-min', get_template_directory_uri() . '/assets/vendors/js/wow.min.js', array('jquery'), false, true);
	
	// appear
	wp_enqueue_script('jquery-appear', get_template_directory_uri() . '/assets/vendors/js/jquery.appear.js', array('jquery'), false, true);
	
	// fancybox
	wp_enqueue_script('fancybox', get_template_directory_uri() . '/assets/vendors/js/jquery.fancybox.js', array('jquery'), false, true);
	
	// odometer
	wp_enqueue_script('odometer', get_template_directory_uri() . '/assets/vendors/js/jquery.odometer.min.js', array('jquery'), false, true);
	
	// lenis
	wp_enqueue_script('lenis', get_template_directory_uri() . '/assets/vendors/js/lenis.min.js', array('jquery'), false, true);
	
	// scrolltrigger
	wp_enqueue_script('scrolltrigger', get_template_directory_uri() . '/assets/vendors/js/scrolltrigger.js', array('jquery'), false, true);
	
	// splittext
	wp_enqueue_script('splittext', get_template_directory_uri() . '/assets/vendors/js/splittext.min.js', array('jquery'), false, true);
	
	// Ploto Theme
	wp_enqueue_script('ploto-theme', get_template_directory_uri() . '/assets/js/theme.js', array('jquery'), false, true);
	
	// Ploto custom
	wp_enqueue_script('ploto-custom-js', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), false, true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ploto_scripts' );

/**
 * Enqueue admin scripts and styles.
 */
function ploto_admin_enqueue_scripts(){
	wp_enqueue_style('ploto-admin-style', get_template_directory_uri() . '/inc/admin/assets/css/admin.css');
	wp_enqueue_script( 'ploto-admin-script', get_template_directory_uri() . '/inc/admin/assets/js/ploto-admin-script.js', array( 'jquery' ), '', true );
    wp_localize_script( 'ploto-admin-script', 'ploto_ajax_object',
        array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'nonce'    => wp_create_nonce('ploto_nonce')
        )
    );
}
add_action( 'admin_enqueue_scripts', 'ploto_admin_enqueue_scripts' );

/**
 * Enqueue User Custom styles.
 */
 if( ! function_exists( 'ploto_user_custom_style' ) ):
    function ploto_user_custom_style() {

		$ploto_print_style = '';
		
			
		 /*=========================================
		 Ploto Page Title
		=========================================*/
		 $ploto_print_style   .=  ploto_customizer_value( 'ploto_breadcrumb_title_size', '.dt_pagetitle .dt_pagetitle_content .title > *', array( 'font-size' ), array( 6, 6, 6 ), 'rem' );
		  $ploto_print_style   .=  ploto_customizer_value( 'ploto_breadcrumb_content_size', '.dt_pagetitle .dt_pagetitle_content .dt_pagetitle_breadcrumb li', array( 'font-size' ), array( 2, 2, 2 ), 'rem' );
		
		$ploto_breadcrumb_opacity_color 	= get_theme_mod('ploto_breadcrumb_opacity_color','#0f0d1d');
			$ploto_print_style .=".dt_pagetitle .dt_pagetitle_bgimage::before {
						background-image: linear-gradient(90deg, " .esc_attr($ploto_breadcrumb_opacity_color). " 0%, rgba(0, 0, 0, 0.15) 100%);
				}\n";
		
	
		 /*=========================================
		 Ploto Logo Size
		=========================================*/
		$ploto_print_style   .= ploto_customizer_value( 'hdr_logo_size', '.site--logo img', array( 'max-width' ), array( 150, 150, 150 ), 'px !important' );
		$ploto_print_style   .= ploto_customizer_value( 'hdr_site_title_size', '.site--logo .site-title', array( 'font-size' ), array( 55, 55, 55 ), 'px !important' );
		$ploto_print_style   .= ploto_customizer_value( 'hdr_site_desc_size', '.site--logo .site-description', array( 'font-size' ), array( 16, 16, 16 ), 'px !important' );	
			
		$ploto_site_container_width 			 = get_theme_mod('ploto_site_container_width','2304');
			if($ploto_site_container_width >=768 && $ploto_site_container_width <=2000){
				$ploto_print_style .=".dt-container,.dt_slider .dt_owl_carousel.owl-carousel .owl-nav,.dt_slider .dt_owl_carousel.owl-carousel .owl-dots {
						max-width: " .esc_attr($ploto_site_container_width). "px;
					}.header--eight .dt-container {
						max-width: calc(" .esc_attr($ploto_site_container_width). "px + 7.15rem);
					}\n";
			}
					
		/**
		 *  Sidebar Width
		 */
		$ploto_sidebar_width = get_theme_mod('ploto_sidebar_width',33);
		if($ploto_sidebar_width !== '') { 
			$ploto_primary_width   = absint( 100 - $ploto_sidebar_width );
				$ploto_print_style .="	@media (min-width: 992px) {#dt-main {
					max-width:" .esc_attr($ploto_primary_width). "%;
					flex-basis:" .esc_attr($ploto_primary_width). "%;
				}\n";
				$ploto_print_style .="#dt-sidebar {
					max-width:" .esc_attr($ploto_sidebar_width). "%;
					flex-basis:" .esc_attr($ploto_sidebar_width). "%;
				}}\n";
        }
		$ploto_print_style   .= ploto_customizer_value( 'ploto_widget_ttl_size', '.dt_widget-area .widget .widget-title', array( 'font-size' ), array( 20, 20, 20 ), 'px' );
		
		/**
		 *  Typography Body
		 */
		 $ploto_body_font_weight_option	 	 = get_theme_mod('ploto_body_font_weight_option','inherit');
		 $ploto_body_text_transform_option	 = get_theme_mod('ploto_body_text_transform_option','inherit');
		 $ploto_body_font_style_option	 	 = get_theme_mod('ploto_body_font_style_option','inherit');
		 $ploto_body_txt_decoration_option	 = get_theme_mod('ploto_body_txt_decoration_option','none');
		
		 $ploto_print_style   .= ploto_customizer_value( 'ploto_body_font_size_option', 'body', array( 'font-size' ), array( 16, 16, 16 ), 'px' );
		 $ploto_print_style   .= ploto_customizer_value( 'ploto_body_line_height_option', 'body', array( 'line-height' ), array( 1.6, 1.6, 1.6 ) );
		 $ploto_print_style   .= ploto_customizer_value( 'ploto_body_ltr_space_option', 'body', array( 'letter-spacing' ), array( 0, 0, 0 ), 'px' );
		 $ploto_print_style .=" body{ 
			font-weight: " .esc_attr($ploto_body_font_weight_option). ";
			text-transform: " .esc_attr($ploto_body_text_transform_option). ";
			font-style: " .esc_attr($ploto_body_font_style_option). ";
			text-decoration: " .esc_attr($ploto_body_txt_decoration_option). ";
		}\n";		 
		
		/**
		 *  Typography Heading
		 */
		 for ( $i = 1; $i <= 6; $i++ ) {
			 $ploto_heading_font_weight_option	 	= get_theme_mod('ploto_h' . $i . '_font_weight_option','700');
			 $ploto_heading_text_transform_option 	= get_theme_mod('ploto_h' . $i . '_text_transform_option','inherit');
			 $ploto_heading_font_style_option	 	= get_theme_mod('ploto_h' . $i . '_font_style_option','inherit');
			 $ploto_heading_txt_decoration_option	= get_theme_mod('ploto_h' . $i . '_txt_decoration_option','inherit');
			 
			 $ploto_print_style   .= ploto_customizer_value( 'ploto_h' . $i . '_font_size_option', 'h' . $i .'', array( 'font-size' ), array( 36, 36, 36 ), 'px' );
			 $ploto_print_style   .= ploto_customizer_value( 'ploto_h' . $i . '_line_height_option', 'h' . $i . '', array( 'line-height' ), array( 1.2, 1.2, 1.2 ) );
			 $ploto_print_style   .= ploto_customizer_value( 'ploto_h' . $i . '_ltr_space_option', 'h' . $i . '', array( 'letter-spacing' ), array( 0, 0, 0 ), 'px' );
			 $ploto_print_style .=" h" . $i . "{ 
				font-weight: " .esc_attr($ploto_heading_font_weight_option). ";
				text-transform: " .esc_attr($ploto_heading_text_transform_option). ";
				font-style: " .esc_attr($ploto_heading_font_style_option). ";
				text-decoration: " .esc_attr($ploto_heading_txt_decoration_option). ";
			}\n";
		 }
		
		
		/*=========================================
		Footer 
		=========================================*/
		$ploto_footer_bg_color			= get_theme_mod('ploto_footer_bg_color','#001321');
		if(!empty($ploto_footer_bg_color)):
			 $ploto_print_style .=".dt_footer--one.dark, .dt_footer--two.dark { 
				    background-color: ".esc_attr($ploto_footer_bg_color).";
			}\n";
		endif;
        wp_add_inline_style( 'ploto-style', $ploto_print_style );
    }
endif;
add_action( 'wp_enqueue_scripts', 'ploto_user_custom_style' );


/**
 * Define Constants
 */
 
$ploto_theme = wp_get_theme();
define( 'PLOTO_THEME_VERSION', $ploto_theme->get( 'Version' ) );

// Root path/URI.
define( 'PLOTO_THEME_DIR', get_template_directory() );
define( 'PLOTO_THEME_URI', get_template_directory_uri() );

// Root path/URI.
define( 'PLOTO_THEME_INC_DIR', PLOTO_THEME_DIR . '/inc');
define( 'PLOTO_THEME_INC_URI', PLOTO_THEME_URI . '/inc');


/**
 * Implement the Custom Header feature.
 */
require_once get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require_once get_template_directory() . '/inc/template-tags.php';
require_once get_template_directory() . '/inc/sidebar.php';

/**
 * Customizer additions.
 */
 require_once get_template_directory() . '/inc/customizer/ploto-customizer.php';
 require get_template_directory() . '/inc/customizer/controls/code/customizer-repeater/inc/customizer.php';
 
/**
 * Nav Walker for Bootstrap Dropdown Menu.
 */
require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';

/**
 * Control Style
 */

require PLOTO_THEME_INC_DIR . '/customizer/controls/code/control-function/style-functions.php';

/**
 * Getting Started
 */
require PLOTO_THEME_INC_DIR . '/admin/getting-started.php';