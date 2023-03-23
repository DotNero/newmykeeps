<?php
namespace app\models;
<<<<<<< HEAD

use yii\base\Model;
use yii\helpers\VarDumper;
use app\models\User;
use Yii;
use yii\db\ActiveRecord;

=======
>>>>>>> 3cf1a60fb592c0a2e9ab73f08462cae40827291a

use yii\base\Model;
use yii\helpers\VarDumper;

class SignupForm extends Model implements User{
    public $username; 
    public $password;
<<<<<<< HEAD
=======
    public $password_repeat;
>>>>>>> 3cf1a60fb592c0a2e9ab73f08462cae40827291a


public function rules()
{
    return [
<<<<<<< HEAD
        [['username', 'password'], 'required'],
        ['username', 'string', 'min' => 4, 'max' => 16],    
        ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'this username already taken'],
        [['password'], 'string', 'min' => 8, 'max' => 32]
    ];
}
public function signup() 
=======
        [['username', 'password', 'password_repeat'], 'required'],
        ['username', 'string', 'min' => 4, 'max' => 16],
        [['password', 'password_repeat'], 'string', 'min' => 8, 'max' => 32],
        [['password_repeat'], 'compare', 'compareAttribute' => 'password']
    ];
}
public function signup()
>>>>>>> 3cf1a60fb592c0a2e9ab73f08462cae40827291a
{
        $user = new User();
        $user->username = $this->username;
        $user->auth_key = \Yii::$app->security->generateRandomString();
        $user->password = \Yii::$app->security->generatePasswordHash($this->password);
        $user->access_token = \Yii::$app->security->generateRandomString();
        //$user->save(false);
<<<<<<< HEAD

        // the following three lines were added:
       // $auth = \Yii::$app->authManager;
       // $authorRole = $auth->getRole('any_role');
       // $auth->assign($authorRole, $user->getId());
       if ($user->save(false)){
        return true;}
       \Yii::error("User was not saved: ".VarDumper::dumpAsString($user->errors));
        return false;
    }}

=======

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
>>>>>>> 3cf1a60fb592c0a2e9ab73f08462cae40827291a
