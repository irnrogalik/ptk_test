<?
foreach($arResult["ITEMS"] as $k => &$arItem) {
	foreach($arItem["PROPERTIES"] as $code => $property) {
		if(!$property["VALUE"]) { continue; }
		if($property["USER_TYPE"] == "HTML") {
			$val = $property["VALUE"]["TEXT"];
		} else {
			$val = $property["VALUE"];
		}
		if(strpos($code,"CHARACKTER_") === 0) {
			$arItem["TABLE"][] = ["NAME" => $property["NAME"], "VALUE" => $val];
		}

	}
}
?>