<?php
namespace Inc\Base;

use Inc\WordPressAPIs\Callbacks\AdminCallbacks;
use Inc\WordPressAPIs\SettingsAPI;

class CPTControler
{
    public $subpages = array();
    public $settingsAPI;
    public $admin_callbacks;
    function register()
    {
        $checkbox = get_option('advThemeMang');
        $checked = isset($checkbox['cpt_manager']) ? ($checkbox['cpt_manager'] ? true : false) : false;
        if (!$checked) {
            return;
        }

        add_action('init', [$this, 'cptActivator']);
        $this->settingsAPI = new SettingsAPI();
        $this->admin_callbacks = new AdminCallbacks();

        $this->subpageGenrator();

    }
    function subpageGenrator()
    {
        $this->subpages = [
            [
                'parent_slug' => 'advThemeMang',
                'page_title' => 'CPT Manager',
                'menu_title' => 'CPT',
                'capability' => 'manage_options',
                'menu_slug' => 'advThemeMang_CPT',
                'call_back' => array($this->admin_callbacks, 'cptManager'),
            ]];

        $this->settingsAPI->addSubpages($this->subpages)->register();

    }

    function cptActivator()
    {
        register_post_type('advThemeMag_products', [
            'labels' => [
                'name' => 'Products',
                'singular_name' => 'Product',
            ],
            'public' => true,
            'has_archive' => true,

        ]);
    }

}