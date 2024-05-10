<?php

namespace Inc\Base;
class Enqueue{
    function register(){
        add_action('admin_footer', [$this,'enque']);
    }
    function enque() {
         wp_enqueue_style('mystyle',   advThemeMang_PLUGIN_URL . 'assets/final-assets/advThemeMang-compiled.css');
         wp_enqueue_script('myscript', advThemeMang_PLUGIN_URL . 'assets/final-assets/advThemeMang-compiled.js',[],1.00,true);
         
    }
}