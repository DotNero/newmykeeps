<?php
namespace app\models;

use app\models\User;
use Yii;
use yii\db\ActiveRecord;
use yii\base\Model;
use yii\helpers\VarDumper;

class SignupForm extends Model{
    public $id;
    public $password;
    public $role_routing;
    public $mail;


public function rules()
{
    return [
        [['mail', 'password'], 'required'],
        ['mail', 'string', 'min' => 4, 'max' => 16],    
        ['mail', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Mail is already taken'],
        [['password'], 'string', 'min' => 8, 'max' => 32]
    ];
}
public function signup() 
{
        $user = new User();
        $user->mail = $this->mail;
        $user->auth_key = \Yii::$app->security->generateRandomString();
        $user->password = \Yii::$app->security->generatePasswordHash($this->password);
        $user->access_token = \Yii::$app->security->generateRandomString();
        $role_routing = $this->role_routing;
        //$user->save(false);

        // the following three lines were added:
       // $auth = \Yii::$app->authManager;
       // $authorRole = $auth->getRole('any_role');
       // $auth->assign($authorRole, $user->getId());
       $uniq = $user::find()->where(['mail' => $user->mail]);
       if(!$uniq){
            if ($user->save(false)){
                return true;}
            else{
                \Yii::error("User was not saved: ".VarDumper::dumpAsString($user->errors));
                return false;}}
        else{
            \Yii::error("Username is already used: ".VarDumper::dumpAsString($user->errors));
            return false;
    }}
}
