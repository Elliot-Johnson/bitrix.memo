//ConvertTimeStamp - дата в формате сайта
//ConvertTimeStamp(time(), "SHORT") - только дата
//ConvertTimeStamp(time(), "FULL") - дата + время
//////////////////////////////////////////////////
$today = ConvertTimeStamp(time(), "SHORT");
    $arFilter = [
        "IBLOCK_ID" => $IBLOCK_ID,
        array(
            'NAME' => $_REQUEST['erid'],
            '>=DATE_CREATE' => $today . " 00:00:00",
            '<=DATE_CREATE' => $today . " 23:59:59",
        ),
    ];
    $res = CIBlockElement::GetList(array("ID" => "DESC"),
        $arFilter,
        false,
        array("nTopCount" => 1),
        ['ID', 'NAME', 'PROPERTY_AMOUNT', 'DATE_CREATE']);
    $added = false;

    while ($obRes = $res->GetNextElement()) {
        $arFields = $obRes->GetFields();
        if (!empty($arFields['PROPERTY_AMOUNT_VALUE'])) {
            $counter = $arFields['PROPERTY_AMOUNT_VALUE'] + 1;
            CIBlockElement::SetPropertyValuesEx($arFields['ID'], false, array("AMOUNT" => $counter));
            $success = true;
            $added = true;
        }
    }
