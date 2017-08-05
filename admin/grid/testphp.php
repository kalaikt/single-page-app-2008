<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ajax test</title>
<link type="text/css" rel="stylesheet" href="output.css" />

<script type="text/javascript" src="scripts/jquery.js"></script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript">
/*function data(){
	var sql="SELECT id, name,deg FROM test";
	obj_ajax = new ServerRequest("data",sql,true,5);
	obj_ajax.control_empty=true;
	obj_ajax.control_insert=true;
	obj_ajax.control_search=true;
	obj_ajax.control_edit=true;
	obj_ajax.control_shuffle=true;
	obj_ajax.report_word=true;
	obj_ajax.report_excel=true;
	obj_ajax.report_csv=true;	
	obj_ajax.fetch_rows(obj_ajax);
}*/

function data1(){
	var sql="SELECT P_Name, P_DOB FROM familymembers";
	obj_ajax1 = new ServerRequest("data1",sql,true,15,"name,DOB");
	obj_ajax1.control_empty=false;
	obj_ajax1.control_insert=true;
	obj_ajax1.control_search=true;
	obj_ajax1.control_edit=true;
	obj_ajax1.control_shuffle=true;
	obj_ajax1.control_query=true;
	obj_ajax1.control_browse=true;
	obj_ajax1.report_word=true;
	obj_ajax1.report_excel=true;
	obj_ajax1.report_csv=true;
	obj_ajax1.fetch_rows(obj_ajax1);
}
//data();
setTimeout("data1()",100);
</script>
</head>
<body>
  <div id="data"></div>
<br />

<!--<input name="btn" type="button" value="show"  onclick="data();"/>-->
 <div id="data1"></div>

<!--<input name="btn1" type="button" value="show"  onclick="data1();"/>-->
</body>
</html>
