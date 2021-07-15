<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%departemen}}".
 *
 * @property int $id
 * @property string $nama
 * @property string|null $keterangan
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updatet_at
 * @property int|null $updated_by
 *
 * @property Karyawan[] $karyawans
 */
class Departemen extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%departemen}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama'], 'required'],
            [['keterangan'], 'string'],
            [['created_at', 'created_by', 'updatet_at', 'updated_by'], 'integer'],
            [['nama'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'keterangan' => 'Keterangan',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updatet_at' => 'Updatet At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[Karyawans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKaryawans()
    {
        return $this->hasMany(Karyawan::className(), ['departemen_id' => 'id']);
    }
}
