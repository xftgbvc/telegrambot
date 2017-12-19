<?php
/**
 * Created by PhpStorm.
 * User: Семен
 * Date: 28.08.2017
 * Time: 5:20
 */

namespace app\helpers;


class RelationHelper
{
    public static function implode($relationData, $printFields = [])
    {
        $items = [];
        $concatFields  = '';
        if (is_array($relationData)){
            foreach ($relationData as $item) {
                foreach($printFields as $field) {
                    $concatFields = $concatFields . ' ' . $item->$field;
                }
                $items[] = $concatFields;
                $concatFields = '';
            }
        }
        return count($items) ? implode(', ', $items) : null ;
    }

}