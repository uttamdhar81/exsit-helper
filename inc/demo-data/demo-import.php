<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( );
}
/**
 * @Packge    : lonyo
 * @version   : 1.0
 * @Author    : Mthemeus
 * @Author URI: https://mthemeus.com/
 */
 
// demo import file
function lonyo_import_files() {

    return array(
        array(
            'import_file_name'             => esc_html__('Lonyo Demo','lonyo'),
            'import_file_url'            =>  get_lonyo_url()  . 'lonyo-demo.xml',
            'import_widget_file_url'     =>  get_lonyo_url()  . 'widgets.wie',
            'import_customizer_file_url' =>  get_lonyo_url()  . 'customizer.dat',
            'local_import_json'           => array(
                array(
                    'file_path'   =>  get_lonyo_url() . 'theme-options.json',
                    'option_name' => 'lonyo_settings',
                ),
            ),
        ),
    );
}
add_filter( 'pt-ocdi/import_files', 'lonyo_import_files' );

// demo import setup
function lonyo_after_import_setup() {
	// Assign menus to their locations.
	$main_menu   = get_term_by( 'name', 'Main Menu', 'nav_menu' );

	set_theme_mod( 'nav_menu_locations', array(
			'primary-menu'    => $main_menu->term_id,
			'mobile-menu'     =>  $main_menu ->term_id,
		)
	);

	// Assign front page and posts page (blog page).
	$front_page_id 	= get_page_by_title( 'Home 01' );
	$blog_page_id  	= get_page_by_title( 'Blog' );

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page_id->ID );
	update_option( 'page_for_posts', $blog_page_id->ID );

	// Define the old and new URLs
    $old_url = 'https://wp.framerpeak.com/lonyo'; // Replace with your old/static URL
    $new_url = esc_url( home_url( '/' ) ); // get current home url
    
    if (class_exists('\Elementor\Utils')) {
        \Elementor\Utils::replace_urls($old_url, $new_url);
    }

	// global data export
	global $wpdb;
    $active_kit_id = $wpdb->get_var(
        "SELECT ID 
         FROM {$wpdb->posts} 
         WHERE post_type = 'elementor_library' 
           AND post_status = 'publish' 
           AND post_title = 'Default Kit'
         ORDER BY ID DESC 
         LIMIT 1"
    );
    // Update the active kit option
    if ($active_kit_id) {
        update_option('elementor_active_kit', $active_kit_id);
    }

    $mas_addons_settings = [
        'heading'        => 'on',
        'button'         => 'on',
        'icon-box'       => 'on',
        'breadcrumb'     => 'on',
        'accordion'      => 'on',
        'price-table'    => 'on',
        'pricing-box'    => 'on',
        'progress-bar'   => 'on',
        'modal-popup'    => 'on',
        'count-down'     => 'on',
        'testimonial'    => 'on',
        'blog'           => 'on',
        'tabs'           => 'on',
        'tab-builder'    => 'on',
        'fun-factor'     => 'on',
        'list-icon'      => 'on',
        'team-member'    => 'on',
        'content-swither'=> 'on',
        'social-icons'   => 'on',
        'marque-slider'  => 'on',
        'timeline'       => 'on',
        'mega-menu'      => 'on',
        'off-canvas'     => 'on',
        'signin'         => 'on',
        'signup'         => 'on',
        'resetpassword'  => 'on',
        'contact-form'   => 'on',
    ];

    $mas_features = [
        "sticky-header" => "on",
        "elementor-animejs" => "on",
        "custom-css" => "on",
        "custom-position" => "on",
        "wrapper-link" => "on",
        "mas-icon" => "on",
        "icons-manager" => "on",
        "section-sticky" => "on",
    ];
    
    $mas_dynamic = [
        "feature-image" => "on",
        "post-navigation" => "on",
        "archive-posts" => "on",
        "archive-title" => "on",
        "author-meta" => "on",
        "post-title" => "on",
        "site-title" => "on",
        "site-tagline" => "on",
        "post-excerpt" => "on",
        "post-content" => "on",
        "post-comments" => "on",
        "page-title" => "on",
    ];

    if ( $mas_addons_settings ) {
        update_option('mas_widgets', $mas_addons_settings);
    }

    if( $mas_features ){
        update_option('mas_features', $mas_features);
    }

    if( $mas_dynamic ){
        update_option('mas_dynamic', $mas_dynamic);
    }

    update_option( 'permalink_structure', '/%postname%/' );

    
}
add_action( 'pt-ocdi/after_import', 'lonyo_after_import_setup' );


//disable the branding notice after successful demo import
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

//change the location, title and other parameters of the plugin page
function lonyo_import_plugin_page_setup( $default_settings ) {
	$default_settings['parent_slug'] = 'themes.php';
	$default_settings['page_title']  = esc_html__( 'Lonyo Demo Import' , 'lonyo' );
	$default_settings['menu_title']  = esc_html__( 'Import Demo Data' , 'lonyo' );
	$default_settings['capability']  = 'import';
	$default_settings['menu_slug']   = 'lonyo-demo-import';

	return $default_settings;
}
add_filter( 'pt-ocdi/plugin_page_setup', 'lonyo_import_plugin_page_setup' );
 
// Enqueue scripts
function lonyo_demo_import_custom_scripts(){
	if( isset( $_GET['page'] ) && $_GET['page'] == 'lonyo-demo-import' ){
		// style
		wp_enqueue_style( 'lonyo-demo-import', LONYO_DEMO_DIR_URI.'css/lonyo.demo.import.css', array(), '1.0', false );
	}
}
add_action( 'admin_enqueue_scripts', 'lonyo_demo_import_custom_scripts' );

