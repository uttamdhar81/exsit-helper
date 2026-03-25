<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( class_exists( 'CSF' ) ) {

    CSF::createSection( 'exsit_settings', array(
        'title'  => esc_html__( 'Header Setting', 'exsit-helper' ),
        'icon'   => 'fa fa-tasks',
        'id'     => 'exsit_header',
        'fields' => array(

            array(
                'id'    => 'exsit_header_settings',
                'type'  => 'tabbed',
                'title' => esc_html__( 'Header', 'exsit-helper' ),
                'tabs'  => array(

                    array(
                        'title'  => esc_html__( 'Header Logo', 'exsit-helper' ),
                        'id'     => 'exsit_header_logo_option',
                        'fields' => array(

                            array(
                                'id'       => 'exsit_site_logo_dimensions',
                                'type'     => 'dimensions',
                                'units'    => array( 'px' ),
                                'title'    => esc_html__( 'Logo Dimensions (Width/Height).', 'exsit-helper' ),
                                'output'   => array( '.header-logo img' ),
                                'subtitle' => esc_html__( 'Set logo dimensions to choose width, height, and unit.', 'exsit-helper' ),
                            ),

                            array(
                                'id'             => 'exsit_site_logo_margin_dimensions',
                                'type'           => 'spacing',
                                'mode'           => 'margin',
                                'output'         => array( '.header-logo img' ),
                                'units_extended' => false,
                                'units'          => array( 'px' ),
                                'title'          => esc_html__( 'Logo Top and Bottom Margin.', 'exsit-helper' ),
                                'left'           => false,
                                'right'          => false,
                                'subtitle'       => esc_html__( 'Set logo top and bottom margin.', 'exsit-helper' ),
                                'default'        => array(
                                    'units' => 'px',
                                ),
                            ),

                            array(
                                'id'       => 'exsit_text_title',
                                'type'     => 'text',
                                'validate' => 'html',
                                'title'    => esc_html__( 'Text Logo', 'exsit-helper' ),
                                'subtitle' => esc_html__( 'Write your logo text to use as logo (you can use <span> tag for styling).', 'exsit-helper' ),
                            ),

                        ),
                    ),

                ),
            ),

        ),
    ) );
}