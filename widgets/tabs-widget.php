<?php
if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

class Exsit_Tabs_Widget extends Widget_Base
{

    public function get_name()
    {
        return 'exsit_tabs';
    }

    public function get_title()
    {
        return __('Tabs', 'exsit-helper');
    }

    public function get_icon()
    {
        return 'eicon-tabs';
    }

    public function get_categories()
    {
        return ['exsit-category'];
    }

    public function get_script_depends()
    {
        return ['exsit-tabs'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'tabs_section',
            [
                'label' => __('Tabs', 'exsit-helper'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'tab_title',
            [
                'label' => __('Tab Title', 'exsit-helper'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Tab Title', 'exsit-helper'),
            ]
        );

        $this->add_control(
            'tabs',
            [
                'label' => __('Tabs', 'exsit-helper'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    ['tab_title' => 'Analytics'],
                    ['tab_title' => 'Develop'],
                    ['tab_title' => 'Marketing'],
                ],
                'title_field' => '{{{ tab_title }}}',
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {

        $settings = $this->get_settings_for_display();

        ?>

        <div class="exsit-tabs-widget">

            <div class="exsit-tabs-nav">

                <?php foreach ($settings['tabs'] as $index => $tab): ?>

                    <button class="exsit-tab-btn <?php echo $index == 0 ? 'active' : ''; ?>"
                        data-tab="tab-<?php echo esc_attr($index); ?>">

                        <?php echo esc_html($tab['tab_title']); ?>

                    </button>

                <?php endforeach; ?>

            </div>

            <div class="exsit-tabs-content">

                <?php foreach ($settings['tabs'] as $index => $tab): ?>

                    <div class="exsit-tab-panel <?php echo $index == 0 ? 'active' : ''; ?>"
                        id="tab-<?php echo esc_attr($index); ?>">

                        <?php
                        echo '<div class="elementor-container">';
                        echo '<p>Add Elementor widgets here (custom content)</p>';
                        echo '</div>';
                        ?>

                    </div>

                <?php endforeach; ?>

            </div>

        </div>

        <?php
    }
}