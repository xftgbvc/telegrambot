<?php
/**
 * Created by PhpStorm.
 * User: Семен
 * Date: 27.08.2017
 * Time: 4:46
 */

namespace app\helpers;
use Yii;

class StatusHelper
{
    const STATUS_INACTIVE=0; // статус записи - скрыто
    const STATUS_ACTIVE=1; // статус - доступно
    const STATUS_ARCHIVED=2; // статус - в архиве

    public static function getLabelStatusType($statusType)
    {
        return ($statusType == 0) ? '<span class="label label-danger">Скрыто</span>'  :
            (($statusType == 1) ? '<span class="label label-success">Доступно</span>' : '<span class="label label-warning">Архив</span>');
    }

    public static function getStatusList()
    {
        return [
            self::STATUS_INACTIVE => 'Скрыто',
            self::STATUS_ACTIVE => 'Доступно',
            self::STATUS_ARCHIVED => 'Архив',
        ];
    }

    public static function getLabelsStatusList()
    {
        return [
            self::STATUS_INACTIVE => '<span class="label label-danger">Скрыто</span>',
            self::STATUS_ACTIVE => '<span class="label label-success">Доступно</span>',
            self::STATUS_ARCHIVED => '<span class="label label-warning">Архив</span>',
        ];
    }

}