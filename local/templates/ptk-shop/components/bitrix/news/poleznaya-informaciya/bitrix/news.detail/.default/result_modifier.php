<?
$arSelect = Array("ID", "IBLOCK_ID", "NAME", "ACTIVE_FROM", "DETAIL_PAGE_URL", "PREVIEW_TEXT");
$arFilter = Array("IBLOCK_ID"=>$arParams["IBLOCK_ID"], "!ID" => $arResult["ID"], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
while($ob = $res->GetNextElement())
{
	$arFields = $ob->GetFields();
	if($arFields["ACTIVE_FROM"]) {
		$arFields["DISPLAY_ACTIVE_FROM"] = FormatDate($arParams["ACTIVE_DATE_FORMAT"], MakeTimeStamp($arFields["ACTIVE_FROM"], CSite::GetDateFormat("FULL")));

	}
	$arResult["SIDEBAR"][] = $arFields;
}
?> 