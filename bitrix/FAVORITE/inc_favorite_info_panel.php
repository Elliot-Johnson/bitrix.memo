<?php
CModule::IncludeModule('iblock');
require_once "CFavorite.php";
$favorite_counter = count(CFavorite::GetList());
if ($_COOKIE["test"] == 1 or 1) {
    global $APPLICATION;
    $APPLICATION->SetAdditionalCSS('/include/catalog/favorite/favorite_info_panel.css', true);
    $APPLICATION->SetAdditionalCSS('/include/catalog/favorite/favorite.css', true);
    $APPLICATION->AddHeadScript($APPLICATION->GetTemplatePath("/include/catalog/favorite/favorite.js"));
    ?>
    <div class="favorite_info_panel <?php if($favorite_counter>0){ echo "active";} ?>">
        <a class="favorite_info_panel__link" href="/wishlist/">
            <span class="favorite_info_panel__icon "></span>
            <span class="favorite_info_panel__counter"><?=$favorite_counter?></span>
        </a>
    </div>
    <?php
}
?>