<?php

namespace Inc\Base;
class SettingsLinks{
    function register() {
        add_filter("plugin_action_links_" . advThemeMang_PLUGIN, [$this,'settingsLink']);
    }
    function settingsLink($link) {
                $settings='<a href="admin.php?page=advThemeMang">Settings</a>';
                array_push($link,$settings);
                return $link;
            }

}