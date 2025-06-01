<?php
/*
Plugin Name: Word Look
Plugin URI:https://github.com/codedbyabir/word-look
Description: A simple WordPress plugin that allows users to double-click on any word in the content to get its meaning from the dictionary.
Version: 1.0.0
Author: Rath Shahamat Abir
Author URI: https://github.com/codedbyabir
License: GPL2
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Require PHP: 8.0
Text Domain: word-look
*/

if (!defined("ABSPATH"))
    exit;



final class Wdlook_Dictionary
{
    const VERSION = "1.0.0";
    public function __construct()
    {

        add_action('wp_enqueue_scripts', [$this, 'wdlook_load_scripts'], 999);
        add_action('wp_footer', [$this, 'wdlook_add_dictionary_popup']);

    }

    function wdlook_load_scripts()
    {
        wp_enqueue_style(
            'wdlook-style-css',
            plugin_dir_url(__FILE__) . 'assets/css/style.css',
            [],
            self::VERSION
        );


        wp_enqueue_script(
            'wdlook-custom-js',
            plugin_dir_url(__FILE__) . 'assets/js/custom.js',
            ['jquery'],
            self::VERSION,
            true
        );
    }

    function wdlook_add_dictionary_popup()
    {
        // Output modal markup in the footer
        ?>

        <div id="wdlook-wordMeaningModal">
            <div class="wdlook-word-modal-content">
                <div class="wdlook-close-wrapper"> <button class="wdlook-word-close"><?php esc_html_e('X', 'word-look'); ?></button></div>  
                <div>
                    <h2 id="wdlook-selectedWord"></h2>
                    <p id="wdlook-wordDefinition"></p>
                </div>
            </div>
        </div>
        <?php
    }
}


if (class_exists('Wdlook_Dictionary')) {
    new Wdlook_Dictionary();
}
