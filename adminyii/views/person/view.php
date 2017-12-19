<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use app\helpers\ButtonsView;

/* @var $this yii\web\View */
/* @var $model app\models\Person */

$this->title = "{$model->first_name} {$model->last_name}";
$this->params['breadcrumbs'][] = ['label' => 'Персоны', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute'=>'photo',
                'format'=> 'raw',
                'value'=>Html::img($model->getThumbFileUrl('photo', 'thumb'), ['width'=>'180']),
            ],
            [
                'attribute'=>'person_id',
                'format'=>'raw',
            ],
            [
                'attribute'=>'first_name',
                'format'=>'raw',
            ],

            [
                'attribute'=>'last_name',
                'format'=>'raw',
            ],

            [
                'attribute'=>'city_id',
                'format'=>'raw',
                'value'=>$model->city->city,
            ],

            [
                'attribute'=>'gender',
                'format'=>'raw',
                'value'=>$model->getGenderType($model->gender),
            ],

            [
                'attribute'=>'birth',
                'format'=>'date',
            ],

            [
                'attribute'=>'status',
                'format'=>'raw',
                'value'=>  \app\helpers\StatusHelper::getLabelStatusType($model->status),
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

        'panel'=>[
            'heading'=> ButtonsView::getUpdateDeleteButtons($model->person_id, 'btn-xs'),
            'headingOptions'=> [
                'template'=>'{title}',
            ],
            'type'=>DetailView::TYPE_PRIMARY,
            //'footer' => $buttonsED,
        ],
        //'buttons1'=> ButtonsView::getUpdateButton($model->post_id, 'btn-xs'),
        'container' => ['id'=>'admin_person_view'],
    ]) ?>

</div>
