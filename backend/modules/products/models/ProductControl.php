<?php

namespace backend\modules\products\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\products\models\Products;

/**
 * ProductControl represents the model behind the search form of `backend\modules\products\models\Products`.
 */
class ProductControl extends Products
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'size_id', 'color_id', 'paren_id', 'price', 'sale_price', 'price_two_in_one', 'price_tree_in_one'], 'integer'],
            [['name', 'created_date', 'description', 'is_slider'], 'safe'],
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
        $query = Products::find();

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
            'size_id' => $this->size_id,
            'color_id' => $this->color_id,
            'paren_id' => $this->paren_id,
            'price' => $this->price,
            'sale_price' => $this->sale_price,
            'created_date' => $this->created_date,
            'price_two_in_one' => $this->price_two_in_one,
            'price_tree_in_one' => $this->price_tree_in_one,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'is_slider', $this->is_slider]);

        return $dataProvider;
    }
}