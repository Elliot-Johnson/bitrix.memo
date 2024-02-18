#Послать письмо с помощью события event send
```
<?php 
    $arEventFields = array(
        "NAME" => "TEST",    
    );
    $mail_id = CEvent::Send("REG_YUR_CANDIDATE_CONFIRMATION", "s1", $arEventFields, "N");
?>
```
