<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\products\models\Products */
/* @var $modelSizes backend\modules\sizes\models\Sizes */
/* @var $modelMenu backend\modules\menu\models\Menu */

$this->title = Yii::t('app', 'Update Products: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="products-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelSizes' => $modelSizes,
        'modelMenu' => $modelMenu,
        'size_items' => $size_items


    ]) ?>

</div>
