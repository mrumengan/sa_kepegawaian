<?php

namespace common\models;

use Yii;
use yii\db\Expression;

/**
 * This is the model class for table "{{%presensi}}".
 *
 * @property int $id
 * @property int $karyawan_id
 * @property float|null $latitude
 * @property float|null $longitude
 * @property string|null $address
 * @property string|null $work_from
 * @property string|null $created_at
 *
 * @property Karyawan $karyawan
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
            [['created_at', 'work_from'], 'safe'],
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
            'address' => 'Alamat',
            'work_from' => 'Lokasi Kerja',
            'created_at' => 'Tgl & Jam',
        ];
    }

    /**
     * Gets query for [[Karyawan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKaryawan()
    {
        return $this->hasOne(Karyawan::class, ['id' => 'karyawan_id']);
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($insert) {
            $this->created_at = new Expression('NOW()'); // diajukan
        }

        return true;
    }
}
