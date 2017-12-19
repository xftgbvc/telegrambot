<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\widgets\Pjax;
use kartik\icons\Icon;
use app\helpers\StatusHelper;
use app\models\Film;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\adminTables\models\FilmSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model app\models\films\FilmComponent */

$this->title = 'Фильмы';
$this->params['breadcrumbs'][] = $this->title;

$filmObject = new Film();
?>
<div class="film-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax' => true,
        'columns' => [
            [
                'class' => 'kartik\grid\SerialColumn',
                'width' => '30px',
            ],
            [
                'class'=>'kartik\grid\ExpandRowColumn',
                'width'=>'50px',
                'value'=>function ($model, $key, $index, $column) {
                    return GridView::ROW_COLLAPSED;
                },
                'detail'=>function ($model, $key, $index, $column) {
                    return Yii::$app->controller->renderPartial('_expand-row-details', ['model'=>$model]);
                },
                'headerOptions'=>['class'=>'kartik-sheet-style'],
                'expandOneOnly'=>true,
            ],
            [
                'attribute' => 'title',
                'vAlign'=>'middle',
                'hAlign'=>'center',
                'width'=>'200px',
            ],
            /*
            [
                'attribute' => 'description',
                'vAlign'=>'middle',
                'hAlign'=>'center',
                'width'=>'450px',
            ],
            */
            [
                'attribute' => 'genre_ids',
                'vAlign'=>'middle',
                'hAlign'=>'center',
                'width'=>'200px',
                'value'=> function($model) {
                    return $model->getGenreNames();
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=> $filmObject->getGenreList(),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Все'],
            ],
            [
                'attribute' => 'country_ids',
                'vAlign'=>'middle',
                'hAlign'=>'center',
                'width'=>'200px',
                'value'=> function($model) {
                    return $model->getCountryNames();
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=> $filmObject->getCountryList(),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Все'],
            ],
            [
                'attribute' => 'actors_ids',
                'vAlign'=>'middle',
                'hAlign'=>'center',
                'width'=>'250px',
                'value'=> function($model) {
                    return $model->getActorNames();
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=> $filmObject->getPeopleList(),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Все'],
            ],

            [
                'attribute' => 'directors_ids',
                'vAlign'=>'middle',
                'hAlign'=>'center',
                'width'=>'250px',
                'value'=> function($model) {
                    return $model->getDirectorNames();
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=> $filmObject->getPeopleList(),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Все'],
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute'=>'status',
                'vAlign'=>'middle',
                'hAlign'=>'center',
                'width'=>'150px',
                'editableOptions'=> function ($model, $key, $index) {
                    return [
                        'header'=>'Статус',
                        'size'=>'sm',
                        //'asPopover' => false,
                        'inputType' => Editable::INPUT_DROPDOWN_LIST,
                        'data' => StatusHelper::getStatusList(),
                        'options' => ['class'=>'form-control', 'placeholder'=>'Выберите статус...'],
                        'displayValueConfig'=> StatusHelper::getLabelsStatusList(),

                    ];
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=> StatusHelper::getStatusList(),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Все'],
            ],
            [
                'attribute'=>'release_year',
                'vAlign'=>'middle',
                'hAlign'=>'center',
                'width'=>'150px',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=> $filmObject->getYearList(),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Все'],
            ],
            /*
            [
                'attribute'=>'premiereRF',
                'vAlign'=>'middle',
                'hAlign'=>'center',
                'filterType'=>GridView::FILTER_DATE,
                'filterWidgetOptions' => [
                    'pluginOptions'=>['autoclose'=>true],
                ],
                'format' => ['date', 'dd.MM.yyyy'],
                'width'=>'180px',
                'value'=> function($model) {
                    return $model->getDatePremierRF();
                },

            ],
            [
                'attribute'=>'premiereWorld',
                'vAlign'=>'middle',
                'hAlign'=>'center',
                'filterType'=>GridView::FILTER_DATE,
                'filterWidgetOptions' => [
                    'pluginOptions'=>['autoclose'=>true],
                ],
                'format' => ['date', 'dd.MM.yyyy'],
                'width'=>'180px',
                'value'=> function($model) {
                    return $model->getDatePremierWorld();
                },

            ],
            */
            // 'rating',

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
                Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'],
                    ['title'=> 'Создать новый фильм','class'=>'btn btn-default']).
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
            'before'=>'<em>* Список всех фильмов. </em>',
        ],
    ]); ?>
</div>
