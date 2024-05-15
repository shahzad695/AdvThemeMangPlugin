<?php
namespace Inc\WordPressAPIs\Callbacks;

class CPTCallbacks
{

    function CPTSectionManager()
    {
        echo 'Generate the required Custom Post Types';
    }

    function cptInputSanitizer($input)
    {
        $output = get_option('advThemeMang_cpt');

        if (isset($_POST['remove'])) {
            unset($output[$_POST["remove"]]);
            return $output;
        }

        $array_name = $input['post_type'];

        if (count($output) === 0) {
            $output[$array_name] = $input;
            return $output;
        }

        foreach ($output as $key => $value) {
            if ($array_name === $key) {
                $output[$key] = $input;
            } else {
                $output[$array_name] = $input;
            }
        }
        return $output;
    }

    function CPTTextFieldManager($args)
    {
        $name = $args['label_for'];
        $option_name = $args['option_name'];

        $value = '';

        if (isset($_POST['edit-post'])) {
            $cpt = $_POST['edit-post'];
            $option = get_option($option_name);
            $value = $option[$_POST['edit-post']][$name];
        }
        echo '<input type="text" id="' . $name . '" name="' . $option_name . '[' . $name . ']" value="' . $value . '" placeholder="' . $args['placeholder'] . '"/>';
    }
    function CPTCheckboxManager($args)
    {
        $name = $args['label_for'];
        $class = $args['class'];
        $option_name = $args['option_name'];
        $checked = false;
        if (isset($_POST['edit-post'])) {
            $option = get_option($option_name);
            // $value = $option[$_POST['edit-post']][$name];
            $checked = isset($option[$_POST['edit-post']][$name]) ? (($option[$_POST['edit-post']][$name]) ? true : false) : false;
        }
        // $checkbox = get_option($option_name);
        // $checked = isset($checkbox[$name]) ? (($checkbox[$name]) ? true : false) : false;
        echo '<div class="container"><input type="checkbox" id="' . $name . '" name="' . $option_name . '[' . $name . ']" value="1" class="' . $class . '" ' . ($checked ? ' checked' : '')
            . '/><div class="toggle__background_container"><label for="' . $name . '" class="toggle__label"></label></div></div>';
    }

}