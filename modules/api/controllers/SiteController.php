<?php

namespace app\modules\api\controllers;

use Yii;
use yii\rest\Controller;
use app\modules\api\models\LoginForm;
use app\models\User;
use app\models\SignupForm;
use app\models\Token;
use app\models\Student;
use app\models\StudentsignupForm;
use yii\filters\AccessControl;
use app\models\CompanySignupForm;
use app\models\Vacancy;
use app\model\Summary;

class SiteController extends Controller
{

    public function access($user, $role)
    {
        if($user->role != $role)
        {
            return false;
        }
        else
        {return true;}
    }

    protected function tokened($in)
    {
        if(!array_key_exists("token", $in)){
            {return false;}}
            else{
            if(!Token::find()->select('token')->where(['token'=>$in['token']])->one())
            {return false;
            }
            else return true;
            }
           
    }
    public function actionIndex()
    {
        return 'api';
    }

    public function actionLogin()
    {   
        $in = \Yii::$app->request->post();
        $user = User::find()
        ->where(['mail' => $in["username"]])
        ->one();


        if(\Yii::$app->security->validatePassword($in["password"], $user->password))
        {   
            $token = new Token;
            $token->user_id = $user->id;
            $token->token = \Yii::$app->security->generateRandomString();
            if(!Token::findOne(['user_id'=>$user->id])){
            $token->save();}
            else
            { $token_update = Token::find()->where(['user_id'=>$user->id])->one();
              $token_update->token = $token->token;
              $token_update->update();}
            return $token->token;
        }
        else{
            return 'ne poluchilos'; 
        }
        
    }
    public function actionRegister()
    {

        $in = \Yii::$app->request->post();
        $signup = new SignupForm();
        $signup->mail = $in["username"];
        $signup->password = $in["password"];
        if($signup->signup())
        {   
            return "You was sucsessfuly registered";}
        else
        {return "Registeraition failed";}
    }



    public function actionStudentRegister()
    {   
        
        $in = \Yii::$app->request->post();

        if($this->tokened($in) == false)
        {return "Access denyed";}
        

        $token = Token::findOne(['token' => $in['token']]);
        $user = $token->getUser();

      
        if($this->access($user, "au") == false){
           return "Access denyed";
        }

   
        $signup = new StudentSignupForm();
        $user_id = $user->id;

        $signup->user_id = $user_id;
        $signup->name = $in["name"];
        $signup->second_name = $in["second_name"];
        $signup->surname = $in["surname"];
        $signup->university = $in["university"];
        $signup->is_mail_connected = false;
        $signup->mail_list_on = boolval($in["mail_list_on"]);
        $signup->phone_number = $in["phone_number"];

        if($signup->signup())
        {   
           $user->role = "student";
           $user->update();
            return "your student's page created";
        }
        else
        {return "error";}
    
    }

    public function actionCompanyRegister()
    {   
        
        $in = \Yii::$app->request->post();

        if($this->tokened($in) == false)
        {return "Access denyed";}
        

        $token = Token::findOne(['token' => $in['token']]);
        $user = $token->getUser();

      
        if($this->access($user, "au") == false){
           return "Access denyed";
        }
    
        $signup = new CompanySignupForm();
        
        $user_id = $user->id;

        $signup->name = $in["name"];
        $signup->number = $in["number"];
        $signup->adress = $in["adress"];
        $signup->avatar = $in["avatar"];
        $signup->discription = $in["discription"];
        $signup->user_id = $user_id;

        if($signup->signup())
        {   
            $user->role = "company";
            $user->update();
            return "your company's page created";
        }
        else
        {return "error";}
    
    }
    
    public function actionAddVacancy()
    {
        $in = \Yii::$app->request->post();

        if($this->tokened($in) == false)
        {return "Access denyed";}
        

        $token = Token::findOne(['token' => $in['token']]);
        $user = $token->getUser();

      
        if($this->access($user, "company") == false){
           return "Access denyed";
        }
        
        $vacancy = new Vacancy;
        $vacancy->title = $in["title"];
        $vacancy->body = $in["body"];
        $company_id = $user->getCompany()->id;

        $uniq = $vacancy->findOne(['title'=>$vacancy->title,'body'=>$vacancy->body]);
        if(!$uniq)
        {
            $vacancy->save();
        }
        else
        {
            return "error";
        }

    }
    public function actionGetVacancy()
    {
        $in = \Yii::$app->request->post();

        if($this->tokened($in) == false)
        {return "Access denyed";}
        

        $token = Token::findOne(['token' => $in['token']]);
        $user = $token->getUser();


        $vacancy = Vacancy::find()->all();
        return $vacancy;
        

    }

    public function actionAddSummary()
    {
        $in = \Yii::$app->request->post();

        if($this->tokened($in) == false)
        {return "Access denyed";}
        

        $token = Token::findOne(['token' => $in['token']]);
        $user = $token->getUser();

      
        if($this->access($user, "student") == false){
           return "Access denyed";
        }
        
        $vacancy = new Vacancy;
        $vacancy->title = $in["title"];
        $vacancy->body = $in["body"];
        $company_id = $user->getCompany()->id;

        $uniq = $vacancy->findOne(['title'=>$vacancy->title,'body'=>$vacancy->body]);
        if(!$uniq)
        {
            $vacancy->save();
        }
        else
        {
            return "error";
        }

    }
    
    
    public function beforeAction($action)
    {   
       
        return parent::beforeAction($action);
    }

}