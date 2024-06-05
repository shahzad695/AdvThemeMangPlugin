<?php

namespace Inc;

class Init
{
    public static function get_services()
    {
        return [
            Pages\Admin::class,
            Base\Enqueue::class,
            Base\SettingsLinks::class,
            Base\CPTControler::class,
            Base\TaxonomyControler::class,
            Base\WidgetControler::class,
            Base\TestimonialControler::class,
            Base\CustomTemplatesControler::class,
        ];
    }
    public static function register_services()
    {
        foreach (self::get_services() as $class) {
            $service = new $class();

            if (method_exists($service, 'register')) {
                $service->register();
            }
        }

    }

}