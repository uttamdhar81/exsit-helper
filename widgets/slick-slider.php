<?php
if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

class Exsit_Slick_Slider extends Widget_Base
{

    public function get_name()
    {
        return 'exsit_slick_slider';
    }

    public function get_title()
    {
        return __('Exsit Slick Slider', 'exsit-addons');
    }

    public function get_icon()
    {
        return 'eicon-slider-push';
    }

    public function get_categories()
    {
        return ['exsit-addons'];
    }

    public function get_script_depends()
    {
        return ['exsit-slick', 'exsit-addons'];
    }

    public function get_style_depends()
    {
        return ['exsit-slick-css', 'exsit-slick-theme'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Slides', 'exsit-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'image',
            [
                'label' => __('Image', 'exsit-addons'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label' => __('Title', 'exsit-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Slide Title', 'exsit-addons'),
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label' => __('Description', 'exsit-addons'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('Slide description', 'exsit-addons'),
            ]
        );

        $this->add_control(
            'slides',
            [
                'label' => __('Slides', 'exsit-addons'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => __('Autoplay', 'exsit-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => 'Yes',
                'label_off' => 'No',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'dots',
            [
                'label' => __('Dots', 'exsit-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => 'Show',
                'label_off' => 'Hide',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'arrows',
            [
                'label' => __('Arrows', 'exsit-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => 'Show',
                'label_off' => 'Hide',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label' => __('Autoplay Speed (ms)', 'exsit-addons'),
                'type' => Controls_Manager::NUMBER,
                'default' => 3000,
                'min' => 1000,
                'step' => 500,
                'condition' => [
                    'autoplay' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_section',
            [
                'label' => __('Content Style', 'exsit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        /* -----------------------
        TITLE STYLE
        ----------------------- */

        $this->add_control(
            'title_heading',
            [
                'label' => __('Title', 'exsit-addons'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .exsit-slide-title',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __('Title Color', 'exsit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .exsit-slide-title' => 'color: {{VALUE}};',
                ],
            ]
        );


        /* -----------------------
        DESCRIPTION STYLE
        ----------------------- */

        $this->add_control(
            'desc_heading',
            [
                'label' => __('Description', 'exsit-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'desc_typography',
                'selector' => '{{WRAPPER}} .exsit-slide-desc',
            ]
        );

        $this->add_control(
            'desc_color',
            [
                'label' => __('Description Color', 'exsit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .exsit-slide-desc' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {

        $settings = $this->get_settings_for_display();
        $slider_id = 'exsit-slick-' . $this->get_id();
        $autoplay = ($settings['autoplay'] === 'yes') ? 'true' : 'false';
        $dots = ($settings['dots'] === 'yes') ? 'true' : 'false';
        $arrows = ($settings['arrows'] === 'yes') ? 'true' : 'false';
        $autoplay_speed = !empty($settings['autoplay_speed']) ? $settings['autoplay_speed'] : 3000;


        ?>
        <div class="exsit-slider-wrapper">
            <div class="exsit-slick-slider" data-autoplay="<?php echo esc_attr($autoplay); ?>"
                data-dots="<?php echo esc_attr($dots); ?>" data-arrows="<?php echo esc_attr($arrows); ?>"
                data-autoplay-speed="<?php echo esc_attr($autoplay_speed); ?>">

                <?php foreach ($settings['slides'] as $slide): ?>

                    <div class="exsit-slide position-relative">

                        <?php if (!empty($slide['image']['url'])): ?>
                            <img src="<?php echo esc_url($slide['image']['url']); ?>" alt="">
                        <?php endif; ?>

                        <div class="exsit-slide-content d-flex flex-column p-4 position-absolute bottom-0 w-100 z-index-1">

                            <?php if (!empty($slide['title'])): ?>
                                <span class="exsit-slide-title mb-0">
                                    <?php echo esc_html($slide['title']); ?>
                                </span>
                            <?php endif; ?>

                            <?php if (!empty($slide['description'])): ?>
                                <p class="exsit-slide-desc mb-0">
                                    <?php echo esc_html($slide['description']); ?>
                                </p>
                            <?php endif; ?>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>
            <div class="exsit-slider-counter p-4 position-absolute bottom-0 end-0 z-index-2 bg-dark text-white">
                <span class="current">1</span> /
                <span class="total"><?php echo count($settings['slides']); ?></span>
            </div>
        </div>

        <script>
            jQuery(document).ready(function ($) {

                var slider = $('#<?php echo esc_js($slider_id); ?>');

                if (!slider.hasClass('slick-initialized')) {

                    slider.slick({
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        autoplay: <?php echo ($settings['autoplay'] === 'yes') ? 'true' : 'false'; ?>,
                        arrows: true,
                        dots: true
                    });

                }

            });
        </script>

        <?php
    }
}