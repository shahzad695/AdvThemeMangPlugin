<?php

namespace Inc\WordPressAPIs;

class SettingsAPI
{
    public $admin_pages = array();
    public $admin_subpages = array();
    public $settings = array();
    public $sections = array();
    public $fields = array();
    function register()
    {

        if (!empty($this->admin_pages) || !empty($this->admin_subpages)) {
            add_action('admin_menu', [$this, 'addAdminMenu']);
        }
        if (!empty($this->settings)) {
            add_action('admin_init', [$this, 'registerSettings']);
        }
    }

    function addPages(array $pages)
    {

        $this->admin_pages = $pages;
        return $this;

    }

    function addSubPages(array $subpages)
    {
        $this->admin_subpages = $subpages;
        return $this;

    }
    function addAdminMenu()
    {

        foreach ($this->admin_pages as $page) {
            add_menu_page($page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'], $page['call_back'], $page['icon_url'], $page['position']);
        }

        foreach ($this->admin_subpages as $subpage) {
            add_submenu_page($subpage['parent_slug'], $subpage['page_title'], $subpage['menu_title'], $subpage['capability'], $subpage['menu_slug'], $subpage['call_back'], );
        }
    }

    function setSettings(array $set)
    {

        $this->settings = $set;

        return $this;

    }

    function setSections(array $sec)
    {
        $this->sections = $sec;
        return $this;

    }

    function setFields(array $fie)
    {
        $this->fields = $fie;
        return $this;

    }
    function registerSettings()
    {

        foreach ($this->settings as $setting) {
            register_setting($setting['option_group'], $setting['option_name'], $setting['callback']);
        }

        foreach ($this->sections as $section) {
            add_settings_section($section['id'], $section['title'], $section['callback'], $section['page']);

        }

        foreach ($this->fields as $field) {
            add_settings_field($field['id'], $field['title'], $field['callback'], $field['page'], $field['section'], $field['args']);

        }
    }
}