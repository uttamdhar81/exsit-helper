<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( class_exists( 'CSF' ) ) {

    CSF::createSection( 'exsit_settings', array(

        'title' => esc_html__( 'Page', 'exsit-helper' ),
        'id'    => 'exsit_page_page',
        'icon'  => 'fa fa-file',

        'fields' => array(

            array(
                'id'       => 'exsit_page_sidebar',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Select Layout', 'exsit-helper' ),
                'subtitle' => esc_html__( 'Choose your page layout (no sidebar / left sidebar / right sidebar).', 'exsit-helper' ),
                'options'  => array(
                    '1' => EXSIT_HELPER_URL . 'assets/image/no-sidebar.png',
                    '2' => EXSIT_HELPER_URL . 'assets/image/left-sidebar.png',
                    '3' => EXSIT_HELPER_URL . 'assets/image/right-sidebar.png',
                ),
                'default'  => '3',
            ),

            array(
                'id'         => 'exsit_page_layoutopt',
                'type'       => 'button_set',
                'title'      => esc_html__( 'Sidebar Settings', 'exsit-helper' ),
                'subtitle'   => esc_html__( 'Choose which sidebar to display when a sidebar layout is selected.', 'exsit-helper' ),
                'options'    => array(
                    '1' => esc_html__( 'Page Sidebar', 'exsit-helper' ),
                    '2' => esc_html__( 'Blog Sidebar', 'exsit-helper' ),
                ),
                'default'    => '1',
                'dependency' => array( 'exsit_page_sidebar', '!=', '1' ),
            ),

            array(
                'id'       => 'exsit_page_title_switcher',
                'type'     => 'switcher',
                'title'    => esc_html__( 'Page Title', 'exsit-helper' ),
                'subtitle' => esc_html__( 'Show or hide page title.', 'exsit-helper' ),
                'default'  => true,
                'on'       => esc_html__( 'Enabled', 'exsit-helper' ),
                'off'      => esc_html__( 'Disabled', 'exsit-helper' ),
            ),

            array(
                'id'         => 'exsit_page_title_tag',
                'type'       => 'select',
                'options'    => array(
                    'h1' => esc_html__( 'H1', 'exsit-helper' ),
                    'h2' => esc_html__( 'H2', 'exsit-helper' ),
                    'h3' => esc_html__( 'H3', 'exsit-helper' ),
                    'h4' => esc_html__( 'H4', 'exsit-helper' ),
                    'h5' => esc_html__( 'H5', 'exsit-helper' ),
                    'h6' => esc_html__( 'H6', 'exsit-helper' ),
                ),
                'default'    => 'h1',
                'title'      => esc_html__( 'Title Tag', 'exsit-helper' ),
                'subtitle'   => esc_html__( 'Select page title tag (H1–H6).', 'exsit-helper' ),
                'dependency' => array( 'exsit_page_title_switcher', '==', true ),
            ),

            array(
                'id'           => 'exsit_breadcrumb_image',
                'type'         => 'upload',
                'title'        => esc_html__( 'Breadcrumb Image', 'exsit-helper' ),
                'library'      => 'image',
                'button_title' => esc_html__( 'Add Image', 'exsit-helper' ),
                'remove_title' => esc_html__( 'Remove Image', 'exsit-helper' ),
                'preview'      => true,
            ),

            array(
                'id'       => 'exsit_enable_breadcrumb',
                'type'     => 'switcher',
                'title'    => esc_html__( 'Breadcrumb', 'exsit-helper' ),
                'subtitle' => esc_html__( 'Show or hide breadcrumb on pages and posts.', 'exsit-helper' ),
                'default'  => true,
                'on'       => esc_html__( 'Show', 'exsit-helper' ),
                'off'      => esc_html__( 'Hide', 'exsit-helper' ),
            ),

        ),

    ) );
}