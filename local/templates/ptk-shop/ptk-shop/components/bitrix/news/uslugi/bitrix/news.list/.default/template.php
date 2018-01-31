		<div class="services_page wrap">
			<h1 class="title">Услуги пассивной противопожарной безопасности строительных конструкций</h1>
			<?
			$i = 0;
			$arItem = $arResult["ITEMS"][$i++];
			?>
			<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="block big cir1">
				<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>">
				<span class="name title"><span><?=$arItem["NAME"]?></span></span>
				<?=$arItem["~PREVIEW_TEXT"]?>
			</a>
			<div class="clearfix">
			<?

			$arItem = $arResult["ITEMS"][$i++];
			?>
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="block fll">
					<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>">
					<span class="name title"><span><?=$arItem["NAME"]?></span></span>
					<?=$arItem["~PREVIEW_TEXT"]?>
				</a>
				<?

			$arItem = $arResult["ITEMS"][$i++];
			?>
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="block fll">
					<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>">
					<span class="name title"><span><?=$arItem["NAME"]?></span></span>
					<?=$arItem["~PREVIEW_TEXT"]?>
				</a>
			</div>
			<?

			$arItem = $arResult["ITEMS"][$i++];
			?>
			<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="block big cir2">
				<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>">
				<span class="name title"><span><?=$arItem["NAME"]?></span></span>
				<?=$arItem["~PREVIEW_TEXT"]?>
			</a>
			<div class="clearfix">
<?
			$arItem = $arResult["ITEMS"][$i++];
			?>
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="block fll">
					<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>">
				<span class="name title"><span><?=$arItem["NAME"]?></span></span>
				<?=$arItem["~PREVIEW_TEXT"]?>
				</a>
				<?

			$arItem = $arResult["ITEMS"][$i++];
			?>
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="block fll">
					<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>">
				<span class="name title"><span><?=$arItem["NAME"]?></span></span>
				<?=$arItem["~PREVIEW_TEXT"]?>
				</a>
			</div>
		</div>