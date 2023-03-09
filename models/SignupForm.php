<?php
namespace app\models;

use yii\base\Model;
use yii\helpers\VarDumper;

class SignupForm extends Model implements User{
    public $username; 
    public $password;
    public $password_repeat;


public function rules()
{
    return [
        [['username', 'password', 'password_repeat'], 'required'],
        ['username', 'string', 'min' => 4, 'max' => 16],
        [['password', 'password_repeat'], 'string', 'min' => 8, 'max' => 32],
        [['password_repeat'], 'compare', 'compareAttribute' => 'password']
    ];
}
public function signup()
{
        $user = new User();
        $user->username = $this->username;
        $user->auth_key = \Yii::$app->security->generateRandomString();
        $user->password = \Yii::$app->security->generatePasswordHash($this->password);
        $user->access_token = \Yii::$app->security->generateRandomString();
        //$user->save(false);

        // the following three lines were added:
       // $auth = \Yii::$app->authManager;
       // $authorRole = $auth->getRole('any_role');
       // $auth->assign($authorRole, $user->getId());

    if ($user -> save()){
        return true;
    }
    \Yii::error("User was not saved: ".VarDumper::dumpAsString($user->errors));
    return false;
}
}