<?php

/* @var $this yii\web\View */
use yii\web\View;

$this->title = 'Femid Chat';
?>
<section class='main'>
<div class='wrap clear'>
<div class="module-header profile-header clear">
                <h2>Диалог с юристом</h2>
   </div>
<div class="box box-warning direct-chat direct-chat-warning">
  <div class="box-header with-border">
    <h3 class="box-title">Диалог</h3>
    <div class="box-tools pull-right">
      <button class="btn btn-box-tool" data-toggle="tooltip" title="Диалоги" data-widget="chat-pane-toggle"><i class="fa fa-comments"></i></button>
    </div>
  </div><!-- /.box-header -->
  <div class="box-body">
    <!-- Conversations are loaded here -->
    <div class="direct-chat-messages">
      
      <?php
      $name=(Yii::$app->user->identity->groups=="1") ? $chat->getUristName() : $chat->getUserName();
       foreach($msg as $res)
        {
          if($res->sender==Yii::$app->user->identity->groups)
          {
             echo '  <!-- Message to the right -->
                <div class="direct-chat-msg right">
                  <div class="direct-chat-info clearfix">
                    <span class="direct-chat-name pull-right">'.Yii::$app->user->identity->username.' '.Yii::$app->user->identity->last_name.'</span>
                    <span class="direct-chat-timestamp pull-left">'.$res->updateDate.'</span>
                  </div><!-- /.direct-chat-info -->
                  <img class="direct-chat-img" src="img/profile-photo.png" alt="message user image"><!-- /.direct-chat-img -->
                  <div class="direct-chat-text">
                    '.$res->message.'
                  </div><!-- /.direct-chat-text -->
                </div><!-- /.direct-chat-msg -->';
          }
          else
          {
                echo '<!-- Message. Default to the left -->
                <div class="direct-chat-msg">
                  <div class="direct-chat-info clearfix">
                    <span class="direct-chat-name pull-left">'.$name.'</span>
                    <span class="direct-chat-timestamp pull-right">'.$res->updateDate.'</span>
                  </div><!-- /.direct-chat-info -->
                  <img class="direct-chat-img" src="img/profile-photo.png" alt="message user image"><!-- /.direct-chat-img -->
                  <div class="direct-chat-text">
                   '.$res->message.'
                  </div><!-- /.direct-chat-text -->
                </div><!-- /.direct-chat-msg -->';
          }
        }
      ?>
      
      

    
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
      </ul><!-- /.contatcts-list -->
    </div><!-- /.direct-chat-pane -->
  </div><!-- /.box-body -->
  <div class="box-footer">
    <div class="input-group">
      <input <?=($close)?'disabled="disabled"':'';?> type="text" name="message"  placeholder="Type Message ..." class="msg-txt form-control">
      <span style="display: none;" class='ask-msg-close'>Вы хотите завершить диалог?</span>
      <span class="input-group-btn">
        <input type="hidden" value="<?php echo $chat_id;?>" class='chat_id'>
        <button <?=($close)?'disabled="disabled"':'';?> type="button" class="btn btn-warning btn-flat send-msg btn-chat">Отправить</button>
        <?= (Yii::$app->user->identity->groups=="2" && !$close) ? '<button type="button" class="btn btn-success btn-flat close-btn">Подтвердить</button><button type="button" class="btn-chat btn btn-danger btn-flat close-chat">Завершить разговор</button><button type="button" class="btn btn-default btn-flat close-btn">Отмена</button>': '';?>
      </span>
    </div>
  </div><!-- /.box-footer-->
</div><!--/.direct-chat -->
</div>
</section>
<?php if(!$close)$this->registerJsFile('js/chat.js'); ?>