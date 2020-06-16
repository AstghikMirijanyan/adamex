<?php
$menu = \backend\modules\menu\models\Menu::find()->asArray()->all();
?>
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
                            ?>
                            <li><a href="<?=$item['id']?>"><?=$item['name']?></a></li>
                    <?php
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
        <nav class="nav-menu mobile-menu">
            <ul>
                <li><a href="./shop.html"><?= Yii::t('app','магазин')?></a></li>
                <li><a href="#"><?= Yii::t('app','Оплата и Доставка')?></a></li>
                <li><a href="./blog.html"><?= Yii::t('app','Новости и акции')?></a></li>
                <li><a href="./blog.html"><?= Yii::t('app','Отзывы')?></a></li>
                <li><a href="./contact.html"><?= Yii::t('app', 'Сотрудничество')?></a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
    </div>
</div>
