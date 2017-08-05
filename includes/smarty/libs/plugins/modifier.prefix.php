<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty wordwrap modifier plugin
 *
 * Type:     modifier<br>
 * Name:     prefix<br>
 * Purpose:  Concat the string with "_"
 * @author   kalai kumr.t <poweredbyu dot com>
 * @param string
 * @param string
 * @return string
 */
function smarty_modifier_prefix($string, $prefix='')
{
	return $string==""?$prefix:$string."_".$prefix;
}

?>
