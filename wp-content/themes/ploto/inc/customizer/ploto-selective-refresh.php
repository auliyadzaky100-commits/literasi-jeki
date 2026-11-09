<?php
function ploto_site_selective_partials( $wp_customize ){	
	// ploto_hdr_top_info_title
	$wp_customize->selective_refresh->add_partial( 'ploto_hdr_top_info_title', array(
		'selector'            => '.dt_header .dt_header-topbar .widget_text.info .title',
		'settings'            => 'ploto_hdr_top_info_title',
		'render_callback'  => 'ploto_hdr_top_info_title_render_callback',
	) );
	
	// ploto_hdr_top_info_btn_lbl
	$wp_customize->selective_refresh->add_partial( 'ploto_hdr_top_info_btn_lbl', array(
		'selector'            => '.dt_header .dt_header-topbar .widget_text.info .title a',
		'settings'            => 'ploto_hdr_top_info_btn_lbl',
		'render_callback'  => 'ploto_hdr_top_info_btn_lbl_render_callback',
	) );
	
	// ploto_hdr_email_title
	$wp_customize->selective_refresh->add_partial( 'ploto_hdr_email_title', array(
		'selector'            => '.dt_header .dt_header-topbar .widget_contact.email .contact__body .title a',
		'settings'            => 'ploto_hdr_email_title',
		'render_callback'  => 'ploto_hdr_email_title_render_callback',
	) );
	
	// ploto_hdr_time_title
	$wp_customize->selective_refresh->add_partial( 'ploto_hdr_time_title', array(
		'selector'            => '.dt_header .dt_header-topbar .widget_contact.time .contact__body .title',
		'settings'            => 'ploto_hdr_time_title',
		'render_callback'  => 'ploto_hdr_time_title_render_callback',
	) );
	
	// ploto_hdr_account_title
	$wp_customize->selective_refresh->add_partial( 'ploto_hdr_account_title', array(
		'selector'            => '.dt_header .dt_navbar-user-item .dt_user_btn',
		'settings'            => 'ploto_hdr_account_title',
		'render_callback'  => 'ploto_hdr_account_title_render_callback',
	) );
	
	// ploto_hdr_btn_lbl
	$wp_customize->selective_refresh->add_partial( 'ploto_hdr_btn_lbl', array(
		'selector'            => '.dt_header .dt_navbar-button-item .dt-btn',
		'settings'            => 'ploto_hdr_btn_lbl',
		'render_callback'  => 'ploto_hdr_btn_lbl_render_callback',
	) );

	// ploto_footer_copyright_text
	$wp_customize->selective_refresh->add_partial( 'ploto_footer_copyright_text', array(
		'selector'            => '.dt_footer .dt_footer_copyright-text',
		'settings'            => 'ploto_footer_copyright_text',
		'render_callback'  => 'ploto_footer_copyright_text_render_callback',
	) );
	}
add_action( 'customize_register', 'ploto_site_selective_partials' );