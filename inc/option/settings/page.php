<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( class_exists( 'CSF' ) ) {

    CSF::createSection( 'exsit_settings', array(

        'title' => esc_html__( 'Page', 'exsit-addons' ),
        'id'    => 'exsit_page_page',
        'icon'  => 'fa fa-file',

        'fields' => array(

            array(
                'id'       => 'exsit_page_sidebar',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Select Layout', 'exsit-addons' ),
                'subtitle' => esc_html__( 'Choose your page layout (no sidebar / left sidebar / right sidebar).', 'exsit-addons' ),
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
                'title'      => esc_html__( 'Sidebar Settings', 'exsit-addons' ),
                'subtitle'   => esc_html__( 'Choose which sidebar to display when a sidebar layout is selected.', 'exsit-addons' ),
                'options'    => array(
                    '1' => esc_html__( 'Page Sidebar', 'exsit-addons' ),
                    '2' => esc_html__( 'Blog Sidebar', 'exsit-addons' ),
                ),
                'default'    => '1',
                'dependency' => array( 'exsit_page_sidebar', '!=', '1' ),
            ),

            array(
                'id'       => 'exsit_page_title_switcher',
                'type'     => 'switcher',
                'title'    => esc_html__( 'Page Title', 'exsit-addons' ),
                'subtitle' => esc_html__( 'Show or hide page title.', 'exsit-addons' ),
                'default'  => true,
                'on'       => esc_html__( 'Enabled', 'exsit-addons' ),
                'off'      => esc_html__( 'Disabled', 'exsit-addons' ),
            ),

            array(
                'id'         => 'exsit_page_title_tag',
                'type'       => 'select',
                'options'    => array(
                    'h1' => esc_html__( 'H1', 'exsit-addons' ),
                    'h2' => esc_html__( 'H2', 'exsit-addons' ),
                    'h3' => esc_html__( 'H3', 'exsit-addons' ),
                    'h4' => esc_html__( 'H4', 'exsit-addons' ),
                    'h5' => esc_html__( 'H5', 'exsit-addons' ),
                    'h6' => esc_html__( 'H6', 'exsit-addons' ),
                ),
                'default'    => 'h1',
                'title'      => esc_html__( 'Title Tag', 'exsit-addons' ),
                'subtitle'   => esc_html__( 'Select page title tag (H1–H6).', 'exsit-addons' ),
                'dependency' => array( 'exsit_page_title_switcher', '==', true ),
            ),

            array(
                'id'           => 'exsit_breadcrumb_image',
                'type'         => 'upload',
                'title'        => esc_html__( 'Breadcrumb Image', 'exsit-addons' ),
                'library'      => 'image',
                'button_title' => esc_html__( 'Add Image', 'exsit-addons' ),
                'remove_title' => esc_html__( 'Remove Image', 'exsit-addons' ),
                'preview'      => true,
            ),

            array(
                'id'       => 'exsit_enable_breadcrumb',
                'type'     => 'switcher',
                'title'    => esc_html__( 'Breadcrumb', 'exsit-addons' ),
                'subtitle' => esc_html__( 'Show or hide breadcrumb on pages and posts.', 'exsit-addons' ),
                'default'  => true,
                'on'       => esc_html__( 'Show', 'exsit-addons' ),
                'off'      => esc_html__( 'Hide', 'exsit-addons' ),
            ),

        ),

    ) );
}