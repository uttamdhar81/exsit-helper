<?php
if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Exsit_Team_Member_Widget extends Widget_Base
{

    public function get_name()
    {
        return 'exsit-team-member';
    }

    public function get_title()
    {
        return __('Team Member', 'exsit-addons');
    }

    public function get_icon()
    {
        return 'eicon-person';
    }

    public function get_categories()
    {
        return ['general'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'exsit-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'member_image',
            [
                'label' => __('Image', 'exsit-addons'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
            ]
        );

        $this->add_control(
            'member_name',
            [
                'label' => __('Name', 'exsit-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => __('John Doe', 'exsit-addons'),
            ]
        );

        $this->add_control(
            'member_position',
            [
                'label' => __('Position', 'exsit-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => __('CEO', 'exsit-addons'),
            ]
        );

        $this->add_control(
            'linkedin',
            [
                'label' => __('LinkedIn URL', 'exsit-addons'),
                'type' => Controls_Manager::URL,
            ]
        );

        $this->add_control(
            'twitch',
            [
                'label' => __('Twitch URL', 'exsit-addons'),
                'type' => Controls_Manager::URL,
            ]
        );

        $this->add_control(
            'twitter',
            [
                'label' => __('Twitter URL', 'exsit-addons'),
                'type' => Controls_Manager::URL,
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {

        $settings = $this->get_settings_for_display();
        ?>

        <div class="d-flex flex-column gap-3">

            <div class="overflow-hidden rounded-4 position-relative image-zoom-onhover">

                <img src="<?php echo esc_url($settings['member_image']['url']); ?>"
                    alt="<?php echo esc_attr($settings['member_name']); ?>" class="w-100 img-fluid">

                <div class="social-wrap social-wrap-box position-absolute top-4">

                    <ul class="d-flex flex-column gap-2 ms-3">

                        <?php if (!empty($settings['linkedin']['url'])): ?>
                            <li>
                                <a href="<?php echo esc_url($settings['linkedin']['url']); ?>">
                                    LinkedIn
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php if (!empty($settings['twitch']['url'])): ?>
                            <li>
                                <a href="<?php echo esc_url($settings['twitch']['url']); ?>">
                                    Twitch
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php if (!empty($settings['twitter']['url'])): ?>
                            <li>
                                <a href="<?php echo esc_url($settings['twitter']['url']); ?>">
                                    Twitter
                                </a>
                            </li>
                        <?php endif; ?>

                    </ul>

                </div>

            </div>

            <div class="text-center">
                <h3 class="text-gray-900 display3-size fw-600 mb-0">
                    <?php echo esc_html($settings['member_name']); ?>
                </h3>

                <p class="text-gray-700 fw-500 fs-16 mb-0">
                    <?php echo esc_html($settings['member_position']); ?>
                </p>
            </div>

        </div>

        <?php
    }

}