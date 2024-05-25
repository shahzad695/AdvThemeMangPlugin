<?php
namespace Inc\Base;

use Inc\WordPressAPIs\WidgetsAPI\MediaWidget;

class WidgetControler
{

    public $media_widget;

    function register()
    {
        $checkbox = get_option('advThemeMang');
        $checked = isset($checkbox['media_widget']) ? ($checkbox['media_widget'] ? true : false) : false;

        if (!$checked) {
            return;
        }
        if (function_exists('register_sidebar')) {
            register_sidebar();
        }
        $this->media_widget = new MediaWidget;
        $this->media_widget->register();

    }

}
