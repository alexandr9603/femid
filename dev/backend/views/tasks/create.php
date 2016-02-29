<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Category;

/* @var $this yii\web\View */
/* @var $model backend\models\Tasks */

$this->title = 'Создать вопрос';
/*$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;*/
?>
 <section class="main">
          <div class="line">
            <div class="wrap no-color">
              <span>Здравствуйте, <?= Yii::$app->user->identity->username; ?>!</span>
            </div>
          </div>
<div class="tasks-create wrap clear">
  <div class="module-header profile-header clear">
                <h2>Обратиться к юристу</h2>
   </div>
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a aria-expanded="true" href="#tab_1" data-toggle="tab">Решение проблемы</a></li>
              <li class=""><a aria-expanded="false" href="#tab_2" data-toggle="tab">Для студентов</a></li>
              <li class=""><a aria-expanded="false" href="#tab_3" data-toggle="tab">Поиск по юристам</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                     <h2>Описание проблемы</h2>
                    <?php $form = ActiveForm::begin(); ?>

                        <?= $form->field($model, 'user_id')->hiddenInput(['value' => Yii::$app->user->identity->id])->label(false); ?>
                  
                            <?= $form->field($model, 'name')->textInput()->label("Заголовок"); ?>                    
                    
                        <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(backend\models\Category::find()->all(), 'id_category', 'name'))->label('Категория') ?>
                        
                        <?= $form->field($model, 'txt')->textarea(['rows' => 6,'placeholder'=>'Опишите, пожалуйста, проблему'])->label(false); ?>
                    
                        <div class="form-group">
                            <?= Html::submitButton('Отправить' , ['class' => 'btn btn-success']) ?>
                        </div>
                    
                        <?php ActiveForm::end(); ?>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                The European languages are members of the same family. Their separate existence is a myth.
                For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ
                in their grammar, their pronunciation and their most common words. Everyone realizes why a
                new common language would be desirable: one could refuse to pay expensive translators. To
                achieve this, it would be necessary to have uniform grammar, pronunciation and more common
                words. If several languages coalesce, the grammar of the resulting language is more simple
                and regular than that of the individual languages.
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                It has survived not only five centuries, but also the leap into electronic typesetting,
                remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
                sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
                like Aldus PageMaker including versions of Lorem Ipsum.
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>

</div>
 </section>