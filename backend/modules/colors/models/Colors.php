<?php

namespace backend\modules\colors\models;

use backend\modules\images\models\Images;
use backend\modules\productColor\models\ProductColor;
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
 * @property Images[] $images0
 * @property ProductColor[] $productColors
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
            'id' => 'ID',
            'color_name' => 'Color Name',
            'img_name' => 'Img Name',
            'alt' => 'Alt',
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
     * Gets query for [[Images0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImages0()
    {
        return $this->hasMany(Images::className(), ['color_id' => 'id']);
    }

    /**
     * Gets query for [[ProductColors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductColors()
    {
        return $this->hasMany(ProductColor::className(), ['color_id' => 'id']);
    }
}
