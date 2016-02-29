<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TestsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Тесты';

?>
<section class="main">
<div class="tasks-create wrap clear">
  <div class="module-header profile-header clear">
                <h2>Тесты</h2>
         <?= Html::a('Добавить вопрос', ['create'], ['class' => 'btn bg-purple margin','style' => 'display: inline;']) ?>
   </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'question:ntext',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
 </section>
