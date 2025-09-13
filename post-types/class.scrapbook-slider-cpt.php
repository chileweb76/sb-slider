<?php

if (! class_exists('scrapbook_Slider_Post_Type')) {
    class Scrapbook_Slider_Post_Type
    {
        public function __construct()
        {
            add_action('init', [$this, 'create_post_type']);
            add_action('add_meta_boxes', [$this, 'add_meta_boxes']);
            add_action('save_post', [$this, 'save_post'], 10, 2);
            add_filter('manage_scrapbook-slider_posts_columns', [$this, 'scrapbook_slider_cpt_columns']);
            add_action('manage_scrapbook-slider_posts_custom_column', [$this, 'scrapbook_slider_custom_columns'], 10, 6);
            add_filter('manage_edit-scrapbook-slider_sortable_columns', [$this, 'scrapbook_slider_sortable_columns']);
        }

        public function create_post_type()
        {
            register_post_type(
                'scrapbook-slider',
                [
                    'label'               => esc_html__('Slider', 'scrapbook-slider'),
                    'description'         => esc_html__('Sliders', 'scrapbook-slider'),
                    'labels'              => [
                        'name'          => esc_html__('Sliders', 'scrapbook-slider'),
                        'singular_name' => esc_html__('Slider', 'scrapbook-slider'),
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

        public function scrapbook_slider_cpt_columns($columns)
        {
            $columns['scrapbook_slider_link_text_left']   = esc_html__('Left Link Text', 'scrapbook-slider');
            $columns['scrapbook_slider_link_url_left']    = esc_html__('Left Link URL', 'scrapbook-slider');
            $columns['scrapbook_slider_link_text_center'] = esc_html__('Center Link Text', 'scrapbook-slider');
            $columns['scrapbook_slider_link_url_center']  = esc_html__('Center Link URL', 'scrapbook-slider');
            $columns['scrapbook_slider_link_text_right']  = esc_html__('Right Link Text', 'scrapbook-slider');
            $columns['scrapbook_slider_link_url_right']   = esc_html__('Right Link URL', 'scrapbook-slider');

            $columns['scrapbook_slider_link_text_bottom_left']   = esc_html__('Bottom Left Link Text', 'scrapbook-slider');
            $columns['scrapbook_slider_link_url_bottom_left']    = esc_html__('Bottom Left Link URL', 'scrapbook-slider');
            $columns['scrapbook_slider_link_text_bottom_center'] = esc_html__('Bottom Center Link Text', 'scrapbook-slider');
            $columns['scrapbook_slider_link_url_bottom_center']  = esc_html__('Bottom Center Link URL', 'scrapbook-slider');
            $columns['scrapbook_slider_link_text_bottom_right']  = esc_html__('Bottom Right Link Text', 'scrapbook-slider');
            $columns['scrapbook_slider_link_url_bottom_right']   = esc_html__('Bottom Right Link URL', 'scrapbook-slider');
            return $columns;

        }

        public function scrapbook_slider_custom_columns($column, $post_id)
        {
            switch ($column) {
                case 'scrapbook_slider_link_text_left':
                    echo esc_html(get_post_meta($post_id, 'scrapbook_slider_link_text_left', true));
                    break;
                case 'scrapbook_slider_link_url_left':
                    echo esc_url(get_post_meta($post_id, 'scrapbook_slider_link_url_left', true));
                    break;
                case 'scrapbook_slider_link_text_center':
                    echo esc_html(get_post_meta($post_id, 'scrapbook_slider_link_text_center', true));
                    break;
                case 'scrapbook_slider_link_url_center':
                    echo esc_url(get_post_meta($post_id, 'scrapbook_slider_link_url_center', true));
                    break;
                case 'scrapbook_slider_link_text_right':
                    echo esc_html(get_post_meta($post_id, 'scrapbook_slider_link_text_right', true));
                    break;
                case 'scrapbook_slider_link_url_right':
                    echo esc_url(get_post_meta($post_id, 'scrapbook_slider_link_url_right', true));
                    break;
                case 'scrapbook_slider_link_text_bottom_left':
                    echo esc_html(get_post_meta($post_id, 'scrapbook_slider_link_text_bottom_left', true));
                    break;
                case 'scrapbook_slider_link_url_bottom_left':
                    echo esc_url(get_post_meta($post_id, 'scrapbook_slider_link_url_bottom_left', true));
                    break;
                case 'scrapbook_slider_link_text_bottom_center':
                    echo esc_html(get_post_meta($post_id, 'scrapbook_slider_link_text_bottom_center', true));
                    break;
                case 'scrapbook_slider_link_url_bottom_center':
                    echo esc_url(get_post_meta($post_id, 'scrapbook_slider_link_url_bottom_center', true));
                    break;
                case 'scrapbook_slider_link_text_bottom_right':
                    echo esc_html(get_post_meta($post_id, 'scrapbook_slider_link_text_bottom_right', true));
                    break;
                case 'scrapbook_slider_link_url_bottom_right':
                    echo esc_url(get_post_meta($post_id, 'scrapbook_slider_link_url_bottom_right', true));
                    break;
            }
        }

        public function scrapbook_slider_sortable_columns($colums)
        {
            $columns['scrapbook_slider_link_text_left']          = esc_html__('scrapbook_slider_link_text_left', 'scrapbook-slider');
            $columns['scrapbook_slider_link_text_center']        = esc_html__('scrapbook_slider_link_text_center', 'scrapbook-slider');
            $columns['scrapbook_slider_link_text_right']         = esc_html__('scrapbook_slider_link_text_right', 'scrapbook-slider');
            $columns['scrapbook_slider_link_text_bottom_left']   = esc_html__('scrapbook_slider_link_text_bottom_left', 'scrapbook-slider');
            $columns['scrapbook_slider_link_text_bottom_center'] = esc_html__('scrapbook_slider_link_text_bottom_center', 'scrapbook-slider');
            $columns['scrapbook_slider_link_text_bottom_right']  = esc_html__('scrapbook_slider_link_text_bottom_right', 'scrapbook-slider');
            return $columns;
        }

        public function add_meta_boxes()
        {
            add_meta_box(
                'scrapbook_slider_meta_box',
                esc_html__('Link Options', 'scrapbook-slider'),
                [$this, 'add_inner_meta_boxes'],
                'scrapbook-slider',
                'normal',
                'high'
            );
        }

        public function add_inner_meta_boxes($post)
        {
            require_once SCRAPBOOK_SLIDER_PATH . 'views/scrapbook-slider_metabox.php';
        }

        public function save_post($post_id)
        {
   
                if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
                    return;
                } 

                if (isset($_POST['post_type']) && $_POST['post_type'] === 'scrapbook-slider') {
                    if (! current_user_can('edit_page', $post_id)) {
                        return;
                    } elseif (! current_user_can('edit_post', $post_id)) {
                        return;
                    }
                }

                if (empty(sanitize_text_field(wp_unslash($_POST['scrapbook_slider_nonce'])))) {
                    $scrapbook_slider_none = sanitize_text_field(wp_unslash($_POST['scrapbook_slider_nonce']));
                }

                if (empty( wp_verify_nonce($scrapbook_slider_none))) {

                if (isset($_POST['action']) && $_POST['action'] = 'editpost') {

                    $old_link_text_left = get_post_meta( $post_id, 'scrapbook_slider_link_text_left', true);
            
                    $old_link_text_center = get_post_meta( $post_id, 'scrapbook_slider_link_text_center', true);

                    $old_link_text_right = get_post_meta( $post_id, 'scrapbook_slider_link_text_right', true);

                    $old_link_text_bottom_left = get_post_meta( $post_id, 'scrapbook_slider_link_text_bottom_left', true);

                    $old_link_text_bottom_center = get_post_meta( $post_id, 'scrapbook_slider_link_text_bottom_center', true);

                    $old_link_text_bottom_right = get_post_meta( $post_id, 'scrapbook_slider_link_text_bottom_right', true);

                    /* left text */
                    if( empty(  sanitize_text_field(wp_unslash($_POST['scrapbook_slider_link_text_left'])))) {
                        update_post_meta( $post_id, 'scrapbook_slider_link_text_left', esc_html(''));
                    }else{    
                        update_post_meta( $post_id, 'scrapbook_slider_link_text_left', ( sanitize_text_field(wp_unslash($_POST['scrapbook_slider_link_text_left']))), $old_link_text_left);
                    } 

                    /* center text */
                    if( empty( sanitize_text_field(wp_unslash($_POST['scrapbook_slider_link_text_center'])))) {
                        update_post_meta( $post_id, 'scrapbook_slider_link_text_center', esc_html('' ));
                    }else{ 
                        update_post_meta( $post_id, 'scrapbook_slider_link_text_center', ( sanitize_text_field(wp_unslash($_POST['scrapbook_slider_link_text_center']))), $old_link_text_center);
                    } 

                    /* right text */
                    if( empty( sanitize_text_field( wp_unslash( $_POST['scrapbook_slider_link_text_right'])))) {
                        update_post_meta( $post_id, 'scrapbook_slider_link_text_right', esc_html(''));
                    }else{ 
                        update_post_meta( $post_id, 'scrapbook_slider_link_text_right', ( sanitize_text_field(wp_unslash($_POST['scrapbook_slider_link_text_right']))), $old_link_text_right);
                    } 

                    /* bottom left text */
                    if( empty( sanitize_text_field(wp_unslash($_POST['scrapbook_slider_link_text_bottom_left'])))) {
                        update_post_meta( $post_id, 'scrapbook_slider_link_text_bottom_left', esc_html(''));
                    }else{ 
                        update_post_meta( $post_id, 'scrapbook_slider_link_text_bottom_left', ( sanitize_text_field(wp_unslash($_POST['scrapbook_slider_link_text_bottom_left']))), $old_link_text_bottom_left);
                    } 

                    /* bottom center text */
                    if( empty( sanitize_text_field( wp_unslash($_POST['scrapbook_slider_link_text_bottom_center'])))) {
                        update_post_meta( $post_id, 'scrapbook_slider_link_text_bottom_center', esc_html(''));
                    }else{ 
                        update_post_meta( $post_id, 'scrapbook_slider_link_text_bottom_center', ( sanitize_text_field(wp_unslash($_POST['scrapbook_slider_link_text_bottom_center']))), $old_link_text_bottom_center);
                    } 

                    /* bottom right text */
                    if( empty(  sanitize_text_field(wp_unslash($_POST['scrapbook_slider_link_text_bottom_right'])))) {
                        update_post_meta( $post_id, 'scrapbook_slider_link_text_bottom_right', esc_html(''));
                    }else{ 
                        update_post_meta( $post_id, 'scrapbook_slider_link_text_bottom_right', ( sanitize_text_field(wp_unslash($_POST['scrapbook_slider_link_text_bottom_right']))), $old_link_text_bottom_right);
                    } 

                    $old_link_url_left = get_post_meta( $post_id, 'scrapbook_slider_url_text_left', true);

                    $old_link_url_center = get_post_meta( $post_id, 'scrapbook_slider_link_url_center', true);

                    $old_link_url_right = get_post_meta( $post_id, 'scrapbook_slider_link_url_right', true);

                    $old_link_url_bottom_left = get_post_meta( $post_id, 'scrapbook_slider_link_url_bottom_left', true);

                    $old_link_url_bottom_center = get_post_meta( $post_id, 'scrapbook_slider_link_url_bottom_center', true);

                    $old_link_url_bottom_right = get_post_meta( $post_id, 'scrapbook_slider_link_url_bottom_right', true);

                    /* left url */
                    if( empty(  sanitize_url(wp_unslash($_POST['scrapbook_slider_link_url_left'])))) {
                        update_post_meta( $post_id, 'scrapbook_slider_link_url_left', '#' );
                    }else{
                        update_post_meta( $post_id, 'scrapbook_slider_link_url_left', ( sanitize_url(wp_unslash($_POST['scrapbook_slider_link_url_left']))), $old_link_url_left );
                    }

                    /* center url */
                    if( empty( sanitize_url( wp_unslash($_POST['scrapbook_slider_link_url_center'])))) {
                        update_post_meta( $post_id, 'scrapbook_slider_link_url_center', '#' );
                    }else{
                        update_post_meta( $post_id, 'scrapbook_slider_link_url_center', (sanitize_url(wp_unslash( $_POST['scrapbook_slider_link_url_center']))), $old_link_url_center );
                    }

                    /* right url */
                    if( empty(  sanitize_url(wp_unslash($_POST['scrapbook_slider_link_url_right'])))) {
                        update_post_meta( $post_id, 'scrapbook_slider_link_url_right', '#' );
                    }else{
                        update_post_meta( $post_id, 'scrapbook_slider_link_url_right', ( sanitize_url(wp_unslash($_POST['scrapbook_slider_link_url_right']))), $old_link_url_right );
                    }

                    /* bottom left url */
                    if( empty(  sanitize_url(wp_unslash($_POST['scrapbook_slider_link_url_bottom_left'])))) {
                        update_post_meta( $post_id, 'scrapbook_slider_link_url_bottom_left', '#' );
                    }else{
                        update_post_meta( $post_id, 'scrapbook_slider_link_url_bottom_left', (sanitize_url(wp_unslash( $_POST['scrapbook_slider_link_url_bottom_left']))), $old_link_url_bottom_left );
                    }

                    /* bottom center url */
                    if( empty(  sanitize_url(wp_unslash($_POST['scrapbook_slider_link_url_bottom_center'])))) {
                        update_post_meta( $post_id, 'scrapbook_slider_link_url_bottom_center', '#' );
                    }else{
                        update_post_meta( $post_id, 'scrapbook_slider_link_url_bottom_center', ( sanitize_url(wp_unslash($_POST['scrapbook_slider_link_url_bottom_center']))), $old_link_url_bottom_center );
                    }

                    /* bottom right url */
                    if( empty(  sanitize_url(wp_unslash($_POST['scrapbook_slider_link_url_bottom_right'])))) {
                        update_post_meta( $post_id, 'scrapbook_slider_link_url_bottom_right', '#' );
                    }else{
                        update_post_meta( $post_id, 'scrapbook_slider_link_url_bottom_right', ( sanitize_url(wp_unslash($_POST['scrapbook_slider_link_url_bottom_right']))), $old_link_url_bottom_right );
                    }
                }

            } elseif (isset($_POST['submitted'])) {
                die('Nonce is missing');
            }
                
        }
        

    }
}
