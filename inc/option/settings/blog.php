<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( class_exists( 'CSF' ) ) {

    CSF::createSection( 'exsit_settings', array(
        'title' => esc_html__( 'Blog Setting', 'exsit-helper' ),
        'icon'  => 'fa fa-th',
        'id'    => 'exsit_blog_page_blogsetting',

        'fields' => array(
            array(
                'id'    => 'exsit_blog_setting',
                'type'  => 'tabbed',
                'title' => esc_html__( 'Blog', 'exsit-helper' ),

                'tabs' => array(

                    // Blog Page
                    array(
                        'title'  => esc_html__( 'Blog Page', 'exsit-helper' ),
                        'fields' => array(

                            array(
                                'id'       => 'exsit_blog_sidebar',
                                'type'     => 'image_select',
                                'title'    => esc_html__( 'Layout', 'exsit-helper' ),
                                'subtitle' => esc_html__( 'Choose blog layout.', 'exsit-helper' ),
                                'options'  => array(
                                    '1' => EXSIT_HELPER_URL . 'assets/image/no-sidebar.png',
                                    '2' => EXSIT_HELPER_URL . 'assets/image/left-sidebar.png',
                                    '3' => EXSIT_HELPER_URL . 'assets/image/right-sidebar.png',
                                ),
                                'default'  => '3',
                            ),
                            

                            array(
                                'id'      => 'exsit_blog_style',
                                'type'    => 'select',
                                'options' => array(
                                    'blog_style_one' => esc_html__( 'Blog Style One', 'exsit-helper' ),
                                    'blog_style_two' => esc_html__( 'Blog Style Two', 'exsit-helper' ),
                                ),
                                'default' => 'blog_style_one',
                                'title'   => esc_html__( 'Blog Style', 'exsit-helper' ),
                            ),

                            array(
                                'id'       => 'exsit_blog_page_title_switcher',
                                'type'     => 'switcher',
                                'default'  => 1,
                                'on'       => esc_html__( 'Show', 'exsit-helper' ),
                                'off'      => esc_html__( 'Hide', 'exsit-helper' ),
                                'title'    => esc_html__( 'Blog Page Title', 'exsit-helper' ),
                                'subtitle' => esc_html__( 'Show or hide blog page title.', 'exsit-helper' ),
                            ),

                            array(
                                'id'       => 'exsit_blog_page_title_setting',
                                'type'     => 'button_set',
                                'title'    => esc_html__( 'Blog Page Title Setting', 'exsit-helper' ),
                                'options'  => array(
                                    'predefine' => esc_html__( 'Default', 'exsit-helper' ),
                                    'custom'    => esc_html__( 'Custom', 'exsit-helper' ),
                                ),
                                'default'    => 'predefine',
                                'dependency' => array( 'exsit_blog_page_title_switcher', '==', '1' ),
                            ),

                            array(
                                'id'         => 'exsit_blog_page_custom_title',
                                'type'       => 'text',
                                'title'      => esc_html__( 'Blog Custom Title', 'exsit-helper' ),
                                'subtitle'   => esc_html__( 'Set a custom blog page title.', 'exsit-helper' ),
                                'dependency' => array( 'exsit_blog_page_title_setting', '==', 'custom' ),
                            ),

                            array(
                                'id'            => 'exsit_blog_post_excerpt',
                                'type'          => 'slider',
                                'title'         => esc_html__( 'Blog Posts Excerpt', 'exsit-helper' ),
                                'default'       => 24,
                                'min'           => 0,
                                'step'          => 1,
                                'max'           => 100,
                                'resolution'    => 1,
                                'display_value' => 'text',
                            ),

                            array(
                                'id'      => 'exsit_blog_readmore_setting',
                                'type'    => 'button_set',
                                'title'   => esc_html__( 'Read More Text Setting', 'exsit-helper' ),
                                'options' => array(
                                    'default' => esc_html__( 'Default', 'exsit-helper' ),
                                    'custom'  => esc_html__( 'Custom', 'exsit-helper' ),
                                ),
                                'default' => 'default',
                            ),

                            array(
                                'id'         => 'exsit_blog_custom_readmore',
                                'type'       => 'text',
                                'title'      => esc_html__( 'Read More Text', 'exsit-helper' ),
                                'dependency' => array( 'exsit_blog_readmore_setting', '==', 'custom' ),
                            ),
                        ),
                    ),

                    // Single Page
                    array(
                        'title'  => esc_html__( 'Single Page', 'exsit-helper' ),
                        'fields' => array(

                            array(
                                'id'       => 'exsit_blog_single_sidebar',
                                'type'     => 'image_select',
                                'title'    => esc_html__( 'Layout', 'exsit-helper' ),
                                'subtitle' => esc_html__( 'Choose blog single page layout.', 'exsit-helper' ),
                                'options'  => array(
                                    '1' => EXSIT_HELPER_URL . 'assets/image/no-sidebar.png',
                                    '2' => EXSIT_HELPER_URL . 'assets/image/left-sidebar.png',
                                    '3' => EXSIT_HELPER_URL . 'assets/image/right-sidebar.png',
                                ),
                                'default'  => '3',
                            ),

                            array(
                                'id'      => 'exsit_post_details_post_navigation',
                                'type'    => 'switcher',
                                'title'   => esc_html__( 'Post Navigation', 'exsit-helper' ),
                                'on'      => esc_html__( 'Show', 'exsit-helper' ),
                                'off'     => esc_html__( 'Hide', 'exsit-helper' ),
                                'default' => 1,
                            ),

                            array(
                                'id'       => 'exsit_post_details_share_options',
                                'type'     => 'switcher',
                                'title'    => esc_html__( 'Share Options', 'exsit-helper' ),
                                'subtitle' => esc_html__( 'Show or hide post share options.', 'exsit-helper' ),
                                'on'       => esc_html__( 'Show', 'exsit-helper' ),
                                'off'      => esc_html__( 'Hide', 'exsit-helper' ),
                                'default'  => 1,
                            ),

                            array(
                                'id'      => 'exsit_post_details_related_post',
                                'type'    => 'switcher',
                                'title'   => esc_html__( 'Related Post', 'exsit-helper' ),
                                'on'      => esc_html__( 'Show', 'exsit-helper' ),
                                'off'     => esc_html__( 'Hide', 'exsit-helper' ),
                                'default' => false,
                            ),

                            array(
                                'id'      => 'exsit_post_details_author_desc_trigger',
                                'type'    => 'switcher',
                                'title'   => esc_html__( 'Author Description', 'exsit-helper' ),
                                'on'      => esc_html__( 'Show', 'exsit-helper' ),
                                'off'     => esc_html__( 'Hide', 'exsit-helper' ),
                                'default' => false,
                            ),
                        ),
                    ),

                    // Meta Data
                    array(
                        'title'  => esc_html__( 'Meta Data', 'exsit-helper' ),
                        'fields' => array(
                            array(
                                'id'      => 'exsit_display_post_date',
                                'type'    => 'switcher',
                                'title'   => esc_html__( 'Post Date', 'exsit-helper' ),
                                'default' => true,
                                'on'      => esc_html__( 'Enabled', 'exsit-helper' ),
                                'off'     => esc_html__( 'Disabled', 'exsit-helper' ),
                            ),
                            array(
                                'id'      => 'exsit_display_post_category',
                                'type'    => 'switcher',
                                'title'   => esc_html__( 'Category', 'exsit-helper' ),
                                'default' => true,
                                'on'      => esc_html__( 'Enabled', 'exsit-helper' ),
                                'off'     => esc_html__( 'Disabled', 'exsit-helper' ),
                            ),
                        ),
                    ),

                ),
            ),
        ),
    ) );
}