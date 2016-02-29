<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini"><img src="./img/logo.png"></span><span class="logo-lg"><img src="./img/logo.png"></span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">
        <?php if(Yii::$app->user->identity->groups!="0")  { ?>
        <li class="dropdown messages-menu">
            <a aria-expanded="true" href="#" class="dropdown-toggle head-new-msg" data-toggle="dropdown">
             <i class="fa fa-envelope-o"></i>
            </a>
            <ul class="dropdown-menu">
              <li class="header">У вас новых сообщений: <span class='cnt-new-msg'>0</span></li>
              <li>
                <!-- inner menu: contains the actual data -->
                <div style="position: relative; overflow: hidden; width: auto; height: 200px;" class="slimScrollDiv">
                    <ul style="overflow: hidden; width: 100%; height: 200px;" class="menu active-cht-msg">
                  
                  <!-- end message -->
                </ul><div style="background: rgb(0, 0, 0) none repeat scroll 0% 0%; width: 3px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 131.148px;" class="slimScrollBar"></div><div style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51) none repeat scroll 0% 0%; opacity: 0.2; z-index: 90; right: 1px;" class="slimScrollRail"></div></div>
              </li>
            </ul>
          </li>
            <?php } ?>
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning count-alerts"></span>
                    </a>
                    <ul class="dropdown-menu">
                       
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu list-alerts">
                                
                            </ul>
                        </li>
                        <li class="footer"><a href="./?r=tasks/">Посмотреть всё</a></li>
                    </ul>
                </li>
                <!-- Tasks: style can be found in dropdown.less -->
                
                <?=(Yii::$app->user->identity->groups=='1')?'<li><a href="./?r=tasks/create">Обратиться</a></li>':''; ?>
                <li class="dropdown notifications-menu">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-align-justify"></i>
                    </a>
                    <!--<button class="btn  btn-flat btn bg-purple btn-flat " type="button"><i class="fa fa-align-justify"></i></button>-->
                     <ul class="dropdown-menu">
                        <li><?= Html::a(
                                    'Выход',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?></li>
                     </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
