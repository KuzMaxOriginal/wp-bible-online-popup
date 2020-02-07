<?php

class MySettingsPage {
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct() {
        add_action('admin_menu', array($this, 'add_plugin_page'));
        add_action('admin_init', array($this, 'page_init'));
    }

    /**
     * Add options page
     */
    public function add_plugin_page() {
        // This page will be under "Settings"
        add_options_page(
            __('Bible Online Popup', 'BOP'),
            __('Bible Online Popup', 'BOP'),
            'manage_options',
            'bop-settings',
            array($this, 'create_admin_page')
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page() {
        // Set class property
        $this->options = get_option('bop_general');
        ?>
        <div class="wrap">
            <h1><?php _e('Bible Online Popup Settings', 'BOP') ?></h1>
            <form method="post" action="options.php">
                <?php
                // This prints out all hidden setting fields
                settings_fields('bop_options');
                do_settings_sections('bop-settings');
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init() {
        register_setting(
            'bop_options', // Option group
            'bop_general', // Option name
            array($this, 'sanitize') // Sanitize
        );

        add_settings_section(
            'section_general', // ID
            __('General Settings', 'BOP'), // Title
            array($this, 'print_general_section_info'), // Callback
            'bop-settings' // Page
        );

        add_settings_section(
            'section_general', // ID
            __('General Settings', 'BOP'), // Title
            array($this, 'print_general_section_info'), // Callback
            'bop-settings' // Page
        );

        add_settings_field(
            'default_trans',
            __('Default translation', 'BOP'),
            array($this, 'default_trans_callback'),
            'bop-settings',
            'section_general'
        );
    }

    public function print_general_section_info() {
        print __('Update your preferences here.', "BOP");
    }

    public function get_translations() {
        return [
            "rst66" => "Русский синодальный перевод (Протестантская редакция)",
            "rst78" => "Русский синодальный перевод (Православная редакция)",
            "rst-jbl" => "Русский синодальный перевод (Юбилейное издание)",
            "lut" => "Перевод свящ. Леонида Лутковского",
            "csl" => "Церковнославянский перевод (Гражданский шрифт)",
            "ubio" => "Біблія в пер. Івана Огієнка",
            "kjv" => "King James Version",
            "deu" => "Deutsche Luther",
            "bel" => "Беларускі пераклад",
            "rom" => "Română traducere",
            "spa" => "Traducción al español",
            "fra" => "Traduction française",
            "ell" => "Ελληνική μετάφραση",
            "ita" => "Traduzione italiana",
            "por" => "Tradução português",
            "tur" => "Türkçe çeviri",
            "zho" => "中文 汉译",
            "pol" => "Biblia Tysiąclecia",
        ];
    }

    public function sanitize($input) {
        $new_input = array();

        if (isset($input['default_trans'])) {
            $new_input['default_trans'] = key_exists($input['default_trans'], $this->get_translations()) ? $input['default_trans'] : null;
        }

        return $new_input;
    }

    public function default_trans_callback() {
        $selected_value = $this->options["default_trans"];

        echo '<select id="default_trans" name="bop_general[default_trans]">';

        foreach ($this->get_translations() as $translation_id => $translation_title) {
            echo '<option value="' . $translation_id . '"' . ($translation_id == $selected_value ? ' selected' : '') . '>'
                . $translation_title . '</option>';
        }

        echo '</select>';
    }
}

if (is_admin())
    $my_settings_page = new MySettingsPage();