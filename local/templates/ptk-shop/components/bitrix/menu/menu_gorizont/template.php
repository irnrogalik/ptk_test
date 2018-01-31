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
//print_r($arResult);
if (empty($arResult["ALL_ITEMS"]))
    return;

CUtil::InitJSCore();

if (file_exists($_SERVER["DOCUMENT_ROOT"] . $this->GetFolder() . '/themes/' . $arParams["MENU_THEME"] . '/colors.css'))
    $APPLICATION->SetAdditionalCSS($this->GetFolder() . '/themes/' . $arParams["MENU_THEME"] . '/colors.css');

$menuBlockId = "catalog_menu_" . $this->randString();
?>
<nav class="n_menu">
    <ul class="n_menu_item_wrap">
        <? foreach ($arResult["MENU_STRUCTURE"] as $itemID => $arColumns) { ?>     <!-- first level-->           
            <li class="n_menu_item">
                <a href="<?= $arResult["ALL_ITEMS"][$itemID]["LINK"] ?>" class="n_link n_link-inherit <?= $arResult["ALL_ITEMS"][$itemID]["SELECTED"] ? "active" : "" ?>"> <?= $arResult["ALL_ITEMS"][$itemID]["TEXT"] ?></a>          
                <? if (is_array($arColumns) && count($arColumns) > 0) { ?>                   

                    <? foreach ($arColumns as $key => $arRow) { ?>
                        <ul class="n_menu_item_wrap">
                            <? foreach ($arRow as $itemIdLevel_2 => $arLevel_3) { ?>  <!-- second level-->
                                <li class="n_menu_item">
                                    <a href="<?= $arResult["ALL_ITEMS"][$itemIdLevel_2]["LINK"] ?>" class="n_link n_link-inherit <?= $arResult["ALL_ITEMS"][$itemIdLevel_2]["SELECTED"] ? "active" : "" ?>"><?= $arResult["ALL_ITEMS"][$itemIdLevel_2]["TEXT"] ?></a>     
                                </li>
                            <? } ?>
                        </ul>
                    <? } ?>                    
                <? } ?>
            </li>
        <? } ?>
    </ul>   
</nav>


<script>
    BX.ready(function () {
        window.obj_<?= $menuBlockId ?> = new BX.Main.Menu.CatalogHorizontal('<?= CUtil::JSEscape($menuBlockId) ?>', <?= CUtil::PhpToJSObject($arResult["ITEMS_IMG_DESC"]) ?>);
    });
</script>