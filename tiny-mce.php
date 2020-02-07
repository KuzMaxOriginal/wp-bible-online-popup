<?php

function bop_shortcode_button_init() {
    if (!current_user_can('edit_posts') && !current_user_can('edit_pages') && get_user_option('rich_editing') == 'true')
        return;

    add_filter("mce_external_plugins", "bop_register_tinymce_plugin");
    add_filter('mce_buttons', 'bop_add_tinymce_button');
    add_filter('mce_external_languages', 'bop_tinymce_languages');
}

add_action('init', 'bop_shortcode_button_init');

function bop_register_tinymce_plugin($plugin_array) {
    $plugin_array['bop_button'] = plugins_url('js/tiny-mce-plugin.js', __FILE__);
    return $plugin_array;
}

function bop_add_tinymce_button($buttons) {
    $buttons[] = "bop_button";
    return $buttons;
}

function bop_tinymce_languages($locales) {
    $locales['bop'] = plugin_dir_path(__FILE__) . 'tiny-mce-lang.php';

    return $locales;
}