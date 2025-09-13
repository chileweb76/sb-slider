
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
            add_action('manage_sb_slider_posts_custom_column', [$this, 'sb_slider_custom_columns'], 10, 2);
            add_filter('manage_edit-sb_slider_sortable_columns', [$this, 'sb_slider_sortable_columns']);
        }

    public function create_post_type(): void
        {
            register_post_type(
                'sb_slider',
                [
                    'labels'              => [
                            'name'          => esc_html__('SB Sliders', 'sb-slider'),
                            'singular_name' => esc_html__('SB Slider', 'sb-slider'),
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

    /**
     * @param array<string,string> $columns
     * @return array<string,string>
     */
    public function sb_slider_cpt_columns(array $columns): array
        {
            $columns['sb_slider_link_text_left']   = esc_html__('Left Link Text', 'sb-slider');
            $columns['sb_slider_link_url_left']    = esc_html__('Left Link URL', 'sb-slider');
            $columns['sb_slider_link_text_center'] = esc_html__('Center Link Text', 'sb-slider');
            $columns['sb_slider_link_url_center']  = esc_html__('Center Link URL', 'sb-slider');
            $columns['sb_slider_link_text_right']  = esc_html__('Right Link Text', 'sb-slider');
            $columns['sb_slider_link_url_right']   = esc_html__('Right Link URL', 'sb-slider');

            $columns['sb_slider_link_text_bottom_left']   = esc_html__('Bottom Left Link Text', 'sb-slider');
            $columns['sb_slider_link_url_bottom_left']    = esc_html__('Bottom Left Link URL', 'sb-slider');
            $columns['sb_slider_link_text_bottom_center'] = esc_html__('Bottom Center Link Text', 'sb-slider');
            $columns['sb_slider_link_url_bottom_center']  = esc_html__('Bottom Center Link URL', 'sb-slider');
            $columns['sb_slider_link_text_bottom_right']  = esc_html__('Bottom Right Link Text', 'sb-slider');
            $columns['sb_slider_link_url_bottom_right']   = esc_html__('Bottom Right Link URL', 'sb-slider');
            return $columns;

        }

    /**
     * @param string $column
     * @param int $post_id
     * @return void
     */
    public function sb_slider_custom_columns(string $column, int $post_id): void
        {
            switch ($column) {
                case 'sb_slider_link_text_left':
                    echo esc_html( $this->get_meta_string( $post_id, 'sb_slider_link_text_left' ) );
                    break;
                case 'sb_slider_link_url_left':
                    echo esc_url( $this->get_meta_string( $post_id, 'sb_slider_link_url_left' ) );
                    break;
                case 'sb_slider_link_text_center':
                    echo esc_html( $this->get_meta_string( $post_id, 'sb_slider_link_text_center' ) );
                    break;
                case 'sb_slider_link_url_center':
                    echo esc_url( $this->get_meta_string( $post_id, 'sb_slider_link_url_center' ) );
                    break;
                case 'sb_slider_link_text_right':
                    echo esc_html( $this->get_meta_string( $post_id, 'sb_slider_link_text_right' ) );
                    break;
                case 'sb_slider_link_url_right':
                    echo esc_url( $this->get_meta_string( $post_id, 'sb_slider_link_url_right' ) );
                    break;
                case 'sb_slider_link_text_bottom_left':
                    echo esc_html( $this->get_meta_string( $post_id, 'sb_slider_link_text_bottom_left' ) );
                    break;
                case 'sb_slider_link_url_bottom_left':
                    echo esc_url( $this->get_meta_string( $post_id, 'sb_slider_link_url_bottom_left' ) );
                    break;
                case 'sb_slider_link_text_bottom_center':
                    echo esc_html( $this->get_meta_string( $post_id, 'sb_slider_link_text_bottom_center' ) );
                    break;
                case 'sb_slider_link_url_bottom_center':
                    echo esc_url( $this->get_meta_string( $post_id, 'sb_slider_link_url_bottom_center' ) );
                    break;
                case 'sb_slider_link_text_bottom_right':
                    echo esc_html( $this->get_meta_string( $post_id, 'sb_slider_link_text_bottom_right' ) );
                    break;
                case 'sb_slider_link_url_bottom_right':
                    echo esc_url( $this->get_meta_string( $post_id, 'sb_slider_link_url_bottom_right' ) );
                    break;
            }
        }

    /**
     * Return a meta value cast to string when possible.
     *
     * @param int $post_id
     * @param string $key
     * @return string
     */
    private function get_meta_string( int $post_id, string $key ): string
    {
        $val = get_post_meta( $post_id, $key, true );
        if ( is_scalar( $val ) ) {
            return (string) $val;
        }
        return '';
    }

    /**
     * @param array<string,string> $columns
     * @return array<string,string>
     */
    public function sb_slider_sortable_columns(array $columns): array
        {
            $columns['sb_slider_link_text_left']          = 'sb_slider_link_text_left';
            $columns['sb_slider_link_text_center']        = 'sb_slider_link_text_center';
            $columns['sb_slider_link_text_right']         = 'sb_slider_link_text_right';
            $columns['sb_slider_link_text_bottom_left']   = 'sb_slider_link_text_bottom_left';
            $columns['sb_slider_link_text_bottom_center'] = 'sb_slider_link_text_bottom_center';
            $columns['sb_slider_link_text_bottom_right']  = 'sb_slider_link_text_bottom_right';
            return $columns;
        }

    public function add_meta_boxes(): void
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

        /**
         * @param \WP_Post|null $post
         * @return void
         */
        public function add_inner_meta_boxes($post = null): void
        {
            require_once SB_SLIDER_PATH . 'views/sb-slider_metabox.php';
        }

    public function save_post(int $post_id, ?\WP_Post $post = null): void
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
