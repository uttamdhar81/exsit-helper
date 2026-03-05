<?php
if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class Exsit_Blog_Card_Widget extends Widget_Base
{

    public function get_name()
    {
        return 'exsit-blog-card';
    }

    public function get_title()
    {
        return __('Blog Card', 'exsit-addons');
    }

    public function get_icon()
    {
        return 'eicon-posts-grid';
    }

    public function get_categories()
    {
        return ['exsit-addons'];
    }

    protected function register_controls()
    {

        /* ---------------------------
        LAYOUT
        ----------------------------*/

        $this->start_controls_section(
            'layout_section',
            [
                'label' => __('Layout', 'exsit-addons'),
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
            'posts_per_page',
            [
                'label' => __('Posts Per Page', 'exsit-addons'),
                'type' => Controls_Manager::NUMBER,
                'default' => 3,
            ]
        );

        $this->add_control(
            'columns',
            [
                'label' => __('Columns', 'exsit-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '1' => '1 Column',
                    '2' => '2 Columns',
                    '3' => '3 Columns',
                ],
            ]
        );

        $this->add_control(
            'image_size',
            [
                'label' => __('Image Resolution', 'exsit-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'large',
                'options' => [
                    'thumbnail' => __('Thumbnail', 'exsit-addons'),
                    'medium' => __('Medium', 'exsit-addons'),
                    'large' => __('Large', 'exsit-addons'),
                    'full' => __('Full', 'exsit-addons'),
                ],
            ]
        );

        $this->add_responsive_control(
            'image_ratio',
            [
                'label' => __('Image Ratio', 'exsit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0.1,
                        'max' => 2,
                        'step' => 0.01,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0.72,
                ],
                'selectors' => [
                    '{{WRAPPER}} .post-image' => 'aspect-ratio: 1 / {{SIZE}};',
                ],
                'condition' => [
                    'layout_style' => 'style1'
                ]
            ]
        );

        $this->add_responsive_control(
            'style2_image_width',
            [
                'label' => __('Image Width', 'exsit-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 80,
                        'max' => 400,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 220,
                ],
                'selectors' => [
                    '{{WRAPPER}} .post-blog-style2 .post-image' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'layout_style' => 'style2'
                ]
            ]
        );

        $this->end_controls_section();

        /* ---------------------------
        EXCERPT
        ----------------------------*/

        $this->start_controls_section(
            'excerpt_section',
            [
                'label' => __('Excerpt', 'exsit-addons'),
            ]
        );

        $this->add_control(
            'show_excerpt',
            [
                'label' => __('Show Excerpt', 'exsit-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'exsit-addons'),
                'label_off' => __('Hide', 'exsit-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'excerpt_length',
            [
                'label' => __('Excerpt Length', 'exsit-addons'),
                'type' => Controls_Manager::NUMBER,
                'default' => 24,
                'condition' => [
                    'show_excerpt' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();


        /* ---------------------------
        QUERY
        ----------------------------*/

        $this->start_controls_section(
            'query_section',
            [
                'label' => __('Query', 'exsit-addons'),
            ]
        );

        $this->add_control(
            'source',
            [
                'label' => __('Source', 'exsit-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'latest',
                'options' => [
                    'latest' => __('Latest Posts', 'exsit-addons'),
                    'manual' => __('Manual Selection', 'exsit-addons'),
                    'exclude' => __('Exclude Posts', 'exsit-addons'),
                ],
            ]
        );

        $this->add_control(
            'posts_ids',
            [
                'label' => __('Search & Select', 'exsit-addons'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'label_block' => true,
                'options' => $this->get_posts(),
                'condition' => [
                    'source' => 'manual'
                ]
            ]
        );

        $this->add_control(
            'exclude_posts',
            [
                'label' => __('Exclude Posts', 'exsit-addons'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'label_block' => true,
                'options' => $this->get_posts(),
                'condition' => [
                    'source' => 'exclude'
                ]
            ]
        );

        $this->add_control(
            'order_by',
            [
                'label' => __('Order By', 'exsit-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'date' => 'Date',
                    'title' => 'Title',
                    'rand' => 'Random'
                ],
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => __('Order', 'exsit-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'DESC',
                'options' => [
                    'ASC' => 'ASC',
                    'DESC' => 'DESC'
                ],
            ]
        );

        $this->end_controls_section();


        /* ---------------------------
        PAGINATION
        ----------------------------*/

        $this->start_controls_section(
            'pagination_section',
            [
                'label' => __('Pagination', 'exsit-addons'),
            ]
        );

        $this->add_control(
            'pagination',
            [
                'label' => __('Enable Pagination', 'exsit-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'exsit-addons'),
                'label_off' => __('No', 'exsit-addons'),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->add_control(
            'pagination_type',
            [
                'label' => __('Pagination Type', 'exsit-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'numbers',
                'options' => [
                    'numbers' => __('Numbers', 'exsit-addons'),
                    'loadmore' => __('Load More Button', 'exsit-addons'),
                ],
                'condition' => [
                    'pagination' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'load_more_text',
            [
                'label' => __('Load More Text', 'exsit-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Load More', 'exsit-addons'),
                'condition' => [
                    'pagination' => 'yes',
                    'pagination_type' => 'loadmore'
                ]
            ]
        );

        $this->end_controls_section();


        /* ---------------------------
        STYLE - TITLE
        ----------------------------*/

        $this->start_controls_section(
            'card_style_section',
            [
                'label' => __('Card', 'exsit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        /* Border */

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'card_border',
                'selector' => '{{WRAPPER}} .post-blog-card',
            ]
        );

        /* Border Radius */

        $this->add_responsive_control(
            'card_border_radius',
            [
                'label' => __('Border Radius', 'exsit-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .post-blog-card' =>
                        'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        /* Box Shadow */

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'card_shadow',
                'selector' => '{{WRAPPER}} .post-blog-card',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'title_style',
            [
                'label' => __('Post Title', 'exsit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __('Color', 'exsit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-blog-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .post-blog-title',
            ]
        );


        $this->end_controls_section();


        /* ---------------------------
        AUTHOR NAME STYLE
        ----------------------------*/

        $this->start_controls_section(
            'author_style',
            [
                'label' => __('Author Name', 'exsit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'author_color',
            [
                'label' => __('Color', 'exsit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-blog-author' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'author_typography',
                'selector' => '{{WRAPPER}} .post-blog-author',
            ]
        );

        $this->end_controls_section();


        /* ---------------------------
        AUTHOR ROLE STYLE
        ----------------------------*/

        $this->start_controls_section(
            'author_role_style',
            [
                'label' => __('Author Role', 'exsit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'author_role_color',
            [
                'label' => __('Color', 'exsit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-blog-author-role' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'author_role_typography',
                'selector' => '{{WRAPPER}} .post-blog-author-role',
            ]
        );

        $this->end_controls_section();

        /* ---------------------------
        STYLE - META
        ----------------------------*/

        $this->start_controls_section(
            'meta_style',
            [
                'label' => __('Post Meta', 'exsit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'meta_color',
            [
                'label' => __('Color', 'exsit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-blog-tag' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'meta_typography',
                'selector' => '{{WRAPPER}} .post-blog-tag',
            ]
        );

        $this->end_controls_section();

        /* ---------------------------
        STYLE - EXCERPT
        ----------------------------*/

        $this->start_controls_section(
            'excerpt_style',
            [
                'label' => __('Excerpt Text', 'exsit-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'excerpt_color',
            [
                'label' => __('Color', 'exsit-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-blog-excerpt' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'excerpt_typography',
                'selector' => '{{WRAPPER}} .post-blog-excerpt',
            ]
        );

        $this->end_controls_section();

    }


    /* ---------------------------
    GET POSTS
    ----------------------------*/

    private function get_posts()
    {

        $posts = get_posts(['numberposts' => -1]);
        $options = [];

        foreach ($posts as $post) {
            $options[$post->ID] = $post->post_title;
        }

        return $options;

    }


    /* ---------------------------
    RENDER
    ----------------------------*/

    protected function render()
    {

        $settings = $this->get_settings_for_display();

        if ($settings['layout_style'] === 'style2') {
            $this->render_style2($settings);
        } else {
            $this->render_style1($settings);
        }

    }


    /* ---------------------------
    STYLE 1
    ----------------------------*/

    protected function render_style1($settings)
    {

        $paged = get_query_var('paged') ? get_query_var('paged') : 1;

        $args = [
            'post_type' => 'post',
            'posts_per_page' => $settings['posts_per_page'],
            'orderby' => $settings['order_by'],
            'order' => $settings['order'],
            'paged' => $paged,
        ];

        if ($settings['source'] === 'manual' && !empty($settings['posts_ids'])) {
            $args['post__in'] = $settings['posts_ids'];
        }

        if ($settings['source'] === 'exclude' && !empty($settings['exclude_posts'])) {
            $args['post__not_in'] = $settings['exclude_posts'];
        }

        $query = new WP_Query($args);

        if (!$query->have_posts())
            return;

        ?>

        <div class="row post-blog-wrapper">

            <?php while ($query->have_posts()):
                $query->the_post(); ?>

                <div class="col-lg-<?php echo 12 / $settings['columns']; ?> mb-4">

                    <a href="<?php the_permalink(); ?>"
                        class="border border-gray-200 rounded-4 overflow-hidden d-flex flex-column shadow-hover-lg post-blog-card">

                        <?php if (has_post_thumbnail()): ?>
                            <div class="post-image scale-img overflow-hidden">
                                <?php the_post_thumbnail($settings['image_size'], [
                                    'class' => 'w-100 h-100 d-block object-fit-cover',
                                    'loading' => 'lazy'
                                ]); ?>
                            </div>
                        <?php endif; ?>

                        <div class="post-content d-flex flex-column p-3 bg-white overflow-hidden z-5">

                            <div class="post-blog-tag d-flex flex-row">
                                <span><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></span>
                                <span class="mx-1">•</span>
                                <span><?php echo $this->get_read_time(); ?> min read</span>
                            </div>

                            <h3 class="post-blog-title mt-2 mb-2">
                                <?php the_title(); ?>
                            </h3>

                            <?php if ($settings['show_excerpt'] === 'yes'): ?>
                                <p class="post-blog-excerpt mb-2">
                                    <?php echo wp_trim_words(get_the_excerpt(), $settings['excerpt_length']); ?>
                                </p>
                            <?php endif; ?>

                            <div class="d-flex flex-row gap-3 mt-2">
                                <div>
                                    <?php echo get_avatar(get_the_author_meta('ID'), 40, '', '', [
                                        'class' => 'rounded-circle'
                                    ]); ?>
                                </div>
                                <div class="d-flex flex-column">

                                    <span class="post-blog-author">
                                        <?php the_author(); ?>
                                    </span>

                                    <span class="post-blog-author-role">
                                        <?php
                                        $user = get_userdata(get_the_author_meta('ID'));
                                        $roles = $user->roles;
                                        $role = !empty($roles) ? ucfirst($roles[0]) : __('Author', 'exsit');

                                        echo esc_html($role);
                                        ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

            <?php endwhile; ?>

        </div>



        <?php
        if ($settings['pagination'] === 'yes' && $settings['pagination_type'] === 'numbers'):
            ?>

            <div class="post-pagination">

                <?php
                echo paginate_links([
                    'total' => $query->max_num_pages,
                    'current' => $paged,
                ]);
                ?>

            </div>

        <?php endif; ?>

        <?php
        wp_reset_postdata();

    }


    protected function render_style2($settings)
    {
        $paged = get_query_var('paged') ? get_query_var('paged') : 1;

        $args = [
            'post_type' => 'post',
            'posts_per_page' => $settings['posts_per_page'],
            'orderby' => $settings['order_by'],
            'order' => $settings['order'],
            'paged' => $paged,
        ];

        if ($settings['source'] === 'manual' && !empty($settings['posts_ids'])) {
            $args['post__in'] = $settings['posts_ids'];
        }

        if ($settings['source'] === 'exclude' && !empty($settings['exclude_posts'])) {
            $args['post__not_in'] = $settings['exclude_posts'];
        }

        $query = new WP_Query($args);

        if (!$query->have_posts())
            return;

        ?>

        <div class="row post-blog-wrapper post-blog-style2">

            <?php while ($query->have_posts()):
                $query->the_post(); ?>

                <div class="col-lg-12 mb-4">

                    <a href="<?php the_permalink(); ?>" class="rounded-4 overflow-hidden d-flex flex-row gap-3 post-blog-card">

                        <?php if (has_post_thumbnail()): ?>
                            <div class="post-image scale-img overflow-hidden flex-shrink-0 overflow-hidden rounded-4">
                                <?php the_post_thumbnail($settings['image_size'], [
                                    'class' => 'w-100 h-100 d-block object-fit-cover',
                                    'loading' => 'lazy'
                                ]); ?>
                            </div>
                        <?php endif; ?>

                        <div class="post-content d-flex flex-column p-3 bg-white overflow-hidden z-5">

                            <div class="post-blog-tag d-flex flex-row">
                                <span><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></span>
                                <span class="mx-1">•</span>
                                <span><?php echo $this->get_read_time(); ?> min read</span>
                            </div>

                            <h3 class="post-blog-title mt-2 mb-2">
                                <?php the_title(); ?>
                            </h3>

                            <?php if ($settings['show_excerpt'] === 'yes'): ?>
                                <p class="post-blog-excerpt mb-2">
                                    <?php echo wp_trim_words(get_the_excerpt(), $settings['excerpt_length']); ?>
                                </p>
                            <?php endif; ?>

                            <div class="d-flex flex-row gap-3 mt-2">
                                <div>
                                    <?php echo get_avatar(get_the_author_meta('ID'), 40, '', '', [
                                        'class' => 'rounded-circle'
                                    ]); ?>
                                </div>
                                <div class="d-flex flex-column">

                                    <span class="post-blog-author">
                                        <?php the_author(); ?>
                                    </span>

                                    <span class="post-blog-author-role">
                                        <?php
                                        $user = get_userdata(get_the_author_meta('ID'));
                                        $roles = $user->roles;
                                        $role = !empty($roles) ? ucfirst($roles[0]) : __('Author', 'exsit');

                                        echo esc_html($role);
                                        ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

            <?php endwhile; ?>

        </div>

        <?php if ($settings['pagination'] === 'yes'): ?>

            <div class="post-pagination">

                <?php if ($settings['pagination_type'] === 'numbers'): ?>

                    <?php
                    echo paginate_links([
                        'total' => $query->max_num_pages,
                        'current' => $paged,
                    ]);
                    ?>

                <?php elseif ($settings['pagination_type'] === 'loadmore'): ?>

                    <button class="post-load-more-btn" data-page="<?php echo esc_attr($paged); ?>"
                        data-max="<?php echo esc_attr($query->max_num_pages); ?>">
                        <?php echo esc_html($settings['load_more_text']); ?>
                    </button>

                <?php endif; ?>

            </div>

        <?php endif; ?>

        <?php
        wp_reset_postdata();
    }


    private function get_read_time()
    {

        $content = get_post_field('post_content', get_the_ID());

        $word_count = str_word_count(strip_tags($content));

        $readingtime = ceil($word_count / 200);

        return $readingtime;

    }

}