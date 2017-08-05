<?php
	include'config.inc';
	$fag=true;
	$root_path = $_POST['root_path'];
	$str=strstr(stripslashes($_REQUEST['sql']),'FROM')==""?strstr(stripslashes($_REQUEST['sql']),'from'):strstr(stripslashes($_REQUEST['sql']),'FROM');
	
	//echo stripslashes($_REQUEST['sql']);
	//if($_REQUEST['query_flag'])exit;
	
 	list($from,$table_name) = explode(' ',$str);
	$idx_filed_result=mysql_fetch_assoc(mysql_query("SHOW KEYS  FROM $table_name"));
	$idx_filed_name=$idx_filed_result['Column_name'];
	$flds_arr = array();
	$f_list_rs=mysql_query('SHOW FIELDS FROM '.$table_name);
	while($field_row=mysql_fetch_assoc($f_list_rs)){
		$flds_arr[] = $field_row['Field'];
	}
	$users = array();
	if($_POST['username_valid_field'] !=''){
		$user_rs=mysql_query('SELECT '.$_POST['username_valid_field'].' FROM '.$table_name);
		while($user_row=mysql_fetch_assoc($user_rs)){
			$users[] = $user_row[$_POST['username_valid_field']];
		}
	}
	
	$full_tbl_result=mysql_query("SELECT * FROM $table_name");
	$table_datas = array();
	while($full_tbl_data = mysql_fetch_assoc($full_tbl_result)){
		foreach($full_tbl_data as $key=>$val){
			$str_arr[] =$val;
		}
		$table_datas[$full_tbl_data[$idx_filed_name]] = implode('|',$str_arr);
		unset($str_arr);
	}
	//print_r($table_datas);
		
	if($_POST['search']==1 and $_POST['keyword'] !=''){
		$loop_flg=0;
		$search_where=(strstr(strtoupper(stripslashes($_REQUEST['sql'])),'WHERE')=="")?'WHERE ':'';
		$loop_flg=$search_where==''?1:0;
		$fld_list=mysql_query('SHOW FIELDS FROM '.$table_name);
		
		while($field_ls=mysql_fetch_assoc($fld_list)){
			if($loop_flg){
				$search_where.=' or '.$field_ls['Field'].' LIKE "%'.$_POST['keyword'].'%"';
			}
			else{
				$search_where.=' '.$field_ls['Field'].' LIKE "%'.$_POST['keyword'].'%"';
				$loop_flg=1;
			}
		}
		$search_where = (strstr(strtoupper(stripslashes($_REQUEST['sql'])),'WHERE')=="")?str_replace($table_name," $table_name ".$search_where,stripslashes($_REQUEST['sql'])):str_replace('WHERE'," WHERE ".$search_where,stripslashes($_REQUEST['sql']));
		
		$search_where = (strstr($search_where,'*') == '')?(strstr($search_where,'select') == '')?str_replace('SELECT','SELECT '.$idx_filed_name.', ',$search_where):str_replace('select','SELECT '.$idx_filed_name.', ',$search_where):$search_where;
		
	}
	
	$shuffle = $_POST['shuffle']==1?' RAND(), ':'';
	
	($_REQUEST['query_flag']==0) and $orderby=(strstr(stripslashes($_REQUEST['sql']),'ORDER BY')=="" and strstr(stripslashes($_REQUEST['sql']),'order by')=="" and strstr(stripslashes($_REQUEST['sql']),'Order By')=="")?"ORDER by ".$shuffle.$idx_filed_name." DESC":'';
	
	$orderby = isset($_POST['flg_inc'])?"ORDER by ".$shuffle.$idx_filed_name." DESC":$orderby;
	$ord =($_POST['sort_flg']==0)?" ASC":" DESC";
	$orderby = ($_POST['sort']!='')?"ORDER by ".$_POST['sort']." $ord":$orderby;
	//echo 'SELECT '.$idx_filed_name.' '.$str.' '.$orderby;
	$unique_id_rs = mysql_query('SELECT '.$idx_filed_name.' '.$str.' '.$orderby);
	/*while($ids=mysql_fetch_assoc($unique_id_rs)){
		$unique_ids[]=$ids[$idx_filed_name];
	}*/
	
	/*echo "<pre>";
	print_r($unique_ids);
	echo "</pre>";*/	
	
	if(isset($_POST['p']) and $_POST['p_page'] >1){
		$limit=" LIMIT ".($_POST['p'] * $_POST['p_page']).", ".$_POST['p_page'];
		$tot_sql=($_POST['search']==1 and $_POST['keyword'] !='')?$search_where:stripslashes($_REQUEST['sql']);
		$tot_pages=mysql_num_rows(mysql_query($tot_sql));
		$pages=($tot_pages%$_POST['p_page'])>0?floor($tot_pages/$_POST['p_page'])+1:floor($tot_pages/$_POST['p_page']);
		$paging = paging('', $pages, $_POST['p']+1, '', '',  "<img src='".$root_path."images/pager_previous_icon.gif'>", "<img src='".$root_path."images/pager_next_icon.gif'>");
		
	}
	
	$sql_query = (strstr(stripslashes($_REQUEST['sql']),'*') == '')?(strstr(strtoupper($_REQUEST['sql']),'SELECT') != '')?strstr(strtoupper($_REQUEST['sql']),strtoupper($idx_filed_name))==''?strstr(stripslashes($_REQUEST['sql']),'SELECT')?str_replace('SELECT','SELECT '.$idx_filed_name.', ',stripslashes($_REQUEST['sql'])):str_replace('select','SELECT '.$idx_filed_name.', ',stripslashes($_REQUEST['sql'])):stripslashes($_REQUEST['sql']):stripslashes($_REQUEST['sql']):stripslashes($_REQUEST['sql']);
	
	$sql_query = ($_POST['search']==1 and $_POST['keyword'] !='')?$search_where:$sql_query ;
	$query = $sql_query.' '. $orderby;
	$sql_text=$_REQUEST['query_flag']==0?$sql_query.' '.$orderby.$limit:stripslashes($_REQUEST['sql'])." ".$limit;
	$RESULT=mysql_query($sql_text);
	$fields_flg=true;
	$arr=array();
	while($row=mysql_fetch_assoc($RESULT)){
		$arr[]=$row;
		$unique_ids[]=$row[$idx_filed_name];
		$cnt=count($row);
	}
	$show_hide=$_POST['search']==1?"block":"none";
	$show_hide_query = $_POST['query_flag']==1?"block":"none";
	//echo $_POST['edit_del_flg'];
	if($_POST['edit_del_flg']=="true"){$cnt=$cnt+2;}else{$cnt=$cnt;}
	echo "<div id='grid_loder' style='display:none' align='center'><img src='".$root_path."images/loading.gif' title='loading'></div>";
	echo "<div id='rpt'></div>";
	echo "<table class='css_tbl'>";
	echo "<tr class='brd_none'><td colspan='".($cnt)."' class='brd_none'> ";
	if($_POST['crl_browse']=="true"){
		echo " <a href='javascript:void(0);' onclick='obj.browse(\"$_POST[idx]\");'><img src='".$root_path."images/browse.gif' title='Browse'></a>";
	}
	if($_POST['crl_query']=="true"){
		echo " <a href='javascript:void(0);' onclick='obj.showhide(\"query\",\"$table_name\");'><img src='".$root_path."images/sql.gif' height='30' title='SQL Query Runner'></a>";
	}
	if($_POST['word']=="true" or $_POST['excel']=="true" or $_POST['csv']=="true"){
		echo " <a href='javascript:void(0);' onclick='obj.showhide(\"report\",\"$table_name\");'><img src='".$root_path."images/report.gif' title='Generate reports'></a>";
	}
	if($_POST['crl_search']=="true"){
		echo " <a href='javascript:void(0);' onclick='obj.showhide(\"search\",\"$table_name\");'><img src='".$root_path."images/search.gif' title='Search'></a>";
	} 
	if($_POST['crl_shuffle']=="true"){
		echo " <a href='javascript:obj.shuffles(\"$_POST[idx]\")'><img src='".$root_path."images/shuffle.gif' title='Shuffle'></a>";
	}
	if($_POST['crl_insert']=="true"){
		echo " <a href='javascript:obj.showhide(\"div_edit\",\"$table_name\");obj.showhide(\"main_grid\",\"$table_name\");' onclick='obj.resetData(\"".implode('|',$flds_arr)."\",\"".implode('|',$users)."\",\"$_POST[idx]\");'><img src='".$root_path."images/insert1.gif' title='Insert'></a>";
	}
	if($_POST['crl_empty']=="true"){
		echo " <a href='javascript:obj.truncate(\"$table_name\",\"$_POST[idx]\")'><img src='".$root_path."images/tbl_empty.png' title='Empty'></a>";
	}
	//echo "</td></tr>";
	//echo "<tr class='brd_none'><td colspan='".($cnt+1)."' class='brd_none'> ";
	echo "<div style='display:none;' class='hide' id='report_$table_name'>";
	if($_POST['excel']=="true"){
		echo " <a href='javascript:obj.reports(\"excel\",\"".str_replace('"',"|",$query)."\")'><img src='".$root_path."images/excel.gif' width='38' height='40' title='Report for excel format'></a>";
	}
	if($_POST['csv']=="true"){
		echo "<a href='javascript:obj.reports(\"csv\",\"".str_replace('"',"|",$query)."\")'><img src='".$root_path."images/csv.gif' width='38' height='40' title='Report for CSV format'></a>";
	}
	if($_POST['word']=="true"){
		echo " <a href='javascript:obj.reports(\"word\",\"".str_replace('"',"|",$query)."\")'><img src='".$root_path."images/word1.gif' width='38' height='38' title='Report for word format'></a>";
	}
	//echo " <a href='javascript:obj.reports(\"pdf\",\"$query\")'><img src='".$root_path."images/pdf1.gif' width='38' height='40' title='Report for PDF format'></a>;
	echo "</div>";
//	echo $_POST['crl_empty'];
	if($_POST['crl_search']=="true"){
		echo "<div style='display:$show_hide;' id='search_$table_name' class='hide'><table><tr><td><input type='text' name='keyword_$table_name' id='keyword_$table_name' class='ser_text' value='$_POST[keyword]' onchange = 'obj.search_results(\"keyword_$table_name\",\"$_POST[idx]\")' ></td><td><a href='javascript:obj.search_results(\"keyword_$table_name\",\"$_POST[idx]\");'><img src='".$root_path."images/search_button.gif' title='GO'></a><td></tr></table></div>";
		
	}
	echo "<div style='display:$show_hide_query;' id='query_$table_name' class='hide'><table><tr><td><textarea name='sql_$table_name' id='sql_$table_name' class='sql_text' >".$sql_query.' '.$orderby."</textarea></td><td><a href='javascript:obj.sql_query(\"sql_$table_name\",\"$_POST[idx]\");'><img src='".$root_path."images/search_button.gif' title='GO'></a><td></tr></table></div><br />

	<div id='div_edit_$table_name' style='display:none'><br />";
	echo "<table class='css_tbl'><tr><th colspan='2' class='css_td header'><span id='edit_title'> EDIT </span></th></tr>";
	$fileds_result = mysql_query("SHOW FIELDS  FROM $table_name");
	$flds_array = array();
	$fields_label = explode(',',$_POST['fields_label']);
	$fl_idx = 0;
	while($flds_ls = mysql_fetch_assoc($fileds_result)){
		$flds_array[] = $flds_ls['Field'];
		if($flds_ls['Extra'] == 'auto_increment'){
			echo "<input type='hidden' name='$flds_ls[Field]' id='$flds_ls[Field]'>";
			continue;
		}
		$unshown_fields = explode(',',$_POST['unshown']);
		$mandatory_fields = explode(',',$_POST['mandatory_fields']);
		if(count($fields_label) > 1){
			echo "<tr id='edit_$flds_ls[Field]'><td class='css_td header1'><label id='label_$flds_ls[Field]'>".ucwords(trim($fields_label[$fl_idx]))."</label>";
			if(in_array($flds_ls[Field],$mandatory_fields) or $_POST['field_password'] == $flds_ls['Field']){
				echo " <span class='star'>*</span>";
			}
			echo "</td>";
			
		}
		else{
			echo "<tr id='edit_$flds_ls[Field]'><td class='css_td header1'><label id='label_$flds_ls[Field]'>".ucwords($flds_ls[Field])."</label>";
			if(in_array($flds_ls[Field],$mandatory_fields) or $_POST['field_password'] == $flds_ls['Field']){
				echo " <span class='star'>*</span>";
			}
			echo "</td>";
		}
		$size = count(substr($flds_ls['Type'],8))==3?substr($flds_ls['Type'],8,2):substr($flds_ls['Type'],8,3);
		$date_cal_fields = explode(',',$_POST['date_cal_fields']);
		if($flds_ls['Type'] == 'text'){
			if($_POST['field_password'] == $flds_ls['Field']){
				$lbl = $fields_label[$fl_idx]!=''?ucwords($fields_label[$fl_idx]):ucwords($flds_ls[Field]);
				echo "<td class='css_td'><input type='password' class='text_box' name='$flds_ls[Field]' id='$flds_ls[Field]'/></td></tr>";
				echo "<tr id='re_$flds_ls[Field]'><td class='css_td header1'><label id='label_re_$flds_ls[Field]'>Re-".$lbl."</label>
						<span class='star'>*</span></td>";
				echo "<td class='css_td'><input type='password' class='text_box' name='re$flds_ls[Field]' id='re$flds_ls[Field]'/>";
			}
			else{
				echo "<td class='css_td'><textarea class='text_box' name='$flds_ls[Field]' id='$flds_ls[Field]'></textarea></td>";
			}
		}else{
			if($_POST['field_password'] == $flds_ls['Field']){
				echo "<td class='css_td'><input type='password' class='text_box' name='$flds_ls[Field]' id='$flds_ls[Field]'/></td></tr>";
				echo "<tr id='re_$flds_ls[Field]'><td class='css_td header1'><label id='label_re_$flds_ls[Field]'>Re-".ucwords($flds_ls[Field])."</label>
							<span class='star'>*</span></td></td>";
				echo "<td class='css_td'><input type='password' class='text_box' name='re$flds_ls[Field]' id='re$flds_ls[Field]'/>";
			}
			else{
				echo "<td class='css_td'><input type='text' class='text_box' name='$flds_ls[Field]' id='$flds_ls[Field]'/>";
			}
			if(strstr(ucwords($flds_ls['Type']),'DATE') !='' or in_array($flds_ls['Field'],$date_cal_fields)){
				echo"<span><a href='javascript:showCalendar(\"\",\"$flds_ls[Field]\",\"$flds_ls[Field]\",\"\",\"$flds_ls[Field]\",0,0,1);'><img src='".$root_path."images/cal.gif' title='cal'></a></span>";
			}
			echo "</td>";
		}
		$fl_idx++;
	}
	  echo "</tr><tr><td colspan='2' align='center'><br /><input type='button' name='insert' class='btn_submit' id='insert' value=' Submit ' onclick='obj.saveRecord(\"$table_name\",\"$idx_filed_name\",\"$_POST[idx]\");'>&nbsp;&nbsp;<input type='button' name='insert' id='insert' class='btn_cancel' value=' Cancel ' onclick ='$(\"#div_edit_$table_name\").slideToggle();
	$(\"#main_grid_$table_name\").slideToggle();'></td></tr>
	</table>";
	
	$flds_list_str=implode('|',$flds_array);
	echo "</div>";
	echo "<div id='div_view_$table_name' style='display:none'><br />";
	echo "<table class='css_tbl'><tr><th colspan='2' class='css_td header'><span id='view_title'> VIEW </span></th></tr>";
	$fileds_result = mysql_query("SHOW FIELDS  FROM $table_name");
	$fields_label = explode(',',$_POST['fields_label']);
	$fl_idx = 0;
	while($flds_ls = mysql_fetch_assoc($fileds_result)){
		
		if(count($fields_label) > 1){
			if ($flds_ls[Field] == $idx_filed_name ){
				echo "<tr style='display:none;' id='view_$flds_ls[Field]'><td align='left'><label>ID </label>";
				echo "</td>";
			}
			else{
				echo "<tr id='view_$flds_ls[Field]'><td class='css_td header1' align='left'><label>".ucfirst(trim($fields_label[$fl_idx]))." </label>";
				echo "</td>";
			}
			
		}
		else{
			echo "<tr id='view_$flds_ls[Field]'><td class='css_td header1' align='left'><label>".ucfirst($flds_ls[Field])." </label>";
			echo "</td>";
		}
		if($_POST['field_password'] == $flds_ls['Field']){
			$lbl = $fields_label[$fl_idx]!=''?ucfirst($fields_label[$fl_idx]):ucfirst($flds_ls[Field]);
			echo "<td class='css_td' align='left'> ************** </td>";
		}
		else{
			echo "<td class='css_td' align='left'><span id='span_$flds_ls[Field]'></span></td>";
		}
		if ($flds_ls[Field] != $idx_filed_name )
			$fl_idx++;
	}
		echo "</tr><tr><td colspan='2' align='center'><br /><input type='button' name='insert' id='insert' class='btn_submit' value=' Update ' onclick ='obj.update(\"$table_name\",\"$idx_filed_name\",\"$_POST[idx]\",\"div_view_$table_name\",\"div_edit_$table_name\")'>&nbsp;&nbsp;<input type='button' name='insert' id='insert' class='btn_cancel' value=' Back ' onclick ='$(\"#div_view_$table_name\").slideToggle();
	$(\"#main_grid_$table_name\").slideToggle();'></td></tr>
	</table>";
	
	echo "</div>";
	echo "</td></tr>";
	echo "<tr><td colspan='$cnt' align='center'><div id='main_grid_$table_name' >";
	echo "<table class='css_tbl'><tr>";
	$i=0;
	
	if(count($arr)==0){echo "<td class='err'>NO RESULTS</td>";exit;}
	foreach($arr as $arr1){
		$color=	$fag?$col_1:$col_2;
		
		if(	$fields_flg){
			foreach($arr1 as $key=>$value){
				$fld_key[] = $key;
			}
			$inc=0;
			
			echo "<tr>";
			if($_POST['fields']!='undefined' and (count(explode(',',$_POST['fields'])) == (count($arr1)-1) or count(explode(',',$_POST['fields'])) == (count($arr1)))){
				if(count($arr1)!= count(explode(',',$_POST['fields']))){
					if ($flds_array[$inc] == $idx_filed_name ){
						if($_POST['edit_del_flg']=="true")
							echo "<td class='css_td header'><input type='checkbox' id='del_all_$table_name' name='del_all_$table_name' value='$unique_ids[$i]' onclick='obj.setCheck(\"del_$table_name\",this.checked);'></td>";
					}
					echo "<th class='header' ><a href='javascript:obj.sorts(\"$idx_filed_name\",\"$_POST[idx]\", $_POST[sort_flg])'>Id</a></th>";
					$inc++;
				}
				foreach(explode(',',$_POST['fields']) as $key=>$value){
					if ($flds_array[$inc] == $idx_filed_name ){
						if($_POST['edit_del_flg']=="true")
							echo "<td class='css_td header'><input type='checkbox' id='del_all_$table_name' name='del_all_$table_name' value='$unique_ids[$i]' onclick='obj.setCheck(\"del_$table_name\",this.checked);'></td>";
					}
					echo "<th class='header' style='width:".(strlen($value)*10-20)."px;'><a href='javascript:obj.sorts(\"$fld_key[$inc]\",\"$_POST[idx]\", $_POST[sort_flg])'>".ucwords($value)."</a></th>";
					$inc++;
				}
			}
			else{
				foreach($arr1 as $key=>$value){
					if ($key == $idx_filed_name ){
						if($_POST['edit_del_flg']=="true")
							echo "<td class='css_td header'><input type='checkbox' id='del_all_$table_name' name='del_all_$table_name' value='$unique_ids[$i]' onclick='obj.setCheck(\"del_$table_name\",this.checked);'></td>";
					}
					echo "<th class='header' style='width:".(strlen($value)*10-20)."px;'><a href='javascript:obj.sorts(\"$key\",\"$_POST[idx]\", $_POST[sort_flg])'>".ucwords($key)."</a></th>";
				}
			}
			if($_POST['edit_del_flg']=="true"){
				//echo '<th class="header edit" bgcolor="#60768C"> Edit </th>';
				echo '<th class="header"> Edit </th>';
				echo '<th class="header"> Delete </th>';
			}
			echo "</tr>";
			$fields_flg=false;
		}
		$flds_arr = array();
		$flds='';
		$fag=$fag?false:true;
		echo "<tr >";
		foreach($arr1 as $key=>$value){
			$flds_arr[]=$key;
			$name='txt_'.$table_name.$key.$unique_ids[$i];
			$width=$value==''?15:strlen($value)+2;
			if($key == $idx_filed_name){
				if($_POST['edit_del_flg']=="true"){
					echo "<td class='css_td header'><input type='checkbox' name='del_{$table_name}[]' value='$unique_ids[$i]'></td>";
				
					echo "<th class='css_td header'><a href='javascript:void(0);' onclick='obj.onViewData(\"$idx_filed_name\",\"".str_replace('"','~',$table_datas[$unique_ids[$i]])."\",\"$flds_list_str\",\"$_POST[idx]\",\"div_view_$table_name\",\"main_grid_$table_name\")'>$value</a></th>";
				}
				else{
					echo "<th class='css_td header'>$value</th>";
				}
			}
			else{
				echo "<td class='css_td' style='width:".(strlen($value)*10-20)."px;'>".ucfirst(trim($value))."</td>";

			}
			

		}
		$flds = implode(',',$flds_arr);
		if($_POST['edit_del_flg']=="true"){
			//echo "<td class='css_td edit'><a href='javascript:obj.edit(\"$table_name\",\"$flds\",\"$unique_ids[$i]\",\"$_POST[idx]\")'><img class=img src='".$root_path."images/edit11.gif' border=0></a></td>";
			echo "<td class='css_td edit'><a href='javascript:void(0);' onclick='obj.onEdit(\"$table_name\",\"$idx_filed_name\",\"$unique_ids[$i]\",\"".str_replace('"','~',$table_datas[$unique_ids[$i]])."\",\"$flds_list_str\",\"$_POST[idx]\",\"div_edit_$table_name\",\"main_grid_$table_name\")'><img class=img src='".$root_path."images/edit.gif' border=0 title='Edit'></a></td>";
			echo "<td class='css_td edit'><a href='javascript:obj.isDelete(\"$table_name\",\"$idx_filed_name\",\"$unique_ids[$i]\",\"$_POST[idx]\")'><img class=img src='".$root_path."images/delete.png' border=0 title='Delete'></a></td>";
		}
		echo "</tr>";
		unset($flds);
		unset($flds_arr);
		$i++;
	}
	if($_POST['edit_del_flg']=="true"){ $colspan = count($arr1)+2;}else{$colspan = count($arr1);}
	echo "<tr>";
	if($_POST['edit_del_flg']=="true"){
	echo "<td class='css_td edit'><a href='javascript:obj.isDeleteRecords(\"$table_name\",\"$idx_filed_name\",\"$_POST[idx]\")'><img class=img src='".$root_path."images/delete.png' border=0 title='Delete multiple records'></a></td>";
	}
	echo "<td class='v_align' colspan='".$colspan."'>&nbsp;<div class='page'>";
	if($_POST['p_page']>0){
		if($pages>1){
			echo $paging;
			//echo "kalai";
		}
	}
	echo "</div></td></tr>";
//	echo "</td><td class='v_align'><a href='javascript:obj.insert(\"$table_name\",\"$idx_filed_name\",\"$_POST[idx]\",\"insert\")'><img src='".$root_path."images/insert1.gif'></td></tr>";

	echo "</table></td></tr></table>";

?>


