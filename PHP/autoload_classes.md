# Пример автозагрузки классов

```
<?php
spl_autoload_register('autoloderAbacus');
function autoloderAbacus($class)
{
    if (strpos($class, "Abacus") !== false) {
        $path = str_replace('\\', DIRECTORY_SEPARATOR, $class);
        $path = str_replace('Abacus', '/local/Abacus/Classes', $path);
        $file = $_SERVER["DOCUMENT_ROOT"] . $path . '.php';
        if (file_exists($file)) {
            require $file;
            return true;
        }
        return false;
    }
    return false;

}
```

##  Файл с классом лежит в /local/Abacus/Classes/Barcode/Barcode.php
```
namespace Abacus\Barcode;

class Barcode
{}
```

## Использование:
```
use \Abacus\Barcode\Barcode;

require_once "inc_init_abacus.php";

$barcode = new Barcode(new BarcodeGenerator());

```
