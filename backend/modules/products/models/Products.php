<?php

namespace backend\modules\products\models;

use backend\modules\cart\models\Cart;
use backend\modules\images\models\Images;
use backend\modules\productColor\models\ProductColor;
use backend\modules\productMenu\models\ProductMenu;
use backend\modules\productSizes\models\ProductSizes;
use backend\modules\sizes\models\Sizes;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string $name
 * @property int|null $paren_id
 * @property int $price
 * @property int|null $sale_price
 * @property string $created_date
 * @property string|null $description
 * @property int|null $price_two_in_one
 * @property int|null $price_tree_in_one
 * @property string $is_slider
 * @property string $is_sale
 * @property string $is_buy
 * @property string|null $short_description
 *
 * @property Cart[] $carts
 * @property Images[] $images
 * @property ProductColor[] $productColors
 * @property ProductMenu[] $productMenus
 * @property ProductSizes[] $productSizes
 * @property Sizes $priceTwoInOne
 * @property Sizes $priceTreeInOne
 */
class Products extends \yii\db\ActiveRecord
{
    public $size;
    public $color;
    public $menu;
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
            [['name', 'price'], 'required'],
            [['paren_id', 'price', 'sale_price', 'price_two_in_one', 'price_tree_in_one'], 'integer'],
            [['created_date','size','color','menu'], 'safe'],
            [['description', 'is_slider', 'is_sale', 'is_buy', 'short_description'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['price_two_in_one'], 'exist', 'skipOnError' => true, 'targetClass' => Sizes::className(), 'targetAttribute' => ['price_two_in_one' => 'id']],
            [['price_tree_in_one'], 'exist', 'skipOnError' => true, 'targetClass' => Sizes::className(), 'targetAttribute' => ['price_tree_in_one' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'paren_id' => 'Paren ID',
            'price' => 'Price',
            'sale_price' => 'Sale Price',
            'created_date' => 'Created Date',
            'description' => 'Description',
            'price_two_in_one' => 'Price Two In One',
            'price_tree_in_one' => 'Price Tree In One',
            'is_slider' => 'Is Slider',
            'is_sale' => 'Is Sale',
            'is_buy' => 'Is Buy',
            'short_description' => 'Short Description',
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

    public function filterProductData($get){
        {
            $query = self::find();

            // add conditions that should always apply here

            $dataProvider = new ActiveDataProvider(['query' => $query]);

            $query->innerJoinWith(['productMenus' => function ($query) use ($get) {
                if (ArrayHelper::keyExists('menu_id', $get)) {
                    $query->andWhere(['product_menu.menu_id' => $get['menu_id']]);
                }
            }]);

            return $dataProvider;
        }
    }

    /**
     * Gets query for [[Images]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(Images::className(), ['product_id' => 'id']);
    }

    /**
     * Gets query for [[ProductColors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductColors()
    {
        return $this->hasMany(ProductColor::className(), ['product_id' => 'id']);
    }

    /**
     * Gets query for [[ProductMenus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductMenus()
    {
        return $this->hasMany(ProductMenu::className(), ['product_id' => 'id']);
    }

    /**
     * Gets query for [[ProductSizes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductSizes()
    {
        return $this->hasMany(ProductSizes::className(), ['product_id' => 'id']);
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
}
