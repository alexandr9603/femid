<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Авторизация';
$this->params['breadcrumbs'][] = $this->title;
?>
            <?php $form = ActiveForm::begin(['id' => 'login-form','options' =>['class'=>'login-form']]); ?>
                <h3><center>Вход</center></h3>
                <p>Рады вас снова видеть</p>
                <div class="all-inputs">
                    <?= $form->field($model, 'email')->label('Email') ?>
    
                    <?= $form->field($model, 'password')->passwordInput()->label('Пароль') ?>
    
                    <?= $form->field($model, 'rememberMe')->checkbox()->label('Запомнить меня') ?>
    
                    <div style="color:#999;margin:1em 0">
                        Если вы забыли свой пароль Вы можете <?= Html::a('восстановить его', ['site/request-password-reset']) ?>.
                    </div>
    
                    <div class="form-group">
                        <?= Html::submitButton('Вход', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    </div>
                </div>

            <?php ActiveForm::end(); ?>

