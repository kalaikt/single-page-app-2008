<?php 
	include'config.inc';
	//echo str_replace("|","'",$_REQUEST[query]);
//	exit;
	switch($_REQUEST['report']){
		case csv:
			header("Expires: 0");
			header("Cache-control: private");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			header("Content-Description: File Transfer");
			header("Content-type: application/octet-stream");
			header("Content-Disposition: attachment; filename=\"my-data.csv\"");
			
			if($_REQUEST['report_fields']!=''){
				$sql = strstr($_REQUEST[query],'SELECT')?str_replace('SELECT','SELECT '.$_REQUEST['report_fields'].',',$_REQUEST[query]):str_replace('select','SELECT '.$_REQUEST['report_fields'].',',$_REQUEST[query]);
			}
			else{
				$sql =$_REQUEST[query];
			}
			$result = mysql_query(str_replace("|","'",$sql));
			$ret = '';
			while($data = mysql_fetch_assoc($result)){
				$ret .= join(',', $data) .PHP_EOL;
			}
			echo $ret;
			break;
		case excel:
			header("Expires: 0");
			header("Cache-control: private");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			header("Content-Description: File Transfer");
			header("Content-type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename=\"my-data.xls\"");
			if($_REQUEST['report_fields']!=''){
				$sql = strstr($_REQUEST[query],'SELECT')?str_replace('SELECT','SELECT '.$_REQUEST['report_fields'].',',$_REQUEST[query]):str_replace('select','SELECT '.$_REQUEST['report_fields'].',',$_REQUEST[query]);
			}
			else{
				$sql =$_REQUEST[query];
			}
			$result = mysql_query(str_replace("|","'",$sql));
			$ret = '';
			while($data = mysql_fetch_assoc($result)){
				$ret .= join("\t", $data) .PHP_EOL;
			}
			echo $ret;
			break;
		case word:
			header("Expires: 0");
			header("Cache-control: private");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			header("Content-Description: File Transfer");
			header("Content-type: application/vnd.ms-word");
			header("Content-Disposition: attachment; filename=\"my-data.doc\"");
			
			if($_REQUEST['report_fields']!=''){
				$sql = strstr($_REQUEST[query],'SELECT')?str_replace('SELECT','SELECT '.$_REQUEST['report_fields'].',',$_REQUEST[query]):str_replace('select','SELECT '.$_REQUEST['report_fields'].',',$_REQUEST[query]);
			}
			else{
				$sql =$_REQUEST[query];
			}
			
			$result = mysql_query(str_replace("|","'",$sql));
			$flg=true;
			$ret = '<table>';
			while($data = mysql_fetch_assoc($result)){
				if($flg){
					$ret .="<tr>";
					foreach($data as $key=>$record){
						$ret .= '<td><b>'. strtoupper($key).'</b></td>';
					}
					$ret .="</tr>";
					$flg=false;
				}
				$ret .="<tr>";
				foreach($data as $key=>$record){
					$ret .= '<td>'. $record.'</td>';
				}
				$ret .="</tr>";
			}
			echo $ret."</table";
			break;
		case pdf:
			header("Expires: 0");
			header("Cache-control: private");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			header("Content-Description: File Transfer");
			header("Content-type: application/pdf");
			header("Content-Disposition: attachment; filename=\"my-data.pdf\"");
			$pdf = pdf_new();
			pdf_open_file($pdf);
			pdf_set_info($pdf, "author", "kalai kumar"); 
			pdf_set_info($pdf, "title", "generate report"); 
			pdf_set_info($pdf, "creator", "kalaikumar"); 
			pdf_set_info($pdf, "subject", "report");
			pdf_begin_page($pdf, 450, 450); 
			$font = pdf_findfont($pdf, "helvetica-bold",  "winansi",0);
			pdf_setfont($pdf, $font, 12); 
						 
			$result = mysql_query(str_replace("|","'",$_REQUEST[query]));
			$ret = '<table>';
			while($data = mysql_fetch_assoc($result)){
				if($flg){
					$ret .="<tr>";
					foreach($data as $key=>$record){
						$ret .= '<td><b>'. strtoupper($key).'</b></td>';
					}
					$ret .="</tr>";
					$flg=false;
				}
				$ret .="<tr>";
				foreach($data as $key=>$record){
					$ret .= '<td>'. $record.'</td>';
				}
				$ret .="</tr>";
			}
			$ret .= $ret."</table";
			pdf_show($pdf, $ret);
			pdf_end_page($pdf); 
			pdf_close($pdf); 
			echo pdf_get_buffer($pdf); 
			//echo $ret."</table";
			break;
	}
?>