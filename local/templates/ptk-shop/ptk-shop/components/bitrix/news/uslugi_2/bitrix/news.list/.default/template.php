<div class="services wrap clearfix">
			<p class="title">Услуги пассивной противопожарной безопасности от «ПТК-Защита»</p>
			<div class="left fll">
				<?
				$i = 0;
				$arItem = $arResult["ITEMS"][$i++];
				?>
				<a href="<?=$arItem["DETAIL_PAGE_URL"];?>" class="block">
					<img src="<?=$arItem["DETAIL_PICTURE"]["SRC"];?>" alt="<?=$arItem["DETAIL_PICTURE"]["ALT"];?>">
					<p class="text"><?=$arItem["NAME"];?></p>
				</a>
			</div>
			<div class="right flr">
				<div class="clearfix mgb">
					<?
					$arItem = $arResult["ITEMS"][$i++];
					?>
					<a href="<?=$arItem["DETAIL_PAGE_URL"];?>" class="block">
						<img src="<?=$arItem["DETAIL_PICTURE"]["SRC"];?>" alt="<?=$arItem["DETAIL_PICTURE"]["ALT"];?>">
						<p class="text"><?=$arItem["NAME"];?></p>
					</a>
					<?
					$arItem = $arResult["ITEMS"][$i++];
					?>
					<a href="<?=$arItem["DETAIL_PAGE_URL"];?>" class="block long">
						<img src="<?=$arItem["DETAIL_PICTURE"]["SRC"];?>" alt="<?=$arItem["DETAIL_PICTURE"]["ALT"];?>">
						<p class="text"><?=$arItem["NAME"];?></p>
					</a>
					<p class="quot">Огнезащитные материалы прошли испытания на полигоне МЧС в Борисовском районе, Минской области, Республики Беларусь <br>и имеют действующие разрешительные документы</p>
				</div>
				<div class="clearfix">
					<?
					$arItem = $arResult["ITEMS"][$i++];
					?>
					<a href="<?=$arItem["DETAIL_PAGE_URL"];?>" class="block ">
						<img src="<?=$arItem["DETAIL_PICTURE"]["SRC"];?>" alt="<?=$arItem["DETAIL_PICTURE"]["ALT"];?>">
						<p class="text"><?=$arItem["NAME"];?></p>
					</a>
					<?
					$arItem = $arResult["ITEMS"][$i++];
					?>
					<a href="<?=$arItem["DETAIL_PAGE_URL"];?>" class="block ">
						<img src="<?=$arItem["DETAIL_PICTURE"]["SRC"];?>" alt="<?=$arItem["DETAIL_PICTURE"]["ALT"];?>">
						<p class="text"><?=$arItem["NAME"];?></p>
					</a>
					<?
					$arItem = $arResult["ITEMS"][$i++];
					?>
					<a href="<?=$arItem["DETAIL_PAGE_URL"];?>" class="block ">
						<img src="<?=$arItem["DETAIL_PICTURE"]["SRC"];?>" alt="<?=$arItem["DETAIL_PICTURE"]["ALT"];?>">
						<p class="text"><?=$arItem["NAME"];?></p>
					</a>
				</div>
			</div>
		</div>