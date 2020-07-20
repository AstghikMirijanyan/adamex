<?php

namespace backend\modules\images\models;

use backend\modules\colors\models\Colors;
use backend\modules\products\models\Products;

/**
 * This is the model class for table "images".
 *
 * @property int $id
 * @property int $size_id
 * @property int $color_id
 * @property int $product_id
 * @property string $image
 * @property string $type
 * @property string|null $main_image
 *
 * @property Colors $color
 * @property Products $product
 * @property Colors $color0
 */
class Images extends \yii\db\ActiveRecord
{
    public $imageFile;
    public $imageFileMulty;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'images';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image'],'filter','filter'=>'\yii\helpers\HtmlPurifier::process'],
            [['imageFile', 'imageFileMulty','type'], 'safe'],
            [['imageFile'], 'file', 'extensions'=>'jpg, gif, png', 'maxSize'=> 1000000], //max 1 mb
            [['imageFile'], 'image'],
            [['size_id', 'color_id', 'product_id', 'image'], 'required'],
            [['size_id', 'color_id', 'product_id'], 'integer'],
            [['main_image'], 'string'],
            [['image'], 'string', 'max' => 500],
            [['color_id'], 'exist', 'skipOnError' => true, 'targetClass' => Colors::className(), 'targetAttribute' => ['color_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['color_id'], 'exist', 'skipOnError' => true, 'targetClass' => Colors::className(), 'targetAttribute' => ['color_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'size_id' => 'Size ID',
            'color_id' => 'Color ID',
            'product_id' => 'Product ID',
            'image' => 'Image',
            'main_image' => 'Main Image',
        ];
    }

    /**
     * Gets query for [[Color]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getColor()
    {
        return $this->hasOne(Colors::className(), ['id' => 'color_id']);
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['id' => 'product_id']);
    }

    /**
     * Gets query for [[Color0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getColor0()
    {
        return $this->hasOne(Colors::className(), ['id' => 'color_id']);
    }
}
