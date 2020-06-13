<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\TourItem;

/**
 * TourItemSearch represents the model behind the search form of `frontend\models\TourItem`.
 */
class TourItemSearch extends TourItem
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'company_id', 'recommended', 'duration_type', 'updated_by', 'status', 'created_by'], 'integer'],
            [['name', 'feature_image', 'description', 'starting_time', 'tip_note', 'updated_date', 'created_date', 'from_date','to_date', 'adult', 'child'], 'safe'],
            [['price', 'duration'], 'number'],
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
        $query = TourItem::find();
        $query->joinWith(['tourCategory']);


        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]],
            'pagination' => ['pageSize' => 10,],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['=', 'tour_category.id', $_SESSION['category_id']]);

        return $dataProvider;
    }
}
