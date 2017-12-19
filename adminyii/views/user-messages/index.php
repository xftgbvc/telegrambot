<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\icons\Icon;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UserMessagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Сообщения Телеграм';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-messages-index box box-solid">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax'=>true,
        'columns' => [
            [
                'class' => 'kartik\grid\SerialColumn',
                'width' => '30px',
            ],
            [
                'attribute'=>'request_message',
                'vAlign'=>'middle',
                'hAlign'=>'center',
                'width'=>'200px',
            ],
            [
                'attribute'=>'response_message',
                'vAlign'=>'middle',
                'hAlign'=>'center',
                'width'=>'200px',
            ],
            [
                'attribute'=>'user_name',
                'vAlign'=>'middle',
                'hAlign'=>'center',
                'width'=>'200px',
            ],
            [
                'attribute'=>'user_id',
                'vAlign'=>'middle',
                'hAlign'=>'center',
                'width'=>'200px',
            ],
            [
                'attribute'=>'created_at',
                'vAlign'=>'middle',
                'hAlign'=>'center',
                'width'=>'200px',
            ],

            [
                'class' => 'kartik\grid\ActionColumn',
                //'template' => '{update} {delete}',
                'dropdown'=>false,
                'vAlign'=>'middle',
                'deleteOptions'=>['role'=>'modal-remote','title'=>'Удалить',
                    'data-confirm'=>true, 'data-method'=>'post',// for overide yii data api
                    'data-request-method'=>'post',
                    'data-toggle'=>'tooltip',
                    'data-confirm-title'=>'Вы уверены?',
                    'message'=>'Вы уверены что хотите удалить эту запись?'
                ],
            ],
        ],
        'toolbar'=> [
            ['content'=>

                Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''],
                    ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Обновить таблицу'])
            ],
            '{toggleData}'.
            '{export}'
        ],
        'striped' => true,
        'condensed' => true,
        'responsive' => true,
        'panel' => [
            'type' => 'primary',
            'heading' => '<i class="glyphicon glyphicon-list"></i> ' . $this->title,
            'before'=>'<em>* Список всех сообщений телеграма. </em>',
        ],
    ]); ?>
</div>
