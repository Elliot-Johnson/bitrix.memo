# Объяснение как использовать

## Все кладу в /include/catalog/favorite/

### В детальном и карточке списка   
local/templates/master_default/components/bitrix/catalog.element/master/template.php   
local/templates/master_default/components/bitrix/catalog.item/master/card/template.php   
### подключаю так:   
include $_SERVER["DOCUMENT_ROOT"]."/include/catalog/favorite/inc_favorite_link.php";  

### !!! наружный блок карточки списка должен иметь class="product-item"  

### в шапке подключаю это:   
include $_SERVER["DOCUMENT_ROOT"]."/include/catalog/favorite/inc_favorite_info_panel.php";   

### в CFavorite.php надо задать IBLOCK_ID
