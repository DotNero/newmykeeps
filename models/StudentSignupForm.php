<?php
namespace app\models;

use app\models\User;
use app\models\Company;
use Yii;
use yii\db\ActiveRecord;
use yii\base\Model;
use yii\helpers\VarDumper;

class SignupForm extends Model{
    public $username; 
    public $password;


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
    ];
}
public function signup() 
{       $student = new Student;
        $student->name = $this->name;
        $student->number = $this->number;
        $student->surname = $this->surname;
        $student->second_name = $this->second_name;
        $student->mail_list_on = $this->mail_list_on;
        $student->user_id = Yii::$app->user->id;
        //$user->save(false);

        // the following three lines were added:
       // $auth = \Yii::$app->authManager;
       // $authorRole = $auth->getRole('any_role');
       // $auth->assign($authorRole, $user->getId());
    
       $uniq = Student::find()->where(['name'=>$student->name, 'surname'=>$student->surname, 'second_name'=>$student->second_name, 'phone_number'=>$student->phone_number]);

       if($uniq){
        if($student->save(false)){
            return true;
        }}
        else{return false;}
    }
}