<?php
namespace Inc\WordPressAPIs\Callbacks;

class TaxonomyCallbacks
{

    function TaxSectionManager()
    {
        echo 'Generate the required Taxonomy';
    }

    function TAXInputSanitizer($input)
    {
        $output = get_option('advThemeMang_tax');

        if (isset($_POST['remove'])) {
            unset($output[$_POST["remove"]]);
            return $output;
        }

        $array_name = $input['taxonomy'];

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

    function TaxTextFieldManager($args)
    {
        $name = $args['label_for'];
        $option_name = $args['option_name'];

        $value = '';

        if (isset($_POST['edit-taxonomy'])) {
            $option = get_option($option_name);
            $value = $option[$_POST['edit-taxonomy']][$name];
        }
        echo '<input type="text" id="' . $name . '" name="' . $option_name . '[' . $name . ']" value="' . $value . '" placeholder="' . $args['placeholder'] . '"/>';
    }
    function TaxCheckboxManager($args)
    {
        $name = $args['label_for'];
        $class = $args['class'];
        $option_name = $args['option_name'];
        $checked = false;
        if (isset($_POST['edit-taxonomy'])) {
            $option = get_option($option_name);
            // $value = $option[$_POST['edit-taxonomy']][$name];
            $checked = isset($option[$_POST['edit-taxonomy']][$name]) ? (($option[$_POST['edit-taxonomy']][$name]) ? true : false) : false;
        }
        // $checkbox = get_option($option_name);
        // $checked = isset($checkbox[$name]) ? (($checkbox[$name]) ? true : false) : false;
        echo '<div class="container"><input type="checkbox" id="' . $name . '" name="' . $option_name . '[' . $name . ']" value="1" class="' . $class . '" ' . ($checked ? ' checked' : '')
            . '/><div class="toggle__background_container"><label for="' . $name . '" class="toggle__label"></label></div></div>';
    }

    function TaxPostTypeCheckboxManager($args)
    {
        $name = $args['label_for'];
        $class = $args['class'];
        $option_name = $args['option_name'];
        $checked = false;
        if (isset($_POST['edit-taxonomy'])) {
            $option = get_option($option_name);

        }

        $post_types = get_post_types(['public' => true]);
        $output = '';
        foreach ($post_types as $post) {
            if (isset($_POST['edit-taxonomy'])) {

                $checked = isset($option[$_POST['edit-taxonomy']][$name][$post]) ? (($option[$_POST['edit-taxonomy']][$name][$post]) ? true : false) : false;

            }

            $output .= '<div class="toggle toggle--mbtm"><input type="checkbox" id="' . $post . '" name="' . $option_name . '[' . $name . '][' . $post . ']" value="1" class="' . $class . '" ' . ($checked ? ' checked' : '')
                . '/><div class="toggle__background_container"><label for="' . $post . '" class="toggle__label"></label></div><strong>' . $post . '</strong></div>';
        }

        echo $output;
    }

}
