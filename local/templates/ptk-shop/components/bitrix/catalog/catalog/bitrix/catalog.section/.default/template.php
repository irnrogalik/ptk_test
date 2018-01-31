<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
$it = 0;
?>
<div class="catalog wrap">
    <p class="title">Комплексные решения для пассивной противопожарной защиты</p>
    <div class="clearfix">
        <?
        foreach ($arResult["ITEMS"] as $k => $arItem) {
            $it++;
            if ($it == 3) {
                ?>
                <div class="form">
                    <div class="front js_front">
                        <p class="title">Консультация специалиста</p>
                        <p class="phone"><?= VELCOM ?></p>
                        <p class="phone mg"><?= MTS ?></p>
                        <p class="title">Обратный звонок</p>
                        <p class="text">Консультант перезвонит в течение<br> рабочего дня с 9:00 до 18:00</p>
                        <button class="but" data-change=".js_front .js_back">Заказать звонок</button>
                    </div>
                    <form action="/requests/consul.php" method="post" class="back js_back js_validate">
                        <i class="close" data-change=".js_back .js_front">×</i>
                        <p class="title">Заполните форму</p>
                        <input type="hidden" name="from" value="//<?= $_SERVER["HTTP_HOST"] ?><?= $_SERVER["REQUEST_URI"] ?>">
                        <div class="field js_input js_class_valid">
                            <span>Имя</span><input data-valid="name" data-valid-min="2" type="text" name="name">
                        </div>
                        <div class="field js_input js_class_valid">
                            <span>Телефон</span><input type="text" data-valid="phone" name="phone">
                        </div>
                        <p class="text">Консультант перезвонит в течение<br> рабочего дня с 9:00 до 18:00</p>
                        <button type="submit" class="but">Заказать звонок</button>
                    </form>
                    <script>
                        $(function () {
                            var validator = new Validator();
                        })
                    </script>
                </div>
            <? } ?>
            <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="cart_big clearfix">
                <span class="label"><?= $arItem["PROPERTIES"]["FIRE_RESIST"]["VALUE"] ?></span>
                <span class="name"><span><?= $arItem["NAME"] ?></span></span>
                <span class="inf">
                    <span class="gray">Состав комплекса</span>
                    <? foreach ($arItem["PROPERTIES"]["INGREDIENTS"]["VALUE"] as $val) { ?>
                        <span class="text"><?= $val ?></span>
                    <? } ?>
                    <span class="but">Подробнее</span>
                </span>
                <span class="img"><img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"></span>
            </a>
        <? } ?>
    </div>
    <p class="title bdt">Материалы</p>
    <div class="clearfix">
        <? foreach ($arResult["MATERIALS"] as $arItem) { ?>                  
            <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="cart_mini">
                <span class="label"><?= $arItem["PROPERTIES"]["FIRE_RESIST"]["VALUE"] ?></span>
                <span class="name"><span><?= $arItem["NAME"] ?></span></span>
                <span class="img"><img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"></span>
                <? foreach ($arItem["PROPS"] as $prop) { ?>
                    <span class="text"><?= $prop["NAME"] ?>: <?= $prop["VALUE"] ?></span>
                <? } ?>
                <span class="but">Подробнее</span>
            </a>
        <? } ?>
        <div class="form">
            <div class="front js_front">
                <p class="title">Консультация специалиста</p>
                <p class="phone"><?= VELCOM ?></p>
                <p class="phone mg"><?= MTS ?></p>
                <p class="title">Обратный звонок</p>
                <p class="text">Консультант перезвонит в течение<br> рабочего дня с 9:00 до 18:00</p>
                <button class="but" data-change=".js_front .js_back">Заказать звонок</button>
            </div>
            <form action="/requests/consul.php" method="post" class="back js_back js_validate">
                <i class="close" data-change=".js_back .js_front">×</i>
                <p class="title">Заполните форму</p>
                <input type="hidden" name="from" value="//<?= $_SERVER["HTTP_HOST"] ?><?= $_SERVER["REQUEST_URI"] ?>">
                <div class="field js_input js_class_valid">
                    <span>Имя</span><input data-valid="name" data-valid-min="2" type="text" name="name">
                </div>
                <div class="field js_input js_class_valid">
                    <span>Телефон</span><input type="text" data-valid="phone" name="phone">
                </div>
                <p class="text">Консультант перезвонит в течение<br> рабочего дня с 9:00 до 18:00</p>
                <button type="submit" class="but">Заказать звонок</button>
            </form>
            <script>
                $(function () {
                    var validator = new Validator();
                })
            </script>
        </div>
    </div>
</div>