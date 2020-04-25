<?php

namespace backend\modules\colors\models;

use backend\modules\images\models\Images;
use backend\modules\products\models\Products;
use Yii;

/**
 * This is the model class for table "colors".
 *
 * @property int $id
 * @property string|null $color_name
 * @property string|null $img_name
 * @property string|null $alt
 *
 * @property Images[] $images
 * @property Products[] $products
 */
class Colors extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'colors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['color_name', 'img_name', 'alt'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'color_name' => Yii::t('app', 'Color Name'),
            'img_name' => Yii::t('app', 'Img Name'),
            'alt' => Yii::t('app', 'Alt'),
        ];
    }

    /**
     * Gets query for [[Images]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(Images::className(), ['color_id' => 'id']);
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::className(), ['color_id' => 'id']);
    }
}
