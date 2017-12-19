<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use kartik\widgets\FileInput;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Person */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="person-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'photo')->widget(FileInput::classname(), [
        'options' => [
            'accept' => 'image/*',
        ],
        'pluginOptions' => [

            'initialPreview'=>Html::img($model->getThumbFileUrl('photo', 'thumb'), ['height' => '207']),
            'overwriteInitial' => true,
            'showUpload'=>false,
            //'showRemove' => true,
            'showCaption' => false,
            'showRemove' => false,
            'browseClass' => 'btn btn-primary',
        ],

    ]); ?>

    <?= $form->field($model, 'gender')->dropDownList($model->genderList) ?>

    <?= $form->field($model, 'birth')->widget(DatePicker::classname(), [
        'options' => [
            'placeholder' => 'Введите дату ...',
            'value' => $model->dateBirth,
        ],
        'pluginOptions' => [
            'autoclose'=>true
        ]
    ]);?>

    <?= $form->field($model, 'city_id')->widget(Select2::classname(), [
        'data'=>$model->cityList,
        'options' => [
            'placeholder' => 'Выберите Город ...',
        ],
    ]); ?>

    <?= $form->field($model, 'status')->dropDownList($model->statusList) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
