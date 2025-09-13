<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../class.sb-slider-settings.php';

class SettingsHelpersTest extends TestCase
{
    public function testGetOptionStringDefaultsToEmpty()
    {
        // Make sure static options are empty for test isolation
        \SB_Slider_Settings::$options = [];
        $this->assertSame('', \SB_Slider_Settings::get_option_string('nonexistent'));
    }

    public function testGetOptionStringReturnsScalar()
    {
        \SB_Slider_Settings::$options = ['title' => 'Hello'];
        $this->assertSame('Hello', \SB_Slider_Settings::get_option_string('title'));
    }

    public function testSafeStringOnNonScalar()
    {
        \SB_Slider_Settings::$options = ['arr' => ['a','b']];
        $this->assertSame('', \SB_Slider_Settings::get_option_string('arr'));
    }
}
