<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
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
 <main>
        <header>
            <div class="header_block">
                <div class="content clearfix">
                    <div class="left_h_block">
                        <div class="logo">
                            <img src="img/logo.png"/>
                        </div>
                    </div>
                    <div class="right_h_block">
                        <div class="head_menu_buttons">
                            <ul>
                                <li><a class="" href="">пользователям</a></li>
                                <li><a class="" href="">юристам</a></li>
                                <li><a class="" href="">блог</a></li>
                            </ul>
                            <a href="./?r=site/login" class="btn btn-white" style="text-decoration:none;">ВОЙТИ</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>


        <?= $content ?>

 <footer>
            <img src="img/footer-logo.png"/>
            <p class="slogan">Тут может быть слоган</p>
            <ul>
                <li>
                    <a href="">О компании</a>
                </li>
                <li>
                    <a href="">Контакты</a>
                </li>
                <li>
                    <a href="">Правила пользования</a>
                </li>
            </ul>
            <p class="copiright">&copy; <?= date('Y') ?>. Femid</p>
        </footer>
    </main>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
