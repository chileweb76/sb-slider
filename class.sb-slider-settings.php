<?php

    if (! class_exists('SB_Slider_Settings')) {
        class SB_Slider_Settings
        {
            public static $options;

            public function __construct()
            {
                self::$options = get_option('sb_slider_options');
                add_action('admin_init', [$this, 'admin_init']);

            }

            public function admin_init()
            {
                register_setting('sb_slider_group', 'sb_slider_options', sanitize_text_field([$this, 'sb_slider_validate']));

                //Section Settings
                add_settings_section(
                    'sb_slider_main_section',
                    esc_html__('How does it work?', 'sb-slider'),
                    null,
                    'sb_slider_page1'
                );

                add_settings_section(
                    'sb_slider_second_section',
                    esc_html__('Button Color Options', 'sb-slider'),
                    null,
                    'sb_slider_page2'
                );

                //Settings Fields
                // Field one Main
                add_settings_field(
                    'sb_slider_shortcode',
                    esc_html__('Shortcode', 'sb-slider'),
                    [$this, 'sb_slider_shortcode_callback'],
                    'sb_slider_page1',
                    'sb_slider_main_section'
                );

                add_settings_field(
                    'sb_slider_instructions',
                    esc_html__('Instructions', 'sb-slider'),
                    [$this, 'sb_slider_instructions_callback'],
                    'sb_slider_page1',
                    'sb_slider_main_section'
                );

                //Field 2 Color

                add_settings_field(
                    'sb_slider_title',
                    esc_html__('Slider Title', 'sb-slider'),
                    [$this, 'sb_slider_title_callback'],
                    'sb_slider_page2',
                    'sb_slider_second_section',
                    [
                        'label_for' => 'sb_slider_title',
                    ]
                );

                add_settings_field(
                    'sb_slider_color',
                    esc_html__('Color Changes', 'sb-slider'),
                    [$this, 'sb_slider_color_callback'],
                    'sb_slider_page2',
                    'sb_slider_second_section'
                );

                add_settings_field(
                    'sb_slider_color_left',
                    esc_html__('Left Button Color', 'sb-slider'),
                    [$this, 'sb_slider_color_left_callback'],
                    'sb_slider_page2',
                    'sb_slider_second_section',
                    ['label_for' => 'sb_slider_color_left']
                );

                add_settings_field(
                    'sb_slider_left_font_color',
                    esc_html__('Font Color', 'sb-slider'),
                    [$this, 'sb_slider_left_font_color_callback'],
                    'sb_slider_page2',
                    'sb_slider_second_section',
                    [
                        'items'     => [
                            'Black',
                            'White',
                        ],
                        'label_for' => 'sb_slider_left_font_color',
                    ]

                );

                add_settings_field(
                    'sb_slider_color_center',
                    esc_html__('Center Button Color', 'sb-slider'),
                    [$this, 'sb_slider_color_center_callback'],
                    'sb_slider_page2',
                    'sb_slider_second_section',
                    ['label_for' => 'sb_slider_color_center']
                );

                add_settings_field(
                    'sb_slider_center_font_color',
                    esc_html__('Font Color', 'sb-slider'),
                    [$this, 'sb_slider_center_font_color_callback'],
                    'sb_slider_page2',
                    'sb_slider_second_section',
                    [
                        'items'     => [
                            'Black',
                            'White',
                        ],
                        'label_for' => 'sb_slider_center_font_color',
                    ]

                );

                add_settings_field(
                    'sb_slider_color_right',
                    esc_html__('Right Button Color', 'sb-slider'),
                    [$this, 'sb_slider_color_right_callback'],
                    'sb_slider_page2',
                    'sb_slider_second_section',
                    ['label_for' => 'sb_slider_color_right']
                );

                add_settings_field(
                    'sb_slider_right_font_color',
                    esc_html__('Font Color', 'sb-slider'),
                    [$this, 'sb_slider_right_font_color_callback'],
                    'sb_slider_page2',
                    'sb_slider_second_section',
                    [
                        'items'     => [
                            'Black',
                            'White',
                        ],
                        'label_for' => 'sb_slider_right_font_color',
                    ]
                );

                add_settings_field(
                    'sb_slider_color_bottom_left',
                    esc_html__('Bottom Left Button Color', 'sb-slider'),
                    [$this, 'sb_slider_color_bottom_left_callback'],
                    'sb_slider_page2',
                    'sb_slider_second_section',
                    ['label_for' => 'sb_slider_color_bottom_left']
                );

                add_settings_field(
                    'sb_slider_bottom_left_font_color',
                    esc_html__('Font Color', 'sb-slider'),
                    [$this, 'sb_slider_bottom_left_font_color_callback'],
                    'sb_slider_page2',
                    'sb_slider_second_section',
                    [
                        'items'     => [
                            'Black',
                            'White',
                        ],
                        'label_for' => 'sb_slider_bottom_left_font_color',
                    ]

                );

                add_settings_field(
                    'sb_slider_color_bottom_center',
                    esc_html__('Bottom Center Button Color', 'sb-slider'),
                    [$this, 'sb_slider_color_bottom_center_callback'],
                    'sb_slider_page2',
                    'sb_slider_second_section',
                    ['label_for' => 'sb_slider_color_bottom_center']
                );

                add_settings_field(
                    'sb_slider_bottom_center_font_color',
                    esc_html__('Font Color', 'sb-slider'),
                    [$this, 'sb_slider_bottom_center_font_color_callback'],
                    'sb_slider_page2',
                    'sb_slider_second_section',
                    [
                        'items'     => [
                            'Black',
                            'White',
                        ],
                        'label_for' => 'sb_slider_bottom_center_font_color',
                    ]

                );

                add_settings_field(
                    'sb_slider_color_bottom_right',
                    esc_html__('Bottom Right Button Color', 'sb-slider'),
                    [$this, 'sb_slider_color_bottom_right_callback'],
                    'sb_slider_page2',
                    'sb_slider_second_section',
                    ['label_for' => 'sb_slider_color_bottom_right']
                );

                add_settings_field(
                    'sb_slider_bottom_right_font_color',
                    esc_html__('Font Color', 'sb-slider'),
                    [$this, 'sb_slider_bottom_right_font_color_callback'],
                    'sb_slider_page2',
                    'sb_slider_second_section',
                    [
                        'items'     => [
                            'Black',
                            'White',
                        ],
                        'label_for' => 'sb_slider_bottom_right_font_color',
                    ]

                );
            }

            public function sb_slider_shortcode_callback()
            {
            ?>
<span><?php esc_html_e('Use the shortcode [sb_slider] to display in any page/post/widget.', 'sb-slider')?></span>
<?php
    }

            public function sb_slider_instructions_callback()
            {
            ?>
<span><?php esc_html_e('Please download a regenerate thumbnail plugin.', 'sb-slider')?></span> </br>
<span><?php esc_html_e('This is needed to setup main image correctly.', 'sb-slider')?>.</span>
<?php
    }

            public function sb_slider_color_callback()
            {
            ?>
<span><?php esc_html_e('Use hex code to input color.', 'sb-slider')?></span>
<?php
    }

            public function sb_slider_title_callback($args)
            {
            ?>
            <input
            type="text"
            name="sb_slider_options[sb_slider_title]"
            id="sb_slider_title"
            value="<?php echo isset(self::$options['sb_slider_title']) ? esc_attr(self::$options['sb_slider_title']) : ''; ?>"
            >
        <?php
            }

                    public function sb_slider_color_left_callback()
                    {
                    ?>
<input type="text" name="sb_slider_options[sb_slider_color_left]" id="sb_slider_color_left" value="<?php echo isset(self::$options['sb_slider_color_left']) ? esc_attr(self::$options['sb_slider_color_left']) : ''; ?>">
<?php
    }

            public function sb_slider_left_font_color_callback($args)
            {
            ?>
<select
id="sb_slider_left_font_color"
name="sb_slider_options[sb_slider_left_font_color]">
<?php
    foreach ($args['items'] as $item):
            ?>
<option value="<?php echo esc_attr($item); ?>"
<?php
    isset(self::$options['sb_slider_left_font_color']) ? selected($item, self::$options['sb_slider_left_font_color'], true) : '';
            ?>
>
<?php echo esc_html(ucfirst($item)); ?>
</option>
<?php endforeach; ?>
</select>
<?php
    }

            public function sb_slider_color_center_callback()
            {
            ?>
<input type="text" name="sb_slider_options[sb_slider_color_center]" id="sb_slider_color_center" value="<?php echo isset(self::$options['sb_slider_color_center']) ? esc_attr(self::$options['sb_slider_color_center']) : ''; ?>">
<?php
    }

            public function sb_slider_center_font_color_callback($args)
            {
            ?>
<select
id="sb_slider_center_font_color"
name="sb_slider_options[sb_slider_center_font_color]">
<?php
    foreach ($args['items'] as $item):
            ?>
<option value="<?php echo esc_attr($item); ?>"
<?php
    isset(self::$options['sb_slider_center_font_color']) ? selected($item, self::$options['sb_slider_center_font_color'], true) : '';
            ?>
>
<?php echo esc_html(ucfirst($item)); ?>
</option>
<?php endforeach; ?>
</select>
<?php
    }

            public function sb_slider_color_right_callback()
            {

            ?>
<input type="text" name="sb_slider_options[sb_slider_color_right]" id="sb_slider_color_right" value="<?php echo isset(self::$options['sb_slider_color_right']) ? esc_attr(self::$options['sb_slider_color_right']) : ''; ?>">
<?php
    }

            public function sb_slider_right_font_color_callback($args)
            {
            ?>
<select
id="sb_slider_right_font_color"
name="sb_slider_options[sb_slider_right_font_color]">
<?php
    foreach ($args['items'] as $item):
            ?>
<option value="<?php echo esc_attr($item); ?>"
<?php
    isset(self::$options['sb_slider_right_font_color']) ? selected($item, self::$options['sb_slider_right_font_color'], true) : '';
            ?>
>
<?php echo esc_html(ucfirst($item)); ?>
</option>
<?php endforeach; ?>
</select>
<?php
    }

            public function sb_slider_color_bottom_left_callback()
            {
            ?>
<input type="text" name="sb_slider_options[sb_slider_color_bottom_left]" id="sb_slider_color_bottom_left" value="<?php echo isset(self::$options['sb_slider_color_bottom_left']) ? esc_attr(self::$options['sb_slider_color_bottom_left']) : ''; ?>">
<?php
    }

            public function sb_slider_bottom_left_font_color_callback($args)
            {
            ?>
<select
id="sb_slider_bottom_left_font_color"
name="sb_slider_options[sb_slider_bottom_left_font_color]">
<?php
    foreach ($args['items'] as $item):
            ?>
<option value="<?php echo esc_attr($item); ?>"
<?php
    isset(self::$options['sb_slider_bottom_left_font_color']) ? selected($item, self::$options['sb_slider_bottom_left_font_color'], true) : '';
            ?>
>
<?php echo esc_html(ucfirst($item)); ?>
</option>
<?php endforeach; ?>
</select>
<?php
    }

            public function sb_slider_color_bottom_center_callback()
            {
            ?>
<input type="text" name="sb_slider_options[sb_slider_color_bottom_center]" id="sb_slider_color_bottom_center" value="<?php echo isset(self::$options['sb_slider_color_bottom_center']) ? esc_attr(self::$options['sb_slider_color_bottom_center']) : ''; ?>">
<?php
    }

            public function sb_slider_bottom_center_font_color_callback($args)
            {
            ?>
<select
id="sb_slider_bottom_center_font_color"
name="sb_slider_options[sb_slider_bottom_center_font_color]">
<?php
    foreach ($args['items'] as $item):
            ?>
<option value="<?php echo esc_attr($item); ?>"
<?php
    isset(self::$options['sb_slider_bottom_center_font_color']) ? selected($item, self::$options['sb_slider_bottom_center_font_color'], true) : '';
            ?>
>
<?php echo esc_html(ucfirst($item)); ?>
</option>
<?php endforeach; ?>
</select>
<?php
    }

            public function sb_slider_color_bottom_right_callback()
            {

            ?>
<input type="text" name="sb_slider_options[sb_slider_color_bottom_right]" id="sb_slider_color_bottom_right" value="<?php echo isset(self::$options['sb_slider_color_bottom_right']) ? esc_attr(self::$options['sb_slider_color_bottom_right']) : ''; ?>">
<?php
    }

            public function sb_slider_bottom_right_font_color_callback($args)
            {
            ?>
<select
id="sb_slider_bottom_right_font_color"
name="sb_slider_options[sb_slider_bottom_right_font_color]">
<?php
    foreach ($args['items'] as $item):
            ?>
<option value="<?php echo esc_attr($item); ?>"
<?php
    isset(self::$options['sb_slider_bottom_right_font_color']) ? selected($item, self::$options['sb_slider_bottom_right_font_color'], true) : '';
            ?>
>
<?php echo esc_html(ucfirst($item)); ?>
</option>
<?php endforeach; ?>
</select>
<?php
    }

            public function sb_slider_validate($input)
            {
                $new_input = [];
                foreach ($input as $key => $value) {
                    switch ($key) {
                        case 'sb_slider_title':
                            if (empty($value)) {
                                add_settings_error('sb_slider_options', 'sb_slider_message', esc_html__('The title field can not be left empty', 'sb-slider'), 'error');
                                $value = esc_html__('Please, type some text', 'sb-slider');
                            }
                            $new_input[$key] = sanitize_text_field($value);
                            break;
                        default:
                            $new_input[$key] = sanitize_text_field($value);
                            break;
                    }
                }
                return $new_input;
            }

        }

}
