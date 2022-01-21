<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Presensi;
use Yii;

/**
 * PresensiSearch represents the model behind the search form of `common\models\Presensi`.
 */
class PresensiSearch extends Presensi
{
    public $created_at_start;
    public $created_at_end;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'karyawan_id'], 'integer'],
            [['latitude', 'longitude'], 'number'],
            [['address', 'created_at', 'created_at_start', 'created_at_end'], 'safe'],
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
        $query = Presensi::find();

        // add conditions that should always apply here
        $query->orderBy(['created_at' => SORT_DESC]);
        if (Yii::$app->user->can('Admin') && Yii::$app->user->karyawanId) {
            $query->andWhere(['karyawan_id' => Yii::$app->user->kayawanId]);
        }
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
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ]);

        if ($params && $this->created_at_start == $this->created_at_end) {
            $this->created_at_start = $this->created_at_start . ' 00:00:00';
            $this->created_at_end = $this->created_at_end . ' 23:59:59';
        }
        $query->andFilterWhere(['between', 'created_at', $this->created_at_start, $this->created_at_end]);

        $query->andFilterWhere(['like', 'address', $this->address]);

        // echo '<pre>';
        // print_r($this->attributes['created_at_start']);
        // print_r($query);
        return $dataProvider;
    }
}
