<?php
    $absolute_path = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
    $wp_load       = $absolute_path[0] . 'wp-load.php';
    require_once $wp_load;

    $options = get_option('sb_slider_options');
    if (! empty($options['sb_slider_color_left'])) {
        $sb_slider_color_left = $options['sb_slider_color_left'];
    } else {
        $sb_slider_color_left = '#D3D3D3';
    }
    if (! empty($options['sb_slider_color_center'])) {
        $sb_slider_color_center = $options['sb_slider_color_center'];
    } else {
        $sb_slider_color_center = '#D3D3D3';
    }
    if (! empty($options['sb_slider_color_right'])) {
        $sb_slider_color_right = $options['sb_slider_color_right'];
    } else {
        $sb_slider_color_right = '#D3D3D3';
    }
    if (! empty($options['sb_slider_color_bottom_left'])) {
        $sb_slider_color_bottom_left = $options['sb_slider_color_bottom_left'];
    } else {
        $sb_slider_color_bottom_left = '#D3D3D3';
    }
    if (! empty($options['sb_slider_color_bottom_center'])) {
        $sb_slider_color_bottom_center = $options['sb_slider_color_bottom_center'];
    } else {
        $sb_slider_color_bottom_center = '#D3D3D3';
    }
    if (! empty($options['sb_slider_color_bottom_right'])) {
        $sb_slider_color_bottom_right = $options['sb_slider_color_bottom_right'];
    } else {
        $sb_slider_color_bottom_right = '#D3D3D3';
    }
    $sb_slider_left_font_color          = $options['sb_slider_left_font_color'];
    $sb_slider_center_font_color        = $options['sb_slider_center_font_color'];
    $sb_slider_right_font_color         = $options['sb_slider_right_font_color'];
    $sb_slider_bottom_left_font_color   = $options['sb_slider_bottom_left_font_color'];
    $sb_slider_bottom_center_font_color = $options['sb_slider_bottom_enter_font_color'];
    $sb_slider_bottom_right_font_color  = $options['sb_slider_bottom_right_font_color'];

    header('Content-type: text/css');
    header('Cache-control: must-revalidate');
?>


p {
  font-size: 0.9rem;
}

.sb_main {
  text-align: center;
  margin-left: 2rem;
  margin-right: 2rem;
}

@media only screen and (max-width: 1080px) {
  .sb_main {
    margin-left: 1rem;
    margin-right: 1rem;
  }
}

.sb_carousel {
  display: flex;
  justify-content: center;
  height: 680px;
}

.sb_main_image {
  margin-top: 1rem;
  margin-bottom: 1rem;
}
.sb_thumbnail {
  display: flex;
  align-items: center;
}

@media only screen and (max-width: 1023px) {
  .sb_thumbnail {
    display: none;
  }
}

.index {
  display: none;
}

.sb_button1,
.sb_button2,
.sb_button3,
.sb_button4,
.sb_button5,
.sb_button6 {
  text-decoration: none;
  font-size: 1rem;
  margin: 0.5rem;
  border-radius: 10%;
  padding-top: 0.5rem;
  padding-bottom: 0.5rem;

}

.sb_button1 {
  grid-area: button1;
  text-align: center;

}

.sb_button2 {
  grid-area: button2;
  text-align: center;
}
.sb_button3 {
  grid-area: button3;
  text-align: center;
}

.sb_button4 {
  grid-area: button4;
  text-align: center;
}

.sb_button5 {
  grid-area: button5;
  text-align: center;
}

.sb_button6 {
  grid-area: button6;
  text-align: center;
}

.sb_store_buttons {
  display: grid;
  grid-template-columns: 153px 154px 153px;
  grid-template-rows: auto;
  grid-template-areas:
    "button1 button2 button3"
    "button4 button5 button6";
}



.next,
.prev {
  display: flex;
  align-items: center;
  margin: 0 5px 3rem 5px;
  height: 3rem;
  font-size: 1rem;
  border: none;
  border-radius: 0.5rem;
  background-color: hsl(0, 0%, 50%);
  color: white;
  cursor: pointer;
}

.sb_image_scroll {
  display: flex;
  align-items: center;
}

.sb_button1_color {
  background-color:<?php echo $sb_slider_color_left ?>;
  color:                   <?php echo $sb_slider_left_font_color ?>;
    &:hover {
      box-shadow: 10px 10px 20px rgba(36, 36, 36, 0.5);
    }
}

.sb_button2_color {
  background-color:<?php echo $sb_slider_color_center ?>;
  color:                   <?php echo $sb_slider_center_font_color ?>;
    &:hover {
      box-shadow: 10px 10px 20px rgba(36, 36, 36, 0.5);
    }
}

.sb_button3_color {
  background-color:<?php echo $sb_slider_color_right ?>;
  color:                   <?php echo $sb_slider_right_font_color ?>;
    &:hover {
      box-shadow: 10px 10px 20px rgba(36, 36, 36, 0.5);
    }
}

.sb_button4_color {
  background-color:<?php echo $sb_slider_color_bottom_left ?>;
  color:                   <?php echo $sb_slider_bottom_left_font_color ?>;
    &:hover {
      box-shadow: 10px 10px 20px rgba(36, 36, 36, 0.5);
    }
}

.sb_button5_color {
  background-color:<?php echo $sb_slider_color_bottom_center ?>;
  color:                   <?php echo $sb_slider_bottom_center_font_color ?>;
    &:hover {
      box-shadow: 10px 10px 20px rgba(36, 36, 36, 0.5);
    }
}

.sb_button6_color {
  background-color:<?php echo $sb_slider_color_bottom_right ?>;
  color:                   <?php echo $sb_slider_bottom_right_font_color ?>;
    &:hover {
      box-shadow: 10px 10px 20px rgba(36, 36, 36, 0.5);
    }
}