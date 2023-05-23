<?php
namespace app\models;

use app\models\User;
use app\models\Company;
use Yii;
use yii\db\ActiveRecord;
use yii\base\Model;
use yii\helpers\VarDumper;

class CompanySignupForm extends Model{
    public $name;
    public $number;
    public $discription;
    public $adress;
    public $user_id;
    public $avatar;


public function rules()
{
    return [
        [['name', 'required'],
        ['name', 'string', 'min' => 4, 'max' => 16],  
        ['name', 'unique', 'targetClass' => '\app\models\Company', 'message' => 'Company with equal name is alreade registered'],  
        ['description', 'string'],
        ['number', 'int' , 'min'=>11, 'max'=>16],
        ['number', 'match', 'pattern'=> '^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$'],
    ]];
}
public function signup() 
{      
        $company = new Company();
        $company->name = $this->name;
        $company->number = $this->number;
        $company->adress = $this->adress;
        $company->avatar = $this->avatar;
        $company->discription = $this->discription;
        $company->user_id = $this->user_id;
        
        $uniq = Company::find()->where(['user_id'=>$company->user_id, 'name'=>$company->name])->one();
    if(!$uniq){
    if ($company->save(false)){
        return true;
          
    }
    return false;}
    return false;
}
}