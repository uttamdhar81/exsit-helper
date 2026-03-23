<?php
namespace Exsit;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

final class Base {

    private static $_instance = null;

    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct() {

        add_action( 'after_setup_theme', [ $this, 'load_settings' ] );
        add_action( 'init', [ $this, 'load_textdomain' ] );
        add_action( 'plugins_loaded', [ $this, 'init' ] );
        add_action( 'admin_menu', [ $this, 'register_theme_admin_menu' ] );
    }

    public function init() {

        if ( ! did_action( 'elementor/loaded' ) ) {
            add_action( 'admin_notices', [ $this, 'elementor_missing_notice' ] );
            return;
        }

        // Elementor hooks
        add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );
        add_action( 'elementor/elements/categories_registered', [ $this, 'register_widget_category' ] );

        // ✅ SAFE: register scripts ONLY on frontend
        add_action( 'wp_enqueue_scripts', [ $this, 'register_assets' ] );
    }

    /**
     * SAFE asset registration (NO localization here)
     */
    public function register_assets() {

        if ( is_admin() ) {
            return;
        }

        // Helper JS
        wp_register_script(
            'exsit-helper',
            EXSIT_HELPER_URL . 'assets/js/helper.js',
            [ 'jquery' ],
            '1.0.0',
            true
        );

        // Slick JS
        wp_register_script(
            'exsit-slick',
            EXSIT_HELPER_URL . 'assets/js/slick.min.js',
            [ 'jquery' ],
            '1.8.1',
            true
        );

        // Slick CSS
        wp_register_style(
            'exsit-slick-css',
            EXSIT_HELPER_URL . 'assets/css/slick.css',
            [],
            '1.8.1'
        );

        wp_register_style(
            'exsit-slick-theme',
            EXSIT_HELPER_URL . 'assets/css/slick-theme.css',
            [ 'exsit-slick-css' ],
            '1.8.1'
        );
    }

    public function register_widgets( $widgets_manager ) {

        $widgets = [
            'team-member.php'  => 'Exsit_Team_Member_Widget',
            'pricing-card.php' => 'Exsit_Pricing_Card_Widget',
            'badge.php'        => 'Exsit_Badge_Widget',
            'counter.php'      => 'Exsit_Counter_Widget',
            'blog-card.php'    => 'Exsit_Blog_Card_Widget',
            'slick-slider.php' => 'Exsit_Slick_Slider',
        ];

        foreach ( $widgets as $file => $class ) {

            $path = EXSIT_HELPER_PATH . 'widgets/' . $file;

            if ( file_exists( $path ) ) {

                require_once $path;

                if ( class_exists( $class ) ) {
                    $widgets_manager->register( new $class() );
                }
            }
        }
    }

    public function register_widget_category( $elements_manager ) {

        $elements_manager->add_category(
            'exsit-addons',
            [
                'title' => esc_html__( 'Exsit Addons', 'exsit-addons' ),
                'icon'  => 'fa fa-plug',
            ]
        );
    }

    public function load_settings() {

        if ( file_exists( EXSIT_HELPER_INC . 'option/settings-init.php' ) ) {
            require_once EXSIT_HELPER_INC . 'option/settings-init.php';
        }

        $settings_files = [
            'preloader.php', 'logo.php', 'header.php', 'footer.php',
            'blog.php', 'page.php', '404page.php',
            'woocommerce.php', 'customcss.php', 'backup.php'
        ];

        foreach ( $settings_files as $file ) {

            $path = EXSIT_HELPER_INC . 'option/settings/' . $file;

            if ( file_exists( $path ) ) {
                require_once $path;
            }
        }
    }

    public function load_textdomain() {

        load_plugin_textdomain(
            'exsit-addons',
            false,
            dirname( plugin_basename( EXSIT_HELPER_PATH . 'exsit-helper.php' ) ) . '/languages'
        );
    }

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

        echo '<div class="wrap">';
        echo '<h1>' . esc_html__( 'Welcome to Exsit Theme', 'exsit-addons' ) . '</h1>';
        echo '<p>' . esc_html__( 'Use Theme Settings to configure your site.', 'exsit-addons' ) . '</p>';
        echo '</div>';
    }

    public function elementor_missing_notice() {

        echo '<div class="notice notice-error">';
        echo '<p><strong>Exsit Helper</strong> requires Elementor to be active.</p>';
        echo '</div>';
    }
}