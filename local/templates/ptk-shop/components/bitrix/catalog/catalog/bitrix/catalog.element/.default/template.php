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
?>
<div class="fix_area js_fix_area">
    <div class="img"><img src="<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>" alt="<?= $arResult["DETAIL_PICTURE"]["ALT"] ?>"></div>
    <div class="front js_front">
        <p class="title">Консультация специалиста</p>
        <p class="phone"><?= VELCOM ?></p>
        <p class="phone mg"><?= MTS ?></p>
        <p class="title">Обратный звонок</p>
        <p class="text">Консультант перезвонит в течение<br> рабочего дня с 9:00 до 18:00</p>
        <button class="but" data-change=".js_front .js_back">Заказать звонок</button>
    </div>
    <form action="/requests/consul.php" method="post" class="back js_validate js_back">
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
</div>
<script>
    $(function () {

        var validator = new Validator();

        fix_worker();

        var img_detail = $('.js_img_detail');

        $('[data-big-src]').on('click', function () {
            img_detail.attr('src', $(this).attr('data-big-src'));
        });

    })
</script>

<? echo $arResult["~DETAIL_TEXT"];
?>
<div class="modal fade" tabindex="0" id="imgModal" role="dialog">
    <div class="modal-dialog imgModal">
        <div class="modal-content">
            <img src="" alt="" class="js_img_detail">
        </div>
    </div>
</div>