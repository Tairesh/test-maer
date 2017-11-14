<?php

namespace app\helpers;

use yii\helpers\StringHelper as BaseStringHelper;

/**
 * Dummy helper
 *
 * @author ilya
 */
class StringHelper extends BaseStringHelper
{

    /**
     * Unicode-version of ucfirst
     * @param string $string
     * @return string
     */
    public static function ucfirst(string $string) : string
    {
        return mb_strtoupper(mb_substr($string, 0, 1)) . mb_substr($string, 1);;
    }
    
}
