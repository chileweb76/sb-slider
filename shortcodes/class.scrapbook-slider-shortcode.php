<?php
if (! class_exists('scrapbook_Slider_Shortcode')) {
    class Scrapbook_Slider_Shortcode
    {
        public function __construct()
        {
            add_shortcode('scrapbook_slider', [$this, 'add_shortcode']);

        }

        public function add_shortcode($atts = [], $content = null, $tag = '')
        {
            $atts = array_change_key_case((array) $atts, CASE_LOWER);

            extract(shortcode_atts(
                ['id' => '', 'orderby' => 'date']
                ,
                $atts,
                $tag
            ));

            if (! empty($id)) {
                $id = array_map('absint', explode(',', $id));
            }

            ob_start();

            require SCRAPBOOK_SLIDER_PATH . 'views/scrapbook-slider_shortcode.php';

            wp_enqueue_script('scrapbook-slider-main-jq');
            wp_enqueue_style('scrapbook-slider-carousel');
            wp_enqueue_style('scrapbook-slider-css');
            wp_enqueue_style('scrapbook-slider-css-map');
            return ob_get_clean();
        }

    }
}
