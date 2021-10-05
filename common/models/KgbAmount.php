<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%kgb_amount}}".
 *
 * @property int $id
 * @property int $exp_year
 * @property int|null $i_a
 * @property int|null $i_b
 * @property int|null $i_c
 * @property int|null $i_d
 * @property int|null $ii_a
 * @property int|null $ii_b
 * @property int|null $ii_c
 * @property int|null $ii_d
 * @property int|null $iii_a
 * @property int|null $iii_b
 * @property int|null $iii_c
 * @property int|null $iii_d
 * @property int|null $iv_a
 * @property int|null $iv_b
 * @property int|null $iv_c
 * @property int|null $iv_d
 * @property int|null $iv_e
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
            [['exp_year', 'i_a', 'i_b', 'i_c', 'i_d', 'ii_a', 'ii_b', 'ii_c', 'ii_d', 'iii_a', 'iii_b', 'iii_c', 'iii_d', 'iv_a', 'iv_b', 'iv_c', 'iv_d', 'iv_e'], 'integer'],
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
            'i_a' => 'I/a',
            'i_b' => 'I/b',
            'i_c' => 'I/c',
            'i_d' => 'I/d',
            'ii_a' => 'II/a',
            'ii_b' => 'II/b',
            'ii_c' => 'II/c',
            'ii_d' => 'II/d',
            'iii_a' => 'III/a',
            'iii_b' => 'III/b',
            'iii_c' => 'III/c',
            'iii_d' => 'III/d',
            'iv_a' => 'IV/a',
            'iv_b' => 'IV/b',
            'iv_c' => 'IV/c',
            'iv_d' => 'IV/d',
            'iv_e' => 'IV/e',
        ];
    }
}
