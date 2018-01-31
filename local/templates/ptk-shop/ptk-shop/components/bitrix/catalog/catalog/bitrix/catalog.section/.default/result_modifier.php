<?

function prepareMatItem($arItem) {
	foreach($arItem["PROPERTIES"] as $code => $val) {
		if(!$val["VALUE"]) {
			continue;
		}
		if(strpos($code, "PROP_") !== false) {
			$arItem["PROPS"][] = $val;
			unset($arItem["PROPERTIES"][$code]);
		}
	}
	return $arItem;
}
$arResult["MATERIALS"] = [];

foreach($arResult["ITEMS"] as $k => $arItem) {
	if($arItem["IBLOCK_SECTION_ID"] == 2) {
		$arResult["MATERIALS"][] = prepareMatItem($arItem);
		unset($arResult["ITEMS"][$k]);
	}
}

