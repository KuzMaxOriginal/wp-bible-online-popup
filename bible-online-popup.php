<?php

/**
 * Plugin Name: Bible Online Popup
 * Description: Popup Bible's verses with Bible Online
 * Version: 1.0.0
 * Author: Maksim Kuzmin
 * License: GPL2
 */

require_once "settings-page.php";
require_once "tiny-mce.php";

function bible_popup_func($atts, $content = "") {
    $options_defaults = [
        "default_trans" => "rst66"
    ];
    $options = wp_parse_args(get_option("bop_general"), $options_defaults);

    $query = isset($atts["query"]) ? $atts["query"] : "";
    $trans = isset($atts["trans"]) ? $atts["trans"] : "";

    if (!$query) {
        $query = "$content";
    }

    if (!$trans) {
        $trans = $options["default_trans"];
    }

    $html = '<a class="bop-ref" data-query="' . $query . '" data-trans="' . $trans . '">' . $content . '</a>';

    return $html;
}

function bop_add_scripts() {
    wp_enqueue_script('bop-popup-js', plugins_url('js/bible-online-popup.js', __FILE__), ['jquery'], false, true);
    wp_enqueue_style('bop-css', plugins_url('css/bible-online-popup.css', __FILE__));
    wp_enqueue_style('bop-spinner', plugins_url('css/spinner.css', __FILE__));
}

function bop_load_plugin_textdomain() {
    load_plugin_textdomain('BOP', FALSE, basename(dirname(__FILE__)) . '/languages/');
}

function bop_plugin_actions($actions, $plugin_file, $plugin_data, $context) {
    array_unshift($actions,
        sprintf('<a href="%s" aria-label="%s">%s</a>',
            menu_page_url('bop-settings', false),
            esc_attr__('Bible Online Popup Settings', 'BOP'),
            esc_html__("Settings", 'default')
        )
    );
    return $actions;
}

add_filter("plugin_action_links_" . plugin_basename(__FILE__), "bop_plugin_actions", 10, 4);

add_action('plugins_loaded', 'bop_load_plugin_textdomain');
add_action('wp_enqueue_scripts', 'bop_add_scripts');

add_shortcode('bible_popup', 'bible_popup_func');