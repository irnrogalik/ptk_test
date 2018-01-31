<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */

/** @var array $arResult */
use Bitrix\Main;

$arResult["GRID"]["HEADERS"][] = ["id" => "PROPERTY_ATRIBUT_VALUE", "name" => "Атрибут"];

$order = ["NAME", "PROPERTY_ATRIBUT_VALUE", "PRICE", "QUANTITY", "SUM", "DELETE"];

$res = [];
foreach ($arResult["GRID"]["HEADERS"] as $arSort) {
    $res[$arSort['id']] = $arSort;
}

foreach ($order as $arOrder) {
    $result[] = $res[$arOrder];
}
unset($arResult["GRID"]["HEADERS"]);
$arResult["GRID"]["HEADERS"] = $result;

//$need_prop = ["PROPERTY_PROP_CONSTANSE_VALUE", "PROPERTY_PROP_COLOUR_VALUE", "PROPERTY_PROP_SIZE_VALUE", "PROPERTY_DIAMETER_VALUE", "PROPERTY_VOLUME_VALUE", "PROPERTY_VOLUME_VALUE"];
foreach ($arResult["GRID"]["ROWS"] as &$gridRows) {
    $props = "";
    foreach (NEED_PROPS_BASKET as $key => $value) {
        if (isset($gridRows[$value])) {
            $props = $gridRows[$value] . ($value == "PROPERTY_VOLUME_VALUE" ? " л" : ($value == "PROPERTY_QUANTITY_VALUE" ? " шт" : ""));
        }
    }
    $gridRows["PROPERTY_ATRIBUT_VALUE"] = $props;
}
