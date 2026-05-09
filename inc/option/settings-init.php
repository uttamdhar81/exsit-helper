<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( class_exists( 'CSF' ) ) {

    $exsit = 'exsit_settings';

    CSF::createOptions( $exsit, array(

        'framework_title'    => esc_html__( 'Theme Settings', 'exsit-helper' ),
        'framework_class'    => 'exsit-framework',

        // Main Menu
        'menu_title'         => esc_html__( 'Exsit Theme', 'exsit-helper' ),
        'menu_slug'          => 'exsit-theme-option',
        'menu_type'          => 'menu',
        'menu_icon'          => 'dashicons-admin-tools',
        'menu_capability'    => 'manage_options',
        'menu_position'      => 30,

        // Features
        'show_bar_menu'      => true,
        'show_sub_menu'      => false,
        'show_search'        => true,
        'show_reset_all'     => true,
        'show_reset_section' => true,

        // Footer
        'footer_text'        => esc_html__( 'Thank you for using Exsit', 'exsit-helper' ),
        'footer_credit'      => esc_html__( 'Powered by Exsit', 'exsit-helper' ),

        // Output CSS
        'output_css'         => true,

    ) );
}