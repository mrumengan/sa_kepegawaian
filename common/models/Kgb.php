<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "{{%kgb}}".
 *
 * @property int $id
 * @property string|null $code
 * @property int $karyawan_id
 * @property int|null $jumlah
 * @property string|null $description
 * @property string|null $tanggal_kenaikan
 * @property string|null $signed_pdf
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 *
 * @property Karyawan $karyawan
 * @property User $createdBy
 * @property User $updatedBy
 */
class Kgb extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $pdf_file;
    public $statuses = [
        5 => 'Mulai Proses',
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
        return '{{%kgb}}';
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
            [['karyawan_id'], 'required'],
            [['karyawan_id', 'jumlah', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['description'], 'string', 'max' => 100],
            [['code'], 'string', 'max' => 10],
            [['tanggal_kenaikan'], 'safe'],
            [['karyawan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Karyawan::className(), 'targetAttribute' => ['karyawan_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            [['pdf_file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Kode',
            'karyawan_id' => 'ID Karyawan',
            'jumlah' => 'Jumlah',
            'description' => 'Description',
            'tanggal_kenaikan' => 'TMT',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
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

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    public function getTanggalKenaikan()
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

        $dates = explode('-', $this->tanggal_kenaikan);

        return $dates[2] . ' ' . $month[(int) $dates[1]] . ' ' . $dates[0];
    }

    public function getTanggalBuat()
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

        $dates = explode('-', date('Y-m-d'));

        return $dates[2] . ' ' . $month[(int) $dates[1]] . ' ' . $dates[0];
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($insert) {
            $this->status = 5; // diajukan
        }
        if (strpos($this->tanggal_kenaikan, '/') == 2) {
            $this->tanggal_kenaikan = substr($this->tanggal_kenaikan, 6) . '-' . substr($this->tanggal_kenaikan, 3, 2) . '-'
                . substr($this->tanggal_kenaikan, 0, 2);
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
