<?php

namespace backend\modules\products\models;

use backend\modules\sizes\models\Sizes;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ProductControl represents the model behind the search form of `backend\modules\products\models\Products`.
 */
class ProductControl extends Products
{
    /**
     * {@inheritdoc}
     */
    public $size;

    public function rules()
    {

        return [
            [['id',  'paren_id', 'price', 'sale_price', 'price_two_in_one', 'price_tree_in_one'], 'integer'],
            [['name','size', 'created_date', 'description', 'is_slider', 'is_sale', 'is_buy','short_description'], 'safe'],
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
            'sort'=> ['defaultOrder' => ['id' => SORT_DESC]],

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
            'paren_id' => $this->paren_id,
            'price' => $this->price,
            'sale_price' => $this->sale_price,
            'created_date' => $this->created_date,
            'price_two_in_one' => $this->price_two_in_one,
            'price_tree_in_one' => $this->price_tree_in_one,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'short_description', $this->short_description])
            ->andFilterWhere(['like', 'is_slider', $this->is_slider])
            ->andFilterWhere(['like', 'is_sale', $this->is_sale])
//            ->andFilterWhere(['like', 'size', $this->productSizes->size->name])
            ->andFilterWhere(['like', 'is_buy', $this->is_buy]);

        return $dataProvider;
    }
}
