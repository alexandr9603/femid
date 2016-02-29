<?php
namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\Tests;
use yii\db\Expression;
Yii::$app->language = "ru-RU";
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
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
         $this->layout = 'layoutsignup';
        if (!\Yii::$app->user->isGuest) {
            return  $this->redirect('../../backend/web/');
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $this->redirect('../../backend/web/');
            //return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        
        $this->layout = 'layoutsignup';
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    $this->redirect('../../backend/web/');
                    //return $this->goHome();
                }
            }
        }
        $tests= new Tests();
        $res=$tests->find()->orderBy(new Expression('rand()'))->limit(20)->all();
        return $this->render('signup', [
            'model' => $model,
            'tests' => $res
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
     
    public function actionGetresult()
    {
        $arr=Yii::$app->request->post();
        
        $tests = new Tests();
        $dataProvider = $tests->find()->all();
        //$kol=count($dataProvider);
        $kol=20;
        $right=0;
        foreach($dataProvider as $test)
        {
          
            foreach($arr['result'] as $answer)
            {
                if($test->id==$answer[0]['id'] && $test->right==$answer[0]['answer'])$right++;
            }
        }
        
        $max_ratin=5;
        $k['kol']=$kol;
        $k['right']=$right;
        $k['max_rating']=$max_ratin;
        $k['rating']=floor(($max_ratin*$right)/$kol);
        return json_encode($k);
    }
    public function actionGettest()
    {
        $tests= new Tests();
        $res=$tests->find()->orderBy(new Expression('rand()'))->limit(20)->all();
        $k=1;
        $temp="is-active";
        $totaltests=count($res);
        $questions = "questions";
        $q = "text";
        $buf="";
        foreach($res as $test)
        {
         
            $buf.= "<li class='$temp' style='margin-bottom:10px;' data='$k'><p class='$questions'>Вопрос $k из $totaltests</p> <span class='$q'> ".$test['question']."</span><div class='div-answers'>";
            $arr=unserialize($test['answers']);
            for($i=0;$i<count($arr);$i++)
            {
             $buf.="<p><input name='answers".$k."' id='variant".$k.$i."' type='radio' class='answers' data='".$test['id']."' value='".($i+1)."'><label for='variant".$k.$i."' class='answer-pick-btn'>".$arr[$i]."</label></p>";
            }
            $buf.="</div></li>";
            $k++;
            $temp="";
        }
        $ret['txt']=$buf;
        return json_encode($ret);
    }
}
