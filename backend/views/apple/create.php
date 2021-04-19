<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Apple */

$this->title = 'Создать яблоко';
$this->params['breadcrumbs'][] = ['label' => 'Яблоки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="apple-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
