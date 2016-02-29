<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Tasks */

$this->title = 'Редактирование';
?>
 <section class="main">
          <div class="line">
            <div class="wrap no-color">
              <span>Здравствуйте, <?= Yii::$app->user->identity->username; ?>!</span>
            </div>
          </div>
<div class="tasks-update wrap clear">
  <div class="module-header profile-header clear">
        <h2><?= (Yii::$app->user->identity->groups=="0")?'Обновление статуса задачи': $model->name ;?></h2>
   </div>

    <?php
     if(Yii::$app->user->identity->groups=="0")
     {
       echo $this->render('_form', ['model' => $model,'urist'=>$urist,'temp'=>$temp]);
     }
     elseif(Yii::$app->user->identity->groups=="2")
     {
         echo $this->render('_urist_form', ['model' => $model,'user'=>$user,'urist'=>$urist,]);   
     }
     else
     {
         echo $this->render('_user_form', ['model' => $model]);   
     }
    ?>

</div>
 </section>
