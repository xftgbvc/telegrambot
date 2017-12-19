<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use app\helpers\ButtonsView;
/* @var $this yii\web\View */
/* @var $model app\models\Film */
?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute'=>'poster',
                'format'=> 'raw',
                'value'=>Html::img($model->getThumbFileUrl('poster', 'thumb'), ['width'=>'180']),
            ],
            [
                'attribute'=>'description',
                'format'=>'raw',
            ],
            [
                'attribute'=>'content',
                'format'=>'raw',
            ],

            [
                'attribute'=>'writers_implode',
                'format'=>'raw',
                'value'=>$model->writerNames,
            ],

            [
                'attribute'=>'producers_implode',
                'format'=>'raw',
                'value'=>$model->producerNames,
            ],

            [
                'attribute'=>'operators_implode',
                'format'=>'raw',
                'value'=>$model->operatorNames,
            ],

            [
                'attribute'=>'composers_implode',
                'format'=>'raw',
                'value'=>$model->composerNames,
            ],

            [
                'attribute'=>'budget',
                'format'=>'raw',
            ],

            [
                'attribute'=>'fees',
                'format'=>'raw',
            ],

            [
                'attribute'=>'duration',
                'format'=>'raw',
            ],


            [
                'attribute'=>'premiereWorld',
                'format'=>'date',
            ],

            [
                'attribute'=>'premiereRF',
                'format'=>'date',
            ],

            [
                'attribute'=>'alias',
                'format' => 'raw',
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
    ]) ?>
