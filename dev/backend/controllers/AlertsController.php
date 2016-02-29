<?php

namespace backend\controllers;

use Yii;
use backend\models\Alerts;
use yii\web\Controller;

class AlertsController extends \yii\web\Controller
{
    
    public function beforeAction($action) {
        $this->enableCsrfValidation=false;
        return parent::beforeAction($action);
    }
    
    public function actionIndex()
    {
       $alerts=new Alerts();
       $user=0;
       if(Yii::$app->user->identity->groups!="0")$user=Yii::$app->user->identity->id;
       $res=$alerts->find()->where(['and','user_get='.$user,'is_viewed=0'])->all();
       $str='';
       $i=0;
       foreach($res as $field)
        {
             $str.=' <li><a href="'.$field->href.'">
                            <i class="fa fa-warning text-yellow"></i>'.$field->message.'
                        </a>
                    </li>';
            if($i>2)break;
                    $i++;
        }
        $k['ret']=$str;
        $k['count']=count($res);
       return json_encode($k);
    }

}
