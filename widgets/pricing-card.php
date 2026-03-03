<?php
if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;

class Exsit_Pricing_Card_Widget extends Widget_Base
{

    public function get_name()
    {
        return 'exsit-pricing-card';
    }

    public function get_title()
    {
        return __('Pricing Card', 'exsit-addons');
    }

    public function get_icon()
    {
        return 'eicon-price-table';
    }

    public function get_categories()
    {
        return ['exsit-addons'];
    }

    protected function register_controls()
    {

        /* ---------------------------
        CONTENT
        ----------------------------*/

        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'exsit-addons'),
            ]
        );

        $this->add_control(
            'layout_style',
            [
                'label' => __('Layout Style', 'exsit-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [
                    'style1' => __('Style 1', 'exsit-addons'),
                    'style2' => __('Style 2', 'exsit-addons'),
                ],
            ]
        );

        $this->add_control(
            'plan_title',
            [
                'label' => __('Title', 'exsit-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Startup',
            ]
        );

        $this->add_control(
            'plan_desc',
            [
                'label' => __('Description', 'exsit-addons'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Best for startup business owners who needs for business.',
            ]
        );

        $this->add_control(
            'price',
            [
                'label' => __('Price', 'exsit-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => '$29',
            ]
        );

        $this->add_control(
            'billing_text',
            [
                'label' => __('Billing Text', 'exsit-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => '/ month',
            ]
        );

        $this->end_controls_section();


        /* ---------------------------
        BUTTON
        ----------------------------*/

        $this->start_controls_section(
            'button_section',
            [
                'label' => __('Button', 'exsit-addons'),
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __('Button Text', 'exsit-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Start trial for 14 days',
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => __('Button Link', 'exsit-addons'),
                'type' => Controls_Manager::URL,
            ]
        );

        $this->add_control(
            'button_icon',
            [
                'label' => __('Icon', 'exsit-addons'),
                'type' => Controls_Manager::ICONS,
            ]
        );

        $this->add_control(
            'button_icon_color',
            [
                'label' => __('Icon Color', 'exsit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .exsit-price-btn i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .exsit-price-btn svg' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'icon_position',
            [
                'label' => __('Icon Position', 'exsit-addons'),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'after',
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
                'toggle' => false,
                'condition' => [
                    'button_icon[value]!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_spacing',
            [
                'label' => __('Icon Spacing', 'exsit-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .exsit-price-btn .exsit-btn-icon-before' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .exsit-price-btn .exsit-btn-icon-after' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'button_icon[value]!' => '',
                ],
            ]
        );

        $this->end_controls_section();


        /* ---------------------------
        FEATURES
        ----------------------------*/

        $this->start_controls_section(
            'features_section',
            [
                'label' => __('Features', 'exsit-addons'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'feature_icon',
            [
                'label' => __('Icon', 'exsit-addons'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-check-circle',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $repeater->add_control(
            'feature_text',
            [
                'label' => __('Feature Text', 'exsit-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => '10 GB disk space availability',
            ]
        );

        $this->add_control(
            'features',
            [
                'label' => __('Features', 'exsit-addons'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ feature_text }}}',
            ]
        );

        $this->end_controls_section();

        // EXTRA FEATURE

        $this->start_controls_section(
            'extra_sections',
            [
                'label' => __('Extra Sections', 'exsit-addons'),
            ]
        );

        $section_repeater = new Repeater();

        $section_repeater->add_control(
            'section_title',
            [
                'label' => __('Section Title', 'exsit-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => 'What you can do',
            ]
        );

        $item_repeater = new Repeater();

        $item_repeater->add_control(
            'item_text',
            [
                'label' => __('Item Text', 'exsit-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Customize your booking page',
            ]
        );

        $section_repeater->add_control(
            'items',
            [
                'label' => __('Items', 'exsit-addons'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $item_repeater->get_controls(),
                'title_field' => '{{{ item_text }}}',
            ]
        );

        $this->add_control(
            'extra_lists',
            [
                'label' => __('Sections', 'exsit-addons'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $section_repeater->get_controls(),
                'title_field' => '{{{ section_title }}}',
            ]
        );

        $this->end_controls_section();

        /* ---------------------------
        BADGE
        ----------------------------*/

        $this->start_controls_section(
            'badge_section',
            [
                'label' => __('Top Badge', 'exsit-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'badge_text',
            [
                'label' => __('Badge Text', 'exsit-addons'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __('Get 20% Off', 'exsit-addons'),
            ]
        );

        $this->add_control(
            'badge_icon',
            [
                'label' => __('Badge Icon', 'exsit-addons'),
                'type' => Controls_Manager::ICONS,
            ]
        );

        $this->end_controls_section();


        /* ---------------------------
        STYLE - CARD
        ----------------------------*/

        $this->start_controls_section(
            'card_style',
            [
                'label' => __('Card Style', 'exsit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'border_color',
            [
                'label' => __('Border Color', 'exsit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .exsit-price-card' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'border_width',
            [
                'label' => __('Border Width', 'exsit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .exsit-price-card' => 'border-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'border_style',
            [
                'label' => __('Border Style', 'exsit-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'solid',
                'options' => [
                    'solid' => __('Solid', 'exsit-addons'),
                    'dashed' => __('Dashed', 'exsit-addons'),
                    'dotted' => __('Dotted', 'exsit-addons'),
                    'double' => __('Double', 'exsit-addons'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .exsit-price-card' => 'border-style: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'card_bg_color',
            [
                'label' => __('Background Color', 'exsit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .exsit-price-card' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();


        /* ---------------------------
        TITLE STYLE
        ----------------------------*/

        $this->start_controls_section(
            'title_style',
            [
                'label' => __('Title', 'exsit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __('Color', 'exsit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .exsit-price-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .exsit-price-title',
            ]
        );

        $this->end_controls_section();


        /* ---------------------------
        DESCRIPTION STYLE
        ----------------------------*/

        $this->start_controls_section(
            'desc_style',
            [
                'label' => __('Description', 'exsit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'desc_color',
            [
                'label' => __('Color', 'exsit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .exsit-price-desc' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'desc_typography',
                'selector' => '{{WRAPPER}} .exsit-price-desc',
            ]
        );

        $this->end_controls_section();


        /* ---------------------------
        PRICE STYLE
        ----------------------------*/

        $this->start_controls_section(
            'price_style',
            [
                'label' => __('Price', 'exsit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'price_color',
            [
                'label' => __('Color', 'exsit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .exsit-price' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'price_typography',
                'selector' => '{{WRAPPER}} .exsit-price',
            ]
        );

        $this->end_controls_section();


        /* ---------------------------
        BILLING STYLE
        ----------------------------*/

        $this->start_controls_section(
            'billing_style',
            [
                'label' => __('Billing Text', 'exsit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'billing_color',
            [
                'label' => __('Color', 'exsit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .exsit-billing' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'billing_typography',
                'selector' => '{{WRAPPER}} .exsit-billing',
            ]
        );

        $this->end_controls_section();

        /* ---------------------------
        BUTTON STYLE
        ----------------------------*/

        $this->start_controls_section(
            'button_style',
            [
                'label' => __('Button', 'exsit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .exsit-price-btn',
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label' => __('Text Color', 'exsit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .exsit-price-btn' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label' => __('Background Color', 'exsit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .exsit-price-btn' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label' => __('Hover Text Color', 'exsit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .exsit-price-btn:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_hover_bg',
            [
                'label' => __('Hover Background', 'exsit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .exsit-price-btn:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        /* ICON SIZE CONTROL */

        $this->add_responsive_control(
            'button_icon_size',
            [
                'label' => __('Icon Size', 'exsit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 8,
                        'max' => 60,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .exsit-price-btn i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .exsit-price-btn svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => __('Padding', 'exsit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .exsit-price-btn' =>
                        'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_radius',
            [
                'label' => __('Border Radius', 'exsit-addons'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .exsit-price-btn' => 'border-radius: {{SIZE}}px;',
                ],
            ]
        );

        $this->end_controls_section();

        /* ---------------------------
        FEATURE TEXT STYLE
        ----------------------------*/

        $this->start_controls_section(
            'feature_text_style',
            [
                'label' => __('Feature Text', 'exsit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'feature_text_color',
            [
                'label' => __('Text Color', 'exsit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .exsit-feature-text' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'feature_typography',
                'selector' => '{{WRAPPER}} .exsit-feature-text',
            ]
        );

        $this->end_controls_section();



        $this->start_controls_section(
            'extra_section_title_style',
            [
                'label' => __('Extra Section Title', 'exsit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'extra_title_color',
            [
                'label' => __('Color', 'exsit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .exsit-extra-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'extra_title_typography',
                'selector' => '{{WRAPPER}} .exsit-extra-title',
            ]
        );

        $this->add_control(
            'item_text_color',
            [
                'label' => __('Color', 'exsit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .exsit-extra-item' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'item_typography',
                'selector' => '{{WRAPPER}} .exsit-extra-item',
            ]
        );

        $this->end_controls_section();

        /* ---------------------------
        FEATURE ICON STYLE
        ----------------------------*/

        $this->start_controls_section(
            'feature_icon_style',
            [
                'label' => __('Feature Icon', 'exsit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'feature_icon_color',
            [
                'label' => __('Icon Color', 'exsit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .exsit-feature-icon' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'feature_icon_size',
            [
                'label' => __('Icon Size', 'exsit-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 40,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .exsit-feature-icon i' => 'font-size: {{SIZE}}px;',
                    '{{WRAPPER}} .exsit-feature-icon svg' =>
                        'width: {{SIZE}}px; height: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_spacing',
            [
                'label' => __('Icon Spacing', 'exsit-addons'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .exsit-feature-icon' => 'margin-right: {{SIZE}}px;',
                ],
            ]
        );

        $this->end_controls_section();

        /* ---------------------------
        BADGE STYLE
        ----------------------------*/

        $this->start_controls_section(
            'badge_style',
            [
                'label' => __('Badge Style', 'exsit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'badge_typography',
                'selector' => '{{WRAPPER}} .exsit-price-badge',
            ]
        );

        $this->add_control(
            'badge_text_color',
            [
                'label' => __('Text Color', 'exsit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .exsit-price-badge' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'badge_bg_color',
            [
                'label' => __('Background Color', 'exsit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .exsit-price-badge' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'badge_border_color',
            [
                'label' => __('Border Color', 'exsit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .exsit-price-badge' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'badge_icon_size',
            [
                'label' => __('Icon Size', 'exsit-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 40,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .exsit-price-badge i' => 'font-size: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .exsit-price-badge svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_section();

    }


    /* --------------------------------------------------
    RENDER
    -------------------------------------------------- */

    protected function render()
    {

        $settings = $this->get_settings_for_display();

        if ($settings['layout_style'] === 'style2') {
            $this->render_style2($settings);
        } else {
            $this->render_style1($settings);
        }

    }


    /* --------------------------------------------------
    STYLE 1
    -------------------------------------------------- */

    protected function render_style1($settings)
    {
        ?>

        <div class="exsit-price-card d-flex flex-column p-5 rounded-4 gap-4">

            <?php $this->render_badge($settings); ?>

            <div>
                <h3 class="exsit-price-title"><?php echo esc_html($settings['plan_title']); ?></h3>

                <p class="exsit-price-desc mb-3">
                    <?php echo esc_html($settings['plan_desc']); ?>
                </p>
            </div>

            <div class="lh-1 d-flex flex-row align-items-baseline gap-1">
                <span class="exsit-price"><?php echo esc_html($settings['price']); ?></span>
                <span class="exsit-billing"><?php echo esc_html($settings['billing_text']); ?></span>
            </div>

            <div class="border-top"></div>

            <?php $this->render_button($settings); ?>

            <div class="border-top"></div>

            <?php $this->render_features($settings); ?>

            <?php $this->render_extra_sections($settings); ?>

        </div>

        <?php
    }


    /* --------------------------------------------------
    STYLE 2
    -------------------------------------------------- */

    protected function render_style2($settings)
    {
        ?>

        <div class="exsit-price-card d-flex flex-column p-5 rounded-4 gap-4">

            <?php $this->render_badge($settings); ?>

            <div>
                <h3 class="exsit-price-title mb-2"><?php echo esc_html($settings['plan_title']); ?></h3>

                <p class="exsit-price-desc mb-0">
                    <?php echo esc_html($settings['plan_desc']); ?>
                </p>
            </div>

            <div class="lh-1 d-flex flex-row align-items-baseline gap-1 py-2">
                <span class="exsit-price"><?php echo esc_html($settings['price']); ?></span>
                <span class="exsit-billing"><?php echo esc_html($settings['billing_text']); ?></span>
            </div>

            <?php $this->render_features($settings); ?>

            <?php $this->render_button($settings); ?>

        </div>

        <?php
    }


    /* --------------------------------------------------
    BADGE
    -------------------------------------------------- */

    protected function render_badge($settings)
    {

        if (empty($settings['badge_text']))
            return;
        ?>

        <div
            class="exsit-price-badge position-absolute start-50 translate-middle-x top-n-4 px-3 py-1 shadow-sm rounded-3 d-flex align-items-center gap-2">

            <?php
            if (!empty($settings['badge_icon']['value'])) {
                Icons_Manager::render_icon($settings['badge_icon'], ['aria-hidden' => 'true']);
            }
            ?>

            <?php echo esc_html($settings['badge_text']); ?>

        </div>

        <?php
    }


    /* --------------------------------------------------
    BUTTON
    -------------------------------------------------- */

    protected function render_button($settings)
    {

        if (empty($settings['button_text']))
            return;

        ?>

        <a href="<?php echo esc_url($settings['button_link']['url']); ?>"
            class="elementor-button elementor-size-lg exsit-price-btn">

            <?php if (!empty($settings['button_icon']['value']) && $settings['icon_position'] === 'before'): ?>

                <span class="exsit-btn-icon-before">
                    <?php Icons_Manager::render_icon($settings['button_icon'], ['aria-hidden' => 'true']); ?>
                </span>

            <?php endif; ?>

            <span class="exsit-btn-text">
                <?php echo esc_html($settings['button_text']); ?>
            </span>

            <?php if (!empty($settings['button_icon']['value']) && $settings['icon_position'] === 'after'): ?>

                <span class="exsit-btn-icon-after">
                    <?php Icons_Manager::render_icon($settings['button_icon'], ['aria-hidden' => 'true']); ?>
                </span>

            <?php endif; ?>

        </a>

        <?php
    }


    /* --------------------------------------------------
    FEATURES
    -------------------------------------------------- */

    protected function render_features($settings)
    {

        if (empty($settings['features']))
            return;

        ?>

        <div>

            <?php foreach ($settings['features'] as $feature): ?>

                <p class="d-flex align-items-center gap-2 mb-2">

                    <span class="exsit-feature-icon">
                        <?php Icons_Manager::render_icon($feature['feature_icon'], ['aria-hidden' => 'true']); ?>
                    </span>

                    <span class="exsit-feature-text">
                        <?php echo esc_html($feature['feature_text']); ?>
                    </span>

                </p>

            <?php endforeach; ?>

        </div>

        <?php
    }

    /* --------------------------------------------------
    EXTRA FEATURES
    -------------------------------------------------- */
    protected function render_extra_sections($settings)
    {

        if (empty($settings['extra_lists']))
            return;

        ?>

        <?php foreach ($settings['extra_lists'] as $section): ?>

            <div class="border-top"></div>

            <div class="exsit-extra-section">

                <?php if (!empty($section['section_title'])): ?>

                    <h5 class="exsit-extra-title mb-3">
                        <?php echo esc_html($section['section_title']); ?>
                    </h5>

                <?php endif; ?>


                <?php if (!empty($section['items'])): ?>

                    <div class="exsit-extra-items">

                        <?php foreach ($section['items'] as $item): ?>

                            <p class="exsit-extra-item mb-2">
                                <?php echo esc_html($item['item_text']); ?>
                            </p>

                        <?php endforeach; ?>

                    </div>

                <?php endif; ?>

            </div>

        <?php endforeach; ?>

        <?php
    }

}