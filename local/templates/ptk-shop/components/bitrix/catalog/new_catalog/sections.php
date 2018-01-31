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
<div class = "n_page wrap n_catalog_wrap justified_container js_complex">
    <aside class="n_catalog__aside js_fix_area">
        <?
        $APPLICATION->IncludeComponent("bitrix:menu", "menu_gorizont", Array(
            "ROOT_MENU_TYPE" => "catalog", // Тип меню для первого уровня
            "MAX_LEVEL" => "3", // Уровень вложенности меню
            "CHILD_MENU_TYPE" => "catalog", // Тип меню для остальных уровней
            "USE_EXT" => "Y", // Подключать файлы с именами вида .тип_меню.menu_ext.php
            "DELAY" => "N", // Откладывать выполнение шаблона меню
            "ALLOW_MULTI_SELECT" => "Y", // Разрешить несколько активных пунктов одновременно
            "MENU_CACHE_TYPE" => "N", // Тип кеширования
            "MENU_CACHE_TIME" => "3600", // Время кеширования (сек.)
            "MENU_CACHE_USE_GROUPS" => "N", // Учитывать права доступа
            "MENU_CACHE_GET_VARS" => "", // Значимые переменные запроса
            "COMPONENT_TEMPLATE" => "catalog_horizontal",
            "MENU_THEME" => "site", // Тема меню
                ), false
        );
        ?> 
    </aside>
    <main class="n_catalog__main">   
        <?
        $APPLICATION->IncludeComponent(
                "bitrix:catalog.section.list", "", array(
            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
            "CACHE_TIME" => $arParams["CACHE_TIME"],
            "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
            "COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
            "TOP_DEPTH" => $arParams["SECTION_TOP_DEPTH"],
            "SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
            "VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
            "SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
            "HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
            "ADD_SECTIONS_CHAIN" => (isset($arParams["ADD_SECTIONS_CHAIN"]) ? $arParams["ADD_SECTIONS_CHAIN"] : '')
                ), $component, array("HIDE_ICONS" => "Y")
        );
        ?>
    </main>
</div>
<script>
    $(function () {
        fix_worker();
    })
</script>