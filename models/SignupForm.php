<?php
namespace app\models;

use yii\base\Model;
use yii\helpers\VarDumper;
use app\models\User;
use Yii;
use yii\db\ActiveRecord;


class SignupForm extends Model{
    public $username; 
    public $password;


public function rules()
{
    return [
        [['username', 'password'], 'required'],
        ['username', 'string', 'min' => 4, 'max' => 16],    
        ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'this username already taken'],
        [['password'], 'string', 'min' => 8, 'max' => 32]
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
       if ($user->save(false)){
        return true;}
       \Yii::error("User was not saved: ".VarDumper::dumpAsString($user->errors));
        return false;
    }}

