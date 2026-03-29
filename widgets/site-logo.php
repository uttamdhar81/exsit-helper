<?php
if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;

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

        // Logo Size
        $this->add_control(
            'logo_size',
            [
                'label' => __('Logo Width', 'exsit-helper'),
                'type'  => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 500,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
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
                'placeholder' => __('https://your-link.com', 'exsit-helper'),
                'default' => [
                    'url' => home_url(),
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        // Get logo
        $logo_id  = get_theme_mod('custom_logo');
        $logo_url = wp_get_attachment_image_url($logo_id, 'full');

        // Link settings
        $link     = !empty($settings['logo_link']['url']) ? $settings['logo_link']['url'] : home_url('/');
        $target   = !empty($settings['logo_link']['is_external']) ? ' target="_blank" rel="noopener"' : '';
        $nofollow = !empty($settings['logo_link']['nofollow']) ? ' rel="nofollow"' : '';

        // Logo size safety
        $width = !empty($settings['logo_size']['size']) ? $settings['logo_size']['size'] : 100;
        $unit  = !empty($settings['logo_size']['unit']) ? $settings['logo_size']['unit'] : '%';

        echo '<a class="exsit-site-logo navbar-brand light-logo logo position-relative" href="' . esc_url($link) . '"' . $target . $nofollow . '>';

        if (has_custom_logo() && $logo_url) {
            echo '<img src="' . esc_url($logo_url) . '" 
                        alt="' . esc_attr(get_bloginfo('name')) . '" 
                        style="width:' . esc_attr($width . $unit) . ';">';
        } else {
            echo '<h1>' . esc_html(get_bloginfo('name')) . '</h1>';
        }

        echo '</a>';
    }
}