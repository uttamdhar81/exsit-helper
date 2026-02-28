<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( class_exists( 'CSF' ) ) {

    CSF::createSection( 'exsit_settings', array(
        'title'  => esc_html__( 'Header Setting', 'exsit-addons' ),
        'icon'   => 'fa fa-tasks',
        'id'     => 'exsit_header',
        'fields' => array(

            array(
                'id'    => 'exsit_header_settings',
                'type'  => 'tabbed',
                'title' => esc_html__( 'Header', 'exsit-addons' ),
                'tabs'  => array(

                    array(
                        'title'  => esc_html__( 'Header Logo', 'exsit-addons' ),
                        'id'     => 'exsit_header_logo_option',
                        'fields' => array(

                            array(
                                'id'       => 'exsit_site_logo_dimensions',
                                'type'     => 'dimensions',
                                'units'    => array( 'px' ),
                                'title'    => esc_html__( 'Logo Dimensions (Width/Height).', 'exsit-addons' ),
                                'output'   => array( '.header-logo img' ),
                                'subtitle' => esc_html__( 'Set logo dimensions to choose width, height, and unit.', 'exsit-addons' ),
                            ),

                            array(
                                'id'             => 'exsit_site_logo_margin_dimensions',
                                'type'           => 'spacing',
                                'mode'           => 'margin',
                                'output'         => array( '.header-logo img' ),
                                'units_extended' => false,
                                'units'          => array( 'px' ),
                                'title'          => esc_html__( 'Logo Top and Bottom Margin.', 'exsit-addons' ),
                                'left'           => false,
                                'right'          => false,
                                'subtitle'       => esc_html__( 'Set logo top and bottom margin.', 'exsit-addons' ),
                                'default'        => array(
                                    'units' => 'px',
                                ),
                            ),

                            array(
                                'id'       => 'exsit_text_title',
                                'type'     => 'text',
                                'validate' => 'html',
                                'title'    => esc_html__( 'Text Logo', 'exsit-addons' ),
                                'subtitle' => esc_html__( 'Write your logo text to use as logo (you can use <span> tag for styling).', 'exsit-addons' ),
                            ),

                        ),
                    ),

                ),
            ),

        ),
    ) );
}