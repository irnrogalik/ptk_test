<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
/** @var array $arParams */
/** @var array $arResult */
/** @var array $arUrls */

/** @var array $arHeaders */
use Bitrix\Sale\DiscountCouponsManager;

if (!empty($arResult["ERROR_MESSAGE"]))
    ShowError($arResult["ERROR_MESSAGE"]);

$bDelayColumn = false;
$bDeleteColumn = false;
$bWeightColumn = false;
$bPropsColumn = false;
$bPriceType = false;
//print_r($arResult);
if ($normalCount > 0):
    ?>
<div id="basket_items_list">
    <div class="bx_ordercart_order_table_container">
        <h1 class="n_title n_title-big">Оформление заявки</h1>
        <table id="basket_items">
            <thead>
                <tr>
                    <!-- <td class="margin"></td> -->
                    <?
                    foreach ($arResult["GRID"]["HEADERS"] as $id => $arHeader):
                        $arHeaders[] = $arHeader["id"];

                            // remember which values should be shown not in the separate columns, but inside other columns
                    if (in_array($arHeader["id"], array("TYPE"))) {
                        $bPriceType = true;
                        continue;
                    } elseif ($arHeader["id"] == "PROPS") {
                        $bPropsColumn = true;
                        continue;
                    } elseif ($arHeader["id"] == "DELAY") {
                        $bDelayColumn = true;
                        continue;
                    } elseif ($arHeader["id"] == "DELETE") {
                        $bDeleteColumn = true;
                        continue;
                    } elseif ($arHeader["id"] == "WEIGHT") {
                        $bWeightColumn = true;
                    }

                    if ($arHeader["id"] == "NAME"):
                        ?>
                    <td class="item" colspan="2" id="col_<?= $arHeader["id"]; ?>">
                        <?
                        elseif ($arHeader["id"] == "PRICE"):
                            ?>
                        <td class="price" id="col_<?= $arHeader["id"]; ?>">
                            <?
                            else:
                                ?>
                            <td class="custom" id="col_<?= $arHeader["id"]; ?>">
                                <?
                                endif;
                                ?>
                                <?= $arHeader["name"]; ?>
                            </td>
                            <?
                            endforeach;

                            if ($bDeleteColumn || $bDelayColumn):
                                ?>
                            <td class="custom"></td>
                            <?
                            endif;
                            ?>
                            <!-- <td class="margin"></td> -->
                        </tr>
                    </thead>

                    <tbody>
                        <?
                        $skipHeaders = array('PROPS', 'DELAY', 'DELETE', 'TYPE');

                        foreach ($arResult["GRID"]["ROWS"] as $k => $arItem):

                            if ($arItem["DELAY"] == "N" && $arItem["CAN_BUY"] == "Y"):
                                ?>
                            <tr id="<?= $arItem["ID"] ?>"
                                data-item-name="<?= $arItem["NAME"] ?>"
                                data-item-brand="<?= $arItem[$arParams['BRAND_PROPERTY'] . "_VALUE"] ?>"
                                data-item-price="<?= $arItem["PRICE"] ?>"
                                data-item-currency="<?= $arItem["CURRENCY"] ?>"
                                >
                                <!-- <td class="margin"></td> -->
                                <?
                                foreach ($arResult["GRID"]["HEADERS"] as $id => $arHeader):

                                    if (in_array($arHeader["id"], $skipHeaders)) // some values are not shown in the columns in this template
                                continue;

                                if ($arHeader["name"] == '')
                                    $arHeader["name"] = GetMessage("SALE_" . $arHeader["id"]);

                                if ($arHeader["id"] == "NAME"):
                                    ?>
                                <td class="itemphoto n_basket_item_img">
                                    <div class="bx_ordercart_photo_container">
                                        <?
                                        if (strlen($arItem["PREVIEW_PICTURE_SRC"]) > 0):
                                            $url = $arItem["PREVIEW_PICTURE_SRC"];
                                        elseif (strlen($arItem["DETAIL_PICTURE_SRC"]) > 0):
                                            $url = $arItem["DETAIL_PICTURE_SRC"];
                                        else:
                                            $url = $templateFolder . "/images/no_photo.png";
                                        endif;

                                        if (strlen($arItem["DETAIL_PAGE_URL"]) > 0):
                                            ?><span href="<?= $arItem["DETAIL_PAGE_URL"] ?>"><? endif; ?>
                                        <img src="<?= $url ?>" alt="" class="n_basket_item_img">
                                        <? if (strlen($arItem["DETAIL_PAGE_URL"]) > 0): ?></span><? endif; ?>
                                    </div>
                                    <?
                                    if (!empty($arItem["BRAND"])):
                                        ?>
                                    <div class="bx_ordercart_brand">
                                        <img alt="" src="<?= $arItem["BRAND"] ?>" />
                                    </div>
                                    <?
                                    endif;
                                    ?>
                                </td>
                                <td class="item">
                                    <h2 class="bx_ordercart_itemtitle">
                                        <? if (strlen($arItem["DETAIL_PAGE_URL"]) > 0): ?><span href="<?= $arItem["DETAIL_PAGE_URL"] ?>"><? endif; ?>
                                        <?= $arItem["NAME"] ?>
                                        <? if (strlen($arItem["DETAIL_PAGE_URL"]) > 0): ?></span><? endif; ?>
                                    </h2>
                                </td>
                                <?
                                elseif ($arHeader["id"] == "QUANTITY"):
                                    ?>
                                <td class="custom n_basket_quantity">
                                    <span><?= $arHeader["name"]; ?>:</span>
                                    <div class="centered">
                                        <table cellspacing="0" cellpadding="0" class="counter">
                                            <tr>
                                                <?
                                                $ratio = isset($arItem["MEASURE_RATIO"]) ? $arItem["MEASURE_RATIO"] : 0;
                                                $useFloatQuantity = ($arParams["QUANTITY_FLOAT"] == "Y") ? true : false;
                                                $useFloatQuantityJS = ($useFloatQuantity ? "true" : "false");
                                                ?>
                                                <?
                                                if (!isset($arItem["MEASURE_RATIO"])) {
                                                    $arItem["MEASURE_RATIO"] = 1;
                                                }

                                                if (
                                                    floatval($arItem["MEASURE_RATIO"]) != 0
                                                    ):
                                                    ?>
                                                    <td>
                                                        <a href="javascript:void(0);" class="minus n_basket_q_but" onclick="setQuantity(<?= $arItem["ID"] ?>, <?= $arItem["MEASURE_RATIO"] ?>, 'down', <?= $useFloatQuantityJS ?>);">&ndash;</a>
                                                    </td>
                                                    <td>
                                                        <input
                                                        type="text"
                                                        size="3"
                                                        id="QUANTITY_INPUT_<?= $arItem["ID"] ?>"
                                                        name="QUANTITY_INPUT_<?= $arItem["ID"] ?>"
                                                        maxlength="18"
                                                        style="max-width: 50px"
                                                        value="<?= $arItem["QUANTITY"] ?>"
                                                        onchange="updateQuantity('QUANTITY_INPUT_<?= $arItem["ID"] ?>', '<?= $arItem["ID"] ?>', <?= $ratio ?>, <?= $useFloatQuantityJS ?>)"
                                                        >
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0);" class="plus n_basket_q_but" onclick="setQuantity(<?= $arItem["ID"] ?>, <?= $arItem["MEASURE_RATIO"] ?>, 'up', <?= $useFloatQuantityJS ?>);">+</a>
                                                    </td>
                                                            <!-- <td id="basket_quantity_control">
                                                                <div class="basket_quantity_control">
                                                                    <a href="javascript:void(0);" class="plus" onclick="setQuantity(<?= $arItem["ID"] ?>, <?= $arItem["MEASURE_RATIO"] ?>, 'up', <?= $useFloatQuantityJS ?>);"></a>
                                                                    <a href="javascript:void(0);" class="minus" onclick="setQuantity(<?= $arItem["ID"] ?>, <?= $arItem["MEASURE_RATIO"] ?>, 'down', <?= $useFloatQuantityJS ?>);"></a>
                                                                </div>
                                                            </td> -->
                                                            <?
                                                            endif;
                                                            if (isset($arItem["MEASURE_TEXT"])) {
                                                                ?>
                                                                <!-- <td style="text-align: left"><?= htmlspecialcharsbx($arItem["MEASURE_TEXT"]) ?></td> -->
                                                                <?
                                                            }
                                                            ?>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <input type="hidden" id="QUANTITY_<?= $arItem['ID'] ?>" name="QUANTITY_<?= $arItem['ID'] ?>" value="<?= $arItem["QUANTITY"] ?>" />
                                            </td>
                                        <? elseif ($arHeader["id"] == "PRICE"):
                                        ?>
                                        <td class="price">
                                            <div class="current_price" id="current_price_<?= $arItem["ID"] ?>">
                                                <?= $arItem["PRICE_FORMATED"] ?>
                                            </div>
                                            <div class="old_price" id="old_price_<?= $arItem["ID"] ?>">
                                                <? if (floatval($arItem["DISCOUNT_PRICE_PERCENT"]) > 0): ?>
                                                <?= $arItem["FULL_PRICE_FORMATED"] ?>
                                            <? endif; ?>
                                        </div>

                                        <? if ($bPriceType && strlen($arItem["NOTES"]) > 0): ?>
                                        <div class="type_price"><?= GetMessage("SALE_TYPE") ?></div>
                                        <div class="type_price_value"><?= $arItem["NOTES"] ?></div>
                                    <? endif; ?>
                                </td>
                                <?
                                elseif ($arHeader["id"] == "DISCOUNT"):
                                    ?>
                                <td class="custom">
                                    <span><?= $arHeader["name"]; ?>:</span>
                                    <div id="discount_value_<?= $arItem["ID"] ?>"><?= $arItem["DISCOUNT_PRICE_PERCENT_FORMATED"] ?></div>
                                </td>
                                <?
                                elseif ($arHeader["id"] == "WEIGHT"):
                                    ?>
                                <td class="custom">
                                    <span><?= $arHeader["name"]; ?>:</span>
                                    <?= $arItem["WEIGHT_FORMATED"] ?>
                                </td>
                                <?
                                else:
                                    ?>
                                <td class="custom">
                                    <span><?= $arHeader["name"]; ?>:</span>
                                    <?
                                    if ($arHeader["id"] == "SUM"):
                                        ?>
                                    <div id="sum_<?= $arItem["ID"] ?>">
                                        <?
                                        endif;

                                        echo $arItem[$arHeader["id"]];

                                        if ($arHeader["id"] == "SUM"):
                                            ?>
                                    </div>
                                    <?
                                    endif;
                                    ?>
                                </td>
                                <?
                                endif;
                                endforeach;

                                if ($bDelayColumn || $bDeleteColumn):
                                    ?>
                                <td class="control n_basket_del_wrap">
                                    <?
                                    if ($bDeleteColumn):
                                        ?>
                                    <a href="<?= str_replace("#ID#", $arItem["ID"], $arUrls["delete"]) ?>"
                                     onclick="return deleteProductRow(this)">
                                     <? //= GetMessage("SALE_DELETE") ?>
                                 </a>                                           
                                 <?
                                 endif;
                                 ?>
                             </td>
                             <?
                             endif;
                             ?>
                             <!-- <td class="margin"></td> -->
                         </tr>
                         <?
                         endif;
                         endforeach;
                         ?>
                     </tbody>
                 </table>
             </div>
             <input type="hidden" id="column_headers" value="<?= htmlspecialcharsbx(implode($arHeaders, ",")) ?>" />
             <input type="hidden" id="offers_props" value="<?= htmlspecialcharsbx(implode($arParams["OFFERS_PROPS"], ",")) ?>" />
             <input type="hidden" id="action_var" value="<?= htmlspecialcharsbx($arParams["ACTION_VARIABLE"]) ?>" />
             <input type="hidden" id="quantity_float" value="<?= ($arParams["QUANTITY_FLOAT"] == "Y") ? "Y" : "N" ?>" />
             <input type="hidden" id="price_vat_show_value" value="<?= ($arParams["PRICE_VAT_SHOW_VALUE"] == "Y") ? "Y" : "N" ?>" />
             <input type="hidden" id="hide_coupon" value="<?= ($arParams["HIDE_COUPON"] == "Y") ? "Y" : "N" ?>" />
             <input type="hidden" id="use_prepayment" value="<?= ($arParams["USE_PREPAYMENT"] == "Y") ? "Y" : "N" ?>" />
             <input type="hidden" id="auto_calculation" value="<?= ($arParams["AUTO_CALCULATION"] == "N") ? "N" : "Y" ?>" />

             <div class="bx_ordercart_order_pay">

                <div class="bx_ordercart_order_pay_left" id="coupons_block">
                    <?
                    if ($arParams["HIDE_COUPON"] != "Y") {
                        ?>
                        <div class="bx_ordercart_coupon">
                            <span><?= GetMessage("STB_COUPON_PROMT") ?></span><input type="text" id="coupon" name="COUPON" value="" onchange="enterCoupon();">&nbsp;<a class="bx_bt_button bx_big" href="javascript:void(0)" onclick="enterCoupon();" title="<?= GetMessage('SALE_COUPON_APPLY_TITLE'); ?>"><?= GetMessage('SALE_COUPON_APPLY'); ?></a>
                        </div><?
                        if (!empty($arResult['COUPON_LIST'])) {
                            foreach ($arResult['COUPON_LIST'] as $oneCoupon) {
                                $couponClass = 'disabled';
                                switch ($oneCoupon['STATUS']) {
                                    case DiscountCouponsManager::STATUS_NOT_FOUND:
                                    case DiscountCouponsManager::STATUS_FREEZE:
                                    $couponClass = 'bad';
                                    break;
                                    case DiscountCouponsManager::STATUS_APPLYED:
                                    $couponClass = 'good';
                                    break;
                                }
                                ?><div class="bx_ordercart_coupon"><input disabled readonly type="text" name="OLD_COUPON[]" value="<?= htmlspecialcharsbx($oneCoupon['COUPON']); ?>" class="<? echo $couponClass; ?>"><span class="<? echo $couponClass; ?>" data-coupon="<? echo htmlspecialcharsbx($oneCoupon['COUPON']); ?>"></span><div class="bx_ordercart_coupon_notes"><?
                                if (isset($oneCoupon['CHECK_CODE_TEXT'])) {
                                    echo (is_array($oneCoupon['CHECK_CODE_TEXT']) ? implode('<br>', $oneCoupon['CHECK_CODE_TEXT']) : $oneCoupon['CHECK_CODE_TEXT']);
                                }
                                ?></div></div><?
                            }
                            unset($couponClass, $oneCoupon);
                        }
                    } else {
                        ?>&nbsp;<?
                    }
                    ?>
                </div>
                <div class="bx_ordercart_order_pay_right">
                    <table class="bx_ordercart_order_sum">
                        <? if ($bWeightColumn && floatval($arResult['allWeight']) > 0): ?>
                        <tr>
                            <td class="custom_t1"><?= GetMessage("SALE_TOTAL_WEIGHT") ?></td>
                            <td class="custom_t2" id="allWeight_FORMATED"><?= $arResult["allWeight_FORMATED"] ?>
                            </td>
                        </tr>
                    <? endif; ?>
                    <? if ($arParams["PRICE_VAT_SHOW_VALUE"] == "Y"): ?>
                    <tr>
                        <td><? echo GetMessage('SALE_VAT_EXCLUDED') ?></td>
                        <td id="allSum_wVAT_FORMATED"><?= $arResult["allSum_wVAT_FORMATED"] ?></td>
                    </tr>
                    <?
                    $showTotalPrice = (float) $arResult["DISCOUNT_PRICE_ALL"] > 0;
                    ?>
                    <tr style="display: <?= ($showTotalPrice ? 'table-row' : 'none'); ?>;">
                        <td class="custom_t1"></td>
                        <td class="custom_t2" style="text-decoration:line-through; color:#828282;" id="PRICE_WITHOUT_DISCOUNT">
                            <?= ($showTotalPrice ? $arResult["PRICE_WITHOUT_DISCOUNT"] : ''); ?>
                        </td>
                    </tr>
                    <?
                    if (floatval($arResult['allVATSum']) > 0):
                        ?>
                    <tr>
                        <td><? echo GetMessage('SALE_VAT') ?></td>
                        <td id="allVATSum_FORMATED"><?= $arResult["allVATSum_FORMATED"] ?></td>
                    </tr>
                    <?
                    endif;
                    ?>
                <? endif; ?>
                <tr class="n_basket_total">
                <td class="fwb">
                    <p>Итоговая стоимость</p>
                    <p class="details">Условия и стоимость доставки <br>обсуждаем индивидуально</p>
                </td>
                    <td class="fwb" id="allSum_FORMATED"><?= str_replace(" ","&nbsp;", $arResult["allSum_FORMATED"]) ?></td>
                </tr>


            </table>
            <div style="clear:both;"></div>
        </div>
        <div style="clear:both;"></div>

        <!-- user personal data form -->
        <div class="n_basket_user_info">
            <h2 class="n_title n_title-middle">Форма заказа</h2>
            <div class="b_info_form_group">
                <label class="b_info_form_field n_required js_class_valid">
                    <span class="b_info_form_lab">Имя</span>
                    <input type="text" class="b_info_form_inp" name="client_name"  data-valid="name" data-valid-min="2">
                    <span class="b_info_form_err">Менеджер не сможет обратиться к&nbsp;вам по этому имени</span>
                </label>
            </div>
            <div class="b_info_form_group">
                <label class="b_info_form_field n_required js_class_valid">
                    <span class="b_info_form_lab">Телефон</span>
                    <input type="tel" class="b_info_form_inp" name="client_tel" data-valid="phone">
                    <span class="b_info_form_err">Менеджер не дозвонится по&nbsp;этому номеру</span>
                </label>
            </div>
            <div class="b_info_form_group">
                <label class="b_info_form_field">
                    <span class="b_info_form_lab">Эл. почта</span>
                    <input type="email" class="b_info_form_inp" name="client_email">
                    <span class="b_info_form_inf">На указанный адрес придёт <br>подтверждение заказа</span>
                </label>
            </div>
            <div class="b_info_form_single">
                <label class="b_info_form_field">
                    <span class="b_info_form_lab">Компания</span>
                    <input type="text" class="b_info_form_inp" name="client_company">
                </label>
            </div>
            <div class="b_info_form_single">
                <label class="b_info_form_field">
                    <span class="b_info_form_lab">Юридические данные</span>
                    <textarea name="client_legal" class="b_info_form_inp"></textarea>
                    <span class="b_info_form_inf">УНП, юр.адрес, банковские&nbsp;реквизиты, ФИО&nbsp;руководителя</span>
                </label>
            </div>
            <div class="b_info_form_single">
                <label class="b_info_form_field">
                    <span class="b_info_form_lab">Сообщение</span>
                    <textarea name="client_comment" class="b_info_form_inp"></textarea>
                </label>
            </div>
                <!-- <div class="n_basket_user_info_form">
                    <div class="b_info_form_row">
                        <label class="b_info_form_cell n_required js_class_valid">
                            <span class="b_info_form_lab">Имя</span>
                            <input type="text" class="b_info_form_inp" name="client_name"  data-valid="name" data-valid-min="2">
                        </label>
                        <label class="b_info_form_cell">
                            <span class="b_info_form_lab">Название компании</span>
                            <input type="text" class="b_info_form_inp" name="client_company">
                        </label>
                    </div>
                    <div class="b_info_form_row">
                        <label class="b_info_form_cell n_required js_class_valid">
                            <span class="b_info_form_lab">Телефон</span>
                            <input type="tel" class="b_info_form_inp" name="client_tel" data-valid="phone">
                        </label>
                        <label class="b_info_form_cell b_info_form_cell-high">
                            <span class="b_info_form_lab">Юридические данные</span>
                            <div class="n_basket_input_wrap">
                                <textarea name="client_legal" class="b_info_form_inp"></textarea>
                                <span class="b_info_form_detail">УНП, юр.адрес, банковские реквизиты, ФИО руководителя</span>
                            </div>
                        </label>
                    </div>
                    <div class="b_info_form_row">
                        <label class="b_info_form_cell">
                            <span class="b_info_form_lab">E-mail</span>
                            <input type="email" class="b_info_form_inp" name="client_email">
                        </label>
                        <label class="b_info_form_cell"></label>
                    </div>
                    <div class="b_info_form_row">
                        <label class="b_info_form_cell b_info_form_cell-wide ">
                            <span class="b_info_form_lab">Комментарии</span>
                            <div class="n_basket_input_wrap">
                                <textarea name="client_comment" class="b_info_form_inp"></textarea>
                            </div>
                        </label>
                    </div>
                </div> -->
            </div>

            <div class="bx_ordercart_order_pay_center">

                <? if ($arParams["USE_PREPAYMENT"] == "Y" && strlen($arResult["PREPAY_BUTTON"]) > 0): ?>
                <?= $arResult["PREPAY_BUTTON"] ?>
                <span><?= GetMessage("SALE_OR") ?></span>
            <? endif; ?>
            <?
            if ($arParams["AUTO_CALCULATION"] != "Y") {
                ?>
                <a href="javascript:void(0)" onclick="updateBasket();" class="checkout refresh"><?= GetMessage("SALE_REFRESH") ?></a>
                <?
            }
            ?>
            <a href="javascript:void(0)" onclick="sentBasket()" class="n_button n_button-add js_send_app disabled" id="user_info_submit">Отправить заявку</a>
            <span class="b_info_form_inf">Имя и&nbsp;телефон &mdash; обязательные поля</span>
        </div>
    </div>
    <script>
        function sentBasket () {
            if(!$('.js_send_app').hasClass('disabled')) {
                checkOut();
            }
        }
    </script>
</div>
<?
else:
    ?>
<div id="basket_items_list">
    <table>
        <tbody>
            <tr>
                <td style="text-align:center">
                    <div class=""><?= GetMessage("SALE_NO_ITEMS"); ?></div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<?
endif;