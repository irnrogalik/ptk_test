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

$depthLevel = $arResult["SECTION"]["DEPTH_LEVEL"];
if ($depthLevel == 0) {
    if (!empty($arResult["SECTIONS"])) {
        ?>
        <div class = "n_page wrap n_catalog_wrap justified_container js_complex">
            <?
            $res = CIBlock::GetByID($arParams["IBLOCK_ID"]);
            if ($ar_res = $res->GetNext()) {
                ?>
                <main class = "n_catalog__main">
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
            </main>
        </div>
        <script>
            $(function () {
                fix_worker();
            })
        </script>
        <?
    }
} else {
    echo $arResult["SECTION"]["~DESCRIPTION"];

    foreach ($arResult["SECTIONS"] as $arSection) {
        ?>
        <p><?= $arSection["NAME"]; ?></p> <a href="<?= $arSection["SECTION_PAGE_URL"] ?>">Весь ассортимент</a>
        <?
        if ($arSection["ITEMS"]) {
            foreach ($arSection["ITEMS"] as $arItem) {
                ?>
                <img src="<?= CFile::GetPath($arItem["DETAIL_PICTURE"]) ?>" alt="<?= $arSection["NAME"] ?>" width="100">
                <p><?= $arItem["NAME"] ?></p>
                <?
                if ($arItem["PROPS"]) {

                    foreach ($arItem["PROPS"] as $arSectionProps) {
                        ?>
                        <p><?= $arSectionProps["NAME"] ?>  -  <?= $arSectionProps["VALUE"] ?></p>
                        <?
                    }
                }
                ?>
                <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>">Подробнее</a><br><br><br><br>
                <?
            }
        }
        ?>
        <?
    }
}
?>