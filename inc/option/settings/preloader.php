<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( class_exists( 'CSF' ) ) {

    CSF::createSection( 'exsit_settings', array(

        'title' => esc_html__( 'Preloader', 'exsit-addons' ),
        'icon'  => 'fa fa-spinner',

        'fields' => array(

            array(
                'id'       => 'exsit_display_preloader',
                'type'     => 'switcher',
                'title'    => esc_html__( 'Preloader', 'exsit-addons' ),
                'subtitle' => esc_html__( 'Switch enabled to display preloader.', 'exsit-addons' ),
                'default'  => true,
                'on'       => esc_html__( 'Enabled', 'exsit-addons' ),
                'off'      => esc_html__( 'Disabled', 'exsit-addons' ),
            ),

        ),

    ) );
}