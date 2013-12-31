<?php
/*
* @package JoomShopping for Joomla!
* @subpackage payment
* @author CM-S.ru
* @copyright Copyright (C) 2012-2013 CM-S.ru. All rights reserved.
* @license GNU General Public License version 2 or later
*/

//защита от прямого доступа
defined('_JEXEC') or die(); ?>

<script type="text/javascript">
	function check_pm_onpay() {
		jQuery('#payment_form').submit();
	}
</script>