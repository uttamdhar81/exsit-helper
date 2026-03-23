<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( class_exists( 'CSF' ) ) {

    CSF::createSection( 'exsit_settings', array(
        'title' => esc_html__( 'Custom Code', 'exsit-addons' ),
        'icon'  => 'fa fa-code',

        'fields' => array(

            array(
                'id'    => 'exsit_custom_code_tab',
                'type'  => 'tabbed',
                'title' => esc_html__( 'Custom Code', 'exsit-addons' ),
                'tabs'  => array(

                    array(
                        'title'  => esc_html__( 'CSS', 'exsit-addons' ),
                        'fields' => array(
                            array(
                                'id'       => 'exsit_css_editor',
                                'type'     => 'code_editor',
                                'settings' => array(
                                    'theme' => 'mbo',
                                    'mode'  => 'css',
                                ),
                                'default'  => '',
                            ),
                        ),
                    ),

                    array(
                        'title'  => esc_html__( 'JS', 'exsit-addons' ),
                        'fields' => array(
                            array(
                                'id'       => 'exsit_js_editor',
                                'type'     => 'code_editor',
                                'settings' => array(
                                    'theme' => 'monokai',
                                    'mode'  => 'javascript',
                                ),
                                'default'  => '',
                            ),
                        ),
                    ),

                ),
            ),

        ),
    ) );
}