<?php

namespace common;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Kgb;

/**
 * modelsKgbSearch represents the model behind the search form of `common\models\Kgb`.
 */
class modelsKgbSearch extends Kgb
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'karyawan_id', 'jumlah', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['description'], 'safe'],
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
        $query = Kgb::find();

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
            'karyawan_id' => $this->karyawan_id,
            'jumlah' => $this->jumlah,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
