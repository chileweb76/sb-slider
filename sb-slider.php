<?php

/**
 *Plugin Name: Scrapbook Slider
 *Plugin URI:
 *Description: A slider designes to show latest product with buttons to go to stores for purchase.
 *Version: 1.0
 *Requires at least: 6.7
 *Author: Christopher Hile
 *Author URI: https://christopherhile.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *Text Domain: sb-slider
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

            require_once SB_SLIDER_PATH . 'inc/class-tgm-plugin-activation.php';

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
            unregister_post_type('sb-slider');
        }

        public static function uninstall()
        {
            delete_option('sb_slider_options');

            $posts = get_posts(
                [
                    'post_type'    => 'sb-slider',
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
                'sb-slider',
                false,
                dirname(plugin_basename(__FILE__)) . '/languages/'
            );
        }

        public function add_menu()
        {
            add_menu_page(
                esc_html__('Scrapbook Slider Options', 'sb-slider'),
                esc_html__('Scrapbook Sliders', 'sb-slider'),
                'manage_options',
                'sb_slider_admin',
                [$this, 'sb_slider_settings_page'],
                'dashicons-images-alt2'
            );

            add_submenu_page(
                'sb_slider_admin',
                esc_html__('Manage Slides', 'sb-slider'),
                esc_html__('Manage Slides', 'sb-slider'),
                'manage_options',
                'edit.php?post_type=sb-slider',
            );

            add_submenu_page(
                'sb_slider_admin',
                esc_html__('Add New Slides', 'sb-slider'),
                esc_html__('Add New Slides', 'sb-slider'),
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
                add_settings_error('sb_slider_options', 'sb_slider_message', esc_html__('Settings Saved', 'sb-slider'), 'success');
            }
            settings_errors('sb_slider_options');
            require SB_SLIDER_PATH . 'views/settings-page.php';
        }

        public function register_scripts()
        {

            wp_register_script('sb-slider-main-jq', SB_SLIDER_URL . 'sb-slider_carousel/sb_slider.js', ['jquery'], SB_SLIDER_VERSION, true);
            wp_register_style('sb-slider-carousel', SB_SLIDER_URL . 'sb-slider_carousel/sb_slider-carousel.php', [], SB_SLIDER_VERSION, 'all');
        }

    }
}

if (class_exists('SB_Slider')) {
    register_activation_hook(__FILE__, ['SB_Slider', 'activate']);
    register_deactivation_hook(__FILE__, ['SB_Slider', 'deactivate']);
    register_uninstall_hook(__FILE__, ['SB_Slider', 'uninstall']);

    $SB_slider = new SB_Slider();
}

add_action('tgmpa_register', 'sb_slider_register_required_plugins');

function sb_slider_register_required_plugins()
{

    $plugins = [

        [
            'name'     => 'Regenerate Thumbnails',
            'slug'     => 'regenerate-thumbnails',
            'required' => false,
        ],

    ];

    $config = [
        'id'           => 'sb-slider',             // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'parent_slug'  => 'plugins.php',           // Parent menu slug.
        'capability'   => 'manage_options',        // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.

    ];

    tgmpa($plugins, $config);
}
