<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * Type:     function
 * Name:     html_select_state
 * Version:  1.0
 * Purpose:  Prints the dropdowns for states selection.
 * Author:   Matthieu Le goff <tubbix@free.fr>
 *
 * ChangeLog: 1.0 initial release
 * -------------------------------------------------------------
 */

function smarty_function_html_select_state($params, &$smarty)
{
    require_once $smarty->_get_plugin_filepath('function','html_options');
	/* Set the name of the <select> tag. */
    $name  = 'State';

    /* Set the different type of states
       us = US states
       uk = UK counties
       fr = FR departements 
	   ar = Argentina states
	   as = Australia states
	   ca = Canada provices
	   */
    $type  = 'us';
    
    /* <select size>'s of <select> tag.
       If not set, uses default dropdown. */
    $size  = null;
	
	/*set empty option name and default selected state
	*/
    $empty_option_name = 'Select State/Province';
    $selected = '';
    /* Unparsed attributes common to *ALL* the <select>/<input> tags.
       An example might be in the template: extra ='class ="foo"'. */
    $extra = null;


    extract($params);


    $us = array(
		 '999' => 'US States',
		 'xy' => '--------------------',
         'al' => 'Alabama',    
         'ak' => 'Alaska',
         'ab' => 'Alberta',    
         'az' => 'Arizona',
         'ar' => 'Arkansas',
         'bc' => 'British Columbia',
         'ca' => 'California',
         'co' => 'Colorado',
         'ct' => 'Connecticut',
         'de' => 'Delaware',
         'dc' => 'District of Columbia',
         'fl' => 'Florida',
         'ga' => 'Georgia',
         'hi' => 'Hawaii',
         'id' => 'Idaho',
         'il' => 'Illinois',
         'in' => 'Indiana',
         'ia' => 'Iowa',
         'ks' => 'Kansas',
         'ky' => 'Kentucky',
         'la' => 'Louisiana',
         'me' => 'Maine',
         'mb' => 'Manitoba',
         'md' => 'Maryland',
         'ma' => 'Massachusetts',
         'mi' => 'Michigan',
         'mn' => 'Minnesota',
         'ms' => 'Mississippi',
         'mo' => 'Missouri',
         'mt' => 'Montana',
         'ne' => 'Nebraska',
         'nv' => 'Nevada',
         'nb' => 'New Brunswick',
         'nh' => 'New Hampshire',
         'nj' => 'New Jersey',
         'nm' => 'New Mexico',
         'ny' => 'New York',
         'nf' => 'Newfoundland',
         'nc' => 'North Carolina',
         'nd' => 'North Dakota',
         'nt' => 'Northwest Territories',
         'ns' => 'Nova Scotia',
         'nu' => 'Nunavut',
         'oh' => 'Ohio',
         'ok' => 'Oklahoma',
         'on' => 'Ontario',
         'or' => 'Oregon',
         'pa' => 'Pennsylvania',
         'pe' => 'Prince Edward Island',
         'qc' => 'Quebec',
         'ri' => 'Rhode Island',
         'sk' => 'Saskatchewan',
         'sc' => 'South Carolina',
         'sd' => 'South Dakota',
         'tn' => 'Tennessee',
         'tx' => 'Texas',
         'ut' => 'Utah',
         'vt' => 'Vermont',
         'vi' => 'Virgin Islands',         
         'va' => 'Virginia',
         'wa' => 'Washington',
         'wv' => 'West Virginia',
         'wi' => 'Wisconsin',
         'wy' => 'Wyoming',
         'yt' => 'Yukon Territories'
    );
    
	$ar = array(
		'999' => 'Argentina Provinces',
		'xx' => '------------------------------',
		'BAC' => 'Buenos Aires Capital Federal',
		'BA' => 'Buenos Aires',
		'CAT' => 'Catamarca',
		'CHA' => 'Chaco',
		'CHU' => 'Chubut',
		'CBA' => 'Crdoba',
		'COR' => 'Corrientes',
		'ER' => 'Entre Ros',
		'FO' => 'Formosa',
		'JU' => 'Jujuy',
		'LP' => 'La Pampa',
		'LR' => 'La Rioja',
		'ME' => 'Mendoza',
		'MI' => 'Misiones',
		'NE' => 'Neuqun',
		'RN' => 'Ro Negro',
		'SA' => 'Salta',
		'SJ' => 'San Juan',
		'SL' => 'San Luis',
		'SC' => 'Santa Cruz',
		'SF' => 'Santa Fe',
		'SDE' => 'Santiago del Estero',
		'TDF' => 'Tierra del Fuego',
		'TU' => 'Tucumn'
		
	);
	
	$as = array(
		'999' => 'Australian States/Territories',
		'xx' => '-----------------------------------------',
		'ACT' => 'Australian Capital Territory',
		'ACI' => 'Ashmore and Cartier Islands',
		'CR' => 'Coral Sea Islands Territory',
		'NSW' => 'New South Wales',
		'NT' => 'Northern Territory',
		'QLD' => 'Queensland',
		'SA' => 'South Australia',
		'TAS' => 'Tasmania',
		'VIC' => 'Victoria',
		'WA' => 'Western Australia'
		
	);
	
	$ca = array(
		
		'999' => 'Canadian Provinces',
		'xx' => '----------------------------',
		'AB' => 'Alberta',
		'BC' => 'British Columbia',
		'MB' => 'Manitoba',
		'NB' => 'New Brunswick',
		'NL' => 'Newfoundland and Labrador',
		'NT' => 'Northwest Territories',
		'NS' => 'Nova Scotia',
		'NU' => 'Nunavut',
		'ON' => 'Ontario',
		'PE' => 'Prince Edward Island',
		'QC' => 'Quebec',
		'SK' => 'Saskatchewan',
		'YT' => 'Yukon'
		
	);
	
	$mx = array(
		'999' => 'Mexican States',
		'xx' => '-----------------------',
		'AB' => 'Aguascalientes',
		'BCN' => 'Baja California',
		'CAM' => 'Campeche',
		'CHP' => 'Chiapas',
		'CHH' => 'Chihuahua',
		'COA' => 'Coahuila',
		'COL' => 'Colima',
		'DIF' => 'Distrito Federal',
		'DUR' => 'Durango',
		'GUA' => 'Guanajuato',
		'GRO' => 'Guerrero',
		'HID' => 'Hidalgo',
		'JAL' => 'Jalisco',
		'MEX' => 'México',
		'MIC' => 'Michoacán',
		'MOR' => 'Morelos',
		'NAY' => 'Nayarit',
		'NLE' => 'Nuevo León',
		'OAX' => 'Oaxaca',
		'PUE' => 'Puebla',
		'QUE' => 'Querétaro',
		'ROO' => 'Quintana Roo',
		'SLP' => 'San Luis Potosí',
		'SIN' => 'Sinaloa',
		'SON' => 'Sonora',
		'TAB' => 'Tabasco',
		'TAM' => 'Tamaulipas',
		'TLA' => 'Tlaxcala',
		'VER' => 'Veracruz',
		'YUC' => 'Yucatán',
		'ZAC' => 'Zacatecas'
		
	);
	
	$sa = array(
		'999' => 'South African Provinces',
		'xx' => '----------------------------------',
		'EC' => 'Eastern Cape',
		'FS' => 'Free State',
		'GT' => 'Gauteng',
		'NL' => 'KwaZulu-Natal',
		'LP' => 'Limpopo',
		'MP' => 'Mpumalanga',
		'NC' => 'Northern Cape',
		'NW' => 'North-West',
		'WC' => 'Western Cape'
		
	);
	
    $uk = array(
		'999' => 'UK Counties',
		'xx' => '------------------',
        'Aberdeenshire',
        'Angus',
        'Argyll',
        'Avon',
        'Ayrshire',
        'Banffshire',
        'Bedfordshire',
        'Berkshire',
        'Berwickshire',
        'Buckinghamshire',
        'Caithness',
        'Cambridgeshire',
        'Cheshire',
        'Clackmannanshire',
        'Cleveland',
        'Clwyd',
        'Cornwall',
        'county',
        'County Antrim',
        'County Armagh',
        'County Down',
        'County Durham',
        'County Fermanagh',
        'County Londonderry',
        'County Tyrone',
        'Cumbria',
        'Derbyshire',
        'Devon',
        'Dorset',
        'Dumfriesshire',
        'Dunbartonshire',
        'Dyfed',
        'East Lothian',
        'East Sussex',
        'Essex',
        'Fife',
        'Gloucestershire',
        'Gwent',
        'Gwynedd',
        'Hampshire',
        'Herefordshire',
        'Hertfordshire',
        'Inverness-shire',
        'Isle of Arran',
        'Isle of Barra',
        'Isle of Bute',
        'Isle of Canna',
        'Isle of Coll',
        'Isle of Colonsay',
        'Isle of Cumbrae',
        'Isle of Eigg',
        'Isle of Gigha',
        'Isle of Harris',
        'Isle of Iona',
        'Isle of Islay',
        'Isle of Jura',
        'Isle of Lewis',
        'Isle of Mull',
        'Isle of North Uist',
        'Isle of Orkney',
        'Isle of Rhum',
        'Isle of Skye',
        'Isle of South Uist',
        'Isle of Tiree',
        'Isle of Wight',
        'Isles of Scilly',
        'Kent',
        'Kincardineshire',
        'Kirkcudbrightshire',
        'Lanarkshire',
        'Lancashire',
        'Leicestershire',
        'Lincolnshire',
        'Merseyside',
        'Middlesex',
        'Mid Glamorgan',
        'Midlothian',
        'Morayshire',
        'Norfolk',
        'Northamptonshire',
        'North Humberside',
        'Northumberland',
        'North Yorkshire',
        'Nottinghamshire',
        'Orkney',
        'Oxfordshire',
        'Peeblesshire',
        'Perthshire',
        'Powys',
        'Renfrewshire',
        'Ross-shire',
        'Roxburghshire',
        'Selkirkshire',
        'Shetland Islands',
        'Shropshire',
        'Somerset',
        'South Glamorgan',
        'South Humberside',
        'South Yorkshire',
        'Staffordshire',
        'Stirlingshire',
        'Suffolk',
        'Surrey',
        'Sutherland',
        'Tyne and Wear',
        'Warwickshire',
        'West Glamorgan',
        'West Lothian',
        'West Midlands',
        'West Sussex',
        'West Yorkshire',
        'Wigtownshire',
        'Wilts',
        'Wiltshire',
        'Worcestershire'
  	);
  	
  	$fr = array(
		'999' => 'French Departments',
		'xx' => '------------------------------',
  	    '01' => 'Ain',
        '02' => 'Aisne',
        '03' => 'Allier',
        '04' => 'Alpes de-Htes Provence',
        '05' => 'Hautes-Alpes',
        '06' => 'Alpes-Maritimes',
        '07' => 'Ardche',
        '08' => 'Ardennes',
        '09' => 'Arige',
        '10' => 'Aube',
        '11' => 'Aude',
        '12' => 'Aveyron',
        '13' => 'Bouches-du-Rh?ne',
        '14' => 'Calvados',
        '15' => 'Cantal',
        '16' => 'Charente',
        '17' => 'Charente-Maritime',
        '18' => 'Cher',
        '19' => 'Corrze',
        '21' => 'C?te d\'Or',
        '22' => 'C?tes d\'Armor',
        '23' => 'Creuse',
        '24' => 'Dordogne',
        '25' => 'Doubs',
        '26' => 'Dr?me',
        '27' => 'Eure',
        '28' => 'Eure-et-Loir',
        '29' => 'Finistre',
        '2A' => 'Corse du Sud',
        '2B' => 'Hautes-Corse',
        '30' => 'Gard',
        '31' => 'Hautes-Garonne',
        '32' => 'Gers',
        '33' => 'Gironde',
        '34' => 'Hrault',
        '35' => 'Ille-et-Vilaine',
        '36' => 'Indre',
        '37' => 'Indre-et-Loire',
        '38' => 'Isre',
        '39' => 'Jura',
        '40' => 'Landes',
        '41' => 'Loir-et-Cher',
        '42' => 'Loire',
        '43' => 'Hautes-Loire',
        '44' => 'Loire-Atlantique',
        '45' => 'Loiret',
        '46' => 'Lot',
        '47' => 'Lot-et-Garonne',
        '48' => 'Lozre',
        '49' => 'Maine-et-Loire',
        '50' => 'Manche',
        '51' => 'Marne',
        '52' => 'Haute-Marne',
        '53' => 'Mayenne',
        '54' => 'Meurthe-et-Moselle',
        '55' => 'Meuse',
        '56' => 'Morbihan',
        '57' => 'Moselle',
        '58' => 'Nivre',
        '59' => 'Nord',
        '60' => 'Oise',
        '61' => 'Orne',
        '62' => 'Pas-de-Calais',
        '63' => 'Puy-de-D?me',
        '64' => 'Pyrnes-Atlantiques',
        '65' => 'Hautes-Pyrnes',
        '66' => 'Pyrnes',
        '67' => 'Bas-Rhin',
        '68' => 'Haut-Rhin',
        '69' => 'Rh?ne',
        '70' => 'Hautes-Sa?ne',
        '71' => 'Sa?ne-et-Loire',
        '72' => 'Sarthe',
        '73' => 'Savoie',
        '74' => 'Hautes-Savoie',
        '75' => 'Paris',
        '76' => 'Seine-Maritime',
        '77' => 'Sein-et-Marne',
        '78' => 'Yvelines',
        '79' => 'Deux-Svres',
        '80' => 'Somme',
        '81' => 'Tarn',
        '82' => 'Tarn-et-Garonne',
        '83' => 'Var',
        '84' => 'Vaucluse',
        '85' => 'Vende',
        '86' => 'Vienne',
        '87' => 'Hautes-Vienne',
        '88' => 'Vosges',
        '89' => 'Yonne',
        '90' => 'Territoire de Belfort',
        '91' => 'Essonne',
        '92' => 'Hauts-de-Seine',
        '93' => 'Seine-St-Denis',
        '94' => 'Val de Marne',
        '95' => 'Val d\'Oise',
        '971' => 'Guadeloupe',
        '972' => 'Martinique',
        '973' => 'Guyane',
        '974' => 'Runion'
   );
  	
    $html_result .= '<select name="' . $name . '"';
    if (null !== $size){
        $html_result .= ' size="' . $size . '"';
    }
    if (null !== $extra){
        $html_result .= ' ' . $extra;
    }

    $html_result .= '>'."\n";
    
    $states_names = array($empty_option_name);
    $states_values = array('');
    
    if ($type == "us") {
        foreach ($us as $key => $value) {
            $states_names[] = $value;
            $states_values[] = strtoupper($key);
        }
    }
    else if ($type == "uk") {
        foreach ($uk as $value) {
            $states_names[] = $value;
            $states_values[] = $value;
        }
    }
    if ($type == "fr") {
        foreach ($fr as $key => $value) {
            $states_names[] = $value;
            $states_values[] = $key;
        }
    }
    
	$all = array($us,$ca);
		if ($type =='all') {
			foreach ($all as $key => $value) {
				foreach($value as $key => $list) {
					 $states_names[] = $list;
            		 $states_values[] = $key;
				}
				  $states_names[] = '&nbsp;';
				  $states_values[] = '0000';
			}
		}
	
    $html_result .= smarty_function_html_options(array('output'       => $states_names,
                                                       'values'       => $states_values,
                                                       'selected'     => $selected,
													   'type'     => $type,
                                                       'print_result' => false),
                                                       $smarty);
    
    $html_result .= '</select>';

    print $html_result;
}

?>