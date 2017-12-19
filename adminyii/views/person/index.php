<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\widgets\Pjax;
use kartik\icons\Icon;
use app\helpers\StatusHelper;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PersonSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Персоны';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-index box box-solid">
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
                'attribute'=>'first_name',
                'vAlign'=>'middle',
                'hAlign'=>'center',
                'width'=>'200px',
            ],
            [
                'attribute'=>'last_name',
                'vAlign'=>'middle',
                'hAlign'=>'center',
                'width'=>'200px',
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
                        'size'=>'md',
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
                'attribute'=>'gender',
                'vAlign'=>'middle',
                'hAlign'=>'center',
                'width'=>'180px',
                'format'=>'raw',
                'value'=> function($model, $key, $index) {
                    return $model->getGenderType($model->gender);
                },

            ],
            [
                'attribute'=>'birth',
                'vAlign'=>'middle',
                'hAlign'=>'center',
                'filterType'=>GridView::FILTER_DATE,
                'filterWidgetOptions' => [
                    'pluginOptions'=>['autoclose'=>true],
                ],
                'format' => ['date', 'dd.MM.yyyy'],
                'width'=>'180px',
                'value'=> function($data) {
                    //return Yii::$app->formatter->asDate($data->created);
                    return date('d-M-y', $data->birth);
                },

            ],
            [
                'attribute'=>'city_id',
                'vAlign'=>'middle',
                'hAlign'=>'center',
                'width'=>'180px',
                'value'=> 'city.city',
                /*
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=> \app\models\persons\PersonComponent::getCityList(),

                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Все'],
                */
            ],
            /*
            [
                'attribute'=>'photo',
                'format'=> 'raw',
                'vAlign'=>'middle',
                'hAlign'=>'center',
                'width'=>'80px',
                'value'=> function($data) {
                    return Html::img($data->getThumbFileUrl('photo', 'thumb'), ['width'=>'80']);
                },
            ],
            */
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
                    ['title'=> 'Создать новую персону','class'=>'btn btn-default']).
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
            'before'=>'<em>* Список всех персон. </em>',
        ],
    ]); ?>
</div>
