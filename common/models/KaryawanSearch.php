<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Karyawan;

/**
 * KaryawanSearch represents the model behind the search form of `common\models\Karyawan`.
 */
class KaryawanSearch extends Karyawan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'departemen_id', 'peringkat'], 'integer'],
            [['nip', 'nama', 'tempat_lahir', 'tanggal_lahir', 'golongan', 'tmt_pangkat', 'jabatan', 'tmt_jabatan', 'eselon', 'pangkat_cpns', 'tmt_cpns', 'tmt_pns', 'gaji_pokok', 'tmt_gaji', 'pendidikan', 'pendidikan_umum', 'diklat_struktural', 'diklat_fungsional', 'jenis_kelamin', 'nip_lama'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Karyawan::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'departemen_id' => $this->departemen_id,
            'tanggal_lahir' => $this->tanggal_lahir,
            'tmt_pangkat' => $this->tmt_pangkat,
            'tmt_jabatan' => $this->tmt_jabatan,
            'tmt_cpns' => $this->tmt_cpns,
            'tmt_pns' => $this->tmt_pns,
            'tmt_gaji' => $this->tmt_gaji,
            'peringkat' => $this->peringkat,
            'status_asn' => $this->status_asn,
        ]);

        $query->andFilterWhere(['like', 'nip', $this->nip])
            ->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'tempat_lahir', $this->tempat_lahir])
            ->andFilterWhere(['like', 'golongan', $this->golongan])
            ->andFilterWhere(['like', 'jabatan', $this->jabatan])
            ->andFilterWhere(['like', 'eselon', $this->eselon])
            ->andFilterWhere(['like', 'pangkat_cpns', $this->pangkat_cpns])
            ->andFilterWhere(['like', 'gaji_pokok', $this->gaji_pokok])
            ->andFilterWhere(['like', 'pendidikan', $this->pendidikan])
            ->andFilterWhere(['like', 'pendidikan_umum', $this->pendidikan_umum])
            ->andFilterWhere(['like', 'diklat_struktural', $this->diklat_struktural])
            ->andFilterWhere(['like', 'diklat_fungsional', $this->diklat_fungsional])
            ->andFilterWhere(['like', 'jenis_kelamin', $this->jenis_kelamin])
            ->andFilterWhere(['like', 'nip_lama', $this->nip_lama]);

        return $dataProvider;
    }
}
