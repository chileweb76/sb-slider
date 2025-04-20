<?php
    $meta = get_post_meta($post->ID);

    $link_text_left          = get_post_meta($post->ID, 'sb_slider_link_text_left', true);
    $link_text_center        = get_post_meta($post->ID, 'sb_slider_link_text_center', true);
    $link_text_right         = get_post_meta($post->ID, 'sb_slider_link_text_right', true);
    $link_text_bottom_left   = get_post_meta($post->ID, 'sb_slider_link_text_bottom_left', true);
    $link_text_bottom_center = get_post_meta($post->ID, 'sb_slider_link_text_bottom_center', true);
    $link_text_bottom_right  = get_post_meta($post->ID, 'sb_slider_link_text_bottom_right', true);

    $link_url_left          = get_post_meta($post->ID, 'sb_slider_link_url_left', true);
    $link_url_center        = get_post_meta($post->ID, 'sb_slider_link_url_center', true);
    $link_url_right         = get_post_meta($post->ID, 'sb_slider_link_url_right', true);
    $link_url_bottom_left   = get_post_meta($post->ID, 'sb_slider_link_url_bottom_left', true);
    $link_url_bottom_center = get_post_meta($post->ID, 'sb_slider_link_url_bottom_center', true);
    $link_url_bottom_right  = get_post_meta($post->ID, 'sb_slider_link_url_bottom_right', true);
?>

<table class="form-table sb-slider-metabox">
    <input type="hidden" name="sb_slider_nonce" value="<? echo wp_create_nonce( "sb_slider_nonce" ); ?>">
    <tr>
        <th>
            <label for="sb_slider_link_text_left"><?php esc_html_e('Left Button Text', 'sb-slider')?></label>
        </th>
        <td>
            <input
                type="text"
                name="sb_slider_link_text_left"
                id="sb_slider_link_text_left"
                class="regular-text link-text"
                value="<?php echo esc_html($link_text_left); ?>"
            >
        </td>
    </tr>
    <tr>
        <th>
            <label for="sb_slider_link_url_left"><?php esc_html_e('Left Button Url', 'sb-slider')?></label>
        </th>
        <td>
            <input
                type="url"
                name="sb_slider_link_url_left"
                id="sb_slider_link_url_left"
                class="regular-text link-url"
                value="<?php echo esc_url($link_url_left); ?>"
            >
        </td>
    </tr>
    <tr>
        <th>
            <label for="sb_slider_link_text_center"><?php esc_html_e('Center Button Text', 'sb-slider')?></label>
        </th>
        <td>
            <input
                type="text"
                name="sb_slider_link_text_center"
                id="sb_slider_link_text_center"
                class="regular-text link-text"
                value="<?php echo esc_html($link_text_center); ?>"
            >
        </td>
    </tr>
    <tr>
        <th>
            <label for="sb_slider_link_url_center"><?php esc_html_e('Center Button Url', 'sb-slider')?></label>
        </th>
        <td>
            <input
                type="url"
                name="sb_slider_link_url_center"
                id="sb_slider_link_url_center"
                class="regular-text link-url"
                value="<?php echo esc_url($link_url_center); ?>"
            >
        </td>
    </tr>
    <tr>
        <th>
            <label for="sb_slider_link_text_right"><?php esc_html_e('Right Button Text', 'sb-slider')?></label>
        </th>
        <td>
            <input
                type="text"
                name="sb_slider_link_text_right"
                id="sb_slider_link_text_right"
                class="regular-text link-text"
                value="<?php echo esc_html($link_text_right); ?>"
            >
        </td>
    </tr>
    <tr>
        <th>
            <label for="sb_slider_link_url_right"><?php esc_html_e('Right Button Url', 'sb-slider')?></label>
        </th>
        <td>
            <input
                type="url"
                name="sb_slider_link_url_right"
                id="sb_slider_link_url_right"
                class="regular-text link-url"
                value="<?php echo esc_url($link_url_right); ?>"
            >
        </td>
    </tr>
    <tr>
        <th>
            <label for="sb_slider_link_text_bottom_left"><?php esc_html_e('Bottom Left Button Text', 'sb-slider')?></label>
        </th>
        <td>
            <input
                type="text"
                name="sb_slider_link_text_bottom_left"
                id="sb_slider_link_text_bottom_left"
                class="regular-text link-text"
                value="<?php echo esc_html($link_text_bottom_left); ?>"
            >
        </td>
    </tr>
    <tr>
        <th>
            <label for="sb_slider_link_url_bottom_left"><?php esc_html_e('Bottom Left Button Url', 'sb-slider')?></label>
        </th>
        <td>
            <input
                type="url"
                name="sb_slider_link_url_bottom_left"
                id="sb_slider_link_url_bottom_left"
                class="regular-text link-url"
                value="<?php echo esc_url($link_url_bottom_left); ?>"
            >
        </td>
    </tr>
    <tr>
        <th>
            <label for="sb_slider_link_text_bottom_center"><?php esc_html_e('Bottom Center Button Text', 'sb-slider')?></label>
        </th>
        <td>
            <input
                type="text"
                name="sb_slider_link_text_bottom_center"
                id="sb_slider_link_text_bottom_center"
                class="regular-text link-text"
                value="<?php echo esc_html($link_text_bottom_center); ?>"
            >
        </td>
    </tr>
    <tr>
        <th>
            <label for="sb_slider_link_url_bottom_center"><?php esc_html_e('Bottom Center Button Url', 'sb-slider')?></label>
        </th>
        <td>
            <input
                type="url"
                name="sb_slider_link_url_bottom_center"
                id="sb_slider_link_url_bottom_center"
                class="regular-text link-url"
                value="<?php echo esc_url($link_url_bottom_center); ?>"
            >
        </td>
    </tr>
    <tr>
        <th>
            <label for="sb_slider_link_text_bottom_right"><?php esc_html_e('Bottom Right Button Text', 'sb-slider')?></label>
        </th>
        <td>
            <input
                type="text"
                name="sb_slider_link_text_bottom_right"
                id="sb_slider_link_text_bottom_right"
                class="regular-text link-text"
                value="<?php echo esc_html($link_text_bottom_right); ?>"
            >
        </td>
    </tr>
    <tr>
        <th>
            <label for="sb_slider_link_url_bottom_right"><?php esc_html_e('Bottom Right Button Url', 'sb-slider')?></label>
        </th>
        <td>
            <input
                type="url"
                name="sb_slider_link_url_bottom_right"
                id="sb_slider_link_url_bottom_right"
                class="regular-text link-url"
                value="<?php echo esc_url($link_url_bottom_right); ?>"
            >
        </td>
    </tr>
</table>
