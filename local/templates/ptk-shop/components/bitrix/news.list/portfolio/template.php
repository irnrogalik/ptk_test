<?if(!empty($arResult["ITEMS"])) { ?>
			<div class="projects">
				<div class="wrap">
					<?if($arParams["LINK_TITLE"]) { ?>
						<a href="<?=$arParams["LINK_TITLE"]?>" class="link_title">
							<span class="title">Реализованные объекты компании «ПТК-Защита»</span>
						</a>
					<? } else { ?>
						<h1 class="title">Реализованные объекты компании «ПТК-Защита»</h1>
					<? } ?>
					<div class="row_slider js_row_slider">
						<div class="wrapper">
							<ul class="js_carret clearfix">
								<?foreach($arResult["ITEMS"] as $k => $arItem) { ?>
								<li class="js_li <?=($k==0)?"active":"";?>" data-tab="<?=$k?>">
										<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>">
										<p class="name"><?=$arItem["NAME"]?></p>
									</li>
								<? } ?>
							</ul>
						</div>
						<div class="control next js_next"></div>
						<div class="control prev js_prev"></div>
					</div>
				</div>
				<?foreach($arResult["ITEMS"] as $k => $arItem) { ?>
					<div class="detail" data-tab-inf="<?=$k?>">
						<div class="wrap clearfix">
							<div class="fll info">
								<table>
									<?foreach($arItem["TABLE"] as $key => $row) {?>
									<tr>
										<td><?=$row["NAME"]?>: </td>
										<td><?=$key==0?'<span class="blue">':'';?><?=htmlspecialchars_decode($row["VALUE"])?><?=$key==0?'</span>':'';?></td>
									</tr>
									<? } ?>
								</table>
								<div class="res">
									<b class="blue">Результат:</b>
									<p><?=htmlspecialchars_decode($arItem["PROPERTIES"]["RESULT"]["VALUE"]["TEXT"]);?></p>
								</div>

							</div>
							<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" class="flr">
						</div>
					</div>
				<? } ?>
				<script>
					$(function () {
		                row_slider({
		                    parent_query: $('.js_row_slider'),
		                    width_element_with_margin: 195,
		                    number_of_visible_elements: 5
		                });
		                $('[data-tab-inf]').hide();
		                $('[data-tab-inf="'+$('.active[data-tab]').attr('data-tab')+'"]').show();
		                $('li[data-tab]').on('click',function() {
		                	var tab = $(this).attr('data-tab');
		                	$('li[data-tab]').removeClass('active');
		                	$(this).addClass('active');
		                	$('li[data-tab='+$(this).data('tab')+']').addClass('active');
		                	$('[data-tab-inf]').hide();
		                	$('[data-tab-inf="'+tab+'"]').show();
		                })
		            })
				</script>
			</div>
<? } ?>