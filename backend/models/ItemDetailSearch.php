<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ItemDetail;

/**
 * ItemDetailSearch represents the model behind the search form of `backend\models\ItemDetail`.
 */
class ItemDetailSearch extends ItemDetail
{
    /**
     * {@inheritdoc}
     */
    public $month, $year;
    public function rules()
    {
        return [
            [['id', 'tour_item_id', 'updated_by', 'status', 'created_by', 'month', 'year'], 'integer'],
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

    /**∂
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ItemDetail::find();

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
            'month' => $this->month,
            'year' => $this->year,
            'tour_item_id' => $this->tour_item_id,
            'date' => $this->date,
            'updated_by' => $this->updated_by,
            'status' => $this->status,
            'updated_date' => $this->updated_date,
            'created_by' => $this->created_by,
            'created_date' => $this->created_date
        ]);

        return $dataProvider;
    }
}
