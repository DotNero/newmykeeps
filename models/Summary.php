<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "summury".
 *
 * @property int $id
 * @property int $student_id
 * @property string $title
 * @property string $summary
 * @property string $tags
 * @property string $created_at
 * @property string|null $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 * @property Student $createdBy
 */
class Summary extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'summury';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['student_id', 'title', 'summary', 'tags', 'created_by', 'updated_by'], 'required'],
            [['student_id', 'created_by', 'updated_by'], 'integer'],    
            [['title', 'summary', 'tags'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => Student::class, 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'student_id' => 'Student ID',
            'title' => 'Title',
            'summary' => 'Summary',
            'tags' => 'Tags',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(Student::class, ['id' => 'created_by']);
    }
}
