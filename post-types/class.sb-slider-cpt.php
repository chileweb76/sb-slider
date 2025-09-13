
<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if (! class_exists('SB_Slider_Post_Type')) {
    class SB_Slider_Post_Type
    {
        public function __construct()
        {
            add_action('init', [$this, 'create_post_type']);
            add_action('add_meta_boxes', [$this, 'add_meta_boxes']);
            add_action('save_post', [$this, 'save_post'], 10, 2);
            add_filter('manage_sb_slider_posts_columns', [$this, 'sb_slider_cpt_columns']);
            add_action('manage_sb_slider_posts_custom_column', [$this, 'sb_slider_custom_columns'], 10, 6);
            add_filter('manage_edit-sb_slider_sortable_columns', [$this, 'sb_slider_sortable_columns']);
        }

        public function create_post_type()
        {
            register_post_type(
                'sb_slider',
                [
                    'label'               => esc_html__('Slider', 'sb-slider'),
                    'description'         => esc_html__('Sliders', 'sb-slider'),
                    'labels'              => [
                        'name'          => esc_html__('Sliders', 'sb-slider'),
                        'singular_name' => esc_html__('Slider', 'sb-slider'),
                    ],
                    'public'              => true,
                    'supports'            => ['title', 'editor', 'thumbnail'],
                    'hierarchical'        => false,
                    'show_ui'             => true,
                    'show_in_menu'        => false,
                    'menu_position'       => 5,
                    'show_in_admin_bar'   => true,
                    'show_in_nav_menus'   => true,
                    'can_export'          => true,
                    'has_archive'         => false,
                    'exclude_from_search' => false,
                    'publicly_queryable'  => true,
                    'show_in_rest'        => true,
                    'menu_icon'           => 'dashicons-images-alt2',

                ]
            );
        }

        public function sb_slider_cpt_columns($columns)
        {
            $columns['sb_slider_link_text_left']   = esc_html__('Left Link Text', 'scrapbook-slider');
            $columns['sb_slider_link_url_left']    = esc_html__('Left Link URL', 'scrapbook-slider');
            $columns['sb_slider_link_text_center'] = esc_html__('Center Link Text', 'scrapbook-slider');
            $columns['sb_slider_link_url_center']  = esc_html__('Center Link URL', 'scrapbook-slider');
            $columns['sb_slider_link_text_right']  = esc_html__('Right Link Text', 'scrapbook-slider');
            $columns['sb_slider_link_url_right']   = esc_html__('Right Link URL', 'scrapbook-slider');

            $columns['sb_slider_link_text_bottom_left']   = esc_html__('Bottom Left Link Text', 'scrapbook-slider');
            $columns['sb_slider_link_url_bottom_left']    = esc_html__('Bottom Left Link URL', 'scrapbook-slider');
            $columns['sb_slider_link_text_bottom_center'] = esc_html__('Bottom Center Link Text', 'scrapbook-slider');
            $columns['sb_slider_link_url_bottom_center']  = esc_html__('Bottom Center Link URL', 'scrapbook-slider');
            $columns['sb_slider_link_text_bottom_right']  = esc_html__('Bottom Right Link Text', 'scrapbook-slider');
            $columns['sb_slider_link_url_bottom_right']   = esc_html__('Bottom Right Link URL', 'scrapbook-slider');
            return $columns;

        }

        public function sb_slider_custom_columns($column, $post_id)
        {
            switch ($column) {
                case 'sb_slider_link_text_left':
                    echo esc_html(get_post_meta($post_id, 'sb_slider_link_text_left', true));
                    break;
                case 'sb_slider_link_url_left':
                    echo esc_url(get_post_meta($post_id, 'sb_slider_link_url_left', true));
                    break;
                case 'sb_slider_link_text_center':
                    echo esc_html(get_post_meta($post_id, 'sb_slider_link_text_center', true));
                    break;
                case 'sb_slider_link_url_center':
                    echo esc_url(get_post_meta($post_id, 'sb_slider_link_url_center', true));
                    break;
                case 'sb_slider_link_text_right':
                    echo esc_html(get_post_meta($post_id, 'sb_slider_link_text_right', true));
                    break;
                case 'sb_slider_link_url_right':
                    echo esc_url(get_post_meta($post_id, 'sb_slider_link_url_right', true));
                    break;
                case 'sb_slider_link_text_bottom_left':
                    echo esc_html(get_post_meta($post_id, 'sb_slider_link_text_bottom_left', true));
                    break;
                case 'sb_slider_link_url_bottom_left':
                    echo esc_url(get_post_meta($post_id, 'sb_slider_link_url_bottom_left', true));
                    break;
                case 'sb_slider_link_text_bottom_center':
                    echo esc_html(get_post_meta($post_id, 'sb_slider_link_text_bottom_center', true));
                    break;
                case 'sb_slider_link_url_bottom_center':
                    echo esc_url(get_post_meta($post_id, 'sb_slider_link_url_bottom_center', true));
                    break;
                case 'sb_slider_link_text_bottom_right':
                    echo esc_html(get_post_meta($post_id, 'sb_slider_link_text_bottom_right', true));
                    break;
                case 'sb_slider_link_url_bottom_right':
                    echo esc_url(get_post_meta($post_id, 'sb_slider_link_url_bottom_right', true));
                    break;
            }
        }

        public function sb_slider_sortable_columns($colums)
        {
            $columns['sb_slider_link_text_left']          = esc_html__('sb_slider_link_text_left', 'scrapbook-slider');
            $columns['sb_slider_link_text_center']        = esc_html__('sb_slider_link_text_center', 'scrapbook-slider');
            $columns['sb_slider_link_text_right']         = esc_html__('sb_slider_link_text_right', 'scrapbook-slider');
            $columns['sb_slider_link_text_bottom_left']   = esc_html__('sb_slider_link_text_bottom_left', 'scrapbook-slider');
            $columns['sb_slider_link_text_bottom_center'] = esc_html__('sb_slider_link_text_bottom_center', 'scrapbook-slider');
            $columns['sb_slider_link_text_bottom_right']  = esc_html__('sb_slider_link_text_bottom_right', 'scrapbook-slider');
            return $columns;
        }

        public function add_meta_boxes()
        {
            add_meta_box(
                'sb_slider_meta_box',
                esc_html__('Link Options', 'sb-slider'),
                [$this, 'add_inner_meta_boxes'],
                'sb_slider',
                'normal',
                'high'
            );
        }

        public function add_inner_meta_boxes($post)
        {
            require_once SB_SLIDER_PATH . 'views/sb-slider_metabox.php';
        }

        public function save_post($post_id)
        {

            // Check if this is an autosave
            if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
                return;
            }

            // Check nonce
            if (!isset($_POST['sb_slider_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['sb_slider_nonce'])), 'sb_slider_nonce')) {
                return;
            }

            // Check user permissions
            if (!current_user_can('edit_post', $post_id)) {
                return;
            }

            if (isset($_POST['action']) && $_POST['action'] === 'editpost') {
                $old_link_text_left          = get_post_meta($post_id, 'sb_slider_link_text_left', true);
                $old_link_text_center        = get_post_meta($post_id, 'sb_slider_link_text_center', true);
                $old_link_text_right         = get_post_meta($post_id, 'sb_slider_link_text_right', true);
                $old_link_text_bottom_left   = get_post_meta($post_id, 'sb_slider_link_text_bottom_left', true);
                $old_link_text_bottom_center = get_post_meta($post_id, 'sb_slider_link_text_bottom_center', true);
                $old_link_text_bottom_right  = get_post_meta($post_id, 'sb_slider_link_text_bottom_right', true);
                // Sanitize text fields if provided
                $new_link_text_left = isset($_POST['sb_slider_link_text_left']) ? sanitize_text_field(wp_unslash($_POST['sb_slider_link_text_left'])) : $old_link_text_left;
                $new_link_text_center = isset($_POST['sb_slider_link_text_center']) ? sanitize_text_field(wp_unslash($_POST['sb_slider_link_text_center'])) : $old_link_text_center;
                $new_link_text_right = isset($_POST['sb_slider_link_text_right']) ? sanitize_text_field(wp_unslash($_POST['sb_slider_link_text_right'])) : $old_link_text_right;
                $new_link_text_bottom_left = isset($_POST['sb_slider_link_text_bottom_left']) ? sanitize_text_field(wp_unslash($_POST['sb_slider_link_text_bottom_left'])) : $old_link_text_bottom_left;
                $new_link_text_bottom_center = isset($_POST['sb_slider_link_text_bottom_center']) ? sanitize_text_field(wp_unslash($_POST['sb_slider_link_text_bottom_center'])) : $old_link_text_bottom_center;
                $new_link_text_bottom_right = isset($_POST['sb_slider_link_text_bottom_right']) ? sanitize_text_field(wp_unslash($_POST['sb_slider_link_text_bottom_right'])) : $old_link_text_bottom_right;

                $old_link_url_left          = get_post_meta($post_id, 'sb_slider_link_url_left', true);
                $old_link_url_center        = get_post_meta($post_id, 'sb_slider_link_url_center', true);
                $old_link_url_right         = get_post_meta($post_id, 'sb_slider_link_url_right', true);
                $old_link_url_bottom_left   = get_post_meta($post_id, 'sb_slider_link_url_bottom_left', true);
                $old_link_url_bottom_center = get_post_meta($post_id, 'sb_slider_link_url_bottom_center', true);
                $old_link_url_bottom_right  = get_post_meta($post_id, 'sb_slider_link_url_bottom_right', true);

                // Sanitize/validate URLs if provided - store raw sanitized URL
                $new_link_url_left = isset($_POST['sb_slider_link_url_left']) ? esc_url_raw(wp_unslash($_POST['sb_slider_link_url_left'])) : $old_link_url_left;
                $new_link_url_center = isset($_POST['sb_slider_link_url_center']) ? esc_url_raw(wp_unslash($_POST['sb_slider_link_url_center'])) : $old_link_url_center;
                $new_link_url_right = isset($_POST['sb_slider_link_url_right']) ? esc_url_raw(wp_unslash($_POST['sb_slider_link_url_right'])) : $old_link_url_right;
                $new_link_url_bottom_left = isset($_POST['sb_slider_link_url_bottom_left']) ? esc_url_raw(wp_unslash($_POST['sb_slider_link_url_bottom_left'])) : $old_link_url_bottom_left;
                // handle possible misspelled field name from original code
                $bottom_center_field = isset($_POST['sb_slider_link_url_bottom_center']) ? 'sb_slider_link_url_bottom_center' : (isset($_POST['sb_slider_link_url_buttom_center']) ? 'sb_slider_link_url_buttom_center' : null);
                if ($bottom_center_field) {
                    $new_link_url_bottom_center = esc_url_raw(wp_unslash($_POST[$bottom_center_field]));
                } else {
                    $new_link_url_bottom_center = $old_link_url_bottom_center;
                }
                $new_link_url_bottom_right = isset($_POST['sb_slider_link_url_bottom_right']) ? esc_url_raw(wp_unslash($_POST['sb_slider_link_url_bottom_right'])) : $old_link_url_bottom_right;

                update_post_meta($post_id, 'sb_slider_link_text_left', $new_link_text_left, $old_link_text_left);
                update_post_meta($post_id, 'sb_slider_link_text_center', $new_link_text_center, $old_link_text_center);
                update_post_meta($post_id, 'sb_slider_link_text_right', $new_link_text_right, $old_link_text_right);
                update_post_meta($post_id, 'sb_slider_link_text_bottom_left', $new_link_text_bottom_left, $old_link_text_bottom_left);
                update_post_meta($post_id, 'sb_slider_link_text_bottom_center', $new_link_text_bottom_center, $old_link_text_bottom_center);
                update_post_meta($post_id, 'sb_slider_link_text_bottom_right', $new_link_text_bottom_right, $old_link_text_bottom_right);

                if (empty($new_link_url_left)) {
                    update_post_meta($post_id, "sb_slider_link_url_left", '#');
                } else {
                    update_post_meta($post_id, 'sb_slider_link_url_left', $new_link_url_left, $old_link_url_left);
                }
                if (empty($new_link_url_center)) {
                    update_post_meta($post_id, "sb_slider_link_url_center", '#');
                } else {
                    update_post_meta($post_id, 'sb_slider_link_url_center', $new_link_url_center, $old_link_url_center);
                }
                if (empty($new_link_url_right)) {
                    update_post_meta($post_id, "sb_slider_link_url_right", '#');
                } else {
                    update_post_meta($post_id, 'sb_slider_link_url_right', $new_link_url_right, $old_link_url_right);
                }

                if (empty($new_link_url_bottom_left)) {
                    update_post_meta($post_id, "sb_slider_link_url_bottom_left", '#');
                } else {
                    update_post_meta($post_id, 'sb_slider_link_url_bottom_left', $new_link_url_bottom_left, $old_link_url_bottom_left);
                }
                if (empty($new_link_url_bottom_center)) {
                    update_post_meta($post_id, "sb_slider_link_url_bottom_center", '#');
                } else {
                    update_post_meta($post_id, 'sb_slider_link_url_bottom_center', $new_link_url_bottom_center, $old_link_url_bottom_center);
                }
                if (empty($new_link_url_bottom_right)) {
                    update_post_meta($post_id, "sb_slider_link_url_bottom_right", '#');
                } else {
                    update_post_meta($post_id, 'sb_slider_link_url_bottom_right', $new_link_url_bottom_right, $old_link_url_bottom_right);
                }

            }
        }

    }
}
