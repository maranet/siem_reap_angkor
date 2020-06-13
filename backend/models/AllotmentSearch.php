<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Allotment;

/**
 * AllotmentSearch represents the model behind the search form of `backend\models\Allotment`.
 */
class AllotmentSearch extends Allotment
{
    /**
     * {@inheritdoc}
     */
    public $month, $year;
    public function rules()
    {
        return [
            [['id', 'company_id', 'rate_set_up_id', 'number', 'updated_by', 'status', 'created_by', 'month', 'year'], 'integer'],
            [['date', 'description', 'updated_date', 'created_date'], 'safe'],
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
        $query = Allotment::find();

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
            'company_id' => $this->company_id,
            'rate_set_up_id' => $this->rate_set_up_id,
            'date' => $this->date,
            'number' => $this->number,
            'updated_by' => $this->updated_by,
            'status' => $this->status,
            'updated_date' => $this->updated_date,
            'created_by' => $this->created_by,
            'created_date' => $this->created_date,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description]);
        return $dataProvider;
    }
}
