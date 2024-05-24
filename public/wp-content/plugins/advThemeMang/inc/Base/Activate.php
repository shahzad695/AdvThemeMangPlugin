<?php

namespace Inc\Base;

class Activate
{
    public static function activate()
    {

        flush_rewrite_rules();
        $option_name = [];
        if (!get_option('advThemeMang')) {
            update_option('advThemeMang', $option_name);
        }
        if (!get_option('advThemeMang_cpt')) {
            update_option('advThemeMang_cpt', $option_name);
        }
        if (!get_option('advThemeMang_tax')) {
            update_option('advThemeMang_tax', $option_name);
        }

    }

}