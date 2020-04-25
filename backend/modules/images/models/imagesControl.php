<?php

namespace backend\modules\images\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\images\models\Images;

/**
 * imagesControl represents the model behind the search form of `backend\modules\images\models\Images`.
 */
class imagesControl extends Images
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'size_id', 'color_id', 'product_id'], 'integer'],
            [['image', 'main_image'], 'safe'],
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
        $query = Images::find();

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
            'product_id' => $this->product_id,
        ]);

        $query->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'main_image', $this->main_image]);

        return $dataProvider;
    }
}
