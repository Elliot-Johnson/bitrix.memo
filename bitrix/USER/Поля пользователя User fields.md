# Поля пользователя USER FIELDS

https://dev.1c-bitrix.ru/api_help/main/reference/cuser/index.php

Страна: WORK_COUNTRY ??? <option selected="" value="1">Россия</option>  
Область / край: WORK_STATE  
Почтовый индекс: WORK_ZIP  
Улица, дом: WORK_STREET  
Почтовый ящик: WORK_MAILBOX


# Поля
Поле 	Тип 	Описание  
ID 	int 	ID пользователя.  
XML_ID 	int 	ID пользователя для связи с внешними источниками (например, ID пользователя в какой-либо внешний базе).  
TIMESTAMP_X 	datetime 	Последнее изменение.  
LOGIN 	varchar (50) 	Имя входа.  
PASSWORD 	varchar (50) 	Хеш от пароля.  
STORED_HASH 	varchar (32) 	Хеш от пароля хранимый в куках пользователя.  
CHECKWORD 	varchar (50) 	Контрольная строка для смены пароля.  
ACTIVE 	char 	Активен (Y|N).  
NAME 	varchar (50) 	Имя.  
LAST_NAME 	varchar (50) 	Фамилия.  
SECOND_NAME 	varchar (50) 	Отчество.  
EMAIL 	varchar (255) 	E-mail адрес.  
LAST_LOGIN 	datetime 	Дата последней авторизации.  
LAST_ACTIVITY_DATE 	datetime 	Дата последнего хита на сайте.  
DATE_REGISTER 	datetime 	Дата регистрации.  
LID 	char (2) 	ID сайта по умолчанию для уведомлений.  
ADMIN_NOTES 	varchar (2000) 	Заметки администратора.  
EXTERNAL_AUTH_ID 	varchar (255) 	Код источника Внешней авторизации.  
## Личные данные:
PERSONAL_PROFESSION 	varchar (255) 	Профессия.  
PERSONAL_WWW 	varchar (255) 	WWW-страница.  
PERSONAL_ICQ 	varchar (255) 	ICQ.  
PERSONAL_GENDER 	char (1) 	Пол.  
PERSONAL_BIRTHDAY 	date 	Дата рождения.  
PERSONAL_PHOTO 	int 	Фотография.  
PERSONAL_PHONE 	varchar (255) 	Телефон.  
PERSONAL_FAX 	varchar (255) 	Факс.  
PERSONAL_MOBILE 	varchar (255) 	Мобильный телефон.  
PERSONAL_PAGER 	varchar (255) 	Пэйджер.  
PERSONAL_STREET 	varchar (2000) 	Улица, дом.  
PERSONAL_MAILBOX 	varchar (255) 	Почтовый ящик.  
PERSONAL_CITY 	varchar (255) 	Город.  
PERSONAL_STATE 	varchar (255) 	Область / край.  
PERSONAL_ZIP 	varchar (255) 	Индекс.  
PERSONAL_COUNTRY 	varchar (255) 	Страна.  
PERSONAL_NOTES 	varchar (2000) 	Дополнительные заметки.  
## Информация о работе:
WORK_COMPANY 	varchar (255) 	Наименование компании.  
WORK_DEPARTMENT 	varchar (255) 	Департамент / Отдел.  
WORK_POSITION 	varchar (255) 	Должность.  
WORK_WWW 	varchar (255) 	WWW-страница.  
WORK_PHONE 	varchar (255) 	Телефон.  
WORK_FAX 	varchar (255) 	Факс.  
WORK_PAGER 	varchar (255) 	Пэйджер.  
WORK_STREET 	varchar (2000) 	Улица, дом.  
WORK_MAILBOX 	varchar (255) 	Почтовый ящик.  
WORK_CITY 	varchar (255) 	Город.  
WORK_STATE 	varchar (255) 	Область / край.  
WORK_ZIP 	varchar (255) 	Индекс.  
WORK_COUNTRY 	varchar (255) 	Страна.  
WORK_PROFILE 	varchar (2000) 	Направления деятельности.  
WORK_LOGO 	int 	Логотип.  
WORK_NOTES 	varchar (2000) 	Дополнительные заметки.  
