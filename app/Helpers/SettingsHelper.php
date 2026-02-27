<?php

namespace App\Helpers;

class SettingsHelper
{
    /**
     * Get a setting value
     *
     * @param string \
     * @param mixed \
     * @return mixed
     */
    public static function get(\, \ = null)
    {
        // You can implement this based on your storage method
        // For now, return from config or session
        return config(\, \);
    }

    /**
     * Set a setting value
     *
     * @param string \
     * @param mixed \
     * @return bool
     */
    public static function set(\, \)
    {
        // You can implement this based on your storage method
        return true;
    }

    /**
     * Get all settings
     *
     * @return array
     */
    public static function all()
    {
        return [
            'system_name' => 'ELCK Southern Lake',
            'church_name' => 'E.L.C.K Southern Lake Diocese',
            'timezone' => 'Africa/Nairobi',
            'date_format' => 'F j, Y',
            'items_per_page' => 10,
            'theme' => 'dark',
        ];
    }
}
