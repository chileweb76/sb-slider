<?php

/**
 *Plugin Name: Scrapbook Slider
 *Plugin URI:
 *Description: A slider designed to show latest product with buttons to go to stores for purchase.
 *Version: 1.0
 *Requires at least: 6.8
 *Author: Christopher Hile
 *Author URI: https://christopherhile.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *Text Domain: scrapbook-slider
 */

/*
Scrapbook Slider is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
Scrapbook Slider is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with Scrapbook Slider. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/

if (! defined('ABSPATH')) {
    exit;
}

if (! class_exists('Scrapbook_Slider')) {
    class Scrapbook_Slider
    {
        public function __construct()
        {

            $this->define_constants();

            add_action('admin_menu', [$this, 'add_menu']);

            require_once SCRAPBOOK_SLIDER_PATH . 'post-types/class.scrapbook-slider-cpt.php';
            $Scrapbook_Slider_Post_Type = new Scrapbook_Slider_Post_Type();

            require_once SCRAPBOOK_SLIDER_PATH . 'class.scrapbook-slider-settings.php';
            $Scrapbook_Slider_Settings = new Scrapbook_Slider_Settings();

            require_once SCRAPBOOK_SLIDER_PATH . 'shortcodes/class.scrapbook-slider-shortcode.php';
            $Scrapbook_Slider_Shortcode = new Scrapbook_Slider_Shortcode();

            require SCRAPBOOK_SLIDER_PATH . 'scrapbook-slider_carousel/scrapbook_slider-carousel.php';

            add_action("wp_enqueue_scripts", [$this, 'register_scripts'], 999);
            add_action('after_setup_theme', [$this, 'reset_parent_setup'], 11);
            add_theme_support('post-thumbnails');
            add_image_size('scrapbook_main_img', 400, 400);

        }

        public function reset_parent_setup()
        {

            global $content_width;
            $content_width = 1200;
        }

        public function define_constants()
        {
            define('SCRAPBOOK_SLIDER_PATH', plugin_dir_path(__FILE__));
            define('SCRAPBOOK_SLIDER_URL', plugin_dir_url(__FILE__));
            define('SCRAPBOOK_SLIDER_VERSION', '1.0.0');
        }

        public static function activate()
        {
            update_option('rewrite_rules', '');
        }

        public static function deactivate()
        {
            flush_rewrite_rules();
            unregister_post_type('scrapbook-sliderr');
        }

        public static function uninstall()
        {
            delete_option('scrapbook_slider_options');

            $posts = get_posts(
                [
                    'post_type'    => 'scrapbook-slider',
                    'number_posts' => -1,
                    'post_status'  => 'any',
                ]
            );

            foreach ($posts as $post) {
                wp_delete_post($post->ID, true);
            }
        }



        public function add_menu()
        {
            add_menu_page(
                esc_html__('Scrapbook Slider Options', 'scrapbook-slider'),
                esc_html__('Scrapbook Sliders', 'scrapbook-slider'),
                'manage_options',
                'scrapbook_slider_admin',
                [$this, 'scrapbook_slider_settings_page'],
                'dashicons-images-alt2'
            );

            add_submenu_page(
                'scrapbook_slider_admin',
                esc_html__('Manage Slides', 'scrapbook-slider'),
                esc_html__('Manage Slides', 'scrapbook-slider'),
                'manage_options',
                'edit.php?post_type=scrapbook-slider',
            );

            add_submenu_page(
                'scrapbook_slider_admin',
                esc_html__('Add New Slides', 'scrapbook-slider'),
                esc_html__('Add New Slides', 'scrapbook-slider'),
                'manage_options',
                'post-new.php?post_type=scrapbook-slider',
            );
        }

        public function scrapbook_slider_settings_page()
        {
            if (! current_user_can('manage_options')) {
                return;
            }
            
            if (isset($_POST['scrapbook_slider_nonce'])) {
                $scrapbook_slider_none = sanitize_text_field(wp_unslash($_POST['scrapbook_slider_nonce']));
            

            if (empty( wp_verify_nonce($scrapbook_slider_none))) {
                    if (isset($_GET['settings-updated'])) {
                        add_settings_error('scrapbook_slider_options', 'scrapbook_slider_message', esc_html('Settings Saved'), 'success');
                    }
                
                }
            }
            settings_errors('scrapbook_slider_options');
            require SCRAPBOOK_SLIDER_PATH . 'views/settings-page.php';
        }

        public function register_scripts()
        {

            wp_register_script('scrapbook-slider-main-jq', SCRAPBOOK_SLIDER_URL . 'scrapbook-slider_carousel/scrapbook_slider.js', ['jquery'], SCRAPBOOK_SLIDER_VERSION, true);
            wp_register_style('scrapbook-slider-css', SCRAPBOOK_SLIDER_URL . 'css/style.css', [], SCRAPBOOK_SLIDER_VERSION, 'all');
            wp_register_style('scrapbook-slider-css-map', SCRAPBOOK_SLIDER_URL . 'css/style.css.map', [], SCRAPBOOK_SLIDER_VERSION, 'all');

          

        }

    }
}

if (class_exists('scrapbook_Slider')) {
    register_activation_hook(__FILE__, ['Scrapbook_Slider', 'activate']);
    register_deactivation_hook(__FILE__, ['Scrapbook_Slider', 'deactivate']);
    register_uninstall_hook(__FILE__, ['Scrapbook_Slider', 'uninstall']);

    $Scrapbook_slider = new Scrapbook_Slider();
}
