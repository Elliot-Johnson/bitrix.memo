<?php
if (!isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && $_SERVER["HTTP_X_REQUESTED_WITH"] === "XMLHttpRequest"){
    exit();
}
header('Content-Type: application/json; charset=utf-8');
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule('iblock');
$result = [];
$result['result']['success'] = false;
$result['result']['message'] = '';
ob_start();
require_once "CFavorite.php";
/**********************************************************************************************************************/

//var_dump($_REQUEST);

if(isset($_REQUEST["product_id"])){
    $product_id = intval($_REQUEST["product_id"]);
    switch ($_REQUEST["action"]){
        case "add":
            $result['result']['success'] = CFavorite::Add($product_id);
            break;
        case "delete":
            $result['result']['success'] = CFavorite::Delete($product_id);
            break;
        default:
            break;
    }
}






/**********************************************************************************************************************/
$buffer = ob_get_clean();
$result['result']['buffer'] = $buffer;
echo json_encode($result);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
