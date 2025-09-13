
<?php
// Deprecated: this file previously served dynamic CSS. The plugin now enqueues
// a static CSS file and injects inline styles. Keeping this file only for
// backwards reference — it should not be publicly reachable.
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
// DO NOT DELETE YET: see sb-slider_carousel/sb_slider-carousel.css and SB_Slider::get_inline_styles()
return;

    $options = get_option('sb_slider_options');
    if (! empty($options['sb_slider_color_left'])) {
        $sb_slider_color_left = $options['sb_slider_color_left'];
    } else {
        $sb_slider_color_left = '#D3D3D3';
    }
    if (! empty($options['sb_slider_color_center'])) {
        $sb_slider_color_center = $options['sb_slider_color_center'];
    } else {
        $sb_slider_color_center = '#D3D3D3';
    }
    if (! empty($options['sb_slider_color_right'])) {
        $sb_slider_color_right = $options['sb_slider_color_right'];
    } else {
        $sb_slider_color_right = '#D3D3D3';
    }
    if (! empty($options['sb_slider_color_bottom_left'])) {
        $sb_slider_color_bottom_left = $options['sb_slider_color_bottom_left'];
    } else {
        $sb_slider_color_bottom_left = '#D3D3D3';
    }
    if (! empty($options['sb_slider_color_bottom_center'])) {
        $sb_slider_color_bottom_center = $options['sb_slider_color_bottom_center'];
    } else {
        $sb_slider_color_bottom_center = '#D3D3D3';
    }
    if (! empty($options['sb_slider_color_bottom_right'])) {
        $sb_slider_color_bottom_right = $options['sb_slider_color_bottom_right'];
    } else {
        $sb_slider_color_bottom_right = '#D3D3D3';
    }
    <?php
    // Deprecated: this file previously served dynamic CSS. The plugin now enqueues
    // a static CSS file and injects inline styles. Keep this file inert so it
    // cannot be requested directly.
    if ( ! defined( 'ABSPATH' ) ) {
        exit; // Exit if accessed directly
    }

    // Intentionally return early — inline styles are generated via SB_Slider::get_inline_styles()
    return;