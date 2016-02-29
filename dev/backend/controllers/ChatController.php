<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\Chat;
use backend\models\Tasks;
use backend\models\Alerts;
use backend\models\ChatMessage;

class ChatController extends Controller
{
    public function beforeAction($action) {
        $this->enableCsrfValidation=false;
        return parent::beforeAction($action);
    }
    
     public function actionIndex()
    {
        
        $chat = new Chat();
        $res=array();
        if(Yii::$app->user->identity->groups=="1")
        {
            $chat_1=$chat->find()->joinWith('task')->where(['and','tasks.stat=5',"chat.user_id=".Yii::$app->user->identity->id])->all();
            $chat_2=$chat->find()->joinWith('task')->where(["and","tasks.stat=6","chat.user_id=".Yii::$app->user->identity->id])->all();
        }
        elseif(Yii::$app->user->identity->groups=="2")
        {
             $chat_1=$chat->find()->joinWith('task')->where(["and","tasks.stat=5","chat.urist_id=".Yii::$app->user->identity->id])->all();
             $chat_2=$chat->find()->joinWith('task')->where(["and","tasks.stat=6","chat.urist_id=".Yii::$app->user->identity->id])->all();
        }
        
        return $this->render('index',['chat_1'=>$chat_1,'chat_2'=>$chat_2]);
    }
    
     public function actionView($id)
    {
         if(Yii::$app->user->identity->groups=="1")
        {
            $chat_1=Chat::find()->joinWith('task')->where(['and','tasks.stat=5',"chat.user_id=".Yii::$app->user->identity->id])->all();
        }
        elseif(Yii::$app->user->identity->groups=="2")
        {
             $chat_1=Chat::find()->joinWith('task')->where(["and","tasks.stat=5","chat.urist_id=".Yii::$app->user->identity->id])->all();
        }
        
        $model= Chat::findOne($id);
        $tasks= Tasks::findOne($model->task_id);
        $close=0;
        if($tasks->stat=="6")$close=1;
         // Убираем алерты просмотреных чатов
        $alert=new Alerts();
        if(Yii::$app->user->identity->groups=="0")
        {
            $alert->updateAll(['is_viewed'=>1],['and','user_get=0','task_id='.$model->task_id]);
        }
        else
        {
            $alert->updateAll(['is_viewed'=>1],['and','user_get='.Yii::$app->user->identity->id,'task_id='.$model->task_id]);
        }
        
        $chat = new ChatMessage();
        $res=$chat->find()->where(["chat_id"=>$id])->all();
        $chat->updateAll(['is_read' => 1], ['and','chat_id='.$id,'sender!='.Yii::$app->user->identity->groups]);
        return $this->render('view',['msg'=>$res,'chat_id'=>$id,'chat'=>$model,'chat_1'=>$chat_1,'close'=>$close]);
    }
    
    public function actionSendmessage($msg,$chat_id,$close=0)
    {
        
        $chat = new ChatMessage();
        $chat->sender=Yii::$app->user->identity->groups;
        $chat->chat_id=$chat_id;
        $chat->message=$msg;
        $chat->save();
        $k['ret']='<div class="direct-chat-msg right">
                  <div class="direct-chat-info clearfix">
                    <span class="direct-chat-name pull-right">'.Yii::$app->user->identity->username.' '.Yii::$app->user->identity->last_name.'</span>
                    <span class="direct-chat-timestamp pull-left">'.date("Y-m-d H:i:s").'</span>
                  </div><!-- /.direct-chat-info -->
                  <img class="direct-chat-img" src="img/profile-photo.png" alt="message user image"><!-- /.direct-chat-img -->
                  <div class="direct-chat-text">
                    '.$msg.'
                  </div><!-- /.direct-chat-text -->
                </div>';
        if($close)
        {
             $model= Chat::findOne($chat_id);
             $tasks= Tasks::findOne($model->task_id);
             $arr['Tasks']['stat']='6';
             $tasks->load($arr);
             $tasks->save();
             
             /*add alerts a  new chat */
            $alerts= new Alerts();
            $alerts->user_sender=Yii::$app->user->identity->id;
            $alerts->message="Чат завершен: ".$tasks->name;
            $alerts->user_get=$model->user_id;
            $alerts->href="./?r=chat/view&id=".$chat_id;
            $alerts->task_id=$model->task_id;
            $alerts->save();
            /**/
        }
        return json_encode($k);
    }
    
    public function actionGetmessage($chat_id)
    {
        $model= Chat::findOne($chat_id);
        $tasks= Tasks::findOne($model->task_id);
        if($tasks->stat=="6")$k['close']=1;
        else $k['close']=0;
        $name=(Yii::$app->user->identity->groups=="2")?$model->getUserName():$model->getUristName();
        $chat = new ChatMessage();
        $res=$chat->find()->where(['and','chat_id='.$chat_id,'sender!='.Yii::$app->user->identity->groups,'is_read=0'])->all();
        $chat->updateAll(['is_read' => 1], ['and','chat_id='.$chat_id,'sender!='.Yii::$app->user->identity->groups]);
        $str="";
        foreach($res as $field)
        {
            $str.='<!-- Message. Default to the left -->
                <div class="direct-chat-msg">
                  <div class="direct-chat-info clearfix">
                    <span class="direct-chat-name pull-left">'.$name.'</span>
                    <span class="direct-chat-timestamp pull-right">'.$field->updateDate.'</span>
                  </div><!-- /.direct-chat-info -->
                  <img class="direct-chat-img" src="img/profile-photo.png" alt="message user image"><!-- /.direct-chat-img -->
                  <div class="direct-chat-text">
                   '.$field->message.'
                  </div><!-- /.direct-chat-text -->
                </div><!-- /.direct-chat-msg -->';
        }
        $k['ret']=$str;
        return json_encode($k);
    }
    
    public function actionHeadmsg()
    {
        $chat_msg = new ChatMessage();
        $chat = new Chat();
          $usr=(Yii::$app->user->identity->groups=="2")?'urist':'user';
        $count=count(Yii::$app->db->createCommand('SELECT * FROM chat_message cm INNER JOIN chat c ON cm.chat_id=c.chat_id WHERE cm.sender!=:sender AND c.'.$usr.'_id=:user AND cm.is_read=:is_read')
                     >bindValue(':sender',Yii::$app->user->identity->groups)
                    ->bindValue(':user',Yii::$app->user->identity->id)
                    ->bindValue(':is_read','0')
                     ->queryAll());
                     
        $active_chat= Yii::$app->db->createCommand('SELECT t.name,c.chat_id,cm.message,cm.updateDate,u.username,u.last_name FROM chat c INNER JOIN chat_message cm ON c.chat_id=cm.chat_id INNER JOIN tasks t ON c.task_id=t.task_id INNER JOIN user u ON c.'.$usr.'_id=u.id WHERE cm.sender!=:sender AND c.'.$usr.'_id=:user AND cm.is_read=:is_read GROUP BY cm.chat_id')
                    ->bindValue(':sender',Yii::$app->user->identity->groups)
                    ->bindValue(':user',Yii::$app->user->identity->id)
                    ->bindValue(':is_read','0')
                    ->queryAll();
        $str="";
        foreach($active_chat as $res)
        {
            
            $str.='<li><!-- start message -->
                    <a href="./?r=chat/view&id='.$res["chat_id"].'">
                      <div class="pull-left">
                        <img src="img/profile-photo.png" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        '.$res["name"].'
                        <!--<small><i class="fa fa-clock-o"></i> 5 mins</small>-->
                      </h4>
                      <p>'.$res["message"].'</p>
                    </a>
                  </li>';
        }
        $k['count']=$count;
        $k["msg"]=$str;
        return json_encode($k);
    }
    
}
?>