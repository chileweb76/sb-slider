<?php
if ( ! defined( 'ABSPATH' ) ) exit;

    global $id;
    global $orderby;

    $args = [
        'post_type'   => 'scrapbook-slider',
        'post_status' => 'publish',
        'post__in'    => $id,
        'orderby'     => $orderby,
    ];

    $my_query = new WP_Query($args);
    global $post;

    if ($my_query->have_posts()):
        while ($my_query->have_posts()): $my_query->the_post();

            $button_text_left[]          = get_post_meta(get_the_ID(), 'scrapbook_slider_link_text_left');
            $button_text_center[]        = get_post_meta(get_the_ID(), 'scrapbook_slider_link_text_center');
            $button_text_right[]         = get_post_meta(get_the_ID(), 'scrapbook_slider_link_text_right');
            $button_text_bottom_left[]   = get_post_meta(get_the_ID(), 'scrapbook_slider_link_text_bottom_left');
            $button_text_bottom_center[] = get_post_meta(get_the_ID(), 'scrapbook_slider_link_text_bottom_center');
            $button_text_bottom_right[]  = get_post_meta(get_the_ID(), 'scrapbook_slider_link_text_bottom_right');

            $button_url_left[]          = get_post_meta(get_the_ID(), 'scrapbook_slider_link_url_left');
            $button_url_center[]        = get_post_meta(get_the_ID(), 'scrapbook_slider_link_url_center');
            $button_url_right[]         = get_post_meta(get_the_ID(), 'scrapbook_slider_link_url_right');
            $button_url_bottom_left[]   = get_post_meta(get_the_ID(), 'scrapbook_slider_link_url_bottom_left');
            $button_url_bottom_center[] = get_post_meta(get_the_ID(), 'scrapbook_slider_link_url_bottom_center');
            $button_url_bottom_right[]  = get_post_meta(get_the_ID(), 'scrapbook_slider_link_url_bottom_right');

            $scrapbook_title[]      = get_the_title();
            $scrapbook_content[]    = get_the_content();
            $image_id        = get_post_thumbnail_id($post->ID);
            $scrapbook_main_image[] = wp_get_attachment_image_src($image_id, 'scrapbook_main_img');
            $scrapbook_thumbnail[]  = wp_get_attachment_image_src($image_id, 'medium');

            
        ?>
		<div class="index"><?php the_title()?></div>
		<?php
                endwhile;
                wp_reset_postdata();
            endif;
            $scrapbook_button_left          = [];
            $scrapbook_button_left          = ['text_left' => $button_text_left, 'url_left' => $button_url_left];
            $scrapbook_button_center        = [];
            $scrapbook_button_center        = ['text_center' => $button_text_center, 'url_center' => $button_url_center];
            $scrapbook_button_right         = [];
            $scrapbook_button_right         = ['text_right' => $button_text_right, 'url_right' => $button_url_right];
            $scrapbook_button_bottom_left   = [];
            $scrapbook_button_bottom_left   = ['text_bottom_left' => $button_text_bottom_left, 'url_bottom_left' => $button_url_bottom_left];
            $scrapbook_button_bottom_center = [];
            $scrapbook_button_bottom_center = ['text_bottom_center' => $button_text_bottom_center, 'url_bottom_center' => $button_url_bottom_center];
            $scrapbook_button_bottom_right  = [];
            $scrapbook_button_bottom_right  = ['text_bottom_right' => $button_text_bottom_right, 'url_bottom_right' => $button_url_bottom_right];

            $scrapbook_length = count($scrapbook_button_left['text_left']);
        ?>
    <section class="scrapbook_carousel">
        <div class="scrapbook_thumbnail">
        <?php
        foreach ($scrapbook_thumbnail as $scrapbook_thumbnails) {?>
            <img class="scrapbook_thumbnail_left remove" src="<?php echo esc_html($scrapbook_thumbnails[0]) ?>" />
        <?php }?>
        </div>
        <article class="scrapbook_main">
            <div class="scrapbook_image_scroll">
                <button class="prev" onclick="prevSlide()">&#10094;</button>
                <?php
                foreach ($scrapbook_main_image as $scrapbook_main_images) {?>
                <div>
                    <img class="scrapbook_main_image remove" src="<?php echo esc_html($scrapbook_main_images[0]); ?>" />
                </div>
                <?php
                }?>
                <button class="next" onclick="nextSlide()">&#10095;</button>
            </div>
            <?php
            foreach ($scrapbook_title as $scrapbook_titles) {?>
                <div class="scrapbook_title remove"><?php echo esc_html($scrapbook_titles); ?></div>
            <?php }
            foreach ($scrapbook_content as $scrapbook_contents) {?>
                <div class="scrapbook_content remove"><?php echo wp_kses_post(apply_filters('the_content', $scrapbook_contents)); ?></div>
            <?php }?>
            <div class="scrapbook_store_buttons">
            <?php for ($i = 0; $i < $scrapbook_length; $i++) { ?>
                <a class="scrapbook_button1 remove<?php echo ! empty($scrapbook_button_left['text_left'][$i][0]) ? ' scrapbook_button1_color' : '' ?>" href="<?php echo esc_url($scrapbook_button_left['url_left'][$i][0]); ?>" target="_blank"><?php echo esc_html($scrapbook_button_left['text_left'][$i][0]);} ?></a>
            <?php for ($i = 0; $i < $scrapbook_length; $i++) {?>
                <a class="scrapbook_button2 remove<?php echo ! empty($scrapbook_button_center['text_center'][$i][0]) ? ' scrapbook_button2_color' : '' ?>" href="<?php echo esc_url($scrapbook_button_center['url_center'][$i][0]); ?>" target="_blank"><?php echo esc_html($scrapbook_button_center['text_center'][$i][0]);} ?></a>
            <?php for ($i = 0; $i < $scrapbook_length; $i++) {?>
                <a class="scrapbook_button3 remove<?php echo ! empty($scrapbook_button_right['text_right'][$i][0]) ? ' scrapbook_button3_color' : '' ?>" href="<?php echo esc_url($scrapbook_button_right['url_right'][$i][0]); ?>"target="_blank"><?php echo esc_html($scrapbook_button_right['text_right'][$i][0]);} ?></a>
            <?php for ($i = 0; $i < $scrapbook_length; $i++) {?>
                <a class="scrapbook_button4 remove<?php echo ! empty($scrapbook_button_bottom_left['text_bottom_left'][$i][0]) ? ' scrapbook_button4_color' : '' ?>" href="<?php echo esc_url($scrapbook_button_bottom_left['url_bottom_left'][$i][0]); ?>"target="_blank"><?php echo esc_html($scrapbook_button_bottom_left['text_bottom_left'][$i][0]);} ?></a>
            <?php for ($i = 0; $i < $scrapbook_length; $i++) {?>
                <a class="scrapbook_button5 remove<?php echo ! empty($scrapbook_button_bottom_center['text_bottom_center'][$i][0]) ? ' scrapbook_button5_color' : '' ?>" href="<?php echo esc_url($scrapbook_button_bottom_center['url_bottom_center'][$i][0]); ?>" target="_blank"><?php echo esc_html($scrapbook_button_bottom_center['text_bottom_center'][$i][0]);} ?></a>
            <?php for ($i = 0; $i < $scrapbook_length; $i++) {?>
                <a class="scrapbook_button6 remove<?php echo ! empty($scrapbook_button_bottom_right['text_bottom_right'][$i][0]) ? ' scrapbook_button6_color' : '' ?>" href="<?php echo esc_url($scrapbook_button_bottom_right['url_bottom_right'][$i][0]); ?>" target="_blank"><?php echo esc_html($scrapbook_button_bottom_right['text_bottom_right'][$i][0]);} ?></a>
            </div>
        </article>
            <div class="scrapbook_thumbnail">
            <?php
            foreach ($scrapbook_thumbnail as $scrapbook_thumbnails) {?>
                <img class="scrapbook_thumbnail_right remove" src="<?php echo esc_html($scrapbook_thumbnails[0]) ?>" />

            <?php }?>
            </div>
    </section>