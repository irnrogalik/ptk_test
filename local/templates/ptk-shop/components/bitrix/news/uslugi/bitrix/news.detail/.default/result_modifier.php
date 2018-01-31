<?

$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DETAIL_PAGE_URL", "PREVIEW_PICTURE", "CODE");
$arFilter = Array("IBLOCK_ID" => CATALOG_ID, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y", "SECTION_ID" => MATERIALS_SECTION_ID);
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while ($ob = $res->GetNextElement()) {
    $arFields = $ob->GetFields();
    $arResult["MATERIALS"][] = [
        "NAME" => $arFields["NAME"],
        "CODE" => $arFields["CODE"],
        "DETAIL_PAGE_URL" => $arFields["DETAIL_PAGE_URL"],
        "PREVIEW_PICTURE" => [
            "SRC" => CFile::GetPath($arFields["PREVIEW_PICTURE"]),
            "ALT" => $arFields["NAME"]
        ]
    ];
}
?> 