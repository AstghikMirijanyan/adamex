<?php
use yii\widgets\ActiveForm;
?>
<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a href="#"><i class="fa fa-home"></i> Home</a>
                    <span>Shop</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section Begin -->

<!-- Product Shop Section Begin -->
<?php
$form = ActiveForm::begin(['id' => 'shop', 'method' => 'get', 'action' => \yii\helpers\Url::to(['/shop'])]); ?>

<section class="product-shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-8 order-2 order-lg-1 produts-sidebar-filter">
                <?php
                if (!empty($sizes)) {
                    ?>
                    <div class="filter-widget">
                        <h4 class="fw-title"><?= Yii::t('app', 'Размер ') ?></h4>
                        <ul class="filter-catagories">
                            <?php
                            foreach ($sizes as $size) {
                                ?>
                                <li><a href="#"><?= Yii::t('app', strtoupper($size['name'])) ?></a></li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                    <?php
                }
                ?>
                <?php if (!empty($categories)) {
                    ?>
                    <div class="filter-widget">
                        <h4 class="fw-title"><?= Yii::t('app', 'Категория') ?></h4>
                        <div class="fw-brand-check">
                            <?php
                            foreach ($categories as $category) {
                                ?>
                                <div class="bc-item">
                                    <label for="<?= $category['name'] ?>">
                                        <?= $category['name'] ?>
                                        <input type="checkbox" id="<?= strtoupper($category['name']) ?>">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>

                    <?php

                } ?>
                <div class="filter-widget">
                    <h4 class="fw-title"><?= Yii::t('app', 'Цена') ?></h4>
                    <div class="filter-range-wrap">
                        <div class="range-slider">
                            <div class="price-input">
                                <input type="text" id="minamount">
                                <input type="text" id="maxamount">
                            </div>
                        </div>
                        <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                             data-min="33" data-max="98">
                            <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                            <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                            <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                        </div>
                    </div>
                    <a href="#" class="filter-btn"><?= Yii::t('app', 'Фильтр') ?></a>
                </div>
                <div class="filter-widget">
                    <h4 class="fw-title"><?= Yii::t('app', strtoupper('Цвет')) ?></h4>
                    <div class="fw-color-choose">
                        <div class="cs-item">
                            <input type="radio" id="cs-black">
                            <label class="cs-black" for="cs-black">Black</label>
                        </div>
                        <div class="cs-item">
                            <input type="radio" id="cs-violet">
                            <label class="cs-violet" for="cs-violet">Violet</label>
                        </div>
                        <div class="cs-item">
                            <input type="radio" id="cs-blue">
                            <label class="cs-blue" for="cs-blue">Blue</label>
                        </div>
                        <div class="cs-item">
                            <input type="radio" id="cs-yellow">
                            <label class="cs-yellow" for="cs-yellow">Yellow</label>
                        </div>
                        <div class="cs-item">
                            <input type="radio" id="cs-red">
                            <label class="cs-red" for="cs-red">Red</label>
                        </div>
                        <div class="cs-item">
                            <input type="radio" id="cs-green">
                            <label class="cs-green" for="cs-green">Green</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 order-1 order-lg-2">
                <div class="product-show-option">
                    <div class="row">
                        <div class="col-lg-7 col-md-7">
                            <div class="select-option">
                                <select class="sorting">
                                    <option value="">Default Sorting</option>
                                </select>
                                <select class="p-show">
                                    <option value="">Show:</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-5 text-right">
                            <p>Show 01- 09 Of 36 Product</p>
                        </div>
                    </div>
                </div>
                <div class="product-list">
                    <div class="row">
                        <?php
                        if (!empty($products)) {
                            foreach ($products as $product) {
                                ?>
                                <div class="col-lg-4 col-sm-6">
                                    <div class="product-item">
                                        <div class="pi-pic">
                                            <img src="images/products/large/<?= $product['images'][0]['image'] ?>"
                                                 alt="">
                                            <?php
                                            if (!empty($product['sale_price'])) {
                                                ?>
                                                <div class="sale pp-sale"><?= Yii::t('app', 'распродажа') ?></div>
                                                <?php
                                            }
                                            ?>
                                            <div class="icon">
                                                <i class="icon_heart_alt"></i>
                                            </div>
                                            <ul>
                                                <li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a>
                                                </li>
                                                <li class="quick-view"><a href="#">+Быстрый просмотр</a></li>
                                            </ul>
                                        </div>
                                        <div class="pi-text">
                                            <?php
                                            if (!empty($product['productMenus'])) {
                                                ?>
                                                <div class="catagory-name">

                                                    <?php
                                                    foreach ($product['productMenus'] as $productMenu) {
                                                        ?>
                                                        <span><?= $productMenu['menu']['name'] ?></span>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                            <a href="#">
                                                <h5><?= $product['name'] ?></h5>
                                            </a>
                                            <?php
                                            if (!empty($product['sale_price'])) {
                                                ?>
                                                <div class="product-price">
                                                    <?= $product['sale_price'] ?>
                                                    <span><?= $product['price'] ?></span>
                                                </div>
                                                <?php
                                            } else {
                                                ?>
                                                <div class="product-price">
                                                    <?= $product['price'] ?>
                                                </div>
                                                <?php
                                            }
                                            ?>

                                        </div>
                                    </div>
                                </div>

                                <?php
                            }
                            ?>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="loading-more">
                    <i class="icon_loading"></i>
                    <a href="#">
                        Loading More
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>
<?php ActiveForm::end(); ?>


