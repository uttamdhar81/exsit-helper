<?php
namespace Exsit;

if (!defined('ABSPATH')) {
    exit;
}

final class Base
{

    private static $instance = null;

    public static function instance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct()
    {
        add_action('plugins_loaded', [$this, 'init']);
        add_action('admin_menu', [$this, 'register_theme_admin_menu']);
    }

    /**
     * Init plugin
     */
    public function init()
    {

        // Load textdomain
        load_plugin_textdomain(
            'exsit-addons',
            false,
            dirname(plugin_basename(__FILE__)) . '/languages'
        );

        // Load Codestar Framework
        if (defined('EXSIT_HELPER_INC') && file_exists(EXSIT_HELPER_INC . 'codestar-framework/codestar-framework.php')) {
            require_once EXSIT_HELPER_INC . 'codestar-framework/codestar-framework.php';
        }

        // Load Theme Settings
        if (defined('EXSIT_HELPER_INC') && file_exists(EXSIT_HELPER_INC . 'option/settings-init.php')) {
            require_once EXSIT_HELPER_INC . 'option/settings-init.php';
        }

        /**
         * Elementor Integration
         */
        if (did_action('elementor/loaded')) {

            add_action('elementor/widgets/register', [$this, 'register_widgets']);

            add_action(
                'elementor/elements/categories_registered',
                [$this, 'register_widget_category']
            );

        }
    }

    /**
     * Register Elementor Widgets
     */
    public function register_widgets($widgets_manager)
    {

        // Team Member Widget
        $team_widget = EXSIT_HELPER_PATH . 'widgets/team-member.php';

        if (file_exists($team_widget)) {

            require_once $team_widget;

            $widgets_manager->register(
                new \Exsit_Team_Member_Widget()
            );
        }


        // Pricing Card Widget
        $pricing_widget = EXSIT_HELPER_PATH . 'widgets/pricing-card.php';

        if (file_exists($pricing_widget)) {

            require_once $pricing_widget;

            $widgets_manager->register(
                new \Exsit_Pricing_Card_Widget()
            );
        }

        // Badge Card Widget
        $badge_widget = EXSIT_HELPER_PATH . 'widgets/badge.php';

        if (file_exists($badge_widget)) {

            require_once $badge_widget;

            $widgets_manager->register(
                new \Exsit_Badge_Widget()
            );
        }

        // Counter Widget
        $counter_widget = EXSIT_HELPER_PATH . 'widgets/counter.php';

        if (file_exists($counter_widget)) {

            require_once $counter_widget;

            $widgets_manager->register(
                new \Exsit_Counter_Widget()
            );
        }

        // Blog Widget
        $blog_widget = EXSIT_HELPER_PATH . 'widgets/blog-card.php';

        if (file_exists($blog_widget)) {

            require_once $blog_widget;

            $widgets_manager->register(
                new \Exsit_Blog_Card_Widget()
            );
        }

        // Slick Slider Widget
        $slick_widget = EXSIT_HELPER_PATH . 'widgets/slick-slider.php';

        if (file_exists($slick_widget)) {

            require_once $slick_widget;

            $widgets_manager->register(
                new \Exsit_Slick_Slider()
            );
        }


    }

    /**
     * Register Elementor Widget Category
     */
    public function register_widget_category($elements_manager)
    {

        $elements_manager->add_category(
            'exsit-addons',
            [
                'title' => esc_html__('Exsit Addons', 'exsit-addons'),
                'icon' => 'fa fa-plug',
            ]
        );

    }

    /**
     * Register parent menu
     */
    public function register_theme_admin_menu()
    {

        add_menu_page(
            esc_html__('Exsit Theme', 'exsit-addons'),
            esc_html__('Exsit Theme', 'exsit-addons'),
            'manage_options',
            'exsit-theme-parent',
            [$this, 'render_dashboard'],
            'dashicons-dashboard',
            30
        );

    }

    /**
     * Dashboard Page
     */
    public function render_dashboard()
    {

        echo '<div class="wrap">';
        echo '<h1>' . esc_html__('Welcome to Exsit Theme', 'exsit-addons') . '</h1>';
        echo '<p>' . esc_html__('Use the Theme Settings to configure your site.', 'exsit-addons') . '</p>';
        echo '</div>';

    }

}