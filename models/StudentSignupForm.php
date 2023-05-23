<?php
namespace app\models;

use app\models\User;
use app\models\Company;
use Yii;
use yii\db\ActiveRecord;
use yii\base\Model;
use yii\helpers\VarDumper;

class StudentsignupForm extends Model{
public $name;
public $phone_number;
public $surname;
public $university;
public $second_name;
public $mail_list_on;
public $user_id;
public $is_mail_connected;
public function rules()
{
    return [
        [['name', 'surname','university','mail','phone_number' ], 'required'],
        ['name', 'string', 'max' => 16],
        ['second_name', 'string', 'max' => 16],
        ['surname', 'string', 'max' => 16],
        ['university', 'string', 'max' => 32],
        ['phone_number', 'int', 'max' => 19, 'min'=> 18],
        ['mail','unique', 'targetClass'=> '\app\models\User', 'message' => 'this mail is already registered'],  
        ['name', 'unique', 'targetClass' => '\app\models\Student', 'message' => 'this username already taken'],
        ['mail_list_on', 'boolean'],
    ];
}
public function signup() 
{       
        $student = new Student;
        $student->name = $this->name;
        $student->phone_number = $this->phone_number;
        $student->surname = $this->surname;
        $student->university=$this->university;
        $student->second_name = $this->second_name;
        $student->mail_list_on = $this->mail_list_on;
        $student->user_id = $this->user_id;
        
        //$user->save(false);

        // the following three lines were added:
       // $auth = \Yii::$app->authManager;
       // $authorRole = $auth->getRole('any_role');
       // $auth->assign($authorRole, $user->getId());
    
       $uniq = Student::find()->where(['user_id'=>$student->user_id, 'name'=>$student->name])->one();

       if(!$uniq){
        if($student->save(false)){
            return true;
        }}
        else{return false;}
    }
}