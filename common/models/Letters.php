<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "{{%letters}}".
 *
 * @property int $id
 * @property string $type
 * @property string|null $ref_nomor_surat
 * @property string|null $ref_asal_surat
 * @property string $ref_tanggal
 * @property string|null $ref_hal
 * @property string $nomor_surat
 * @property string $sifat
 * @property int $lampiran
 * @property string|null $hal
 * @property string $signed_pdf
 * @property int $status
 * @property string|null $created_at
 * @property int|null $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 *
 * @property User $createdBy
 * @property User $updatedBy
 */
class Letters extends \yii\db\ActiveRecord
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

    public $titles = [
        'pangkat' => 'Usulan Kenaikan Pangkat',
        'mutasi' => 'Usulan Mutasi',
        'karsuis' => 'Usulan Kartu Suami / Istri',
    ];

    public $members = '';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%letters}}';
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'value' => new Expression('NOW()'),
            ],
            BlameableBehavior::class
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ref_tanggal'], 'required'],
            [['ref_tanggal', 'signed_pdf', 'created_at', 'updated_at'], 'safe'],
            [['type', 'ref_hal', 'hal'], 'string'],
            [['lampiran', 'status', 'created_by', 'updated_by'], 'integer'],
            [['ref_nomor_surat'], 'string', 'max' => 25],
            [['ref_asal_surat', 'nomor_surat'], 'string', 'max' => 100],
            [['sifat'], 'string', 'max' => 20],
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
            'ref_nomor_surat' => 'Nomor Asal Surat',
            'ref_asal_surat' => 'Asal Surat',
            'ref_tanggal' => 'Tanggal Surat',
            'ref_hal' => 'Hal Asal Surat',
            'nomor_surat' => 'Nomor Surat',
            'sifat' => 'Sifat',
            'lampiran' => 'Lampiran',
            'hal' => 'Hal Surat',
            'signed_pdf' => 'PDF',
            'members' => 'Karyawan',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
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

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployees()
    {
        return $this->hasMany(LetterMember::class, ['letter_id' => 'id']);
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($insert) {
            $this->status = 5;
            $this->ref_tanggal = substr($this->ref_tanggal, 6) . '-' . substr($this->ref_tanggal, 3, 2) . '-'
                . substr($this->ref_tanggal, 0, 2);
        } else {
            if ($this->oldAttributes['ref_tanggal'] != $this->attributes['ref_tanggal']) {
                $this->ref_tanggal = substr($this->ref_tanggal, 6) . '-' . substr($this->ref_tanggal, 3, 2) . '-'
                    . substr($this->ref_tanggal, 0, 2);
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
