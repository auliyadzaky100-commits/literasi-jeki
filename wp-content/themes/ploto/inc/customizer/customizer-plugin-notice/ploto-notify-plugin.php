<?php
/*
 *  Customizer Notifications
 */
require get_template_directory() . '/inc/customizer/customizer-plugin-notice/ploto-customizer-notify.php';
$ploto_config_customizer = array(
    'recommended_plugins' => array( 
        'desert-companion' => array(
            'recommended' => true,
            'description' => sprintf( 
                /* translators: %s: plugin name */
                esc_html__( 'If you want to show all the features and sections of the Theme. please install and activate %s plugin', 'ploto' ), '<strong>Desert Companion</strong>' 
            ),
        ),
    ),
	'recommended_actions'       => array(),
	'recommended_actions_title' => esc_html__( 'Recommended Actions', 'ploto' ),
	'recommended_plugins_title' => esc_html__( 'Recommended Plugin', 'ploto' ),
	'install_button_label'      => esc_html__( 'Install and Activate', 'ploto' ),
	'activate_button_label'     => esc_html__( 'Activate', 'ploto' ),
	'ploto_deactivate_button_label'   => esc_html__( 'Deactivate', 'ploto' ),
);
Ploto_Customizer_Notify::init( apply_filters( 'ploto_customizer_notify_array', $ploto_config_customizer ) );