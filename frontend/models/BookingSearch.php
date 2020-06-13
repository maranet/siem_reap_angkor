<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Booking;

/**
 * BookingSearch represents the model behind the search form of `frontend\models\Booking`.
 */
class BookingSearch extends Booking
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'updated_by', 'created_by', 'status', 'company_id', 'user_id', 'country_id'], 'integer'],
            [['title', 'updated_date', 'created_date', 'first_name', 'last_name', 'email', 'confirm_email', 'contact_phone', 'description'], 'safe'],
            [['total'], 'number'],
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
        $query = Booking::find();

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
            'updated_date' => $this->updated_date,
            'updated_by' => $this->updated_by,
            'created_date' => $this->created_date,
            'created_by' => $this->created_by,
            'status' => $this->status,
            'company_id' => $this->company_id,
            'user_id' => $this->user_id,
            'country_id' => $this->country_id,
            'total' => $this->total,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'confirm_email', $this->confirm_email])
            ->andFilterWhere(['like', 'contact_phone', $this->contact_phone])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
