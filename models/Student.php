<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "student".
 *
 * @property int $id
 * @property string $name
 * @property string $second_name
 * @property string $surname
 * @property string $university
 * @property int $user_id
 * @property int $is_mail_connected
 * @property int $mail_list_on
 * @property string $photo
 * @property int $phone_number
 *
 * @property Summury[] $summuries
 * @property User $user
 */
class Student extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'student';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'second_name', 'surname', 'university', 'user_id', 'is_mail_connected', 'mail_list_on', 'photo', 'phone_number'], 'required'],
            [['user_id', 'is_mail_connected', 'mail_list_on', 'phone_number'], 'integer'],
            [['name', 'second_name', 'surname', 'university', 'photo'], 'string', 'max' => 255],
            [['user_id'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'second_name' => 'Second Name',
            'surname' => 'Surname',
            'university' => 'University',
            'user_id' => 'User ID',
            'is_mail_connected' => 'Is Mail Connected',
            'mail_list_on' => 'Mail List On',
            'photo' => 'Photo',
            'phone_number' => 'Phone Number',
        ];
    }

    /**
     * Gets query for [[Summuries]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSummary()
    {
        return $this->hasMany(Summary::class, ['created_by' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
}
