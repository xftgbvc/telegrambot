<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $model app\models\Film */
$this->title = "Изменить Фильм: {$model->title}";
$this->params['breadcrumbs'][] = ['label' => 'Фильмы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->film_id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="film-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
