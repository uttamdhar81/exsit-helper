<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( class_exists( 'CSF' ) ) {

    CSF::createSection( 'exsit_settings', array(
        'title' => esc_html__( 'Blog Setting', 'exsit-addons' ),
        'icon'  => 'fa fa-th',
        'id'    => 'exsit_blog_page_blogsetting',

        'fields' => array(
            array(
                'id'    => 'exsit_blog_setting',
                'type'  => 'tabbed',
                'title' => esc_html__( 'Blog', 'exsit-addons' ),

                'tabs' => array(

                    // Blog Page
                    array(
                        'title'  => esc_html__( 'Blog Page', 'exsit-addons' ),
                        'fields' => array(

                            array(
                                'id'       => 'exsit_blog_sidebar',
                                'type'     => 'image_select',
                                'title'    => esc_html__( 'Layout', 'exsit-addons' ),
                                'subtitle' => esc_html__( 'Choose blog layout.', 'exsit-addons' ),
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
                                    'blog_style_one' => esc_html__( 'Blog Style One', 'exsit-addons' ),
                                    'blog_style_two' => esc_html__( 'Blog Style Two', 'exsit-addons' ),
                                ),
                                'default' => 'blog_style_one',
                                'title'   => esc_html__( 'Blog Style', 'exsit-addons' ),
                            ),

                            array(
                                'id'       => 'exsit_blog_page_title_switcher',
                                'type'     => 'switcher',
                                'default'  => 1,
                                'on'       => esc_html__( 'Show', 'exsit-addons' ),
                                'off'      => esc_html__( 'Hide', 'exsit-addons' ),
                                'title'    => esc_html__( 'Blog Page Title', 'exsit-addons' ),
                                'subtitle' => esc_html__( 'Show or hide blog page title.', 'exsit-addons' ),
                            ),

                            array(
                                'id'       => 'exsit_blog_page_title_setting',
                                'type'     => 'button_set',
                                'title'    => esc_html__( 'Blog Page Title Setting', 'exsit-addons' ),
                                'options'  => array(
                                    'predefine' => esc_html__( 'Default', 'exsit-addons' ),
                                    'custom'    => esc_html__( 'Custom', 'exsit-addons' ),
                                ),
                                'default'    => 'predefine',
                                'dependency' => array( 'exsit_blog_page_title_switcher', '==', '1' ),
                            ),

                            array(
                                'id'         => 'exsit_blog_page_custom_title',
                                'type'       => 'text',
                                'title'      => esc_html__( 'Blog Custom Title', 'exsit-addons' ),
                                'subtitle'   => esc_html__( 'Set a custom blog page title.', 'exsit-addons' ),
                                'dependency' => array( 'exsit_blog_page_title_setting', '==', 'custom' ),
                            ),

                            array(
                                'id'            => 'exsit_blog_post_excerpt',
                                'type'          => 'slider',
                                'title'         => esc_html__( 'Blog Posts Excerpt', 'exsit-addons' ),
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
                                'title'   => esc_html__( 'Read More Text Setting', 'exsit-addons' ),
                                'options' => array(
                                    'default' => esc_html__( 'Default', 'exsit-addons' ),
                                    'custom'  => esc_html__( 'Custom', 'exsit-addons' ),
                                ),
                                'default' => 'default',
                            ),

                            array(
                                'id'         => 'exsit_blog_custom_readmore',
                                'type'       => 'text',
                                'title'      => esc_html__( 'Read More Text', 'exsit-addons' ),
                                'dependency' => array( 'exsit_blog_readmore_setting', '==', 'custom' ),
                            ),
                        ),
                    ),

                    // Single Page
                    array(
                        'title'  => esc_html__( 'Single Page', 'exsit-addons' ),
                        'fields' => array(

                            array(
                                'id'       => 'exsit_blog_single_sidebar',
                                'type'     => 'image_select',
                                'title'    => esc_html__( 'Layout', 'exsit-addons' ),
                                'subtitle' => esc_html__( 'Choose blog single page layout.', 'exsit-addons' ),
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
                                'title'   => esc_html__( 'Post Navigation', 'exsit-addons' ),
                                'on'      => esc_html__( 'Show', 'exsit-addons' ),
                                'off'     => esc_html__( 'Hide', 'exsit-addons' ),
                                'default' => 1,
                            ),

                            array(
                                'id'       => 'exsit_post_details_share_options',
                                'type'     => 'switcher',
                                'title'    => esc_html__( 'Share Options', 'exsit-addons' ),
                                'subtitle' => esc_html__( 'Show or hide post share options.', 'exsit-addons' ),
                                'on'       => esc_html__( 'Show', 'exsit-addons' ),
                                'off'      => esc_html__( 'Hide', 'exsit-addons' ),
                                'default'  => 1,
                            ),

                            array(
                                'id'      => 'exsit_post_details_related_post',
                                'type'    => 'switcher',
                                'title'   => esc_html__( 'Related Post', 'exsit-addons' ),
                                'on'      => esc_html__( 'Show', 'exsit-addons' ),
                                'off'     => esc_html__( 'Hide', 'exsit-addons' ),
                                'default' => false,
                            ),

                            array(
                                'id'      => 'exsit_post_details_author_desc_trigger',
                                'type'    => 'switcher',
                                'title'   => esc_html__( 'Author Description', 'exsit-addons' ),
                                'on'      => esc_html__( 'Show', 'exsit-addons' ),
                                'off'     => esc_html__( 'Hide', 'exsit-addons' ),
                                'default' => false,
                            ),
                        ),
                    ),

                    // Meta Data
                    array(
                        'title'  => esc_html__( 'Meta Data', 'exsit-addons' ),
                        'fields' => array(
                            array(
                                'id'      => 'exsit_display_post_date',
                                'type'    => 'switcher',
                                'title'   => esc_html__( 'Post Date', 'exsit-addons' ),
                                'default' => true,
                                'on'      => esc_html__( 'Enabled', 'exsit-addons' ),
                                'off'     => esc_html__( 'Disabled', 'exsit-addons' ),
                            ),
                            array(
                                'id'      => 'exsit_display_post_category',
                                'type'    => 'switcher',
                                'title'   => esc_html__( 'Category', 'exsit-addons' ),
                                'default' => true,
                                'on'      => esc_html__( 'Enabled', 'exsit-addons' ),
                                'off'     => esc_html__( 'Disabled', 'exsit-addons' ),
                            ),
                        ),
                    ),

                ),
            ),
        ),
    ) );
}