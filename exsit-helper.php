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

define( 'EXSIT_HELPER_PATH', plugin_dir_path( __FILE__ ) );
define( 'EXSIT_HELPER_URL', plugin_dir_url( __FILE__ ) );
define( 'EXSIT_HELPER_INC', EXSIT_HELPER_PATH . 'inc/' );

/**
 * LOAD FILES SAFELY
 */
add_action( 'after_setup_theme', function() {

	// Codestar
	if ( file_exists( EXSIT_HELPER_INC . 'codestar-framework/codestar-framework.php' ) ) {
		require_once EXSIT_HELPER_INC . 'codestar-framework/codestar-framework.php';
	}

	// Helper
	if ( file_exists( EXSIT_HELPER_INC . 'helper-function.php' ) ) {
		require_once EXSIT_HELPER_INC . 'helper-function.php';
	}

});

/**
 * Base Loader
 */
if ( file_exists( EXSIT_HELPER_PATH . 'base.php' ) ) {
	require_once EXSIT_HELPER_PATH . 'base.php';
	\Exsit\Base::instance();
}