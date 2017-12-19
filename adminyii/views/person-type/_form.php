<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\PersonType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="person-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
