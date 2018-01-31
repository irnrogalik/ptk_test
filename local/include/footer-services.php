<?
CModule::IncludeModule('iblock');
$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DETAIL_PAGE_URL");
$arFilter = Array("IBLOCK_ID" => 1, "ACTIVE" => "Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while ($ob = $res->GetNextElement()) {
    $arFields = $ob->GetFields();
    $services[] = $arFields;
}
?>
<div class="fll list col1">
    <a href="/uslugi/" class="name">Услуги</a>
    <? foreach ($services as $service) { ?>
        <a class="link" href="<?= $service["DETAIL_PAGE_URL"] ?>"><span><?= $service["NAME"] ?></span></a>
    <? } ?>
</div>