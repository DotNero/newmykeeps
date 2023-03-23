<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\identityInterface;
use Yii;


/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $auth_key
 * @property string $access_token
 * 
 *
 * @property Keep[] $keeps
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
<<<<<<< HEAD
            [['username', 'password'], 'required'],
            ['username', 'string', 'min' => 4, 'max' => 16],
            [['password'], 'string', 'min' => 8, 'max' => 32]
=======
            [['username', 'password', 'password_repeat'], 'required'],
            ['username', 'string', 'min' => 4, 'max' => 16],
            [['password', 'password_repeat'], 'string', 'min' => 8, 'max' => 32],
            [['password_repeat'], 'compare', 'compareAttribute' => 'password']
>>>>>>> 3cf1a60fb592c0a2e9ab73f08462cae40827291a
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'auth_key' => 'Auth Key',
            'access_token' => 'Access Token',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public function validatePassword($password)
    {
        return \Yii::$app->security->validatePassword($password, $this->password);
    }


    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }
    
    public static function findByUsername($username)
    {
        $user = User::find()
<<<<<<< HEAD
        ->where(['username' => $username])
=======
        ->where(['usr_id' => $username])
>>>>>>> 3cf1a60fb592c0a2e9ab73f08462cae40827291a
    ->one();
    
        return $user;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function generateAuthKey()
    {
        $this -> auth_key = Yii::$app->getSecurity()->generateAuthKey();
    }

    public function setPassword($password)
    {$this->password = Yii::$app -> sequrity -> generatePasswordHash($password);
    }
<<<<<<< HEAD
    public function setUsername($username)
    {$this->username = $username;
    }
=======

>>>>>>> 3cf1a60fb592c0a2e9ab73f08462cae40827291a
    
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert)){
            if($this->isNewRecord){
                $this -> auth_key = \Yii::$app->security->generateRandomString();
            }return true;
        }return false;
    }

    /**
     * Gets query for [[Keeps]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKeeps()
    {
        return $this->hasMany(Keep::class, ['created_at' => 'id']);
    }
}
