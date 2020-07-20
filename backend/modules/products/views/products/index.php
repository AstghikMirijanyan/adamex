<?php

use backend\modules\images\models\Images;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\products\models\ProductControl */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Товары');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Создание продуктов'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php
    // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            [
                'attribute' => 'name',
                'label' => 'Название',
            ],
            [
                'attribute' => 'size',
                'label' => 'Размер',
                'format' => 'raw',
                'value' => function ($data) {
                    if (!empty($data['productSizes'])) {
                        $sizes = '';
                        foreach ($data['productSizes'] as $size) {
                            $sizes .= '<p>' . $size['size']['name'] . '</p>';
                        }
                        return $sizes;
                    } else {
                        return "-";
                    }
                }
            ],
            [
                'attribute' => 'color',
                'format' => 'raw',
                'value' => function ($data) {
                    if (!empty($data['productColors'])) {
                        $colors = '';
                        foreach ($data['productColors'] as $color) {
                            $color_show = $color['color']['color_name'];
                            $colors .= "<p class='color_div' style='background-color: $color_show'></p>";
                        }
                        return $colors;
                    } else {
                        return "-";
                    }
                }],
            [
                'attribute' => 'menu',
                'label' => 'Категория',
                'format' => 'raw',
                'value' => function ($data) {
                    if (!empty($data['productMenus'])) {
                        $menus = '';
                       foreach ($data['productMenus'] as $menu){
                           $menus .= '<p style="background-color: ">' . $menu['menu']['name'] . '</p>';
                       }
                       return $menus;
                    } else {
                        return "-";
                    }
                }

            ],
            [
                'attribute' => 'images',
                'format' => 'raw',
                'value' => function ($data) {
                    if (!empty($data['images'])) {
                        $html = '';
                       foreach ($data['images'] as $image){
                           $html .= Html::img(Yii::$app->homeUrl.'../../frontend/web/images/products/' . $image['image'],['style' => ['max-height'=>'120px','max-width' => '120px'] ,'class' => 'img img-responsive']);

                       }
                       return $html;
                    } else {
                        return "-";
                    }
                }
            ],
            //'paren_id',
            'price',
//            'sale_price',
//            'created_date',
//            'description',
            //'price_two_in_one',
            //'price_tree_in_one',
            //'is_slider',
            //'menu_id',
            //'is_sale',
            //'is_buy',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
