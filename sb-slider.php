<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Plugin Name: SB Slider
 * Plugin URI:
 * Description: A slider designed to show the latest product with buttons to go to stores for purchase.
 * Version: 1.0
 * Requires at least: 6.8
 * Author: Christopher Hile
 * Author URI: https://christopherhile.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: sb-slider
 * Domain Path: /languages
 */

if ( ! class_exists( 'SB_Slider' ) ) {
    class SB_Slider {
        public function __construct() {
            $this->define_constants();

            // Admin pages
            add_action( 'admin_menu', [ $this, 'add_menu' ] );

            // Load components
            require_once SB_SLIDER_PATH . 'post-types/class.sb-slider-cpt.php';
            require_once SB_SLIDER_PATH . 'class.sb-slider-settings.php';
            require_once SB_SLIDER_PATH . 'shortcodes/class.sb-slider-shortcode.php';

            new SB_Slider_Post_Type();
            new SB_Slider_Settings();
            new SB_Slider_Shortcode();

            add_action( 'wp_enqueue_scripts', [ $this, 'register_scripts' ], 999 );
            add_action( 'after_setup_theme', [ $this, 'reset_parent_setup' ], 11 );
            add_theme_support( 'post-thumbnails' );
            add_image_size( 'sb_slider_main_img', 400, 400 );
        }

        public function reset_parent_setup(): void {
            global $content_width;
            $content_width = 1200;
        }

        public function define_constants(): void {
            if ( ! defined( 'SB_SLIDER_PATH' ) ) {
                define( 'SB_SLIDER_PATH', plugin_dir_path( __FILE__ ) );
            }
            if ( ! defined( 'SB_SLIDER_URL' ) ) {
                define( 'SB_SLIDER_URL', plugin_dir_url( __FILE__ ) );
            }
            if ( ! defined( 'SB_SLIDER_VERSION' ) ) {
                define( 'SB_SLIDER_VERSION', '1.0.0' );
            }
        }

        public static function activate(): void {
            update_option( 'rewrite_rules', '' );
        }

        public static function deactivate(): void {
            flush_rewrite_rules();
            if ( post_type_exists( 'sb_slider' ) ) {
                unregister_post_type( 'sb_slider' );
            }
        }

        public static function uninstall(): void {
            delete_option( 'sb_slider_options' );

            $posts = get_posts( [
                'post_type'    => 'sb_slider',
                'number_posts' => -1,
                'post_status'  => 'any',
            ] );

            foreach ( $posts as $post ) {
                if ( $post instanceof \WP_Post ) {
                    wp_delete_post( $post->ID, true );
                }
            }
        }

        public function load_textdomain(): void {
            load_plugin_textdomain( 'sb-slider', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
        }

    public function add_menu(): void {
            add_menu_page(
                esc_html__( 'SB Slider Options', 'sb-slider' ),
                esc_html__( 'SB Sliders', 'sb-slider' ),
                'manage_options',
                'sb_slider_admin',
                [ $this, 'sb_slider_settings_page' ],
                'dashicons-images-alt2'
            );

            add_submenu_page( 'sb_slider_admin', esc_html__( 'Manage Slides', 'sb-slider' ), esc_html__( 'Manage Slides', 'sb-slider' ), 'manage_options', 'edit.php?post_type=sb_slider' );
            add_submenu_page( 'sb_slider_admin', esc_html__( 'Add New Slides', 'sb-slider' ), esc_html__( 'Add New Slides', 'sb-slider' ), 'manage_options', 'post-new.php?post_type=sb_slider' );
        }

    public function sb_slider_settings_page(): void {
            if ( ! current_user_can( 'manage_options' ) ) {
                return;
            }

            if ( isset( $_GET['settings-updated'] ) ) {
                add_settings_error( 'sb_slider_options', 'sb_slider_message', esc_html__( 'Settings Saved', 'sb-slider' ), 'success' );
            }

            settings_errors( 'sb_slider_options' );
            require SB_SLIDER_PATH . 'views/settings-page.php';
        }

    public function register_scripts(): void {
            wp_register_script( 'sb-slider-main-jq', SB_SLIDER_URL . 'sb-slider_carousel/sb_slider.js', [ 'jquery' ], SB_SLIDER_VERSION, true );

            // Enqueue static CSS file
            wp_register_style( 'sb-slider-carousel', SB_SLIDER_URL . 'sb-slider_carousel/sb_slider-carousel.css', [], SB_SLIDER_VERSION, 'all' );
            wp_enqueue_style( 'sb-slider-carousel' );

            // Add inline styles generated from options
            $inline = $this->get_inline_styles();
            if ( ! empty( $inline ) ) {
                wp_add_inline_style( 'sb-slider-carousel', $inline );
            }
        }

        /**
         * Build inline CSS from saved plugin options.
         *
         * @return string
         */
        private function get_inline_styles() {
            $options = get_option( 'sb_slider_options', [] );
            // default colors
            $defaults = [
                'sb_slider_color_left'                    => '#D3D3D3',
                'sb_slider_color_center'                  => '#D3D3D3',
                'sb_slider_color_right'                   => '#D3D3D3',
                'sb_slider_color_bottom_left'             => '#D3D3D3',
                'sb_slider_color_bottom_center'           => '#D3D3D3',
                'sb_slider_color_bottom_right'            => '#D3D3D3',
                'sb_slider_left_font_color'               => '#000000',
                'sb_slider_center_font_color'             => '#000000',
                'sb_slider_right_font_color'              => '#000000',
                'sb_slider_bottom_left_font_color'        => '#000000',
                'sb_slider_bottom_center_font_color'      => '#000000',
                'sb_slider_bottom_right_font_color'       => '#000000',
            ];

            foreach ( $defaults as $key => $def ) {
                $value = isset( $options[ $key ] ) && $options[ $key ] !== '' ? $options[ $key ] : $def;
                // sanitize the color or hex value - allow only safe characters
                $value             = preg_replace( '/[^#A-Za-z0-9(),.\\-%\\s]/', '', $value );
                $options[ $key ] = $value;
            }

            $styles  = "";
            $styles .= ".sb_button1_color{background-color:{$options['sb_slider_color_left']};color:{$options['sb_slider_left_font_color']};}\\n";
            $styles .= ".sb_button2_color{background-color:{$options['sb_slider_color_center']};color:{$options['sb_slider_center_font_color']};}\\n";
            $styles .= ".sb_button3_color{background-color:{$options['sb_slider_color_right']};color:{$options['sb_slider_right_font_color']};}\\n";
            $styles .= ".sb_button4_color{background-color:{$options['sb_slider_color_bottom_left']};color:{$options['sb_slider_bottom_left_font_color']};}\\n";
            $styles .= ".sb_button5_color{background-color:{$options['sb_slider_color_bottom_center']};color:{$options['sb_slider_bottom_center_font_color']};}\\n";
            $styles .= ".sb_button6_color{background-color:{$options['sb_slider_color_bottom_right']};color:{$options['sb_slider_bottom_right_font_color']};}\\n";

            return $styles;
        }

    }
}

if ( class_exists( 'SB_Slider' ) ) {
    register_activation_hook( __FILE__, [ 'SB_Slider', 'activate' ] );
    register_deactivation_hook( __FILE__, [ 'SB_Slider', 'deactivate' ] );
    register_uninstall_hook( __FILE__, [ 'SB_Slider', 'uninstall' ] );

    $SB_slider = new SB_Slider();
}

// Load deprecated/inert carousel file only if it exists (kept for backward-compatibility but no longer used)
if ( file_exists( SB_SLIDER_PATH . 'sb-slider_carousel/sb_slider-carousel.php' ) ) {
    // the file was deprecated and now returns early; keep include for safety but it's inert
    require_once SB_SLIDER_PATH . 'sb-slider_carousel/sb_slider-carousel.php';
}

