<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();
/**
 * @global array $arParams
 * @global CUser $USER
 * @global CMain $APPLICATION
 * @global string $cartId
 */
$compositeStub = (isset($arResult['COMPOSITE_STUB']) && $arResult['COMPOSITE_STUB'] == 'Y');
?>


    <a href="<?= $arParams["PATH_TO_BASKET"] ?>" id="<?= $cartId ?>" class="top_caret__link">
        <span class="top_caret__ico ">
            <? include("img/n_application.svg"); ?>
            <span class="top_caret__icoNum js_top_basket_aim <?= $arResult["NUM_PRODUCTS"] == 0 ? "n_invisible" : "" ?>"><?= $arResult["NUM_PRODUCTS"] ?></span> 
            <!--доабвлять этому элементу класс n_invisible, если корзина пустая-->  
        </span>
        <span class="top_caret__text n_link n_link-inherit n_link-dotted ">Оформление заявки</span>
    </a>
