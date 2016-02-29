<?php
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'Диалоги';

?>

<section class="main">
<div class="tasks-create wrap clear">
  <div class="module-header profile-header clear">
                <h2>Диалоги</h2>
   </div>
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a aria-expanded="true" href="#tab_1" data-toggle="tab">Активные</a></li>
              <li class=""><a aria-expanded="false" href="#tab_2" data-toggle="tab">Завершенные</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                
                <div class="box box-warning direct-chat direct-chat-warning direct-chat-contacts-open">
  <div class="box-header with-border">
    <h3 class="box-title">История</h3>
    <div class="box-tools pull-right">
      <span data-original-title="3 New Messages" data-toggle="tooltip" title="" class="badge bg-yellow"><?=count($chat_1);?></span>
    </div>
  </div><!-- /.box-header -->
  <div class="box-body">
    <!-- Conversations are loaded here -->
    <div class="direct-chat-messages">
    
    </div><!--/.direct-chat-messages-->

    <!-- Contacts are loaded here -->
    <div class="direct-chat-contacts">
      <ul class="contacts-list">
          <?php
                foreach($chat_1 as $res)
                  { ?>
                     <li><a href="./?r=chat/view&id=<?=$res->chat_id;?>">
                          <img class="contacts-list-img" src="img/profile-photo.png" alt="Contact Avatar">
                          <div class="contacts-list-info">
                            <span class="contacts-list-name">
                                Заявка
                              <small class="contacts-list-date pull-right"><?= $res->date_add; ?></small>
                            </span>
                            <span class="contacts-list-msg"><?= $res->getTaskName(); ?></span>
                          </div><!-- /.contacts-list-info -->
                        </a>
                      </li>
                  <?php }
                ?>
        <!-- End Contact Item -->
      </ul><!-- /.contatcts-list -->
    </div><!-- /.direct-chat-pane -->
  </div><!-- /.box-body -->
  
</div><!--/.direct-chat -->
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                              <div class="box box-warning direct-chat direct-chat-warning direct-chat-contacts-open">
  <div class="box-header with-border">
    <h3 class="box-title">История</h3>
    <div class="box-tools pull-right">
      <span data-original-title="3 New Messages" data-toggle="tooltip" title="" class="badge bg-yellow"><?=count($chat_2);?></span>
    </div>
  </div><!-- /.box-header -->
  <div class="box-body">
    <!-- Conversations are loaded here -->
    <div class="direct-chat-messages">
      
    </div><!--/.direct-chat-messages-->

    <!-- Contacts are loaded here -->
    <div class="direct-chat-contacts">
      <ul class="contacts-list">
          <?php
                foreach($chat_2 as $res)
                  { ?>
                     <li><a href="./?r=chat/view&id=<?=$res->chat_id;?>">
                          <img class="contacts-list-img" src="img/profile-photo.png" alt="Contact Avatar">
                          <div class="contacts-list-info">
                            <span class="contacts-list-name">
                                Заявка
                              <small class="contacts-list-date pull-right"><?= $res->date_add; ?></small>
                            </span>
                            <span class="contacts-list-msg"><?= $res->getTaskName(); ?></span>
                          </div><!-- /.contacts-list-info -->
                        </a>
                      </li>
                  <?php }
                ?>
        <!-- End Contact Item -->
      </ul><!-- /.contatcts-list -->
    </div><!-- /.direct-chat-pane -->
  </div><!-- /.box-body -->
  
</div><!--/.direct-chat -->
            <!-- /.tab-content -->
          </div>

</div>
 </section>