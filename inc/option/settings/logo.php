<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( class_exists( 'CSF' ) ) {

    CSF::createSection( 'exsit_settings', array(

        'title' => esc_html__( 'Logo', 'exsit-addons' ),
        'icon'  => 'fas fa-image',

        'fields' => array(

            array(
                'id'       => 'exsit_dark_logo',
                'type'     => 'media',
                'title'    => esc_html__( 'Dark Logo', 'exsit-addons' ),
                'subtitle' => esc_html__( 'Choose the site dark logo.', 'exsit-addons' ),
                'default'  => array(
                    'url' => '',
                ),
            ),

            array(
                'id'       => 'exsit_white_logo',
                'type'     => 'media',
                'title'    => esc_html__( 'White Logo', 'exsit-addons' ),
                'subtitle' => esc_html__( 'Choose the site white logo.', 'exsit-addons' ),
                'default'  => array(
                    'url' => '',
                ),
            ),

        ),

    ) );
}