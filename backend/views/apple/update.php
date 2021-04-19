<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Apple */

$this->title = 'Изменить яблоко: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Яблоки', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="apple-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
