<footer>
    <div class="top">
        <div class="wrap">
            <div class="dop clearfix">


				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					".default",
					Array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"COMPONENT_TEMPLATE" => ".default",
						"EDIT_TEMPLATE" => "",
						"PATH" => "/include/footer-services.php"
					)
				);?>
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					".default",
					Array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"COMPONENT_TEMPLATE" => ".default",
						"EDIT_TEMPLATE" => "",
						"PATH" => "/include/footer-2.php"
					)
				);?>

                <?
                $APPLICATION->IncludeComponent(
                        "bitrix:main.include", ".default", Array(
                    "COMPONENT_TEMPLATE" => ".default",
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => "/include/legal_information.php",
                    "EDIT_TEMPLATE" => ""
                        )
                );
                ?>
                
            </div>
            <div class="info clearfix">
                <?
                $APPLICATION->IncludeComponent(
                        "bitrix:main.include", ".default", Array(
                    "COMPONENT_TEMPLATE" => ".default",
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => "/include/copyright.php",
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
            </div>
        </div>
    </div>
    <div class="foot">
        <div class="wrap">
            <?
            $APPLICATION->IncludeComponent(
                    "bitrix:main.include", ".default", Array(
                "COMPONENT_TEMPLATE" => ".default",
                "AREA_FILE_SHOW" => "file",
                "PATH" => "/include/creator.php",
                "EDIT_TEMPLATE" => ""
                    )
            );
            ?>
            <span class="scrollTop"></span>
        </div>
    </div>
</footer>
<link rel="stylesheet" type="text/css" href="<?php echo SITE_TEMPLATE_PATH ?>/style/s.php/sass.scss">
<script src="<?php echo SITE_TEMPLATE_PATH ?>/js/jquery.maskedinput.js" type="text/javascript"></script>

<script src="<?php echo SITE_TEMPLATE_PATH ?>/js/main.js" type="text/javascript"></script>
</body>
</html>