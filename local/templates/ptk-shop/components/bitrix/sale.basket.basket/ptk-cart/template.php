<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
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
/** @var CBitrixBasketComponent $component */
$templateData = array(
    'TEMPLATE_THEME' => $this->GetFolder() . '/themes/' . $arParams['TEMPLATE_THEME'] . '/style.css',
    'TEMPLATE_CLASS' => 'bx_' . $arParams['TEMPLATE_THEME'],
);
$this->addExternalCss($templateData['TEMPLATE_THEME']);

$curPage = $APPLICATION->GetCurPage() . '?' . $arParams["ACTION_VARIABLE"] . '=';
$arUrls = array(
    "delete" => $curPage . "delete&id=#ID#",
    "delay" => $curPage . "delay&id=#ID#",
    "add" => $curPage . "add&id=#ID#",
);
unset($curPage);

$arParams['USE_ENHANCED_ECOMMERCE'] = isset($arParams['USE_ENHANCED_ECOMMERCE']) && $arParams['USE_ENHANCED_ECOMMERCE'] === 'Y' ? 'Y' : 'N';
$arParams['DATA_LAYER_NAME'] = isset($arParams['DATA_LAYER_NAME']) ? trim($arParams['DATA_LAYER_NAME']) : 'dataLayer';
$arParams['BRAND_PROPERTY'] = isset($arParams['BRAND_PROPERTY']) ? trim($arParams['BRAND_PROPERTY']) : '';

$arBasketJSParams = array(
    'SALE_DELETE' => GetMessage("SALE_DELETE"),
    'SALE_DELAY' => GetMessage("SALE_DELAY"),
    'SALE_TYPE' => GetMessage("SALE_TYPE"),
    'TEMPLATE_FOLDER' => $templateFolder,
    'DELETE_URL' => $arUrls["delete"],
    'DELAY_URL' => $arUrls["delay"],
    'ADD_URL' => $arUrls["add"],
    'EVENT_ONCHANGE_ON_START' => (!empty($arResult['EVENT_ONCHANGE_ON_START']) && $arResult['EVENT_ONCHANGE_ON_START'] === 'Y') ? 'Y' : 'N',
    'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
    'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
    'BRAND_PROPERTY' => $arParams['BRAND_PROPERTY']
);
?>
<script type="text/javascript">
    var basketJSParams = <?= CUtil::PhpToJSObject($arBasketJSParams); ?>;
</script>
<?
$APPLICATION->AddHeadScript($templateFolder . "/script.js");

if (strlen($arResult["ERROR_MESSAGE"]) <= 0) {
    ?>
    <div id="warning_message">
        <?
        if (!empty($arResult["WARNING_MESSAGE"]) && is_array($arResult["WARNING_MESSAGE"])) {
            foreach ($arResult["WARNING_MESSAGE"] as $v)
                ShowError($v);
        }
        ?>
    </div>
    <?
    $normalCount = count($arResult["ITEMS"]["AnDelCanBuy"]);
    $normalHidden = ($normalCount == 0) ? 'style="display:none;"' : '';

    $delayCount = count($arResult["ITEMS"]["DelDelCanBuy"]);
    $delayHidden = ($delayCount == 0) ? 'style="display:none;"' : '';

    $subscribeCount = count($arResult["ITEMS"]["ProdSubscribe"]);
    $subscribeHidden = ($subscribeCount == 0) ? 'style="display:none;"' : '';

    $naCount = count($arResult["ITEMS"]["nAnCanBuy"]);
    $naHidden = ($naCount == 0) ? 'style="display:none;"' : '';

    foreach (array_keys($arResult['GRID']['HEADERS']) as $id) {
        $data = $arResult['GRID']['HEADERS'][$id];
        $headerName = (isset($data['name']) ? (string) $data['name'] : '');
        if ($headerName == '')
            $arResult['GRID']['HEADERS'][$id]['name'] = GetMessage('SALE_' . $data['id']);
        unset($headerName, $data);
    }
    unset($id);
    ?>
    <form method="post" action="/requests/orderMake.php" name="basket_form" id="basket_form" class="js_validate">
        <div id="basket_form_container">
            <div class="bx_ordercart <?= $templateData['TEMPLATE_CLASS']; ?> wrap n_page">
                <!-- <div class="bx_sort_container">
                    <span><?= GetMessage("SALE_ITEMS") ?></span>
                    <a href="javascript:void(0)" id="basket_toolbar_button" class="current" onclick="showBasketItemsList()"><?= GetMessage("SALE_BASKET_ITEMS") ?><div id="normal_count" class="flat" style="display:none">&nbsp;(<?= $normalCount ?>)</div></a>
                    <a href="javascript:void(0)" id="basket_toolbar_button_delayed" onclick="showBasketItemsList(2)" <?= $delayHidden ?>><?= GetMessage("SALE_BASKET_ITEMS_DELAYED") ?><div id="delay_count" class="flat">&nbsp;(<?= $delayCount ?>)</div></a>
                    <a href="javascript:void(0)" id="basket_toolbar_button_subscribed" onclick="showBasketItemsList(3)" <?= $subscribeHidden ?>><?= GetMessage("SALE_BASKET_ITEMS_SUBSCRIBED") ?><div id="subscribe_count" class="flat">&nbsp;(<?= $subscribeCount ?>)</div></a>
                    <a href="javascript:void(0)" id="basket_toolbar_button_not_available" onclick="showBasketItemsList(4)" <?= $naHidden ?>><?= GetMessage("SALE_BASKET_ITEMS_NOT_AVAILABLE") ?><div id="not_available_count" class="flat">&nbsp;(<?= $naCount ?>)</div></a>
                </div> -->
                <?
                include($_SERVER["DOCUMENT_ROOT"] . $templateFolder . "/basket_items.php");
                ?>
            </div>
        </div>
        <input type="hidden" name="BasketOrder" value="BasketOrder" />
        <!-- <input type="hidden" name="ajax_post" id="ajax_post" value="Y"> -->
    </form>
    <script>
        $(function () {
            var validator = new Validator();
        })

    </script>
    <?
}elseif (strlen($arResult["ERROR_MESSAGE"]) > 0) {
    ?>
    <div class="basket_empty wrap clearfix">
        <div class="left">
            <p class="h3">В заявку ничего не добавлено</p>
            <a href="/catalog" class="butt n_button">Перейти в каталог</a>           
        </div>        
    </div>
    <?
} else {
    ShowError($arResult["ERROR_MESSAGE"]);
}