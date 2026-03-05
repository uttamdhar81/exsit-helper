<?php
/**
 * Exsit Helper Functions
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Social Sharing Buttons
 */
if (!function_exists('exsit_social_sharing_buttons')) {

    function exsit_social_sharing_buttons()
    {

        $url = get_permalink();
        $title = rawurlencode(get_the_title());

        $twitterURL = 'https://twitter.com/share?text=' . esc_attr($title) . '&url=' . esc_url($url);
        $facebookURL = 'https://www.facebook.com/sharer/sharer.php?u=' . esc_url($url);
        $pinterestURL = 'https://pinterest.com/pin/create/link/?url=' . esc_url($url) . '&media=' . esc_url(get_the_post_thumbnail_url()) . '&description=' . esc_attr(get_the_title());
        $linkedinURL = 'https://www.linkedin.com/shareArticle?mini=true&url=' . esc_url($url) . '&title=' . esc_attr($title);

        $output = '';
        $output .= '<li><a class="facebook" href="' . esc_url($facebookURL) . '" target="_blank" rel="noopener"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16"><path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/></svg></a></li>';
        $output .= '<li><a class="twitter" href="' . esc_url($twitterURL) . '" target="_blank" rel="noopener"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-twitter-x" viewBox="0 0 16 16"><path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z"/></svg></a></li>';
        $output .= '<li><a class="pinterest" href="' . esc_url($pinterestURL) . '" target="_blank" rel="noopener"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-pinterest" viewBox="0 0 16 16"><path d="M8 0a8 8 0 0 0-2.915 15.452c-.07-.633-.134-1.606.027-2.297.146-.625.938-3.977.938-3.977s-.239-.479-.239-1.187c0-1.113.645-1.943 1.448-1.943.682 0 1.012.512 1.012 1.127 0 .686-.437 1.712-.663 2.663-.188.796.4 1.446 1.185 1.446 1.422 0 2.515-1.5 2.515-3.664 0-1.915-1.377-3.254-3.342-3.254-2.276 0-3.612 1.707-3.612 3.471 0 .688.265 1.425.595 1.826a.24.24 0 0 1 .056.23c-.061.252-.196.796-.222.907-.035.146-.116.177-.268.107-1-.465-1.624-1.926-1.624-3.1 0-2.523 1.834-4.84 5.286-4.84 2.775 0 4.932 1.977 4.932 4.62 0 2.757-1.739 4.976-4.151 4.976-.811 0-1.573-.421-1.834-.919l-.498 1.902c-.181.695-.669 1.566-.995 2.097A8 8 0 1 0 8 0"/></svg></a></li>';
        $output .= '<li><a class="linkedin" href="' . esc_url($linkedinURL) . '" target="_blank" rel="noopener"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16"><path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z"/></svg></a></li>';

        return $output;
    }
}

/**
 * Allow SVG Uploads
 */
if (!function_exists('exsit_mime_types')) {
    function exsit_mime_types($mimes)
    {
        $mimes['svg'] = 'image/svg+xml';
        $mimes['svgz'] = 'image/svgz+xml';
        return $mimes;
    }
    add_filter('upload_mimes', 'exsit_mime_types');
}

/**
 * Fix SVG upload check
 */
if (!function_exists('exsit_wp_check_filetype_and_ext')) {
    function exsit_wp_check_filetype_and_ext($data, $file, $filename, $mimes)
    {
        $wp_filetype = wp_check_filetype($filename, $mimes);
        return array(
            'ext' => $wp_filetype['ext'],
            'type' => $wp_filetype['type'],
            'proper_filename' => $data['proper_filename'],
        );
    }
    add_filter('wp_check_filetype_and_ext', 'exsit_wp_check_filetype_and_ext', 10, 4);
}

/**
 * One Click Demo Import – After Import Hook
 */
if (!function_exists('exsit_after_content_import_execution')) {
    function exsit_after_content_import_execution($selected_import_files, $import_files, $selected_index)
    {

        if (!class_exists('OCDI\Downloader')) {
            return;
        }

        $downloader = new OCDI\Downloader();

        if (!empty($import_files[$selected_index]['import_json'])) {

            foreach ($import_files[$selected_index]['import_json'] as $index => $import) {

                $file_path = $downloader->download_file(
                    $import['file_url'],
                    'exsit-demo-json-' . $index . '-' . date('Y-m-d__H-i-s') . '.json'
                );

                $file_raw = OCDI\Helpers::data_from_file($file_path);
                update_option($import['option_name'], json_decode($file_raw, true));
            }

        } elseif (!empty($import_files[$selected_index]['local_import_json'])) {

            foreach ($import_files[$selected_index]['local_import_json'] as $index => $import) {
                $file_raw = OCDI\Helpers::data_from_file($import['file_path']);
                update_option($import['option_name'], json_decode($file_raw, true));
            }
        }
    }
    add_action('ocdi/after_content_import_execution', 'exsit_after_content_import_execution', 3, 99);
}

/**
 * Remote Demo Base URL
 */
if (!function_exists('get_exsit_url')) {
    function get_exsit_url()
    {
        return 'https://yourdomain.com/exsit-demo/';
    }
}


add_action('wp_ajax_exsit_load_more_posts', 'exsit_load_more_posts');
add_action('wp_ajax_nopriv_exsit_load_more_posts', 'exsit_load_more_posts');

function exsit_load_more_posts()
{

    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $posts_per_page = intval($_POST['posts_per_page']);
    $image_size = sanitize_text_field($_POST['image_size']);
    $excerpt_length = intval($_POST['excerpt_length']);

    $args = [
        'post_type' => 'post',
        'posts_per_page' => $posts_per_page,
        'paged' => $paged
    ];

    $query = new WP_Query($args);

    if ($query->have_posts()):

        while ($query->have_posts()):
            $query->the_post(); ?>

            <div class="col-lg-12 mb-4">

                <a href="<?php the_permalink(); ?>" class="rounded-4 overflow-hidden d-flex flex-row gap-3 post-blog-card">

                    <?php if (has_post_thumbnail()): ?>
                        <div class="post-image scale-img overflow-hidden flex-shrink-0 rounded-4">
                            <?php the_post_thumbnail($image_size, [
                                'class' => 'w-100 h-100 d-block object-fit-cover',
                                'loading' => 'lazy'
                            ]); ?>
                        </div>
                    <?php endif; ?>

                    <div class="post-content d-flex flex-column p-3 bg-white overflow-hidden z-5">

                        <div class="post-blog-tag d-flex flex-row">
                            <span><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></span>
                            <span class="mx-1">•</span>
                            <span><?php echo ceil(str_word_count(strip_tags(get_the_content())) / 200); ?> min read</span>
                        </div>

                        <h3 class="post-blog-title mt-2 mb-2">
                            <?php the_title(); ?>
                        </h3>

                        <p class="post-blog-excerpt mb-2">
                            <?php echo wp_trim_words(get_the_excerpt(), $excerpt_length); ?>
                        </p>

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

        <?php endwhile;

    endif;

    wp_reset_postdata();
    wp_die();
}