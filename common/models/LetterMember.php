<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%letter_member}}".
 *
 * @property int $id
 * @property int $letter_id
 * @property int $karyawan_id
 * @property string|null $meta
 *
 * @property Letters $letter
 * @property Karyawan $karyawan
 */
class LetterMember extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%letter_member}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['letter_id', 'karyawan_id'], 'required'],
            [['letter_id', 'karyawan_id'], 'integer'],
            [['meta'], 'string', 'max' => 100],
            [['letter_id'], 'exist', 'skipOnError' => true, 'targetClass' => Letters::className(), 'targetAttribute' => ['letter_id' => 'id']],
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
            'letter_id' => 'Letter ID',
            'karyawan_id' => 'Karyawan ID',
            'meta' => 'Meta',
        ];
    }

    /**
     * Gets query for [[Letter]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLetter()
    {
        return $this->hasOne(Letters::className(), ['id' => 'letter_id']);
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
