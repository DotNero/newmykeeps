<?php

namespace app\controllers;

use Yii;
use app\models\EmailConfirm;
use yii\base\InvalidArgumentException;
use app\models\PasswordResetRequestForm;
use app\models\PasswordResetForm;
use yii\web\BadRequestHttpException;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\User;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SignupForm;
use yii\web\ForbiddenHttpException;
use app\models\StudentsignupForm;
use app\models\CompanySignupform;

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
                'denyCallback' => function() {
                    die('Доступ запрещен');
                },
            'rules' => [

                [
                    'allow' => true,
                    'actions' => ['login', 'signup'],
                    'roles' => ['?'],
                ],

                [
                    'allow' => true,
                    'actions' => ['logout'],
                    'roles' => ['user_au'],
                ],
            ]
            ],
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


    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
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

    public function actionPasswordResetRequest()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Спасибо! На ваш Email было отправлено письмо со ссылкой на восстановление пароля.');
 
                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Извините. У нас возникли проблемы с отправкой.');
            }
        }
 
        return $this->render('passwordResetRequest', [
            'model' => $model,
        ]);
    }

    public function actionEmailConfirm($token)
    {
        try {
            $model = new EmailConfirm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
 
        if ($model->confirmEmail()) {
            Yii::$app->getSession()->setFlash('success', 'Спасибо! Ваш Email успешно подтверждён.');
        } else {
            Yii::$app->getSession()->setFlash('error', 'Ошибка подтверждения Email.');
        }
 
        return $this->goHome();
    }
    /**
     * Logout action.
     *
     * @return Response
     */
    
    public function actionPasswordReset($token)
    {
        try {
            $model = new PasswordResetForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
 
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'Спасибо! Пароль успешно изменён.');
 
            return $this->goHome();
        }
 
        return $this->render('passwordReset', [
            'model' => $model,
        ]);
    }
     public function actionsStudentsignup()
     {
        $model = new StudentsignupForm();
        if($model->load(Yii::$app->reqest->post()) && $model->signup)
        {
            Yii::$app->session->addFlash('SIGNUP', 'your student account have successfuly registered');
        }
        return $this->render('studentsg',['model'=>$model]);
     }

     public function actionsCompanySignup()
     {
        $model = new CompanySignupForm();
        if($model->load(Yii::$app->reqest->post()) && $model->signup)
        {
            Yii::$app->session->addFlash('SIGNUP', 'your student account have successfuly registered');
        }
        return $this->render('studentsg',['model'=>$model]);
     }
     
     public function actionSignup()
     {
         $model = new SignupForm();
         $post = Yii::$app->request->post();

         if ($model->load($post) && $model->signup()){

             if($post['signup-button'] === "student")
             {   
                 return $this->redirect(['/site/student-signup']);

             }
             if($post['signup-button'] === "company")
             {
                return $this->redirect(['/site/company-signup']);
             }
         }
         return $this->render('signup',['model'=>$model]);  
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