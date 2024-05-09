<?php

namespace Inc\Base;

class Activate
{
    public static function activate()
    {

        flush_rewrite_rules();

        if (get_option('advThemeMang')) {
            return;
        }
        $option_name = [];
        update_option('advThemeMang', $option_name);
    }

}