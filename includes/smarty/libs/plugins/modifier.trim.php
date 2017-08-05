<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty trim modifier plugin
 *
 * Type:     modifier<br>
 * Name:     trim<br>
 * Purpose:  Trim a string.
 * @author   kalai kumar <poweredbyu not com>
 * @param string
 * @param string
 */
function smarty_modifier_trim($string, $mode="trim")
{
	switch($mode){
		case 'ltrim':
				$string=ltrim($string);
			break;	
		case 'rtrim':
				$string=rtrim($string);
			break;
		default:
			$string=trim($string);
	}
	return $string;
}

?>
