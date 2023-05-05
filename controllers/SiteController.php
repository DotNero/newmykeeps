<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\User;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SignupForm;
use yii\web\ForbiddenHttpException;
use app\models\StudentContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            // 'access' => [
            //     'class' => AccessControl::class,
            //     'only' => ['login', 'logout', 'signup'],
            //     'rules' => [
            //         [   
            //             'actions' => ['login', 'signup'],
            //             'allow' => true,
            //             'roles' => ['?'],
            //         ],
            //         ['allow' => true,
            //          'actions'=> ['logout'],
            //          'roles'=> ['@'],
            //     ],
            //     ],
            // ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */

 public function beforeAction($action)
 {
    if(parent::beforeAction($action)){
        if(!Yii::$app->user->can($action->id)){
            throw new ForbiddenHttpException('Access denied');
        }
        return true;
    }
    else{
        return false;
    }
 }
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
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */

     public function actionsStudentSignup()
     {
        $model = new StudentSignupForm();
        if($model->load(Yii::$app->reqest->post()) && $model->signup)
        {
            Yii::$app->session->addFlash('SIGNUP', 'your student account have successfuly registered');
        }
     }
     public function actionSignup()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post()) && $model->signup()){
            Yii::$app->session->addFlash('SIGNUP', 'You have successfully registered');
            if($model->role_routing=="Student")
            {return $this->redirect("/web/index.php?r=site%2Fabout");}
            return $this->redirect(Yii::$app->homeUrl);
        }
        Yii::$app->session->addFlash('SIGNUP', 'We have some troubles with your account, sorry');
        return $this->render('signup',['model'=>$model]);

        //переписать этот метод, так, чтобы происходило разделение 
        
    }
     

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /*
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}