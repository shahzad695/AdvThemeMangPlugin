<?php

/*

plugin name: advance Theme Manager plugin
plugin URI: https://github.com/shahzad695/AdvThemeMangPlugin
Description: advance plugin to customize the theme
version: 1.0.0
Author: shahzad Ahmad
Author URI: https://github.com/shahzad695
License: GPLv2 or later
Text Domain: advance-theme-manager


*/


if(!defined('ABSPATH')){
    die;
}

class AdvThemeMangPlugin {
    function __construct() {
        add_action('init', [$this,'customPostType']);
    }
    function activate(){
        $this->customPostType();
        flush_rewrite_rules();

    }
    function deactivate(){
        flush_rewrite_rules();
    }

    function customPostType(){
        register_post_type('book', ['public'=>true,'label'=>'Books']);
}
}

if(class_exists('AdvThemeMangPlugin')){

    $advThemeMangPlugin = new AdvThemeMangPlugin();
}

register_activation_hook(__FILE__, [$advThemeMangPlugin,'activate']);
register_deactivation_hook(__FILE__, [$advThemeMangPlugin,'deactivate']);