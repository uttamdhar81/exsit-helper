<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( class_exists( 'CSF' ) ) {

    $exsit = 'exsit_settings';

    CSF::createOptions( $exsit, array(
        'framework_title'      => esc_html__( 'Theme Settings', 'exsit-helper' ),
        'framework_class'      => 'exsit-framework',
        'menu_title'           => esc_html__( 'Theme Settings', 'exsit-helper' ),
        'menu_slug'            => 'exsit-theme-option',
        'menu_type'            => 'submenu',   // top-level menu (simpler)
        'menu_parent'          => 'exsit-theme-parent', // Ensure this is the correct parent slug
        'menu_capability'      => 'manage_options',
        'menu_position'        => 30,
        'show_bar_menu'        => true,
        'show_sub_menu'        => true,
        'show_search'          => true,
        'show_reset_all'       => true,
        'show_reset_section'   => true,
        'footer_text'          => esc_html__( 'Thank you for using Exsit', 'exsit-helper' ),
        'footer_credit'        => esc_html__( 'Powered by Exsit', 'exsit-helper' ),
        'output_css'           => true,
    ) );
}

