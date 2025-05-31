<?php
/*
Plugin Name: Double Click Dictionary
Plugin URI:https://github.com/codedbyabir/double-click-dictionary
Description: Double Click Dictionary is a WordPress plugin that allows users to double-click on any word in the content area to get its meaning from the dictionary.
Version: 1.0.0
Author: Rath Shahamat Abir
Author URI: https://github.com/codedbyabir
License: GPL2
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if (!defined("ABSPATH"))
    exit;



class Double_click_dictionary
{
    const VERSION = "1.0.1";
    public function __construct()
    {

        add_action('wp_enqueue_scripts', [$this, 'dcd_load_scripts'], 999);
        add_action('wp_footer', [$this, 'dcd_add_dictionary_popup']);

    }

    function dcd_load_scripts()
    {
        wp_enqueue_style(
        'dcd-style-css',
        plugin_dir_url(__FILE__) . 'assets/css/style.css',
        [],
        self::VERSION
);


        wp_enqueue_script(
            'dcd-custom-js',
            plugin_dir_url(__FILE__) . 'assets/js/custom.js',
            ['jquery'],
            self::VERSION,
            true
        );
    }

    function dcd_add_dictionary_popup()
    {
        // Output modal markup in the footer
        ?>

        <div id="wordMeaningModal" class="word-modal">
            <div class="word-modal-content">
                <div class="close-wrapper"> <button class="word-close">X</button></div>
                <div>
                    <h2 id="selectedWord"></h2>
                    <p id="wordDefinition"></p>
                </div>
            </div>
        </div>
        <?php
    }
}


new Double_click_dictionary();