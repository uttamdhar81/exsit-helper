<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( );
}

function exsit_import_files() {

    return array(
        array(
            'import_file_name' => esc_html__('Exsit Demo', 'exsit-helper'),
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
add_filter( 'pt-ocdi/import_files', 'exsit_import_files' );

// demo import setup
function exsit_after_import_setup() {

    // ✅ Assign Menu
    $main_menu = get_term_by( 'slug', 'primary', 'nav_menu' );

    if ( $main_menu && ! is_wp_error( $main_menu ) ) {
        $locations = get_theme_mod( 'nav_menu_locations', array() );

        $locations['primary-menu'] = $main_menu->term_id;
        $locations['mobile-menu']  = $main_menu->term_id;

        set_theme_mod( 'nav_menu_locations', $locations );
    }

    // ✅ Assign Front Page
    $front_page = get_page_by_path( 'tech-agency' );

    if ( $front_page && ! is_wp_error( $front_page ) ) {
        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $front_page->ID );
    }

    // Define the old and new URLs
    $old_url = 'https://uicobe.com/theme/exsit'; // Replace with your old/static URL
    $new_url = esc_url( home_url( '/' ) ); // get current home url
    
    if (class_exists('\Elementor\Utils')) {
        \Elementor\Utils::replace_urls($old_url, $new_url);
    }

    // ✅ Permalinks
    update_option( 'permalink_structure', '/%postname%/' );
    flush_rewrite_rules();

    add_action( 'shutdown', function() {

        if ( class_exists( '\Elementor\Plugin' ) ) {

            // Clear CSS & regenerate
            \Elementor\Plugin::$instance->files_manager->clear_cache();

            // Sync templates
            \Elementor\Plugin::$instance->templates_manager
                ->get_source( 'local' )
                ->sync_items();
        }

    });

}

add_action( 'pt-ocdi/after_import', 'exsit_after_import_setup' );