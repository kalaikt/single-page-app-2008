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
function smarty_function_html_show_country($params, &$smarty)
{
    $country_codes = array(
                        "us" => "united states",
                        "ca" => "canada",
                        "al" => "albania",
                        "dz" => "algeria",
                        "as" => "american samoa",
                        "ad" => "andorra",
                        "ao" => "angola",
                        "ai" => "anguilla",
                        "aq" => "antarctica",
                        "ag" => "antigua and barbuda",
                        "ar" => "argentina",
                        "am" => "armenia",
                        "aw" => "aruba",
                        "au" => "australia",
                        "at" => "austria",
                        "az" => "azerbaijan",
                        "bs" => "bahamas",
                        "bh" => "bahrain",
                        "bd" => "bangladesh",
                        "bb" => "barbados",
                        "by" => "belarus",
                        "be" => "belgium",
                        "bz" => "belize",
                        "bj" => "benin",
                        "bm" => "bermuda",
                        "bt" => "bhutan",
                        "bo" => "bolivia",
                        "ba" => "bosnia and herzegovina",
                        "bw" => "botswana",
                        "bv" => "bouvet island",
                        "br" => "brazil",
                        "io" => "british indian ocean territory",
                        "bn" => "brunei darussalam",
                        "bg" => "bulgaria",
                        "bf" => "burkina faso",
                        "bi" => "burundi",
                        "kh" => "cambodia",
                        "cm" => "cameroon",
                        "cv" => "cape verde",
                        "ky" => "cayman islands",
                        "cf" => "central african republic",
                        "td" => "chad",
                        "cl" => "chile",
                        "cn" => "china",
                        "cx" => "christmas island",
                        "cc" => "cocos (keeling) islands",
                        "co" => "colombia",
                        "km" => "comoros",
                        "cg" => "congo",
                        "cd" => "congo",
                        "ck" => "cook islands",
                        "cr" => "costa rica",
                        "ci" => "cote d'ivoire",
                        "hr" => "croatia",
                        "cu" => "cuba",
                        "cy" => "cyprus",
                        "cz" => "czech republic",
                        "dk" => "denmark",
                        "dj" => "djibouti",
                        "dm" => "dominica",
                        "do" => "dominican republic",
                        "tp" => "east timor",
                        "ec" => "ecuador",
                        "eg" => "egypt",
                        "sv" => "el salvador",
                        "gq" => "equatorial guinea",
                        "er" => "eritrea",
                        "ee" => "estonia",
                        "et" => "ethiopia",
                        "fk" => "falkland islands (malvinas)",
                        "fo" => "faroe islands",
                        "fj" => "fiji",
                        "fi" => "finland",
                        "fr" => "france",
                        "gf" => "french guiana",
                        "pf" => "french polynesia",
                        "tf" => "french southern territories",
                        "ga" => "gabon",
                        "gm" => "gambia",
                        "ge" => "georgia",
                        "de" => "germany",
                        "gh" => "ghana",
                        "gi" => "gibraltar",
                        "gb" => "great britain",
                        "gr" => "greece",
                        "gl" => "greenland",
                        "gd" => "grenada",
                        "gp" => "guadeloupe",
                        "gu" => "guam",
                        "gt" => "guatemala",
                        "gn" => "guinea",
                        "gw" => "guinea-bissau",
                        "gy" => "guyana",
                        "ht" => "haiti",
                        "hm" => "heard island and mcdonald islands",
                        "va" => "holy see (vatican city state)",
                        "hn" => "honduras",
                        "hk" => "hong kong",
                        "hu" => "hungary",
                        "is" => "iceland",
                        "in" => "india",
                        "id" => "indonesia",
                        "ir" => "iran",
                        "iq" => "iraq",
                        "ie" => "ireland",
                        "il" => "israel",
                        "it" => "italy",
                        "jm" => "jamaica",
                        "jp" => "japan",
                        "jo" => "jordan",
                        "kz" => "kazakstan",
                        "ke" => "kenya",
                        "ki" => "kiribati",
                        "kr" => "korea, republic of",
                        "kw" => "kuwait",
                        "kg" => "kyrgyzstan",
                        "la" => "lao people's democratic republic",
                        "lv" => "latvia",
                        "lb" => "lebanon",
                        "ls" => "lesotho",
                        "lr" => "liberia",
                        "ly" => "libyan arab jamahiriya",
                        "li" => "liechtenstein",
                        "lt" => "lithuania",
                        "lu" => "luxembourg",
                        "mo" => "macau",
                        "mk" => "macedonia",
                        "mg" => "madagascar",
                        "mw" => "malawi",
                        "my" => "malaysia",
                        "mv" => "maldives",
                        "ml" => "mali",
                        "mt" => "malta",
                        "mh" => "marshall islands",
                        "mq" => "martinique",
                        "mr" => "mauritania",
                        "mu" => "mauritius",
                        "yt" => "mayotte",
                        "mx" => "mexico",
                        "fm" => "micronesia",
                        "md" => "moldova, republic of",
                        "mc" => "monaco",
                        "mn" => "mongolia",
                        "ms" => "montserrat",
                        "ma" => "morocco",
                        "mz" => "mozambique",
                        "mm" => "myanmar",
                        "na" => "namibia",
                        "nr" => "nauru",
                        "np" => "nepal",
                        "nl" => "netherlands",
                        "an" => "netherlands antilles",
                        "nc" => "new caledonia",
                        "nz" => "new zealand",
                        "ni" => "nicaragua",
                        "ne" => "niger",
                        "ng" => "nigeria",
                        "nu" => "niue",
                        "nf" => "norfolk island",
                        "mp" => "northern mariana islands",
                        "no" => "norway",
                        "om" => "oman",
                        "pk" => "pakistan",
                        "pw" => "palau",
                        "ps" => "palestinian territory",
                        "pa" => "panama",
                        "pg" => "papua new guinea",
                        "py" => "paraguay",
                        "pe" => "peru",
                        "ph" => "philippines",
                        "pn" => "pitcairn",
                        "pl" => "poland",
                        "pt" => "portugal",
                        "pr" => "puerto rico",
                        "qa" => "qatar",
                        "re" => "reunion",
                        "ro" => "romania",
                        "ru" => "russian federation",
                        "rw" => "rwanda",
                        "sh" => "saint helena",
                        "kn" => "saint kitts and nevis",
                        "lc" => "saint lucia",
                        "pm" => "saint pierre and miquelon",
                        "vc" => "saint vincent and the grenadines",
                        "ws" => "samoa",
                        "sm" => "san marino",
                        "st" => "sao tome and principe",
                        "sa" => "saudi arabia",
                        "sn" => "senegal",
                        "sc" => "seychelles",
                        "sl" => "sierra leone",
                        "sg" => "singapore",
                        "sk" => "slovakia",
                        "si" => "slovenia",
                        "sb" => "solomon islands",
                        "so" => "somalia",
                        "za" => "south africa",
                        "gs" => "south georgia",
                        "gs" => "south sandwich islands",
                        "es" => "spain",
                        "lk" => "sri lanka",
                        "sd" => "sudan",
                        "sr" => "suriname",
                        "sj" => "svalbard and jan mayen",
                        "sz" => "swaziland",
                        "se" => "sweden",
                        "ch" => "switzerland",
                        "sy" => "syrian arab republic",
                        "tw" => "taiwan",
                        "tj" => "tajikistan",
                        "tz" => "tanzania",
                        "th" => "thailand",
                        "tg" => "togo",
                        "tk" => "tokelau",
                        "to" => "tonga",
                        "tt" => "trinidad and tobago",
                        "tn" => "tunisia",
                        "tr" => "turkey",
                        "tm" => "turkmenistan",
                        "tc" => "turks and caicos islands",
                        "tv" => "tuvalu",
                        "ug" => "uganda",
                        "ua" => "ukraine",
                        "ae" => "united arab emirates",
                        "gb" => "united kingdom",
                        "um" => "united states minor outlying islands",
                        "uy" => "uruguay",
                        "uz" => "uzbekistan",
                        "vu" => "vanuatu",
                        "ve" => "venezuela",
                        "vn" => "viet nam",
                        "vg" => "virgin islands, british",
                        "vi" => "virgin islands, u.s.",
                        "wf" => "wallis and futuna",
                        "eh" => "western sahara",
                        "ye" => "yemen",
                        "yu" => "yugoslavia",
                        "zm" => "zambia",
                        "zw" => "zimbabwe"
        			);

	!isset($params['key']) and  $smarty->trigger_error("show_country: missing 'key' parameter");
	switch($params['case']){
		case 'upper':
			echo strtoupper($country_codes[strtolower($params['key'])]);
			break;
		case 'lower':
			echo strtolower($country_codes[strtolower($params['key'])]);
			break;
		case 'ucwords':
			
			echo ucwords($country_codes[strtolower($params['key'])]);
			break;
		case 'ucfirst':
			echo ucfirst($country_codes[strtolower($params['key'])]);
			break;
		default:
			echo strtoupper($country_codes[strtolower($params['key'])]);
	}

}

?>
