<?php
namespace Exsit;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

final class Base {

    private static $instance = null;

    public static function instance() {
        if ( self::$instance === null ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        add_action( 'plugins_loaded', [ $this, 'init' ] );
        add_action( 'admin_menu', [ $this, 'register_theme_admin_menu' ] );
    }

    /**
     * Init plugin
     */
    public function init() {

        // Load textdomain
        load_plugin_textdomain( 'exsit-addons', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

        // Load Codestar Framework
        if ( defined( 'EXSIT_HELPER_INC' ) && file_exists( EXSIT_HELPER_INC . 'codestar-framework/codestar-framework.php' ) ) {
            require_once EXSIT_HELPER_INC . 'codestar-framework/codestar-framework.php';
        }

        // Load Theme Settings
        if ( defined( 'EXSIT_HELPER_INC' ) && file_exists( EXSIT_HELPER_INC . 'option/settings-init.php' ) ) {
            require_once EXSIT_HELPER_INC . 'option/settings-init.php';
        }
    }

    /**
     * Register parent menu for Theme Settings (optional)
     */
    public function register_theme_admin_menu() {
        add_menu_page(
            esc_html__( 'Exsit Theme', 'exsit-addons' ),
            esc_html__( 'Exsit Theme', 'exsit-addons' ),
            'manage_options',
            'exsit-theme-parent',
            [ $this, 'render_dashboard' ],
            'dashicons-dashboard', 
            30
        );
    }

    public function render_dashboard() {
        echo '<div class="wrap"><h1>' . esc_html__( 'Welcome to Exsit Theme', 'exsit-addons' ) . '</h1></div>';
    }
}