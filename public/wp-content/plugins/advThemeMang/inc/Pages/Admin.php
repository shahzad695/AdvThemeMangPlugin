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
        ];

        $this->settings[] = [
            'option_group' => 'admin_manager_group',
            'option_name' => 'advThemeMang',
            'callback' => array($this->admin_manager_callbacks, 'adminManagerInputSanitizer'),
        ];

        $this->sections = [[
            'id' => 'admin_settings_section',
            'title' => 'Admin Settings Manager',
            'callback' => array($this->admin_manager_callbacks, 'adminSettingSectionManager'),
            'page' => 'advThemeMang',
        ]];

        foreach (advThemeMang_ADMINSETTINGSMANAGER as $key => $value) {

            $this->fields[] = [
                'id' => $key,
                'title' => $value,
                'callback' => array($this->admin_manager_callbacks, 'adminSettingFieldsManager'),
                'page' => 'advThemeMang',
                'section' => 'admin_settings_section',
                'args' => [
                    'label_for' => $key,
                    'class' => 'toggle__checkbox_input',
                    'option_name' => 'advThemeMang',
                ],
            ];

        }

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