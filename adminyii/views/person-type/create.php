<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PersonType */

$this->title = 'Создать Тип Персоны';
$this->params['breadcrumbs'][] = ['label' => 'Типы Персон', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-type-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
