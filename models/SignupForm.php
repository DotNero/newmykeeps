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
    public $verifyCode;
    public $mail_comfirm_token;
    public $role;

public function rules()
{
    return [
        ['mail', 'filter', 'filter' => 'trim'],
        ['mail', 'unique', 'targetClass' => User::class, 'message' => 'This email address has already been taken.'],
        [['mail', 'password'], 'required'],
        ['mail', 'string', 'min' => 4, 'max' => 55],
        
        [['password'], 'string', 'min' => 8, 'max' => 32],

    ];
}
public function signup() 
{
    if($this->validate()){
        $user = new User();
        $user->mail = $this->mail;
        $user->auth_key = \Yii::$app->security->generateRandomString();
        $user->password = \Yii::$app->security->generatePasswordHash($this->password);
        $user->status = User::STATUS_WAIT;
        $user->generateEmailConfirmToken();
        $user->access_token = \Yii::$app->security->generateRandomString();
        $user->role = "au";

        //$user->save(false);

        // the following three lines were added:
       // $auth = \Yii::$app->authManager;
       // $authorRole = $auth->getRole('any_role');
       // $auth->assign($authorRole, $user->getId());
    
       
       if ($user->save(false)) {
        Yii::$app->mailer->compose('@app/mail/layouts/emailConfirm', ['user' => $user])
            ->setTo($this->mail)
            ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->name])
            //->setReplyTo([$this->mail => $this->name])
            ->setSubject('New message')
            ->send();
        return true;
        return false;
    }


}
}
}
