<?php
$menu = \backend\modules\menu\models\Menu::find()->asArray()->all();
use \yii\helpers\Url;
?>


<body>
<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>
<header class="header-section">

<div class="nav-item">
    <div class="" style="margin-left: 6%">
        <div class="nav-depart">

            <div class="depart-btn">
                <i class="ti-menu"></i>
                <span><?= Yii::t('app', 'Каталог')?></span>
                <ul class="depart-hover">
                    <?php
                    if (!empty($menu)){
                        foreach ($menu as $item){
                            $menu_id = $item['id'];
                            ?>
                            <li><a href="<?= Url::to(["/shop?menu_id=$menu_id"])?>" ><?=$item['name']?></a></li>
                    <?php
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
        <nav class="nav-menu mobile-menu">
            <ul>
                <li><a href="<?= Url::to(['/shop']) ?>"><?= Yii::t('app','магазин')?></a></li>
                <li><a href="<?= Url::to(['/shipping'])?>"><?= Yii::t('app','Оплата и Доставка')?></a></li>
                <li><a href="<?= Url::to(['/sale'])?>"><?= Yii::t('app','Новости и акции')?></a></li>
                <li><a href="<?= Url::to([''])?>"><?= Yii::t('app','Гарантия')?></a></li>
                <li><a href="<?= Url::to(['/contacts'])?>"><?= Yii::t('app', 'Сотрудничество')?></a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
    </div>
</div>
<div class="container">
    <div class="inner-header">
        <div class="row">
            <div class="col-lg-2 col-md-2">
                <div class="logo">
                    <a href="/adamex">
                        <img src="img/logo.png" alt="">
                    </a>
                </div>
            </div>
            <div class="col-lg-7 col-md-7">
                <div class="advanced-search">
                    <div class="input-group input__search">
                        <input type="text" placeholder="What do you need?">
                        <button type="button"><i class="ti-search"></i></button>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 text-right col-md-3">
                <ul class="nav-right">
                    <li class="heart-icon">
                        <a href="#">
                            <i class="icon_heart_alt"></i>
                            <span>1</span>
                        </a>
                    </li>
                    <li class="cart-icon">
                        <a href="#">
                            <i class="icon_bag_alt"></i>
                            <span>3</span>
                        </a>
                        <div class="cart-hover">
                            <div class="select-items">
                                <table>
                                    <tbody>
                                    <tr>
                                        <td class="si-pic"><img src="img/select-product-1.jpg" alt=""></td>
                                        <td class="si-text">
                                            <div class="product-selected">
                                                <p>$60.00 x 1</p>
                                                <h6>Kabino Bedside Table</h6>
                                            </div>
                                        </td>
                                        <td class="si-close">
                                            <i class="ti-close"></i>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="si-pic"><img src="img/select-product-2.jpg" alt=""></td>
                                        <td class="si-text">
                                            <div class="product-selected">
                                                <p>$60.00 x 1</p>
                                                <h6>Kabino Bedside Table</h6>
                                            </div>
                                        </td>
                                        <td class="si-close">
                                            <i class="ti-close"></i>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="select-total">
                                <span>total:</span>
                                <h5>$120.00</h5>
                            </div>
                            <div class="select-button">
                                <a href="#" class="primary-btn view-card">VIEW CARD</a>
                                <a href="#" class="primary-btn checkout-btn">CHECK OUT</a>
                            </div>
                        </div>
                    </li>
                    <li class="cart-price">$150.00</li>
                </ul>
            </div>
        </div>
    </div>
</div>
</header>


