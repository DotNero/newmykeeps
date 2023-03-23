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

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['login', 'logout', 'signup'],
                'rules' => [
                    [   
                        'actions' => ['login', 'signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    ['allow' => true,
                     'actions'=> ['logout'],
                     'roles'=> ['@'],
                ],
                ],
            ],
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

     public function actionSignup()
<<<<<<< HEAD
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post()) && $model->signup()){
            Yii::$app->session->addFlash('SIGNUP', 'You have successfully registered');
            return $this->redirect(Yii::$app->homeUrl);
        }
        Yii::$app->session->addFlash('SIGNUP', 'We have some troubles with your account, sorry');
        return $this->render('signup',['model'=>$model]);
        
    }
     
=======
     {
         $model = new SignupForm();
     
         if ($model->load(Yii::$app->request->post()) && $model->signup()) { /*Save 
     to DB first*/
             $genmail = $model->email; //get model email value 
             $identity = User::findOne(['email' => $genmail]); //find user by email
             if (Yii::$app->user->login($identity)) { // login user
                 return $this->redirect('account'); // show accaount page
             }
         }
         return $this->render('signup', [
             'model' => $model,
         ]);
     }
>>>>>>> 3cf1a60fb592c0a2e9ab73f08462cae40827291a

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