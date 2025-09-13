
<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 *Plugin Name: Scrapbook Slider
 *Plugin URI:
 *Description: A slider designed to show the latest product with buttons to go to stores for purchase.
 *Version: 1.0
 *Requires at least: 6.7
 *Author: Christopher Hile
 *Author URI: https://christopherhile.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *Text Domain: scrapbook-slider
 *Domain Path: /languages
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

if (! class_exists('SB_Slider')) {
    class SB_Slider
    {
        public function __construct()
        {
            $this->define_constants();
            $this->load_textdomain();

            add_action('admin_menu', [$this, 'add_menu']);

            require_once SB_SLIDER_PATH . 'post-types/class.sb-slider-cpt.php';
            $SB_Slider_Post_Type = new SB_Slider_Post_Type();

            require_once SB_SLIDER_PATH . 'class.sb-slider-settings.php';
            $SB_Slider_Settings = new SB_Slider_Settings();

            require_once SB_SLIDER_PATH . 'shortcodes/class.sb-slider-shortcode.php';
            $SB_Slider_Shortcode = new SB_Slider_Shortcode();

            add_action("wp_enqueue_scripts", [$this, 'register_scripts'], 999);
            add_action('after_setup_theme', [$this, 'reset_parent_setup'], 11);
            add_theme_support('post-thumbnails');
            add_image_size('sb_main_img', 400, 400);

        }

        public function reset_parent_setup()
        {

            global $content_width;
            $content_width = 1200;
        }

        public function define_constants()
        {
            define('SB_SLIDER_PATH', plugin_dir_path(__FILE__));
            define('SB_SLIDER_URL', plugin_dir_url(__FILE__));
            define('SB_SLIDER_VERSION', '1.0.0');
        }

        public static function activate()
        {
            update_option('rewrite_rules', '');
        }

        public static function deactivate()
        {
            flush_rewrite_rules();
            unregister_post_type('scrapbook-slider');
        }

        public static function uninstall()
        {
            delete_option('sb_slider_options');

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

        public function load_textdomain()
        {
            load_plugin_textdomain(
                'scrapbook-slider',
                false,
                dirname(plugin_basename(__FILE__)) . '/languages/'
            );
        }

        public function add_menu()
        {
            add_menu_page(
                esc_html__('Scrapbook Slider Options', 'scrapbook-slider'),
                esc_html__('Scrapbook Sliders', 'scrapbook-slider'),
                'manage_options',
                'sb_slider_admin',
                [$this, 'sb_slider_settings_page'],
                'dashicons-images-alt2'
            );

            add_submenu_page(
                'sb_slider_admin',
                esc_html__('Manage Slides', 'scrapbook-slider'),
                esc_html__('Manage Slides', 'scrapbook-slider'),
                'manage_options',
                'edit.php?post_type=sb-slider',
            );

            add_submenu_page(
                'sb_slider_admin',
                esc_html__('Add New Slides', 'scrapbook-slider'),
                esc_html__('Add New Slides', 'scrapbook-slider'),
                'manage_options',
                'post-new.php?post_type=sb-slider',
            );
        }

        public function sb_slider_settings_page()
        {
            if (! current_user_can('manage_options')) {
                return;
            }

            if (isset($_GET['settings-updated'])) {
                add_settings_error('sb_slider_options', 'sb_slider_message', esc_html__('Settings Saved', 'scrapbook-slider'), 'success');
            }

            settings_errors('sb_slider_options');
            require SB_SLIDER_PATH . 'views/settings-page.php';
        }

        public function register_scripts()
        {
            wp_register_script('sb-slider-main-jq', SB_SLIDER_URL . 'sb-slider_carousel/sb_slider.js', ['jquery'], SB_SLIDER_VERSION, true);
            // Enqueue static CSS file
            wp_register_style('sb-slider-carousel', SB_SLIDER_URL . 'sb-slider_carousel/sb_slider-carousel.css', [], SB_SLIDER_VERSION, 'all');
            wp_enqueue_style('sb-slider-carousel');

            // Add inline styles generated from options
            $inline = $this->get_inline_styles();
            if (!empty($inline)) {
                wp_add_inline_style('sb-slider-carousel', $inline);
            }
        }

        /**
         * Build inline CSS from saved plugin options.
         *
         * @return string
         */
        private function get_inline_styles()
        {
            $options = get_option('sb_slider_options', []);
            // default colors
            $defaults = [
                'sb_slider_color_left' => '#D3D3D3',
                'sb_slider_color_center' => '#D3D3D3',
                'sb_slider_color_right' => '#D3D3D3',
                'sb_slider_color_bottom_left' => '#D3D3D3',
                'sb_slider_color_bottom_center' => '#D3D3D3',
                'sb_slider_color_bottom_right' => '#D3D3D3',
                'sb_slider_left_font_color' => '#000000',
                'sb_slider_center_font_color' => '#000000',
                'sb_slider_right_font_color' => '#000000',
                'sb_slider_bottom_left_font_color' => '#000000',
                'sb_slider_bottom_center_font_color' => '#000000',
                'sb_slider_bottom_right_font_color' => '#000000',
            ];

            $styles = '';
            foreach ($defaults as $key => $def) {
                $value = isset($options[$key]) && $options[$key] !== '' ? $options[$key] : $def;
                // sanitize the color or hex value - allow only safe characters
                $value = preg_replace('/[^#A-Za-z0-9(),.\-%\s]/', '', $value);
                $options[$key] = $value;
            }

            $styles .= ".sb_button1_color{background-color:{$options['sb_slider_color_left']};color:{$options['sb_slider_left_font_color']};}\n";
            $styles .= ".sb_button2_color{background-color:{$options['sb_slider_color_center']};color:{$options['sb_slider_center_font_color']};}\n";
            $styles .= ".sb_button3_color{background-color:{$options['sb_slider_color_right']};color:{$options['sb_slider_right_font_color']};}\n";
            $styles .= ".sb_button4_color{background-color:{$options['sb_slider_color_bottom_left']};color:{$options['sb_slider_bottom_left_font_color']};}\n";
            $styles .= ".sb_button5_color{background-color:{$options['sb_slider_color_bottom_center']};color:{$options['sb_slider_bottom_center_font_color']};}\n";
            $styles .= ".sb_button6_color{background-color:{$options['sb_slider_color_bottom_right']};color:{$options['sb_slider_bottom_right_font_color']};}\n";

            return $styles;
        }

    }
}

if (class_exists('SB_Slider')) {
    register_activation_hook(__FILE__, ['SB_Slider', 'activate']);
    register_deactivation_hook(__FILE__, ['SB_Slider', 'deactivate']);
    register_uninstall_hook(__FILE__, ['SB_Slider', 'uninstall']);

    $SB_slider = new SB_Slider();
}
