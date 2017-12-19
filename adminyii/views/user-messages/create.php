<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\UserMessages */

$this->title = 'Create User Messages';
$this->params['breadcrumbs'][] = ['label' => 'User Messages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-messages-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
