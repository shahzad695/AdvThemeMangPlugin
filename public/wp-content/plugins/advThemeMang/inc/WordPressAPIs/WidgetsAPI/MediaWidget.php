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
        // var_dump($this);
        // die();
        register_widget($this);
    }
    public function Widget($args, $instance)
    {
        echo $args['before_widget'];
        echo $instance;
        echo $args['after_widget'];

    }
    public function form($instance)
    {
        $title = $instance['title'];
    }
}