<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty search highlight modifier plugin
 *
 * Type:     modifier<br>
 * Name:     search_highlight<br>
 * Purpose:  highlight search terms in title
 * @param string
 * @return string
 */
function smarty_modifier_search_highlight($string)
{
		if($_GET['search'] || $_GET['series']) {
			$search = $_GET['series'] ? $_GET['series'] : $_GET['search'];
			$words = explode(' ',trim($search));
			$title = $string;
			if($_GET['method'] != 'exact') {
				foreach($words as $word) {
					$title = eregi_replace($word,'{'.stripslashes($word).'}',$title);
				}
			}
			else {
					$title = eregi_replace($search,'{'.stripslashes($search).'}',$title);
			}
	
			return str_replace('{','<span class="highlight">',str_replace('}','</span>',$title));
		}
		else {
			return $string;
		}
}

?>
