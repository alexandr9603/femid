<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAssetReg;
use common\widgets\Alert;

AppAssetReg::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">

    <div class="login-page">
      <header class="login-page-header">
        <div class="wrap">
          <div class="logo"><img src="img/logo.png" alt=""></div>
          <div class="login-page-register">
            <span>Впервые тут?</span>
            <a href="./?r=site/<?= (Yii::$app->controller->action->id=='login') ? "signup" : "login" ;?>">
                <?= (Yii::$app->controller->action->id=='login') ? "Регистрация" : "Вход" ;?>
                <i> ></i>
            </a>
          </div>
        </div>
      </header>
    
       
    <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
       
      
    </div>
    
    <div class="container">
       
        <?= $content ?>
    </div>
</div>

<!--<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>-->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
