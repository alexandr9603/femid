<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="outer-sign-up">
  <div class="inner-sign-up">
            <?php $form = ActiveForm::begin(['id' => 'form-signup','options' =>['class'=>'login-form login-form-reg']]); ?>
                <h3><center>Регистрация</center></h3>
                <p>Чтобы начать работать в системе, заполните, пожалуйста, форму. Все поля обязательны</p>
                <div class="all-inputs">
                    <?= $form->field($model, 'email')->label('Email') ?>
    
                    <?= $form->field($model, 'password')->passwordInput()->label('Пароль') ?>
                    
                    <?= $form->field($model, 'password_repeat')->passwordInput()->label('Повторите пароль') ?>
                    
                    <?= $form->field($model, 'username')->label('Имя') ?>
                    
                    <?= $form->field($model, 'last_name')->label('Фамилия') ?>
                    
                    <?= $form->field($model, 'tel')->label('Телефон') ?>
                    
                    <?=$form->field($model, 'groups')->hiddenInput(['value' => '1','id'=>'groups'])->label(false); ?>
                      <?=$form->field($model, 'lvl')->hiddenInput(['value' => '0','id'=>'lvl'])->label(false); ?>
                    <div class="register-as">
                        <h3 class="upper"><center>Зарегистрироваться</center></h3>
                        <?= Html::Button('Как юрист', ['class' => 'btn btn-primary regusr btn eq-width to-left','data'=>'2']) ?>
                        <?= Html::Button('Как пользователь', ['class' => 'btn btn-primary regusr btn eq-width to-right','data'=>'1']) ?>
                        
                    </div>
                </div>
            <?php ActiveForm::end(); ?>
        
 <ol class='tests'>
    <span class="input-info"><i class="fa fa-chevron-left"></i> Ввод данных</span>
    <p class="title">Осталось пройти тест</p>
    <p class="sub-title">Чтобы начать работать как юрист, пройдите, пожалуйста, тест.</p>
    <?php
    $k=1;
    $temp="is-active";
    $totaltests=count($tests);
    $questions = "questions";
    $q = "text";
        foreach($tests as $test)
        {
            
          echo "<li class='$temp' style='margin-bottom:10px;' data='$k'><p class='$questions'>Вопрос $k из $totaltests</p> <span class='$q'> ".$test->question."</span><div class='div-answers'>";
           $arr=unserialize($test->answers);
           for($i=0;$i<count($arr);$i++)
           {
            echo "<p><input name='answers".$k."' id='variant".$k.$i."' type='radio' class='answers' data='".$test->id."' value='".($i+1)."'><label for='variant".$k.$i."' class='answer-pick-btn'>".$arr[$i]."</label></p>";
           }
           echo"</div></li>";
           $k++;
           $temp="";
        }
    ?>
    <p class="text" id="testRespond">
      <span class="line1"></span><br/>
      <span class="line2"></span>
    </p>

    <?= Html::button('Далее', ['class' => 'btn bg-purple margin next']) ?>
    <?= Html::button('Зарегистрироваться', ['class' => 'btn bg-purple margin finish','style'=>'display:none;']) ?>
    <?= Html::button('Закончить регистрацию', ['class' => 'btn bg-purple margin сonfirm-reg','style'=>'display:none;']) ?>
    <?= Html::button('Попробовать еще раз', ['class' => 'btn bg-purple margin restart','style'=>'display:none;']) ?>
</ol>


  </div>
</div>
   


