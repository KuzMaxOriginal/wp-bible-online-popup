=== Bible Online Popup ===
Contributors: maksimkuzmin
Tags: bible, api implementation
Requires at least: 5.2
Tested up to: 5.3
Requires PHP: 7.0
Stable tag: 1.0
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl.html

A WordPress plugin based on BibleOnline.ru API, that allows you to make popping-up Bible passages on your website.

== Description ==
The plugin is NOT developed by BibleOnline.ru team, it solely implements it\'s API documented on https://bibleonline.docs.apiary.io/.

Inspired by many similar popping up embedded scripts for Bible verses, Bible Online Popup adds an ability for easily converting Bible references like Jhn. 3:5 or John 3:5-7 into a hoverable link, so when mouse is over, it shows a pop-up frame with corresponding Bible verse and a link for reading more it on BibleOnline.ru website.

To create such a reference, just write Bible verse short name, select it in the editor and click blue button \"Make a Bible Popup from selection\" in the toolbar, so it wraps selection in [bible_popup] shortcode.

You can also create references manually, by using [bible_popup] shortcode.

Examples:

* [bible_popup]John 3:5-7[/bible_popup]
* [bible_popup query=\"John 3:5-7\"]some text[/bible_popup]
* [bible_popup trans=\"kjv\"]John 3:5-7[/bible_popup]

### Improtant notice - known issues

For reasons that are not in charge of developer of this plugin, currently there are not all
of the translations available on BibleOnline.ru for browser reading, that you can
use in plugin. Also, unfortunately, there's no English version provided for AJAX yet.

Currently available translations:

* Русский синодальный перевод (Протестантская редакция)
* Русский синодальный перевод (Православная редакция)
* Русский синодальный перевод (Юбилейное издание)
* Церковнославянский перевод (Гражданский шрифт)
* Deutsche Luther
* Беларускі пераклад
* Traducción al español
* Traduction française
* Ελληνική μετάφραση
* Traduzione italiana
* Tradução português
* Türkçe çeviri
* 中文 汉译
* Biblia Tysiąclecia

Also, not for every translation the book name will be translated. Mostly it appears in
Russian.

== Installation ==
Just upload the plugin and follow WordPress installation instructions. After installation and activation, go to Bible Online Popup settings page under \"Settings\" admin menu and adjust preferences.