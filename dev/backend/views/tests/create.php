<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Tests */

$this->title = 'Добавление вопроса';
?>

<section class="main">
<div class="tasks-create wrap clear">
  <div class="module-header profile-header clear">
                <h2>Добавление вопроса</h2>
   </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
 </section>