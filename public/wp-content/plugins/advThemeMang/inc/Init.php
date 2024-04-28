<?php

namespace Inc;
class Init{
    static function get_services(){
        return[
            Pages\Admin::class,
            Base\Enqueue::class,
        ];
    }
    public static  function register_services() {
        foreach (self::get_services() as $class){
            $service = new $class();
            $service->register();
            // if(method_exists($service,'register')){
                
            // }
        }
       
    }

    // public static function instanciate($class) {
    //     $service = new $class();
    //     return $service;
    // }

}

// use Inc\Activate;
// use Inc\Deactivate;
// use Inc\admin\AdminPages;
// class AdvThemeMangPlugin {
//     public $pluginName;
//     function __construct() {
//         $this->pluginName = plugin_basename(__FILE__);
        

//     }
//     function register() {
//         
//         
//         add_filter("plugin_action_links_$this->pluginName", [$this,'settingsLink']);
//     }
       
//     function activate(){
//         add_action('init', [$this,'customPostType']);
//        Activate::activate();

//     }
//     function deactivate(){
        
//        Deactivate::deactivate();

    
//     }

//     function customPostType(){
//         register_post_type('book', ['public'=>true,'label'=>'Books']);
//     }
//   
//     
//     function settingsLink($link) {
//         $settings='<a href="admin.php?page=advThemeMang">Settings</a>';
//         array_push($link,$settings);
//         return $link;
//     }
// }

// if(class_exists('AdvThemeMangPlugin')){

//     $advThemeMangPlugin = new AdvThemeMangPlugin();
//     $advThemeMangPlugin->register();
// }

// register_activation_hook(__FILE__, [$advThemeMangPlugin,'activate']);
// register_deactivation_hook(__FILE__, [$advThemeMangPlugin,'deactivate']);