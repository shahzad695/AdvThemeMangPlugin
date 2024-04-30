<?php

namespace Inc\Pages;

use Inc\WordPressAPIs\SettingsAPI;

class Admin
{
    public $pages = array();
    public $settings;
    function __construct() 
    {
        $this->settings = new SettingsAPI();
        $this->pages = [[
            'page_title'  =>  'Advance Theme Manager', 
            'menu_title'  =>  'advThemeMang',
            'capability'  => 'manage_options', 
            'menu_slug'   =>  'advThemeMang', 
            'call_back'   =>  function (){echo '<h1>Advanace Theme Manager</h1>';},
            'icon_url'    =>  'dashicons-store', 
            'position'    =>   110
        ]];
    }

    function register() {
        $this->settings->addPages($this->pages)->register();
    }
    // function admin_pages() {
    //      add_menu_page('Advance Theme Manager', 'advThemeMang', 'manage_options', 'advThemeMang', [$this,'adminIndex'], 'dashicons-store', 110);
    //      }
    // function adminIndex() {
    //             require_once advThemeMang_PLUGIN_PATH . 'temp/admin.php';
    //         }
  
}