<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use app\helpers\ButtonsView;

/* @var $this yii\web\View */
/* @var $model app\models\UserMessages */

$this->title = $model->user_messages_id;
$this->params['breadcrumbs'][] = ['label' => 'Сообщения Телеграм', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="genre-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute'=>'user_messages_id',
                'format'=>'raw',
            ],

            [
                'attribute'=>'request_message',
                'format'=>'raw',
            ],

            [
                'attribute'=>'response_message',
                'format'=>'raw',
            ],

            [
                'attribute'=>'user_name',
                'format'=>'raw',
            ],

            [
                'attribute'=>'user_id',
                'format'=>'raw',
            ],


            [
                'attribute'=>'created_at',
                'format'=>'raw',
            ],

        ],
        'condensed'=>true,
        'hover'=>true,
        'mode'=>DetailView::MODE_VIEW,
        'bordered' => false,
        'striped' => false,
        'responsive' => true,
        'hAlign'=>true,
        'vAlign'=>true,

        'panel'=>[
            'heading'=> ButtonsView::getUpdateDeleteButtons($model->user_messages_id, 'btn-xs'),
            'headingOptions'=> [
                'template'=>'{title}',
            ],
            'type'=>DetailView::TYPE_PRIMARY,
            //'footer' => $buttonsED,
        ],
        //'buttons1'=> ButtonsView::getUpdateButton($model->post_id, 'btn-xs'),
        'container' => ['id'=>'admin_user_messages_view'],
    ]) ?>

</div>
