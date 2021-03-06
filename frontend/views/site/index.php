<!-- Header End -->

<!-- Hero Section Begin -->
<section class="hero-section">
    <div class="hero-items owl-carousel">

        <?php if (!empty($slider_products)) {
            $img = '';
            foreach ($slider_products as $product) {
                $imag = $product['images'][0]['image'];
                ?>
                <div class="single-hero-items set-bg" data-setbg="images/products/large/<?= $imag ?>">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-5">
                                <?php if (!empty($product['productMenus'])) {
                                    foreach ($product['productMenus'] as $menu) {
                                        ?>
                                        <span><?= $menu['menu']['name'] ?></span>
                                        <?php
                                    }
                                } ?>
                                <h2><?= $product['name'] ?></h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore</p>
                                <a href="<?= \yii\helpers\Url::to(['']) ?>" class="primary-btn">Shop Now</a>
                            </div>
                        </div>
                        <div class="off-card">
                            <h2>Sale <span><?= ($product['price'] - $product['sale_price']) / 100 ?>%</span></h2>
                        </div>
                    </div>
                </div>

                <?php
            }
        } ?>
    </div>
</section>
<!-- Hero Section End -->

<!-- Banner Section Begin -->
<div class="banner-section spad">
    <div class="container-fluid">
        <div class="row">
            <?php if (!empty($sizes)) {
                foreach ($sizes as $size) {
                    ?>
                    <div class="col-lg-6">
                        <div class="single-banner">
                            <img src="img/cortina-se-3-v-1.jpg" alt="">
                            <div class="inner-text">
                                <h4><?= $size['name'] ?></h4>
                            </div>
                        </div>
                    </div>

                    <?php
                }
            } ?>
        </div>
    </div>
</div>
<!-- Banner Section End -->

<!-- Women Banner Section Begin -->
<section class="women-banner spad">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3">
                <?php
                if (!empty($last_admission)){
                    foreach ($last_admission as $value){
                        $img = $value['images'][0]['image'];
                    }
                }
                ?>
                <div class="product-large set-bg" data-setbg="images/products/unnamed.jpg">
                    <h2><?= Yii::t('app','ADAMEX')?></h2>
                    <a href="#"><?= Yii::t('app','ПОПУЛЯРНОЕ ИЗ НОВОЙ ПОСТАВКИ')?></a>
                </div>
            </div>
            <div class="col-lg-8 offset-lg-1">
                <div class="filter-control">
                    <ul>
                        <li><?= Yii::t('app','ПОСЛЕДНЕЕ ПОСТУПЛЕНИЕ')?></li>
                    </ul>
                </div>
                <div class="product-slider owl-carousel">
                    <?php if (!empty($last_admission)) {
                        foreach ($last_admission as $admission) {
                            $img = $admission['images'][0]['image'];
                            ?>
                            <div class="product-item">
                                <div class="pi-pic">
                                    <img src="images/products/large/<?= $img ?>" alt="">
                                    <div class="icon">
                                        <i class="icon_heart_alt"></i>
                                    </div>
                                    <ul>
                                        <li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a></li>
                                        <li class="quick-view"><a href="#">+ Quick View</a></li>
                                    </ul>
                                </div>
                                <div class="pi-text">
                                    <?php if (!empty($product['productMenus'])) {
                                        foreach ($product['productMenus'] as $menu) {
                                            ?>
                                            <div class="catagory-name"><?= $menu['menu']['name'] ?></div>

                                            <?php
                                        }
                                    } ?>
                                    <a href="#">
                                        <h5><?= $admission['name'] ?></h5>
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

                            <?php
                        }
                    } ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="deal-of-week set-bg spad" data-setbg="img/time-bg.jpg">
    <div class="container">
        <div class="col-lg-6 text-center">
            <div class="section-title">
                <h2>Deal Of The Week</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed<br/> do ipsum dolor sit amet,
                    consectetur adipisicing elit </p>
                <div class="product-price">
                    $35.00
                    <span>/ HanBag</span>
                </div>
            </div>
            <div class="countdown-timer" id="countdown">
                <div class="cd-item">
                    <span>56</span>
                    <p>Days</p>
                </div>
                <div class="cd-item">
                    <span>12</span>
                    <p>Hrs</p>
                </div>
                <div class="cd-item">
                    <span>40</span>
                    <p>Mins</p>
                </div>
                <div class="cd-item">
                    <span>52</span>
                    <p>Secs</p>
                </div>
            </div>
            <a href="#" class="primary-btn">Shop Now</a>
        </div>
    </div>
</section>
<!-- Deal Of The Week Section End -->

<!-- Man Banner Section Begin -->
<section class="man-banner spad">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="filter-control">
                    <ul>
                        <li>ХИТЫ ПРОДАЖ</li>
                    </ul>
                </div>
                <div class="product-slider owl-carousel">
                    <div class="product-item">
                        <div class="pi-pic">
                            <img src="img/products/man-1.jpg" alt="">
                            <div class="sale">Sale</div>
                            <div class="icon">
                                <i class="icon_heart_alt"></i>
                            </div>
                            <ul>
                                <li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a></li>
                                <li class="quick-view"><a href="#">+ Quick View</a></li>
                                <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                            </ul>
                        </div>
                        <div class="pi-text">
                            <div class="catagory-name">Coat</div>
                            <a href="#">
                                <h5>Pure Pineapple</h5>
                            </a>
                            <div class="product-price">
                                $14.00
                                <span>$35.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="product-item">
                        <div class="pi-pic">
                            <img src="img/products/man-2.jpg" alt="">
                            <div class="icon">
                                <i class="icon_heart_alt"></i>
                            </div>
                            <ul>
                                <li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a></li>
                                <li class="quick-view"><a href="#">+ Quick View</a></li>
                                <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                            </ul>
                        </div>
                        <div class="pi-text">
                            <div class="catagory-name">Shoes</div>
                            <a href="#">
                                <h5>Guangzhou sweater</h5>
                            </a>
                            <div class="product-price">
                                $13.00
                            </div>
                        </div>
                    </div>
                    <div class="product-item">
                        <div class="pi-pic">
                            <img src="img/products/man-3.jpg" alt="">
                            <div class="icon">
                                <i class="icon_heart_alt"></i>
                            </div>
                            <ul>
                                <li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a></li>
                                <li class="quick-view"><a href="#">+ Quick View</a></li>
                                <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                            </ul>
                        </div>
                        <div class="pi-text">
                            <div class="catagory-name">Towel</div>
                            <a href="#">
                                <h5>Pure Pineapple</h5>
                            </a>
                            <div class="product-price">
                                $34.00
                            </div>
                        </div>
                    </div>
                    <div class="product-item">
                        <div class="pi-pic">
                            <img src="img/products/man-4.jpg" alt="">
                            <div class="icon">
                                <i class="icon_heart_alt"></i>
                            </div>
                            <ul>
                                <li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a></li>
                                <li class="quick-view"><a href="#">+ Quick View</a></li>
                                <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                            </ul>
                        </div>
                        <div class="pi-text">
                            <div class="catagory-name">Towel</div>
                            <a href="#">
                                <h5>Converse Shoes</h5>
                            </a>
                            <div class="product-price">
                                $34.00
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 offset-lg-1">
                <div class="product-large set-bg m-large" data-setbg="images/products/immm.jpg">
                    <h2><?= Yii::t('app','СЕЙЧАС ПОКУПАЮТ')?></h2>
                    <a href="#"><?= Yii::t('app','Мы подобрали самые популярные модели')?></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Man Banner Section End -->

<!-- Instagram Section Begin -->
<div class="instagram-photo">
    <div class="insta-item set-bg" data-setbg="img/insta-1.jpg">
        <div class="inside-text">
            <i class="ti-instagram"></i>
            <h5><a href="#">colorlib_Collection</a></h5>
        </div>
    </div>
    <div class="insta-item set-bg" data-setbg="img/insta-2.jpg">
        <div class="inside-text">
            <i class="ti-instagram"></i>
            <h5><a href="#">colorlib_Collection</a></h5>
        </div>
    </div>
    <div class="insta-item set-bg" data-setbg="img/insta-3.jpg">
        <div class="inside-text">
            <i class="ti-instagram"></i>
            <h5><a href="#">colorlib_Collection</a></h5>
        </div>
    </div>
    <div class="insta-item set-bg" data-setbg="img/insta-4.jpg">
        <div class="inside-text">
            <i class="ti-instagram"></i>
            <h5><a href="#">colorlib_Collection</a></h5>
        </div>
    </div>
    <div class="insta-item set-bg" data-setbg="img/insta-5.jpg">
        <div class="inside-text">
            <i class="ti-instagram"></i>
            <h5><a href="#">colorlib_Collection</a></h5>
        </div>
    </div>
    <div class="insta-item set-bg" data-setbg="img/insta-6.jpg">
        <div class="inside-text">
            <i class="ti-instagram"></i>
            <h5><a href="#">colorlib_Collection</a></h5>
        </div>
    </div>
</div>
<!-- Instagram Section End -->

<!-- Latest Blog Section Begin -->
<section class="latest-blog spad">
    <div class="container">

        <div class="benefit-items">
            <div class="row">
                <div class="col-lg-4">
                    <div class="single-benefit">
                        <div class="sb-icon">
                            <img src="img/icon-1.png" alt="">
                        </div>
                        <div class="sb-text">
                            <h6>Free Shipping</h6>
                            <p>For all order over 99$</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-benefit">
                        <div class="sb-icon">
                            <img src="img/icon-2.png" alt="">
                        </div>
                        <div class="sb-text">
                            <h6>Delivery On Time</h6>
                            <p>If good have prolems</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-benefit">
                        <div class="sb-icon">
                            <img src="img/icon-1.png" alt="">
                        </div>
                        <div class="sb-text">
                            <h6>Secure Payment</h6>
                            <p>100% secure payment</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>