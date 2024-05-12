<?php
namespace Inc\WordPressAPIs\Callbacks;

class AdminManagerCallbacks
{
    function adminManagernIputSanitizer($input)
    {
        var_dump($input);
        $output = [];
        foreach (advThemeMang_ADMINSETTINGSMANAGER as $key => $value) {
            $output[$key] = isset($input[$key]) ? true : false;
        }
        return $output;

    }
    function adminSettingSectionManager()
    {
        echo 'Activate the desired options of the advanced Theme Manager Plugin';
    }
    function adminSettingFieldsManager($args)
    {
        $name = $args['label_for'];
        $class = $args['class'];
        $option_name = $args['option_name'];
        $checkbox = get_option($option_name);
        $checked = isset($checkbox[$name]) ? (($checkbox[$name]) ? true : false) : false;
        echo '<div class="container"><input type="checkbox" id="' . $name . '" name="' . $option_name . '[' . $name . ']" value="1" class="' . $class . '" ' . ($checked ? ' checked' : '')
            . '/><div class="toggle__background_container"><label for="' . $name . '" class="toggle__label"></label></div></div>';
    }

}