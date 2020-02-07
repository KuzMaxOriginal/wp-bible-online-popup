jQuery(document).ready(function ($) {
    tinymce.create('tinymce.plugins.bop_plugin', {
        init: function (editor, url) {
            // Register command for when button is clicked
            editor.addCommand('bop_insert_shortcode', function () {
                selected = tinyMCE.activeEditor.selection.getContent();

                if (selected) {
                    //If text is selected when button is clicked
                    //Wrap shortcode around it.
                    content = '[bible_popup]' + selected + '[/bible_popup]';
                }

                tinymce.execCommand('mceInsertContent', false, content);
            });

            // Register buttons - trigger above command when clicked
            editor.addButton('bop_button', {
                title: editor.getLang('bop.buttonTitle'),
                cmd: 'bop_insert_shortcode',
                image: url + '/../assets/bibleonline.svg'
            });
        },
    });

    // Register our TinyMCE plugin
    // first parameter is the button ID1
    // second parameter must match the first parameter of the tinymce.create() function above
    tinymce.PluginManager.add('bop_button', tinymce.plugins.bop_plugin);
});