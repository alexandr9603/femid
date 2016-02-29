<?php

namespace backend\controllers;

use Yii;
use backend\models\Tasks;
use backend\models\Alerts;
use backend\models\Chat;
use backend\models\User;
use backend\models\TasksSearch;


use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TasksController implements the CRUD actions for Tasks model.
 */
class TasksController extends Controller
{
   
   
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Tasks models.
     * @return mixed
     */
    
     /*
     *0 - у админа
     *1 - у юриста
     *2 - у пользователя
     *3 - юрист отклонил
     *4 - пользователь отклонил
     *5 - пользователь принял
     *6 - чат завершен
     */
    public function actionIndex()
    {
        
        $searchModel =new TasksSearch();
        $ts=new TasksSearch();
        $view="";
        if(Yii::$app->user->identity->groups=="0")//Если админ
        {
            $view="list";
            $dataProvider = $searchModel->search();
        }
        elseif(Yii::$app->user->identity->groups=="1")//если пользователь
        {
            $view="views";
            $dataProvider = $searchModel->search(['TasksSearch'=>['user_id' =>Yii::$app->user->identity->id]]);
        }
        else //Если юрист
        {
            $view="index";
            $dataProvider = $searchModel->search(['TasksSearch'=>['urist_id' =>Yii::$app->user->identity->id]]);
        }
        
        $dataProvider->pagination->pageSize=5;
        return $this->render($view,[
            'task'=>$ts,
            'dataProvider'=>$dataProvider
        ]);
        
    }

    /**
     * Displays a single Tasks model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    /**
     * Creates a new Tasks model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tasks();
        $arr=Yii::$app->request->post();
        $arr['Tasks']['date_add']=$arr['Tasks']['date_upd']=date("Y-m-d H:i:s");
        $arr['Tasks']['price']=0;
        
        if ($model->load($arr) && $model->save()) {
            $alerts= new Alerts();
            $alerts->user_sender=Yii::$app->user->identity->id;
            $alerts->message="Создана новая заявка: ".$arr['Tasks']['name'];
            $alerts->user_get='0';
            $alerts->href="./?r=tasks/update&id=".$model->task_id;
            $alerts->task_id=$model->task_id;
            $alerts->save();
            return $this->redirect(['views']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Tasks model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        
        // Убираем алерты просмотреных тасков
        $alert=new Alerts();
        if(Yii::$app->user->identity->groups=="0")
        {
            $alert->updateAll(['is_viewed'=>1],['and','user_get=0','task_id='.$id]);
        }
        else
        {
            $alert->updateAll(['is_viewed'=>1],['and','user_get='.Yii::$app->user->identity->id,'task_id='.$id]);
        }
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
             /*
           
            *4 - пользователь отклонил 
            */
            if($model->stat=="1")
            {
                $alerts= new Alerts();
                $alerts->user_sender=Yii::$app->user->identity->id;
                $alerts->message="Новая заявка: ".$model->name;
                $alerts->user_get=$model->urist_id;
                $alerts->href="./?r=tasks/update&id=".$model->task_id;
                $alerts->task_id=$model->task_id;
                $alerts->save();
            }
            elseif($model->stat=="2")
            {
                $alerts= new Alerts();
                $alerts->user_sender=Yii::$app->user->identity->id;
                $alerts->message="Подтверждение заявки: ".$model->name;
                $alerts->user_get=$model->user_id;
                $alerts->href="./?r=tasks/update&id=".$model->task_id;
                $alerts->task_id=$model->task_id;
                $alerts->save();
            }
            elseif($model->stat=="3")
            {
                $alerts= new Alerts();
                $alerts->user_sender=Yii::$app->user->identity->id;
                $alerts->message="Пересмотрение заявки: ".$model->name;
                $alerts->user_get="0";
                $alerts->href="./?r=tasks/update&id=".$model->task_id;
                $alerts->task_id=$model->task_id;
                $alerts->save();
            }
            
            if(Yii::$app->user->identity->groups=="1" && $model->stat=="5")
            {
             $chat = new Chat();
             $arr['Chat']['user_id']= $model->user_id;
             $arr['Chat']['urist_id']=$model->urist_id;
             $arr['Chat']['task_id']=$model->task_id;
             $chat->load($arr);
             $chat->save();
             
             /*add alerts a  new chat */
            $alerts= new Alerts();
            $alerts->user_sender=Yii::$app->user->identity->id;
            $alerts->message="Открыт новый чат: ".$model->name;
            $alerts->user_get=$model->urist_id;
            $alerts->href="./?r=chat/view&id=".$chat->chat_id;
            $alerts->task_id=$model->task_id;
            $alerts->save();
            /**/
             return $this->redirect("./?r=chat/view&id=".$chat->chat_id);
            }
            if(Yii::$app->user->identity->groups=="1")return $this->redirect(['views']);
            elseif(Yii::$app->user->identity->groups=="0")return $this->redirect(['index']);
            else return $this->redirect(['list']);
        } else {
            $usr= new User();
            $user=$usr->find()->where(['id'=>$model->user_id])->one();
            $temp=Yii::$app->db->createCommand('SELECT u.id,stat,COUNT(*) as cnt_stat  FROM tasks t INNER JOIN user u ON t.urist_id=u.id WHERE u.groups="2" AND t.stat="6" OR t.stat="5" GROUP BY u.id,stat')->queryAll();
            $urist=$usr->find()->where(['groups'=>'2'])->all();
            return $this->render('update', [
                'model' => $model,
                'user' => $user,
                'urist' => $urist,
                'temp'=> $temp,
            ]);
        }
    }

    /**
     * Deletes an existing Tasks model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tasks model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tasks the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tasks::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
     public function getTxtstatus($id)
    {
        $stat[0]='У администратора';
        $stat[1]='У юриста';
        $stat[2]='У пользователя';
        $stat[3]='Юрист отклонил';
        $stat[4]='Пользователь отклонил';
        $stat[5]='Пользователь принял';
        $stat[6]='Задача решена';
        return $stat[$id];
    }
    
}
