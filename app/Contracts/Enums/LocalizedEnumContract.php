<?php
namespace App\Contracts\Enums;

interface LocalizedEnumContract
{
    /**
     * Get the default localization key.
     *
     * @return string
     */
    public static function getLocalizationKey();
}
