<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%lembur}}".
 *
 * @property int $id
 * @property int $karyawan_id
 * @property string $tanggal_lembur
 * @property int $jumlah
 *
 * @property Karyawan $karyawan
 */
class Lembur extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%lembur}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['karyawan_id', 'tanggal_lembur', 'jumlah'], 'required'],
            [['karyawan_id', 'jumlah'], 'integer'],
            [['tanggal_lembur'], 'safe'],
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
            'tanggal_lembur' => 'Tanggal Lembur',
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
