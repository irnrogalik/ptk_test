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
/*
  ini_set('error_reporting', E_ALL);
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
 */
$depthLevel = $arResult["SECTION"]["DEPTH_LEVEL"];
?>
<? if ($depthLevel == 0) { ?>
    <!--<main class = "n_catalog__main">-->
    <?
    if (!empty($arResult["SECTIONS"])) {
        ?>
        <?
        $res = CIBlock::GetByID($arParams["IBLOCK_ID"]);
        if ($ar_res = $res->GetNext()) {
            ?>
            <h1 class = "n_title n_title-big"><?= $ar_res['NAME']; ?></h1>
            <div class = "n_box">
                <p class = "n_text" ><?= $ar_res['~DESCRIPTION']; ?></p>
                <div class = "n_factoid-text">
                    <p>Товары сертифицированы в Республике Беларусь</p>
                </div>
            </div>
        <? } ?>
        <?
        foreach ($arResult["SECTIONS"] as $arSection) {
            ?>
            <div class = "n_box">
                <h2 class = "n_title n_title-middle"><?= $arSection["NAME"] ?></h2>
                <p class = "n_text"><?= $arSection["~DESCRIPTION"] ?></p>
                <p class = "n_text">
                    <a href = "<?= $arSection["SECTION_PAGE_URL"] ?>" class = " n_catalog_link n_link n_link-dotted">Весь ассортимент</a>
                </p>
            </div>
            <? if ($arSection["CHILD"]) { ?>
                <ul class = "n_catalog_sublist"><?
                    foreach ($arSection["CHILD"] as $sChild) {
                        ?>
                        <li class = "n_catalog_sublist_item"><a href = "<?= $sChild["SECTION_PAGE_URL"] ?>">
                                <img src = "<?= $sChild["PICTURE"]["SRC"] ?>" alt = "<?= $sChild["PICTURE"]["ALT"] ?>">
                                <span class = "n_link n_link-inherit"><?= $sChild["NAME"] ?></span></a>
                        </li>
                    <? } ?>
                </ul>
            <? } ?>                    
        <? } ?>
    <? }
    ?>
    <!--</main>-->
    <?
} else {
    ?>
    <? if (!empty($arResult["SECTIONS"])) { ?>
        <!--<main class="n_catalog__main">-->   
        <h1 class="n_title n_title-big"><?= $arResult["SECTION_INFO"]["NAME"] ?></h1>
        <div class="n_box">
            <p class="n_text"><?= $arResult["SECTION_INFO"]["TEXT_1"] ?></p>
            <div class="n_factoid-text">
                <p><?= $arResult["SECTION_INFO"]["NOTE_SECTION"] ?></p>
            </div>                    
        </div>
        <? if (isset($arResult["SECTION_INFO"]["TEXT_2"])) { ?>
            <div class="n_box">
                <div class="n_text n_text-narrow"><?= $arResult["SECTION_INFO"]["TEXT_2"]; ?></div>
                <? if (isset($arResult["SECTION_INFO"]["FACTOID_PICTURE"]) || isset($arResult["SECTION_INFO"]["FACTOID_TEXT"])) { ?>
                    <div class="n_factoid-circ">
                        <div class="circ__content circ__content-<?= ($arResult["SECTION_INFO"]["FACTOID_PICTURE"] && $arResult["SECTION_INFO"]["FACTOID_TEXT"]) ? "multi" : ($arResult["SECTION_INFO"]["FACTOID_TEXT"] ? "single" : "") ?>">
                            <? if (isset($arResult["SECTION_INFO"]["FACTOID_PICTURE"])) { ?>
                                <img class="circ_ico" src="<?= CFile::GetPath($arResult["SECTION_INFO"]["FACTOID_PICTURE"]) ?>" alt="<?= $arResult["SECTION_INFO"]["NAME"] ?>">
                            <? } ?>
                            <p class="circ_text"><?= $arResult["SECTION_INFO"]["FACTOID_TEXT"] ?></p>
                        </div>
                    </div>
                <? } ?>
            </div>
        <? } ?>

        <?
        foreach ($arResult["SECTIONS"] as $arSection) {
            ?>                      
            <div class="n_categorybox justified_container">
                <div class="n_category__head justified_container">
                    <h2 class="n_title n_title-middle"><?= $arSection["NAME"]; ?></h2>
                    <a href="<?= $arSection["SECTION_PAGE_URL"] ?>" class=" n_catalog_link n_link n_link-dotted">Весь ассортимент</a>
                </div>
                <?
                if ($arSection["ITEMS"]) {
                    foreach ($arSection["ITEMS"] as $item) {
                        ?>
                        <div class="n_snipet">
                            <?
                            $APPLICATION->IncludeComponent(
                                    'bitrix:catalog.item', 'item_ptk', array(
                                'RESULT' => array(
                                    'ITEM' => $item,
                                    'TYPE' => "card",
                                    'BIG_LABEL' => 'N',
                                    'BIG_DISCOUNT_PERCENT' => 'N',
                                    'BIG_BUTTONS' => 'N',
                                    'SCALABLE' => 'N'
                                ),
                                'PARAMS' => $arParams), $component, array('HIDE_ICONS' => 'Y')
                            );
                            ?>
                        </div>
                        <?
                    }
                }
                ?>
            </div>
        <? } ?>                 

    <? } ?>
    <!--</main>-->
<? } ?>
