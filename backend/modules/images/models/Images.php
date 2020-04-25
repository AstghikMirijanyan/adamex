<?php

namespace backend\modules\images\models;

use backend\modules\colors\models\Colors;
use Yii;

/**
 * This is the model class for table "images".
 *
 * @property int $id
 * @property int $size_id
 * @property int $color_id
 * @property int $product_id
 * @property string $image
 * @property string|null $main_image
 *
 * @property Colors $color
 */
class Images extends \yii\db\ActiveRecord
{
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
            [['size_id', 'color_id', 'product_id', 'image'], 'required'],
            [['size_id', 'color_id', 'product_id'], 'integer'],
            [['main_image'], 'string'],
            [['image'], 'string', 'max' => 500],
            [['color_id'], 'exist', 'skipOnError' => true, 'targetClass' => Colors::className(), 'targetAttribute' => ['color_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'size_id' => Yii::t('app', 'Size ID'),
            'color_id' => Yii::t('app', 'Color ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'image' => Yii::t('app', 'Image'),
            'main_image' => Yii::t('app', 'Main Image'),
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
}
