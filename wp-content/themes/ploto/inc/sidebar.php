<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

function ploto_widgets_init() {	
	if ( class_exists( 'WooCommerce' ) ) {
		register_sidebar( array(
			'name' => __( 'WooCommerce Widget Area', 'ploto' ),
			'id' => 'ploto-woocommerce-sidebar',
			'description' => __( 'This Widget area for WooCommerce Widget', 'ploto' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h5 class="widget-title">',
			'after_title' => '</h5>',
		) );
	}
	
	register_sidebar( array(
		'name' => __( 'Sidebar Widget Area', 'ploto' ),
		'id' => 'ploto-sidebar-primary',
		'description' => __( 'The Primary Widget Area', 'ploto' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );
	
	
	$ploto_footer_widget_column = get_theme_mod('ploto_footer_widget_column','4');
	for ($i=1; $i<=$ploto_footer_widget_column; $i++) {
		register_sidebar( array(
			'name' => __( 'Footer  ', 'ploto' )  . $i,
			'id' => 'ploto-footer-widget-' . $i,
			'description' => __( 'The Footer Widget Area', 'ploto' )  . $i,
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h5 class="widget-title">',
			'after_title' => '</h5>',
		) );
	}
}
add_action( 'widgets_init', 'ploto_widgets_init' );