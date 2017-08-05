<?php
function smarty_modifier_url_source($string)
{
	$raw_url= parse_url($string);
	//print_r($raw_url);
	//preg_match ("/\.([^\/]+)/", $raw_url['host'], $domain_only);
	return strtolower(str_replace("www.",'',$raw_url['host']));
}
?>
