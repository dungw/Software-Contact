<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Software;

/**
 * SoftwareSearch represents the model behind the search form about `common\models\Software`.
 */
class SoftwareSearch extends Software
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cate_id', 'manufacture_id', 'user_rating', 'price_range', 'status'], 'integer'],
            [['name', 'picture', 'description', 'os_support'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Software::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'cate_id' => $this->cate_id,
            'manufacture_id' => $this->manufacture_id,
            'user_rating' => $this->user_rating,
            'price_range' => $this->price_range,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'picture', $this->picture])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'os_support', $this->os_support]);

        return $dataProvider;
    }
}
