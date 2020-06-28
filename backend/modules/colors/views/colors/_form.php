<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\colors\models\Colors */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="colors-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'color_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'img_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alt')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
