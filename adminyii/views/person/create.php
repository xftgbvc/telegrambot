<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Person */

$this->title = 'Создать Персону';
$this->params['breadcrumbs'][] = ['label' => 'Персоны', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-create ">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
