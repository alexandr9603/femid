<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Tests */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tests-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'question')->textInput() ?>

    1. Правильный: <input checked type="radio" name='Tests[right]' value="1"><?= $form->field($model, 'answers[0]')->textInput()->label(false) ?>
    2. Правильный: <input type="radio" name='Tests[right]' value="2"><?= $form->field($model, 'answers[1]')->textInput()->label(false) ?>
    3. Правильный: <input type="radio" name='Tests[right]' value="3"><?= $form->field($model, 'answers[2]')->textInput()->label(false) ?>
    4. Правильный: <input type="radio" name='Tests[right]' value="4"><?= $form->field($model, 'answers[3]')->textInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
