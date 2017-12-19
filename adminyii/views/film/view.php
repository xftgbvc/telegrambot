<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use app\helpers\ButtonsView;

/* @var $this yii\web\View */
/* @var $model app\models\Film */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Фильмы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="film-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute'=>'poster',
                'format'=> 'raw',
                'value'=>Html::img($model->getThumbFileUrl('poster', 'thumb'), ['width'=>'180']),
            ],
            [
                'attribute'=>'title',
                'format'=>'raw',
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
                'attribute'=>'genres_implode',
                'format'=>'raw',
                'value'=>$model->genreNames,
            ],

            [
                'attribute'=>'countries_implode',
                'format'=>'raw',
                'value'=>$model->countryNames,
            ],

            [
                'attribute'=>'actors_implode',
                'format'=>'raw',
                'value'=>$model->actorNames,
            ],

            [
                'attribute'=>'directors_implode',
                'format'=>'raw',
                'value'=>$model->directorNames,
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
                'attribute'=>'release_year',
                'format'=>'raw',
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
            'heading'=> ButtonsView::getUpdateDeleteButtons($model->film_id, 'btn-xs'),
            'headingOptions'=> [
                'template'=>'{title}',
            ],
            'type'=>DetailView::TYPE_PRIMARY,
            //'footer' => $buttonsED,
        ],
        //'buttons1'=> ButtonsView::getUpdateButton($model->post_id, 'btn-xs'),
        'container' => ['id'=>'admin_film_view'],
    ]) ?>

</div>
