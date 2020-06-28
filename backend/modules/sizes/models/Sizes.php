<?php

namespace backend\modules\sizes\models;

use backend\modules\products\models\Products;
use backend\modules\productSizes\ProductSizes;
use Yii;

/**
 * This is the model class for table "sizes".
 *
 * @property int $id
 * @property string $name
 *
 * @property ProductSizes[] $productSizes
 * @property Products[] $products
 * @property Products[] $products0
 */
class Sizes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sizes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * Gets query for [[ProductSizes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductSizes()
    {
        return $this->hasMany(ProductSizes::className(), ['size_id' => 'id']);
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::className(), ['price_two_in_one' => 'id']);
    }

    /**
     * Gets query for [[Products0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts0()
    {
        return $this->hasMany(Products::className(), ['price_tree_in_one' => 'id']);
    }
}
