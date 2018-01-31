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
if (!empty($arResult['ITEMS']))
{
?>
<div class="col flr slider_catal_main">
				<a href="/catalog/" class="link_title">
					<span class="title">Огнезащитные материалы</span>
				</a>
				<div class="mini_slider js_mini_slider">
					<div class="wrapper">
						<?foreach($arResult['ITEMS'] as $arItem) { ?>
						<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="js_slide slide">
							<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>">
							<p class="slider_link_wrap"><span class="n_link"><?=$arItem["NAME"]?></span></p>
						</a>
						<? } ?>

					</div>
					<ul class="navigation js_navigation"></ul>
					<div class="control js_control next"></div>
					<div class="control js_control prev"></div>
				</div>
				<p class="pseudo_but_wrap">
					<span class="pseudo_but name n_link n_link-modal ">Скачать каталог товаров и услуг</span>
					<!-- ссылку на файл указать в data-href -->
					<a href="#" download class="download_link hidden" data-href="/upload/Catalog_PTK-zaschita.pdf">Скачать &#8681;</a>
				</p>
			</div>
			<!--span class="jivo_button js-chat">Чат</span-->
		<script>
			$(function() {
				var damm = new DammSlider({
					query: $('.js_mini_slider'),
					start_slide: 0,
					speed: 300,
					offsetTop: 0,
					min_height: 0
				});
			})
			</script>
<?
}