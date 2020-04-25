<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\sizes\models\Sizes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sizes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'two_in_one')->textInput() ?>

    <?= $form->field($model, 'tree_in_one')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
