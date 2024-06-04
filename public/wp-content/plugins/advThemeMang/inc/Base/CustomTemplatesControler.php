<?php
namespace Inc\Base;

use Inc\WordPressAPIs\Callbacks\AdminCallbacks;
use Inc\WordPressAPIs\Callbacks\CPTCallbacks;
use Inc\WordPressAPIs\SettingsAPI;

class CustomTemplatesControler
{

    public $templates = array();
    
    function register()
    {
        $checkbox = get_option('advThemeMang');
        $checked = isset($checkbox['custom_templates']) ? ($checkbox['custom_templates'] ? true : false) : false;
        if (!$checked) {
            return;
        }
        // var_dump('custom templates are on');
        // die();
        $this->templates = [
            'page-templates/two-columns-layout.php' => 'Two Columns Layout',
        ];
       
        add_filter('theme_page_templates', [$this, 'addPageTemplates']);
        add_filter('template_include', [$this, 'includeTemplates']);
       

}
    public function addPageTemplates($templates)
    {
        $templates = array_merge($templates, $this->templates);
        return $templates;
    }
    public function includeTemplates($templates)
    {
        // var_dump($templates);
        // die();
        global $post;

        if(!$post){
            return $templates;
        }
        $template_name = get_post_meta($post->ID, '_wp_page_template', true);
       

        if(!isset($this->templates[$template_name])){
            return $templates;
        }

        $file = advThemeMang_PLUGIN_PATH.$template_name;
        
        
        if(file_exists($file)){
        //     var_dump($file,$templates);
        // die();
            return $file;
        }

        return $templates;
    }
}