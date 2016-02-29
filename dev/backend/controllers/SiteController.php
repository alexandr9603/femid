<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;
use backend\models\User;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index','user'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        
        if(Yii::$app->user->identity->groups=="0")
        {
            $this->redirect('../../backend/web/?r=tasks/');   
        }
        else
        {
            return $this->render('index');   
        }
        
    }
    
     public function actionUser($id)
    {
        
            $data= User::findOne($id);     
            return $this->render('user',['data'=>$data]);   
        
    }
    

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        else
        {
             $this->redirect('../../frontend/web/');
        }

       
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        $this->redirect('../../frontend/web/');
        //return $this->goHome();
    }
}
