<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Person */

$this->title = 'Изменить Персону: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Персоны', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => "{$model->first_name} {$model->last_name}", 'url' => ['view', 'id' => $model->person_id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="person-update ">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
