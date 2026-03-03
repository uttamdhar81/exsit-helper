<?php
if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class Exsit_Counter_Widget extends Widget_Base
{

    public function get_name()
    {
        return 'exsit-counter';
    }

    public function get_title()
    {
        return __('Counter', 'exsit-addons');
    }

    public function get_icon()
    {
        return 'eicon-counter';
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
                'label' => __('Counter', 'exsit-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'counter_number',
            [
                'label' => __('Number', 'exsit-addons'),
                'type' => Controls_Manager::NUMBER,
                'default' => 4.5,
                'step' => 0.1,
            ]
        );

        $this->add_control(
            'counter_suffix',
            [
                'label' => __('Suffix', 'exsit-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => 'k',
            ]
        );

        $this->end_controls_section();


        /* ---------------------------
        STYLE - NUMBER
        ----------------------------*/

        $this->start_controls_section(
            'number_style',
            [
                'label' => __('Number', 'exsit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'number_typography',
                'selector' => '{{WRAPPER}} .exsit-counter',
            ]
        );

        $this->add_control(
            'number_color',
            [
                'label' => __('Color', 'exsit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .exsit-counter' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();


        /* ---------------------------
        STYLE - SUFFIX
        ----------------------------*/

        $this->start_controls_section(
            'suffix_style',
            [
                'label' => __('Suffix', 'exsit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'suffix_typography',
                'selector' => '{{WRAPPER}} .exsit-counter-suffix',
            ]
        );

        $this->add_control(
            'suffix_color',
            [
                'label' => __('Color', 'exsit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .exsit-counter-suffix' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

    }


    /* ---------------------------
    RENDER
    ----------------------------*/

    protected function render()
    {

        $settings = $this->get_settings_for_display();

        ?>

        <h3 class="exsit-counter-wrapper lh-1 align-items-baseline d-flex mb-0">

            <span class="exsit-counter" data-percentage="<?php echo esc_attr($settings['counter_number']); ?>">
                <?php echo esc_html($settings['counter_number']); ?>
            </span>

            <?php if (!empty($settings['counter_suffix'])): ?>

                <span class="exsit-counter-suffix">
                    <?php echo esc_html($settings['counter_suffix']); ?>
                </span>

            <?php endif; ?>
            

        </h3>

        <?php
    }
}
