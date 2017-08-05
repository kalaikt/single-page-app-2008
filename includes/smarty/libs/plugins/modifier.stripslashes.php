<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty strip modifier plugin
 *
 * Type:     modifier<br>
 * Name:     stripslashes<br>
 * Purpose:  Replace all \ slashes.
 * Example:  {$var|stripslashes} 
 * Date:     September 28th, 2007
 * @author   kalai kumar <powered by u dot com>
 * @version  1.0
 * @param string
 * @param string
 * @return string
 */
function smarty_modifier_stripslashes($text)
{
    return stripslashes($text);
}

/* vim: set expandtab: */

?>
