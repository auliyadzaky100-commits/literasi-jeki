<?php
function ploto_footer_customize_settings( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	// Footer Section Panel // 
	$wp_customize->add_panel( 
		'footer_options', 
		array(
			'priority'      => 34,
			'capability'    => 'edit_theme_options',
			'title'			=> __('Footer Options', 'ploto'),
		) 
	);

	/*=========================================
	Footer Widget
	=========================================*/
	$wp_customize->add_section(
        'ploto_footer_widget',
        array(
            'title' 		=> __('Footer Widget','ploto'),
			'panel'  		=> 'footer_options',
			'priority'      => 3,
		)
    );
	
	// Heading
	$wp_customize->add_setting(
		'ploto_footer_widget_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'ploto_sanitize_text',
		)
	);

	$wp_customize->add_control(
	'ploto_footer_widget_head',
		array(
			'type' => 'hidden',
			'label' => __('Footer Widget','ploto'),
			'section' => 'ploto_footer_widget',
			'priority'  => 1,
		)
	);
	
	
	// column // 
	$wp_customize->add_setting(
    	'ploto_footer_widget_column',
    	array(
	        'default'			=> '3',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'ploto_sanitize_select',
			'priority' => 3,
		)
	);	

	$wp_customize->add_control(
		'ploto_footer_widget_column',
		array(
		    'label'   		=> __('Select Widget Column','ploto'),
		    'section' 		=> 'ploto_footer_widget',
			'type'			=> 'select',
			'choices'        => 
			array(
				'' => __( 'None', 'ploto' ),
				'12' => __( '1 Column', 'ploto' ),
				'6' => __( '2 Column', 'ploto' ),
				'4' => __( '3 Column', 'ploto' ),
				'3' => __( '4 Column', 'ploto' )
			) 
		) 
	);
	
	
	/*=========================================
	Footer Copright
	=========================================*/
	$wp_customize->add_section(
        'ploto_footer_copyright',
        array(
            'title' 		=> __('Footer Copright','ploto'),
			'panel'  		=> 'footer_options',
			'priority'      => 4,
		)
    );
		
	// Heading
	$wp_customize->add_setting(
		'ploto_footer_copyright_first_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'ploto_sanitize_text',
		)
	);

	$wp_customize->add_control(
	'ploto_footer_copyright_first_head',
		array(
			'type' => 'hidden',
			'label' => __('Copyright','ploto'),
			'section' => 'ploto_footer_copyright',
			'priority'  => 3,
		)
	);
	
	// footer third text // 
	$ploto_copyright = esc_html__('Copyright &copy; [current_year] [site_title] | Powered by [theme_author]', 'ploto' );
	$wp_customize->add_setting(
    	'ploto_footer_copyright_text',
    	array(
			'default' => $ploto_copyright,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'ploto_sanitize_html',
		)
	);	

	$wp_customize->add_control( 
		'ploto_footer_copyright_text',
		array(
		    'label'   		=> __('Copyright','ploto'),
		    'section'		=> 'ploto_footer_copyright',
			'type' 			=> 'textarea',
			'priority'      => 4,
		)  
	);	

	/*=========================================
	Footer Background
	=========================================*/
	$wp_customize->add_section(
        'footer_background_options',
        array(
            'title' 		=> __('Footer Background','ploto'),
			'panel'  		=> 'footer_options',
			'priority'      => 4,
		)
    );
	
	
	//  Footer Background Color
	$wp_customize->add_setting(
	'ploto_footer_bg_color', 
	array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
		'default' => '#001321'
    ));
	
	$wp_customize->add_control( 
		new WP_Customize_Color_Control
		($wp_customize, 
			'ploto_footer_bg_color', 
			array(
				'label'      => __( 'Footer Background Color', 'ploto' ),
				'section'    => 'footer_background_options',
			) 
		) 
	);
}
add_action( 'customize_register', 'ploto_footer_customize_settings' );