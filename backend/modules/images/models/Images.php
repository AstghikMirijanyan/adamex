<?php

namespace backend\modules\images\models;

use Yii;

/**
 * This is the model class for table "images".
 *
 * @property int $id
 * @property int $size_id
 * @property int $product_id
 * @property string $image
 * @property string|null $main_image
 *
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
            [['imageFile', 'imageFileMulty'], 'safe'],
            [['imageFile'], 'file', 'extensions'=>'jpg, gif, png', 'maxSize'=> 1000000], //max 1 mb
            [['imageFile'], 'image'],
            [['size_id',  'product_id', 'image'], 'required'],
            [['size_id', 'product_id'], 'integer'],
            [['main_image'], 'string'],
            [['image'], 'string', 'max' => 500],
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
            'product_id' => Yii::t('app', 'Product ID'),
            'image' => Yii::t('app', 'Image'),
            'main_image' => Yii::t('app', 'Main Image'),
        ];
    }


}
