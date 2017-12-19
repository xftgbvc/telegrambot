<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Genre */

$this->title = "Изменить Жанр: {$model->genre}";
$this->params['breadcrumbs'][] = ['label' => 'Жанры', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->genre, 'url' => ['view', 'id' => $model->genre_id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="genre-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
