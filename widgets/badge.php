<?php
if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;

class Exsit_Badge_Widget extends Widget_Base
{

    public function get_name()
    {
        return 'exsit-badge';
    }

    public function get_title()
    {
        return __('Badge', 'exsit-addons');
    }

    public function get_icon()
    {
        return 'eicon-call-to-action';
    }

    public function get_categories()
    {
        return ['exsit-addons'];
    }

    protected function register_controls()
    {

        /*-----------------------------
        CONTENT
        -----------------------------*/

        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Badge', 'exsit-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'badge_text',
            [
                'label' => __('Text', 'exsit-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Designed to evolve with business', 'exsit-addons'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'badge_icon',
            [
                'label' => __('Icon', 'exsit-addons'),
                'type' => Controls_Manager::ICONS,
            ]
        );

        $this->add_control(
            'icon_position',
            [
                'label' => __('Icon Position', 'exsit-addons'),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'before',
                'options' => [
                    'before' => [
                        'title' => __('Before', 'exsit-addons'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'after' => [
                        'title' => __('After', 'exsit-addons'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
            ]
        );

        $this->end_controls_section();


        /*-----------------------------
        STYLE - TEXT
        -----------------------------*/

        $this->start_controls_section(
            'text_style',
            [
                'label' => __('Text', 'exsit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'selector' => '{{WRAPPER}} .exsit-badge',
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => __('Text Color', 'exsit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .exsit-badge' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();


        /*-----------------------------
        STYLE - ICON
        -----------------------------*/

        $this->start_controls_section(
            'icon_style',
            [
                'label' => __('Icon', 'exsit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => __('Icon Size', 'exsit-addons'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .exsit-badge i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .exsit-badge svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => __('Icon Color', 'exsit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .exsit-badge i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .exsit-badge svg' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();


        /*-----------------------------
        STYLE - BADGE
        -----------------------------*/

        $this->start_controls_section(
            'badge_style',
            [
                'label' => __('Badge', 'exsit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'badge_bg',
            [
                'label' => __('Background', 'exsit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .exsit-badge' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'badge_border',
                'selector' => '{{WRAPPER}} .exsit-badge',
            ]
        );

        $this->add_responsive_control(
            'badge_radius',
            [
                'label' => __('Border Radius', 'exsit-addons'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .exsit-badge' => 'border-radius: {{SIZE}}px',
                ],
            ]
        );

        $this->add_responsive_control(
            'badge_padding',
            [
                'label' => __('Padding', 'exsit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .exsit-badge' =>
                        'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_section();
    }


    /*-----------------------------
    RENDER
    -----------------------------*/

    protected function render()
    {

        $settings = $this->get_settings_for_display();

        ?>

        <div class="exsit-badge d-inline-flex align-items-center gap-2">

            <?php if (!empty($settings['badge_icon']['value']) && $settings['icon_position'] === 'before'): ?>

                <?php Icons_Manager::render_icon($settings['badge_icon'], ['aria-hidden' => 'true']); ?>

            <?php endif; ?>

            <span class="exsit-badge-text">
                <?php echo esc_html($settings['badge_text']); ?>
            </span>

            <?php if (!empty($settings['badge_icon']['value']) && $settings['icon_position'] === 'after'): ?>

                <?php Icons_Manager::render_icon($settings['badge_icon'], ['aria-hidden' => 'true']); ?>

            <?php endif; ?>

        </div>

        <?php
    }
}