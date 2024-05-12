<?php
namespace Inc\Base;

use Inc\WordPressAPIs\Callbacks\AdminCallbacks;
use Inc\WordPressAPIs\Callbacks\CPTCallbacks;
use Inc\WordPressAPIs\SettingsAPI;

class CPTControler
{

    public $settingsAPI;
    public $settings;
    public $sctions;
    public $fields;
    public $admin_callbacks;
    public $custom_post_types = array();
    public $subpages = array();
    function register()
    {
        $checkbox = get_option('advThemeMang');
        $checked = isset($checkbox['cpt_manager']) ? ($checkbox['cpt_manager'] ? true : false) : false;
        if (!$checked) {
            return;
        }
        $this->settingsAPI = new SettingsAPI();
        $this->admin_callbacks = new AdminCallbacks();
        $this->cpt_callbacks = new CPTCallbacks();

        $this->storeCustomPostTypes();
        $this->subpageGenrator();
        // if (!empty($this->custom_post_types)) {
        add_action('init', [$this, 'registerCPT']);
        // }

    }
    function subpageGenrator()
    {
        $this->subpages = [
            [
                'parent_slug' => 'advThemeMang',
                'page_title' => 'CPT Manager',
                'menu_title' => 'CPT',
                'capability' => 'manage_options',
                'menu_slug' => 'advThemeMang_cpt',
                'call_back' => array($this->admin_callbacks, 'cptManager'),
            ]];

        $this->settings = [[
            'option_group' => 'cpt_manager_group',
            'option_name' => 'advThemeMang_cpt',
            'callback' => array($this->cpt_callbacks, 'cptInputSanitizer'),
        ]];

        $this->sections = [[
            'id' => 'admin_cpt_section',
            'title' => 'CPT Manager',
            'callback' => array($this->cpt_callbacks, 'CPTSectionManager'),
            'page' => 'advThemeMang_cpt',
        ]];

        $this->fields = [[
            'id' => 'post_type',
            'title' => 'Post Type',
            'callback' => array($this->cpt_callbacks, 'CPTTextFieldManager'),
            'page' => 'advThemeMang_cpt',
            'section' => 'admin_cpt_section',
            'args' => [
                'label_for' => 'post_type',
                'option_name' => 'advThemeMang_cpt',
                'placeholder' => 'eg.Product',
            ]],
            [
                'id' => 'plural_name',
                'title' => 'Plural Name',
                'callback' => array($this->cpt_callbacks, 'CPTTextFieldManager'),
                'page' => 'advThemeMang_cpt',
                'section' => 'admin_cpt_section',
                'args' => [
                    'label_for' => 'plural_name',
                    'option_name' => 'advThemeMang_cpt',
                    'placeholder' => 'eg.Products',
                ]],
            [
                'id' => 'singular_name',
                'title' => 'Singular Name',
                'callback' => array($this->cpt_callbacks, 'CPTTextFieldManager'),
                'page' => 'advThemeMang_cpt',
                'section' => 'admin_cpt_section',
                'args' => [
                    'label_for' => 'singular_name',
                    'option_name' => 'advThemeMang_cpt',
                    'placeholder' => 'eg.Product',
                ]],
            [
                'id' => 'has_archive',
                'title' => 'Archive',
                'callback' => array($this->cpt_callbacks, 'CPTCheckboxManager'),
                'page' => 'advThemeMang_cpt',
                'section' => 'admin_cpt_section',
                'args' => [
                    'label_for' => 'has_archive',
                    'class' => 'toggle__checkbox_input',
                    'option_name' => 'advThemeMang_cpt',
                ]],
            [
                'id' => 'public',
                'title' => 'Public',
                'callback' => array($this->cpt_callbacks, 'CPTCheckboxManager'),
                'page' => 'advThemeMang_cpt',
                'section' => 'admin_cpt_section',
                'args' => [
                    'label_for' => 'public',
                    'class' => 'toggle__checkbox_input',
                    'option_name' => 'advThemeMang_cpt',
                ]],
        ];
        $this->settingsAPI->setSettings($this->settings);
        $this->settingsAPI->setSections($this->sections);
        $this->settingsAPI->setFields($this->fields);
        $this->settingsAPI->addSubpages($this->subpages)->register();

    }

    function storeCustomPostTypes()
    {

        $post_types = get_option('advThemeMang_cpt');
        // var_dump($post_types);
        // die();

        foreach ($post_types as $post_type) {
            // var_dump($post_type);

            $this->custom_post_types[] = [

                'post_type' => $post_type['post_type'],
                'name' => $post_type['plural_name'],
                'singular_name' => $post_type['singular_name'],
                'public' => $post_type['public'],
                'has_archive' => $post_type['has_archive'],

            ];

        }
        // var_dump($this->custom_post_types);
        // die();
    }

    function registerCPT()
    {
        foreach ($this->custom_post_types as $custom_post_type) {

            $name = $custom_post_type['name'];
            $singular = $custom_post_type['singular_name'];
            $public = ($custom_post_type['public'] ? true : false);
            $has_archive = ($custom_post_type['has_archive'] ? true : false);

            register_post_type($singular, [
                'labels' => [
                    'name' => $name,
                    'singular_name' => $singular,
                ],
                'public' => $public,
                'has_archive' => $has_archive,

            ]);
        }
    }

}