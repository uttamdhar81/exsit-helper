<?php
if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;

class Exsit_Feature_Slider extends Widget_Base
{

    public function get_name()
    {
        return 'exsit_feature_slider';
    }

    public function get_title()
    {
        return __('Vertical Slider', 'exsit-helper');
    }

    public function get_icon()
    {
        return 'eicon-slider-push';
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

        /*
        |--------------------------------------------------------------------------
        | SLIDES
        |--------------------------------------------------------------------------
        */

        $this->start_controls_section(
            'slides_section',
            [
                'label' => __('Slides', 'exsit-helper'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'bg_image',
            [
                'label'   => __('Background Image', 'exsit-helper'),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'badge_icon',
            [
                'label' => __('Badge Icon', 'exsit-helper'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $repeater->add_control(
            'badge_text',
            [
                'label'   => __('Badge Text', 'exsit-helper'),
                'type'    => Controls_Manager::TEXT,
                'default' => __('Quarterly Revenue analytics', 'exsit-helper'),
            ]
        );

        $repeater->add_control(
            'number',
            [
                'label'   => __('Large Number', 'exsit-helper'),
                'type'    => Controls_Manager::TEXT,
                'default' => __('8.7x', 'exsit-helper'),
            ]
        );

        $repeater->add_control(
            'number_text',
            [
                'label'   => __('Small Text', 'exsit-helper'),
                'type'    => Controls_Manager::TEXT,
                'default' => __('Fast response time', 'exsit-helper'),
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | FEATURE ITEMS
        |--------------------------------------------------------------------------
        */

        $feature_repeater = new Repeater();

        $feature_repeater->add_control(
            'feature_number',
            [
                'label'   => __('Feature Number', 'exsit-helper'),
                'type'    => Controls_Manager::TEXT,
                'default' => '1',
            ]
        );

        $feature_repeater->add_control(
            'feature_title',
            [
                'label'   => __('Feature Title', 'exsit-helper'),
                'type'    => Controls_Manager::TEXT,
                'default' => __('Marketing Strategy', 'exsit-helper'),
            ]
        );

        $feature_repeater->add_control(
            'feature_desc',
            [
                'label'   => __('Feature Description', 'exsit-helper'),
                'type'    => Controls_Manager::TEXTAREA,
                'default' => __('Our design services starts and ends with a best-in-class experience strategy.', 'exsit-helper'),
            ]
        );

        $repeater->add_control(
            'feature_items',
            [
                'label'       => __('Feature Items', 'exsit-helper'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $feature_repeater->get_controls(),
                'title_field' => '{{{ feature_title }}}',
            ]
        );

        $this->add_control(
            'slides',
            [
                'label'       => __('Slides', 'exsit-helper'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ badge_text }}}',
            ]
        );

        $this->end_controls_section();

        /*
        |--------------------------------------------------------------------------
        | SETTINGS
        |--------------------------------------------------------------------------
        */

        $this->start_controls_section(
            'settings_section',
            [
                'label' => __('Slider Settings', 'exsit-helper'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label'   => __('Autoplay', 'exsit-helper'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'dots',
            [
                'label'   => __('Dots', 'exsit-helper'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'arrows',
            [
                'label'   => __('Arrows', 'exsit-helper'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'false',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {

        $settings = $this->get_settings_for_display();

        if (empty($settings['slides'])) {
            return;
        }

        $autoplay = ($settings['autoplay'] === 'yes') ? 'true' : 'false';
        $dots     = ($settings['dots'] === 'yes') ? 'true' : 'false';
        $arrows   = ($settings['arrows'] === 'yes') ? 'true' : 'false';

?>
    <div class="exsit-feature-slider-wrapper">

        <!-- MAIN SLIDER -->
        <div class="exsit-feature-slider-main"
            data-autoplay="<?php echo esc_attr($autoplay); ?>"
            data-dots="<?php echo esc_attr($dots); ?>"
            data-arrows="<?php echo esc_attr($arrows); ?>">

            <?php foreach ($settings['slides'] as $slide): ?>

                <div class="exsit-feature-slide">

                    <div class="exsit-feature-image position-relative overflow-hidden rounded-4">

                        <?php
                        if (!empty($slide['bg_image']['id'])) {
                            echo wp_get_attachment_image(
                                $slide['bg_image']['id'],
                                'full',
                                false,
                                [
                                    'class' => 'w-100 exsit-feature-bg',
                                ]
                            );
                        }
                        ?>

                        <div class="exsit-feature-overlay"></div>

                        <div class="exsit-feature-top">

                            <div class="exsit-feature-badge">
                                <?php
                                if (!empty($slide['badge_icon']['value'])) {
                                    \Elementor\Icons_Manager::render_icon(
                                        $slide['badge_icon'],
                                        [
                                            'aria-hidden' => 'true',
                                            'class' => 'exsit-feature-badge-icon',
                                        ]
                                    );
                                }
                                ?>
                            </div>

                            <?php if (!empty($slide['badge_text'])): ?>
                                <span class="exsit-feature-badge-text">
                                    <?php echo esc_html($slide['badge_text']); ?>
                                </span>
                            <?php endif; ?>

                        </div>

                        <div class="exsit-feature-bottom">

                            <?php if (!empty($slide['number'])): ?>
                                <h2 class="exsit-feature-number">
                                    <?php echo esc_html($slide['number']); ?>
                                </h2>
                            <?php endif; ?>

                            <?php if (!empty($slide['number_text'])): ?>
                                <span class="exsit-feature-small-text">
                                    <?php echo esc_html($slide['number_text']); ?>
                                </span>
                            <?php endif; ?>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>


        <!-- THUMBNAIL NAVIGATION -->
        <div class="exsit-feature-slider-nav mt-4">

            <?php foreach ($settings['slides'] as $slide): ?>

                <?php
                $feature = !empty($slide['feature_items'][0])
                    ? $slide['feature_items'][0]
                    : '';
                ?>

                <?php if (!empty($feature)): ?>

                    <div class="exsit-feature-thumb">

                        <div class="exsit-feature-card">

                            <div class="exsit-feature-card-number">
                                <?php echo esc_html($feature['feature_number']); ?>
                            </div>

                            <div class="exsit-feature-card-content">

                                <h4 class="exsit-feature-card-title">
                                    <?php echo esc_html($feature['feature_title']); ?>
                                </h4>

                                <p class="exsit-feature-card-desc">
                                    <?php echo esc_html($feature['feature_desc']); ?>
                                </p>

                            </div>

                        </div>

                    </div>

                <?php endif; ?>

            <?php endforeach; ?>

        </div>

    </div>

<?php
    }
}