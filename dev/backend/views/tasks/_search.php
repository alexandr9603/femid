<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TasksSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tasks-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'task_id') ?>
    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'category_id') ?>

    <?= $form->field($model, 'txt') ?>

    <?= $form->field($model, 'urist_id') ?>

    <?php // echo $form->field($model, 'date_add') ?>

    <?php // echo $form->field($model, 'date_upd') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'stat') ?>

    <?php // echo $form->field($model, 'form') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
