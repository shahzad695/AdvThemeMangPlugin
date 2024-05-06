<?php

namespace Inc\WordPressAPIs\Callbacks;

class AdminCallbacks
{
    function adminDashboard()
    {
        
        return require_once (advThemeMang_PLUGIN_PATH . 'temp/admin.php');
    }

    function cptManager()
    {
       return require_once (advThemeMang_PLUGIN_PATH . 'temp/cpt.php');
    }

    function settings( $input)
    {
        return $input;
    }
    function sections( )
    {
        echo '<p>This is Admin Settings Section</p>';
    }
    function fields( )
    {
        $value = get_option('first_name');
        echo '<input type="text" name="first_name" value="'.$value.'" placeholder="First Name">';
    }
    
}