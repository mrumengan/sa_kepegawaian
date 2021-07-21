<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%cuti}}".
 *
 * @property int $id
 * @property int $tipe_id
 * @property int $karyawan_id
 * @property string $tanggal_cuti
 * @property int $jumlah
 * @property int $status
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $updated_by
 *
 * @property Karyawan $karyawan
 */
class Cuti extends \yii\db\ActiveRecord
{
    public $statuses = [
        5 => 'Diajukan',
        10 => 'Disetujui',
        0 => 'Ditolak'
    ];

    public $badges = [
        5 => 'badge-secondary',
        10 => 'badge-success',
        0 => 'badge-warning'
    ];

    public $code_width = 4;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%cuti}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            BlameableBehavior::class
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipe_id', 'karyawan_id', 'tanggal_cuti', 'jumlah'], 'required'],
            [['tipe_id', 'karyawan_id', 'jumlah', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
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
            'id' => 'No. Surat',
            'tipe_id' => 'ID Tipe',
            'karyawan_id' => 'ID Karyawan',
            'tanggal_cuti' => 'Tanggal Cuti',
            'jumlah' => 'Jumlah Hari',
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

    /**
     * Gets query for [[CutiTipe]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCutiTipe()
    {
        return $this->hasOne(CutiTipe::class, ['id' => 'tipe_id']);
    }

    public function getTanggalCuti()
    {
        $month = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );

        $dates = explode('-', $this->tanggal_cuti);

        // variabel pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun

        return $dates[2] . ' ' . $month[(int) $dates[1]] . ' ' . $dates[0];
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($insert) $this->status = 5; // diajukan

        $this->tanggal_cuti = substr($this->tanggal_cuti, 6) . '-' . substr($this->tanggal_cuti, 3, 2) . '-'
            . substr($this->tanggal_cuti, 0, 2);

        return true;
    }
}
