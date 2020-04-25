<?php

namespace backend\modules\sizes\models;

use backend\modules\products\models\Products;
use Yii;

/**
 * This is the model class for table "sizes".
 *
 * @property int $id
 * @property int $two_in_one
 * @property int $tree_in_one
 *
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
            [['two_in_one', 'tree_in_one'], 'required'],
            [['two_in_one', 'tree_in_one'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'two_in_one' => Yii::t('app', 'Two In One'),
            'tree_in_one' => Yii::t('app', 'Tree In One'),
        ];
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
