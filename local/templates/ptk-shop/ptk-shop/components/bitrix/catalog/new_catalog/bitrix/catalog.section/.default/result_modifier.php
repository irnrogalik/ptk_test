<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */
$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

$arFilter = Array("IBLOCK_ID" => 4, "ID" => $arResult["ID"]);

$rsSect = CIBlockSection::GetList(Array("SORT" => "ACS"), $arFilter, false, array("NAME", "IBLOCK_ID", "UF_*"));
while ($arSect = $rsSect->GetNext()) {
    $arResult["SECTION_INFO"]["NAME"] = $arSect["NAME"];
    $arResult["SECTION_INFO"]["TEXT_1"] = $arSect["UF_TEXT_1"];
    $arResult["SECTION_INFO"]["TEXT_2"] = $arSect["UF_TEXT_2"];
    $arResult["SECTION_INFO"]["NOTE_SECTION"] = $arSect["UF_NOTE_SECTION"];
    $arResult["SECTION_INFO"]["FACTOID_TEXT"] = $arSect["UF_FACTOID_TEXT"];
    $arResult["SECTION_INFO"]["FACTOID_PICTURE"] = $arSect["UF_FACTOID_PICTURE"];
}


