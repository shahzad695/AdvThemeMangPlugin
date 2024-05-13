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
        $array_name = $input['post_type'];

        if (count($output) === 0) {

            $stored[$array_name] = $input;

            return $stored;
        }

        foreach ($output as $key => $value) {

            if ($array_name === $key) {

                $output[$key] = $input;
                // var_dump($output);
                // die();
            } else {
                $output[$array_name] = $input;
                // var_dump($output);
                // die();

            }

        }

        return $output;

    }
    function CPTTextFieldManager($args)
    {
        $name = $args['label_for'];
        $option_name = $args['option_name'];
        $option = get_option($option_name);
        // $value = $option[$name];
        echo '<input type="text" id="' . $name . '" name="' . $option_name . '[' . $name . ']" value="" placeholder="' . $args['placeholder'] . '"/>';
    }
    function CPTCheckboxManager($args)
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