<?php

namespace backend\modules\sizes\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\sizes\models\Sizes;

/**
 * SizesControl represents the model behind the search form of `backend\modules\sizes\models\Sizes`.
 */
class SizesControl extends Sizes
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'two_in_one', 'tree_in_one'], 'integer'],
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
        $query = Sizes::find();

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
            'two_in_one' => $this->two_in_one,
            'tree_in_one' => $this->tree_in_one,
        ]);

        return $dataProvider;
    }
}
