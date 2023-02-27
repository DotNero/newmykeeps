<?php

namespace app\models;
use yii\base\Model;

class SignupForm extends Model{
    public $username; 
    public $password;
    public $auth_key;
    public $access_token;
}

public function rules()
{
    return
        [['username','password'], 'required', 'message' => 'Заполните поле'],];   
}

public function attributeLabels()
{
return [
    'username' => 'Логин';
    'password' => 'Пароль';
]
}

?>