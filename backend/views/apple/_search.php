<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AppleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="apple-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'color') ?>

    <?= $form->field($model, 'created_at') ?>

    <?= $form->field($model, 'fall_at') ?>

    <?= $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'eaten') ?>

    <div class="form-group">
        <?= Html::submitButton('Искать', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Сбросить', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
