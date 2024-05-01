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
        
        if(!empty($this->admin_pages))
        {
        add_action('admin_menu', [$this, 'addAdminMenu']);
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
        
        foreach ($this->admin_pages as $page)
        {
            add_menu_page($page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'], $page['call_back'], $page['icon_url'], $page['position']);
        }

        foreach ($this->admin_subpages as $subpage)
        {
            add_submenu_page($subpage['parent_slug'],$subpage['page_title'], $subpage['menu_title'], $subpage['capability'], $subpage['menu_slug'], $subpage['call_back'], );
        }
    }

    function setSettings(array $settings)
    {
        $this->settings = $settings;
        return $this;

    }

    function setSections(array $sections)
    {
        $this->sections = $sections;
        return $this;

    }

    function setFields(array $fields)
    {
        $this->fields = $fields;
        return $this;

    }
    function registerSettings()
    {
        foreach ($this->$settings as $subpage)
        {
            register_setting($setting['option_group'], $setting['option_name'], $setting['callback']);
        }

        foreach ($this->$sections as $section)
        {
            add_settings_section(['id'], ['title'], ['callback'], ['page']);
            
        }

        foreach ($this->$fields as $field)
        {
            add_settings_field($field['id'], $field['title'], $field['callback'], $field['page'], $field['section'], $field['args']);

        }
    }
}