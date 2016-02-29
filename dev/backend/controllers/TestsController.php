<?php

namespace backend\controllers;

use Yii;
use backend\models\Tests;
use backend\models\TestsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TestsController implements the CRUD actions for Tests model.
 */
class TestsController extends Controller
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
     * Lists all Tests models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TestsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
         $dataProvider->pagination->pageSize=5;
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tests model.
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
     * Creates a new Tests model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tests();
        $arr=Yii::$app->request->post();
        $arr['Tests']['answers']=serialize($arr['Tests']['answers']);
        if ($model->load($arr) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Tests model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if(Yii::$app->request->post())
        {
            $arr=Yii::$app->request->post();
            $arr['Tests']['answers']=serialize($arr['Tests']['answers']);   
        }
        if ($model->load($arr) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Tests model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    public function actionPass()
    {
        $tests = new Tests();
        $dataProvider = $tests->find()->all();

        return $this->render('pass', [
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionGetresult()
    {
        $arr=Yii::$app->request->post();
        
        $tests = new Tests();
        $dataProvider = $tests->find()->all();
        $kol=count($dataProvider);
        $right=0;
        foreach($dataProvider as $test)
        {
          
            foreach($arr['result'] as $answer)
            {
                if($test->id==$answer[0]['id'] && $test->right==$answer[0]['answer'])$right++;
            }
        }
        
        $max_ratin=10;
        $k['kol']=$kol;
        $k['right']=$right;
        $k['max_rating']=$max_ratin;
        $k['rating']=floor(($max_ratin*$right)/$kol);
        return json_encode($k);
    }

    /**
     * Finds the Tests model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tests the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tests::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
