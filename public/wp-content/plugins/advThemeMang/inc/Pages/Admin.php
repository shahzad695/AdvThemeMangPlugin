<?php

namespace Inc\Pages;

class Admin{
    function register() {
        add_action('admin_menu', [$this,'admin_pages']);
    }
    function admin_pages() {
         add_menu_page('Advance Theme Manager', 'advThemeMang', 'manage_options', 'advThemeMang', [$this,'adminIndex'], 'dashicons-store', 110);
         }
    function adminIndex() {
                require_once PLUGIN_PATH . 'temp/admin.php';
            }
  
}