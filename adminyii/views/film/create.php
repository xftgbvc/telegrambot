<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Film */

$this->title = 'Создать Фильм';
$this->params['breadcrumbs'][] = ['label' => 'Фильмы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="film-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
