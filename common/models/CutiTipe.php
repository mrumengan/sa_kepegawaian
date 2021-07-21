<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%cuti_tipe}}".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int|null $back_date
 *
 * @property Cuti[] $cutis
 */
class CutiTipe extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%cuti_tipe}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['back_date'], 'integer'],
            [['name'], 'string', 'max' => 100],
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
            'description' => 'Description',
            'back_date' => 'Back Date',
        ];
    }

    /**
     * Gets query for [[Cutis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCutis()
    {
        return $this->hasMany(Cuti::className(), ['tipe_id' => 'id']);
    }
}
