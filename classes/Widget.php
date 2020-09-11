<?php
namespace ElPackInator\Classes;

use Elementor\Plugin;

class Widget
{
    /**
     * This register widget class
     * @param string class
     * @return void
     */
    public static function register( $class )
    {
        $widget     =   new $class;
        Plugin::$instance->widgets_manager->register_widget_type( $widget );
    }

    /**
     * That register elementor controls
     * @param string $class
     * @return void
     */
    public static function init_controls( $class )
    {
        $control     =   new $class;
        Plugin::$instance->controls_manager->register_control( $control->type, $control );
    }
}