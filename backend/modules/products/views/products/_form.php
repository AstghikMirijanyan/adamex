<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\products\models\Products */
/* @var $modelImages backend\modules\images\models\Images */
/* @var $modelSizes backend\modules\sizes\models\Sizes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-form">
    <?php $form = ActiveForm::begin([
        'enableClientValidation' => true,
        'enableAjaxValidation' => false,
        'validateOnChange' => true,
        'validateOnBlur' => false,
        'options' => [
            'enctype' => 'multipart/form-data',
            'id' => 'dynamic-form'
        ]
    ]); ?>
    <div class="tabbable-bordered">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#information" aria-expanded="false"><?= Yii::t('app', 'Информация') ?></a></li>
            <li class=""><a data-toggle="tab" href="#price" aria-expanded="false"><?= Yii::t('app', 'Цена') ?></a></li>
            <li class=""><a data-toggle="tab" href="#seo" aria-expanded="false"><?= Yii::t('app', 'SEO') ?></a></li>
            <li class=""><a data-toggle="tab" href="#color" aria-expanded="false"><?= Yii::t('app', 'Цвет') ?></a></li>
            <li class=""><a data-toggle="tab" href="#association" aria-expanded="false"><?= Yii::t('app','Категория')?></a></li>
            <li class=""><a data-toggle="tab" href="#size" aria-expanded="false"><?= Yii::t('app', 'Размер') ?> </a></li>
            <li class=""><a data-toggle="tab" href="#images" aria-expanded="false"><?= Yii::t('app','Картинки')?> </a></li>
        </ul>
        <div class="tab-content">
            <div id="information" class="tab-pane active">
                <div class="form-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-12">
                                <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('Имя') ?>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <?= $form->field($model, 'description')->widget(\yii\redactor\widgets\Redactor::className(),
                                                [
                                                    'clientOptions' =>
                                                        [
                                                            'imageUpload' => \yii\helpers\Url::to(['/redactor/upload/image']),
                                                            'fileUpload' => false,
                                                            'plugins' => ['fontcolor', 'imagemanager', 'table', 'undoredo', 'clips', 'fullscreen'],
                                                        ]
                                                ])
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <?= $form->field($model, 'short_description')->widget(\yii\redactor\widgets\Redactor::className(),
                                                [
                                                    'clientOptions' =>
                                                        [
                                                            'imageUpload' => \yii\helpers\Url::to(['/redactor/upload/image']),
                                                            'fileUpload' => false,
                                                            'plugins' => ['fontcolor', 'imagemanager', 'table', 'undoredo', 'clips', 'fullscreen'],
                                                        ]
                                                ])
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <?= $form->field($model, 'is_sale')->dropDownList(['0', '1',], ['prompt' => ''])->label('Продажа?') ?>
                                <?= $form->field($model, 'is_slider')->dropDownList(['0', '1',], ['prompt' => ''])->label('В слайдере?') ?>
                                <?= $form->field($model, 'is_buy')->dropDownList(['0', '1',], ['prompt' => ''])->label('СЕЙЧАС ПОКУПАЮТ?') ?>
                                <?php $form->field($model, 'created_date')->textInput()->label('Дата создания') ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="price" class="tab-pane">
                <div class="form-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-12">
                                <?= $form->field($model, 'price')->textInput() ?>
                                <?= $form->field($model, 'sale_price')->textInput() ?>
                                <?= $form->field($model, 'price_two_in_one')->textInput() ?>
                                <?= $form->field($model, 'price_tree_in_one')->textInput() ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="seo" class="tab-pane">
                <div class="form-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-12">
                                djsfhjds
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="association" class="tab-pane">
                <div class="form-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-12">

                                <?= $form->field($modelMenu, 'name')->dropDownList(
                                    \yii\helpers\ArrayHelper::map($menu_items, 'id', 'name')
                                ) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="color" class="tab-pane">
                <div class="form-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="row clearfix">
                                    <?php
                                    echo \kartik\color\ColorInput::widget([
                                        'name' => 'Product[color]',
                                        'value' => $model->color,
                                        'attribute' => 'saturation',
                                        'options' => ['readonly' => false,'required' => true]
                                    ]);
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="size" class="tab-pane">
                <div class="form-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-12">
                                <?= $form->field($modelSizes, 'name')->dropDownList(
                                    \yii\helpers\ArrayHelper::map($size_items, 'id', 'name')
                                ) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="images" class="tab-pane">
                <div class="form-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="multi">

                                    <?php

                                    $uploadFile = \yii\helpers\Url::to(['/products/upload-file?id=' . $model->id]);
                                    $imagesOptions = [];
                                    $imgPath = [];
                                    $size = 0;

                                    if (!$model->isNewRecord) {

                                        $model_image = \backend\modules\images\models\Images::find()->where(['product_id' => $model->id])->orderBy('sort')->all();

                                        if (!empty($model_image)) {

                                            foreach ($model_image as $val) {

                                                $deleteUrl = \yii\helpers\Url::to(["/products/delete-file?id=". $val->id]);

                                                if (file_exists(Yii::$app->params['productImage'] . $val->image)) {
                                                    $size = filesize(Yii::$app->params['productImage'] . $val->image);
                                                    $imgPath[] = Html::img(\yii\helpers\Url::to( '/images/products/' . $val->image),['width' => 'auto', 'height' => '100%', 'data-id' => $val->id]);
                                                }

                                                $imagesOptions[] = [
                                                    'url' => $deleteUrl,
                                                    'size' => $size,
                                                    'key' => $val->id,

                                                ];
                                            }

                                        }
                                    }
                                    ?>

                                    <?= $form->field($modelImages, 'imageFileMulty[]')->widget(\kartik\file\FileInput::classname(), [
                                        'attribute' => 'imageFileMulty[]',
                                        'name' => 'imageFileMulty[]',
                                        'options' => [
                                            'accept' => 'image/*,video/*',
                                            'multiple' => true,
                                        ],
                                        'pluginOptions' => [
                                            'previewFileType' => 'image',
                                            'uploadAsync' => true,
                                            'showPreview' => true,
                                            'showUpload' => $model->isNewRecord ? false : true,
                                            'showCaption' => false,
                                            'showDrag' => false,
                                            'uploadUrl' => $uploadFile,
                                            'initialPreviewConfig' => $imagesOptions,
                                            'initialPreview' => $imgPath,
                                            'initialPreviewAsData' => false,
                                            'initialPreviewShowDelete' => true,
                                            'overwriteInitial' => $model->isNewRecord ? true : false,
                                            'resizeImages' => true,
                                            'layoutTemplates' => [
                                                !$model->isNewRecord ?: 'actionUpload' => '',
                                            ],
                                        ],
                                    ]);
                                    ?>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
