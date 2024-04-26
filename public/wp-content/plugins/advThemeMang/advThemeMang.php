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
    public $pluginName;
    function __construct() {
        $this->pluginName = plugin_basename(__FILE__);
        

    }
    function register() {
        add_action('admin_enqueue_scripts', [$this,'enque']);
        add_action('admin_menu', [$this,'admin_pages']);
        add_filter("plugin_action_links_$this->pluginName", [$this,'settingsLink']);
    }
       
    function activate(){
        add_action('init', [$this,'customPostType']);
       require_once plugin_dir_path(__FILE__) . 'inc/advThemeMangActivate.php';
       advThemeMangActivate::activate();

    }
    function deactivate(){
        require_once plugin_dir_path(__FILE__) . 'inc/advThemeMangDeactivate.php';
        advThemeMangDeactivate::deactivate();

    
    }

    function customPostType(){
        register_post_type('book', ['public'=>true,'label'=>'Books']);
    }
    function enque() {
        
        wp_enqueue_style('mystyle', plugins_url('/assets/mystyle.css', __FILE__));
        wp_enqueue_script('myscript', plugins_url('/assets/myscript.js', __FILE__),[]);
    }
    function admin_pages() {
        add_menu_page('Advance Theme Manager', 'advThemeMang', 'manage_options', 'advThemeMang', [$this,'adminIndex'], 'dashicons-store', 110);
    }
    function adminIndex() {
        require_once plugin_dir_path(__FILE__) . 'temp/admin.php';
    }
    function settingsLink($link) {
        $settings='<a href="admin.php?page=advThemeMang">Settings</a>';
        array_push($link,$settings);
        return $link;
    }
}

if(class_exists('AdvThemeMangPlugin')){

    $advThemeMangPlugin = new AdvThemeMangPlugin();
    $advThemeMangPlugin->register();
}

register_activation_hook(__FILE__, [$advThemeMangPlugin,'activate']);
register_deactivation_hook(__FILE__, [$advThemeMangPlugin,'deactivate']);