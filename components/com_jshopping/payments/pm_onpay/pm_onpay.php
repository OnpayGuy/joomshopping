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

class pm_onpay extends PaymentRoot
{
	var $_OnpaySaveLog = false;
	static $_df_pay_mode = "fix";
	static $_df_form_id = "7";
	static $_df_pay_url = "http://secure.onpay.ru/pay/";
	static $_df_logo_url = "http://onpay.ru/images/onpay_logo.gif";
	static $_df_log_path = "/logs/.log.onpay_sale";

	function showPaymentForm($params, $pmconfigs) {
		include(dirname(__FILE__).'/paymentform.php');
	}
	
	function __SaveLog($data) {
		if($this->_OnpaySaveLog && $data) {
			$log_name = $_SERVER['DOCUMENT_ROOT'].self::$_df_log_path;
			if(!file_exists($log_name)) {
				mkdir($log_name);
				chmod($log_name, 0755);
			}
			$log_name .= "/".date('d').".php";
			$td = mktime(0, 0, 0, intval(date("m")), intval(date("d")), intval(date("Y")));
			$log_open = (!file_exists($log_name) || file_exists($log_name) && filemtime($log_name) < $td) ? "w" : "a+";
			if($fh = fopen($log_name, $log_open)) {
				if($log_open == "w") fwrite($fh, "#\n#<?php die('Forbidden.'); ?>\n#\n");
				fwrite($fh, "#".date("d.m.Y H:i:s")." ip:{$_SERVER['REMOTE_ADDR']}\n");
				if(is_array($data)) {
					$key = $data['key'] && in_array($data['type'], array('check', 'pay')) ? $data['key'] : false ;
					$str = serialize($data);
					if($key) {
						$str = str_replace($key, "#KEY#", $str);
					}
				} elseif(is_string($data)) {
					$str = $data;
				} else {
					$str = serialize($data);
				}
				fwrite($fh, $str."\n");
				fclose($fh);
				chmod($log_name, 0755);
			}
		}
	}
	
	//функция подключает языковый файл
	function loadLanguageFile()
	{
		$lang = JFactory::getLanguage();
		$langtag = $lang->getTag(); //определяем текущий язык

		if (file_exists(JPATH_ROOT.'/components/com_jshopping/payments/pm_onpay/lang/'.$langtag.'.php')) {
			require_once(JPATH_ROOT.'/components/com_jshopping/payments/pm_onpay/lang/'.$langtag.'.php');
		} else { 
			require_once(JPATH_ROOT.'/components/com_jshopping/payments/pm_onpay/lang/en-GB.php'); //если языковый файл не найден, то подключаем en-GB.php
		}
	}
	
	//функция показывает настройки плагина в админке
	function showAdminFormParams($params)
	{
		$array_params = array(
			'onpay_login', 
			'onpay_secret_key', 
			'convert',
			'price_final',
			'form_id',
			'lang',
			'currency_usd',
			'currency_eur',
			'currency_rur',
			'currency_rub',
			'currency_uah',
			'currency_byr',
			'add_params',
			'url_success', 
			'url_fail', 
			'transaction_end_status', 
			'transaction_pending_status', 
			'transaction_failed_status'
			);
		
		foreach ($array_params as $key) {
			if (!isset($params[$key])) {
				$params[$key] = '';
			}
		}

		$orders = JModelLegacy::getInstance('orders', 'JshoppingModel');
		$currency = JModelLegacy::getInstance('currencies', 'JshoppingModel'); 
		
		$this->loadLanguageFile(); //подключаем нужный язык
		
		include(dirname(__FILE__).'/adminparamsform.php');
	}
	
	//функция выдает ответ для сервиса onpay в формате XML на чек запрос 
	function answercheck($code, $pay_for, $order_amount, $order_currency, $text, $pmconfigs)
	{ 
		$md5 = strtoupper(md5("check;{$pay_for};{$order_amount};{$order_currency};{$code};".$pmconfigs['onpay_secret_key'])); 
		$ret = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<result>\n<code>{$code}</code>\n<pay_for>{$pay_for}</pay_for>\n<comment>{$text}</comment>\n<md5>{$md5}</md5>\n</result>";
		$this->__SaveLog($ret);
		return $ret;
	}
	
	//функция выдает ответ для сервиса onpay в формате XML на pay запрос 
	function answerpay($code, $pay_for, $order_amount, $order_currency, $text, $onpay_id, $pmconfigs)
	{ 
		$md5 = strtoupper(md5("pay;{$pay_for};{$onpay_id};{$pay_for};{$order_amount};{$order_currency};{$code};".$pmconfigs['onpay_secret_key'])); 
		$ret = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<result>\n<code>{$code}</code>\n<comment>{$text}</comment>\n<onpay_id>{$onpay_id}</onpay_id>\n<pay_for>{$pay_for}</pay_for>\n<order_id>{$pay_for}</order_id>\n<md5>{$md5}</md5>\n</result>"; 
		$this->__SaveLog($ret);
		return $ret;
	}
	
	//функция выводит результат в XML формате, в ответ на запрос сервера onpay
	function nofityFinish($pmconfigs, $order, $rescode)
	{
		die("___rez___\n".$this->rezult); //строка ___rez___ служит меткой для отделения заголовков от тела результата
	}
	
	//проверка входных данных от onpay
	function checkTransaction($pmconfigs, $order, $act) {

		$this->__SaveLog('checkTransaction:'.serialize($_REQUEST));
		
		$order->order_total = $this->to_float($order->order_total); //приводим сумму заказа в нужный формат		
		$this->rezult = '';
		$error = '';
		//получаем данные, что нам прислал запрос 
		$type = JRequest::getVar('type');
		$order_amount = $this->to_float(JRequest::getVar('order_amount'));
		$pay_for = JRequest::getVar('pay_for');
		$order_currency = JRequest::getVar('order_currency');
		
		$this->loadLanguageFile(); //подключаем нужный язык
		
		//проверяем чек запрос 
		if ($type == 'check') {
			if($this->CheckOrderPayAllow($pmconfigs, $order)) {
				die("___rez___\n".$this->answercheck(0, $pay_for, $order_amount, $order_currency, 'OK', $pmconfigs));
			} else {
				die("___rez___\n".$this->answercheck(2, $pay_for, $order_amount, $order_currency, 'Error order_id:' . $pay_for . ' in order_id!=order_id, order_sum>sum or order_status!=P', $pmconfigs));
			}
		}
		
		//проверяем pay запрос 
		if ($type == 'pay') { 
			//получаем данные
			$onpay_id = JRequest::getVar('onpay_id'); 
			$balance_amount = JRequest::getVar('balance_amount'); 
			$balance_currency = JRequest::getVar('balance_currency'); 
			$exchange_rate = JRequest::getVar('exchange_rate'); 
			$md5 = JRequest::getVar('md5'); 
			
			//производим проверки входных данных 
			if (empty($onpay_id)) {
				$error .= _JSHOP_ERROR_ONPAY_ID.'<br>';
			} else {
				if (!is_numeric(intval($onpay_id))) {
					$error .= _JSHOP_ERROR_ONPAY_NOT_NUM.'<br>';
				}
			}
			
			if (empty($order_amount)) {
				$error .= _JSHOP_ERROR_ONPAY_SUM.'<br>';
			} else {
				if (!is_numeric($order_amount)) {
					$error .= _JSHOP_ERROR_ONPAY_NOT_NUM.'<br>';
				}
			}
			 
			if (empty($balance_amount)) {
				$error .= _JSHOP_ERROR_ONPAY_SUM.'<br>';
			} else {
				if (!is_numeric(intval($balance_amount))) {
					$error .= _JSHOP_ERROR_ONPAY_NOT_NUM.'<br>';
				}
			}
			 
			if (empty($balance_currency)) {
				$error .= _JSHOP_ERROR_ONPAY_CUR.'<br>';
			} else {
				if (strlen($balance_currency) > 4) {
					$error .= _JSHOP_ERROR_ONPAY_TOLONG.'<br>';
				}
			}
			 
			if (empty($order_currency)) {
				$error .= _JSHOP_ERROR_ONPAY_CUR.'<br>';
			} else {
				if (strlen($order_currency) > 4) {
					$error .= _JSHOP_ERROR_ONPAY_TOLONG.'<br>';
				}
			}
			 
			if (empty($exchange_rate)) {
				$error .= _JSHOP_ERROR_ONPAY_SUM.'<br>';
			} else {
				if (!is_numeric($exchange_rate)) {
					$error .= _JSHOP_ERROR_ONPAY_NOT_NUM.'<br>';
				}
			} 

			//если нет ошибок 
			if (!$error) { 
				if (is_numeric($pay_for)) { //если pay_for - число 
					if($this->CheckOrderPayAllow($pmconfigs, $order, $order_amount)) {
						//создаем строку хэша с присланных данных 
						$md5fb = strtoupper(md5($type.";".$pay_for.";".$onpay_id.";".$order_amount.";".$order_currency.";".$pmconfigs['onpay_secret_key'])); 
						//сверяем строчки хеша (присланную и созданную нами) 
						if ($md5fb != $md5) {
							$this->rezult = $this->answerpay(8, $pay_for, $order_amount, $order_currency, _JSHOP_ERROR_ONPAY_MD5, $onpay_id, $pmconfigs);
							return array(0, _JSHOP_ERROR_ONPAY_MD5);
						} else { 
							$this->rezult = $this->answerpay(0, $pay_for, $order_amount, $order_currency, 'OK', $onpay_id, $pmconfigs);
							return array(1, '');
						}
					} else {
						$rezult = answerpay(10, $pay_for, $order_amount, $order_currency, 'Cannot find any pay rows acording to this parameters: wrong payment', $onpay_id);
					}
				} else {
					//если pay_for - не правильный формат 
					$this->rezult = $this->answerpay(11, $pay_for, $order_amount, $order_currency, _JSHOP_ERROR_ONPAY_PARAM, $onpay_id, $pmconfigs); 
					return array(0, _JSHOP_ERROR_ONPAY_PARAM);
				} 
			} else {
				//если есть ошибки 
				$this->rezult = $this->answerpay(12, $pay_for, $order_amount, $order_currency, _JSHOP_ERROR_ONPAY_PARAM.': '.$error, $onpay_id, $pmconfigs);
				return array(0, _JSHOP_ERROR_ONPAY_PARAM.': '.$error);
			} 
		} 
	
		return array(0, _JSHOP_ERROR_ONPAY_RESP.' '.$order->order_id);                    
	}

	function CheckOrderPayAllow($pmconfigs, $order, $sum=false) {
		$order_id = intval($order->order_id);
		$_sum = floatval($order->order_total);
		$order_status = intval($order->order_status);
		$order_pm_status = intval($pmconfigs['transaction_pending_status']);
		$ret = ($order_id > 0 && $_sum > 0 && $order_status > 0 && $order_pm_status > 0 && $order_status == $order_pm_status);
		if($ret && $sum !== false) {
			$sum = floatval($sum);
			$ret = ($sum >= $_sum);
		}
		$this->__SaveLog(array(
			'order_id' => $order_id,
			'order_total' => $_sum,
			'order_status' => $order_status,
			'email' => $order->email,
			'order_pm_status' => $order_pm_status,
			'order_pm_sum' => $sum
			));
		return $ret;
	}

	function getOnpayCurrency($code_iso, $pmconfigs) {
		return $pmconfigs["currency_".strtolower($code_iso)];
	}

	//функция показывает форму оплаты
	function showEndForm($pmconfigs, $order) {
		if($this->CheckOrderPayAllow($pmconfigs, $order)) {
			$this->loadLanguageFile();
			$arPay = array(
				'pay_mode' => self::$_df_pay_mode,
				'price' => self::to_float($order->order_total),
				'ticker' => self::getOnpayCurrency($order->currency_code_iso, $pmconfigs),
				'pay_for' => $order->order_id,
				'convert' => $pmconfigs['convert'] ? 'yes' : 'no',
				'key' => $pmconfigs['onpay_secret_key'],
				);
			$arPay['md5string'] = implode(';', $arPay);
			$arPay['md5'] = strtoupper(md5($arPay['md5string']));
			
			$login = $pmconfigs['onpay_login'];
			$form_id = $pmconfigs['form_id'] ? $pmconfigs['form_id'] : self::$_df_form_id;
			$user_email = urlencode($order->email);

			$uri = JURI::getInstance();        
			$urlhost = $uri->toString(array("scheme",'host', 'port'));
			$url_success = str_replace("#ORDER_ID#", $order->order_id, urlencode($pmconfigs['url_success']));
			if(empty($url_success)) {
				$url_success = urlencode($urlhost.SEFLink('/index.php?option=com_jshopping&controller=user&task=order&order_id='.$order->order_id));
			}
			$url_fail = str_replace("#ORDER_ID#", $order->order_id, urlencode($pmconfigs['url_fail']));
			if(empty($url_fail)) {
				$url_fail = urlencode($urlhost.SEFLink('/index.php?option=com_jshopping&controller=user&task=order&order_id='.$order->order_id));
			}
			
			$url = self::$_df_pay_url."{$login}?f={$form_id}&pay_mode={$arPay['pay_mode']}&pay_for={$arPay['pay_for']}&price={$arPay['price']}&ticker={$arPay['ticker']}&convert={$arPay['convert']}&md5={$arPay['md5']}&user_email={$user_email}&url_success={$url_success}&url_fail={$url_fail}";
			if($pmconfigs['price_final']) {
				$url .= "&price_final=true";
			}
			if($pmconfigs['lang']) {
				$url .= "&ln={$pmconfigs['lang']}";
			}
			if($pmconfigs['add_params']) {
				$url .= "&".str_replace("`", "=", $pmconfigs['add_params']);
			}
			?>
		<html>
			<head>
				<meta http-equiv="content-type" content="text/html; charset=utf-8" />           
			</head>
			<body>
				<form id="paymentform" action="<?php echo $url; ?>" name="paymentform" method="post">
					<div><img src="<?=self::$_df_logo_url?>" alt="" /></div>
					<?/*div><input type="submit" name="submit"  value="<?php echo _JSHOP_FRM_ONPAY_PAY?>" /></div*/?>
				</form>
			<?php echo _JSHOP_REDIRECT_TO_PAYMENT_PAGE; ?>
			<br>
			<script type="text/javascript">document.getElementById('paymentform').submit();</script>
			</body>
		</html>
		<?php
		die();	
		}
	}

	//функция переводит число в нужный формат
	function to_float($sum)
	{ 
		$sum = round(floatval($sum), 2);
		$sum = sprintf('%01.2f', $sum);
		
		if (substr($sum, -1) == '0') {
			$sum = sprintf('%01.1f', $sum);
		}
		
		return $sum;
	}

	//функция определяет ID заказа
	function getUrlParams($pmconfigs)
	{                        
		$params = array(); 
		$params['order_id'] = JRequest::getInt('pay_for');
		$params['hash'] = '';
		$params['checkHash'] = 0;
		$params['checkReturnParams'] = 0;
		
		$this->__SaveLog('getUrlParams:'.serialize($_REQUEST));

		return $params;
	}
}
?>