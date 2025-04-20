<?php

    global $id;
    global $orderby;

    $args = [
        'post_type'   => 'sb-slider',
        'post_status' => 'publish',
        'post__in'    => $id,
        'orderby'     => $orderby,
    ];

    $my_query = new WP_Query($args);
    global $post;

    if ($my_query->have_posts()):
        while ($my_query->have_posts()): $my_query->the_post();

            $button_text_left[]          = get_post_meta(get_the_ID(), 'sb_slider_link_text_left');
            $button_text_center[]        = get_post_meta(get_the_ID(), 'sb_slider_link_text_center');
            $button_text_right[]         = get_post_meta(get_the_ID(), 'sb_slider_link_text_right');
            $button_text_bottom_left[]   = get_post_meta(get_the_ID(), 'sb_slider_link_text_bottom_left');
            $button_text_bottom_center[] = get_post_meta(get_the_ID(), 'sb_slider_link_text_bottom_center');
            $button_text_bottom_right[]  = get_post_meta(get_the_ID(), 'sb_slider_link_text_bottom_right');

            $button_url_left[]          = get_post_meta(get_the_ID(), 'sb_slider_link_url_left');
            $button_url_center[]        = get_post_meta(get_the_ID(), 'sb_slider_link_url_center');
            $button_url_right[]         = get_post_meta(get_the_ID(), 'sb_slider_link_url_right');
            $button_url_bottom_left[]   = get_post_meta(get_the_ID(), 'sb_slider_link_url_bottom_left');
            $button_url_bottom_center[] = get_post_meta(get_the_ID(), 'sb_slider_link_url_bottom_center');
            $button_url_bottom_right[]  = get_post_meta(get_the_ID(), 'sb_slider_link_url_bottom_right');

            $sb_title[]      = get_the_title();
            $sb_content[]    = get_the_content();
            $image_id        = get_post_thumbnail_id($post->ID);
            $sb_main_image[] = wp_get_attachment_image_src($image_id, 'sb_main_img');
            $sb_thumbnail[]  = wp_get_attachment_image_src($image_id, 'medium');
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
        foreach ($sb_thumbnail as $sb_thumbnails) {?>
            <img class="sb_thumbnail_left remove" src="<?php echo $sb_thumbnails[0] ?>" />
        <?php }?>
        </div>
        <article class="sb_main">
            <div class="sb_image_scroll">
                <button class="prev" onclick="prevSlide()">&#10094;</button>
                <?php
                foreach ($sb_main_image as $sb_main_images) {?>
                <div>
                    <img class="sb_main_image remove" src="<?php echo $sb_main_images[0]; ?>" />
                </div>
                <?php
                }?>
                <button class="next" onclick="nextSlide()">&#10095;</button>
            </div>
            <?php
            foreach ($sb_title as $sb_titles) {?>
                <div class="sb_title remove"><?php echo $sb_titles; ?></div>
            <?php }
            foreach ($sb_content as $sb_contents) {?>
                <div class="sb_content remove"><?php echo $sb_contents; ?></div>
            <?php }?>
            <div class="sb_store_buttons">
            <?php for ($i = 0; $i < $sb_length; $i++) {?>
                <a class="sb_button1 remove<?php echo ! empty($sb_button_left['text_left'][$i][0]) ? ' sb_button1_color' : '' ?>" href="<?php echo esc_url($sb_button_left['url_left'][$i][0]); ?>" target="_blank"><?php echo $sb_button_left['text_left'][$i][0];} ?></a>
            <?php for ($i = 0; $i < $sb_length; $i++) {?>
                <a class="sb_button2 remove<?php echo ! empty($sb_button_center['text_center'][$i][0]) ? ' sb_button2_color' : '' ?>" href="<?php echo esc_url($sb_button_center['url_center'][$i][0]); ?>" target="_blank"><?php echo $sb_button_center['text_center'][$i][0];} ?></a>
            <?php for ($i = 0; $i < $sb_length; $i++) {?>
                <a class="sb_button3 remove<?php echo ! empty($sb_button_right['text_right'][$i][0]) ? ' sb_button3_color' : '' ?>" href="<?php echo esc_url($sb_button_right['url_right'][$i][0]); ?>"target="_blank"><?php echo $sb_button_right['text_right'][$i][0];} ?></a>
            <?php for ($i = 0; $i < $sb_length; $i++) {?>
                <a class="sb_button4 remove<?php echo ! empty($sb_button_bottom_left['text_bottom_left'][$i][0]) ? ' sb_button4_color' : '' ?>" href="<?php echo esc_url($sb_button_bottom_left['url_bottom_left'][$i][0]); ?>"target="_blank"><?php echo $sb_button_bottom_left['text_bottom_left'][$i][0];} ?></a>
            <?php for ($i = 0; $i < $sb_length; $i++) {?>
                <a class="sb_button5 remove<?php echo ! empty($sb_button_bottom_center['text_bottom_center'][$i][0]) ? ' sb_button5_color' : '' ?>" href="<?php echo esc_url($sb_button_bottom_center['url_bottom_center'][$i][0]); ?>" target="_blank"><?php echo $sb_button_bottom_center['text_bottom_center'][$i][0];} ?></a>
            <?php for ($i = 0; $i < $sb_length; $i++) {?>
                <a class="sb_button6 remove<?php echo ! empty($sb_button_bottom_right['text_bottom_right'][$i][0]) ? ' sb_button6_color' : '' ?>" href="<?php echo esc_url($sb_button_bottom_right['url_bottom_right'][$i][0]); ?>" target="_blank"><?php echo $sb_button_bottom_right['text_bottom_right'][$i][0];} ?></a>
            </div>
        </article>
            <div class="sb_thumbnail">
            <?php
            foreach ($sb_thumbnail as $sb_thumbnails) {?>
                <img class="sb_thumbnail_right remove" src="<?php echo $sb_thumbnails[0] ?>" />

            <?php }?>
            </div>
    </section>