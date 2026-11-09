<?php
/**
 * Ploto Customizer Class
 *
 * @package Ploto
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

 if ( ! class_exists( 'Ploto_Customizer' ) ) :

	class Ploto_Customizer {

		// Constructor customizer
		public function __construct() {
			add_action( 'customize_register',array( $this, 'ploto_customizer_register' ) );
			add_action( 'customize_register',array( $this, 'ploto_customizer_sainitization_selective_refresh' ) );
			add_action( 'customize_register',array( $this, 'ploto_customizer_control' ) );
			add_action( 'customize_preview_init',array( $this, 'ploto_customize_preview_js' ) );
			add_action( 'customize_controls_enqueue_scripts',array( $this, 'ploto_customizer_navigation_script' ) );
			add_action( 'after_setup_theme',array( $this, 'ploto_customizer_settings' ) );
		}
		
		/**
		 * Add postMessage support for site title and description for the Theme Customizer.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		public function ploto_customizer_register( $wp_customize ) {
			
			$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
			$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
			$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
			$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
			$wp_customize->get_setting('custom_logo')->transport = 'refresh';
		}
		
		// Register custom controls
		public function ploto_customizer_control( $wp_customize ) {
			
			$ploto_control_dir =  PLOTO_THEME_INC_DIR . '/customizer/controls';
			
			// Load custom control classes.
			$wp_customize->register_control_type( 'Ploto_Customizer_Range_Control' );
			require $ploto_control_dir . '/code/ploto-slider-control.php';
			require $ploto_control_dir . '/code/ploto-icon-picker-control.php';
			require $ploto_control_dir . '/code/ploto-category-dropdown-control.php';

		}
		
		// selective refresh.
		public function ploto_customizer_sainitization_selective_refresh() {

			require PLOTO_THEME_INC_DIR . '/customizer/sanitization.php';

		}

		// Theme Customizer preview reload changes asynchronously.
		public function ploto_customize_preview_js() {
			wp_enqueue_script( 'ploto-customizer', PLOTO_THEME_INC_URI . '/customizer/assets/js/customizer-preview.js', array( 'customize-preview' ), PLOTO_THEME_VERSION, true );
		}
		
		public function ploto_customizer_navigation_script() {
			 wp_enqueue_script( 'ploto-customizer-section', PLOTO_THEME_INC_URI .'/customizer/assets/js/customizer-section.js', array("jquery"),'', true  );	
		}
		

		// Include customizer settings.
			
		public function ploto_customizer_settings() {
			// Recommended Plugin
			require PLOTO_THEME_INC_DIR . '/customizer/customizer-plugin-notice/ploto-notify-plugin.php';
			
			// Upsale
			require PLOTO_THEME_INC_DIR . '/customizer/controls/code/upgrade/class-customize.php';
			
			$ploto_customize_dir =  PLOTO_THEME_INC_DIR . '/customizer/customizer-settings';
			require $ploto_customize_dir . '/ploto-header-customize-setting.php';
			require $ploto_customize_dir . '/ploto-footer-customize-setting.php';
			require $ploto_customize_dir . '/ploto-theme-customize-setting.php';
			require $ploto_customize_dir . '/ploto-typography-customize-setting.php';
			require PLOTO_THEME_INC_DIR . '/customizer/ploto-selective-partial.php';
			require PLOTO_THEME_INC_DIR . '/customizer/ploto-selective-refresh.php';
		}

	}
endif;
new Ploto_Customizer();