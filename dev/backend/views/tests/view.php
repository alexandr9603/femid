<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Tests */

$this->title = "Вопрос: ".$model->question;

?>
<section class="main">
<div class="tasks-create wrap clear">
  <div class="module-header profile-header clear">
        <h2><?=$this->title;?></h2>
         
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary','style' => 'display: inline;margin-left:10px;']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить данный вопрос?',
                'method' => 'post',
            ],
            'style' => 'display: inline;'
        ]) ?>
   </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'question:ntext',
            [
                'label' => 'Ответы',
                'value' => "1.".unserialize($model->answers)[0]." 2.".unserialize($model->answers)[1]." 3.".unserialize($model->answers)[2]." 4.".unserialize($model->answers)[3],
            ],
        ],
    ]) ?>

</div>
 </section>

