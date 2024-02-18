# Ресайз картинок
## Image Resize

```
$file = CFile::ResizeImageGet($uInfo['PERSONAL_PHOTO'], array('width'=>150, 'height'=>150), BX_RESIZE_IMAGE_PROPORTIONAL, true);               
$img = '<img src="'.$file['src'].'" width="'.$file['width'].'" height="'.$file['height'].'" />';  
```

BX_RESIZE_IMAGE_EXACT - масштабирует в прямоугольник $arSize c сохранением пропорций, обрезая лишнее;  
BX_RESIZE_IMAGE_PROPORTIONAL - масштабирует с сохранением пропорций, размер ограничивается $arSize;  
BX_RESIZE_IMAGE_PROPORTIONAL_ALT - масштабирует с сохранением пропорций за ширину при этом принимается максимальное значение из высоты/ширины, 
размер ограничивается $arSize, улучшенная обработка вертикальных картинок.  
