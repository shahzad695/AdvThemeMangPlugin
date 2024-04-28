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
if(file_exists(dirname(__FILE__). '/vendor/autoload.php')){
    require_once dirname(__FILE__) .'/vendor/autoload.php';
}

define('PLUGIN_PATH', plugin_dir_path(__FILE__));
define('PLUGIN_URL',  plugin_dir_url(__FILE__));
define('PLUGIN',  plugin_basename(__FILE__));

function activate(){
    Inc\Base\Activate::activate();
}
function deactivate() {
    Inc\Base\Deactivate::deactivate();
}

register_activation_hook(__FILE__, 'activate');
register_deactivation_hook(__FILE__, 'deactivate');

if(class_exists('Inc\\Init')){
    Inc\Init::register_services();
}