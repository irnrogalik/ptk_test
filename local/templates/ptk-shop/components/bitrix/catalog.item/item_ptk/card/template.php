<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $item
 * @var array $actualItem
 * @var array $minOffer
 * @var array $itemIds
 * @var array $price
 * @var array $measureRatio
 * @var bool $haveOffers
 * @var bool $showSubscribe
 * @var array $morePhoto
 * @var bool $showSlider
 * @var string $imgTitle
 * @var string $productTitle
 * @var string $buttonSizeClass
 * @var CatalogSectionComponent $component
 */
//print_r($item);
//die();
//$need_prop = ["PROP_CONSTANSE", "PROP_COLOuR", "PROP_CARTS", "PROP_SIZE", "DIAMETER", "CONCENTRATE"];
?>
<a href="<?= $item['DETAIL_PAGE_URL'] ?>" id="<?= $areaId ?>" >
    <div class="n_snipet__img n_img">
        <?
        if (is_array($item["PREVIEW_PICTURE"]) || is_array($item["PREVIEW_PICTURE"])) {
            $src = $item["PREVIEW_PICTURE"]["SRC"] ? $item["PREVIEW_PICTURE"]["SRC"] : $item["DETAIL_PICTURE"]["SRC"];
            $alt = $item["PREVIEW_PICTURE"]["ALT"] ? $item["PREVIEW_PICTURE"]["ALT"] : $item["DETAIL_PICTURE"]["ALT"];
        } else {
            $src = CFile::GetPath($item["PREVIEW_PICTURE"] ? $item["PREVIEW_PICTURE"] : $item["DETAIL_PICTURE"]);
            $alt = $item["NAME"];
        }
        ?>
        <img src="<?= $src ?>" alt="<?= $alt ?>">
    </div>
    <div class="n_snipet__title">
        <p class="n_link n_link-inherit"><?= $item["NAME"] ?></p>
    </div>
    <div class="n_snipet__details">
        <? if (!empty($item["OFFERS"])) { ?>
            <div class = "n_snipet__details_item">
                <?
                $num_prop = [];
                $sort_num_prop = [];
                foreach ($item["OFFERS"] as $arOffer) {
                    $num_prop[] = $arOffer["PROPERTIES"]["VOLUME"]["VALUE"] ? $arOffer["PROPERTIES"]["VOLUME"]["VALUE"] : $arOffer["PROPERTIES"]["QUANTITY"]["VALUE"];
                }
                sort($num_prop);

                foreach ($num_prop as $key => $num) {
                    if ($key == 0) {
                        $prop = $num;
                    } else {
                        $prop .= ", " . $num;
                    }
                }
                ?>
                <span><?= $item["OFFERS"][0]["PROPERTIES"]["VOLUME"]["VALUE"] ? $item["OFFERS"][0]["PROPERTIES"]["VOLUME"]["NAME"] : $item["OFFERS"][0]["PROPERTIES"]["QUANTITY"]["NAME"] ?>:</span>
                <span><?= $prop ?></span>
            </div>
        <? } ?>
        <?
        foreach ($item["PROPERTIES"] as $prop) {
            if (!in_array($prop["CODE"], NEED_PROPS))
                continue;
            if (!empty($prop["VALUE"])) {
                ?>
                <div class = "n_snipet__details_item">
                    <span><?= $prop["NAME"] ?>:</span>
                    <span><?= $prop["VALUE"] ?></span>
                </div>
                <?
            }
        }
        ?>
    </div>
    <div class = "n_snipet__button_wrap">
        <span class = "n_button n_button-transparent">Подробнее</span>
    </div>
</a>