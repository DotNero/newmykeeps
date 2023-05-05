<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\identityInterface;
use Yii;


/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $mail
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
            ['mail','required'], 
            [['password'], 'string', 'min' => 8, 'max' => 32],
        ];
    }

    public function attributeLabels()
    {
        return [
            
            'password' => 'Password',
            'access_token' => 'Access Token',
            'mail' => 'Mail',
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
    
    public static function findByUsername($mail)
    {
        $user = User::find()
        ->where(['mail' => $mail])
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
    public function setMail($mail)
    {$this->mail = $mail;
    }
    
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


     //public function getSummary()
    //  {return $this->hasMany(Summary::class, ['created_at' => 'id']);
    // }
}
