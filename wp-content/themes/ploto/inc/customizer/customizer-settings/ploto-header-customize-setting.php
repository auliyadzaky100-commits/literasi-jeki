<?php
function ploto_header_customize_settings( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Header Settings Panel
	=========================================*/
	$wp_customize->add_panel( 
		'header_options', 
		array(
			'priority'      => 2,
			'capability'    => 'edit_theme_options',
			'title'			=> __('Header Options', 'ploto'),
		) 
	);
	
	/*=========================================
	Ploto Site Identity
	=========================================*/
	$wp_customize->add_section(
        'title_tagline',
        array(
        	'priority'      => 1,
            'title' 		=> __('Site Identity','ploto'),
			'panel'  		=> 'header_options',
		)
    );
	
	// Logo Width // 
	if ( class_exists( 'Ploto_Customizer_Range_Control' ) ) {
		$wp_customize->add_setting(
			'hdr_logo_size',
			array(
				'default'			=> '150',
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'ploto_sanitize_range_value',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control( 
		new Ploto_Customizer_Range_Control( $wp_customize, 'hdr_logo_size', 
			array(
				'label'      => __( 'Logo Size', 'ploto' ),
				'section'  => 'title_tagline',
				 'media_query'   => true,
					'input_attr'    => array(
						'mobile'  => array(
							'min'           => 0,
							'max'           => 500,
							'step'          => 1,
							'default_value' => 150,
						),
						'tablet'  => array(
							'min'           => 0,
							'max'           => 500,
							'step'          => 1,
							'default_value' => 150,
						),
						'desktop' => array(
							'min'           => 0,
							'max'           => 500,
							'step'          => 1,
							'default_value' => 150,
						),
					),
			) ) 
		);
	}
	
	
	// Site Title Size // 
	if ( class_exists( 'Ploto_Customizer_Range_Control' ) ) {
		$wp_customize->add_setting(
			'hdr_site_title_size',
			array(
				'default'			=> '55',
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'ploto_sanitize_range_value',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control( 
		new Ploto_Customizer_Range_Control( $wp_customize, 'hdr_site_title_size', 
			array(
				'label'      => __( 'Site Title Size', 'ploto' ),
				'section'  => 'title_tagline',
				 'media_query'   => true,
					'input_attr'    => array(
						'mobile'  => array(
							'min'           => 0,
							'max'           => 100,
							'step'          => 1,
							'default_value' => 55,
						),
						'tablet'  => array(
							'min'           => 0,
							'max'           => 100,
							'step'          => 1,
							'default_value' => 55,
						),
						'desktop' => array(
							'min'           => 0,
							'max'           => 100,
							'step'          => 1,
							'default_value' => 55,
						),
					),
			) ) 
		);
	}
	
	// Site Tagline Size // 
	if ( class_exists( 'Ploto_Customizer_Range_Control' ) ) {
		$wp_customize->add_setting(
			'hdr_site_desc_size',
			array(
				'default'			=> '16',
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'ploto_sanitize_range_value',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control( 
		new Ploto_Customizer_Range_Control( $wp_customize, 'hdr_site_desc_size', 
			array(
				'label'      => __( 'Site Tagline Size', 'ploto' ),
				'section'  => 'title_tagline',
				 'media_query'   => true,
					'input_attr'    => array(
						'mobile'  => array(
							'min'           => 0,
							'max'           => 50,
							'step'          => 1,
							'default_value' => 16,
						),
						'tablet'  => array(
							'min'           => 0,
							'max'           => 50,
							'step'          => 1,
							'default_value' => 16,
						),
						'desktop' => array(
							'min'           => 0,
							'max'           => 50,
							'step'          => 1,
							'default_value' => 16,
						),
					),
			) ) 
		);
	}
	
	
	// Hide / Show
	$wp_customize->add_setting( 
		'ploto_title_tagline_seo' , 
			array(
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'ploto_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'ploto_title_tagline_seo', 
		array(
			'label'	      => esc_html__( 'Enable Hidden Title (h1 missing SEO issue)', 'ploto' ),
			'section'     => 'title_tagline',
			'type'        => 'checkbox'
		) 
	);
	
	/*=========================================
	Top Header
	=========================================*/
	$wp_customize->add_section(
        'ploto_top_header',
        array(
        	'priority'      => 2,
            'title' 		=> __('Top Header','ploto'),
			'panel'  		=> 'header_options',
		)
    );	
	
	/*=========================================
	Global Setting
	=========================================*/
	$wp_customize->add_setting(
		'ploto_hdr_top'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'ploto_sanitize_text',
			'priority' => 3,
		)
	);

	$wp_customize->add_control(
	'ploto_hdr_top',
		array(
			'type' => 'hidden',
			'label' => __('Global Setting','ploto'),
			'section' => 'ploto_top_header',
		)
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'ploto_hs_hdr' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'ploto_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'ploto_hs_hdr', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'ploto' ),
			'section'     => 'ploto_top_header',
			'type'        => 'checkbox'
		) 
	);		
	
	/*=========================================
	Info
	=========================================*/
	$wp_customize->add_setting(
		'ploto_hdr_top_info'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'ploto_sanitize_text',
			'priority' => 11,
		)
	);

	$wp_customize->add_control(
	'ploto_hdr_top_info',
		array(
			'type' => 'hidden',
			'label' => __('Info','ploto'),
			'section' => 'ploto_top_header',
			
		)
	);
	$wp_customize->add_setting( 
		'ploto_hs_hdr_top_info', 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'ploto_sanitize_checkbox',
			'priority' => 11,
		) 
	);
	
	$wp_customize->add_control(
	'ploto_hs_hdr_top_info', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'ploto' ),
			'section'     => 'ploto_top_header',
			'type'        => 'checkbox'
		) 
	);	
	// icon // 
	$wp_customize->add_setting(
    	'ploto_hdr_top_info_icon',
    	array(
	        'default' => 'fal fa-medal',
			'sanitize_callback' => 'sanitize_text_field',
			'capability' => 'edit_theme_options',
		)
	);	

	$wp_customize->add_control(new Ploto_Icon_Picker_Control($wp_customize, 
		'ploto_hdr_top_info_icon',
		array(
		    'label'   		=> __('Icon','ploto'),
		    'section' 		=> 'ploto_top_header',			
		))  
	);
	
	// title // 
	$wp_customize->add_setting(
    	'ploto_hdr_top_info_title',
    	array(
	        'default'			=> __('Trusted partner in business excellence','ploto'),
			'sanitize_callback' => 'ploto_sanitize_html',
			'capability' => 'edit_theme_options',
			'priority' => 11,
		)
	);	

	$wp_customize->add_control( 
		'ploto_hdr_top_info_title',
		array(
		    'label'   		=> __('Title','ploto'),
		    'section' 		=> 'ploto_top_header',
			'type'		 =>	'text'
		)  
	);
	
	// Button Label // 
	$wp_customize->add_setting(
    	'ploto_hdr_top_info_btn_lbl',
    	array(
	        'default'			=> __('Join us now','ploto'),
			'sanitize_callback' => 'ploto_sanitize_html',
			'transport'         => $selective_refresh,
			'capability' => 'edit_theme_options',
			'priority' => 11,
		)
	);	

	$wp_customize->add_control( 
		'ploto_hdr_top_info_btn_lbl',
		array(
		    'label'   		=> __('Button Label','ploto'),
		    'section' 		=> 'ploto_top_header',
			'type'		 =>	'text'
		)  
	);
	
	// Link // 
	$wp_customize->add_setting(
    	'ploto_hdr_top_info_link',
    	array(
			'default'			=> '#',
			'sanitize_callback' => 'ploto_sanitize_url',
			'capability' => 'edit_theme_options',
			'priority' => 11,
		)
	);	

	$wp_customize->add_control( 
		'ploto_hdr_top_info_link',
		array(
		    'label'   		=> __('Button Link','ploto'),
		    'section' 		=> 'ploto_top_header',
			'type'		 =>	'text'
		)  
	);
		
		
	/*=========================================
	Email
	=========================================*/
	$wp_customize->add_setting(
		'ploto_hdr_top_email'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'ploto_sanitize_text',
			'priority' => 11,
		)
	);

	$wp_customize->add_control(
	'ploto_hdr_top_email',
		array(
			'type' => 'hidden',
			'label' => __('Email','ploto'),
			'section' => 'ploto_top_header',
		)
	);
	$wp_customize->add_setting( 
		'ploto_hs_hdr_email' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'ploto_sanitize_checkbox',
			'priority' => 12,
		) 
	);
	
	$wp_customize->add_control(
	'ploto_hs_hdr_email', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'ploto' ),
			'section'     => 'ploto_top_header',
			'type'        => 'checkbox'
		) 
	);	
	
	// icon // 
	$wp_customize->add_setting(
    	'ploto_hdr_email_icon',
    	array(
	        'default' => 'far fa-envelope-open',
			'sanitize_callback' => 'sanitize_text_field',
			'capability' => 'edit_theme_options',
		)
	);	

	$wp_customize->add_control(new Ploto_Icon_Picker_Control($wp_customize, 
		'ploto_hdr_email_icon',
		array(
		    'label'   		=> __('Icon','ploto'),
		    'section' 		=> 'ploto_top_header',
			'iconset' => 'fa',
			
		))  
	);	
	
	//  Title // 
	$wp_customize->add_setting(
    	'ploto_hdr_email_title',
    	array(
	        'default'			=> __('info@example.com','ploto'),
			'sanitize_callback' => 'ploto_sanitize_html',
			'capability' => 'edit_theme_options',
			'transport'         => $selective_refresh,
			'priority' => 13,
		)
	);	

	$wp_customize->add_control( 
		'ploto_hdr_email_title',
		array(
		    'label'   		=> __('Title','ploto'),
		    'section' 		=> 'ploto_top_header',
			'type'		 =>	'text'
		)  
	);
	
	// Link // 
	$wp_customize->add_setting(
    	'ploto_hdr_email_link',
    	array(
			'default'=> 'mailto:info@example.com',
			'sanitize_callback' => 'ploto_sanitize_url',
			'capability' => 'edit_theme_options',
			'priority' => 14,
		)
	);	

	$wp_customize->add_control( 
		'ploto_hdr_email_link',
		array(
		    'label'   		=> __('Link','ploto'),
		    'section' 		=> 'ploto_top_header',
			'type'		 =>	'text'
		)  
	);
	
	
	/*=========================================
	Time
	=========================================*/
	$wp_customize->add_setting(
		'ploto_hdr_top_time'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'ploto_sanitize_text',
			'priority' => 14,
		)
	);

	$wp_customize->add_control(
	'ploto_hdr_top_time',
		array(
			'type' => 'hidden',
			'label' => __('Time','ploto'),
			'section' => 'ploto_top_header',
		)
	);
	$wp_customize->add_setting( 
		'ploto_hs_hdr_time' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'ploto_sanitize_checkbox',
			'priority' => 14,
		) 
	);
	
	$wp_customize->add_control(
	'ploto_hs_hdr_time', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'ploto' ),
			'section'     => 'ploto_top_header',
			'type'        => 'checkbox'
		) 
	);	
	
	// icon // 
	$wp_customize->add_setting(
    	'ploto_hdr_time_icon',
    	array(
	        'default' => 'far fa-clock',
			'sanitize_callback' => 'sanitize_text_field',
			'capability' => 'edit_theme_options',
		)
	);	

	$wp_customize->add_control(new Ploto_Icon_Picker_Control($wp_customize, 
		'ploto_hdr_time_icon',
		array(
		    'label'   		=> __('Icon','ploto'),
		    'section' 		=> 'ploto_top_header',
			'iconset' => 'fa',
			
		))  
	);	
	
	//  Title // 
	$wp_customize->add_setting(
    	'ploto_hdr_time_title',
    	array(
	        'default'			=> __('Mon-Sat: 9.00am To 7.00pm','ploto'),
			'sanitize_callback' => 'ploto_sanitize_html',
			'capability' => 'edit_theme_options',
			'transport'         => $selective_refresh,
			'priority' => 14,
		)
	);	

	$wp_customize->add_control( 
		'ploto_hdr_time_title',
		array(
		    'label'   		=> __('Title','ploto'),
		    'section' 		=> 'ploto_top_header',
			'type'		 =>	'text'
		)  
	);
	
	// Link // 
	$wp_customize->add_setting(
    	'ploto_hdr_time_link',
    	array(
			'sanitize_callback' => 'ploto_sanitize_url',
			'capability' => 'edit_theme_options',
			'priority' => 14,
		)
	);	

	$wp_customize->add_control( 
		'ploto_hdr_time_link',
		array(
		    'label'   		=> __('Link','ploto'),
		    'section' 		=> 'ploto_top_header',
			'type'		 =>	'text'
		)  
	);
	
	/*=========================================
	Social
	=========================================*/
	$wp_customize->add_setting(
		'Ploto_hdr_social_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'ploto_sanitize_text',
			'priority' => 24,
		)
	);

	$wp_customize->add_control(
	'Ploto_hdr_social_head',
		array(
			'type' => 'hidden',
			'label' => __('Social Icons','ploto'),
			'section' => 'ploto_top_header',
		)
	);
	
	
	$wp_customize->add_setting( 
		'ploto_hs_hdr_social' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'ploto_sanitize_checkbox',
			'priority' => 25,
		) 
	);
	
	$wp_customize->add_control(
	'ploto_hs_hdr_social', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'ploto' ),
			'section'     => 'ploto_top_header',
			'type'        => 'checkbox'
		) 
	);
	
	/**
	 * Customizer Repeater
	 */
		$wp_customize->add_setting( 'ploto_hdr_social', 
			array(
			 'sanitize_callback' => 'ploto_repeater_sanitize',
			 'priority' => 26,
			 'default' => ploto_get_social_icon_default()
		)
		);
		
		$wp_customize->add_control( 
			new PLOTO_Repeater( $wp_customize, 
				'ploto_hdr_social', 
					array(
						'label'   => esc_html__('Social Icons','ploto'),
						'section' => 'ploto_top_header',
						'customizer_repeater_icon_control' => true,
						'customizer_repeater_link_control' => true,
					) 
				) 
			);
			
	// Upgrade
	if ( class_exists( 'Desert_Companion_Customize_Upgrade_Control' ) ) {
		$wp_customize->add_setting(
		'ploto_social_option_upsale', 
		array(
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'priority' => 26,
		));
		
		$wp_customize->add_control( 
			new Desert_Companion_Customize_Upgrade_Control
			($wp_customize, 
				'ploto_social_option_upsale', 
				array(
					'label'      => __( 'Icons', 'ploto' ),
					'section'    => 'ploto_top_header'
				) 
			) 
		);	
	}		
			
	/*=========================================
	Header Navigation
	=========================================*/	
	$wp_customize->add_section(
        'ploto_hdr_nav',
        array(
        	'priority'      => 4,
            'title' 		=> __('Navigation Bar','ploto'),
			'panel'  		=> 'header_options',
		)
    );
	
	/*=========================================
	Header Account
	=========================================*/	
	$wp_customize->add_setting(
		'ploto_hdr_account'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'ploto_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'ploto_hdr_account',
		array(
			'type' => 'hidden',
			'label' => __('My Account','ploto'),
			'section' => 'ploto_hdr_nav',
		)
	);
	
	
	$wp_customize->add_setting( 
		'ploto_hs_hdr_account' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'ploto_sanitize_checkbox',
			'priority' => 1,
		) 
	);
	
	$wp_customize->add_control(
	'ploto_hs_hdr_account', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'ploto' ),
			'section'     => 'ploto_hdr_nav',
			'type'        => 'checkbox'
		) 
	);	
	
	// icon // 
	$wp_customize->add_setting(
    	'ploto_hdr_account_icon',
    	array(
	        'default' => 'far fa-user',
			'sanitize_callback' => 'sanitize_text_field',
			'capability' => 'edit_theme_options',
		)
	);	

	$wp_customize->add_control(new Ploto_Icon_Picker_Control($wp_customize, 
		'ploto_hdr_account_icon',
		array(
		    'label'   		=> __('Icon','ploto'),
		    'section' 		=> 'ploto_hdr_nav',
			'iconset' => 'fa',
			
		))  
	);	
	
	//  Title // 
	$wp_customize->add_setting(
    	'ploto_hdr_account_title',
    	array(
	        'default'			=> __('Account','ploto'),
			'sanitize_callback' => 'ploto_sanitize_html',
			'capability' => 'edit_theme_options',
			'priority' => 1,
		)
	);	

	$wp_customize->add_control( 
		'ploto_hdr_account_title',
		array(
		    'label'   		=> __('Title','ploto'),
		    'section' 		=> 'ploto_hdr_nav',
			'type'		 =>	'text'
		)  
	);
	
	// Link // 
	$wp_customize->add_setting(
    	'ploto_hdr_account_link',
    	array(
			'default'			=> '#',
			'sanitize_callback' => 'ploto_sanitize_url',
			'capability' => 'edit_theme_options',
			'priority' => 1,
		)
	);	

	$wp_customize->add_control( 
		'ploto_hdr_account_link',
		array(
		    'label'   		=> __('Link','ploto'),
		    'section' 		=> 'ploto_hdr_nav',
			'type'		 =>	'text'
		)  
	);
	
	/*=========================================
	Header Cart
	=========================================*/	
	$wp_customize->add_setting(
		'ploto_hdr_cart'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'ploto_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'ploto_hdr_cart',
		array(
			'type' => 'hidden',
			'label' => __('WooCommerce Cart','ploto'),
			'section' => 'ploto_hdr_nav',
		)
	);
	
	
	$wp_customize->add_setting( 
		'ploto_hs_hdr_cart' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'ploto_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'ploto_hs_hdr_cart', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'ploto' ),
			'section'     => 'ploto_hdr_nav',
			'type'        => 'checkbox'
		) 
	);	
	
	/*=========================================
	Header Search
	=========================================*/	
	$wp_customize->add_setting(
		'ploto_hdr_search'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'ploto_sanitize_text',
			'priority' => 3,
		)
	);

	$wp_customize->add_control(
	'ploto_hdr_search',
		array(
			'type' => 'hidden',
			'label' => __('Site Search','ploto'),
			'section' => 'ploto_hdr_nav',
		)
	);
	$wp_customize->add_setting( 
		'ploto_hs_hdr_search' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'ploto_sanitize_checkbox',
			'priority' => 4,
		) 
	);
	
	$wp_customize->add_control(
	'ploto_hs_hdr_search', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'ploto' ),
			'section'     => 'ploto_hdr_nav',
			'type'        => 'checkbox'
		) 
	);	
	
	/*=========================================
	Header Button
	=========================================*/	
	$wp_customize->add_setting(
		'ploto_hdr_button'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'ploto_sanitize_text',
			'priority' => 7,
		)
	);

	$wp_customize->add_control(
	'ploto_hdr_button',
		array(
			'type' => 'hidden',
			'label' => __('Button','ploto'),
			'section' => 'ploto_hdr_nav',
		)
	);
	
	$wp_customize->add_setting(
		'ploto_hs_hdr_btn' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'ploto_sanitize_checkbox',
			'priority' => 8,
		) 
	);
	
	$wp_customize->add_control(
	'ploto_hs_hdr_btn', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'ploto' ),
			'section'     => 'ploto_hdr_nav',
			'type'        => 'checkbox'
		) 
	);
	
	
	// icon // 
	$wp_customize->add_setting(
    	'ploto_hdr_btn_icon',
    	array(
	        'default' => 'fab fa-whatsapp',
			'sanitize_callback' => 'sanitize_text_field',
			'capability' => 'edit_theme_options',
		)
	);	

	$wp_customize->add_control(new Ploto_Icon_Picker_Control($wp_customize, 
		'ploto_hdr_btn_icon',
		array(
		    'label'   		=> __('Icon','ploto'),
		    'section' 		=> 'ploto_hdr_nav',
			'iconset' => 'fa',
			
		))  
	);
	
	
	// Button Label // 
	$wp_customize->add_setting(
    	'ploto_hdr_btn_lbl',
    	array(
	        'default'			=> __('Get A Quote','ploto'),
			'sanitize_callback' => 'ploto_sanitize_html',
			'capability' => 'edit_theme_options',
			'priority' => 9,
		)
	);	

	$wp_customize->add_control( 
		'ploto_hdr_btn_lbl',
		array(
		    'label'   		=> __('Button Label','ploto'),
		    'section' 		=> 'ploto_hdr_nav',
			'type'		 =>	'text'
		)  
	);
	
	// Button Link // 
	$wp_customize->add_setting(
    	'ploto_hdr_btn_link',
    	array(
			'default'			=> '#',
			'sanitize_callback' => 'ploto_sanitize_url',
			'capability' => 'edit_theme_options',
			'priority' => 10,
		)
	);	

	$wp_customize->add_control( 
		'ploto_hdr_btn_link',
		array(
		    'label'   		=> __('Button Link','ploto'),
		    'section' 		=> 'ploto_hdr_nav',
			'type'		 =>	'text'
		)  
	);
	
	
	// Open New Tab
	$wp_customize->add_setting( 
		'ploto_hdr_btn_target' , 
			array(
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'ploto_sanitize_checkbox',
			'priority' => 11,
		) 
	);
	
	$wp_customize->add_control(
	'ploto_hdr_btn_target', 
		array(
			'label'	      => esc_html__( 'Open in New Tab ?', 'ploto' ),
			'section'     => 'ploto_hdr_nav',
			'type'        => 'checkbox'
		) 
	);	
	
	/*=========================================
	Sticky Header
	=========================================*/	
	$wp_customize->add_section(
        'ploto_sticky_header_set',
        array(
        	'priority'      => 4,
            'title' 		=> __('Header Sticky','ploto'),
			'panel'  		=> 'header_options',
		)
    );
	
	// Heading
	$wp_customize->add_setting(
		'ploto_hdr_sticky'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'ploto_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'ploto_hdr_sticky',
		array(
			'type' => 'hidden',
			'label' => __('Sticky Header','ploto'),
			'section' => 'ploto_sticky_header_set',
		)
	);
	$wp_customize->add_setting( 
		'ploto_hs_hdr_sticky' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'ploto_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'ploto_hs_hdr_sticky', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'ploto' ),
			'section'     => 'ploto_sticky_header_set',
			'type'        => 'checkbox'
		) 
	);	
}
add_action( 'customize_register', 'ploto_header_customize_settings' );