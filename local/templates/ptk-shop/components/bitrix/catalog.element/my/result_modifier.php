<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */
$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

$arResult["AVAIL_OFFERS"] = "true";
if ($arResult["OFFERS"]) {
    foreach ($arResult["OFFERS"] as $arOffer) {
        if ($arOffer["PROPERTIES"]["AVAILABILITY"]["VALUE_XML_ID"] != "Y") {
            $count_avail++;
        }
    }
//    echo "SDF";
//    print_r($count_avail);
    if ($count_avail == count($arResult["OFFERS"])) {
        $arResult["AVAIL_OFFERS"] = "false";
    }
}

//print_r($arResult);