<?php
/*
 * Plugin Name:       Exsit Helper
 * Description:       Helper plugin for Exsit theme (Theme Settings & Demo Import).
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Uicobe
 * Author URI:        https://uicobe.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       exsit-addons
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Constants
define( 'EXSIT_HELPER_PATH', plugin_dir_path( __FILE__ ) );
define( 'EXSIT_HELPER_URL', plugin_dir_url( __FILE__ ) );
define( 'EXSIT_HELPER_INC', plugin_dir_path( __FILE__ ) . 'inc/' );

// Load Codestar Framework
if ( file_exists( EXSIT_HELPER_INC . 'codestar-framework/codestar-framework.php' ) ) {
    require_once EXSIT_HELPER_INC . 'codestar-framework/codestar-framework.php';
}

// Load helper functions
if ( file_exists( EXSIT_HELPER_INC . 'helper-function.php' ) ) {
    require_once EXSIT_HELPER_INC . 'helper-function.php';
}

// Load Base Class
if ( file_exists( EXSIT_HELPER_PATH . 'base.php' ) ) {
    require_once EXSIT_HELPER_PATH . 'base.php';
    \Exsit\Base::instance();
}

// Load Theme Settings Init (creates Theme Settings menu)
if ( file_exists( EXSIT_HELPER_INC . 'option/settings-init.php' ) ) {
    require_once EXSIT_HELPER_INC . 'option/settings-init.php';
}

// Load Settings Sections
$settings_files = array(
    'preloader.php',
    'logo.php',
    'header.php',
    'footer.php',
    'blog.php',
    'page.php',
    '404page.php',
    'woocommerce.php',
    'customcss.php',
    'backup.php',
);

foreach ( $settings_files as $file ) {
    $path = EXSIT_HELPER_INC . 'option/settings/' . $file;
    if ( file_exists( $path ) ) {
        require_once $path;
    }
}

// Demo Import (optional)
if ( file_exists( EXSIT_HELPER_INC . 'demo-data/demo-import.php' ) ) {
    require_once EXSIT_HELPER_INC . 'demo-data/demo-import.php';
}