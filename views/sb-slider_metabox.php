
<?php
/**
 * Metabox view for SB Slider post type
 * @var WP_Post $post
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global $post;

// Ensure we have a post object and ID before attempting to read meta.
$post_id = isset( $post ) && isset( $post->ID ) ? (int) $post->ID : 0;

/**
 * Helper to read a meta value and ensure it's a string for escaping.
 * Returns empty string when not set.
 *
 * @param int $post_id
 * @param string $key
 * @return string
 */
function sb_slider_get_meta_string( $post_id, $key ) {
    $val = '';
    if ( $post_id > 0 ) {
        $val = get_post_meta( $post_id, $key, true );
    }
    // Force scalar to string; if array/object/null return empty string
    if ( is_scalar( $val ) ) {
        return (string) $val;
    }
    return '';
}

$meta = $post_id ? get_post_meta( $post_id ) : array();

$link_text_left          = sb_slider_get_meta_string( $post_id, 'sb_slider_link_text_left' );
$link_text_center        = sb_slider_get_meta_string( $post_id, 'sb_slider_link_text_center' );
$link_text_right         = sb_slider_get_meta_string( $post_id, 'sb_slider_link_text_right' );
$link_text_bottom_left   = sb_slider_get_meta_string( $post_id, 'sb_slider_link_text_bottom_left' );
$link_text_bottom_center = sb_slider_get_meta_string( $post_id, 'sb_slider_link_text_bottom_center' );
$link_text_bottom_right  = sb_slider_get_meta_string( $post_id, 'sb_slider_link_text_bottom_right' );

$link_url_left          = sb_slider_get_meta_string( $post_id, 'sb_slider_link_url_left' );
$link_url_center        = sb_slider_get_meta_string( $post_id, 'sb_slider_link_url_center' );
$link_url_right         = sb_slider_get_meta_string( $post_id, 'sb_slider_link_url_right' );
$link_url_bottom_left   = sb_slider_get_meta_string( $post_id, 'sb_slider_link_url_bottom_left' );
$link_url_bottom_center = sb_slider_get_meta_string( $post_id, 'sb_slider_link_url_bottom_center' );
$link_url_bottom_right  = sb_slider_get_meta_string( $post_id, 'sb_slider_link_url_bottom_right' );
?>

<table class="form-table sb-slider-metabox">
    <?php wp_nonce_field( 'sb_slider_nonce', 'sb_slider_nonce' ); ?>
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
                value="<?php echo esc_attr( $link_text_left ); ?>"
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
                value="<?php echo esc_attr( $link_url_left ); ?>"
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
                value="<?php echo esc_attr( $link_text_center ); ?>"
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
                value="<?php echo esc_attr( $link_url_center ); ?>"
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
                value="<?php echo esc_attr( $link_text_right ); ?>"
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
                value="<?php echo esc_attr( $link_url_right ); ?>"
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
                value="<?php echo esc_attr( $link_text_bottom_left ); ?>"
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
                value="<?php echo esc_attr( $link_url_bottom_left ); ?>"
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
                value="<?php echo esc_attr( $link_text_bottom_center ); ?>"
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
                value="<?php echo esc_attr( $link_url_bottom_center ); ?>"
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
                value="<?php echo esc_attr( $link_text_bottom_right ); ?>"
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
                value="<?php echo esc_attr( $link_url_bottom_right ); ?>"
            >
        </td>
    </tr>
</table>
