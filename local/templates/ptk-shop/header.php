<!DOCTYPE html>
<html>
    <head lang="ru-RU">
        <title><? $APPLICATION->ShowTitle() ?></title>
        <? $APPLICATION->ShowHead() ?>
        <meta name="viewport" content="width=device-width">
        <link rel="shortcut icon" href="/favicon.ico" type="image/png">
        <link rel="icon" href="/favicon.ico" type="image/png">
        <link href='//fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="<?php echo SITE_TEMPLATE_PATH ?>/style/css/n_style.css">
        <script src="<?php echo SITE_TEMPLATE_PATH ?>/js/jquery.js" type="text/javascript"></script>
        <?php include_once(__DIR__."/google.php"); ?>
    </head>
    <body>
        <?php include_once(__DIR__."/yandex.php"); ?>
        <? $APPLICATION->ShowPanel() ?>
        <script>
            var VELCOM = '<?= VELCOM ?>';
            $(function () {
                $(".js-phone").text(VELCOM);
            })
        </script>
        <header>
            <div class="wrap top">
                <?
                $APPLICATION->IncludeComponent(
                        "bitrix:main.include", ".default", Array(
                    "COMPONENT_TEMPLATE" => ".default",
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => "/include/logo.php",
                    "EDIT_TEMPLATE" => ""
                        )
                );
                ?>
                <?
                $APPLICATION->IncludeComponent(
                        "bitrix:main.include", ".default", Array(
                    "COMPONENT_TEMPLATE" => ".default",
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => "/include/phones.php",
                    "EDIT_TEMPLATE" => ""
                        )
                );
                ?>


                <?
                $APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket.line", 
	"basket_link", 
	array(
		"HIDE_ON_BASKET_PAGES" => "N",
		"PATH_TO_BASKET" => "/cart/",
		"PATH_TO_ORDER" => "/cart/",
		"PATH_TO_PERSONAL" => SITE_DIR."personal/",
		"PATH_TO_PROFILE" => SITE_DIR."personal/",
		"PATH_TO_REGISTER" => "",
		"POSITION_FIXED" => "Y",
		"POSITION_HORIZONTAL" => "right",
		"POSITION_VERTICAL" => "top",
		"SHOW_AUTHOR" => "N",
		"SHOW_DELAY" => "N",
		"SHOW_EMPTY_VALUES" => "N",
		"SHOW_IMAGE" => "Y",
		"SHOW_NOTAVAIL" => "N",
		"SHOW_NUM_PRODUCTS" => "Y",
		"SHOW_PERSONAL_LINK" => "N",
		"SHOW_PRICE" => "Y",
		"SHOW_PRODUCTS" => "N",
		"SHOW_SUMMARY" => "Y",
		"SHOW_TOTAL_PRICE" => "N",
		"COMPONENT_TEMPLATE" => "basket_link",
		"PATH_TO_AUTHORIZE" => ""
	),
	false
);
                ?>

            </div>
            <div class="menu">
                <div class="wrap">
                    <?
                    $APPLICATION->IncludeComponent("bitrix:menu", "top_menu", Array(
                        "ALLOW_MULTI_SELECT" => "N", // Разрешить несколько активных пунктов одновременно
                        "CHILD_MENU_TYPE" => "left", // Тип меню для остальных уровней
                        "DELAY" => "N", // Откладывать выполнение шаблона меню
                        "MAX_LEVEL" => "1", // Уровень вложенности меню
                        "MENU_CACHE_GET_VARS" => array(// Значимые переменные запроса
                            0 => "",
                        ),
                        "MENU_CACHE_TIME" => "3600", // Время кеширования (сек.)
                        "MENU_CACHE_TYPE" => "N", // Тип кеширования
                        "MENU_CACHE_USE_GROUPS" => "Y", // Учитывать права доступа
                        "ROOT_MENU_TYPE" => "left", // Тип меню для первого уровня
                        "USE_EXT" => "N", // Подключать файлы с именами вида .тип_меню.menu_ext.php
                            ), false
                    );
                    ?>
                </div>
            </div>
        </header>