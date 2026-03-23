<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( class_exists( 'CSF' ) ) {

    CSF::createSection( 'exsit_settings', array(
        'title' => esc_html__( '404 Page', 'exsit-addons' ),
        'icon'  => 'fa fa-exclamation-circle',

        'fields' => array(

            array(
                'title'    => esc_html__( '404 Image', 'exsit-addons' ),
                'subtitle' => esc_html__( 'Add your 404 image.', 'exsit-addons' ),
                'id'       => 'exsit_error_image',
                'type'     => 'media',
            ),

            array(
                'id'       => 'exsit_404_error_number',
                'type'     => 'text',
                'title'    => esc_html__( 'Page Error Number', 'exsit-addons' ),
                'subtitle' => esc_html__( 'Set page error number.', 'exsit-addons' ),
                'default'  => esc_html__( '404', 'exsit-addons' ),
            ),

            array(
                'id'       => 'exsit_404_title',
                'type'     => 'text',
                'title'    => esc_html__( 'Page Title', 'exsit-addons' ),
                'subtitle' => esc_html__( 'Set page title.', 'exsit-addons' ),
                'default'  => esc_html__( 'Oops! that page cant be found.', 'exsit-addons' ),
            ),

            array(
                'id'       => 'exsit_404_subtitle',
                'type'     => 'text',
                'title'    => esc_html__( 'Page Subtitle', 'exsit-addons' ),
                'subtitle' => esc_html__( 'Set page subtitle.', 'exsit-addons' ),
                'default'  => esc_html__( 'Oops, the page you are trying to access does not exist ? Try again later or go back to home.', 'exsit-addons' ),
            ),

            array(
                'id'       => 'exsit_404_btn_text',
                'type'     => 'text',
                'title'    => esc_html__( 'Button Text', 'exsit-addons' ),
                'subtitle' => esc_html__( 'Set button text.', 'exsit-addons' ),
                'default'  => esc_html__( 'Back To Home', 'exsit-addons' ),
            ),

        ),

    ) );
}