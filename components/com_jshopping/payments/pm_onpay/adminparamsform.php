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

//вывод настроек плагина
?>
<div class="col100">
	<fieldset class="adminform">
		<table class="admintable" width="100%">
			<tr>
				<td class="key" width="300">
					<?php echo _JSHOP_CFG_ONPAY_API_URL; ?></td>
				<td>
					<b><?php echo JURI::root()."index.php?option=com_jshopping&controller=checkout&task=step7&act=notify&js_paymentclass=pm_onpay"; ?></b>
				</td>
			</tr>
			<tr>
				<td class="key" width="300">
					<?php echo _JSHOP_CFG_ONPAY_LOGIN; ?></td>
				<td>
					<input type="text" name="pm_params[onpay_login]" class="inputbox" value="<?php echo $params['onpay_login']; ?>" />
					<?php echo JHTML::tooltip(_JSHOP_CFG_ONPAY_LOGIN_DESCRIPTION); ?>
				</td>
			</tr>
			<tr>
				<td class="key">
					<?php echo _JSHOP_CFG_ONPAY_SECRET_KEY; ?>
				</td>
				<td>
					<input type="text" name="pm_params[onpay_secret_key]" class="inputbox" value="<?php echo $params['onpay_secret_key'];?>" />
					<?php echo JHTML::tooltip(_JSHOP_CFG_ONPAY_SECRET_KEY_DESCRIPTION); ?>
				</td>
			</tr>
			<tr>
				<td class="key">
					<?php echo _JSHOP_CFG_ONPAY_CONVERT; ?>
				</td>
				<td>
					<?php
						echo JHTML::_('select.booleanlist', 'pm_params[convert]', 'class="inputbox" size="1"', $params['convert'], 'JYES', 'JNO', false);
						echo JHTML::tooltip(_JSHOP_CFG_ONPAY_CONVERT_DESCRIPTION);
					?>
				</td>
			</tr>
			<tr>
				<td class="key">
					<?php echo _JSHOP_CFG_ONPAY_PRICE_FINAL; ?>
				</td>
				<td>
					<?php
						echo JHTML::_('select.booleanlist', 'pm_params[price_final]', 'class="inputbox" size="1"', $params['price_final'], 'JYES', 'JNO', false);
						echo JHTML::tooltip(_JSHOP_CFG_ONPAY_PRICE_FINAL_DESCRIPTION);
					?>
				</td>
			</tr>
			<tr>
				<td class="key">
					<?php echo _JSHOP_CFG_ONPAY_FORMID; ?>
				</td>
				<td>
				<?php
					$arFormIDs = array(
						array('id'=>2, 'name'=>_JSHOP_CFG_ONPAY_FORMID_FORM_DEFAULT_CAPTION),
						array('id'=>7, 'name'=>_JSHOP_CFG_ONPAY_FORMID_DESIGN_N7_CAPTION),
						array('id'=>8, 'name'=>_JSHOP_CFG_ONPAY_FORMID_DESIGN_N8_CAPTION),
						array('id'=>9, 'name'=>_JSHOP_CFG_ONPAY_FORMID_MOBILE_FORM_CAPTION),
						);
					echo JHTML::_('select.genericlist', $arFormIDs, 'pm_params[form_id]', 'class="inputbox"', 'id', 'name', $params['form_id']);
				?>
				</td>
			</tr>
			<tr>
				<td class="key">
					<?php echo _JSHOP_CFG_ONPAY_LANG; ?>
				</td>
				<td>
				<?php
					$arFormIDs = array(
						array('id'=>'', 'name'=>_JSHOP_CFG_ONPAY_LANG_DEFAULT_CAPTION),
						array('id'=>'en', 'name'=>_JSHOP_CFG_ONPAY_LANG_EN_CAPTION),
						);
					echo JHTML::_('select.genericlist', $arFormIDs, 'pm_params[lang]', 'class="inputbox"', 'id', 'name', $params['lang']);
				?>
				</td>
			</tr>
<?
		$arCurrency = array(
		    array('id'=>"RUR", 'name'=>_JSHOP_CFG_ONPAY_CURRENCY_OPTION_RUR_CAPTION),
		    array('id'=>"EUR", 'name'=>_JSHOP_CFG_ONPAY_CURRENCY_OPTION_EUR_CAPTION),
		    array('id'=>"USD", 'name'=>_JSHOP_CFG_ONPAY_CURRENCY_OPTION_USD_CAPTION),
		    array('id'=>"TST", 'name'=>_JSHOP_CFG_ONPAY_CURRENCY_OPTION_TST_CAPTION),
		    array('id'=>"LIE", 'name'=>_JSHOP_CFG_ONPAY_CURRENCY_OPTION_LIE_CAPTION),
		    array('id'=>"LIQ", 'name'=>_JSHOP_CFG_ONPAY_CURRENCY_OPTION_LIQ_CAPTION),
		    array('id'=>"LIU", 'name'=>_JSHOP_CFG_ONPAY_CURRENCY_OPTION_LIU_CAPTION),
		    array('id'=>"LIZ", 'name'=>_JSHOP_CFG_ONPAY_CURRENCY_OPTION_LIZ_CAPTION),
		    array('id'=>"WMB", 'name'=>_JSHOP_CFG_ONPAY_CURRENCY_OPTION_WMB_CAPTION),
		    array('id'=>"WME", 'name'=>_JSHOP_CFG_ONPAY_CURRENCY_OPTION_WME_CAPTION),
		    array('id'=>"WMR", 'name'=>_JSHOP_CFG_ONPAY_CURRENCY_OPTION_WMR_CAPTION),
		    array('id'=>"WMU", 'name'=>_JSHOP_CFG_ONPAY_CURRENCY_OPTION_WMU_CAPTION),
		    array('id'=>"WMZ", 'name'=>_JSHOP_CFG_ONPAY_CURRENCY_OPTION_WMZ_CAPTION),
			);
			foreach($currency->getAllCurrencies() as $oCurrency):
				$currency_code = $oCurrency->currency_code_iso;?>
			<tr>
				<td class="key">
					<?php 
					echo _JSHOP_CFG_ONPAY_CURRENCY, ' ', $currency_code;
					$currency_code = strtolower($currency_code);
					?>
				</td>
				<td>
				<?php
					echo JHTML::_('select.genericlist', $arCurrency, "pm_params[currency_{$currency_code}]", 'class="inputbox"', 'id', 'name', $params["currency_{$currency_code}"]);
				?>
				</td>
			</tr>
			<?endforeach;
			$key = md5(__FILE__);
			?>
            <tr>
				<td class="key">
					<?php echo _JSHOP_CFG_ONPAY_ADD_PARAMS; ?>
				</td>
				<td>
					<input type="text" class="inputbox" value="<?php echo str_replace("`", "=", $params['add_params']);?>" onblur="f_params_<?=$key?>_add_paramsalert(this.value);" />
					<input type="hidden" id="pm_params_<?=$key?>_add_params" name="pm_params[add_params]" value="<?php echo $params['add_params'];?>" />
					<?php echo JHTML::tooltip(_JSHOP_CFG_ONPAY_ADD_PARAMS_DESCRIPTION); ?>
<script type="text/javascript">
function f_params_<?=$key?>_add_paramsalert( vl ) {
	if(vl) {
		var a = vl.split('=');
		vl = a.join('`');
	} else {
		vl = "";
	}
	var obj=document.getElementById("pm_params_<?=$key?>_add_params");
	if(obj) {
		obj.value = vl;
	}
}
</script>
				</td>
			</tr>
            <tr>
				<td class="key">
					<?php echo _JSHOP_CFG_ONPAY_URL_SUCCESS; ?>
				</td>
				<td>
					<input type="text" name="pm_params[url_success]" class="inputbox" value="<?php echo $params['url_success'];?>" />
					<?php echo JHTML::tooltip(_JSHOP_CFG_ONPAY_URL_SUCCESS_DESCRIPTION); ?>
				</td>
			</tr>
			<tr>
				<td class="key">
					<?php echo _JSHOP_CFG_ONPAY_URL_FAIL; ?>
				</td>
				<td>
					<input type="text" name="pm_params[url_fail]" class="inputbox" value="<?php echo $params['url_fail'];?>" />
					<?php echo JHTML::tooltip(_JSHOP_CFG_ONPAY_URL_FAIL_DESCRIPTION); ?>
				</td>
			</tr>
			<tr>
				<td class="key">
					<?php echo _JSHOP_TRANSACTION_END; ?>
				</td>
				<td>
				<?php
					echo JHTML::_('select.genericlist', $orders->getAllOrderStatus(), 'pm_params[transaction_end_status]', 'class="inputbox" size="1"', 'status_id', 'name', $params['transaction_end_status']);
				?>
				</td>
			</tr>
			<tr>
				<td class="key">
					<?php echo _JSHOP_TRANSACTION_PENDING; ?>
				</td>
				<td>
				<?php 
					echo JHTML::_('select.genericlist', $orders->getAllOrderStatus(), 'pm_params[transaction_pending_status]', 'class="inputbox" size="1"', 'status_id', 'name', $params['transaction_pending_status']);
				?>
				</td>
			</tr>
			<tr>
				<td class="key">
					<?php echo _JSHOP_TRANSACTION_FAILED; ?>
				</td>
				<td>
				<?php 
					echo JHTML::_('select.genericlist', $orders->getAllOrderStatus(), 'pm_params[transaction_failed_status]', 'class="inputbox" size="1"', 'status_id', 'name', $params['transaction_failed_status']);
				?>
				</td>
			</tr>
		</table>
	</fieldset>
</div>
<div class="clr"></div>