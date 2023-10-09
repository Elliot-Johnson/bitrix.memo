/// Получить ID инфоблока по коду
// Определение ID инфоблока по коду counting_of_banners_showing_and_clicks
$IBLOCK_ID = 0;
if (CModule::IncludeModule('iblock')) {
    $res = CIBlock::GetList(array(), array('TYPE' => 'information', '=CODE' => 'counting_of_banners_showing_and_clicks', 'CHECK_PERMISSIONS' => 'N'), false);
    while ($arrIBlock = $res->Fetch()) $IBLOCK_ID = intval($arrIBlock['ID']);
}
//
