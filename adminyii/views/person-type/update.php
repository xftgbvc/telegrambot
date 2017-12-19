<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PersonType */

$this->title = 'Редактировать Тип Персоны: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Типы Персон', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->personType_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="person-type-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
