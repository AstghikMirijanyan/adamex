<?php

namespace backend\modules\products\models;

use backend\modules\cart\models\Cart;
use backend\modules\colors\models\Colors;
use backend\modules\sizes\models\Sizes;
use Yii;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string $name
 * @property int|null $size_id
 * @property int|null $color_id
 * @property int|null $paren_id
 * @property int $price
 * @property int $sale_price
 * @property string $created_date
 * @property string|null $description
 * @property int|null $price_two_in_one
 * @property int $price_tree_in_one
 * @property string $is_slider
 *
 * @property Cart[] $carts
 * @property Sizes $priceTwoInOne
 * @property Sizes $priceTreeInOne
 * @property Colors $color
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'price', 'sale_price', 'price_tree_in_one'], 'required'],
            [['size_id', 'color_id', 'paren_id', 'price', 'sale_price', 'price_two_in_one', 'price_tree_in_one'], 'integer'],
            [['created_date'], 'safe'],
            [['is_slider'], 'string'],
            [['name', 'description'], 'string', 'max' => 255],
            [['price_two_in_one'], 'exist', 'skipOnError' => true, 'targetClass' => Sizes::className(), 'targetAttribute' => ['price_two_in_one' => 'id']],
            [['price_tree_in_one'], 'exist', 'skipOnError' => true, 'targetClass' => Sizes::className(), 'targetAttribute' => ['price_tree_in_one' => 'id']],
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
            'name' => Yii::t('app', 'Name'),
            'size_id' => Yii::t('app', 'Size ID'),
            'color_id' => Yii::t('app', 'Color ID'),
            'paren_id' => Yii::t('app', 'Paren ID'),
            'price' => Yii::t('app', 'Price'),
            'sale_price' => Yii::t('app', 'Sale Price'),
            'created_date' => Yii::t('app', 'Created Date'),
            'description' => Yii::t('app', 'Description'),
            'price_two_in_one' => Yii::t('app', 'Price Two In One'),
            'price_tree_in_one' => Yii::t('app', 'Price Tree In One'),
            'is_slider' => Yii::t('app', 'Is Slider'),
        ];
    }

    /**
     * Gets query for [[Carts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarts()
    {
        return $this->hasMany(Cart::className(), ['product_id' => 'id']);
    }

    /**
     * Gets query for [[PriceTwoInOne]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPriceTwoInOne()
    {
        return $this->hasOne(Sizes::className(), ['id' => 'price_two_in_one']);
    }

    /**
     * Gets query for [[PriceTreeInOne]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPriceTreeInOne()
    {
        return $this->hasOne(Sizes::className(), ['id' => 'price_tree_in_one']);
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
