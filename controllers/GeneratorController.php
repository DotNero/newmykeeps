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
use app\models\Student;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SignupForm;
use yii\web\ForbiddenHttpException;
use app\models\StudentSignupForm;
use app\models\CompanySignupform;
use Faker\Factory;

class GeneratorController extends Controller
{
public function actionGenerateUser()
{
    $factory = Factory::create();

    for($i=0; $i < 10; $i++)
    {$user = new User();
     $user->mail = $factory->email();
     $user->password = $factory->password(rand(8,20));
     $user->auth_key = $factory->text(rand(8,20));
     $user->access_token = $factory->text(rand(8,20));
     $user->mail_confirm_token = $factory->text(rand(8,20));
     $user->status = 'waiting';
     $user->save(false);
    }
}
public function actionGenerateStudent()
{
    $factory = Factory::create();
    $func = function($digit){
        if($digit >= 1 && $digit <= 2)
        {
            return true;
        }
        return false;
    };
    for($i=0;$i < 10;$i++)
    {
        $student = new Student();
        $student->name = $factory->firstName();
        $student->second_name = $factory->firstName();
        $student->surname = $factory->lastName();
        $student->university = $factory->country();
        $student->user_id = $factory->valid($func)->randomNumber(rand(1,2));
        $student->is_mail_connected = $factory->boolean();
        $student->photo= $factory->imageUrl();
        $student->phone_number=$factory->phoneNumber();
        $student->save(false);

    }
}
}