<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\RatePlan;

/**
 * RatePlanSearch represents the model behind the search form of `backend\models\RatePlan`.
 */
class RatePlanSearch extends RatePlan
{
    /**
     * {@inheritdoc}
     */
    public $month, $year;
    public function rules()
    {
        return [
            [['id', 'company_id', 'rate_set_up_id', 'rate_range_id', 'mark_up_type', 'updated_by', 'status', 'created_by', 'month', 'year'], 'integer'],
            [['cost_adult', 'cost_child', 'price_adult', 'price_child', 'mark_up_adult', 'mark_up_child'], 'number'],
            [['date', 'updated_date', 'created_date'], 'safe'],
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
        $query = RatePlan::find();

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
            'cost_adult' => $this->cost_adult,
            'company_id' => $this->company_id,
            'rate_set_up_id' => $this->rate_set_up_id,
            'rate_range_id' => $this->rate_range_id,
            'cost_child' => $this->cost_child,
            'price_adult' => $this->price_adult,
            'price_child' => $this->price_child,
            'mark_up_adult' => $this->mark_up_adult,
            'mark_up_child' => $this->mark_up_child,
            'mark_up_type' => $this->mark_up_type,
            'date' => $this->date,
            'updated_by' => $this->updated_by,
            'status' => $this->status,
            'updated_date' => $this->updated_date,
            'created_by' => $this->created_by,
            'created_date' => $this->created_date,
        ]);

        return $dataProvider;
    }
}
