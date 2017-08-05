<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {html_country} function plugin
 *
 * Type:     function<br>
 * Name:     html_country<br>
 * Input:<br>
 *           - key       (country code) - string default ""
 *         
 * Purpose:  Prints the country name from
 *           the passed param
 * @author kalai kumar.t < powerbyu dot com >
 * @param syring
 * @return string
 */
function smarty_function_get_field_value($params, &$smarty)
{
   !isset($params['name']) and  $smarty->trigger_error("get_field_value: missing 'name' parameter");
	echo "<script>alert(document.getElementById('".$params['name']."').value)</script>";
	$value=sprintf("%s","<script>document.getElementById('".$params['name']."').value");
	//print $country_codes[strtoupper($params['key'])];

}

?>
