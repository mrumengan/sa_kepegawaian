<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%penggajian}}".
 *
 * @property int $id
 * @property string $tanggal
 * @property string $keterangan
 * @property int $karyawan_id
 * @property int $jumlah_gaji
 * @property int $jumlah_lembur
 * @property int $potongan
 * @property int $total_gaji_diterima
 *
 * @property Karyawan $karyawan
 */
class Penggajian extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%penggajian}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tanggal', 'keterangan', 'karyawan_id', 'jumlah_gaji', 'jumlah_lembur', 'potongan', 'total_gaji_diterima'], 'required'],
            [['tanggal'], 'safe'],
            [['keterangan'], 'string'],
            [['karyawan_id', 'jumlah_gaji', 'jumlah_lembur', 'potongan', 'total_gaji_diterima'], 'integer'],
            [['karyawan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Karyawan::className(), 'targetAttribute' => ['karyawan_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tanggal' => 'Tanggal',
            'keterangan' => 'Keterangan',
            'karyawan_id' => 'Karyawan ID',
            'jumlah_gaji' => 'Jumlah Gaji',
            'jumlah_lembur' => 'Jumlah Lembur',
            'potongan' => 'Potongan',
            'total_gaji_diterima' => 'Total Gaji Diterima',
        ];
    }

    /**
     * Gets query for [[Karyawan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKaryawan()
    {
        return $this->hasOne(Karyawan::className(), ['id' => 'karyawan_id']);
    }
}
