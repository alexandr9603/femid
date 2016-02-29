<?php

/* @var $this yii\web\View */

$this->title = 'Femid';
?>

        <!-- Start MAIN -->
        <section class="main">
          <div class="line">
            <div class="wrap no-color">
              <span>Здравствуйте, <?= Yii::$app->user->identity->username; ?>!</span>
            </div>
          </div>
          <!-- Profile -->
          <section class="profile">
            <div class="wrap clear">
              <div class="module-header profile-header clear">
                <h2>Профиль</h2>
              </div>
              <div class="profile-data">
                <div class="profile-data-item">
                  <div class="label">Имя<span class="mandatory">*</span></div>
                  <div class="value"><?= $data->username; ?></div>
                </div>
                <div class="profile-data-item">
                  <div class="label">Фамилия<span class="mandatory">*</span></div>
                  <div class="value"><?= $data->last_name; ?></div>
                </div>
               <!-- <div class="profile-data-item gender">
                  <div class="label">Пол</div>
                  <div class="value">
                    <div class="sex-trigger">
                      <span class="men active">Мужской</span>
                      <span class="women">Женский</span>
                      <i class="icon-cancel"></i>
                    </div>
                  </div>
                </div>
                <div class="profile-data-item">
                  <div class="label">Дата рождения</div>
                  <div class="value">25 декабря 1988 <i class="icon-cancel"></i></div>
                </div>
                <div class="profile-data-item">
                  <div class="label">Страна</div>
                  <div class="value">Украина <i class="icon-cancel"></i></div>
                </div>
                <div class="profile-data-item">
                  <div class="label">Город</div>
                  <div class="value">Киев <i class="icon-cancel"></i></div>
                </div>!-->
              </div>
              <div class="profile-img">
                <img src="img/profile-photo.png" alt="profile photo">
              </div>
            </div>
          </section>
          <!-- End Profile -->
         
        </section>
        <!-- End MAIN -->