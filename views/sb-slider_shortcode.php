
<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

    global $id;
    global $orderby;

    $args = [
        'post_type'   => 'sb_slider',
        'post_status' => 'publish',
        'post__in'    => $id,
        'orderby'     => $orderby,
    ];

    // Initialize arrays to avoid undefined variable warnings
    $button_text_left = $button_text_center = $button_text_right = [];
    $button_text_bottom_left = $button_text_bottom_center = $button_text_bottom_right = [];
    $button_url_left = $button_url_center = $button_url_right = [];
    $button_url_bottom_left = $button_url_bottom_center = $button_url_bottom_right = [];
    $sb_title = $sb_content = $sb_main_image = $sb_thumbnail = [];

    $my_query = new WP_Query($args);
    global $post;

    if ($my_query->have_posts()):
        while ($my_query->have_posts()): $my_query->the_post();

                $post_id = (int) get_the_ID();
                // Use single-value meta (true) and cast to string where appropriate
                $button_text_left[]          = is_scalar( get_post_meta( $post_id, 'sb_slider_link_text_left', true ) ) ? (string) get_post_meta( $post_id, 'sb_slider_link_text_left', true ) : '';
                $button_text_center[]        = is_scalar( get_post_meta( $post_id, 'sb_slider_link_text_center', true ) ) ? (string) get_post_meta( $post_id, 'sb_slider_link_text_center', true ) : '';
                $button_text_right[]         = is_scalar( get_post_meta( $post_id, 'sb_slider_link_text_right', true ) ) ? (string) get_post_meta( $post_id, 'sb_slider_link_text_right', true ) : '';
                $button_text_bottom_left[]   = is_scalar( get_post_meta( $post_id, 'sb_slider_link_text_bottom_left', true ) ) ? (string) get_post_meta( $post_id, 'sb_slider_link_text_bottom_left', true ) : '';
                $button_text_bottom_center[] = is_scalar( get_post_meta( $post_id, 'sb_slider_link_text_bottom_center', true ) ) ? (string) get_post_meta( $post_id, 'sb_slider_link_text_bottom_center', true ) : '';
                $button_text_bottom_right[]  = is_scalar( get_post_meta( $post_id, 'sb_slider_link_text_bottom_right', true ) ) ? (string) get_post_meta( $post_id, 'sb_slider_link_text_bottom_right', true ) : '';

            $button_url_left[]          = is_scalar( get_post_meta( $post_id, 'sb_slider_link_url_left', true ) ) ? (string) get_post_meta( $post_id, 'sb_slider_link_url_left', true ) : '';
            $button_url_center[]        = is_scalar( get_post_meta( $post_id, 'sb_slider_link_url_center', true ) ) ? (string) get_post_meta( $post_id, 'sb_slider_link_url_center', true ) : '';
            $button_url_right[]         = is_scalar( get_post_meta( $post_id, 'sb_slider_link_url_right', true ) ) ? (string) get_post_meta( $post_id, 'sb_slider_link_url_right', true ) : '';
            $button_url_bottom_left[]   = is_scalar( get_post_meta( $post_id, 'sb_slider_link_url_bottom_left', true ) ) ? (string) get_post_meta( $post_id, 'sb_slider_link_url_bottom_left', true ) : '';
            $button_url_bottom_center[] = is_scalar( get_post_meta( $post_id, 'sb_slider_link_url_bottom_center', true ) ) ? (string) get_post_meta( $post_id, 'sb_slider_link_url_bottom_center', true ) : '';
            $button_url_bottom_right[]  = is_scalar( get_post_meta( $post_id, 'sb_slider_link_url_bottom_right', true ) ) ? (string) get_post_meta( $post_id, 'sb_slider_link_url_bottom_right', true ) : '';

            $sb_title[]      = get_the_title();
            $sb_content[]    = get_the_content();
            $image_id = (int) get_post_thumbnail_id($post_id);
            if ($image_id > 0) {
                $sb_main_image[] = wp_get_attachment_image_src($image_id, 'sb_main_img');
                $sb_thumbnail[]  = wp_get_attachment_image_src($image_id, 'medium');
            } else {
                $sb_main_image[] = [];
                $sb_thumbnail[]  = [];
            }
        ?>
		<div class="index"><?php the_title()?></div>
		<?php
                endwhile;
                wp_reset_postdata();
            endif;
            $sb_button_left          = [];
            $sb_button_left          = ['text_left' => $button_text_left, 'url_left' => $button_url_left];
            $sb_button_center        = [];
            $sb_button_center        = ['text_center' => $button_text_center, 'url_center' => $button_url_center];
            $sb_button_right         = [];
            $sb_button_right         = ['text_right' => $button_text_right, 'url_right' => $button_url_right];
            $sb_button_bottom_left   = [];
            $sb_button_bottom_left   = ['text_bottom_left' => $button_text_bottom_left, 'url_bottom_left' => $button_url_bottom_left];
            $sb_button_bottom_center = [];
            $sb_button_bottom_center = ['text_bottom_center' => $button_text_bottom_center, 'url_bottom_center' => $button_url_bottom_center];
            $sb_button_bottom_right  = [];
            $sb_button_bottom_right  = ['text_bottom_right' => $button_text_bottom_right, 'url_bottom_right' => $button_url_bottom_right];

            $sb_length = count($sb_button_left['text_left']);

        ?>

    <section class="sb_carousel">
        <div class="sb_thumbnail">
        <?php
        foreach ($sb_thumbnail as $sb_thumbnails) {
            $src = isset($sb_thumbnails[0]) ? esc_url( $sb_thumbnails[0] ) : '';
            echo '<img class="sb_thumbnail_left remove" src="' . $src . '" alt="" />';
        }
        ?>
        </div>
        <article class="sb_main">
            <div class="sb_image_scroll">
                <button class="prev" onclick="prevSlide()">&#10094;</button>
                <?php
                foreach ($sb_main_image as $sb_main_images) {
                    $src = isset($sb_main_images[0]) ? esc_url( $sb_main_images[0] ) : '';
                    echo '<div><img class="sb_main_image remove" src="' . $src . '" alt="" /></div>';
                }
                ?>
            </div>
            <?php
            foreach ($sb_title as $sb_titles) {
                echo '<div class="sb_title remove">' . esc_html( $sb_titles ) . '</div>';
            }
            foreach ($sb_content as $sb_contents) {
                echo '<div class="sb_content remove">' . wp_kses_post( $sb_contents ) . '</div>';
            }
            ?>
            <div class="sb_store_buttons">
            <?php
            for ($i = 0; $i < $sb_length; $i++) {
                // Left
                $text_left = isset( $sb_button_left['text_left'][$i] ) ? esc_html( (string) $sb_button_left['text_left'][$i] ) : '';
                $url_left  = isset( $sb_button_left['url_left'][$i] ) ? esc_url( (string) $sb_button_left['url_left'][$i] ) : '#';
                echo '<a class="sb_button1 remove' . ( ! empty( $text_left ) ? ' sb_button1_color' : '' ) . '" href="' . $url_left . '" target="_blank">' . $text_left . '</a>';

                // Center
                $text_center = isset( $sb_button_center['text_center'][$i] ) ? esc_html( (string) $sb_button_center['text_center'][$i] ) : '';
                $url_center  = isset( $sb_button_center['url_center'][$i] ) ? esc_url( (string) $sb_button_center['url_center'][$i] ) : '#';
                echo '<a class="sb_button2 remove' . ( ! empty( $text_center ) ? ' sb_button2_color' : '' ) . '" href="' . $url_center . '" target="_blank">' . $text_center . '</a>';

                // Right
                $text_right = isset( $sb_button_right['text_right'][$i] ) ? esc_html( (string) $sb_button_right['text_right'][$i] ) : '';
                $url_right  = isset( $sb_button_right['url_right'][$i] ) ? esc_url( (string) $sb_button_right['url_right'][$i] ) : '#';
                echo '<a class="sb_button3 remove' . ( ! empty( $text_right ) ? ' sb_button3_color' : '' ) . '" href="' . $url_right . '" target="_blank">' . $text_right . '</a>';

                // Bottom left
                $text_bl = isset( $sb_button_bottom_left['text_bottom_left'][$i] ) ? esc_html( (string) $sb_button_bottom_left['text_bottom_left'][$i] ) : '';
                $url_bl  = isset( $sb_button_bottom_left['url_bottom_left'][$i] ) ? esc_url( (string) $sb_button_bottom_left['url_bottom_left'][$i] ) : '#';
                echo '<a class="sb_button4 remove' . ( ! empty( $text_bl ) ? ' sb_button4_color' : '' ) . '" href="' . $url_bl . '" target="_blank">' . $text_bl . '</a>';

                // Bottom center
                $text_bc = isset( $sb_button_bottom_center['text_bottom_center'][$i] ) ? esc_html( (string) $sb_button_bottom_center['text_bottom_center'][$i] ) : '';
                $url_bc  = isset( $sb_button_bottom_center['url_bottom_center'][$i] ) ? esc_url( (string) $sb_button_bottom_center['url_bottom_center'][$i] ) : '#';
                echo '<a class="sb_button5 remove' . ( ! empty( $text_bc ) ? ' sb_button5_color' : '' ) . '" href="' . $url_bc . '" target="_blank">' . $text_bc . '</a>';

                // Bottom right
                $text_br = isset( $sb_button_bottom_right['text_bottom_right'][$i] ) ? esc_html( (string) $sb_button_bottom_right['text_bottom_right'][$i] ) : '';
                $url_br  = isset( $sb_button_bottom_right['url_bottom_right'][$i] ) ? esc_url( (string) $sb_button_bottom_right['url_bottom_right'][$i] ) : '#';
                echo '<a class="sb_button6 remove' . ( ! empty( $text_br ) ? ' sb_button6_color' : '' ) . '" href="' . $url_br . '" target="_blank">' . $text_br . '</a>';
            }
            ?>
            </div>
        </article>
            <div class="sb_thumbnail">
            <?php
            foreach ( $sb_thumbnail as $sb_thumbnails ) {
                $src = isset( $sb_thumbnails[0] ) ? esc_url( $sb_thumbnails[0] ) : '';
                echo '<img class="sb_thumbnail_right remove" src="' . $src . '" alt="" />';
            }
            ?>
            </div>
    </section>