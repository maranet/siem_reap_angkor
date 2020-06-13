<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\RatePlanSetup;

/**
 * RatePlanSetupSearch represents the model behind the search form of `backend\models\RatePlanSetup`.
 */
class RatePlanSetupSearch extends RatePlanSetup
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'tour_item_id', 'created_by', 'updated_by', 'status'], 'integer'],
            [['name', 'starting_time', 'description', 'created_date', 'updated_date'], 'safe'],
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
        $query = RatePlanSetup::find();

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
            // 'tour_item_id' => $_SESSION['tour_item_id'],
            'starting_time' => $this->starting_time,
            'created_by' => $this->created_by,
            'created_date' => $this->created_date,
            'updated_by' => $this->updated_by,
            'updated_date' => $this->updated_date,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['=', 'tour_item_id', $_SESSION['tour_item_id']]);

        return $dataProvider;
    }
}
