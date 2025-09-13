
<?php
if ( ! defined( 'ABSPATH' ) ) {
    // Allow tests to include this file: when PHPUnit is running we avoid exiting so tests can load class definitions.
    if ( ! defined( 'PHPUNIT_COMPOSER_INSTALL' ) ) {
        exit; // Exit if accessed directly in normal runtime
    }
    // When running under PHPUnit, define a benign ABSPATH so the rest of the file loads.
    if ( ! defined( 'ABSPATH' ) ) {
        define( 'ABSPATH', __DIR__ . '/' );
    }
}

    if (! class_exists('SB_Slider_Settings')) {
        class SB_Slider_Settings
        {
            /**
             * Plugin options array.
             *
             * @var array<string,mixed>
             */
            public static array $options = [];

            /**
             * Get option value as string safely.
             *
             * @param string $key
             * @param string $default
             * @return string
             */
            public static function get_option_string( string $key, string $default = '' ): string
            {
                if ( isset( self::$options[ $key ] ) && is_scalar( self::$options[ $key ] ) ) {
                    return (string) self::$options[ $key ];
                }
                return $default;
            }

            /**
             * Safely cast mixed values to string.
             *
             * @param mixed $val
             * @return string
             */
            private static function safe_string( $val ): string
            {
                if ( is_scalar( $val ) ) {
                    return (string) $val;
                }
                return '';
            }

            public function __construct()
            {
                // Ensure options is always an array for typed property safety.
                $raw_opts = (array) get_option( 'sb_slider_options', [] );
                // Normalize keys to strings to satisfy static analysis expectations
                $normalized = [];
                foreach ( $raw_opts as $k => $v ) {
                    $normalized[ (string) $k ] = $v;
                }
                self::$options = $normalized;
                add_action('admin_init', [$this, 'admin_init']);

            }

            /**
             * Register settings, sections and fields.
             *
             * @return void
             */
            public function admin_init(): void
            {
                register_setting(
                    'sb_slider_group', 
                    'sb_slider_options', 
                    [
                        // Use a dedicated sanitize callback to clean the options array
                        'sanitize_callback' => [$this, 'sanitize_options']
                    ]
                );

                //Section Settings
                add_settings_section(
                    'sb_slider_main_section',
                    esc_html__('How does it work?', 'sb-slider'),
                    '__return_null',
                    'sb_slider_page1'
                );

                add_settings_section(
                    'sb_slider_second_section',
                    esc_html__('Button Color Options', 'sb-slider'),
                    '__return_null',
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

            /**
             * Sanitize the options array before saving.
             *
             * @param array<string,mixed> $input
             * @return array<string,mixed>
             */
            public function sanitize_options(array $input = []): array
            {
                $output = [];

                foreach ($input as $key => $value) {
                    if ( is_array( $value ) ) {
                        // Recursively sanitize arrays
                        $output[ $key ] = array_map( 'sanitize_text_field', $value );
                        continue;
                    }

                    // For known color and title fields use text sanitization
                    $output[ $key ] = sanitize_text_field( self::safe_string( $value ) );
                }

                return $output;
            }

            /**
             * Output the shortcode help text.
             *
             * @return void
             */
            public function sb_slider_shortcode_callback(): void
            {
            ?>
<span><?php esc_html_e('Use the shortcode [sb_slider] to display in any page/post/widget.', 'sb-slider')?></span>
<?php
    }

            /**
             * Output instructions text.
             *
             * @return void
             */
            public function sb_slider_instructions_callback(): void
            {
            ?>
<span><?php esc_html_e('Please download a regenerate thumbnail plugin.', 'sb-slider')?></span> </br>
<span><?php esc_html_e('This is needed to setup main image correctly.', 'sb-slider')?>.</span>
<?php
    }

            /**
             * Output color help text.
             *
             * @return void
             */
            public function sb_slider_color_callback(): void
            {
            ?>
<span><?php esc_html_e('Use hex code to input color.', 'sb-slider')?></span>
<?php
    }

            /**
             * Title field callback.
             *
             * @param array<string,mixed> $args
             * @return void
             */
            public function sb_slider_title_callback(array $args = []): void
            {
            ?>
            <input
            type="text"
            name="sb_slider_options[sb_slider_title]"
            id="sb_slider_title"
            value="<?php echo esc_attr( self::get_option_string( 'sb_slider_title' ) ); ?>"
            >
        <?php
            }

                    /**
                     * Left color input callback.
                     *
                     * @return void
                     */
                    public function sb_slider_color_left_callback(): void
                    {
                    ?>
<input type="text" name="sb_slider_options[sb_slider_color_left]" id="sb_slider_color_left" value="<?php echo esc_attr( self::get_option_string( 'sb_slider_color_left' ) ); ?>">
<?php
    }

            /**
             * Left font color select callback.
             *
             * @param array<string,mixed> $args
             * @return void
             */
            public function sb_slider_left_font_color_callback(array $args = []): void
            {
            ?>
<select id="sb_slider_left_font_color" name="sb_slider_options[sb_slider_left_font_color]">
<?php
    $items = isset($args['items']) ? (array) $args['items'] : [];
    $current = self::get_option_string( 'sb_slider_left_font_color' );
    foreach ($items as $item):
        $item_s = self::safe_string( $item );
        ?>
        <option value="<?php echo esc_attr($item_s); ?>" <?php selected($item_s, $current, true); ?>><?php echo esc_html(ucfirst($item_s)); ?></option>
    <?php endforeach; ?>
</select>
<?php
    }

            /**
             * Center color input callback.
             *
             * @return void
             */
            public function sb_slider_color_center_callback(): void
            {
            ?>
<input type="text" name="sb_slider_options[sb_slider_color_center]" id="sb_slider_color_center" value="<?php echo esc_attr( self::get_option_string( 'sb_slider_color_center' ) ); ?>">
<?php
    }

            /**
             * Center font color select callback.
             *
             * @param array<string,mixed> $args
             * @return void
             */
            public function sb_slider_center_font_color_callback(array $args = []): void
            {
            ?>
<select id="sb_slider_center_font_color" name="sb_slider_options[sb_slider_center_font_color]">
<?php
    $items = isset($args['items']) ? (array) $args['items'] : [];
    $current = self::get_option_string( 'sb_slider_center_font_color' );
    foreach ($items as $item):
        $item_s = self::safe_string( $item );
        ?>
        <option value="<?php echo esc_attr($item_s); ?>" <?php selected($item_s, $current, true); ?>><?php echo esc_html(ucfirst($item_s)); ?></option>
    <?php endforeach; ?>
</select>
<?php
    }

            /**
             * Right color input callback.
             *
             * @return void
             */
            public function sb_slider_color_right_callback(): void
            {

            ?>
<input type="text" name="sb_slider_options[sb_slider_color_right]" id="sb_slider_color_right" value="<?php echo esc_attr( self::get_option_string( 'sb_slider_color_right' ) ); ?>">
<?php
    }

            /**
             * Right font color select callback.
             *
             * @param array<string,mixed> $args
             * @return void
             */
            public function sb_slider_right_font_color_callback(array $args = []): void
            {
            ?>
<select id="sb_slider_right_font_color" name="sb_slider_options[sb_slider_right_font_color]">
<?php
    $items = isset($args['items']) ? (array) $args['items'] : [];
    $current = self::get_option_string( 'sb_slider_right_font_color' );
    foreach ($items as $item):
        $item_s = self::safe_string( $item );
        ?>
        <option value="<?php echo esc_attr($item_s); ?>" <?php selected($item_s, $current, true); ?>><?php echo esc_html(ucfirst($item_s)); ?></option>
    <?php endforeach; ?>
</select>
<?php
    }

            /**
             * Bottom left color input callback.
             *
             * @return void
             */
            public function sb_slider_color_bottom_left_callback(): void
            {
            ?>
<input type="text" name="sb_slider_options[sb_slider_color_bottom_left]" id="sb_slider_color_bottom_left" value="<?php echo esc_attr( self::get_option_string( 'sb_slider_color_bottom_left' ) ); ?>">
<?php
    }

            /**
             * Bottom left font select callback.
             *
             * @param array<string,mixed> $args
             * @return void
             */
            public function sb_slider_bottom_left_font_color_callback(array $args = []): void
            {
            ?>
<select id="sb_slider_bottom_left_font_color" name="sb_slider_options[sb_slider_bottom_left_font_color]">
<?php
    $items = isset($args['items']) ? (array) $args['items'] : [];
    $current = self::get_option_string( 'sb_slider_bottom_left_font_color' );
    foreach ($items as $item):
        $item_s = self::safe_string( $item );
        ?>
        <option value="<?php echo esc_attr($item_s); ?>" <?php selected($item_s, $current, true); ?>><?php echo esc_html(ucfirst($item_s)); ?></option>
    <?php endforeach; ?>
</select>
<?php
    }

            /**
             * Bottom center color input callback.
             *
             * @return void
             */
            public function sb_slider_color_bottom_center_callback(): void
            {
            ?>
<input type="text" name="sb_slider_options[sb_slider_color_bottom_center]" id="sb_slider_color_bottom_center" value="<?php echo esc_attr( self::get_option_string( 'sb_slider_color_bottom_center' ) ); ?>">
<?php
    }

            /**
             * Bottom center font select callback.
             *
             * @param array<string,mixed> $args
             * @return void
             */
            public function sb_slider_bottom_center_font_color_callback(array $args = []): void
            {
            ?>
<select id="sb_slider_bottom_center_font_color" name="sb_slider_options[sb_slider_bottom_center_font_color]">
<?php
    $items = isset($args['items']) ? (array) $args['items'] : [];
    $current = self::get_option_string( 'sb_slider_bottom_center_font_color' );
    foreach ($items as $item):
        $item_s = self::safe_string( $item );
        ?>
        <option value="<?php echo esc_attr($item_s); ?>" <?php selected($item_s, $current, true); ?>><?php echo esc_html(ucfirst($item_s)); ?></option>
    <?php endforeach; ?>
</select>
<?php
    }

            /**
             * Bottom right color input callback.
             *
             * @return void
             */
            public function sb_slider_color_bottom_right_callback(): void
            {

            ?>
<input type="text" name="sb_slider_options[sb_slider_color_bottom_right]" id="sb_slider_color_bottom_right" value="<?php echo esc_attr( self::get_option_string( 'sb_slider_color_bottom_right' ) ); ?>">
<?php
    }

            /**
             * Bottom right font select callback.
             *
             * @param array<string,mixed> $args
             * @return void
             */
            public function sb_slider_bottom_right_font_color_callback(array $args = []): void
            {
            ?>
<select id="sb_slider_bottom_right_font_color" name="sb_slider_options[sb_slider_bottom_right_font_color]">
<?php
    $items = isset($args['items']) ? (array) $args['items'] : [];
    $current = self::get_option_string( 'sb_slider_bottom_right_font_color' );
    foreach ($items as $item):
        $item_s = self::safe_string( $item );
        ?>
        <option value="<?php echo esc_attr($item_s); ?>" <?php selected($item_s, $current, true); ?>><?php echo esc_html(ucfirst($item_s)); ?></option>
    <?php endforeach; ?>
</select>
<?php
    }

            /**
             * Validate settings on save.
             *
             * @param array<string,mixed> $input
             * @return array<string,mixed>
             */
            public function sb_slider_validate(array $input = []): array
            {
                $new_input = [];
                foreach ($input as $key => $value) {
                    switch ($key) {
                        case 'sb_slider_title':
                            if (empty($value)) {
                                add_settings_error('sb_slider_options', 'sb_slider_message', esc_html__('The title field can not be left empty', 'sb-slider'), 'error');
                                $value = esc_html__('Please, type some text', 'sb-slider');
                            }
                            $new_input[$key] = sanitize_text_field( self::safe_string( $value ) );
                            break;
                        default:
                            $new_input[ $key ] = sanitize_text_field( self::safe_string( $value ) );
                            break;
                    }
                }
                return $new_input;
            }

        }

}

// PHPUnit test shim: when running tests outside WP, ensure class exists and no-op functions are present
if ( defined( 'PHPUNIT_COMPOSER_INSTALL' ) || ( defined( 'WP_TESTS_DIR' ) && WP_TESTS_DIR === '' ) ) {
    if ( ! function_exists( 'add_action' ) ) {
        function add_action() { /* noop for tests */ }
    }
}
