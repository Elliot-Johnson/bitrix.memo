# CUser

## Текущий пользователь

global $USER;  
echo "[".$USER->GetID()."] (".$USER->GetLogin().") ".$USER->GetFullName();  


## Получить пользователя по логину
$user = CUser::GetByLogin($USER_LOGIN])->Fetch();

## Получить пользователя по ID
$user = CUser::GetByID($USER_ID)->Fetch();


## Добавление нового пользователя
$user = new CUser;  
$arFields = array(  
"LOGIN" => $this->counteragent_fields["LOGIN"],  
                    "NAME" => $this->counteragent_fields["NAME"],  
                    "EMAIL" => $this->counteragent_fields["EMAIL"],  
                    "LID" => "ru",  
                    "ACTIVE" => "Y",  
                    "GROUP_ID" => array(6, 10),  
                    "PASSWORD" => $this->counteragent_fields["PASSWORD"],  
                    "CONFIRM_PASSWORD" => $this->counteragent_fields["PASSWORD"],  
                    "UF_CODE" => $response["id"],  
                    "UF_INN" => $this->counteragent_fields["INN"],  
                );  

$ID = $user->Add($arFields);    
if (intval($ID) > 0)    
    return true;   
else  
    echo $user->LAST_ERROR;   
****************************************** 

## Множественное поле
global $USER_FIELD_MANAGER;   
$UF_FILIAL_IDs = [];   
$arFields_filial = $USER_FIELD_MANAGER->GetUserFields("USER");   
$obEnum = new CUserFieldEnum;   
$rsEnum = $obEnum->GetList(array(), array("USER_FIELD_ID" => $arFields_filial["UF_FILIAL"]["ID"]));   
while ($arEnum = $rsEnum->GetNext()) {   
    $UF_FILIAL_IDs[] = $arEnum["ID"];   
}  
$arFields["UF_FILIAL"] = $UF_FILIAL_IDs;  


## Еще вариант  
$rsEnum = CUserFieldEnum::GetList(  
                                [],  
                                [  
                                    "ID" => $user['UF_CURRENT_FILIAL'],  
                                    "USER_FIELD_ID" => 45  
                                ]  
                            );  
if ($ar_res = $rsEnum->Fetch()) {  
}    

******************************************  

## Обновление одного поля

$user = new CUser;  
$user->Update($USER->getId(), ["UF_BIK" => ""]);  
******************************************  

## Получение всех полей текущего юзера
$arUser = CUser::GetByID($GLOBALS["USER"]->GetId())->GetNext();  
var_dump_pre($arUser);  
или одного  
var_dump_pre($arUser["UF_FILIAL"]);  

## Узнать состоит ли юзер в группе №9.
global $USER;  
if (in_array(9, CUser::GetUserGroup($USER->GetID()))) {           
  
}  



