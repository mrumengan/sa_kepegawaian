<?php

namespace common\components;

use common\models\Karyawan;
use Yii;

/**
 * Extended yii\web\User
 *
 * This allows us to do "Yii::$app->user->something" by adding getters
 * like "public function getSomething()"
 *
 * So we can use variables and functions directly in `Yii::$app->user`
 */
class User extends \yii\web\User
{
    public function getUsername()
    {
        return \Yii::$app->user->identity->username;
    }

    public function getName()
    {
        return \Yii::$app->user->identity->name;
    }

    public function getAsn()
    {
        $karyawan = Karyawan::findOne(['user_id' => $this->id]);

        return $karyawan->status_asn;
    }

    public function getKaryawanId()
    {
        $karyawan = Karyawan::findOne(['user_id' => $this->id]);

        return $karyawan->id;
    }
}
