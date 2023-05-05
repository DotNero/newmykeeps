<?php
namespace app\models;

use app\models\User;
use app\models\Company;
use Yii;
use yii\db\ActiveRecord;
use yii\base\Model;
use yii\helpers\VarDumper;

class SignupForm extends Model{
    public $password;
    public $access_token;
    public $name;
    public $number;
    public $descripton;
    public $adress;


public function rules()
{
    return [
        [['mail','name', 'password','number'], 'required'],
        ['name', 'string', 'min' => 4, 'max' => 16],  
        ['mail','unique', 'targetClass'=> '\app\models\User', 'message' => 'this mail is already registered'],  
        ['name', 'unique', 'targetClass' => '\app\models\Company', 'message' => 'this username already taken'],
        [['password'], 'string', 'min' => 8, 'max' => 32]
    ];
}
public function signup() 
{      
        $company = new Company();
        $company->name = $this->name;
        $company->number = $this->number;
        $company->discription = $this->discription;
        $company->mail_list_on = $this->mail_list_on;
        $company->user_id = Yii::$app->user->id;
        
       $uniq = Company::find()->where(['name' => $company->name, 'number'=>$company->number]);
       if(!$uniq){
                if ($company->save(false)){
                    return true;
                }}
            else{
                \Yii::error("User was not saved: ".VarDumper::dumpAsString($company->errors));
                return false;}
    }}

