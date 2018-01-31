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
//$need_prop = ["PROP_CONSTANSE", "PROP_COLOuR", "PROP_CARTS", "PROP_SIZE", "DIAMETER", "CONCENTRATE"];
?>

<a class = "" href = "<?= $item['DETAIL_PAGE_URL'] ?>" title = "<?= $imgTitle ?>">
    <img src = "<?= $item["DETAIL_PICTURE"]["SRC"] ?>" class="myclass">
    <p><?= $item["NAME"] ?></p>
    <?
    foreach ($item["PROPERTIES"] as $prop) {
        if (!in_array($prop["CODE"], NEED_PROPS))
            continue;
        if (!empty($prop["VALUE"])) {
            ?>
            <p><?= $prop["NAME"] ?> <?= $prop["VALUE"] ?></p>
            <?
        }
    }
    ?>
    Подробнее</a>



