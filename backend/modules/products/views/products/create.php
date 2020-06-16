<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\products\models\Products */
/* @var $modelImages backend\modules\images\models\Images */
/* @var $modelSizes backend\modules\sizes\models\Sizes */
/* @var $modelMenu backend\modules\menu\models\Menu */

$this->title = Yii::t('app', 'Создание продуктов');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelImages' => $modelImages,
        'modelSizes' => $modelSizes,
        'modelMenu' => $modelMenu,
        'menu_items' => $menu_items

    ]) ?>

</div>
