<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model backend\models\Tests */

$this->title = 'Редактирование вопроса: ' . ' ' . $model->question;
?>
<section class="main">
<div class="tasks-create wrap clear">
  <div class="module-header profile-header clear">
        <h2><?=$this->title;?></h2>
   </div>
    <?php $form = ActiveForm::begin(); ?>
     <?= $form->field($model, 'question')->textInput() ?>
        <?php
            $arr=unserialize($model->answers);
           
            for($i=0;$i<count($arr);$i++)
            {
                $temp=(($i+1)==$model->right)?'checked':'';
                echo ($i+1).". Правильный: <input ".$temp." type='radio' name='Tests[right]' value='".($i+1)."'>".$form->field($model, 'answers['.$i.']')->textInput(['value'=>$arr[$i]])->label(false);
            }
        ?>
    
    
    <div class="form-group">
        <?= Html::submitButton('Обновить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
 </section>
