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

//определяем константы для русского языка
define('_JSHOP_CFG_ONPAY_LOGIN', 'Имя пользователя');
define('_JSHOP_CFG_ONPAY_LOGIN_DESCRIPTION', 'Ваш логин в системе Onpay.ru');
define('_JSHOP_CFG_ONPAY_SECRET_KEY', 'Пароль для API IN');
define('_JSHOP_CFG_ONPAY_SECRET_KEY_DESCRIPTION', 'Должен совпадать с указанным в Личном Кабинете Onpay.ru, раздел <b>Настройки интернет-магазина</b>');
define('_JSHOP_CFG_ONPAY_PRICE_FINAL', 'Комиссию платежной системы взымать с продавца?');
define('_JSHOP_CFG_ONPAY_PRICE_FINAL_DESCRIPTION', 'Если Да, то к стоимости заказа не будет прибавляться комиссия платежной системы на ввод');
define('_JSHOP_CFG_ONPAY_ADD_PARAMS', 'Дополнительные параметры');
define('_JSHOP_CFG_ONPAY_ADD_PARAMS_DESCRIPTION', 'Дополнительные параметры к форме оплаты. Формат - параметр=значение, разделитель - &');
define('_JSHOP_CFG_ONPAY_URL_SUCCESS', 'Ссылка успешного завершения платежа');
define('_JSHOP_CFG_ONPAY_URL_SUCCESS_DESCRIPTION', 'Ссылка, на которую будет переадресован пользователь после успешного завершения платежа. <b>
Внимание! Не может содержать параметры запроса (все, что идет после «?» в ссылке)</b>');
define('_JSHOP_CFG_ONPAY_URL_FAIL', 'Ссылка неудачного завершения платежа');
define('_JSHOP_CFG_ONPAY_URL_FAIL_DESCRIPTION', 'Ссылка, на которую будет переадресован пользователь после неудачного завершения платежа. <b>Внимание! Не может содержать параметры запроса (все, что идет после «?» в ссылке)</b>');
define('_JSHOP_ERROR_ONPAY_ID', 'Не указан id');
define('_JSHOP_ERROR_ONPAY_NOT_NUM', 'Параметр не является числом');
define('_JSHOP_ERROR_ONPAY_SUM', 'Не указана сумма');
define('_JSHOP_ERROR_ONPAY_CUR', 'Не указана валюта');
define('_JSHOP_ERROR_ONPAY_TOLONG', 'Параметр слишком длинный');
define('_JSHOP_ERROR_ONPAY_MD5', 'Не правильная Md5 сигнатура');
define('_JSHOP_ERROR_ONPAY_PARAM', 'Ошибка в параметрах данных');
define('_JSHOP_ERROR_ONPAY_RESP', 'Ошибка ответа. Номер заказа');

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
