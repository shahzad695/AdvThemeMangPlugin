<?php

namespace Inc;
class Init{
    static function get_services(){
        return[
            Pages\Admin::class,
            Base\Enqueue::class,
            Base\SettingsLinks::class,
        ];
    }
    public static  function register_services() {
        foreach (self::get_services() as $class){
            $service = new $class();
            
            if(method_exists($service,'register')){
                $service->register();
            }
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
//         
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
//     
// }

// if(class_exists('AdvThemeMangPlugin')){

//     $advThemeMangPlugin = new AdvThemeMangPlugin();
//     $advThemeMangPlugin->register();
// }

// register_activation_hook(__FILE__, [$advThemeMangPlugin,'activate']);
// register_deactivation_hook(__FILE__, [$advThemeMangPlugin,'deactivate']);