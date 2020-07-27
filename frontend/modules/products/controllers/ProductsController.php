<?php

namespace frontend\modules\products\controllers;

use backend\modules\menu\models\Menu;
use backend\modules\products\models\Products;
use backend\modules\sizes\models\Sizes;

class ProductsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $sizes = Sizes::find()->asArray()->all();
        $categories = Menu::find()->asArray()->all();
        $get = \Yii::$app->request->get();
        $products = new Products();

        $all_products = $products->filterProductData($get);
        $pr = $all_products->query->all();

        return $this->render('index',
            [
                'sizes' => $sizes,
                'categories' => $categories,
                'products' => $pr
            ]);
    }

}
