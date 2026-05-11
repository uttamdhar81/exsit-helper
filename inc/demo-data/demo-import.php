<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit();
}

/**
 * Demo Import Files
 */
function exsit_import_files() {

    return array(
        array(
            'import_file_name'  => esc_html__( 'Exsit Demo', 'exsit-helper' ),
            'local_import_file' => EXSIT_HELPER_INC . '/demo-data/exsit-demo.xml',

            'local_import_json' => array(
                array(
                    'file_path'   => EXSIT_HELPER_INC . '/demo-data/theme-settings.json',
                    'option_name' => 'exsit_settings',
                ),
            ),
        ),
    );
}
add_filter( 'ocdi/import_files', 'exsit_import_files' );


/**
 * After Import Setup
 */
function exsit_after_import_setup() {

    /**
     * Assign Menu
     */
    $main_menu = get_term_by( 'slug', 'primary', 'nav_menu' );

    if ( $main_menu && ! is_wp_error( $main_menu ) ) {

        $locations = get_theme_mod( 'nav_menu_locations', array() );

        $locations['primary-menu'] = $main_menu->term_id;
        $locations['mobile-menu']  = $main_menu->term_id;

        set_theme_mod( 'nav_menu_locations', $locations );
    }


    /**
     * Assign Front Page
     */
    $front_page = get_page_by_path( 'tech-agency' );

    if ( $front_page && ! is_wp_error( $front_page ) ) {

        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $front_page->ID );
    }


    /**
     * Replace Elementor URLs
     */
    $old_url = 'https://uicobe.com/theme/exsit';
    $new_url = esc_url( home_url( '/' ) );

    if ( class_exists( '\Elementor\Utils' ) ) {
        \Elementor\Utils::replace_urls( $old_url, $new_url );
    }


    /**
     * Elementor Settings
     */
    if ( class_exists( '\Elementor\Plugin' ) ) {

        // Enable Elementor support for pages/posts if missing
        $elementor_cpt_support = get_option( 'elementor_cpt_support', array() );

        if ( empty( $elementor_cpt_support ) ) {

            update_option(
                'elementor_cpt_support',
                array( 'page', 'post' )
            );
        }

        // Clear Elementor cache
        \Elementor\Plugin::$instance->files_manager->clear_cache();
    }


    /**
     * Permalinks
     */
    update_option( 'permalink_structure', '/%postname%/' );
    flush_rewrite_rules();
}

add_action( 'ocdi/after_import', 'exsit_after_import_setup' );