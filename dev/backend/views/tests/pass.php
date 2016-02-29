<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TestsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Прохождение теста';

?>

<section class="main">
<div class="tasks-create wrap clear">
  <div class="module-header profile-header clear">
                <h2><?=$this->title;?></h2>
   </div>
  <ol style=list-style-type:decimal !important;'>
    <?php
    $k=1;
        foreach($dataProvider as $test)
        {
           echo "<li style=''margin-bottom:10px;'> <span style='font-weight:bold;'>Вопрос: ".$test->question."</span><div class='div-answers'>";
           $arr=unserialize($test->answers);
           for($i=0;$i<count($arr);$i++)
           {
              echo "<p><input name='answers".$test->id."' type='radio' class='answers' data='".$test->id."' value='".($i+1)."'>: ".$arr[$i]."</p>";
           }
           echo"</div></li>";
           $k++;
        }
    ?>
</ol>
    <?= Html::button('Закончить', ['class' => 'btn bg-purple margin finish']) ?>
</div>
 </section>
<?php if(!$close)$this->registerJsFile('js/test.js'); ?>