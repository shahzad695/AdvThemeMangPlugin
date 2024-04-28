<?php

namespace Inc\Base;
class Enqueue{
    function register(){
        add_action('admin_enqueue_scripts', [$this,'enque']);
    }
    function enque() {
         wp_enqueue_style('mystyle', PLUGIN_URL . 'assets/mystyle.css');
         wp_enqueue_script('myscript', PLUGIN_URL . 'assets/myscript.js');
    }
}