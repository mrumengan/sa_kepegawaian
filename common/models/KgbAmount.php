<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%kgb_amount}}".
 *
 * @property int $id
 * @property int $exp_year
 * @property int|null $1a
 * @property int|null $1b
 * @property int|null $1c
 * @property int|null $1d
 * @property int|null $2a
 * @property int|null $2b
 * @property int|null $2c
 * @property int|null $2d
 * @property int|null $3a
 * @property int|null $3b
 * @property int|null $3c
 * @property int|null $3d
 * @property int|null $4a
 * @property int|null $4b
 * @property int|null $4c
 * @property int|null $4d
 * @property int|null $4e
 */
class KgbAmount extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%kgb_amount}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['exp_year'], 'required'],
            [['exp_year', '1a', '1b', '1c', '1d', '2a', '2b', '2c', '2d', '3a', '3b', '3c', '3d', '4a', '4b', '4c', '4d', '4e'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'exp_year' => 'MKG',
            '1a' => '1a',
            '1b' => '1b',
            '1c' => '1c',
            '1d' => '1d',
            '2a' => '2a',
            '2b' => '2b',
            '2c' => '2c',
            '2d' => '2d',
            '3a' => '3a',
            '3b' => '3b',
            '3c' => '3c',
            '3d' => '3d',
            '4a' => '4a',
            '4b' => '4b',
            '4c' => '4c',
            '4d' => '4d',
            '4e' => '4e',
        ];
    }
}
