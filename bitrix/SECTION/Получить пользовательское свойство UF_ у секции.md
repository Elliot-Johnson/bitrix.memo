# Выбираем значение пользовательского свойства у секции
```
if(isset($arResult['SECTION']['ID'])){
    $aCurSection   = CIBlockSection::GetList( array(), array('IBLOCK_ID'=>$arParams["IBLOCK_ID"],'ID'=>$arResult['SECTION']['ID'],), false, array( 'UF_TEXT_FOR_ELEMENT_UNDER_H1' ) )->Fetch();
    if ($aCurSection["UF_TEXT_FOR_ELEMENT_UNDER_H1"]) {
        $UF_TEXT_FOR_ELEMENT_UNDER_H1 = htmlspecialcharsBack($aCurSection["UF_TEXT_FOR_ELEMENT_UNDER_H1"]);
    }
}
```
