<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<?
echo $arResult["~DETAIL_TEXT"];
if($arResult["MATERIALS"]) {
?>
<div class="wrap">
<div class="dop_materials">
	<p class="title">Материалы для огнезащиты</p>
	<ul class="clearfix">
		<?foreach($arResult["MATERIALS"] as $material) {
                    if ($arResult["ID"] == 6 && $material["CODE"] != "lak-stabiterm-107") continue;?>
		<li>
			<a href="<?=$material["DETAIL_PAGE_URL"]?>">
				<img src="<?=$material["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$material["PREVIEW_PICTURE"]["ALT"]?>">
				<span class="name"><?=$material["NAME"]?></span>
			</a>
		</li>
		<? } ?>
	</ul>
</div>
</div>
<? } ?>