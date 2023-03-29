# Заказ (Sale\Order)

use Bitrix\Sale;
Заказ (Sale\Order)
Заказ представляет собой объект класса Bitrix\Sale\Order. Нужно запомнить, что пока не вызван метод save() этот объект необязательно связан с сохранённым заказом. Также пока вы не вызовете save(), изменения в заказе не будут сохранены в базе данных.

Существующий заказ можно получить следующим образом:

/** int $orderId ID заказа */
$order = Sale\Order::load($orderId);

/** mixed $orderNumber номер заказа */
$order = Sale\Order::loadByAccountNumber($orderNumber);
Поля заказа можно получить короткими вызовами:

$order->getId(); // ID заказа
$order->getSiteId(); // ID сайта
$order->getDateInsert(); // объект Bitrix\Main\Type\DateTime
$order->getPersonTypeId(); // ID типа покупателя
$order->getUserId(); // ID пользователя

$order->getPrice(); // Сумма заказа
$order->getDiscountPrice(); // Размер скидки
$order->getDeliveryPrice(); // Стоимость доставки
$order->getSumPaid(); // Оплаченная сумма
$order->getCurrency(); // Валюта заказа

$order->isPaid(); // true, если оплачен
$order->isAllowDelivery(); // true, если разрешена доставка
$order->isShipped(); // true, если отправлен
$order->isCanceled(); // true, если отменен
Также любое поле по имени можно получить так:

$order->getField("ORDER_WEIGHT"); // Вес заказа
$order->getField('PRICE'); // Сумма заказа
// Изменение поля:
$order->setField('USER_DESCRIPTION', 'Комментарий к заказу');
$order->save();
Список доступных полей можно получить, вызвав $order->getAvailableFields().

Заказ имеет связь один-ко-многим с несколькими объектами в виде коллекций - коллекция товаров в корзине (Sale\Basket), коллекция отгрузок (Sale\ShipmentCollection), коллекция оплат (Sale\PaymentCollection) и коллекция свойств заказа (Sale\PropertyValueCollection).

Самый простой способ получить список способов доставки и оплаты - короткие вызовы:

$paymentIds = $order->getPaymentSystemId(); // массив id способов оплат
$deliveryIds = $order->getDeliverySystemId(); // массив id способов доставки
Чтобы получить список примененных к заказу скидок, нужно вызвать:

$discountData = $order->getDiscount()->getApplyResult();
В массиве $discountData['DISCOUNT_LIST'] содержится список скидок, в $discountData['COUPON_LIST'] содержится список купонов. Т.к. скидки можно отключать в админке, следует проверять поле APPLY: если Y - скидка/купон применёны, если N - были отключены менеджером.

Корзина заказа (Sale\Basket)
Про работу с корзиной была отдельная статья, привязать и получить корзину заказа можно так:

/** Sale\Basket $basket */
$order->setBasket($basket);

$basket = $order->getBasket();
Свойства заказа (Sale\PropertyValueCollection)
Свойства заказа - объекты Bitrix\Sale\PropertyValue - собраны в коллекции propertyCollection

$propertyCollection = $order->getPropertyCollection();
Получить значения всех свойств и группы свойств можно так:

$ar = $propertyCollection->getArray(); // массив ['properties' => [..], 'groups' => [..] ];
$ar = $propertyCollection->getGroups(); // массив групп
$ar = $propertyCollection->getGroupProperties($groupId); // массив свойств, относящихся к группе
У многих свойств заказа есть определенное встроенное назначение (атрибуты IS_EMAIL, IS_PAYER, IS_LOCATION, IS_LOCATION4TAX, IS_PROFILE_NAME, IS_ZIP, IS_PHONE, IS_ADDRESS). Такие свойства можно получить следующими методами:

$emailPropValue = $propertyCollection->getUserEmail();
$namePropValue  = $propertyCollection->getPayerName();
$locPropValue   = $propertyCollection->getDeliveryLocation();
$taxLocPropValue = $propertyCollection->getTaxLocation();
$profNamePropVal = $propertyCollection->getProfileName();
$zipPropValue   = $propertyCollection->getDeliveryLocationZip();
$phonePropValue = $propertyCollection->getPhone();
$addrPropValue  = $propertyCollection->getAddress();
Получить значение свойства по ID:

$somePropValue = $propertyCollection->getItemByOrderPropertyId($orderPropertyId);
В любом случае получаем значение свойства - экземпляр класса Bitrix\Sale\PropertyValue. Из него мы можем получить значение свойства:

$somePropValue->getValue(); // значение свойства
$somePropValue->getViewHtml(); // представление значения в читаемом виде (напр. для местоположения - путь страна, регион, город)
И информацию о самом свойстве:

$arProp  = $somePropValue->getProperty(); // массив данных о самом свойстве
$propId  = $somePropValue->getPropertyId(); // ID свойства
$propName = $somePropValue->getName(); // Название
$isRequired = $somePropValue->isRequired(); // true, если свойство обязательное
$propPerson = $somePropValue->getPersonTypeId(); // Тип плательщика
$propGroup  = $somePropValue->getGroupId(); // ID группы
Чтобы изменить значение свойства следует вызвать метод setValue и сохранить сущность

$somePropValue->setValue("value");
$order->save(); 
// можно $somePropValue->save(), но пересчета заказа не произойдёт
Оплаты заказа (Sale\PaymentCollection)
$paymentCollection = $order->getPaymentCollection();
Из коллекции оплат также можно получить информацию об оплате, что и из объекта заказа. Оплата с внутреннего счета также считается одной из оплат:

$paymentCollection->isPaid(); // true, если все оплаты оплачены
$paymentCollection->hasPaidPayment(); // true, если хотя бы одна оплата оплачена
$paymentCollection->getPaidSum(); // оплаченная сумма
$paymentCollection->isExistsInnerPayment(); // true, если осуществлена оплата с внутреннего счета
Коллекция содержит объекты оплаты Sale\Payment с информацией об оплатах:

foreach ($paymentCollection as $payment) {
    $sum = $payment->getSum(); // сумма к оплате
    $isPaid = $payment->isPaid(); // true, если оплачена
    $isReturned = $payment->isReturn(); // true, если возвращена

    $ps = $payment->getPaySystem(); // платежная система (объект Sale\PaySystem\Service)
    $psID = $payment->getPaymentSystemId(); // ID платежной системы
    $psName = $payment->getPaymentSystemName(); // название платежной системы
    $isInnerPs = $payment->isInner(); // true, если это оплата с внутреннего счета
}
Оплатить или вернуть оплату можно методами setPaid(), setReturn():

$onePayment = $paymentCollection[0];
$onePayment->setPaid("N"); // отмена оплаты
$onePayment->setPaid("Y"); // оплата
$onePayment->setReturn("Y"); // возврат (деньги возвращаются на внутренний счет или в платежную систему, если обработчик реализует интерфейс Sale\PaySystem\IRefund)
// после любых действий нужно сохранить сущность:
$order->save();
Инициировать оплату (вывести шаблон оплаты: форму, кнопку и т.п.) можно следующим образом:

$service = Sale\PaySystem\Manager::getObjectById($onePayment->getPaymentSystemId());
$context = \Bitrix\Main\Application::getInstance()->getContext();
$service->initiatePay($onePayment, $context->getRequest());
Пример оформления заказа в D7
Для примера приведу простейший код оформления заказа с комментариями

use Bitrix\Main\Context,
    Bitrix\Currency\CurrencyManager,
    Bitrix\Sale\Order,
    Bitrix\Sale\Basket,
    Bitrix\Sale\Delivery,
    Bitrix\Sale\PaySystem;

global $USER;

Bitrix\Main\Loader::includeModule("sale");
Bitrix\Main\Loader::includeModule("catalog");

// Допустим некоторые поля приходит в запросе
$request = Context::getCurrent()->getRequest();
$productId = $request["PRODUCT_ID"];
$phone = $request["PHONE"];
$name = $request["NAME"];
$comment = $request["COMMENT"];

$siteId = Context::getCurrent()->getSite();
$currencyCode = CurrencyManager::getBaseCurrency();

// Создаёт новый заказ
$order = Order::create($siteId, $USER->isAuthorized() ? $USER->GetID() : 539);
$order->setPersonTypeId(1);
$order->setField('CURRENCY', $currencyCode);
if ($comment) {
    $order->setField('USER_DESCRIPTION', $comment); // Устанавливаем поля комментария покупателя
}

// Создаём корзину с одним товаром
$basket = Basket::create($siteId);
$item = $basket->createItem('catalog', $productId);
$item->setFields(array(
    'QUANTITY' => 1,
    'CURRENCY' => $currencyCode,
    'LID' => $siteId,
    'PRODUCT_PROVIDER_CLASS' => '\CCatalogProductProvider',
));
$order->setBasket($basket);

// Создаём одну отгрузку и устанавливаем способ доставки - "Без доставки" (он служебный)
$shipmentCollection = $order->getShipmentCollection();
$shipment = $shipmentCollection->createItem();
$service = Delivery\Services\Manager::getById(Delivery\Services\EmptyDeliveryService::getEmptyDeliveryServiceId());
$shipment->setFields(array(
    'DELIVERY_ID' => $service['ID'],
    'DELIVERY_NAME' => $service['NAME'],
));
$shipmentItemCollection = $shipment->getShipmentItemCollection();
$shipmentItem = $shipmentItemCollection->createItem($item);
$shipmentItem->setQuantity($item->getQuantity());

// Создаём оплату со способом #1
$paymentCollection = $order->getPaymentCollection();
$payment = $paymentCollection->createItem();
$paySystemService = PaySystem\Manager::getObjectById(1);
$payment->setFields(array(
    'PAY_SYSTEM_ID' => $paySystemService->getField("PAY_SYSTEM_ID"),
    'PAY_SYSTEM_NAME' => $paySystemService->getField("NAME"),
));

// Устанавливаем свойства
$propertyCollection = $order->getPropertyCollection();
$phoneProp = $propertyCollection->getPhone();
$phoneProp->setValue($phone);
$nameProp = $propertyCollection->getPayerName();
$nameProp->setValue($name);

// Сохраняем
$order->doFinalAction(true);
$result = $order->save();
$orderId = $order->getId();
