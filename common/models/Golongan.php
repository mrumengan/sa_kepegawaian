<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%golongan}}".
 *
 * @property int $id
 * @property string $nama_golongan
 * @property int $gaji_pokok
 * @property int $tunjangan_istri
 * @property int $tunjangan_anak
 * @property int $tunjangan_transport
 * @property int $tunjangan_makan
 *
 * @property Karyawan[] $karyawans
 */
class Golongan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%golongan}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_golongan', 'gaji_pokok', 'tunjangan_istri', 'tunjangan_anak', 'tunjangan_transport', 'tunjangan_makan'], 'required'],
            [['gaji_pokok', 'tunjangan_istri', 'tunjangan_anak', 'tunjangan_transport', 'tunjangan_makan'], 'integer'],
            [['nama_golongan'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_golongan' => 'Nama Golongan',
            'gaji_pokok' => 'Gaji Pokok',
            'tunjangan_istri' => 'Tunjangan Istri',
            'tunjangan_anak' => 'Tunjangan Anak',
            'tunjangan_transport' => 'Tunjangan Transport',
            'tunjangan_makan' => 'Tunjangan Makan',
        ];
    }

    /**
     * Gets query for [[Karyawans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKaryawans()
    {
        return $this->hasMany(Karyawan::className(), ['golongan_id' => 'id']);
    }
}
