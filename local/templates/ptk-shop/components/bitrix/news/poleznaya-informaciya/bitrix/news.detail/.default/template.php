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

<div class="news detail wrap clearfix">
			<div class="content fll">
				<h1 class="title main"><?=$arResult["NAME"]?></h1>
				<p class="date"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></p>
				<img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?$arResult["DETAIL_PICTURE"]["SRC"]:$arResult["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>">
				<div class="text">
					<?=$arResult["~DETAIL_TEXT"]?>
				</div>
			</div>
	<?if($arResult["SIDEBAR"]) { ?>
			<div class="sidebar flr">
				<?foreach($arResult["SIDEBAR"] as $sideItem) { ?>
				<a href="<?=$sideItem["DETAIL_PAGE_URL"]?>" class="block clearfix">
					<span class="name title"><?=$sideItem["NAME"]?></span>
					<span class="date"><?=$sideItem["DISPLAY_ACTIVE_FROM"]?></span>
					<span class="text"><?=$sideItem["PREVIEW_TEXT"]?></span>
				</a>
				<? } ?>
			</div>
	<? } ?>
		</div>