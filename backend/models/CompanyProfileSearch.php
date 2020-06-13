<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CompanyProfile;

/**
 * CompanyProfileSearch represents the model behind the search form of `backend\models\CompanyProfile`.
 */
class CompanyProfileSearch extends CompanyProfile
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'company_type', 'number_of_user', 'status', 'company_status', 'created_by', 'updated_by', 'passed_by', 'handle_by', 'deactivated_by', 'user_id', 'company_id', 'code'], 'integer'],
            [['name', 'country_id', 'city_id', 'address', 'postal_code', 'contact_person', 'general_email', 'invoice_email', 'mobile_number_invoice', 'main_phone_1', 'main_phone_2', 'website_url', 'sale_date', 'service_agreement', 'fee', 'created_date', 'updated_date', 'deactivated_at', 'deactivated_reason', 'deactivated_requested_by', 'deactivated_requested_contact_detail', 'lived_date', 'description','link_facebook', 'link_instagram', 'link_twitter', 'link_linkedin'], 'safe'],
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
        $query = CompanyProfile::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['company_status'=>SORT_ASC]]
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
            'country_id' => $this->country_id,
            'city_id' => $this->city_id,
            'company_type' => $this->company_type,
            'user_id' => $this->user_id,
            'company_id' => $this->company_id,
            'number_of_user' => $this->number_of_user,
            'sale_date' => $this->sale_date,
            'code' => $this->code,
            'status' => $this->status,
            'description' => $this->description,

            'company_status' => $this->company_status,
            'created_by' => $this->created_by,
            'created_date' => $this->created_date,
            'updated_date' => $this->updated_date,
            'updated_by' => $this->updated_by,
            'passed_by' => $this->passed_by,
            'handle_by' => $this->handle_by,
            'deactivated_at' => $this->deactivated_at,
            'deactivated_by' => $this->deactivated_by,
            'lived_date' => $this->lived_date,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'postal_code', $this->postal_code])
            ->andFilterWhere(['like', 'contact_person', $this->contact_person])
            ->andFilterWhere(['like', 'company_status', $this->company_status])
            ->andFilterWhere(['like', 'general_email', $this->general_email])
            ->andFilterWhere(['like', 'invoice_email', $this->invoice_email])
            ->andFilterWhere(['like', 'mobile_number_invoice', $this->mobile_number_invoice])
            ->andFilterWhere(['like', 'main_phone_1', $this->main_phone_1])
            ->andFilterWhere(['like', 'main_phone_2', $this->main_phone_2])
            ->andFilterWhere(['like', 'website_url', $this->website_url])
            ->andFilterWhere(['like', 'service_agreement', $this->service_agreement])
            ->andFilterWhere(['like', 'fee', $this->fee])
            ->andFilterWhere(['like', 'deactivated_reason', $this->deactivated_reason])
            ->andFilterWhere(['like', 'deactivated_requested_by', $this->deactivated_requested_by])
            // ->andFilterWhere(['=', 'company_id',$_SESSION['company_id'] ])
            ->andFilterWhere(['like', 'deactivated_requested_contact_detail', $this->deactivated_requested_contact_detail]);

        return $dataProvider;
    }
}
