<?php

defined('MOODLE_INTERNAL') || die();

/**
 * Makes our changes to the CSS
 *
 * @param string $css
 * @param theme_config $theme
 * @return string
 */
function kittv_user_settings($css, $theme) {

    // Set the font reference size
    if (empty($theme->settings->fontsizereference)) {
        $fontsizereference = '13'; // default
    } else {
        $fontsizereference = $theme->settings->fontsizereference;
    }
    $css = kittv_set_fontsizereference($css, $fontsizereference);

    // set the customcss
    if (!empty($theme->settings->customcss)) {
        $customcss = $theme->settings->customcss;
    } else {
        $customcss = null;
    }
    $css = kittv_set_customcss($css, $customcss);

    // Return the CSS
    return $css;
}



/**
 * Sets the link color variable in CSS
 *
 */
function kittv_set_fontsizereference($css, $fontsizereference) {
    $tag = '[[setting:fontsizereference]]';
    $css = str_replace($tag, $fontsizereference.'px', $css);
    return $css;
}

function kittv_set_customcss($css, $customcss) {
    $tag = '[[setting:customcss]]';
    $css = str_replace($tag, $customcss, $css);
    return $css;
}
