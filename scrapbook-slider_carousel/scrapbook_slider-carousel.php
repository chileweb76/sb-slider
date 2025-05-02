<?php
  require_once SCRAPBOOK_SLIDER_PATH . 'vendor/autoload.php';
 
  use ScssPhp\ScssPhp\Compiler;
  use ScssPhp\ScssPhp\ValueConverter;

  $compiler = new Compiler();

  $source_scss = SCRAPBOOK_SLIDER_PATH . 'stylesheets/scrapbook_variables.scss';
 
 

 header('Content-type: text/css');
 header('Cache-control: must-revalidate');
 
 if (! defined('ABSPATH')) {
  exit;
}

    $options = get_option('scrapbook_slider_options');
    if (! empty($options['scrapbook_slider_color_left'])) {
        $scrapbook_slider_color_left = $options['scrapbook_slider_color_left'];
    } else {
        $scrapbook_slider_color_left = '#D3D3D3';
    }
    if (! empty($options['scrapbook_slider_color_center'])) {
        $scrapbook_slider_color_center = $options['scrapbook_slider_color_center'];
    } else {
        $scrapbook_slider_color_center = '#D3D3D3';
    }
    if (! empty($options['scrapbook_slider_color_right'])) {
        $scrapbook_slider_color_right = $options['scrapbook_slider_color_right'];
    } else {
        $scrapbook_slider_color_right = '#D3D3D3';
    }
    if (! empty($options['scrapbook_slider_color_bottom_left'])) {
        $scrapbook_slider_color_bottom_left = $options['scrapbook_slider_color_bottom_left'];
    } else {
        $scrapbook_slider_color_bottom_left = '#D3D3D3';
    }
    if (! empty($options['scrapbook_slider_color_bottom_center'])) {
        $scrapbook_slider_color_bottom_center = $options['scrapbook_slider_color_bottom_center'];
    } else {
        $scrapbook_slider_color_bottom_center = '#D3D3D3';
    }
    if (! empty($options['scrapbook_slider_color_bottom_right'])) {
        $scrapbook_slider_color_bottom_right = $options['scrapbook_slider_color_bottom_right'];
    } else {
        $scrapbook_slider_color_bottom_right = '#D3D3D3';
    }
    $scrapbook_slider_left_font_color          = $options['scrapbook_slider_left_font_color'];
    $scrapbook_slider_center_font_color        = $options['scrapbook_slider_center_font_color'];
    $scrapbook_slider_right_font_color         = $options['scrapbook_slider_right_font_color'];
    $scrapbook_slider_bottom_left_font_color   = $options['scrapbook_slider_bottom_left_font_color'];
    $scrapbook_slider_bottom_center_font_color = $options['scrapbook_slider_bottom_center_font_color'];
    $scrapbook_slider_bottom_right_font_color  = $options['scrapbook_slider_bottom_right_font_color'];

    $compiler->addVariables( [
     '$scrapbook-slider-color-left' => ValueConverter::parseValue($scrapbook_slider_color_left),
     '$scrapbook-slider-color-center' => ValueConverter::parseValue($scrapbook_slider_color_center),
    '$scrapbook-slider-color-right' => ValueConverter::parseValue($scrapbook_slider_color_right),
    '$scrapbook-slider-color-bottom-left' => ValueConverter::parseValue($scrapbook_slider_color_bottom_left),
    '$scrapbook-slider-color-bottom-center' => ValueConverter::parseValue($scrapbook_slider_color_bottom_center),
    '$scrapbook-slider-color-bottom-right' => ValueConverter::parseValue($scrapbook_slider_color_bottom_right),
   '$scrapbook-slider-left-font-color' => ValueConverter::parseValue($scrapbook_slider_left_font_color),
   '$scrapbook-slider-center-font-color' => ValueConverter::parseValue($scrapbook_slider_center_font_color),
   '$scrapbook-slider-right-font-color' => ValueConverter::parseValue($scrapbook_slider_right_font_color),
   '$scrapbook-slider-bottom-left-font-color' => ValueConverter::parseValue($scrapbook_slider_bottom_left_font_color),
   '$scrapbook-slider-bottom-center-font-color' => ValueConverter::parseValue($scrapbook_slider_bottom_center_font_color),
   '$scrapbook-slider-bottom-right-font-color' => ValueConverter::parseValue($scrapbook_slider_bottom_right_font_color)
    ]);
    

  $scss_code ='
   .scrapbook_button1_color {

    background-color: $scrapbook-slider-color-left;
    color: $scrapbook-slider-left-font-color;
    }

  .scrapbook_button2_color {

    background-color: $scrapbook-slider-color-center;
    color: $scrapbook-slider-center-font-color;
    }

  .scrapbook_button3_color {

    background-color: $scrapbook-slider-color-right;
    color: $scrapbook-slider-right-font-color;
    }

  .scrapbook_button4_color {

    background-color: $scrapbook-slider-color-bottom-left;
    color: $scrapbook-slider-bottom-left-font-color;
    }

  .scrapbook_button5_color {

    background-color: $scrapbook-slider-color-bottom-center;
    color: $scrapbook-slider-bottom-center-font-color;
    }

  .scrapbook_button6_color {

    background-color: $scrapbook-slider-color-bottom-right;
    color: $scrapbook-slider-bottom-right-font-color;
    }
  ';

  $compileCss = $compiler->compileString($scss_code)->getCss();

    file_put_contents($source_scss, $compileCss);
 
?>


