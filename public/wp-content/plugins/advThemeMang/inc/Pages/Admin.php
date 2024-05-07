<?php

namespace Inc\Pages;

use Inc\WordPressAPIs\Callbacks\AdminCallbacks;
use Inc\WordPressAPIs\Callbacks\AdminManagerCallbacks;
use Inc\WordPressAPIs\SettingsAPI;

class Admin
{
    public $pages = array();
    public $subpages = array();
    public $settings = array();
    public $sections = array();
    public $fields = array();
    public $settingsAPI;
    public $admin_callbacks;
    function __construct()
    {
        $this->settingsAPI = new SettingsAPI();
        $this->admin_callbacks = new AdminCallbacks();
        $this->admin_manager_callbacks = new AdminManagerCallbacks();
        $this->pages = [[
            'page_title' => 'Advance Theme Manager',
            'menu_title' => 'advThemeMang',
            'capability' => 'manage_options',
            'menu_slug' => 'advThemeMang',
            'call_back' => array($this->admin_callbacks, 'adminDashboard'),
            'icon_url' => 'dashicons-store',
            'position' => 110,
        ]];
        $this->subpages = [
            [
                'parent_slug' => 'advThemeMang',
                'page_title' => 'Advance Theme Manager',
                'menu_title' => 'Dashboard',
                'capability' => 'manage_options',
                'menu_slug' => 'advThemeMang',
                'call_back' => $this->pages[0]['call_back'],
            ],
            [
                'parent_slug' => 'advThemeMang',
                'page_title' => 'CPT Manager',
                'menu_title' => 'CPT',
                'capability' => 'manage_options',
                'menu_slug' => 'advThemeMang_CPT',
                'call_back' => array($this->admin_callbacks, 'cptManager'),
            ]];

        $this->settings = [
            [
                'option_group' => 'admin_manager_group',
                'option_name' => 'cpt_manager',
                'callback' => array($this->admin_manager_callbacks, 'adminManagerInputSanitizer'),
            ],
            [
                'option_group' => 'admin_manager_group',
                'option_name' => 'taxonomy_manager',
                'callback' => array($this->admin_manager_callbacks, 'adminManagerInputSanitizer'),
            ],
            [
                'option_group' => 'admin_manager_group',
                'option_name' => 'media_widget',
                'callback' => array($this->admin_manager_callbacks, 'adminManagerInputSanitizer'),
            ],
            [
                'option_group' => 'admin_manager_group',
                'option_name' => 'gallery_manager',
                'callback' => array($this->admin_manager_callbacks, 'adminManagerInputSanitizer'),
            ],
            [
                'option_group' => 'admin_manager_group',
                'option_name' => 'testimonial_manager',
                'callback' => array($this->admin_manager_callbacks, 'adminManagerInputSanitizer'),
            ],
            [
                'option_group' => 'admin_manager_group',
                'option_name' => 'login_manager',
                'callback' => array($this->admin_manager_callbacks, 'adminManagerInputSanitizer'),
            ],
            [
                'option_group' => 'admin_manager_group',
                'option_name' => 'membershi_manager',
                'callback' => array($this->admin_manager_callbacks, 'adminManagerInputSanitizer'),
            ],
            [
                'option_group' => 'admin_manager_group',
                'option_name' => 'chat_manager',
                'callback' => array($this->admin_manager_callbacks, 'adminManagerInputSanitizer'),
            ],

        ];
        $this->sections = [[
            'id' => 'admin_settings_section',
            'title' => 'Admin Settings Manager',
            'callback' => array($this->admin_manager_callbacks, 'adminSettingSectionManager'),
            'page' => 'advThemeMang',
        ]];
        $this->fields = [
            [
                'id' => 'cpt_manager',
                'title' => 'Activate CPT Manager',
                'callback' => array($this->admin_manager_callbacks, 'adminSettingFieldsManager'),
                'page' => 'advThemeMang',
                'section' => 'admin_settings_section',
                'args' => [
                    'label_for' => 'cpt_manager',
                    'class' => 'tab__checkbox_input',
                ],
            ],

            [
                'id' => 'taxonomy_manager',
                'title' => 'Activate Taxonomy Manager',
                'callback' => array($this->admin_manager_callbacks, 'adminSettingFieldsManager'),
                'page' => 'advThemeMang',
                'section' => 'admin_settings_section',
                'args' => [
                    'label_for' => 'taxonomy_manager',
                    'class' => 'tab__checkbox_input',
                ],
            ],
            [
                'id' => 'media_widget',
                'title' => 'Activate Media widget',
                'callback' => array($this->admin_manager_callbacks, 'adminSettingFieldsManager'),
                'page' => 'advThemeMang',
                'section' => 'admin_settings_section',
                'args' => [
                    'label_for' => 'media_widget',
                    'class' => 'tab__checkbox_input',
                ],
            ],
            [
                'id' => 'gallery_manager',
                'title' => 'Activate Gallery Manager',
                'callback' => array($this->admin_manager_callbacks, 'adminSettingFieldsManager'),
                'page' => 'advThemeMang',
                'section' => 'admin_settings_section',
                'args' => [
                    'label_for' => 'gallery_manager',
                    'class' => 'tab__checkbox_input',
                ],
            ],
            [
                'id' => 'testimonial_manager',
                'title' => 'Activate Tetimonial Manager',
                'callback' => array($this->admin_manager_callbacks, 'adminSettingFieldsManager'),
                'page' => 'advThemeMang',
                'section' => 'admin_settings_section',
                'args' => [
                    'label_for' => 'testimonial_manager',
                    'class' => 'tab__checkbox_input',
                ],
            ],
            [
                'id' => 'login_manager',
                'title' => 'Activate Login Manager',
                'callback' => array($this->admin_manager_callbacks, 'adminSettingFieldsManager'),
                'page' => 'advThemeMang',
                'section' => 'admin_settings_section',
                'args' => [
                    'label_for' => 'login_manager',
                    'class' => 'tab__checkbox_input',
                ],
            ],
            [
                'id' => 'membership_manager',
                'title' => 'Activate Membership Manager',
                'callback' => array($this->admin_manager_callbacks, 'adminSettingFieldsManager'),
                'page' => 'advThemeMang',
                'section' => 'admin_settings_section',
                'args' => [
                    'label_for' => 'membership_manager',
                    'class' => 'tab__checkbox_input',
                ],
            ],
            [
                'id' => 'chat_manager',
                'title' => 'Activate Chat Manager',
                'callback' => array($this->admin_manager_callbacks, 'adminSettingFieldsManager'),
                'page' => 'advThemeMang',
                'section' => 'admin_settings_section',
                'args' => [
                    'label_for' => 'chat_manager',
                    'class' => 'tab__checkbox_input',
                ],
            ],

        ];

    }

    function register()
    {
        // var_dump[$this->pages];
        $this->settingsAPI->setSettings($this->settings);
        $this->settingsAPI->setSections($this->sections);
        $this->settingsAPI->setFields($this->fields);
        $this->settingsAPI->addPages($this->pages)->addSubPages($this->subpages)->register();
    }
    // function admin_pages() {
    //      add_menu_page('Advance Theme Manager', 'advThemeMang', 'manage_options', 'advThemeMang', [$this,'adminIndex'], 'dashicons-store', 110);
    //      }
    // function adminIndex() {
    //             require_once advThemeMang_PLUGIN_PATH . 'temp/admin.php';
    //         }

}