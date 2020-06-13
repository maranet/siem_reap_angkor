<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;

/**
 * UserSearch represents the model behind the search form of `app\models\User`.
 */
class UserSearch extends User
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'employee_id', 'user_type_id', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['last_name', 'first_name', 'username', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'verification_token', 'created_date', 'updated_date'], 'safe'],
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
        $query = User::find();

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

        // // grid filtering conditions
        // $query->andFilterWhere([
        //     'id' => $this->id,
        //     'employee_id' => $this->employee_id,
        //     'user_type_id' => $this->user_type_id,
        //     'status' => $this->status,
        //     'created_at' => $this->created_at,
        //     'updated_at' => $this->updated_at,
        //     'created_date' => $this->created_date,
        //     'created_by' => $this->created_by,
        //     'updated_date' => $this->updated_date,
        //     'updated_by' => $this->updated_by,
        // ]);

        $query->andFilterWhere(['like', 'employee_id', $this->employee_id])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'user_type_id', $this->user_type_id]);

        return $dataProvider;
    }
}
