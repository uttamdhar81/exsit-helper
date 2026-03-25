<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( class_exists( 'CSF' ) ) {

    CSF::createSection( 'exsit_settings', array(

        'title' => esc_html__( 'Logo', 'exsit-helper' ),
        'icon'  => 'fas fa-image',

        'fields' => array(

            array(
                'id'       => 'exsit_dark_logo',
                'type'     => 'media',
                'title'    => esc_html__( 'Dark Logo', 'exsit-helper' ),
                'subtitle' => esc_html__( 'Choose the site dark logo.', 'exsit-helper' ),
                'default'  => array(
                    'url' => '',
                ),
            ),

            array(
                'id'       => 'exsit_white_logo',
                'type'     => 'media',
                'title'    => esc_html__( 'White Logo', 'exsit-helper' ),
                'subtitle' => esc_html__( 'Choose the site white logo.', 'exsit-helper' ),
                'default'  => array(
                    'url' => '',
                ),
            ),

        ),

    ) );
}