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
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'logo_size',
            [
                'label' => __('Logo Size', 'exsit-helper'),
                'type' => Controls_Manager::SLIDER,
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

        this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'logo_size', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                'include' => [],
                'default' => 'large',
                'condition' => [
                    'logo_type' => 'custom',
                ]
            ]
        );

        

        $this->add_responsive_control(
            'content_align',
            [
                'label' => __('Align', 'exsit-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'exsit-addons'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('top', 'exsit-addons'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'exsit-addons'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'exsit_class' => 'content-align%s-',
                'toggle' => true,
            ]
        );

        $this->add_control(
            'logo_link',
            [
                'label' => __('Logo Link', 'exsit-helper'),
                'type' => Controls_Manager::URL,
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

        $logo_id  = get_theme_mod('custom_logo');
        $logo_url = wp_get_attachment_image_url($logo_id, 'full');

        $link     = !empty($settings['logo_link']['url']) ? $settings['logo_link']['url'] : home_url();
        $target   = !empty($settings['logo_link']['is_external']) ? ' target="_blank"' : '';
        $nofollow = !empty($settings['logo_link']['nofollow']) ? ' rel="nofollow"' : '';

        echo '<a class="exsit-site-logo" 
            href="' . esc_url($link) . '" 
            ' . $target . $nofollow . ' 
            style="display:block; text-align:' . esc_attr($settings['content_align']) . ';">';

        if (has_custom_logo() && $logo_url) {
            echo '<img src="' . esc_url($logo_url) . '" 
                        alt="' . esc_attr(get_bloginfo('name')) . '" 
                        style="width: ' . esc_attr($settings['logo_size']['size']) . esc_attr($settings['logo_size']['unit']) . ';">';
        } else {
            echo '<h1>' . esc_html(get_bloginfo('name')) . '</h1>';
        }

        echo '</a>';
    }
}