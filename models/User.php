<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\base\NotSupportedException;
use yii\web\identityInterface;
use yii\helpers\ArrayHelper;
use Yii;


/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $mail
 * @property string $password
 * @property string $auth_key
 * @property string $access_token
 * @property string $password_reset_token
 * @property string $mail_confirm_token
 * @property integer $status
 * @property string $role
 * 
 *
 * 
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{   
    const STATUS_BLOCKED = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_WAIT = 2;
    /**
     * {@inheritdoc}
     */

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['mail','required'], 
            ['mail', 'unique', 'targetClass' => self::class, 'message' => 'This username has already been taken.'],
            ['mail', 'string', 'max'=>55],
            ['status', 'integer'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => array_keys(self::getStatusesArray())],
            [['password'], 'string', 'min' => 8, 'max' => 32],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status'=>'Status',
            'mail' => 'Mail',
            'role' => 'Role'
        ];
    }

    /**
     * {@inheritdoc}
     */

     public function getStatusName()
     {   
         return(ArrayHelper::getValue(self::getStatusesArray(), $this->status));
     }
     public static function tableName()
     {
         return 'user';
     }
 
     public static function getStatusesArray()
     {
         return [
             self::STATUS_BLOCKED => 'Заблокирован',
             self::STATUS_ACTIVE => 'Активен',
             self::STATUS_WAIT => 'Ожидает подтверждения',
         ];
     }
    public static function findIdentity($id)
    {
        return static::findOne(['id'=>$id,'status'=>self::STATUS_ACTIVE]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::find()
            ->joinWith('tokens t')
            ->andWhere(['t.token' => $token])
            ->andWhere(['>', 't.expired_at', time()])
            ->one();
    }

    public function validatePassword($password)
    {
        return \Yii::$app->security->validatePassword($password, $this->password);
    }

    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }
        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        return $timestamp + $expire >= time();
    }

    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public static function findByEmailConfirmToken($mail_confirm_token)
    {
        return static::findOne(['mail_confirm_token' => $mail_confirm_token, 'status' => self::STATUS_WAIT]);
    }

    public function generateEmailConfirmToken()
    {
        $this->mail_confirm_token = Yii::$app->security->generateRandomString();
    }

    public function removeEmailConfirmToken()
    {
        $this->mail_confirm_token = null;
    }

    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
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

    public function getStudent(){
        return $this->hasOne(Student::class,['user_id'=>'id']);
    }
    public function getCompany(){
        return $this->hasOne(Company::class,['user_id'=>'id']);
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
