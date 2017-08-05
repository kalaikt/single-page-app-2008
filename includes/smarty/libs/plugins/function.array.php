<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

/**
 * Smarty {array} function plugin
 *
 * Type:     function<br>
 * Name:     array<br>
 * Date:     Aug 10, 2007<br>
 * Purpose:  create an array from a string<br>
 * Input:<br>
 *         - name = name of array
 *         - values= array elements as string

 * Examples:
 * {array name="list" values="one,two,three"}
 * {array name="list" values="one=>ONE,two=>TWO,three=>THREE"}
 * @author   kalai kumar.t <poweredbyu dot com>
 * @param array
 * @param Smarty
 */
function smarty_function_array($params, &$smarty)
{
    if (!isset($params['name'])) {
        $smarty->trigger_error("array: missing 'name' parameter");
        return;
    }
    if (!isset($params['values'])) {
        $smarty->trigger_error("array: missing 'values' parameter");
        return;
    }
	if(strpos($params['values'],'=>')>0){
		$temp=explode(',',$params['values']);
		foreach($temp as $key=>$value){
			$temp=explode('=>',$value);
			if($temp[1]=="")
				$string[]=trim($temp[0]);
			else
				$string[$temp[0]]=trim($temp[1]);
		}
		$arr[]=$string;
	}
	else{
		$arr=explode(',',trim($params['values']));
	}
	$smarty->assign($params['name'],$arr);
}

?>
