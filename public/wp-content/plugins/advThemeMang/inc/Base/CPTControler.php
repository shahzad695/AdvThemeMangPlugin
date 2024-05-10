<?php
namespace Inc\Base;

use Inc\WordPressAPIs\Callbacks\AdminCallbacks;
use Inc\WordPressAPIs\SettingsAPI;

class CPTControler
{
    public $subpages = array();
    public $settingsAPI;
    public $admin_callbacks;
    public $custom_post_types = array();
    function register()
    {
        $checkbox = get_option('advThemeMang');
        $checked = isset($checkbox['cpt_manager']) ? ($checkbox['cpt_manager'] ? true : false) : false;
        if (!$checked) {
            return;
        }
        $this->settingsAPI = new SettingsAPI();
        $this->admin_callbacks = new AdminCallbacks();

        // $this->storeCustomPostTypes();
        $this->subpageGenrator();
        if (!empty($this->custom_post_types)) {
            add_action('init', [$this, 'registerCPT']);
        }

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

    function storeCustomPostTypes()
    {
        $this->custom_post_types = [
            [
                'post_type' => 'advThemeMag_products',
                'name' => 'Products',
                'singular_name' => 'Product',
                'public' => true,
                'has_archive' => true,

            ],
            [
                'post_type' => 'advThemeMag_comics',
                'name' => 'Comics',
                'singular_name' => 'Comic',
                'public' => true,
                'has_archive' => true,
            ],
        ];
    }

    function registerCPT()
    {
        foreach ($this->custom_post_types as $custom_post_type) {

            register_post_type($custom_post_type['post_type'], [
                'labels' => [
                    'name' => $custom_post_type['name'],
                    'singular_name' => $custom_post_type['singular_name'],
                ],
                'public' => $custom_post_type['public'],
                'has_archive' => $custom_post_type['has_archive'],

            ]);
        }
    }

}