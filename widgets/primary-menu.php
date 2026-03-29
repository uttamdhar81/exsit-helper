<?php
if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Exsit_Primary_Menu extends Widget_Base {
    public function get_name() {
        return 'exsit-primary-menu';
    }

    public function get_title() {
        return __('Primary Menu', 'exsit-helper');
    }

    public function get_icon() {
        return 'eicon-nav-menu';
    }

    public function get_categories() {
        return ['exsit-helper'];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'exsit-helper'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'menu_location',
            [
                'label' => __('Menu Location', 'exsit-helper'),
                'type' => Controls_Manager::SELECT,
                'options' => $this->get_menu_locations(),
                'default' => '',
            ]
        );

        $this->end_controls_section();
    }

    private function get_menu_locations() {
        $locations = get_nav_menu_locations();
        $menus = wp_get_nav_menus();
        $options = [];

        foreach ($menus as $menu) {
            if (in_array($menu->term_id, $locations)) {
                $options[$menu->term_id] = $menu->name;
            }
        }

        return $options;
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if (empty($settings['menu_location'])) {
            echo '<p>' . __('Please select a menu location.', 'exsit-helper') . '</p>';
            return;
        }

        wp_nav_menu([
            'theme_location' => array_search($settings['menu_location'], get_nav_menu_locations()),
            'container' => false,
            'menu_class' => 'exsit-primary-menu',
        ]);
    }
}