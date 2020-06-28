<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\productSizes\models\ProductSizes */

$this->title = Yii::t('app', 'Create Product Sizes');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Product Sizes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-sizes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
