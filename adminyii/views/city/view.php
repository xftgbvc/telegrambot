<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use app\helpers\ButtonsView;

/* @var $this yii\web\View */
/* @var $model app\models\City */

$this->title = $model->city;
$this->params['breadcrumbs'][] = ['label' => 'Города', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="city-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute'=>'city_id',
                'format'=>'raw',
            ],

            [
                'attribute'=>'city',
                'format'=>'raw',
            ],

            [
                'attribute'=>'country_id',
                'format'=>'raw',
                'value'=>$model->country->country,
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
            'heading'=> ButtonsView::getUpdateDeleteButtons($model->city_id, 'btn-xs'),
            'headingOptions'=> [
                'template'=>'{title}',
            ],
            'type'=>DetailView::TYPE_PRIMARY,
            //'footer' => $buttonsED,
        ],
        //'buttons1'=> ButtonsView::getUpdateButton($model->post_id, 'btn-xs'),
        'container' => ['id'=>'admin_city_view'],
    ]) ?>

</div>
