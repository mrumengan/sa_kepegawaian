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
    public $titles = [
        'pangkat' => 'Usulan Kenaikan Pangkat',
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
            [['ref_tanggal', 'created_at', 'updated_at'], 'safe'],
            [['type', 'ref_hal', 'hal'], 'string'],
            [['lampiran', 'created_by', 'updated_by'], 'integer'],
            [['ref_nomor_surat'], 'string', 'max' => 25],
            [['ref_asal_surat', 'nomor_surat'], 'string', 'max' => 100],
            [['sifat'], 'string', 'max' => 20],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ref_nomor_surat' => 'Nomor Surat',
            'ref_asal_surat' => 'Asal Surat',
            'ref_tanggal' => 'Tanggal Surat',
            'ref_hal' => 'Hal',
            'nomor_surat' => 'Nomor Surat',
            'sifat' => 'Sifat',
            'lampiran' => 'Lampiran',
            'hal' => 'Hal',
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

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        return true;
    }
}
