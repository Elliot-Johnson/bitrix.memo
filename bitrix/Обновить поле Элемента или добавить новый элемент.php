<?php
//Обновить установить поле Элемента или добавить новый элемент

CModule::IncludeModule('iblock');

//Обновление

//Надо указывать все PROPERTY_VALUES иначе неуказанные сотрутся.

$res = $el->Update($ar_fields['ID'], array("NAME" => $NAME));


if($ELEMENT_ID) {
    $el = new CIBlockElement;

    $PROP["USER"] = $USER->GetID();
    $PROP["VIDEO"] = $VIDEO_ID;

    $fields = Array(
        "PROPERTY_VALUES" => $PROP,
        "IBLOCK_ID" => IntVal($IBLOCK_ID),
        "MODIFIED_BY"    => $USER->GetID(),
        "DATE_ACTIVE_TO" => "",
    );
    $res = $el->Update($ELEMENT_ID,$fields, false, false, true, true);
    if($res){
        echo "успех";
    }else{
        echo "Что-то пошло не так.";
    }
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//ОБНОВЛЕНИЕ ОДНОГО ПОЛЯ
CIBlockElement::SetPropertyValuesEx($ELEMENT_ID, false, array($PROPERTY_CODE => $PROPERTY_VALUE));
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Добавление

$NOW_DATE =  date("d.m.Y");
$NEW_DATE =  date("d.m.Y", strtotime("+3 month"));

$el = new CIBlockElement;
$PROP["USER"] = $USER->GetID();
$PROP["VIDEO"] = $VIDEO_ID;
$arLoadElementArray = array(
    "MODIFIED_BY" => 1,
    "IBLOCK_ID" => $IBLOCK_ID,
    "PROPERTY_VALUES" => $PROP,
    "NAME" => $USER->GetID()."_".$VIDEO_ID,
    "DATE_ACTIVE_FROM" =>  $NOW_DATE,
    "DATE_ACTIVE_TO" =>  $NEW_DATE,
    "ACTIVE" => "Y",
);
$res = $el->Add($arLoadElementArray);
if($res){
    echo "Доступ добавлен!\n";
}else{
    echo "Что-то пошло не так с добавлением!\n";
}






