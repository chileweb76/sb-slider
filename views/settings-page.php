<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
<div class="wrap">
    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
    <?php

    $active_tab = isset($_GET['tab']) ? sanitize_text_field($_GET['tab']) : 'main_options';
    ?>
    <h2 class="nav-tab-wrapper">
        <a href="?page=sb_slider_admin&tab=main_options" class="nav-tab                                                                         <?php echo $active_tab == 'main_options' ? 'nav-tab-active' : '' ?>"><?php esc_html_e('Main', 'scrapbook-slider')?></a>

        <a href="?page=sb_slider_admin&tab=color_options" class="nav-tab                                                                          <?php echo $active_tab == 'color_options' ? 'nav-tab-active' : '' ?>"><?php esc_html_e('Color Options', 'scrapbook-slider')?></a>

    </h2>
    <form action="options.php" method="post">
        <?php
            switch ($active_tab) {
                case 'main_options':
                    settings_fields('sb_slider_group');
                    do_settings_sections('sb_slider_page1');
                    break;
                case 'color_options':
                    settings_fields('sb_slider_group');
                    do_settings_sections('sb_slider_page2');
                    submit_button(esc_html__('Save Settings', 'scrapbook-slider'));
                    break;
                default:
                    break;
            }

        ?>
    </form>
</div>
