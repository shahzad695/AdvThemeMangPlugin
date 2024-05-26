<?php
namespace Inc\WordPressAPIs\WidgetsAPI;

use WP_Widget;

class MediaWidget extends WP_Widget
{

    public $widget_ID;
    public $widget_name;
    public $widget_options;
    public $control_options;

    public function __construct()
    {

        $this->widget_ID = 'advthemeManag_media_widget';
        $this->widget_name = 'Advance Theme Manager Media Widget';
        $this->widget_options = [
            'classname' => $this->widget_ID,
            'description' => $this->widget_name,
            'customize_selective_refresh' => true,
        ];
        $this->control_options = [
            'width' => 400,
            'height' => 300,
        ];
        parent::__construct($this->widget_ID, $this->widget_name, $this->widget_options, $this->control_options);
    }
    public function register()
    {

        add_action('widgets_init', [$this, 'widgetInit']);

    }

    public function widgetInit()
    {

        register_sidebar(array(
            'name' => 'Sidebar Name',
            'id' => 'sidebar-1',
            'description' => 'sidebar for widgets',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="widgettitle">',
            'after_title' => '</h2>',
        ));

        register_widget($this);
    }
    public function Widget($args, $instance)
    {
        $title = apply_filters('widget_title', $instance['title']);
        $image = esc_url($instance['image']);
        echo $args['before_widget'];
        if (!empty($title)) {
            echo $args['before_widget'] . $title . $args['after_widget'];
        }
        if (!empty($image)) {
            echo '<img src="' . $image . '" alt="' . $title . '">';
        }
        echo $args['after_widget'];

    }
    public function form($instance)
    {
        $title = isset($instance['title']) ? $instance['title'] : '';
        $image = isset($instance['image']) ? $instance['image'] : '';
        ?>
<label for="<?php echo $this->get_field_id('title') ?>">Title</label>
<input type="text" class="widefat" id="<?php echo $this->get_field_id('title') ?>" name="<?php echo $this->get_field_name('title') ?>"
    value="<?php echo $title ?>">
<label for="<?php echo $this->get_field_id('image') ?>">Image</label>
<input type="text" class="widefat upload-image" id="<?php echo $this->get_field_id('image') ?>"
    name="<?php echo $this->get_field_name('image') ?>" value="<?php echo $image ?>">
<button type="button" id="widget-image-uploader" class="button button-primary js-image-uploader">Select Image</button>

<?php

    }
    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['image'] = sanitize_text_field($new_instance['image']);
        
        return $instance;
    }

}