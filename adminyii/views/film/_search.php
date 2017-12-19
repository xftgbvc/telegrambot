<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FilmSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="film-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'film_id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'content') ?>

    <?= $form->field($model, 'budget') ?>

    <?php // echo $form->field($model, 'fees') ?>

    <?php // echo $form->field($model, 'premiereWorld') ?>

    <?php // echo $form->field($model, 'premiereRF') ?>

    <?php // echo $form->field($model, 'release_year') ?>

    <?php // echo $form->field($model, 'duration') ?>

    <?php // echo $form->field($model, 'poster') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'alias') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
