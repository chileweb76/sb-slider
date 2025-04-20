<div class="wrap">
    <h1><?php esc_html(get_admin_page_title(), 'sb_slider')?></h1>
    <?php

        $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'main_options';
    ?>
    <h2 class="nav-tab-wrapper">
        <a href="?page=sb_slider_admin&tab=main_options" class="nav-tab                                                                         <?php echo $active_tab == 'main_options' ? 'nav-tab-active' : '' ?>"><?php esc_html_e('Main', 'sb-slider')?></a>

        <a href="?page=sb_slider_admin&tab=color_options" class="nav-tab                                                                          <?php echo $active_tab == 'color_options' ? 'nav-tab-active' : '' ?>"><?php esc_html_e('Color Options', 'sb-slider')?></a>

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
                    submit_button(esc_html__('Save Settings', 'sb-slider'));
                    break;
                default;
            }

        ?>
    </form>
</div>
