<?php
/**
 * Deprecated and inert: previously used to print dynamic CSS.
 * The plugin now registers/enqueues a static CSS file and injects inline styles
 * through `SB_Slider::get_inline_styles()`. This file is kept only for
 * compatibility but returns early to avoid serving CSS from PHP.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// This file is intentionally inert now.
return;