<div class="col fll usefull">
				<a href="/poleznaya-informaciya/" class="link_title">
					<span class="title">Полезная информация</span>
				</a>
				<?foreach($arResult["ITEMS"] as $k => $arItem) { ?>
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="artic <?=$k ==0?"nopd":""?>">
					<span class="name"><?=$arItem["NAME"]?></span>
					<span class="date"><?=$arItem["DISPLAY_ACTIVE_FROM"]?></span>
					<span class="text"><?=$arItem["PREVIEW_TEXT"]?></span>
				</a>
				<? } ?>
			</div>