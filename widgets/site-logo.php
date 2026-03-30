<?php
if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Exsit_Site_Logo extends Widget_Base {

    public function get_name() {
        return 'exsit-site-logo';
    }

    public function get_title() {
        return __('Site Logo', 'exsit-helper');
    }

    public function get_icon() {
        return 'eicon-site-logo';
    }

    public function get_categories() {
        return ['exsit-helper'];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'exsit-helper'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Logo Type
        $this->add_control(
            'logo_type',
            [
                'label' => __('Logo Type', 'exsit-helper'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'default' => __('Default Logo (Customizer)', 'exsit-helper'),
                    'custom'  => __('Custom Logo', 'exsit-helper'),
                ],
                'default' => 'default',
            ]
        );

        // Light Logo (Custom)
        $this->add_control(
            'image',
            [
                'label' => __('Light Logo', 'exsit-helper'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
                'condition' => [
                    'logo_type' => 'custom',
                ],
            ]
        );

        // Dark Logo
        $this->add_control(
            'dark_logo',
            [
                'label' => __('Dark Logo', 'exsit-helper'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
                'condition' => [
                    'logo_type' => 'custom',
                ],
            ]
        );

        // Logo Size
        $this->add_control(
            'logo_size',
            [
                'label' => __('Logo Width', 'exsit-helper'),
                'type'  => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => ['min' => 10, 'max' => 500],
                    '%'  => ['min' => 10, 'max' => 100],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
            ]
        );

        // Alignment
        $this->add_responsive_control(
            'content_align',
            [
                'label' => __('Alignment', 'exsit-helper'),
                'type'  => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'exsit-helper'),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'exsit-helper'),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'exsit-helper'),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle'  => true,
                'selectors' => [
                    '{{WRAPPER}} .exsit-site-logo' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        // Logo Link
        $this->add_control(
            'logo_link',
            [
                'label' => __('Logo Link', 'exsit-helper'),
                'type'  => Controls_Manager::URL,
                'default' => [
                    'url' => home_url('/'),
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        // Default logo (Customizer)
        $custom_logo_id = get_theme_mod('custom_logo');
        $default_logo   = wp_get_attachment_image_url($custom_logo_id, 'full');

        // Light logo
        if ($settings['logo_type'] === 'custom' && !empty($settings['image']['url'])) {
            $light_logo = $settings['image']['url'];
        } else {
            $light_logo = $default_logo;
        }

        // Dark logo
        $dark_logo = !empty($settings['dark_logo']['url']) ? $settings['dark_logo']['url'] : '';

        // Link
        $link     = !empty($settings['logo_link']['url']) ? $settings['logo_link']['url'] : home_url('/');
        $target   = !empty($settings['logo_link']['is_external']) ? ' target="_blank" rel="noopener"' : '';
        $nofollow = !empty($settings['logo_link']['nofollow']) ? ' rel="nofollow"' : '';

        // Size
        $width = !empty($settings['logo_size']['size']) ? $settings['logo_size']['size'] : 100;
        $unit  = !empty($settings['logo_size']['unit']) ? $settings['logo_size']['unit'] : '%';

        echo '<a class="exsit-site-logo navbar-brand logo position-relative" href="' . esc_url($link) . '"' . $target . $nofollow . '>';

        if (!empty($light_logo)) {

            $light_class = !empty($dark_logo) ? 'light-logo' : '';

            // Light Logo
            echo '<img class="' . esc_attr($light_class) . '" 
                        src="' . esc_url($light_logo) . '" 
                        alt="' . esc_attr(get_bloginfo('name')) . '" 
                        style="width:' . esc_attr($width . $unit) . ';">';

            // Dark Logo
            if (!empty($dark_logo)) {
                echo '<img class="dark-logo" 
                            src="' . esc_url($dark_logo) . '" 
                            alt="' . esc_attr(get_bloginfo('name')) . '" 
                            style="width:' . esc_attr($width . $unit) . ';">';
            }

        } else {
            echo '<h1>' . esc_html(get_bloginfo('name')) . '</h1>';
        }

        echo '</a>';
    }
}