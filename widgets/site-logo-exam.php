<?php
namespace Lonyo\Widgets;

if (!defined('ABSPATH')) {
    exit;
}
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Typography;
use \Elementor\Widget_Base;
// Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Lonyo_Site_Logo extends Widget_Base
{

    /**
     * Retrieve the widget name.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'lonyo-logo';
    }


    /**
     * Retrieve the widget title.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return __('Site Logo', 'lonyo-addons');
    }

    /**
     * Retrieve the widget icon.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'mas eicon-image';
    }

    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * Note that currently Elementor supports only one category.
     * When multiple categories passed, Elementor uses the first one.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories()
    {
        return ['lonyo-addons'];
    }

    /**
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function register_controls()
    {
        $this->start_controls_section(
            'section_layout',
            [
                'label' => __('Layout', 'lonyo-addons'),
            ]
        );

        $this->add_control(
			'logo_type',
			[
				'label' => __( 'Logo Type', 'lonyo-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'dark',
				'options' => [
					'dark'  => __( 'Dark', 'lonyo-addons' ),
					'white' => __( 'White', 'lonyo-addons' ),
					'custom' => __( 'Custom', 'lonyo-addons' ),
				],
			]
        );
        
        $this->add_control(
            'image',
            [
                'label' => __('Choose logo', 'lonyo-addons'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
                'condition' => [
                    'logo_type' => 'custom',
                ]
            ]
        );

        $this->add_group_control(
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
                'label' => __('Align', 'lonyo-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'lonyo-addons'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('top', 'lonyo-addons'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'lonyo-addons'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'lonyo_class' => 'content-align%s-',
                'toggle' => true,
            ]
        );

        $this->add_responsive_control(
            'image_width',
            [
                'label' => __('Image width', 'lonyo-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .ama-site-logo img' => 'width: {{SIZE}}{{UNIT}};',
                ]

            ]
        );



        $this->end_controls_section();
    }

    /**
     * Render the widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render()
    {

        $settings = $this->get_settings();

?>
        <div class="ama-site-logo content-align-<?php echo $settings['content_align'] ?>">
            <a href="<?php echo home_url(); ?>" class="ama-site-logo-wrap">
                <?php
				
				echo "<span class='site-logo'>";
                if ( 'custom' == $settings['logo_type'] && $settings['image']['url']) {
                    echo \Elementor\Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail', 'image');
                } else {
                    echo $this->lonyo_get_site_logo( $settings['logo_type'] );
                }
				echo '</span>'
                
                ?>
            </a>

        </div>
<?php

    }


    /**
     * 
     *  Mas get logo  
     * 
     */
    public function lonyo_get_site_logo( $logo_type = 'dark' ) {
        $logo = '';
        $logo_url = '';
    
        if( class_exists( 'CSF' ) ) {
			$darklogo = null !== lonyo_opt('dark_logo') ? lonyo_opt('dark_logo') : '';
			$whitelogo =  null !== lonyo_opt('white_logo') ? lonyo_opt('white_logo') : '';
		 }


        if ( 'dark' == $logo_type ) {
           
            $logo_url = esc_url( $darklogo['url'] );
            $logo = '<img src="' . $logo_url . '" alt="' . esc_attr( get_bloginfo('title') ) . '" class="navbar-brand__regular dark-logo">';
        } elseif ( 'white' == $logo_type ) {
            
            $logo_url = esc_url( $whitelogo['url'] );

            $logo = '<img src="' . $logo_url . '" alt="' . esc_attr( get_bloginfo('title') ) . '" class="navbar-brand__regular white-logo">';
        } else {
            if ( has_custom_logo() ) {
                $core_logo_id = get_theme_mod('custom_logo');
                $logo_data = wp_get_attachment_image_src( $core_logo_id, 'full' );
    
                // Ensure the array contains a URL before accessing it
                if ( is_array( $logo_data ) && ! empty( $logo_data[0] ) ) {
                    $logo_url = esc_url( $logo_data[0] );
                    $logo = '<img src="' . $logo_url . '" alt="' . esc_attr( get_bloginfo('title') ) . '" class="navbar-brand__regular">';
                }
            } else {
                $logo = '<h1 class="navbar-brand__regular">' . get_bloginfo('name') . '</h1>';
            }
        }
    
        return $logo;
    }
    
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Lonyo\Widgets\Lonyo_Site_Logo() );