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
 *
 * @property User $user
 * @property Departemen $departemen
 */
class Karyawan extends \yii\db\ActiveRecord
{
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
            [['user_id', 'departemen_id', 'peringkat'], 'integer'],
            [['tanggal_lahir', 'tmt_pangkat', 'tmt_jabatan', 'tmt_cpns', 'tmt_pns', 'tmt_gaji'], 'safe'],
            [['nip', 'nip_lama'], 'string', 'max' => 21],
            [['nama', 'pendidikan_umum'], 'string', 'max' => 43],
            [['tempat_lahir'], 'string', 'max' => 22],
            [['golongan'], 'string', 'max' => 5],
            [['jabatan'], 'string', 'max' => 214],
            [['eselon'], 'string', 'max' => 6],
            [['pangkat_cpns'], 'string', 'max' => 20],
            [['gaji_pokok', 'jenis_kelamin'], 'string', 'max' => 9],
            [['pendidikan'], 'string', 'max' => 16],
            [['diklat_struktural'], 'string', 'max' => 17],
            [['diklat_fungsional'], 'string', 'max' => 26],
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
            'departemen_id' => 'Departemen ID',
            'nip' => 'Nip',
            'nama' => 'Nama',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'golongan' => 'Golongan',
            'tmt_pangkat' => 'Tmt Pangkat',
            'jabatan' => 'Jabatan',
            'tmt_jabatan' => 'Tmt Jabatan',
            'eselon' => 'Eselon',
            'pangkat_cpns' => 'Pangkat Cpns',
            'tmt_cpns' => 'Tmt Cpns',
            'tmt_pns' => 'Tmt Pns',
            'gaji_pokok' => 'Gaji Pokok',
            'tmt_gaji' => 'Tmt Gaji',
            'pendidikan' => 'Pendidikan',
            'pendidikan_umum' => 'Pendidikan Umum',
            'diklat_struktural' => 'Diklat Struktural',
            'diklat_fungsional' => 'Diklat Fungsional',
            'jenis_kelamin' => 'Jenis Kelamin',
            'nip_lama' => 'Nip Lama',
            'peringkat' => 'Peringkat',
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
     * Gets query for [[Cuti]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCutis()
    {
        return $this->hasMany(Cuti::class, ['karyawan_id' => 'id']);
    }

    /**
     * Gets masa kerja.
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMasaKerja()
    {
        $date_start = date_create($this->tmt_pns);
        $date_now = date_create(date('d-m-Y', time()));

        $interval = date_diff($date_start, $date_now);

        return $interval->format('%y');
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        $this->tanggal_lahir = substr($this->tanggal_lahir, 6) . '-' . substr($this->tanggal_lahir, 3, 2) . '-'
            . substr($this->tanggal_lahir, 0, 2);

        return true;
    }
}
