<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%cuti}}".
 *
 * @property int $id
 * @property int $karyawan_id
 * @property string $tanggal_cuti
 * @property int $jumlah
 *
 * @property Karyawan $karyawan
 */
class Cuti extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%cuti}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['karyawan_id', 'tanggal_cuti', 'jumlah'], 'required'],
            [['karyawan_id', 'jumlah'], 'integer'],
            [['tanggal_cuti'], 'safe'],
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
            'karyawan_id' => 'Karyawan ID',
            'tanggal_cuti' => 'Tanggal Cuti',
            'jumlah' => 'Jumlah',
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
