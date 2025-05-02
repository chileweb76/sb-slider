<?php  if ( ! defined( 'ABSPATH' ) ) exit; 
?>

<div class="wrap">
    <h1><?php esc_html(get_admin_page_title())?></h1>
    <?php

    $tab = filter_input(
        INPUT_GET, 
        'tab', 
        FILTER_CALLBACK, 
        ['options' => 'esc_html']
    );

    $active_tab = $tab ?: 'main_options';
    ?>
    <h2 class="nav-tab-wrapper">
        <a href="?page=scrapbook_slider_admin&tab=main_options" class="nav-tab                                                                         <?php echo $active_tab == 'main_options' ? 'nav-tab-active' : '' ?>"><?php esc_html_e('Main', 'scrapbook-slider')?></a>

        <a href="?page=scrapbook_slider_admin&tab=color_options" class="nav-tab                                                                          <?php echo $active_tab == 'color_options' ? 'nav-tab-active' : '' ?>"><?php esc_html_e('Color Options', 'scrapbook-slider')?></a>

    </h2>
    <form action="options.php" method="post">
   <?php wp_nonce_field( 'save_settings', 'scrapbook_slider_nonce');
            switch ($active_tab) {
                case 'main_options':
                    settings_fields('scrapbook_slider_group');
                    do_settings_sections('scrapbook_slider_page1');
                    break;
                case 'color_options':
                    settings_fields('scrapbook_slider_group');
                    do_settings_sections('scrapbook_slider_page2');
                    submit_button(esc_html__('Save Settings', 'scrapbook-slider'));
                    break;
                default;
            }

        ?>
    </form>
</div>
