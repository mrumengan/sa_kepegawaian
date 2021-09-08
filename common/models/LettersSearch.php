<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Letters;

/**
 * LettersSearch represents the model behind the search form of `common\models\Letters`.
 */
class LettersSearch extends Letters
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'lampiran', 'created_by', 'updated_by'], 'integer'],
            [['type', 'ref_nomor_surat', 'ref_asal_surat', 'ref_tanggal', 'ref_hal', 'nomor_surat', 'sifat', 'hal', 'created_at', 'updated_at'], 'safe'],
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
        $query = Letters::find();

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
            'type' => $this->type,
            'id' => $this->id,
            'ref_tanggal' => $this->ref_tanggal,
            'lampiran' => $this->lampiran,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'ref_nomor_surat', $this->ref_nomor_surat])
            ->andFilterWhere(['like', 'ref_asal_surat', $this->ref_asal_surat])
            ->andFilterWhere(['like', 'ref_hal', $this->ref_hal])
            ->andFilterWhere(['like', 'nomor_surat', $this->nomor_surat])
            ->andFilterWhere(['like', 'sifat', $this->sifat])
            ->andFilterWhere(['like', 'hal', $this->hal]);

        return $dataProvider;
    }
}
