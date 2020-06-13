<?php

namespace frontend\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Allotment;

/**
 * AllotmentSearch represents the model behind the search form of `frontend\models\Allotment`.
 */
class AllotmentSearch extends Allotment
{
    /**
     * {@inheritdoc}
     */
    public $adult, $child, $from_date, $to_date, $tour_category_id;
    public function rules()
    {
        return [
            [['id', 'company_id', 'rate_set_up_id', 'tour_item_id', 'number', 'updated_by', 'status', 'created_by', 'adult', 'child', 'tour_category_id'], 'integer'],
            [['date', 'description', 'updated_date', 'created_date', 'from_date', 'to_date'], 'safe'],
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
     * Creates data provider ins`tance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Allotment::find()->select(['allotment.tour_item_id'])->where(['tour_item.status'=>1])->distinct();
        $query->joinWith(['tourItem']);
        // $query->joinWith(['ratePlan']);



        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            // 'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]],
            'pagination' => ['pageSize' => 3],
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
            'tour_item_id' => $this->tour_item_id,
            'company_id' => $this->company_id,
            'date' => $this->date,
            'number' => $this->number,
            'updated_by' => $this->updated_by,
            'status' => $this->status,
            'updated_date' => $this->updated_date,
            'created_by' => $this->created_by,
            'created_date' => $this->created_date,
        ]);
            $date_type = 'date(allotment.date)';
            // if (isset($adult = $_SESSION['adult'])) {
            //     $adult = $_SESSION['adult'];
            //     $child = $_SESSION['child'];
            //     $number_guest = $adult+$child;
            // }
            // echo $_SESSION['adult'];
            //  if (!empty($adult = $_SESSION['adult']) ) {
            //     $adult = $_SESSION['adult'];
            //     $child = $_SESSION['child'];
            //     $number_guest = $adult+$child;
            //  }


        $query->andFilterWhere(['or',
                ['between', $date_type, $this->from_date, $this->to_date],
            ]);
            $query->andFilterWhere(['=', 'tour_item.category_id',$this->tour_category_id]);
          
            
           // echo $query->createCommand()->getRawSql();


        return $dataProvider;
    }
}
