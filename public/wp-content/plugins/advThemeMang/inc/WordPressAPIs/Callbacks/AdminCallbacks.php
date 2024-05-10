<?php

namespace Inc\WordPressAPIs\Callbacks;

class AdminCallbacks
{
    function adminDashboard()
    {

        return require_once advThemeMang_PLUGIN_PATH . 'temp/admin.php';
    }

    function cptManager()
    {
        return require_once advThemeMang_PLUGIN_PATH . 'temp/cpt.php';
    }

}