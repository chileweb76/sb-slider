<?php
// Minimal bootstrap for PHPStan: define plugin constants and include main plugin file so symbols are discoverable.
if ( ! defined( 'SB_SLIDER_PATH' ) ) {
    define( 'SB_SLIDER_PATH', __DIR__ . DIRECTORY_SEPARATOR );
}
if ( ! defined( 'SB_SLIDER_URL' ) ) {
    define( 'SB_SLIDER_URL', 'http://example.org/' );
}
if ( ! defined( 'SB_SLIDER_VERSION' ) ) {
    define( 'SB_SLIDER_VERSION', '1.0.0' );
}
// Don't require the full plugin file here because it pulls in other files that
// might not be present in the analysis environment. Instead provide minimal
// stubs for classes and no-op WP functions so PHPStan can discover symbols.
if ( ! function_exists( 'add_action' ) ) {
    /**
     * No-op add_action stub for analysis.
     *
     * @param mixed ...$args
     * @return void
     */
    function add_action(mixed ...$args): void { }
}
if ( ! function_exists( 'add_filter' ) ) {
    /**
     * No-op add_filter stub for analysis.
     *
     * @param mixed ...$args
     * @return void
     */
    function add_filter(mixed ...$args): void { }
}
if ( ! function_exists( 'register_activation_hook' ) ) {
    /**
     * No-op register_activation_hook stub for analysis.
     *
     * @param mixed ...$args
     * @return void
     */
    function register_activation_hook(mixed ...$args): void { }
}
if ( ! function_exists( 'register_deactivation_hook' ) ) {
    /**
     * No-op register_deactivation_hook stub for analysis.
     *
     * @param mixed ...$args
     * @return void
     */
    function register_deactivation_hook(mixed ...$args): void { }
}
if ( ! function_exists( 'register_uninstall_hook' ) ) {
    /**
     * No-op register_uninstall_hook stub for analysis.
     *
     * @param mixed ...$args
     * @return void
     */
    function register_uninstall_hook(mixed ...$args): void { }
}

// Minimal class stubs for static analysis (no implementation required).
if ( ! class_exists( 'SB_Slider' ) ) {
    /**
     * Minimal SB_Slider stub for PHPStan analysis.
     *
     * This stub documents key methods used elsewhere to assist static analysis.
     */
    class SB_Slider {
        /**
         * Register scripts and styles.
         *
         * @return void
         */
        public function register_scripts(): void {}

        // real implementation exists in the plugin; no stub needed here
    }
}
if ( ! class_exists( 'SB_Slider_Post_Type' ) ) {
    /**
     * Minimal post type class stub.
     */
    class SB_Slider_Post_Type {
        public function create_post_type(): void {}
        public function add_meta_boxes(): void {}
        public function add_inner_meta_boxes(?\WP_Post $post = null): void {}
        public function save_post(int $post_id, ?\WP_Post $post = null): void {}
    }
}
if ( ! class_exists( 'SB_Slider_Settings' ) ) {
    /**
     * Minimal settings class stub.
     */
    class SB_Slider_Settings {
        public function __construct() {}
        public function register_settings(): void {}
    }
}
if ( ! class_exists( 'SB_Slider_Shortcode' ) ) {
    /**
     * Minimal shortcode class stub.
     */
    class SB_Slider_Shortcode {
        /**
         * @param array<string,mixed> $atts
         * @param string|null $content
         * @param string $tag
         * @return string
         */
        public function add_shortcode(array $atts = [], ?string $content = null, string $tag = ''): string { return ''; }
    }
}
