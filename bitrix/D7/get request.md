# Получение параметров GET или POST, можно использовать код:  

Код $value = $request["some_name"]; возвращает строку, которая __прошла уже фильтры модуля безопасности__.   
Однако это не говорит о ее безопасности, всё зависит от того, что с ней необходимо делать дальше.   

```
use Bitrix\Main\Application;
/**/
$context = Application::getInstance()->getContext();
/**/
$request = $context->getRequest();
/**/
$request = Application::getInstance()->getContext()->getRequest();
var_dump($request["clear_cache"]);
```

```
$value = $request->getQuery("some_name");   // получение GET-параметра
$value = $request->getPost("some_name");   // получение POST-параметра
$value = $request->getFile("some_name");   // получение загруженного файла
$value = $request->getCookie("some_name");   // получение значения кука
$uri = $request->getRequestUri();   // получение запрошенного адреса
$method = $request->getRequestMethod();   // получение метода запроса
$flag = $request->isPost();      // true - POST-запрос, иначе false
```
