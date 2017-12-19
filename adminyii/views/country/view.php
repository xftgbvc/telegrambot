<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use app\helpers\ButtonsView;

/* @var $this yii\web\View */
/* @var $model app\models\Country */

$this->title = $model->country;
$this->params['breadcrumbs'][] = ['label' => 'Страны', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="country-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute'=>'country_id',
                'format'=>'raw',
            ],

            [
                'attribute'=>'country',
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
            'heading'=> ButtonsView::getUpdateDeleteButtons($model->country_id, 'btn-xs'),
            'headingOptions'=> [
                'template'=>'{title}',
            ],
            'type'=>DetailView::TYPE_PRIMARY,
            //'footer' => $buttonsED,
        ],
        //'buttons1'=> ButtonsView::getUpdateButton($model->post_id, 'btn-xs'),
        'container' => ['id'=>'admin_country_view'],
    ]) ?>

</div>
