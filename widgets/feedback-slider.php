<?php
if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

class Exsit_Feedback_Slider extends Widget_Base
{

    public function get_name()
    {
        return 'exsit_feedback_slider';
    }

    public function get_title()
    {
        return __('Feedback Slider', 'exsit-helper');
    }

    public function get_icon()
    {
        return 'eicon-testimonial-carousel';
    }

    public function get_categories()
    {
        return ['exsit-helper'];
    }

    public function get_script_depends()
    {
        return ['exsit-slick', 'exsit-helper'];
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
                'label' => __('Feedback Items', 'exsit-helper'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'layout_style',
            [
                'label' => __('Style', 'exsit-helper'),
                'type' => Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [
                    'style1' => __('Style 1 ', 'exsit-helper'),
                    'style2' => __('Style 2 ', 'exsit-helper'),
                    'style3' => __('Style 3 ', 'exsit-helper'),
                    'style4' => __('Style 4 ', 'exsit-helper'),
                    'style5' => __('Style 5 ', 'exsit-helper'),
                ],
            ]
        );

        $repeater = new Repeater();


        $repeater->add_control(
            'brand_image',
            [
                'label' => __('Brand Logo', 'exsit-helper'),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $repeater->add_control(
            'bg_image',
            [
                'label' => __('Background Image', 'exsit-helper'),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $repeater->add_control(
            'user_image',
            [
                'label' => __('User Image', 'exsit-helper'),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $repeater->add_control(
            'user_name',
            [
                'label' => __('User Name', 'exsit-helper'),
                'type' => Controls_Manager::TEXT,
                'default' => 'John Doe',
            ]
        );

        $repeater->add_control(
            'user_role',
            [
                'label' => __('User Role', 'exsit-helper'),
                'type' => Controls_Manager::TEXT,
                'default' => 'CEO, Company',
            ]
        );

        $repeater->add_control(
            'feedback_text',
            [
                'label' => __('Feedback Text', 'exsit-helper'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Amazing service and support!',
            ]
        );

        $repeater->add_control(
            'rating_value',
            [
                'label' => __('Rating Value', 'exsit-helper'),
                'type' => Controls_Manager::NUMBER,
                'default' => 4.5,
                'step' => 0.1,
            ]
        );

        $repeater->add_control(
            'rating_count',
            [
                'label' => __('Rating Count', 'exsit-helper'),
                'type' => Controls_Manager::TEXT,
                'default' => '{ 2.3k + Reviews }',
            ]
        );
        $this->add_control(
            'feedbacks',
            [
                'label' => __('Feedback List', 'exsit-helper'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ user_name }}}',
            ]
        );

        // Slider options (same as your first widget)
        $this->add_control('autoplay', [
            'label' => __('Autoplay', 'exsit-helper'),
            'type' => Controls_Manager::SWITCHER,
            'default' => 'yes',
        ]);

        $this->add_control('dots', [
            'label' => __('Dots', 'exsit-helper'),
            'type' => Controls_Manager::SWITCHER,
            'default' => 'yes',
        ]);

        $this->add_control('arrows', [
            'label' => __('Arrows', 'exsit-helper'),
            'type' => Controls_Manager::SWITCHER,
            'default' => 'no',
        ]);

        $this->end_controls_section();

        /* -----------------------
        STYLE
        ----------------------- */

        $this->start_controls_section(
            'section_wrapper_style',
            [
                'label' => __('Wrapper Card', 'exsit-helper'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'wrapper_bg',
            [
                'label' => __('Background Color', 'exsit-helper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .feedback-slider-wrapper' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'wrapper_padding',
            [
                'label' => __('Padding', 'exsit-helper'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .feedback-slider-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'wrapper_radius',
            [
                'label' => __('Border Radius', 'exsit-helper'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .feedback-slider-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_feedback_style',
            [
                'label' => __('Feedback Text', 'exsit-helper'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'feedback_typography',
                'selector' => '{{WRAPPER}} .exsit-feedback-text',
            ]
        );

        $this->add_control(
            'feedback_color',
            [
                'label' => __('Color', 'exsit-helper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .exsit-feedback-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_author_name_style',
            [
                'label' => __('Author Name', 'exsit-helper'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'author_name_typography',
                'selector' => '{{WRAPPER}} .exsit-user-name',
            ]
        );

        $this->add_control(
            'author_name_color',
            [
                'label' => __('Color', 'exsit-helper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .exsit-user-name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_author_role_style',
            [
                'label' => __('Author Role', 'exsit-helper'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'author_role_typography',
                'selector' => '{{WRAPPER}} .exsit-user-role',
            ]
        );

        $this->add_control(
            'author_role_color',
            [
                'label' => __('Color', 'exsit-helper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .exsit-user-role' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_author_image_style',
            [
                'label' => __('Author Image', 'exsit-helper'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'author_image_size',
            [
                'label' => __('Size', 'exsit-helper'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 30,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .exsit-user-img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_brand_image_style',
            [
                'label' => __('Brand Image', 'exsit-helper'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'brand_image_size',
            [
                'label' => __('Size', 'exsit-helper'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .exsit-brand-img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_rating_style',
            [
                'label' => __('Rating', 'exsit-helper'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        /* -----------------------
        STAR ICON
        ----------------------- */
        /* FULL STAR */
        $this->add_control(
            'rating_star_full',
            [
                'label' => __('Full Star Icon', 'exsit-helper'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'fa-solid',
                ],
            ]
        );

        /* EMPTY STAR */
        $this->add_control(
            'rating_star_empty',
            [
                'label' => __('Empty Star Icon', 'exsit-helper'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'far fa-star',
                    'library' => 'fa-regular',
                ],
            ]
        );

        $this->add_responsive_control(
            'rating_star_size',
            [
                'label' => __('Star Size', 'exsit-helper'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 40,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .exsit-rating-stars i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .exsit-rating-stars svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'rating_color',
            [
                'label' => __('Star Color', 'exsit-helper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .exsit-rating-stars i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .exsit-rating-stars svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        /* -----------------------
        RATING VALUE
        ----------------------- */

        $this->add_control(
            'rating_value_heading',
            [
                'label' => __('Rating Value', 'exsit-helper'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'rating_value_typography',
                'selector' => '{{WRAPPER}} .exsit-rating-value',
            ]
        );

        $this->add_control(
            'rating_value_color',
            [
                'label' => __('Color', 'exsit-helper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .exsit-rating-value' => 'color: {{VALUE}};',
                ],
            ]
        );

        /* -----------------------
        RATING COUNT
        ----------------------- */

        $this->add_control(
            'rating_count_heading',
            [
                'label' => __('Rating Count', 'exsit-helper'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'rating_count_typography',
                'selector' => '{{WRAPPER}} .exsit-rating-count',
            ]
        );

        $this->add_control(
            'rating_count_color',
            [
                'label' => __('Color', 'exsit-helper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .exsit-rating-count' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $autoplay = ($settings['autoplay'] === 'yes') ? 'true' : 'false';
        $dots = ($settings['dots'] === 'yes') ? 'true' : 'false';
        $arrows = ($settings['arrows'] === 'yes') ? 'true' : 'false';
        ?>

        <div class="feedback-slider-wrapper position-relative">

            <div class="exsit-slick-slider" data-style="<?php echo esc_attr($settings['layout_style']); ?>"
                data-autoplay="<?php echo esc_attr($autoplay); ?>" data-dots="<?php echo esc_attr($dots); ?>"
                data-arrows="<?php echo esc_attr($arrows); ?>" data-autoplay-speed="3000">

                <?php foreach ($settings['feedbacks'] as $item): ?>

                    <?php if ($settings['layout_style'] === 'style5'): ?>

                        <div class="exsit-feedback-slide flex-md-row flex-column d-flex gap-3">
                            <!-- LEFT CONTENT -->
                            <div class="exsit-feedback-left flex-1 d-flex flex-column pe-lg-5">
                                <!-- RATING -->
                                <div class="d-flex flex-row gap-2 mb-4 align-items-center pt-2">
                                    <div class="exsit-rating-stars d-flex">
                                        <?php
                                        $rating = floatval($item['rating_value']);
                                        $full = round($rating);
                                        $empty = 5 - $full;

                                        // Full stars
                                        for ($i = 0; $i < $full; $i++) {
                                            \Elementor\Icons_Manager::render_icon($settings['rating_star_full'], ['aria-hidden' => 'true']);
                                        }

                                        // Empty stars
                                        for ($i = 0; $i < $empty; $i++) {
                                            \Elementor\Icons_Manager::render_icon($settings['rating_star_empty'], ['aria-hidden' => 'true']);
                                        }
                                        ?>
                                    </div>
                                    <!-- VALUE -->
                                    <span class="exsit-rating-value mb-0 d-inline-block pt-1">
                                        <?php echo esc_html($item['rating_value']); ?>
                                    </span>

                                </div>
                                <!-- TEXT -->
                                <p class="exsit-feedback-text mb-3">
                                    <?php echo esc_html($item['feedback_text']); ?>
                                </p>
                                <!-- Author -->
                                <div class="d-flex align-items-center gap-3 mt-5">
                                    <?php if (!empty($item['user_image']['url'])): ?>
                                        <img class="exsit-user-img rounded-circle" src="<?php echo esc_url($item['user_image']['url']); ?>"
                                            alt="">
                                    <?php endif; ?>

                                    <div>
                                        <div class="exsit-user-name">
                                            <?php echo esc_html($item['user_name']); ?>
                                        </div>
                                        <div class="exsit-user-role">
                                            <?php echo esc_html($item['user_role']); ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- RIGHT CONTENT -->
                            <div class="exsit-feedback-right text-lg-end ms-md-auto w-190 mt-auto pt-md-0 pt-3 d-lg-flex d-none">
                                <!-- IMAGE -->
                                <?php if (!empty($item['bg_image']['url'])): ?>
                                    <img loading="lazy" src="<?php echo esc_url($item['bg_image']['url']); ?>" alt=""
                                        class="w-100 overflow-hidden" style="border-radius: 100px;">
                                <?php endif; ?>
                            </div>

                        </div>

                    <?php elseif ($settings['layout_style'] === 'style4'): ?>

                        <div class="exsit-feedback-slide d-flex flex-column gap-4">
                            
                            <!-- CONTENT -->
                            <div class="feedback-content w-100 position-relative top-0 start-0 d-flex flex-column h-100 rounded-4" style="background-image: url(<?php echo esc_url($item['bg_image']['url']); ?>);">
                                <div class="row h-100">
                                    <div class="col-xl-5 col-lg-6 p-lg-5 p-4 h-100 d-flex flex-column justify-content-start">
                                        <!-- RATING -->
                                        <div class="d-flex flex-column gap-0 mb-0 ps-2 text-start justify-content-start">
                                            <!-- VALUE -->
                                            <span class="exsit-rating-value mb-0 d-inline-block pt-1">
                                                <?php echo esc_html($item['rating_value']); ?>
                                            </span>
                                            <div class="exsit-rating-stars d-flex">
                                                <?php
                                                $rating = floatval($item['rating_value']);
                                                $full = round($rating);
                                                $empty = 5 - $full;

                                                // Full stars
                                                for ($i = 0; $i < $full; $i++) {
                                                    \Elementor\Icons_Manager::render_icon($settings['rating_star_full'], ['aria-hidden' => 'true']);
                                                }

                                                // Empty stars
                                                for ($i = 0; $i < $empty; $i++) {
                                                    \Elementor\Icons_Manager::render_icon($settings['rating_star_empty'], ['aria-hidden' => 'true']);
                                                }
                                                ?>
                                            </div>

                                        </div>
                                        <!-- TEXT -->
                                        <p class="exsit-feedback-text ps-2 my-lg-5 my-4">
                                            <?php echo esc_html($item['feedback_text']); ?>
                                        </p>
                                        <!-- Author -->
                                        <div class="d-flex align-items-center gap-3 mt-auto ps-2">
                                            <div>
                                                <div class="exsit-user-name">
                                                    <?php echo esc_html($item['user_name']); ?>
                                                </div>
                                                <div class="exsit-user-role">
                                                    <?php echo esc_html($item['user_role']); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    <?php elseif ($settings['layout_style'] === 'style3'): ?>

                        <div class="exsit-feedback-slide position-relative">

                            <!-- CONTENT -->
                            <div class="d-flex flex-column w-100 z-5 position-relative rounded-4 bg-gray-800 p-4 bg-dark-gray">

                                <!-- RATING -->
                                <div class="d-flex flex-row gap-2 mb-4 align-items-center ps-2 pt-2">
                                    <div class="exsit-rating-stars d-flex">
                                        <?php
                                        $rating = floatval($item['rating_value']);
                                        $full = round($rating);
                                        $empty = 5 - $full;

                                        // Full stars
                                        for ($i = 0; $i < $full; $i++) {
                                            \Elementor\Icons_Manager::render_icon($settings['rating_star_full'], ['aria-hidden' => 'true']);
                                        }

                                        // Empty stars
                                        for ($i = 0; $i < $empty; $i++) {
                                            \Elementor\Icons_Manager::render_icon($settings['rating_star_empty'], ['aria-hidden' => 'true']);
                                        }
                                        ?>
                                    </div>
                                    <!-- VALUE -->
                                    <span class="exsit-rating-value mb-0 d-inline-block pt-1">
                                        <?php echo esc_html($item['rating_value']); ?>
                                    </span>

                                </div>

                                <!-- TEXT -->
                                <p class="exsit-feedback-text mb-3 ps-2">
                                    <?php echo esc_html($item['feedback_text']); ?>
                                </p>

                                <!-- Author -->
                                <div class="d-flex align-items-center gap-3 mt-5">
                                    <?php if (!empty($item['user_image']['url'])): ?>
                                        <img class="exsit-user-img rounded-circle" src="<?php echo esc_url($item['user_image']['url']); ?>"
                                            alt="">
                                    <?php endif; ?>

                                    <div>
                                        <div class="exsit-user-name">
                                            <?php echo esc_html($item['user_name']); ?>
                                        </div>
                                        <div class="exsit-user-role">
                                            <?php echo esc_html($item['user_role']); ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="#fff"
                                    class="bi bi-quote position-absolute bottom-0 end-0 opacity-25 m-4" viewBox="0 0 16 16">
                                    <path
                                        d="M12 12a1 1 0 0 0 1-1V8.558a1 1 0 0 0-1-1h-1.388q0-.527.062-1.054.093-.558.31-.992t.559-.683q.34-.279.868-.279V3q-.868 0-1.52.372a3.3 3.3 0 0 0-1.085.992 4.9 4.9 0 0 0-.62 1.458A7.7 7.7 0 0 0 9 7.558V11a1 1 0 0 0 1 1zm-6 0a1 1 0 0 0 1-1V8.558a1 1 0 0 0-1-1H4.612q0-.527.062-1.054.094-.558.31-.992.217-.434.559-.683.34-.279.868-.279V3q-.868 0-1.52.372a3.3 3.3 0 0 0-1.085.992 4.9 4.9 0 0 0-.62 1.458A7.7 7.7 0 0 0 3 7.558V11a1 1 0 0 0 1 1z" />
                                </svg>
                            </div>

                        </div>

                    <?php elseif ($settings['layout_style'] === 'style2'): ?>

                        <div class="exsit-feedback-slide position-relative">

                            <!-- IMAGE -->
                            <?php if (!empty($item['user_image']['url'])): ?>
                                <img loading="lazy" src="<?php echo esc_url($item['user_image']['url']); ?>" alt=""
                                    class="w-100 rounded-2 overflow-hidden">
                            <?php endif; ?>

                            <!-- CONTENT -->
                            <div class="p-4 d-flex flex-column position-absolute bottom-0 start-0 w-100 z-5">

                                <!-- TEXT -->
                                <p class="exsit-feedback-text mb-3 ps-2">
                                    <?php echo esc_html($item['feedback_text']); ?>
                                </p>

                                <!-- RATING -->
                                <div class="d-flex flex-row gap-2 mb-0 align-items-center ps-2">
                                    <div class="exsit-rating-stars d-flex">
                                        <?php
                                        $rating = floatval($item['rating_value']);
                                        $full = round($rating);
                                        $empty = 5 - $full;

                                        // Full stars
                                        for ($i = 0; $i < $full; $i++) {
                                            \Elementor\Icons_Manager::render_icon($settings['rating_star_full'], ['aria-hidden' => 'true']);
                                        }

                                        // Empty stars
                                        for ($i = 0; $i < $empty; $i++) {
                                            \Elementor\Icons_Manager::render_icon($settings['rating_star_empty'], ['aria-hidden' => 'true']);
                                        }
                                        ?>
                                    </div>
                                    <!-- VALUE -->
                                    <span class="exsit-rating-value mb-0 d-inline-block pt-1">
                                        <?php echo esc_html($item['rating_value']); ?>
                                    </span>

                                </div>

                            </div>

                        </div>

                    <?php else: ?>

                        <div class="exsit-feedback-slide d-flex flex-md-row flex-column gap-3">
                            <!-- LEFT CONTENT -->
                            <div class="exsit-feedback-left flex-1 d-flex flex-column">
                                <!-- Brand -->
                                <?php if (!empty($item['brand_image']['url'])): ?>
                                    <img class="exsit-brand-img mb-lg-3" src="<?php echo esc_url($item['brand_image']['url']); ?>" alt="">
                                <?php endif; ?>

                                <!-- Feedback -->
                                <p class="exsit-feedback-text my-4">
                                    <?php echo esc_html($item['feedback_text']); ?>
                                </p>

                                <!-- Author -->
                                <div class="d-flex align-items-center gap-3 mt-lg-3">
                                    <?php if (!empty($item['user_image']['url'])): ?>
                                        <img class="exsit-user-img rounded-circle" src="<?php echo esc_url($item['user_image']['url']); ?>"
                                            alt="">
                                    <?php endif; ?>

                                    <div>
                                        <div class="exsit-user-name">
                                            <?php echo esc_html($item['user_name']); ?>
                                        </div>
                                        <div class="exsit-user-role">
                                            <?php echo esc_html($item['user_role']); ?>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- RIGHT RATING -->
                            <div class="exsit-feedback-right text-lg-end ms-md-auto w-21 mt-auto pt-md-0 pt-3">
                                <span class="exsit-rating-value">
                                    <?php echo esc_html($item['rating_value']); ?>
                                </span>
                                <div class="exsit-rating-stars">
                                    <?php
                                    $rating = floatval($item['rating_value']);
                                    $full = round($rating);
                                    $empty = 5 - $full;

                                    // Full stars
                                    for ($i = 0; $i < $full; $i++) {
                                        \Elementor\Icons_Manager::render_icon($settings['rating_star_full'], ['aria-hidden' => 'true']);
                                    }

                                    // Empty stars
                                    for ($i = 0; $i < $empty; $i++) {
                                        \Elementor\Icons_Manager::render_icon($settings['rating_star_empty'], ['aria-hidden' => 'true']);
                                    }
                                    ?>

                                </div>
                                <p class="exsit-rating-count mb-0">
                                    <?php echo esc_html($item['rating_count']); ?>
                                </p>
                            </div>
                        </div>

                    <?php endif; ?>

                <?php endforeach; ?>

            </div>

        </div>

        <?php
    }
}