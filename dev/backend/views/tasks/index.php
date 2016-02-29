<?php

use yii\helpers\Html;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $model backend\models\Tasks */

$this->title = 'Заявки';  
?>
 <section class="main">
<div class="tasks-create wrap clear">
  <div class="module-header profile-header clear">
                <h2>Заявки</h2>
   </div>
        <?= GridView::widget([
                      'dataProvider' =>$dataProvider,
                      'tableOptions' => [
                            'class' => 'table table-striped table-bordered'
                        ],
                      'columns' => [
                          ['class' => 'yii\grid\SerialColumn'],
                          //'task_id',
                          'name',
                          [
                              'attribute'=>'category_id',
                              'label'=>'Категория',
                              'format'=>'text', // Возможные варианты: raw, html
                              'content'=>function($data){
                                  return $data->getCategoryName();
                              },
                          ],
                          'txt:ntext',
                          [
                              'label' => 'Цена',
                              'format' => 'text',
                              'value' => function($data){
                                  return (!$data->price)?"N/A":$data->price;
                              },
                          ],
                          [
                              'label' => 'Cтатус',
                              'format' => 'text',
                              'value' => function($data){
                                  return $data->getTxtstatus($data->stat);
                              },
                          ],
                           [
                              'class' => 'yii\grid\ActionColumn',
                              'template' => '{update}',
                              'buttons' => [
                                  'update' => function ($url,$model) {
                                      return ($model->stat=="1")?Html::a('<i class="fa fa-fw fa-eye"></i>', $url):"";
                                  },
                              ],
                          ],
                      ],
                  ]); ?>

</div>
 </section>