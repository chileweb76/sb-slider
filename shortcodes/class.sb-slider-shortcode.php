<?php
if (! class_exists('SB_Slider_Shortcode')) {
    class SB_Slider_Shortcode
    {
        public function __construct()
        {
            add_shortcode('sb_slider', [$this, 'add_shortcode']);

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

            require SB_SLIDER_PATH . 'views/sb-slider_shortcode.php';

            wp_enqueue_script('sb-slider-main-jq');
            wp_enqueue_style('sb-slider-carousel');
            return ob_get_clean();
        }

    }
}
