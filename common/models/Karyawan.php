<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%karyawan}}".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $departemen_id
 * @property string|null $nip
 * @property string|null $nama
 * @property string|null $tempat_lahir
 * @property string|null $tanggal_lahir
 * @property string|null $golongan
 * @property string|null $tmt_pangkat
 * @property string|null $jabatan
 * @property string|null $tmt_jabatan
 * @property string|null $eselon
 * @property string|null $pangkat_cpns
 * @property string|null $tmt_cpns
 * @property string|null $tmt_pns
 * @property string|null $gaji_pokok
 * @property string|null $tmt_gaji
 * @property string|null $pendidikan
 * @property string|null $pendidikan_umum
 * @property string|null $diklat_struktural
 * @property string|null $diklat_fungsional
 * @property string|null $jenis_kelamin
 * @property string|null $nip_lama
 * @property int|null $peringkat
 * @property string|null $foto
 * @property int|0 $status_asn
 *
 * @property User $user
 * @property Departemen $departemen
 * @property Golongan $golongan
 */
class Karyawan extends \yii\db\ActiveRecord
{

    public $photo_file;

    public $masa_kerja;

    public $statuses = [
        0 => 'Non ASN',
        10 => 'ASN'
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%karyawan}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gaji_pokok', 'user_id', 'departemen_id', 'peringkat', 'status_asn'], 'integer'],
            [['tanggal_lahir', 'tmt_pangkat', 'tmt_jabatan', 'tmt_cpns', 'tmt_pns', 'tmt_gaji', 'foto'], 'safe'],
            [['nip', 'nip_lama'], 'string', 'max' => 21],
            [['nama', 'pendidikan_umum'], 'string', 'max' => 100],
            [['tempat_lahir'], 'string', 'max' => 100],
            [['golongan'], 'string', 'max' => 5],
            [['jabatan'], 'string', 'max' => 500],
            [['eselon'], 'string', 'max' => 6],
            [['pangkat_cpns'], 'string', 'max' => 50],
            [['jenis_kelamin'], 'string', 'max' => 9],
            [['pendidikan'], 'string', 'max' => 100],
            [['diklat_struktural'], 'string', 'max' => 200],
            [['diklat_fungsional'], 'string', 'max' => 200],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['departemen_id'], 'exist', 'skipOnError' => true, 'targetClass' => Departemen::className(), 'targetAttribute' => ['departemen_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'departemen_id' => 'Bagian',
            'nip' => 'NIP',
            'nama' => 'Nama',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'golongan' => 'Pangkat - Golongan Ruang',
            'tmt_pangkat' => 'TMT Pangkat',
            'jabatan' => 'Jabatan',
            'tmt_jabatan' => 'TMT Jabatan',
            'eselon' => 'Eselon',
            'pangkat_cpns' => 'Pangkat CPNS',
            'tmt_cpns' => 'TMT CPNS',
            'tmt_pns' => 'TMT PNS',
            'gaji_pokok' => 'Gaji Pokok',
            'tmt_gaji' => 'TMT KGB',
            'pendidikan' => 'Pendidikan',
            'pendidikan_umum' => 'Pendidikan Umum',
            'diklat_struktural' => 'Diklat Struktural',
            'diklat_fungsional' => 'Diklat Fungsional',
            'jenis_kelamin' => 'Jenis Kelamin',
            'nip_lama' => 'NIP Lama',
            'peringkat' => 'Kelas Jabatan',
            'foto' => 'Foto',
            'status_asn' => 'Status ASN',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * Gets query for [[Departemen]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartemen()
    {
        return $this->hasOne(Departemen::className(), ['id' => 'departemen_id']);
    }

    /**
     * Gets query for [[Golongan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGolRuang()
    {
        return $this->hasOne(Golongan::className(), ['nama_golongan' => 'golongan']);
    }

    /**
     * Gets query for [[Cuti]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCutis()
    {
        return $this->hasMany(Cuti::class, ['karyawan_id' => 'id']);
    }

    /**
     * Gets query for [[KGB]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKgbs()
    {
        return $this->hasMany(Kgb::className(), ['karyawan_id' => 'id']);
    }

    /**
     * Gets query for [[KGB]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInProcessKgb()
    {
        return $this->hasOne(Kgb::className(), ['karyawan_id' => 'id'])->andOnCondition(['status' => 5]);
    }


    /**
     * Gets masa kerja.
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMasaKerja()
    {
        $date_start = date_create($this->tmt_cpns);

        $date_now = date_create(date('d-m-Y', time()));

        $interval = date_diff($date_start, $date_now);

        if ($interval->format('%y') == (int) 0) {
            return $interval->format('%m') . ' bulan';
        } else {
            return $interval->format('%y') . ' tahun';
        }
    }

    /**
     * Gets masa kerja.
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKgbAmount()
    {
        $date_start = date_create($this->tmt_cpns);

        $date_now = date_create(date('d-m-Y', time()));

        $interval = date_diff($date_start, $date_now);

        $kgb_amount = KgbAmount::findOne(['exp_year' => $interval->format('%y')]);
        if ($kgb_amount) {
            return $kgb_amount[str_replace('/', '_', strtolower($this->golongan))];
        } else {
            return $this->gaji_pokok;
        }
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($this->status_asn == 0) {
            if (strpos($this->tanggal_lahir, '/') == 2) {
                $this->tanggal_lahir = substr($this->tanggal_lahir, 6) . '-' . substr($this->tanggal_lahir, 3, 2) . '-'
                    . substr($this->tanggal_lahir, 0, 2);
            }
        } else {
            if ($this->status_asn == 10) {
                if (strpos($this->tanggal_lahir, '/') == 2) {
                    $this->tanggal_lahir = substr($this->tanggal_lahir, 6) . '-' . substr($this->tanggal_lahir, 3, 2) . '-'
                        . substr($this->tanggal_lahir, 0, 2);
                    $this->tmt_pangkat = substr($this->tmt_pangkat, 6) . '-' . substr($this->tmt_pangkat, 3, 2) . '-'
                        . substr($this->tmt_pangkat, 0, 2);
                    $this->tmt_jabatan = substr($this->tmt_jabatan, 6) . '-' . substr($this->tmt_jabatan, 3, 2) . '-'
                        . substr($this->tmt_jabatan, 0, 2);
                    $this->tmt_cpns = substr($this->tmt_cpns, 6) . '-' . substr($this->tmt_cpns, 3, 2) . '-'
                        . substr($this->tmt_cpns, 0, 2);
                    $this->tmt_pns = substr($this->tmt_pns, 6) . '-' . substr($this->tmt_pns, 3, 2) . '-'
                        . substr($this->tmt_pns, 0, 2);
                    $this->tmt_gaji = substr($this->tmt_gaji, 6) . '-' . substr($this->tmt_gaji, 3, 2) . '-'
                        . substr($this->tmt_gaji, 0, 2);
                }
            }
        }

        return true;
    }

    public function upload()
    {
        if ($this->validate()) {
            if (is_file(Yii::getAlias('@frontend/web/media/img/') . $this->foto)) unlink(Yii::getAlias('@frontend/web/media/img/') . $this->foto);
            $saved_photo_file_name = 'photo_' . $this->photo_file->baseName . '_' . $this->id . '.' . $this->photo_file->extension;
            $this->photo_file->saveAs('media/img/' . $saved_photo_file_name);
            $this->foto = $saved_photo_file_name;
            return true;
        } else {
            return false;
        }
    }
}
