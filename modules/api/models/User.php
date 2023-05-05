<?php 
namespace app\modules\api\models;

use app\models\User as ModelsUser;

class User extends ModelsUser
{
    public function fields()
    {
        return['id','mail'];
    }

    public function extraFields()
    {
        return [
            'company',
            'student',
        ];
    }
//Связь один к одному
    public function getCompany(){
       return $this->hasOne(Company::class, ['user_id' => 'id']);
    }
//Связь один к одному

    public function getStudent(){
        return $this->hasOne(Student::class, ['user_id'=>'id']);
    }
}