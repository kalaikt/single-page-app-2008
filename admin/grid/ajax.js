// sever side data
function ServerRequest(id,sql,flg,nos,fld_list){
	this.sql = sql;
	this.div_id = id;
	this.record_count = '';
	this.edit_flag = flg;
	this.no_rs_page = nos;
	this.cur_page = 0;
	this.fields = fld_list;
	this.shuffle = 0;
	this.searchs = 0;
	this.keyword = '';
	this.control_empty = 0;
	this.control_insert = 0;
	this.control_search = 0;
	this.control_shuffle = 0;
	this.control_edit = 0;
	this.control_browse = 0;
	this.control_query = 0;	
	this.sortby='';
	this.sort_flg=1;
	this.query='';
	this.query_flag=0;
	this.report='';
	this.report_word = 0;
	this.report_excel = 0;
	this.report_csv = 0;
	this.report_pdf = 0;
	this.root_path = '';
	this.fields_unshow ='';
	this.default_fields_values='';
	this.fields_unshow_new ='';
	this.fields_label ='';
	this.fields_list='';
	this.field_password='';
	this.save_mode = 0;
	this.mandatory_fields = '';
	this.num_valid_fields = '';
	this.email_valid_fields = '';
	this.username_valid_field = '';
	this.date_cal_fields = '';
	this.password_encrypt = 1;
	this.report_fields = '';
	this.user_list = '';
	
}
// global data maintains
function init(){
	this.obj_array = new Array();
	this.idx = 0;
	this.temp = 0;
	this.fld_values = '';
	this.fld_ls = '';
}
ini_obj = new init();
obj = new ServerRequest();
function handleHttpResponse(){	
	if (http.readyState == 4){
		if(http.status==200){
			var results=http.responseText;
			if(!document.getElementById(obj.div_id)){
				alert('Undefined div id');
			}else{
				document.getElementById(obj.div_id).innerHTML = results;
			}
		}
  	}
}
function handleHttpResponseDelete(){	
	if (http.readyState == 4){
		if(http.status==200){
			var results=http.responseText;
			obj.fetch_rows(ini_obj.obj_array[ini_obj.temp]);
		}
  	}
}

function handleHttpResponseInsert(){	
	if (http.readyState == 4){
		if(http.status==200){
			var results=http.responseText;
			obj.fetch_rows(ini_obj.obj_array[ini_obj.temp]);
		}
  	}
}

function handleHttpResponseSave(){	
	if (http.readyState == 4){
		if(http.status==200){
			var results=http.responseText;
		}
  	}
}

ServerRequest.prototype.fetch_rows=function(obj_a){  
	$('#grid_loder').slideToggle();
	ini_obj.obj_array.push(obj_a);
	obj = obj_a;
	sql = (obj.query_flag == 1)?obj.query:obj.sql;
	var url = obj.root_path+"getdata.php";
	var params = "sql="+sql+"&edit_del_flg="+obj.edit_flag+"&p="+obj.cur_page+"&crl_empty="+obj.control_empty+"&crl_shuffle="+obj.control_shuffle+"&crl_search="+obj.control_search+"&crl_insert="+obj.control_insert+"&search="+obj.searchs+"&keyword="+obj.keyword+"&p_page="+obj.no_rs_page+"&shuffle="+obj.shuffle+"&fields="+obj.fields+"&word="+obj.report_word+"&excel="+obj.report_excel+"&csv="+obj.report_csv+"&sort="+obj.sortby+"&sort_flg="+obj.sort_flg+"&query_flag="+obj.query_flag+"&unshown="+obj.fields_unshow+"&fields_label="+obj.fields_label+"&crl_browse="+obj.control_browse+"&crl_query="+obj.control_query+"&root_path="+obj.root_path+"&field_password="+obj.field_password+"&date_cal_fields="+obj.date_cal_fields+"&mandatory_fields="+obj.mandatory_fields+"&username_valid_field="+obj.username_valid_field+"&idx="+ini_obj.idx++;
	obj.query_flag =0; 
	http.open("POST",url, true);
	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	http.setRequestHeader("Content-length", params.length);
	http.setRequestHeader("Connection", "close");
	http.onreadystatechange = handleHttpResponse;
	http.send(params);
	
}

ServerRequest.prototype.isDelete=function(tbl_name,field,id,cur_idx){   
	if(confirm('Are you sure you want to delete?')){
		$('#grid_loder').slideToggle();
		ini_obj.temp = cur_idx
		var url =  obj.root_path+"delete.php";
		var params = "tbl_name="+tbl_name+"&field="+field+"&id="+id;
		http.open("POST",url, true);
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		http.setRequestHeader("Content-length", params.length);
		http.setRequestHeader("Connection", "close");
		http.onreadystatechange = handleHttpResponseDelete;
		http.send(params);
	}
}
ServerRequest.prototype.isDeleteRecords=function(tbl_name, field, cur_idx){   
	var id = obj.getIds(tbl_name);
	if(id == ''){
		alert('Select atleast one record');
	}else{
		if(confirm('Are you sure you want to delete?')){
			$('#grid_loder').slideToggle();
			ini_obj.temp = cur_idx
			var url =  obj.root_path+"delete.php";
			var params = "tbl_name="+tbl_name+"&field="+field+"&id="+id;
			http.open("POST",url, true);
			http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			http.setRequestHeader("Content-length", params.length);
			http.setRequestHeader("Connection", "close");
			http.onreadystatechange = handleHttpResponseDelete;
			http.send(params);
		}
	}
}
ServerRequest.prototype.edit=function(tbl_name,fields,id,cur_idx){   
	var flds = fields.split(',');
	for(i=0;i<flds.length;i++){
		document.getElementById('txt_'+tbl_name+flds[i]+id).readOnly=false;
		document.getElementById('txt_'+tbl_name+flds[i]+id).className="txt_write";
	}
} 
ServerRequest.prototype.showEdit=function(cur_obj,idx){   
	if(ini_obj.obj_array[idx].control_edit){
		cur_obj.readOnly=false;
		cur_obj.className="txt_write";
		cur_obj.focus();
	}
} 
ServerRequest.prototype.setCheck=function(id, flg){   
	var c_obj = document.getElementsByName(id+"[]");
	for(var i=0;i<c_obj.length;i++){
		c_obj[i].checked = flg;
	}
}
ServerRequest.prototype.getIds=function(tbl_name){   
	var c_obj = document.getElementsByName('del_'+tbl_name+'[]');
	var str='';
	var flg=true;
	for(var i=0;i<c_obj.length;i++){
		if(c_obj[i].checked){
			if(flg){
				str=c_obj[i].value;
				flg = false;
			}
			else{
				str=str+'|'+c_obj[i].value;
			}
		}
	}
	return str;
}
ServerRequest.prototype.shuffles=function(idx){   
	ini_obj.obj_array[idx].shuffle=1;
	obj.fetch_rows(ini_obj.obj_array[idx]);
} 

ServerRequest.prototype.goTo=function(id,idx){   
	ini_obj.obj_array[idx].cur_page=id-1;
	obj.fetch_rows(ini_obj.obj_array[idx]);
}
ServerRequest.prototype.goToPrevious=function(idx){   
	ini_obj.obj_array[idx].cur_page=--obj.cur_page;
	obj.fetch_rows(ini_obj.obj_array[idx]);
}
ServerRequest.prototype.goToNext=function(idx){   
	ini_obj.obj_array[idx].cur_page=++obj.cur_page;
	obj.fetch_rows(ini_obj.obj_array[idx]);
}
ServerRequest.prototype.search_results=function(name,idx){   
	ini_obj.obj_array[idx].searchs = 1;
	ini_obj.obj_array[idx].keyword = document.getElementById(name).value;
	obj.fetch_rows(ini_obj.obj_array[idx]);
}
ServerRequest.prototype.browse=function(idx){   
	ini_obj.temp=idx;
	ini_obj.obj_array[idx].searchs = 0;
	ini_obj.obj_array[idx].cur_page= 0;
	ini_obj.obj_array[idx].keyword='';
	obj.fetch_rows(ini_obj.obj_array[idx]);
}

ServerRequest.prototype.sql_query=function(name,idx){   
	var str = document.getElementById(name).value;
	ini_obj.obj_array[idx].query_flag = 1;
	ini_obj.obj_array[idx].query = str;
	if(str.toUpperCase(str).match("SELECT")){
		obj.fetch_rows(ini_obj.obj_array[idx]);
	}
	else{
		alert("Permission denied for delete, update and alter...");	
	}
	
}

ServerRequest.prototype.sorts=function(name,idx,flg){   
	ini_obj.obj_array[idx].sortby = name;
	ini_obj.obj_array[idx].sort_flg = flg?0:1;
	obj.fetch_rows(ini_obj.obj_array[idx]);
}
ServerRequest.prototype.showhide=function(id,t_name){   
		
	$('#'+id+"_"+t_name+'').slideToggle();
	/*if(document.getElementById("search_"+t_name).style.display !="none" && id!="search")
		$('#search_'+t_name+'').slideToggle();
	
	if(document.getElementById("report_"+t_name).style.display !="none" && id!="report")
		$('#report_'+t_name+'').slideToggle();*/
}
ServerRequest.prototype.save=function(tbl_name,field,idx_fld,id,cur_obj){   
	$('#grid_loder').slideToggle();
	cur_obj.readOnly=true;
	cur_obj.className="txt_read";
	var url = obj.root_path+"save.php";
	var params = "tbl_name="+tbl_name+"&field="+field+"&id="+id+"&idx_fld="+idx_fld+"&value="+cur_obj.value;
	http.open("POST",url, true);
	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	http.setRequestHeader("Content-length", params.length);
	http.setRequestHeader("Connection", "close");
	http.onreadystatechange = handleHttpResponseSave;
	http.send(params);

} 

ServerRequest.prototype.saveRecord=function(tbl_name,field,idx){   
	if(obj.isValidData(idx)){
		$('#grid_loder').slideToggle();
		ini_obj.temp = idx;
		var url = obj.root_path+"save.php";
		var params = "tbl_name="+tbl_name+"&field="+field+"&fields_unshow="+ini_obj.obj_array[idx].fields_unshow+"&password_encrypt="+ini_obj.obj_array[idx].password_encrypt+"&mode="+ini_obj.obj_array[idx].save_mode+"&field_list="+ini_obj.obj_array[idx].fields_list+"&field_password="+ini_obj.obj_array[idx].field_password;

		var default_fields_values = ini_obj.obj_array[idx].default_fields_values.split(',');
		if(default_fields_values !=""){
			for(var j=0;j<default_fields_values.length;j++){
				values = default_fields_values[j].split(':');
				document.getElementById(values[0]).value =values[1];
			}
		}
		
		if(ini_obj.obj_array[idx].fields_list !=''){
			f_ls = ini_obj.obj_array[idx].fields_list.split('|');
			for(var i=0;i<f_ls.length;i++){
				params  = params + "&"+f_ls[i]+"="+document.getElementById(f_ls[i]).value;
			}
		}
		http.open("POST",url, true);
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		http.setRequestHeader("Content-length", params.length);
		http.setRequestHeader("Connection", "close");
		http.onreadystatechange = handleHttpResponseInsert;
		http.send(params);
	}

} 
ServerRequest.prototype.isValidData=function(idx){ 
	var m_fields = ini_obj.obj_array[idx].mandatory_fields.split(',');
	if( ini_obj.obj_array[idx].mandatory_fields !=''){
		for(var i=0;i<m_fields.length;i++){
			if(document.getElementById(m_fields[i]).value == ''){
				alert('Enter '+document.getElementById('label_'+m_fields[i]).innerHTML);
				document.getElementById(m_fields[i]).focus();
				return false;
				break;
			}
		}
	}
	if(ini_obj.obj_array[idx].field_password !=''){
		if(document.getElementById(ini_obj.obj_array[idx].field_password).value ==''){
			alert('Enter password');
			document.getElementById(ini_obj.obj_array[idx].field_password).focus();
			return false;
		}
		if(ini_obj.obj_array[idx].field_password !=''){
			var str = document.getElementById(ini_obj.obj_array[idx].field_password).value;
			
			if(str.length < 6){
				alert('Password must be greater then or equal to six characters');
				document.getElementById(ini_obj.obj_array[idx].field_password).focus();
				return false;
			}
			if(document.getElementById(ini_obj.obj_array[idx].field_password).value!=''){
				if(document.getElementById("re"+ini_obj.obj_array[idx].field_password).value != document.getElementById(ini_obj.obj_array[idx].field_password).value){
					alert('Password and re-password are not equal');
					document.getElementById(ini_obj.obj_array[idx].field_password).focus();
					return false;
				}
			}
		}
	}
	if(!obj.isNumber(idx))
		return false;
	if(!obj.isValidEmail(idx))
		return false;	
	if(!obj.isUserExist(idx))
		return false;
		
	return true;
}
ServerRequest.prototype.isNumber=function(idx){ 
	var rtn = true;
	var num_fields = ini_obj.obj_array[idx].num_valid_fields.split(',');
	if( ini_obj.obj_array[idx].num_valid_fields !=''){
		for(var i=0;i<num_fields.length;i++){
			if(document.getElementById(num_fields[i]).value != '' && isNaN(document.getElementById(num_fields[i]).value)){
				alert('Invalid data, enter numbers only');
				document.getElementById(num_fields[i]).focus();
				document.getElementById(num_fields[i]).select();
				rtn = false;
				break;
			}
		}
	}
	return rtn;
}
ServerRequest.prototype.isUserExist=function(idx){ 
	var rtn = true;
	var num_fields = ini_obj.obj_array[idx].user_list.split('|');
	if( ini_obj.obj_array[idx].user_list !='' && ini_obj.obj_array[idx].save_mode == 0){
		for(var i=0;i<num_fields.length;i++){
			if(document.getElementById(ini_obj.obj_array[idx].username_valid_field).value == num_fields[i]){
				alert('Invalid user, user already exist');
				document.getElementById(ini_obj.obj_array[idx].username_valid_field).focus();
				document.getElementById(ini_obj.obj_array[idx].username_valid_field).select();
				rtn = false;
				break;
			}
		}
	}
	return rtn;
}
ServerRequest.prototype.isValidEmail=function(idx){ 
	var rtn = true;
	var e_fields = ini_obj.obj_array[idx].email_valid_fields.split(',');
	if( ini_obj.obj_array[idx].email_valid_fields !=''){
		for(var i=0;i<e_fields.length;i++){
			if(document.getElementById(e_fields[i]).value != '' && !(document.getElementById(e_fields[i]).value).match(/^[a-zA-Z][\w\.-]*[a-zA-Z0-9]@[a-zA-Z0-9][\w\.-]*[a-zA-Z0-9]\.[a-zA-Z][a-zA-Z\.]*[a-zA-Z]$/)){
				alert('Invalid email ID');
				document.getElementById(e_fields[i]).focus();
				document.getElementById(e_fields[i]).select();
				rtn = false;
				break;
			}
		}
	}
	return rtn;
}
ServerRequest.prototype.onEdit=function(tbl_name,field,idx_fld,values,f_list,idx,d_edit_id,d_main_id){   
	$('#'+d_edit_id).slideToggle();
	$('#'+d_main_id).slideToggle();
	
	ini_obj.obj_array[idx].fields_list = f_list;
	ini_obj.obj_array[idx].save_mode = 1;
	ini_obj.fld_values = values;
	var value_list = values.split("|");
	var field_list = f_list.split('|');
	
	var unshown_field_list = ini_obj.obj_array[idx].fields_unshow.split(',');
	
	for(var i=0;i<field_list.length;i++){
		document.getElementById(field_list[i]).value = value_list[i];
		if(field_list[i] == field)
			document.getElementById('edit_title').innerHTML = " EDIT - "+ value_list[i];
		
		if(field_list[i] == ini_obj.obj_array[idx].field_password)
			document.getElementById('re'+field_list[i]).value = value_list[i];
	}
	
	if(ini_obj.obj_array[idx].field_password !="")
	document.getElementById("re_"+ini_obj.obj_array[idx].field_password).style.display = 'none';
	
	if(unshown_field_list !=""){
		for(var j=0;j<unshown_field_list.length;j++){
			document.getElementById("edit_"+unshown_field_list[j]).style.display = 'none';
		}
	}
}
ServerRequest.prototype.addNew=function(idx){   
	var unshown_field_list = ini_obj.obj_array[idx].fields_unshow.split(',');
	
	if(unshown_field_list !=""){
		for(var j=0;j<unshown_field_list.length;j++){
			document.getElementById("edit_"+unshown_field_list[j]).style.display = 'none';
		}
	}
}
ServerRequest.prototype.onViewData=function(field,values,f_list,idx,d_view_id,d_main_id){   
	ini_obj.obj_array[idx].fields_list = f_list;
	ini_obj.fld_ls = f_list;
	ini_obj.fld_values = values;
	var value_list = values.split("|");
	var field_list = f_list.split('|');
	
	for(var i=0;i<field_list.length;i++){
		if(field_list[i] == field)
			document.getElementById('view_title').innerHTML = " VIEW - "+ value_list[i];
			
		if(field_list[i] != ini_obj.obj_array[idx].field_password)
			document.getElementById("span_"+field_list[i]).innerHTML = value_list[i] ==""?"&nbsp;":value_list[i];
	}
	$('#'+d_view_id).slideToggle();
	$('#'+d_main_id).slideToggle();
	
} 
ServerRequest.prototype.update=function(tbl_name, field, idx, d_view_id, d_edit_id){   
	$('#'+d_view_id).slideToggle();
	$('#'+d_edit_id).slideToggle();
	obj.onEdit(tbl_name, field,'', ini_obj.fld_values,ini_obj.fld_ls, idx);
	
} 
ServerRequest.prototype.resetData=function(f_list, u_list, idx){
	ini_obj.obj_array[idx].fields_list = f_list;
	ini_obj.obj_array[idx].user_list = u_list;
	ini_obj.obj_array[idx].save_mode = 0;
	var unshown_field_list = ini_obj.obj_array[idx].fields_unshow.split(',');
	var unshown_field_list_new = ini_obj.obj_array[idx].fields_unshow_new.split(',');
	
	var f_list = ini_obj.obj_array[idx].fields_list.split('|');
	if(unshown_field_list !=""){
		for(var j=0;j<unshown_field_list.length;j++){
			document.getElementById("edit_"+unshown_field_list[j]).style.display = '';
		}
	}
	if(unshown_field_list_new !=""){
		for(var j=0;j<unshown_field_list_new.length;j++){
			document.getElementById("edit_"+unshown_field_list_new[j]).style.display = 'none';
		}
	}
		
	document.getElementById('edit_title').innerHTML = " NEW RECORD ";
	
	if(ini_obj.obj_array[idx].field_password !="")
		document.getElementById("re_"+ini_obj.obj_array[idx].field_password).style.display = '';
	
	for(var i=0;i<f_list.length;i++){
		if(f_list[i] != ''){
			document.getElementById(f_list[i]).value = '';
			if(f_list[i] == ini_obj.obj_array[idx].field_password){
				document.getElementById('re'+f_list[i]).value = '';
			}
		}
	}
}
ServerRequest.prototype.reports=function(format,sql){   
	var url = obj.root_path+"reports.php?";
	var params = "report="+format+"&query="+sql+"&report_fields="+obj.report_fields;
	window.location.href=url+params;
} 
ServerRequest.prototype.insert=function(tbl_name,field,idx,flg){   
	$('#grid_loder').slideToggle();
	ini_obj.obj_array[idx].keyword='';
	ini_obj.temp=idx;
	var url = obj.root_path+"insert.php";
	var params = "tbl_name="+tbl_name+"&field="+field+"&id="+idx+"&flg_inc="+flg;
	http.open("POST",url, true);
	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	http.setRequestHeader("Content-length", params.length);
	http.setRequestHeader("Connection", "close");
	http.onreadystatechange = handleHttpResponseDelete;
	http.send(params);

}

ServerRequest.prototype.truncate = function(tbl_name,id){   
	if(confirm('Sure you want to empty this table')){
		$('#grid_loder').slideToggle();
		ini_obj.temp=id;
		var url = obj.root_path+"truncate.php";
		var params = "tbl_name="+tbl_name;
		http.open("POST",url, true);
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		http.setRequestHeader("Content-length", params.length);
		http.setRequestHeader("Connection", "close");
		http.onreadystatechange = handleHttpResponseDelete;
		http.send(params);
	}

}
function getHTTPObject(){
	var xmlhttp;
 
  	if(window.XMLHttpRequest){
    	xmlhttp = new XMLHttpRequest();
  	}
  	else if (window.ActiveXObject){
    	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	    if (!xmlhttp){
        	xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
    	}
	}
	return xmlhttp;
}
var http = getHTTPObject();