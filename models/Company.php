<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\app\models\User;
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
class Company extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'number','discription','adress'], 'required'],
            ['name', 'string', 'max' => 16],
            ['number', 'int','min'=> 18, 'max'=> 19],
            ['discription', 'string', 'max' => 1000 ],
            [['password'], 'string', 'min' => 8, 'max' => 32]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'number' => 'Number',
            'discription' => 'Discription',
            'adress' => 'Adress',
            'mail_list_on' => 'Mail List On',
            'is_mail_connect' => 'Is Mail Connect',
            'user_id' => 'User Id', 
            
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
    
    public static function findByNameSurname($name,$surname)
    {
        $user = Company::find()
        ->where(['mail' => $name])
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
    public function setUsername($mail)
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
