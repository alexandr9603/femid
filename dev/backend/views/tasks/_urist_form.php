<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\User;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model backend\models\Tasks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tasks-form">

    <?php $form = ActiveForm::begin(['options' => ['class' => 'uristform']]); ?>
    <?= $form->field($model, 'user_id')->hiddenInput()->label(false) ?>
    <p><b>Пользователь:</b> <?= $model->getUserName() ;?></p><br>
    <p><b>Категория:</b> <?= $model->getCategoryName() ;?></p><br>
    
        
    <?= $form->field($model, 'txt')->textarea(['rows' => 6,'disabled'=>'true']) ?>
    
    <?= $form->field($model, 'stat')->hiddenInput(['value' =>'2'])->label(false); ?>
    
    <br><p><b>Цена:</b> <?= $model->price ;?></p>
    <br>

    <div class="form-group" style="padding-bottom:10px;">
        
        <button data='3' style="width:100px;display: inline;margin-right:10px;" type="button" class="btn-urist btn btn-block btn-default">Отклонить</button>
        <button data='2' style="width:100px;display: inline;margin: 0px;" type="button" class="btn-urist btn btn-block btn-success">Принять</button>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
    $(document).ready(function(){
        $(".btn-urist").click(function(){
            $("#tasks-stat").val($(this).attr("data"));
            $(".uristform").submit();
        });
     
    })
</script>