<?php
/**
 * Created by PhpStorm.
 * User: Семен
 * Date: 27.08.2017
 * Time: 4:21
 */

namespace app\helpers;
use yii\helpers\Html;
class ButtonsView
{
    public static function getCreateButton($btnSize = null)
    {
        return Html::a('Create Post', ['create'], ['class' => "btn btn-success $btnSize"]);
    }

    public static function getUpdateButton($recordID, $btnSize = null)
    {
        return Html::a('Изменить', ['update', 'id' => $recordID], ['class' => "btn btn-success $btnSize"]);
    }

    public static function getDeleteButton($recordID, $btnSize)
    {
        return Html::a('Удалить', ['delete', 'id' => $recordID], [
            'class' => "btn btn-danger $btnSize",
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить запись персонала?',
                'method' => 'post',
            ],
        ]);
    }

    public static function getUpdateDeleteButtons($recordID, $btnSize = null)
    {
        return  self::getUpdateButton($recordID, $btnSize) . ' ' .  self::getDeleteButton($recordID, $btnSize);
    }

}