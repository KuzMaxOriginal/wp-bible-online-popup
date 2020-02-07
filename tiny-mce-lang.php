<?php

// This file is based on wp-includes/js/tinymce/langs/wp-langs.php

if (!defined('ABSPATH'))
    exit;

if (!class_exists('_WP_Editors'))
    require(ABSPATH . WPINC . '/class-wp-editor.php');

function my_custom_tinymce_plugin_translation() {
    $strings = array(
        'buttonTitle' => __('Make a Bible Popup from selection', 'BOP'),
    );
    $locale = _WP_Editors::$mce_locale;
    $translated = 'tinyMCE.addI18n("' . $locale . '.bop", ' . json_encode($strings) . ");\n";

    return $translated;
}

$strings = my_custom_tinymce_plugin_translation();