<?php
/*
* @package JoomShopping for Joomla!
* @subpackage payment
* @author CM-S.ru
* @copyright Copyright (C) 2012-2013 CM-S.ru. All rights reserved.
* @license GNU General Public License version 2 or later
*/

//защита от прямого доступа
defined('_JEXEC') or die();

//определяем константы для украинского языка
define('_JSHOP_CFG_ONPAY_LOGIN', 'Ім\'я користувача');
define('_JSHOP_CFG_ONPAY_LOGIN_DESCRIPTION', 'Ваш логін в системі Onpay.ru');
define('_JSHOP_CFG_ONPAY_SECRET_KEY', 'Пароль для API IN');
define('_JSHOP_CFG_ONPAY_SECRET_KEY_DESCRIPTION', 'Повинен співпадати зі вказаним в "Личном Кабинете" Onpay.ru, розділ <b>Настройки интернет-магазина</b>');
define('_JSHOP_CFG_ONPAY_PRICE_FINAL', 'Комісію платіжної системи стягувати з продавця?');
define('_JSHOP_CFG_ONPAY_PRICE_FINAL_DESCRIPTION', 'Якщо Так, то до вартості замовлення не буде додаватися комісія платіжної системи на введення');
define('_JSHOP_CFG_ONPAY_ADD_PARAMS', 'Додаткові параметри');
define('_JSHOP_CFG_ONPAY_ADD_PARAMS_DESCRIPTION', 'Додаткові параметри до форми оплати. Формат - параметр = значення, роздільник - &');
define('_JSHOP_CFG_ONPAY_URL_SUCCESS', 'Ссилка успішного завершення платежу');
define('_JSHOP_CFG_ONPAY_URL_SUCCESS_DESCRIPTION', 'Посилання, на яке буде переадресований користувач після успішного завершення платежу. <b>
Увага! Не може містити параметри (все, що іде після «?» в посиланню).</b>');
define('_JSHOP_CFG_ONPAY_URL_FAIL', 'Ссилка невдалого завершення платежу');
define('_JSHOP_CFG_ONPAY_URL_FAIL_DESCRIPTION', 'Ссилка, на яку буде переадресований користувач після невдалого завершення платежу. <b>Увага! Не може містити параметри (все, що іде після «?» в посиланню).</b>');
define('_JSHOP_ERROR_ONPAY_ID', 'Не вказаний id');
define('_JSHOP_ERROR_ONPAY_NOT_NUM', 'Параметр не є числом');
define('_JSHOP_ERROR_ONPAY_SUM', 'Не вказана сума');
define('_JSHOP_ERROR_ONPAY_CUR', 'Не вказана валюта');
define('_JSHOP_ERROR_ONPAY_TOLONG', 'Параметр надто довгий');
define('_JSHOP_ERROR_ONPAY_MD5', 'Не правильна md5 сигнатура');
define('_JSHOP_ERROR_ONPAY_PARAM', 'Помилка в параметрах данних');
define('_JSHOP_ERROR_ONPAY_RESP', 'Помилка відповіді. Номер заказу');

define("_JSHOP_CFG_ONPAY_CONVERT", "Конвертировать поступающие платежи в валюту заказа");
define("_JSHOP_CFG_ONPAY_CONVERT_DESCRIPTION", "Параметр «convert» платёжной ссылки");
define("_JSHOP_CFG_ONPAY_FORMID", "Вариант дизайна платежной формы");
define("_JSHOP_CFG_ONPAY_FORMID_FORM_DEFAULT_CAPTION", "Вариант дизайна платежной формы");
define("_JSHOP_CFG_ONPAY_FORMID_DESIGN_N7_CAPTION", "Дизайн №7");
define("_JSHOP_CFG_ONPAY_FORMID_DESIGN_N8_CAPTION", "Дизайн №8");
define("_JSHOP_CFG_ONPAY_FORMID_MOBILE_FORM_CAPTION", "Мобильная форма");
define("_JSHOP_CFG_ONPAY_LANG", "Язык отображения платежной формы");
define("_JSHOP_CFG_ONPAY_LANG_DEFAULT_CAPTION", "по умолчанию - русский");
define("_JSHOP_CFG_ONPAY_LANG_EN_CAPTION", "английский");
define("_JSHOP_CFG_ONPAY_CURRENCY", "Валюта для");
define("_JSHOP_CFG_ONPAY_CURRENCY_OPTION_RUR_CAPTION", "Российский рубль");
define("_JSHOP_CFG_ONPAY_CURRENCY_OPTION_EUR_CAPTION", "Евро");
define("_JSHOP_CFG_ONPAY_CURRENCY_OPTION_USD_CAPTION", "Доллар");
define("_JSHOP_CFG_ONPAY_CURRENCY_OPTION_TST_CAPTION", "Тестовый платёж");
define("_JSHOP_CFG_ONPAY_CURRENCY_OPTION_LIE_CAPTION", "LiqPay LIE (Евро)");
define("_JSHOP_CFG_ONPAY_CURRENCY_OPTION_LIQ_CAPTION", "LiqPay LIQ (Рос. рубль)");
define("_JSHOP_CFG_ONPAY_CURRENCY_OPTION_LIU_CAPTION", "LiqPay LIU (Гривна)");
define("_JSHOP_CFG_ONPAY_CURRENCY_OPTION_LIZ_CAPTION", "LiqPay LIZ (Доллар)");
define("_JSHOP_CFG_ONPAY_CURRENCY_OPTION_WMB_CAPTION", "Webmoney WMB (Бел. рубль)");
define("_JSHOP_CFG_ONPAY_CURRENCY_OPTION_WME_CAPTION", "Webmoney WME (Евро)");
define("_JSHOP_CFG_ONPAY_CURRENCY_OPTION_WMR_CAPTION", "Webmoney WMR (Рос. рубль)");
define("_JSHOP_CFG_ONPAY_CURRENCY_OPTION_WMU_CAPTION", "Webmoney WMU (Гривна)");
define("_JSHOP_CFG_ONPAY_CURRENCY_OPTION_WMZ_CAPTION", "Webmoney WMZ (Доллар)");
define("_JSHOP_FRM_ONPAY_PAY", "Оплатить");
define("_JSHOP_CFG_ONPAY_API_URL", "URL скрипта для API-запросов<br /><small style=\"white-space: nowrap;color:#999;\">Параметр \"URL API\" в личном кабинете системы OnPay.ru&nbsp;&nbsp;</small>");
