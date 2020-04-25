<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\sizes\models\Sizes */

$this->title = Yii::t('app', 'Create Sizes');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sizes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sizes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
