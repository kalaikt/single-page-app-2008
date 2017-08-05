<?php
/**
 * Smarty {array} function plugin
 *
 * Type:     function<br>
 * Name:     array<br>
 * Date:     Aug 10, 2007<br>
 * Purpose:  create an array from a string<br>
 * Input:<br>
 *         - name = name of array
 * Examples:
 * {print_r name=$list}
 * @author   kalai kumar.t <poweredbyu dot com>
 * @param array
 * @param Smarty
 */
 
function smarty_function_print_r($params, &$smarty)
{
    if (!isset($params['name'])) {
        $smarty->trigger_error("array: missing 'name' parameter");
        return;
    }
   	echo "<pre>";
	print_r($params['name']);
}
?>