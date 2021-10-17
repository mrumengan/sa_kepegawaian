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
 * @property string|null $photo_file
 *
 * @property Karyawan $karyawan
 */
class Presensi extends \yii\db\ActiveRecord
{
    public $photo_data;

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
            [['photo_file'], 'string', 'max' => 100],
            [['photo_data'], 'string'],
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

    public function upload()
    {
        if ($this->validate()) {
            $imageData = base64_decode(str_replace('data:image/jpeg;base64,', '', $this->photo_data));
            if (is_file(Yii::getAlias('@frontend/web/media/img/presensi/') . $this->photo_file)) unlink(Yii::getAlias('@frontend/web/media/img/presensi/') . $this->foto);
            $file_name = 'photo_' . Yii::$app->security->generateRandomString(5) . '.jpg';
            $saved_photo_file_name = Yii::getAlias('@frontend/web/media/img/presensi/') . $file_name;
            if (file_put_contents($saved_photo_file_name, $imageData) === false) {
                throw new \yii\base\Exception("Couldn't save image to $file_name");
            }
            $this->photo_data = null;
            $this->photo_file = $file_name;
            return true;
        } else {
            return false;
        }
    }
}
