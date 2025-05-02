<?php

    if (! class_exists('_Slider_Settings')) {
        class Scrapbook_Slider_Settings
        {
            public static $options;

            public function __construct()
            {
                self::$options = get_option('scrapbook_slider_options');
                add_action('admin_init', [$this, 'admin_init']);
               
            }

            public function admin_init()
            {
                register_setting('scrapbook_slider_group', 'scrapbook_slider_options', ([$this, 'scrapbook_slider_validate']));

                //Section Settings
                add_settings_section(
                    'scrapbook_slider_main_section',
                    esc_html__('How does it work?', 'scrapbook-slider'),
                    null,
                    'scrapbook_slider_page1'
                );

                add_settings_section(
                    'scrapbook_slider_second_section',
                    esc_html__('Button Color Options', 'scrapbook-slider'),
                    null,
                    'scrapbook_slider_page2'
                );

                //Settings Fields
                // Field one Main
                add_settings_field(
                    'scrapbook_slider_shortcode',
                    esc_html__('Shortcode', 'scrapbook-slider'),
                    [$this, 'scrapbook_slider_shortcode_callback'],
                    'scrapbook_slider_page1',
                    'scrapbook_slider_main_section'
                );

                add_settings_field(
                    'scrapbook_slider_instructions',
                    esc_html__('Instructions', 'scrapbook-slider'),
                    [$this, 'scrapbook_slider_instructions_callback'],
                    'scrapbook_slider_page1',
                    'scrapbook_slider_main_section'
                );

                //Field 2 Color

                add_settings_field(
                    'scrapbook_slider_title',
                    esc_html__('Slider Title', 'scrapbook-slider'),
                    [$this, 'scrapbook_slider_title_callback'],
                    'scrapbook_slider_page2',
                    'scrapbook_slider_second_section',
                    [
                        'label_for' => 'scrapbook_slider_title',
                    ]
                );

                add_settings_field(
                    'scrapbook_slider_color',
                    esc_html__('Color Changes', 'scrapbook-slider'),
                    [$this, 'scrapbook_slider_color_callback'],
                    'scrapbook_slider_page2',
                    'scrapbook_slider_second_section'
                );

                add_settings_field(
                    'scrapbook_slider_color_left',
                    esc_html__('Left Button Color', 'scrapbook-slider'),
                    [$this, 'scrapbook_slider_color_left_callback'],
                    'scrapbook_slider_page2',
                    'scrapbook_slider_second_section',
                    ['label_for' => 'scrapbook_slider_color_left']
                );

                add_settings_field(
                    'scrapbook_slider_left_font_color',
                    esc_html__('Font Color', 'scrapbook-slider'),
                    [$this, 'scrapbook_slider_left_font_color_callback'],
                    'scrapbook_slider_page2',
                    'scrapbook_slider_second_section',
                    [
                        'items'     => [
                            'Black',
                            'White',
                        ],
                        'label_for' => 'scrapbook_slider_left_font_color',
                    ]

                );

                add_settings_field(
                    'scrapbook_slider_color_center',
                    esc_html__('Center Button Color', 'scrapbook-slider'),
                    [$this, 'scrapbook_slider_color_center_callback'],
                    'scrapbook_slider_page2',
                    'scrapbook_slider_second_section',
                    ['label_for' => 'scrapbook_slider_color_center']
                );

                add_settings_field(
                    'scrapbook_slider_center_font_color',
                    esc_html__('Font Color', 'scrapbook-slider'),
                    [$this, 'scrapbook_slider_center_font_color_callback'],
                    'scrapbook_slider_page2',
                    'scrapbook_slider_second_section',
                    [
                        'items'     => [
                            'Black',
                            'White',
                        ],
                        'label_for' => 'scrapbook_slider_center_font_color',
                    ]

                );

                add_settings_field(
                    'scrapbook_slider_color_right',
                    esc_html__('Right Button Color', 'scrapbook-slider'),
                    [$this, 'scrapbook_slider_color_right_callback'],
                    'scrapbook_slider_page2',
                    'scrapbook_slider_second_section',
                    ['label_for' => 'scrapbook_slider_color_right']
                );

                add_settings_field(
                    'scrapbook_slider_right_font_color',
                    esc_html__('Font Color', 'scrapbook-slider'),
                    [$this, 'scrapbook_slider_right_font_color_callback'],
                    'scrapbook_slider_page2',
                    'scrapbook_slider_second_section',
                    [
                        'items'     => [
                            'Black',
                            'White',
                        ],
                        'label_for' => 'scrapbook_slider_right_font_color',
                    ]
                );

                add_settings_field(
                    'scrapbook_slider_color_bottom_left',
                    esc_html__('Bottom Left Button Color', 'scrapbook-slider'),
                    [$this, 'scrapbook_slider_color_bottom_left_callback'],
                    'scrapbook_slider_page2',
                    'scrapbook_slider_second_section',
                    ['label_for' => 'scrapbook_slider_color_bottom_left']
                );

                add_settings_field(
                    'scrapbook_slider_bottom_left_font_color',
                    esc_html__('Font Color', 'scrapbook-slider'),
                    [$this, 'scrapbook_slider_bottom_left_font_color_callback'],
                    'scrapbook_slider_page2',
                    'scrapbook_slider_second_section',
                    [
                        'items'     => [
                            'Black',
                            'White',
                        ],
                        'label_for' => 'scrapbook_slider_bottom_left_font_color',
                    ]

                );

                add_settings_field(
                    'scrapbook_slider_color_bottom_center',
                    esc_html__('Bottom Center Button Color', 'scrapbook-slider'),
                    [$this, 'scrapbook_slider_color_bottom_center_callback'],
                    'scrapbook_slider_page2',
                    'scrapbook_slider_second_section',
                    ['label_for' => 'scrapbook_slider_color_bottom_center']
                );

                add_settings_field(
                    'scrapbook_slider_bottom_center_font_color',
                    esc_html__('Font Color', 'scrapbook-slider'),
                    [$this, 'scrapbook_slider_bottom_center_font_color_callback'],
                    'scrapbook_slider_page2',
                    'scrapbook_slider_second_section',
                    [
                        'items'     => [
                            'Black',
                            'White',
                        ],
                        'label_for' => 'scrapbook_slider_bottom_center_font_color',
                    ]

                );

                add_settings_field(
                    'scrapbook_slider_color_bottom_right',
                    esc_html__('Bottom Right Button Color', 'scrapbook-slider'),
                    [$this, 'scrapbook_slider_color_bottom_right_callback'],
                    'scrapbook_slider_page2',
                    'scrapbook_slider_second_section',
                    ['label_for' => 'scrapbook_slider_color_bottom_right']
                );

                add_settings_field(
                    'scrapbook_slider_bottom_right_font_color',
                    esc_html__('Font Color', 'scrapbook-slider'),
                    [$this, 'scrapbook_slider_bottom_right_font_color_callback'],
                    'scrapbook_slider_page2',
                    'scrapbook_slider_second_section',
                    [
                        'items'     => [
                            'Black',
                            'White',
                        ],
                        'label_for' => 'scrapbook_slider_bottom_right_font_color',
                    ]

                );
            }

            public function scrapbook_slider_shortcode_callback()
            {
            ?>
<span><?php esc_html_e('Use the shortcode [scrapbook_slider] to display in any page', 'scrapbook-slider')?></span>
<?php
    }

            public function scrapbook_slider_instructions_callback()
            {
            ?>
<span><?php esc_html_e('1. Place shortcode in an ungrouped section of page.', 'scrapbook-slider')?></span> </br>
<span><?php esc_html_e('2. Please download a regenerate thumbnail plugin.', 'scrapbook-slider')?></span> </br>
<span><?php esc_html_e('This is needed to setup main image correctly.', 'scrapbook-slider')?>.</span>
<?php
    }

            public function scrapbook_slider_color_callback()
            {
            ?>
<span><?php esc_html_e('Use hex code with # to input color. Default #D3D3D3', 'scrapbook-slider')?></span>
<?php
    }

            public function scrapbook_slider_title_callback($args)
            {
            ?>
            <input
            type="text"
            name="scrapbook_slider_options[scrapbook_slider_title]"
            id="scrapbook_slider_title"
            value="<?php echo isset(self::$options['scrapbook_slider_title']) ? esc_attr(self::$options['scrapbook_slider_title']) : ''; ?>"
            >
        <?php
            }

                    public function scrapbook_slider_color_left_callback()
                    {
                    ?>
<input type="text" name="scrapbook_slider_options[scrapbook_slider_color_left]" id="scrapbook_slider_color_left" value="<?php echo isset(self::$options['scrapbook_slider_color_left']) ? esc_attr(self::$options['scrapbook_slider_color_left']) : ''; ?>">
<?php
    }

            public function scrapbook_slider_left_font_color_callback($args)
            {
            ?>
<select
id="scrapbook_slider_left_font_color"
name="scrapbook_slider_options[scrapbook_slider_left_font_color]">
<?php
    foreach ($args['items'] as $item):
            ?>
<option value="<?php echo esc_attr($item); ?>"
<?php
    isset(self::$options['scrapbook_slider_left_font_color']) ? selected($item, self::$options['scrapbook_slider_left_font_color'], true) : '';
            ?>
>
<?php echo esc_html(ucfirst($item)); ?>
</option>
<?php endforeach; ?>
</select>
<?php
    }

            public function scrapbook_slider_color_center_callback()
            {
            ?>
<input type="text" name="scrapbook_slider_options[scrapbook_slider_color_center]" id="_scrapbookslider_color_center" value="<?php echo isset(self::$options['scrapbook_slider_color_center']) ? esc_attr(self::$options['scrapbook_slider_color_center']) : ''; ?>">
<?php
    }

            public function scrapbook_slider_center_font_color_callback($args)
            {
            ?>
<select
id="scrapbook_slider_center_font_color"
name="scrapbook_slider_options[scrapbook_slider_center_font_color]">
<?php
    foreach ($args['items'] as $item):
            ?>
<option value="<?php echo esc_attr($item); ?>"
<?php
    isset(self::$options['scrapbook_slider_center_font_color']) ? selected($item, self::$options['scrapbook_slider_center_font_color'], true) : '';
            ?>
>
<?php echo esc_html(ucfirst($item)); ?>
</option>
<?php endforeach; ?>
</select>
<?php
    }

            public function scrapbook_slider_color_right_callback()
            {

            ?>
<input type="text" name="scrapbook_slider_options[scrapbook_slider_color_right]" id="scrapbook_slider_color_right" value="<?php echo isset(self::$options['scrapbook_slider_color_right']) ? esc_attr(self::$options['scrapbook_slider_color_right']) : ''; ?>">
<?php
    }

            public function scrapbook_slider_right_font_color_callback($args)
            {
            ?>
<select
id="scrapbook_slider_right_font_color"
name="scrapbook_slider_options[scrapbook_slider_right_font_color]">
<?php
    foreach ($args['items'] as $item):
            ?>
<option value="<?php echo esc_attr($item); ?>"
<?php
    isset(self::$options['scrapbook_slider_right_font_color']) ? selected($item, self::$options['scrapbook_slider_right_font_color'], true) : '';
            ?>
>
<?php echo esc_html(ucfirst($item)); ?>
</option>
<?php endforeach; ?>
</select>
<?php
    }

            public function scrapbook_slider_color_bottom_left_callback()
            {
            ?>
<input type="text" name="scrapbook_slider_options[scrapbook_slider_color_bottom_left]" id="scrapbook_slider_color_bottom_left" value="<?php echo isset(self::$options['scrapbook_slider_color_bottom_left']) ? esc_attr(self::$options['scrapbook_slider_color_bottom_left']) : ''; ?>">
<?php
    }

            public function scrapbook_slider_bottom_left_font_color_callback($args)
            {
            ?>
<select
id="scrapbook_slider_bottom_left_font_color"
name="scrapbook_slider_options[scrapbook_slider_bottom_left_font_color]">
<?php
    foreach ($args['items'] as $item):
            ?>
<option value="<?php echo esc_attr($item); ?>"
<?php
    isset(self::$options['scrapbook_slider_bottom_left_font_color']) ? selected($item, self::$options['scrapbook_slider_bottom_left_font_color'], true) : '';
            ?>
>
<?php echo esc_html(ucfirst($item)); ?>
</option>
<?php endforeach; ?>
</select>
<?php
    }

            public function scrapbook_slider_color_bottom_center_callback()
            {
            ?>
<input type="text" name="scrapbook_slider_options[scrapbook_slider_color_bottom_center]" id="scrapbook_slider_color_bottom_center" value="<?php echo isset(self::$options['scrapbook_slider_color_bottom_center']) ? esc_attr(self::$options['scrapbook_slider_color_bottom_center']) : ''; ?>">
<?php
    }

            public function scrapbook_slider_bottom_center_font_color_callback($args)
            {
            ?>
<select
id="scrapbook_slider_bottom_center_font_color"
name="scrapbook_slider_options[scrapbook_slider_bottom_center_font_color]">
<?php
    foreach ($args['items'] as $item):
            ?>
<option value="<?php echo esc_attr($item); ?>"
<?php
    isset(self::$options['scrapbook_slider_bottom_center_font_color']) ? selected($item, self::$options['scrapbook_slider_bottom_center_font_color'], true) : '';
            ?>
>
<?php echo esc_html(ucfirst($item)); ?>
</option>
<?php endforeach; ?>
</select>
<?php
    }

            public function scrapbook_slider_color_bottom_right_callback()
            {

            ?>
<input type="text" name="scrapbook_slider_options[scrapbook_slider_color_bottom_right]" id="scrapbook_slider_color_bottom_right" value="<?php echo isset(self::$options['scrapbook_slider_color_bottom_right']) ? esc_attr(self::$options['scrapbook_slider_color_bottom_right']) : ''; ?>">
<?php
    }

            public function scrapbook_slider_bottom_right_font_color_callback($args)
            {
            ?>
<select
id="scrapbook_slider_bottom_right_font_color"
name="scrapbook_slider_options[scrapbook_slider_bottom_right_font_color]">
<?php
    foreach ($args['items'] as $item):
            ?>
<option value="<?php echo esc_attr($item); ?>"
<?php
    isset(self::$options['scrapbook_slider_bottom_right_font_color']) ? selected($item, self::$options['scrapbook_slider_bottom_right_font_color'], true) : '';
            ?>
>
<?php echo esc_html(ucfirst($item)); ?>
</option>
<?php endforeach; ?>
</select>
<?php
    }

            public function scrapbook_slider_validate($input)
            {
                $new_input = [];
                foreach ($input as $key => $value) {
                    switch ($key) {
                        case 'scrapbook_slider_title':
                            if (empty($value)) {
                                add_settings_error('scrapbook_slider_options', 'scrapbook_slider_message', esc_html__('The title field can not be left empty', 'scrapbook-slider'), 'error');
                                $value = esc_html__('Please, type some text', 'scrapbook-slider');
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
