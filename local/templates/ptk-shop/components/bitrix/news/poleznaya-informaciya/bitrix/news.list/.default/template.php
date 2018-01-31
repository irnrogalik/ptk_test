<div class="news wrap clearfix">
<h1 class="title main">Полезная информация</h1>
<div class="content fll">
	<?
	for($i = 0; $i < 3; $i++){ 
	$arItem = $arResult["ITEMS"][$i];
	?>
	<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="block clearfix <?= ($i == 0)?"top":"";?>">
		<span class="img"><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"></span>
		<span class="info">
			<span class="name title"><?=$arItem["NAME"]?></span>
			<span class="date"><?=$arItem["DISPLAY_ACTIVE_FROM"]?></span>
			<span class="text"><?=$arItem["PREVIEW_TEXT"]?></span>
		</span>
	</a>
	<? } ?>
	
</div>
<div class="sidebar flr">
	<?
	for($i = 3; $i < 6; $i++){ 
	$arItem = $arResult["ITEMS"][$i];
	?>
	<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="block clearfix">
		<span class="name title"><?=$arItem["NAME"]?></span>
		<span class="date"><?=$arItem["DISPLAY_ACTIVE_FROM"]?></span>
		<span class="text"><?=$arItem["PREVIEW_TEXT"]?></span>
	</a>
	<? } ?>
</div>
</div>