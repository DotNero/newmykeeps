<?php

namespace app\models;


use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%post}}".
 *
 * 
 * @property integer $user_id
 * @property integer $expired_at
 * @property string $token
 */
class Token extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%token}}';
    }

    public function getUser()
    {
        $user = User::findOne(['id'=>$this->user_id]);
        return($user);
    }

}