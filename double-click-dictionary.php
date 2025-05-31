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
*/

if (!defined("ABSPATH"))
    exit;



class Word_Look
{
    const VERSION = "1.0.0";
    public function __construct()
    {

        add_action('wp_enqueue_scripts', [$this, 'wl_load_scripts'], 999);
        add_action('wp_footer', [$this, 'wl_add_dictionary_popup']);

    }

    function wl_load_scripts()
    {
        wp_enqueue_style(
        'wl-style-css',
        plugin_dir_url(__FILE__) . 'assets/css/style.css',
        [],
        self::VERSION
);


        wp_enqueue_script(
            'wl-custom-js',
            plugin_dir_url(__FILE__) . 'assets/js/custom.js',
            ['jquery'],
            self::VERSION,
            true
        );
    }

    function wl_add_dictionary_popup()
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


new Word_Look();
