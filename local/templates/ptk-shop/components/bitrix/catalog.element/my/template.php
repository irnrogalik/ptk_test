<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */
$this->setFrameMode(true);
//print_r($arResult);
//print_r(NEED_PROPS);
?>
<div class="catElement__wrap wrap n_page justified_container js_complex">

    <?
    if ($arResult["PROPERTIES"]["NEW_CARD"]["VALUE_ENUM_ID"] == 20) {
        ?>
        <main class="catElement__main">
            <h1 class="n_title n_title-big"><?= $arResult["NAME"] ?></h1>
            <div class="n_box">
                <p class="n_text"><?= $arResult["PREVIEW_TEXT"] ?></p>
                <? if (isset($arResult["PROPERTIES"]["NOTE"]["VALUE"])) { ?>
                <div class="n_factoid-text">
                    <p><?= $arResult["PROPERTIES"]["NOTE"]["VALUE"] ?></p>
                </div>
                <? } ?>
            </div>

            <?
            // применения 
            if (isset($arResult["PROPERTIES"]["APPLICATION"]["VALUE"]) || isset($arResult["PROPERTIES"]["FIRE_PROTECTION"]["VALUE"])) {
                ?>
                <div class="n_box">
                    <h2 class="n_title n_title-middle"><?= $arResult["PROPERTIES"]["APPLICATION"]["VALUE"] ? $arResult["PROPERTIES"]["APPLICATION"]["NAME"] : $arResult["PROPERTIES"]["FIRE_PROTECTION"]["NAME"] ?></h2>
                    <ul class="n_list">
                        <?
                        $values_array = $arResult["PROPERTIES"]["APPLICATION"]["VALUE"] ? $arResult["PROPERTIES"]["APPLICATION"]["VALUE"] : $arResult["PROPERTIES"]["FIRE_PROTECTION"]["VALUE"];
                        foreach ($values_array as $arAplication) {
                            ?>
                            <li><?= $arAplication ?></li>
                            <? } ?>
                        </ul>
                        <? if (isset($arResult["PROPERTIES"]["NOTE_FOR_APPLICATION"]["VALUE"])) { ?>
                        <div class="n_factoid-text">
                            <p><?= $arResult["PROPERTIES"]["NOTE_FOR_APPLICATION"]["VALUE"] ?></p>
                        </div>
                        <? } ?>
                        <? if ($arResult["IBLOCK_SECTION_ID"] == 7) { ?>
                        <div class="n_factoid-circ">
                            <div class="circ__content circ__content-single">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/img/n_img/pro-brite.png" alt="Pro-Brite">
                            </div>
                        </div>
                        <? } elseif ($arResult["IBLOCK_SECTION_ID"] == 4) { ?>
                        <div class="n_factoid-circ">
                            <div class="circ__content circ__content-multi">                                
                                <p class="circ_title">EI 150</p> 
                                <p class="circ_text">предел огнестойкости муфты</p>
                            </div>
                        </div>     
                        <? } ?>
                    </div>
                    <? } ?> 

                    <?
            // Технические характеристики
                    if (!empty($arResult["DISPLAY_PROPERTIES"])) {
                        ?>
                        <div class="n_table_wrap">
                            <h2 class="n_table_title">Технические характеристики</h2>
                            <div class="n_table">
                                <? foreach ($arResult["DISPLAY_PROPERTIES"] as $arDisplay) { ?>
                                <div class="n_table__row">
                                    <div class="n_table__cell"><?= strpos($arDisplay["NAME"], "(") ? stristr($arDisplay["NAME"], "(", true) : $arDisplay["NAME"] ?></div>
                                    <div class="n_table__cell"><?= $arDisplay["VALUE"] ?></div>
                                </div>
                                <? } ?>
                            </div>
                        </div>
                        <? } ?>

                        <?
            //схема муфты
                        if ($arResult["IBLOCK_SECTION_ID"] == 4) {
                            ?>
                            <div class="n_scheme__wrap n_mufta">
                                <h2 class="n_title n_title-middle">Схема корпуса муфты</h2>
                                <img class="n_scheme__img" src="<?= SITE_TEMPLATE_PATH ?>/img/n_img/n_mufta.png" alt="МУФТА ПРОТИВОПОЖАРНАЯ">
                                <span class="n_scheme__textWrap">
                                    <span class="n_scheme__text">Терморасширяющийся материал <i class="n_scheme__line"></i></span>
                                    <span class="n_scheme__text">Разъёмный металлический корпус <i class="n_scheme__line"></i></span>
                                    <span class="n_scheme__text">Болтовое <br>соединение <i class="n_scheme__line"></i></span>
                                    <span class="n_scheme__text">Лепесток <br>крепления <i class="n_scheme__line"></i></span>
                                </span>
                            </div>
                            <? }
                            ?>
                            <?
            // оранженвая плашка
                            if (isset($arResult["PROPERTIES"]["NAME"]["VALUE"]) || isset($arResult["PROPERTIES"]["TEXT"]["VALUE"])) {
                                ?>
                                <div class="n_box n_box-accent">
                                    <p class="n_accent__title"><?= $arResult["PROPERTIES"]["NAME"]["VALUE"] ?></p>
                                    <p class="n_text"><?= $arResult["PROPERTIES"]["TEXT"]["VALUE"] ?></p>
                                </div>
                                <? } ?>
                                <?
            // преимущества
                                if (isset($arResult["PROPERTIES"]["ADVANTAGES"]["VALUE"])) {
                                    ?>
                                    <div class="n_box">
                                        <h2 class="n_title n_title-middle"><?= $arResult["PROPERTIES"]["ADVANTAGES"]["NAME"] ?></h2>
                                        <div class="n_list_wrap">
                                            <ul class="n_list">
                                                <? foreach ($arResult["PROPERTIES"]["ADVANTAGES"]["VALUE"] as $arAdvantages) { ?>
                                                <li><?= $arAdvantages ?></li>
                                                <? } ?>
                                            </ul>
                                            <? if ($arResult["IBLOCK_SECTION_ID"] == 7 || $arResult["IBLOCK_SECTION_ID"] == 4) { ?>
                                            <div class="n_factoid-circ">
                                                <div class="circ__content circ__content-<?= ($arResult["IBLOCK_SECTION_ID"] == 7 && $arResult["PROPERTIES"]["PICTURE_FACTOID"]["VALUE"]) ? "multi" : (($arResult["IBLOCK_SECTION_ID"] == 4 || !$arResult["PROPERTIES"]["PICTURE_FACTOID"]["VALUE"]) ? "single" : "") ?>">
                                                    <? if ($arResult["IBLOCK_SECTION_ID"] == 7 && $arResult["PROPERTIES"]["PICTURE_FACTOID"]["VALUE"]) { ?>
                                                    <img class="circ_ico" src="<?= CFile::GetPath($arResult["PROPERTIES"]["PICTURE_FACTOID"]["VALUE"]) ?>" alt="Pro-Brite">
                                                    <? } ?>
                                                    <p class="circ_text"><?= $arResult["IBLOCK_SECTION_ID"] == 4 ? "Продукт соответствует требованиям СТБ 2224-2011" : ($arResult["PROPERTIES"]["FACTOID_PIC"]["VALUE"] ? $arResult["PROPERTIES"]["FACTOID_PIC"]["VALUE"] : "") ?></p>
                                                </div>
                                            </div>
                                            <? } ?>
                                        </div>
                                    </div>
                                    <? } ?> 

                                    <?
            // особенности обработки
                                    if (isset($arResult["PROPERTIES"]["FEATURES"]["VALUE"]) || isset($arResult["PROPERTIES"]["FEATURES_MONTAGE"]["VALUE"])) {
                                        ?>
                                        <div class = "n_box">
                                            <h2 class = "n_title n_title-middle"><?= $arResult["PROPERTIES"]["FEATURES"]["VALUE"] ? $arResult["PROPERTIES"]["FEATURES"]["NAME"] : $arResult["PROPERTIES"]["FEATURES_MONTAGE"]["NAME"] ?></h2>
                                            <div class = "n_text">
                                                <?= $arResult["PROPERTIES"]["FEATURES"]["~VALUE"] ? $arResult["PROPERTIES"]["FEATURES"]["~VALUE"] : $arResult["PROPERTIES"]["FEATURES_MONTAGE"]["~VALUE"] ?>
                                            </div>
                                            <? if (isset($arResult["PROPERTIES"]["NOTE_FOR_FEATURES"]["VALUE"])) { ?>
                                            <div class = "n_factoid-text">
                                                <p><?= $arResult["PROPERTIES"]["NOTE_FOR_FEATURES"]["VALUE"] ?></p>
                                            </div>
                                            <? } ?>
                                            <?
                    //схема монтажа
                                            if ($arResult["IBLOCK_SECTION_ID"] == 4) {
                                                ?>
                                                <div class="n_img n_install">
                                                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/n_img/n_mufta_install.jpg" alt="монтаж муфт">
                                                </div>
                                                <? } ?>
                                            </div>
                                            <? } ?>


                                            <? if ($arResult["PROPERTIES"]["CERTIFICATES"]["VALUE"]) { ?>
                                            <div class="n_box">
                                                <h2 class="n_title n_title-middle">Сертификаты соответствия</h2>
                                                <div class="n_text"><?= $arResult["PROPERTIES"]["CERTIFICATES"]["~VALUE"] ?></div>
                                                <div class="n_text">
                                                    <!-- заменить ссылки на правильные файлы!!! -->
                                                    <!--<p><span class="n_link n_link-modal" data-big-src="<?= CFile::GetPath($arResult["PROPERTIES"]["CERTIFICATE_PIC"]["VALUE"]) ?>" data-toggle="modal" data-target="#imgModal"><?= $arResult["PROPERTIES"]["CERTIFICATE"]["VALUE"] ?></span></p>-->
                                                    <!--<p><span class="n_link n_link-modal" data-big-src="/bitrix/templates/ptk-shop/img/sertificat7.jpg" data-toggle="modal" data-target="#imgModal">Положения об эксплуатационных характеристиках</span></p>-->
                                                </div>
                                            </div>
                                            <? } ?>
                                        </main>
                                        <!--    </div>-->
                                        <? } else {
                                            ?>
        <!--                <div class = "fix_area js_fix_area">
                        <div class = "img"><img src = "<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>" alt = "<?= $arResult["DETAIL_PICTURE"]["ALT"] ?>"></div>
                        <div class = "front js_front">
                            <p class = "title">Консультация специалиста</p>
                            <p class = "phone"><?= VELCOM ?></p>
                            <p class="phone mg"><?= MTS ?></p>
                            <p class="title">Обратный звонок</p>
                            <p class="text">Консультант перезвонит в течение<br> рабочего дня с 9:00 до 18:00</p>
                            <button class="but" data-change=".js_front .js_back">Заказать звонок</button>
                        </div>
                        <form action="/requests/consul.php" method="post" class="back js_validate js_back">
                            <i class="close" data-change=".js_back .js_front">×</i>
                            <p class="title">Заполните форму</p>
                            <input type="hidden" name="from" value="//<?= $_SERVER["HTTP_HOST"] ?><?= $_SERVER["REQUEST_URI"] ?>">
                            <div class="field js_input js_class_valid">
                                <span>Имя</span><input data-valid="name" data-valid-min="2" type="text" name="name">
                            </div>
                            <div class="field js_input js_class_valid">
                                <span>Телефон</span><input type="text" data-valid="phone" name="phone">
                            </div>
                            <p class="text">Консультант перезвонит в течение<br> рабочего дня с 9:00 до 18:00</p>
                            <button type="submit" class="but">Заказать звонок</button>
                        </form>
                    </div>-->

        <!--script>
            /*
             $(function () {
             
             var validator = new Validator();
             
             fix_worker();
             
             var img_detail = $('.js_img_detail');
             
             $('[data-big-src]').on('click', function () {
             img_detail.attr('src', $(this).attr('data-big-src'));
             });
             
             })*/
         </script-->       
         <div class="complex js_complex wrap clearfix">
            <? echo $arResult["~DETAIL_TEXT"]; ?>
            <div class = "modal fade" tabindex = "0" id = "imgModal" role = "dialog">
                <div class = "modal-dialog imgModal">
                    <div class = "modal-content">
                        <img src = "" alt = "" class = "js_img_detail">
                    </div>
                </div>
            </div>           
        </div>
        <? } ?>
        <aside class="catElement__aside js_fix_area">
            <div class="catElement__info ">
                <div class="n_info__img"><img src="<?= $arResult["DETAIL_PICTURE"]["SRC"] ? $arResult["DETAIL_PICTURE"]["SRC"] : $arResult["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arResult["DETAIL_PICTURE"]["ALT"] ?>"></div>           

                <?
//            print_r($arResult);
                if ((isset($arResult["MIN_PRICE"]["VALUE"]) && $arResult["MIN_PRICE"]["VALUE"] != 0) || ($arResult["OFFERS"] && $arResult["AVAIL_OFFERS"] != "false")) {
                    ?>
                    <div class="n_info__price"><span class="js_n-offer_price"><?= $arResult["MIN_PRICE"]["PRINT_DISCOUNT_VALUE"] ?></span></div>   
                    <? } ?>
                    <div class="n_info__offers">
                        <? if ($arResult["OFFERS"]) { ?>
                        <p class="n_offers__title"><?= $arResult["OFFERS"][0]["PROPERTIES"]["VOLUME"]["VALUE"] ? $arResult["OFFERS"][0]["PROPERTIES"]["VOLUME"]["NAME"] : $arResult["OFFERS"][0]["PROPERTIES"]["QUANTITY"]["NAME"] ?></p>
                        <?
                    } else {
                        foreach ($arResult["PROPERTIES"] as $prop) {
                            if (!in_array($prop["CODE"], NEED_PROPS))
                                continue;
                            if (!empty($prop["VALUE"])) {
                                ?>
                                <p class="n_offers__title"><?= $prop["NAME"] . " " . $prop["VALUE"] ?></p>                            
                                <?
                            }
                        }
                    }
                    ?>
                    <?
                    if ($arResult["OFFERS"]) {
                        $i = 0;
                        ?>
                        <ul class="n_offers__items">
                            <?
                            foreach ($arResult["OFFERS"] as $key => $arOffer) {
                                $active = false;
                                if ($i == 0 && $arOffer["PROPERTIES"]["AVAILABILITY"]["VALUE_XML_ID"] == "Y" && $arOffer["MIN_PRICE"]["VALUE"]) {
                                    $active = true;
                                    $i++;
                                }
                                ?>
                                <li class="n_offers__item js_n-offer <?= $arOffer["PROPERTIES"]["AVAILABILITY"]["VALUE_XML_ID"] == "Y" ? "" : "disabled" ?> <?= $active ? "active" : "" ?>" 
                                    data-item-id="<?= $arOffer["ID"] ?>" 
                                    data-item-price="<?= $arOffer["MIN_PRICE"]["PRINT_DISCOUNT_VALUE"] ?>">
                                    <span class="n_offers__item_text"><?= $arOffer["PROPERTIES"]["VOLUME"]["VALUE"] ? $arOffer["PROPERTIES"]["VOLUME"]["VALUE"] : $arOffer["PROPERTIES"]["QUANTITY"]["VALUE"] ?></span>
                                </li>                          
                                <? } ?>
                            </ul>
                            <? } ?>
                        </div>
                        <? if ((isset($arResult["MIN_PRICE"]["VALUE"]) && $arResult["MIN_PRICE"]["VALUE"] != 0) || ($arResult["OFFERS"] && $arResult["AVAIL_OFFERS"] != "false")) { ?>
                        <div class="n_to_basket_wrap">
                            <form action="post" class="n_to_basket_info n_hidden" id="info_to_basket">
                                <input type="text" name="item-id" value="<?= $arResult['ID'] ?>">
                                <input type="text" name="item-cookies" value="печеньки, много-много печенек, ням-ням &#x1f36a; &#x1f36a; &#x1f36a;">
                            </form>
                            <a href="#" class="n_button n_button-add js-basket_add">Добавить в заявку</a>
                            <a href="/cart" class="n_button n_button-go">Оформить заявку</a>
                            <p class="n_to_basket_text">Указать количество товара можно&nbsp;при&nbsp;заказе</p>
                        </div>
                        <? } ?>
                        <div class="n_general_sideinfo">
                            <p class="n_sideinfo__title">Консультация специалиста</p>
                            <p class="n_sideinfo__text n_sideinfo__time">с 9:00 до 18:00 в будни</p>
                            <p class="n_sideinfo__text n_sideinfo__tel"><a href="tel:<?= VELCOM ?>"><?= VELCOM ?></a></p>
                            <p class="n_sideinfo__text n_sideinfo__tel"><a href="tel:<?= MTS ?>"><?= MTS ?></a></p>
                        </div>
                    </div>
                </aside>

            </div>
            <div class = "modal fade" tabindex = "0" id = "imgModal" role = "dialog">
                <div class = "modal-dialog imgModal">
                    <div class = "modal-content">
                        <img src = "" alt = "" class = "js_img_detail">
                    </div>
                </div>
            </div> 
            <script>
               window.onload = function () {
                fix_worker();
            };

        </script>




