<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tag_object".
 *
 * @property int $id
 * @property string $tag
 *
 * @property SummaryTag[] $summaryTags
 * @property VacancyTag[] $vacancyTags
 */
class TagObject extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tag_object';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tag'], 'required'],
            [['tag'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tag' => 'Tag',
        ];
    }

    /**
     * Gets query for [[SummaryTags]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSummaryTags()
    {
        return $this->hasMany(SummaryTag::class, ['tag_id' => 'id']);
    }

    /**
     * Gets query for [[VacancyTags]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVacancyTags()
    {
        return $this->hasMany(VacancyTag::class, ['tag_id' => 'id']);
    }
}
