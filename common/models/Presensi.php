<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%presensi}}".
 *
 * @property int $id
 * @property int $karyawan_id
 * @property float|null $latitude
 * @property float|null $longitude
 * @property string|null $address
 * @property string|null $created_at
 */
class Presensi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%presensi}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['karyawan_id'], 'required'],
            [['karyawan_id'], 'integer'],
            [['latitude', 'longitude'], 'number'],
            [['created_at'], 'safe'],
            [['address'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'karyawan_id' => 'Karyawan ID',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'address' => 'Address',
            'created_at' => 'Created At',
        ];
    }
}
