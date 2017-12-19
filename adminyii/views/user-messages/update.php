<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserMessages */

$this->title = 'Изменить Сообщение Пользователя: ' . $model->user_messages_id;
$this->params['breadcrumbs'][] = ['label' => 'Сообщения Телеграм', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user_messages_id, 'url' => ['view', 'id' => $model->user_messages_id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="user-messages-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
