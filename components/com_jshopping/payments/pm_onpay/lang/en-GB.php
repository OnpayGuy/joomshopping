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

//определяем константы для английского языка
define('_JSHOP_CFG_ONPAY_LOGIN', 'User name');
define('_JSHOP_CFG_ONPAY_LOGIN_DESCRIPTION', 'Your login in Onpay.ru');
define('_JSHOP_CFG_ONPAY_SECRET_KEY', 'Password for API IN');
define('_JSHOP_CFG_ONPAY_SECRET_KEY_DESCRIPTION', 'Should match in the Personal Area Onpay.ru, the <b>Settings online store</b>');
define('_JSHOP_CFG_ONPAY_PRICE_FINAL', 'Commission to charge a payment system with the seller?');
define('_JSHOP_CFG_ONPAY_PRICE_FINAL_DESCRIPTION', 'If Yes, to the cost of the order will be added no commission payment system to enter');
define('_JSHOP_CFG_ONPAY_ADD_PARAMS', 'Additional parameters');
define('_JSHOP_CFG_ONPAY_ADD_PARAMS_DESCRIPTION', 'Additional parameters to the form of payment. Format - parameter = value separator - &');
define('_JSHOP_CFG_ONPAY_URL_SUCCESS', 'Link to the successful completion of payment');
define('_JSHOP_CFG_ONPAY_URL_SUCCESS_DESCRIPTION', 'Link to which the user will be redirected after a successful completion of payment. <b>
Attention! Can not contain the query parameters (everything that comes after the "?" in the link).</b>');
define('_JSHOP_CFG_ONPAY_URL_FAIL', 'Link unsuccessful completion of payment');
define('_JSHOP_CFG_ONPAY_URL_FAIL_DESCRIPTION', 'Link, which will redirect the user after unsuccessful completion of payment. <b>Attention! Can not contain the query parameters (everything that comes after the "?" in the link).</b>');
define('_JSHOP_ERROR_ONPAY_ID', 'Unknown id');
define('_JSHOP_ERROR_ONPAY_NOT_NUM', 'The parameter is not a number');
define('_JSHOP_ERROR_ONPAY_SUM', 'Do not state the amount of');
define('_JSHOP_ERROR_ONPAY_CUR', 'Not specified currency');
define('_JSHOP_ERROR_ONPAY_TOLONG', 'The parameter is too long');
define('_JSHOP_ERROR_ONPAY_MD5', 'Md5 signature is wrong');
define('_JSHOP_ERROR_ONPAY_PARAM', 'Error in parameters data');
define('_JSHOP_ERROR_ONPAY_RESP', 'Error response. Order ID');

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
