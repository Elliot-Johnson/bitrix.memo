<?php

class CFavorite {
    const IBLOCK_ID = 37;

    public static function GetList() {
        global $USER;
        //\Bitrix\Main\Loader::includeModule('iblock');
        $returnElements = [];

        if ($USER->IsAuthorized()) {
            $idUser = $USER->GetID();
            $rsUser = CUser::GetByID($idUser);
            $arUser = $rsUser->Fetch();
            $arElements = unserialize($arUser["UF_FAVORITES"]);

            if($_COOKIE["favorites"]){
                $arElements2 = json_decode($_COOKIE["favorites"], true);
            }
            if(is_array($arElements2) and count($arElements2)>0){
                $arElements = array_merge($arElements, $arElements2);
                $arElements = array_unique($arElements);
                $USER->Update($idUser, Array("UF_FAVORITES" => serialize($arElements)));
                unset($_COOKIE['favorites']);
                setcookie('favorites', '', -1, '/');
            }
        }else{
            if($_COOKIE["favorites"]){
                $arElements = json_decode($_COOKIE["favorites"], true);
            }
        }
        if ($arElements) {
            $dataElements = CIBlockElement::GetList([], ['IBLOCK_ID' => self::IBLOCK_ID, 'ID' => $arElements, 'ACTIVE' => 'Y'], ['ID']);
            while ($element = $dataElements->GetNext()) {
                $returnElements[] = $element['ID'];
            }
        }
        return $returnElements;
    }

    public static function Check($id) {
        global $USER;

        if ($USER->IsAuthorized()) {
            $idUser = $USER->GetID();
            $rsUser = CUser::GetByID($idUser);
            $arUser = $rsUser->Fetch();
            $arElements = unserialize($arUser["UF_FAVORITES"]);
            return (is_array($arElements) && in_array($id, $arElements)) ? true : false;
        }else{
            if($_COOKIE["favorites"]){
                $arElements = json_decode($_COOKIE["favorites"], true);
                return (is_array($arElements) && in_array($id, $arElements)) ? true : false;
            }
        }
        return false;
    }

    public static function Add($id) {
        global $USER;
        if ($USER->IsAuthorized()) {
            $idUser = $USER->GetID();
            $arElements = self::GetList();
            if (!in_array($id, $arElements)) {
                $arElements[] = $id;
            }
            $result = $USER->Update($idUser, Array("UF_FAVORITES" => serialize($arElements)));
        } else {
            return false;
        }
        return $result;
    }
    public static function Delete($id) {
        global $USER;
        if ($USER->IsAuthorized()) {
            $idUser = $USER->GetID();
            $arElements = self::GetList();
            foreach ($arElements as $key => $arElement) {
                if ($id == $arElement) {
                    unset($arElements[$key]);
                }
            }
            $result = $USER->Update($idUser, Array("UF_FAVORITES" => serialize($arElements)));
        }

        return $result;
    }
}