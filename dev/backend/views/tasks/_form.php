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

    <?php $form = ActiveForm::begin(['options'=>['class'=>'admin-form-task']]); ?>
    <?= $form->field($model, 'user_id')->hiddenInput()->label(false) ?>
    <div class="form-group field-tasks-name required ">
        <label class="control-label" for="tasks-name">Пользователь</label>
            <input id="tasks-name" class="form-control" value="<?= $model->getUserName(); ?>" type="text" readonly>
        <div class="help-block"></div>
    </div>
    
    <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(backend\models\Category::find()->all(), 'id_category', 'name'))->label('Категория') ?>
    
    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'txt')->textarea(['rows' => 6]) ?>
    
    <?= $form->field($model, 'stat')->hiddenInput(['value' =>'1'])->label(false); ?>
    
    <?= $form->field($model, 'urist_id')->hiddenInput()->label(false); ?>
     
     <div class="form-group field-tasks-name required ">
        <label class="control-label">Юрист: <span class='ur-name'></span></label>
        <div class="help-block"></div>
    </div>
    <button style="margin: 0px 0px 20px;" type="button" class="btn-set-ur btn bg-purple margin">Выбрать юриста</button>
    
    

    <?= $form->field($model, 'price')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<div class="bg-popup">
    <div class="content-popup">
        <table class='select-urist'>
            <tr class='header'><td>Имя Фамилия</td><td>Активных заявок</td><td>Завершенные заявки</td></tr>
            <?php foreach($urist as $res)
                    {
                        $active=$end="";
                        foreach($temp as $cnt)
                        {
                            if($cnt['id']==$res->id && $cnt['stat']=="5")
                            {
                               $active=$cnt['cnt_stat'];
                            }
                            elseif($cnt['id']==$res->id && $cnt['stat']=="6")
                            {
                                $end=$cnt['cnt_stat'];
                            
                            }
                        }
                        echo '<tr class="body-ur" data="'.$res->id.'"><td class="td-ur-name">'.$res->username.' '.$res->last_name.'</td><td>'.$active.'</td><td>'.$end.'</td></tr>';
                    }
            ?>
        </table>
    </div>
</div>

