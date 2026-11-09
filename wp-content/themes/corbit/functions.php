<?php
/**
 * Theme functions and definitions
 *
 * @package Corbit
 */

/**
 * After setup theme hook
 */
function corbit_theme_setup(){
    /*
     * Make child theme available for translation.
     * Translations can be filed in the /languages/ directory.
     */
    load_child_theme_textdomain( 'corbit' );	
}
add_action( 'after_setup_theme', 'corbit_theme_setup' );

/**
 * Load assets.
 */

function corbit_theme_css() {
	wp_enqueue_style( 'corbit-parent-theme-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'corbit_theme_css', 99);

require get_stylesheet_directory() . '/theme-functions/controls/class-customize.php';

/**
 * Import Options From Parent Theme
 *
 */
function corbit_parent_theme_options() {
	$ploto_mods = get_option( 'theme_mods_ploto' );
	if ( ! empty( $ploto_mods ) ) {
		foreach ( $ploto_mods as $ploto_mod_k => $ploto_mod_v ) {
			set_theme_mod( $ploto_mod_k, $ploto_mod_v );
		}
	}
}
add_action( 'after_switch_theme', 'corbit_parent_theme_options' );