<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "offer".
 *
 * @property int $id
 * @property int $vacancy_id
 * @property int $summary_id
 * @property string $text
 *
 * @property Summury $summary
 * @property Vacancy $vacancy
 */
class Offer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'offer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['vacancy_id', 'summary_id', 'text'], 'required'],
            [['vacancy_id', 'summary_id'], 'integer'],
            [['text'], 'string'],
            [['vacancy_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vacancy::class, 'targetAttribute' => ['vacancy_id' => 'id']],
            [['summary_id'], 'exist', 'skipOnError' => true, 'targetClass' => Summury::class, 'targetAttribute' => ['summary_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'vacancy_id' => 'Vacancy ID',
            'summary_id' => 'Summary ID',
            'text' => 'Text',
        ];
    }

    /**
     * Gets query for [[Summary]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSummary()
    {
        return $this->hasOne(Summury::class, ['id' => 'summary_id']);
    }

    /**
     * Gets query for [[Vacancy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVacancy()
    {
        return $this->hasOne(Vacancy::class, ['id' => 'vacancy_id']);
    }
}
