<?php

namespace backend\modules\productSizes\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\productSizes\models\ProductSizes;

/**
 * ProductSizesControl represents the model behind the search form of `backend\modules\productSizes\models\ProductSizes`.
 */
class ProductSizesControl extends ProductSizes
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'product_id', 'size_id'], 'integer'],
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
        $query = ProductSizes::find();

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
            'product_id' => $this->product_id,
            'size_id' => $this->size_id,
        ]);

        return $dataProvider;
    }
}
