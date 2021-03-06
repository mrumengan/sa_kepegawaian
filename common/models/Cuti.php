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
 * @property string $description
 * @property int $jumlah
 * @property string $alamat_cuti
 * @property string $telepon_cuti
 * @property int $status
 * @property string $signed_pdf
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $updated_by
 *
 * @property Karyawan $karyawan
 */
class Cuti extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $pdf_file;
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
            [['tanggal_cuti', 'signed_pdf', 'description', 'alamat_cuti', 'telepon_cuti'], 'safe'],
            [['karyawan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Karyawan::className(), 'targetAttribute' => ['karyawan_id' => 'id']],
            [['pdf_file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'No. Surat',
            'tipe_id' => 'Jenis Cuti',
            'karyawan_id' => 'ID Karyawan',
            'tanggal_cuti' => 'Tanggal Cuti',
            'description' => 'Alasan Cuti',
            'signed_pdf' => 'PDF',
            'jumlah' => 'Jumlah Hari',
            'alamat_cuti' => 'Alamat Cuti',
            'telepon_cuti' => 'Telepon Selama Cuti'
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

        return $dates[2] . ' ' . $month[(int) $dates[1]] . ' ' . $dates[0];
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($insert) {
            $this->status = 5; // diajukan
            if (strpos($this->tanggal_cuti, '/') == 2) {
                $this->tanggal_cuti = substr($this->tanggal_cuti, 6) . '-' . substr($this->tanggal_cuti, 3, 2) . '-'
                    . substr($this->tanggal_cuti, 0, 2);
            }
        }

        return true;
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->pdf_file->saveAs('media/pdf/' . $this->pdf_file->baseName . '.' . $this->pdf_file->extension);
            $this->signed_pdf = $this->pdf_file->name;
            return true;
        } else {
            return false;
        }
    }
}
