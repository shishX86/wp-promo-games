<?php

/**
 * 
 * @package WpPromoGames
 */

namespace WpPromoGames\Core;


class Utils
{

    public static function sanitizeArray(?array &$arr = []): ?array
    {
        if( !isset($arr) ) return $arr;

        foreach ($arr as &$value) {
            if (!is_array($value)) {
                $value = sanitize_text_field($value);
            } else {
                self::sanitizeArray($value);
            }
        }

        return $arr ? $arr : [];
    }

    public static function getRepeaterValues(array $tmplFields, array $postData): array {
        $output = [];

        foreach ($tmplFields as $key => $conf) {
            if (is_array($conf) && isset($conf['name'])) {
                $name = str_replace(array( '[', ']' ), '', $conf['name']);
                $values = self::sanitizeArray( $postData[$name] );

                $output[] = [
                    'value' => $values,
                    'conf' => $conf
                ];
            }
        }

        return $output;
    }
}
