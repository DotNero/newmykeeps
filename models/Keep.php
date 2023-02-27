<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "keep".
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $body
 * @property string|null $date
 * @property int $created_at
 * @property int|null $created_by
 * @property int $updated_at
 * @property int|null $updated_by
 *
 * @property User $createdAt
 */
class Keep extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'keep';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'slug', 'body', 'created_at', 'updated_at'], 'required'],
            [['body'], 'string'],
            [['date'], 'safe'],
            [['created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['title', 'slug'], 'string', 'max' => 1024],
            [['created_at'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_at' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'slug' => 'Slug',
            'body' => 'Body',
            'date' => 'Date',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[CreatedAt]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedAt()
    {
        return $this->hasOne(User::class, ['id' => 'created_at']);
    }
}
