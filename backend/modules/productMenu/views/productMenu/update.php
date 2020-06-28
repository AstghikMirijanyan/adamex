<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\productMenu\models\ProductMenu */

$this->title = 'Update Product Menu: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Product Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-menu-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
