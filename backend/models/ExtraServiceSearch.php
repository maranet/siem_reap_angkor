<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ExtraService;

/**
 * ExtraServiceSearch represents the model behind the search form of `backend\models\ExtraService`.
 */
class ExtraServiceSearch extends ExtraService
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'company_id', 'adult', 'child', 'updated_by', 'status', 'created_by'], 'integer'],
            [['name', 'feature_image', 'description', 'policy', 'updated_date', 'created_date'], 'safe'],
            [['adult_price', 'child_price', 'extra_amount'], 'number'],
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
        $query = ExtraService::find();

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
            'adult' => $this->adult,
            'adult_price' => $this->adult_price,
            'child' => $this->child,
            'child_price' => $this->child_price,
            'extra_amount' => $this->extra_amount,
            'updated_by' => $this->updated_by,
            'updated_date' => $this->updated_date,
            'status' => $this->status,
            'created_by' => $this->created_by,
            'created_date' => $this->created_date,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'feature_image', $this->feature_image])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'policy', $this->policy]);

        return $dataProvider;
    }
}
