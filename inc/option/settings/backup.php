<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( class_exists( 'CSF' ) ) {

    CSF::createSection( 'exsit_settings', array(
        'title'       => esc_html__( 'Backup', 'exsit-addons' ),
        'icon'        => 'fas fa-shield-alt',
        'description' => esc_html__( 'Backup theme options data.', 'exsit-addons' ),
        'fields'      => array(
            array(
                'type' => 'backup',
            ),
        ),
    ) );
}