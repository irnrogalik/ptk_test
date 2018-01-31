<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

$arViewModeList = array('LIST', 'LINE', 'TEXT', 'TILE');

$arDefaultParams = array(
    'VIEW_MODE' => 'LIST',
    'SHOW_PARENT_NAME' => 'Y',
    'HIDE_SECTION_NAME' => 'N'
);

$arParams = array_merge($arDefaultParams, $arParams);

if (!in_array($arParams['VIEW_MODE'], $arViewModeList))
    $arParams['VIEW_MODE'] = 'LIST';
if ('N' != $arParams['SHOW_PARENT_NAME'])
    $arParams['SHOW_PARENT_NAME'] = 'Y';
if ('Y' != $arParams['HIDE_SECTION_NAME'])
    $arParams['HIDE_SECTION_NAME'] = 'N';

$arResult['VIEW_MODE_LIST'] = $arViewModeList;

if (0 < $arResult['SECTIONS_COUNT']) {
    if ('LIST' != $arParams['VIEW_MODE']) {
        $boolClear = false;
        $arNewSections = array();
        foreach ($arResult['SECTIONS'] as &$arOneSection) {
            if (1 < $arOneSection['RELATIVE_DEPTH_LEVEL']) {
                $boolClear = true;
                continue;
            }
            $arNewSections[] = $arOneSection;
        }
        unset($arOneSection);
        if ($boolClear) {
            $arResult['SECTIONS'] = $arNewSections;
            $arResult['SECTIONS_COUNT'] = count($arNewSections);
        }
        unset($arNewSections);
    }
}

if (0 < $arResult['SECTIONS_COUNT']) {
    $boolPicture = false;
    $boolDescr = false;
    $arSelect = array('ID');
    $arMap = array();
    if ('LINE' == $arParams['VIEW_MODE'] || 'TILE' == $arParams['VIEW_MODE']) {
        reset($arResult['SECTIONS']);
        $arCurrent = current($arResult['SECTIONS']);
        if (!isset($arCurrent['PICTURE'])) {
            $boolPicture = true;
            $arSelect[] = 'PICTURE';
        }
        if ('LINE' == $arParams['VIEW_MODE'] && !array_key_exists('DESCRIPTION', $arCurrent)) {
            $boolDescr = true;
            $arSelect[] = 'DESCRIPTION';
            $arSelect[] = 'DESCRIPTION_TYPE';
        }
    }
    if ($boolPicture || $boolDescr) {
        foreach ($arResult['SECTIONS'] as $key => $arSection) {
            $arMap[$arSection['ID']] = $key;
        }
        $rsSections = CIBlockSection::GetList(array(), array('ID' => array_keys($arMap)), false, $arSelect);
        while ($arSection = $rsSections->GetNext()) {
            if (!isset($arMap[$arSection['ID']]))
                continue;
            $key = $arMap[$arSection['ID']];
            if ($boolPicture) {
                $arSection['PICTURE'] = intval($arSection['PICTURE']);
                $arSection['PICTURE'] = (0 < $arSection['PICTURE'] ? CFile::GetFileArray($arSection['PICTURE']) : false);
                $arResult['SECTIONS'][$key]['PICTURE'] = $arSection['PICTURE'];
                $arResult['SECTIONS'][$key]['~PICTURE'] = $arSection['~PICTURE'];
            }
            if ($boolDescr) {
                $arResult['SECTIONS'][$key]['DESCRIPTION'] = $arSection['DESCRIPTION'];
                $arResult['SECTIONS'][$key]['~DESCRIPTION'] = $arSection['~DESCRIPTION'];
                $arResult['SECTIONS'][$key]['DESCRIPTION_TYPE'] = $arSection['DESCRIPTION_TYPE'];
                $arResult['SECTIONS'][$key]['~DESCRIPTION_TYPE'] = $arSection['~DESCRIPTION_TYPE'];
            }
        }
    }
}
if ($arResult["SECTION"]["DEPTH_LEVEL"] == 0) {
    $sections = [];
    foreach ($arResult['SECTIONS'] as $key => $arSection) {
        if (empty($arSection["IBLOCK_SECTION_ID"])) {
            $sections[$arSection["ID"]] = $arSection;
        } else {
            $sections[$arSection["IBLOCK_SECTION_ID"]]["CHILD"][] = $arSection;
        }
    }
    unset($arResult['SECTIONS']);
    $arResult['SECTIONS'] = $sections;
} else {
    foreach ($arResult['SECTIONS'] as $key => $arSection) {
        $ids[] = $arSection["ID"];
    }

    $arSelect = Array("ID", "NAME", "DETAIL_PICTURE", "DETAIL_PAGE_URL", "IBLOCK_SECTION_ID", "PREVIEW_PICTURE");
    $arFilter = Array("IBLOCK_ID" => 4, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y", "SECTION_ID" => $ids);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        if (count($items[$arFields["IBLOCK_SECTION_ID"]]) > 1) {
            continue;
        }
        $arProp = $ob->GetProperties();
        foreach ($arProp as $key => $arP) {
            if (!in_array($arP["CODE"], NEED_PROPS))
                continue;
            if (!empty($arP["VALUE"])) {
                $arFields["PROPERTIES"][$key]["NAME"] = $arP["NAME"];
                $arFields["PROPERTIES"][$key]["VALUE"] = $arP["VALUE"];
                $arFields["PROPERTIES"][$key]["CODE"] = $arP["CODE"];
            }
        }

        $items[$arFields["IBLOCK_SECTION_ID"]][] = $arFields;
    }

    foreach ($arResult['SECTIONS'] as $key => &$arSection) {
        if (array_key_exists($arSection["ID"], $items)) {
            $arSection["ITEMS"] = $items[$arSection["ID"]];
        }
    }

    $arFilters = Array("IBLOCK_ID" => 4, "ID" => $arResult["SECTION"]["ID"]);

    $rsSect = CIBlockSection::GetList(Array("SORT" => "ACS"), $arFilters, false, array("NAME", "IBLOCK_ID", "UF_*"));
    while ($arSect = $rsSect->GetNext()) {
        $arResult["SECTION_INFO"]["NAME"] = $arSect["NAME"];
        $arResult["SECTION_INFO"]["TEXT_1"] = $arSect["~UF_TEXT_1"];
        $arResult["SECTION_INFO"]["TEXT_2"] = $arSect["~UF_TEXT_2"];
        $arResult["SECTION_INFO"]["NOTE_SECTION"] = $arSect["~UF_NOTE_SECTION"];
        $arResult["SECTION_INFO"]["FACTOID_TEXT"] = $arSect["~UF_FACTOID_TEXT"];
        $arResult["SECTION_INFO"]["FACTOID_PICTURE"] = $arSect["UF_FACTOID_PICTURE"];
    }
}
?>