<?php

/**
 * Settings for the kittv theme
 */

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {
    // font size reference
    $name = 'theme_kittv/fontsizereference';
    $title = get_string('fontsizereference','theme_kittv');
    $description = get_string('fontsizereferencedesc', 'theme_kittv');
    $default = '13';
    $choices = array(11=>'11px', 12=>'12px', 13=>'13px', 14=>'14px', 15=>'15px', 16=>'16px');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $settings->add($setting);

    // Foot note setting
    $name = 'theme_kittv/footnote';
    $title = get_string('footnote','theme_kittv');
    $description = get_string('footnotedesc', 'theme_kittv');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $settings->add($setting);

    // Custom CSS file
    $name = 'theme_kittv/customcss';
    $title = get_string('customcss','theme_kittv');
    $description = get_string('customcssdesc', 'theme_kittv');
    $default = '';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $settings->add($setting);
}