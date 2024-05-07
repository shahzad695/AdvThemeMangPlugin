<?php
namespace Inc\WordPressAPIs\Callbacks;

class AdminManagerCallbacks
{
    function adminManagerInputSanitizer($input)
    {
        return (isset($input) ? true : false);

    }
    function adminSettingSectionManager()
    {
        echo 'Activate the desired options of the advanced Theme Manager Plugin';
    }
    function adminSettingFieldsManager($args)
    {
        $name = $args['label_for'];
        $class = $args['class'];
        $checkbox = get_option($name);
        echo '<input type="checkbox" name="' . $name . '" value="1" class="' . $class . '" ' . ($checkbox ? 'checked' : '') . '/>';
    }

}