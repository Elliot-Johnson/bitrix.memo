<h1>Как передать данные в component_epilog.php</h1>

Для этого (для нашего примера $arResult['TEXT']) в result_modifier.php добавим следующие строки:

<?
//$this->__component->SetResultCacheKeys(['TEXT']);

if ($arResult['IS_SET']) {
    $this->__component->SetResultCacheKeys(['IS_SET']);
}
?>

//////////////////////////////////////////////////
component_epilog.php
//////////////////////////////////////////////////
<?
if (!isset($arResult['IS_SET'])):
    include "inc_block_recommended.php";
endif;
?>




