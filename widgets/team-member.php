<?php
if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;

class Exsit_Team_Member_Widget extends Widget_Base
{

    public function get_name()
    {
        return 'exsit-team-member';
    }

    public function get_title()
    {
        return __('Team Member', 'exsit-helper');
    }

    public function get_icon()
    {
        return 'eicon-person';
    }

    public function get_categories()
    {
        return ['exsit-helper'];
    }

    public function get_keywords()
    {
        return ['team', 'member', 'profile', 'staff'];
    }

    protected function register_controls()
    {

        /*-----------------------------------
        TEAM MEMBER
        -----------------------------------*/

        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Team Member', 'exsit-helper'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'member_image',
            [
                'label' => __('Image', 'exsit-helper'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'member_name',
            [
                'label' => __('Name', 'exsit-helper'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Goria Coast', 'exsit-helper'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'member_position',
            [
                'label' => __('Position', 'exsit-helper'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Founder and CEO', 'exsit-helper'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'card_style',
            [
                'label' => __('Card Style', 'exsit-helper'),
                'type' => Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [
                    'style1' => __('Card Style 1', 'exsit-helper'),
                    'style2' => __('Card Style 2', 'exsit-helper'),
                ],
            ]
        );

        $this->end_controls_section();



        /*-----------------------------------
        SOCIAL ICONS
        -----------------------------------*/

        $this->start_controls_section(
            'social_section',
            [
                'label' => __('Social Icons', 'exsit-helper'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'social_icon',
            [
                'label' => __('Icon', 'exsit-helper'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fab fa-facebook-f',
                    'library' => 'fa-brands',
                ],
            ]
        );

        $repeater->add_control(
            'social_link',
            [
                'label' => __('Link', 'exsit-helper'),
                'type' => Controls_Manager::URL,
                'placeholder' => 'https://your-link.com',
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $repeater->add_control(
            'icon_color',
            [
                'label' => __('Icon Color', 'exsit-helper'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
            ]
        );

        $repeater->add_control(
            'icon_hover_color',
            [
                'label' => __('Hover Color', 'exsit-helper'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ff0000',
            ]
        );

        $this->add_control(
            'social_icons',
            [
                'label' => __('Social Icons', 'exsit-helper'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => 'Social Icon',
            ]
        );

        $this->end_controls_section();



        /*-----------------------------------
        STYLE TAB
        -----------------------------------*/

        $this->start_controls_section(
            'icon_style_section',
            [
                'label' => __('Icon Style', 'exsit-helper'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => __('Icon Size', 'exsit-helper'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 80,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .exsit-team-member .social-wrap i' => 'font-size: {{SIZE}}px;',
                    '{{WRAPPER}} .exsit-team-member .social-wrap svg' => 'width: {{SIZE}}px; height: {{SIZE}}px;',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_section',
            [
                'label' => __('Style', 'exsit-helper'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        /* -----------------------------
        MEMBER NAME STYLE
        ----------------------------- */

        $this->add_control(
            'member_name_heading',
            [
                'label' => __('Member Name', 'exsit-helper'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'member_name_typography',
                'selector' => '{{WRAPPER}} .exsit-member-name',
            ]
        );

        $this->add_control(
            'member_name_color',
            [
                'label' => __('Color', 'exsit-helper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .exsit-member-name' => 'color: {{VALUE}};',
                ],
            ]
        );


        /* -----------------------------
        MEMBER POSITION STYLE
        ----------------------------- */

        $this->add_control(
            'member_position_heading',
            [
                'label' => __('Member Position', 'exsit-helper'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'member_position_typography',
                'selector' => '{{WRAPPER}} .exsit-member-position',
            ]
        );

        $this->add_control(
            'member_position_color',
            [
                'label' => __('Color', 'exsit-helper'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .exsit-member-position' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }



    /*-----------------------------------
    RENDER
    -----------------------------------*/

    protected function render()
    {

        $settings = $this->get_settings_for_display();
        $layout_class = ($settings['card_style'] === 'style1')
            ? 'text-center'
            : 'text-start position-absolute bottom-0 start-0 p-4 w-100 pb-3';

        ?>

        <div class="exsit-team-member d-flex flex-column gap-3 member-wrap">

            <div class="overflow-hidden rounded-4 position-relative image-zoom-onhover">

                <img src="<?php echo esc_url($settings['member_image']['url']); ?>"
                    alt="<?php echo esc_attr($settings['member_name']); ?>" class="w-100 img-fluid" loading="lazy">

                <?php if (!empty($settings['social_icons'])): ?>

                    <div class="social-wrap social-wrap-box position-absolute top-4">

                        <ul class="d-flex flex-column gap-2 ms-3">

                            <?php foreach ($settings['social_icons'] as $index => $item):

                                $icon_color = !empty($item['icon_color']) ? $item['icon_color'] : '#000';
                                $hover_color = !empty($item['icon_hover_color']) ? $item['icon_hover_color'] : '#ff0000';

                                ?>

                                <li class="mb-1">

                                    <a href="<?php echo esc_url($item['social_link']['url']); ?>"
                                        style="color: <?php echo esc_attr($icon_color); ?>;"
                                        onmouseover="this.style.color='<?php echo esc_attr($hover_color); ?>'"
                                        onmouseout="this.style.color='<?php echo esc_attr($icon_color); ?>'">

                                        <?php
                                        Icons_Manager::render_icon(
                                            $item['social_icon'],
                                            ['aria-hidden' => 'true']
                                        );
                                        ?>

                                    </a>

                                </li>

                            <?php endforeach; ?>

                        </ul>

                    </div>

                <?php endif; ?>

            </div>

            <div class="<?php echo esc_attr($layout_class); ?>">

                <?php if (!empty($settings['member_name'])): ?>
                    <h3 class="exsit-member-name">
                        <?php echo esc_html($settings['member_name']); ?>
                    </h3>
                <?php endif; ?>

                <?php if (!empty($settings['member_position'])): ?>
                    <span class="exsit-member-position">
                        <?php echo esc_html($settings['member_position']); ?>
                    </span>
                <?php endif; ?>

            </div>

        </div>

        <?php
    }
    

}