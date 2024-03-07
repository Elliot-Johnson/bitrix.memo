# Получение параметров GET или POST, можно использовать код:  

Код $value = $request["some_name"]; возвращает строку, которая __прошла уже фильтры модуля безопасности__.   
Однако это не говорит о ее безопасности, всё зависит от того, что с ней необходимо делать дальше.   

```
use Bitrix\Main\Application;

$request = Application::getInstance()->getContext()->getRequest();
var_dump($request["clear_cache"]);
```
