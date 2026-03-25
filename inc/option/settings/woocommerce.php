<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( class_exists( 'CSF' ) ) {

    CSF::createSection( 'exsit_settings', array(

        'title' => esc_html__( 'WooCommerce Page', 'exsit-helper' ),
        'id'    => 'exsit_woo_page_settings',
        'icon'  => 'fa fa-shopping-cart',

        'fields' => array(
            array(
                'id'    => 'exsit_wc_settings',
                'type'  => 'tabbed',
                'title' => esc_html__( 'WooCommerce Settings', 'exsit-helper' ),

                'tabs' => array(

                    // Shop Page
                    array(
                        'title'  => esc_html__( 'Shop Page', 'exsit-helper' ),
                        'fields' => array(

                            array(
                                'title'    => esc_html__( 'Shop Page Background', 'exsit-helper' ),
                                'subtitle' => esc_html__( 'Add your shop page background image.', 'exsit-helper' ),
                                'id'       => 'exsit_shop_bg',
                                'type'     => 'media',
                            ),

                            array(
                                'id'       => 'exsit_woo_shoppage_sidebar',
                                'title'    => esc_html__( 'Shop Page Sidebar', 'exsit-helper' ),
                                'subtitle' => esc_html__( 'Choose shop page sidebar layout.', 'exsit-helper' ),
                                'type'     => 'image_select',
                                'options'  => array(
                                    '1' => EXSIT_HELPER_URL . 'assets/image/no-sidebar.png',
                                    '2' => EXSIT_HELPER_URL . 'assets/image/left-sidebar.png',
                                    '3' => EXSIT_HELPER_URL . 'assets/image/right-sidebar.png',
                                ),
                                'default'  => '3',
                            ),

                            array(
                                'id'       => 'exsit_woo_product_col',
                                'type'     => 'image_select',
                                'title'    => esc_html__( 'Product Column', 'exsit-helper' ),
                                'subtitle' => esc_html__( 'Set product columns for shop page.', 'exsit-helper' ),
                                'options'  => array(
                                    '2' => EXSIT_HELPER_URL . 'assets/image/2col.png',
                                    '3' => EXSIT_HELPER_URL . 'assets/image/3col.png',
                                    '4' => EXSIT_HELPER_URL . 'assets/image/4col.png',
                                    '6' => EXSIT_HELPER_URL . 'assets/image/6col.png',
                                ),
                                'default'  => '4',
                            ),

                            array(
                                'id'      => 'exsit_woo_product_perpage',
                                'type'    => 'text',
                                'title'   => esc_html__( 'Products Per Page', 'exsit-helper' ),
                                'default' => '10',
                            ),

                        ),
                    ),

                    // Single Product Page
                    array(
                        'title'  => esc_html__( 'Single Product Page', 'exsit-helper' ),
                        'fields' => array(

                            array(
                                'id'       => 'exsit_woo_singlepage_sidebar',
                                'type'     => 'image_select',
                                'title'    => esc_html__( 'Product Single Page Sidebar', 'exsit-helper' ),
                                'subtitle' => esc_html__( 'Choose single product page sidebar layout.', 'exsit-helper' ),
                                'options'  => array(
                                    '1' => EXSIT_HELPER_URL . 'assets/image/no-sidebar.png',
                                    '2' => EXSIT_HELPER_URL . 'assets/image/left-sidebar.png',
                                    '3' => EXSIT_HELPER_URL . 'assets/image/right-sidebar.png',
                                ),
                                'default'  => '1',
                            ),

                            array(
                                'id'      => 'exsit_product_details_title_position',
                                'type'    => 'button_set',
                                'default' => 'header',
                                'options' => array(
                                    'header' => esc_html__( 'On Header', 'exsit-helper' ),
                                    'below'  => esc_html__( 'Below Thumbnail', 'exsit-helper' ),
                                ),
                                'title'    => esc_html__( 'Product Title Position', 'exsit-helper' ),
                                'subtitle' => esc_html__( 'Control product details title position.', 'exsit-helper' ),
                            ),

                            array(
                                'id'         => 'exsit_product_details_custom_title',
                                'type'       => 'text',
                                'title'      => esc_html__( 'Product Details Title', 'exsit-helper' ),
                                'default'    => esc_html__( 'Shop Details', 'exsit-helper' ),
                                'dependency' => array( 'exsit_product_details_title_position', '==', 'below' ),
                            ),

                            array(
                                'id'      => 'exsit_woo_stock_quantity_show_hide',
                                'type'    => 'switcher',
                                'title'   => esc_html__( 'Stock Quantity Show/Hide', 'exsit-helper' ),
                                'default' => true,
                                'on'      => esc_html__( 'Show', 'exsit-helper' ),
                                'off'     => esc_html__( 'Hide', 'exsit-helper' ),
                            ),

                            array(
                                'id'      => 'exsit_woo_relproduct_display',
                                'type'    => 'switcher',
                                'title'   => esc_html__( 'Related Products', 'exsit-helper' ),
                                'default' => true,
                                'on'      => esc_html__( 'Show', 'exsit-helper' ),
                                'off'     => esc_html__( 'Hide', 'exsit-helper' ),
                            ),

                            array(
                                'id'         => 'exsit_woo_relproduct_num',
                                'type'       => 'text',
                                'title'      => esc_html__( 'Related Products Number', 'exsit-helper' ),
                                'default'    => 4,
                                'dependency' => array( 'exsit_woo_relproduct_display', '==', true ),
                            ),

                            array(
                                'id'         => 'exsit_woo_related_product_col',
                                'type'       => 'image_select',
                                'title'      => esc_html__( 'Related Product Columns', 'exsit-helper' ),
                                'dependency' => array( 'exsit_woo_relproduct_display', '==', true ),
                                'options'    => array(
                                    '2' => EXSIT_HELPER_URL . 'assets/image/2col.png',
                                    '3' => EXSIT_HELPER_URL . 'assets/image/3col.png',
                                    '4' => EXSIT_HELPER_URL . 'assets/image/4col.png',
                                    '6' => EXSIT_HELPER_URL . 'assets/image/6col.png',
                                ),
                                'default' => '3',
                            ),

                            array(
                                'id'      => 'exsit_woo_upsellproduct_display',
                                'type'    => 'switcher',
                                'title'   => esc_html__( 'Upsell Products', 'exsit-helper' ),
                                'default' => true,
                                'on'      => esc_html__( 'Show', 'exsit-helper' ),
                                'off'     => esc_html__( 'Hide', 'exsit-helper' ),
                            ),

                            array(
                                'id'         => 'exsit_woo_upsellproduct_num',
                                'type'       => 'text',
                                'title'      => esc_html__( 'Upsell Products Number', 'exsit-helper' ),
                                'default'    => 3,
                                'dependency' => array( 'exsit_woo_upsellproduct_display', '==', true ),
                            ),

                            array(
                                'id'      => 'exsit_woo_crosssellproduct_display',
                                'type'    => 'switcher',
                                'title'   => esc_html__( 'Cross-sell Products', 'exsit-helper' ),
                                'default' => true,
                                'on'      => esc_html__( 'Show', 'exsit-helper' ),
                                'off'     => esc_html__( 'Hide', 'exsit-helper' ),
                            ),

                            array(
                                'id'         => 'exsit_woo_crosssellproduct_num',
                                'type'       => 'text',
                                'title'      => esc_html__( 'Cross-sell Products Number', 'exsit-helper' ),
                                'default'    => 3,
                                'dependency' => array( 'exsit_woo_crosssellproduct_display', '==', true ),
                            ),

                        ),
                    ),

                ),
            ),
        ),
    ) );
}