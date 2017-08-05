var uploader="";
var uploadDir="";
var dirname="";
var filename="";
var timeInterval="";
var idname="";
uploaderId = 'add_image';
function PeopleU(){
	this.content='';
}
people = new PeopleU();
PeopleU.prototype.getData=function(tpl_name, params){   
	var url ="ajax.php?&tpl_name="+tpl_name;
	$('#loading').slideToggle();
	http.open("POST",url, true);
	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	http.setRequestHeader("Content-length", params.length);
	http.setRequestHeader("Connection", "close");
	http.onreadystatechange = handleHttpResponse;
	http.send(params);
} 

PeopleU.prototype.traceUpload=function(){
	var url ="imageupload.php?&uploadDir="+uploadDir+"&dirname="+dirname+"&filename="+filename+"&uploader="+uploader;
	var params='';
	http.open("POST",url, true);
	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	http.setRequestHeader("Content-length", params.length);
	http.setRequestHeader("Connection", "close");
	http.onreadystatechange = handleResponse;
	http.send(params);
} 
PeopleU.prototype.deleteFile=function(url){
	$('#loading').slideToggle();
	var params='';
	url = "deletefile.php?&"+url;
	http.open("POST",url, true);
	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	http.setRequestHeader("Content-length", params.length);
	http.setRequestHeader("Connection", "close");
	http.onreadystatechange = handleResponse;
	http.send(params);
} 
PeopleU.prototype.uploadFile = function(obj, dname) {
	uploadDir=obj.value;
	idname=obj.name;
	dirname=dname;
	filename=uploadDir.substr(uploadDir.lastIndexOf('\\')+1);
	filename=document.getElementById('f_name').value+filename;
	//document.getElementById('loading'+idname).innerHTML="<img src='loading.gif' alt='loading...' />";
	uploaderId = 'uploader'+obj.name;
	uploader = obj.name;

	if(people.checkPhoto(filename)){
		$('#loading').slideToggle();
		document.getElementById('formName'+obj.name).submit();
		timeInterval=setInterval("people.traceUpload()", 1500);
	}
	else{
		alert("Invalid file format. We supports  .JPG, .PNG, and .GIF image formats.");
	}
}
PeopleU.prototype.check=function(ch, name){   
	var ch_box = document.getElementsByName(name);
	for(i=0;i<ch_box.length;i++){
		ch_box[i].checked = ch;
	}
}
PeopleU.prototype.checkPhoto=function(imagePath){   
	 var pathLength = imagePath.length;
	 var lastDot = imagePath.lastIndexOf(".");
	 var fileType = imagePath.substring(lastDot,pathLength);
	 if((fileType == ".gif") || (fileType == ".jpg") || (fileType == ".png") || (fileType == ".GIF") || (fileType == ".JPG") || (fileType == ".PNG")) {
	  return true;
	 } 
	 else {
	  return false;
	}
}
PeopleU.prototype.getList=function(tpl, id){   
	people.getData(tpl, id);
}
PeopleU.prototype.searchs=function(tpl, id, e){   
	if(e==13){
		people.getData(tpl, "&keyword="+id.value);
	}
}
PeopleU.prototype.reports=function(type,sql, name){   
	document.location.href = "report.php?report="+type+"&sql="+sql+'&name='+name;
}

PeopleU.prototype.setClear=function(name){   
	obj = document.getElementsByName(name);
	document.getElementById('edit_txt').innerHTML = "Add";
	for(i=0;i<obj.length;i++){
		switch(obj[i].type){
			case 'select-one':
				obj[i].selectedIndex = 0;
				break;
			default:
				obj[i].value = '';
		}
	}
	obj[1].focus();
	
	if(document.getElementById('add_image')){
		people.deleteFile('');
	}
	if(document.getElementById('preview')){
		document.getElementById('preview').style.display = 'none';
		$('#ptext').slideToggle();
	}
}
PeopleU.prototype.deleteRecords=function(tpl, name, id, msg){   
	obj = document.getElementsByName(name);
	str='';
	flg = false;
	for(i=0;i<obj.length;i++){
		if(obj[i].checked){
			str = str !=''?str + "|"+ obj[i].value:obj[i].value;
			flg = true;
		}
	}
	if(flg){
		if(confirm(msg)){
			people.getData(tpl, id+str);
			
		}
	}
	else
		alert('You must select atleast one record');
}
PeopleU.prototype.deleteRecord=function(tpl,id, msg){   
	if(confirm(msg)){
		people.getData(tpl, id);
	}
}
PeopleU.prototype.setText=function(){
	
	
	if(document.getElementById('ptext').style.display == 'none'){
		$('#ptext').slideToggle();
	}
	var str ='';
	if(document.getElementById('title_image')){
		str = document.getElementById('title_image').value !=''?'<div class="news_image"><img src="../images/'+document.getElementById('title_image').value+'"/></div>':'';
		document.getElementById('p_content').className = 'height';
	}
	else{
		document.getElementById('p_content').className = 'none';
	}
	
	str = str + (document.getElementById('title').value !=''?'<div class="sub_heading">'+document.getElementById('title').value+'</div>':'');
	//str = str + (document.getElementById('sub_title').value !=''?'<div class="sub_heading">'+document.getElementById('sub_title').value+'</div>':'');
	tem = document.getElementsByName('data[]');
	
	if(str != ""){
		document.getElementById('preview').style.display = '';
	}
	document.getElementById('p_content').innerHTML = str + (new String(tem[2].value)).replace(/\n/g,"<br>");
	//alert(document.getElementById('p_content').innerHTML);
}
PeopleU.prototype.addMoreTitle = function(){
	str ='';
	if(document.getElementById('title_image')){
		str = document.getElementById('title_image').value !=''?'<div><img src="../images/'+document.getElementById('title_image').value+'"/><br/><div>':'';
		document.getElementById('title_image').value='';
	}
	
	str = str + (document.getElementById('title').value !=''?'<div class="heading">'+document.getElementById('title').value+'</div>':'');
	//str = str + (document.getElementById('sub_title').value !=''?'<div class="sub_heading">'+document.getElementById('sub_title').value+'</div>':'');
	if(document.getElementById('description').value !=' '){
		this.content = this.content + str + document.getElementById('description').value+"<br/><br/>";
	}
	
	document.getElementById('title').value ='';
	document.getElementById('sub_title').value ='';
	document.getElementById('description').value =' ';
	if(document.getElementById('title_image')){
		document.getElementById('title_image').value !=''?people.addImage():'';
	}
}
PeopleU.prototype.setContents=function(tpl,name,param,idx){ 
	if(people.isValidData(name, idx)){
		people.addMoreTitle();
		document.getElementById('description').value = document.getElementById('p_content').innerHTML;
		this.content='';
		people.saveData(tpl, name, param, idx);
	}
}
PeopleU.prototype.saveData=function(tpl, name, param, idx){   
	str ='';
	obj = document.getElementsByName(name);
	if(people.isValidData(name, idx)){
		for(i=0;i<obj.length;i++){
			str = str + '&'+obj[i].id + "=" + obj[i].value;
		}
		if(document.getElementById('title_image')){
			str = str + "&image="+document.getElementById('title_image').value;
		}
		people.getData(tpl , str+param);
	}
}
PeopleU.prototype.isValidData=function(name,idx){   
	var obj = document.getElementsByName(name);
	flg = true;
	for(i=idx;i<obj.length;i++){
		if(obj[i].value==''){
			alert(obj[i].title);
			obj[i].focus();
			flg = false;
			break;
		}
	}
	return flg;
}
PeopleU.prototype.setValues=function(str, name){   
	value = str.split('|');
	obj = document.getElementsByName(name);
	document.getElementById('edit_txt').innerHTML = "Edit";
	for(i=0;i<obj.length;i++){
		switch(obj[i].type){
			case 'select-one':
				obj[i].selectedIndex = value[i];
				break;
			default:
				obj[i].value = new String(value[i]).replace(/~/g,'"').replace(/@/g,"'").replace(/images\//g,"../images/");
		}
	}
	people.setText();
	people.setShowHide('add_news|search|reports|news_list');
}
PeopleU.prototype.setShowHide=function(ids){   
	id = ids.split('|');
	this.content='';
	for(i=0;i<id.length;i++){
		if(i>0 && document.getElementById(id[i]).style.display !="none" && id[i] != "news_list"){
			$('#'+id[i]+'').slideToggle();
		}
		else if(i==0){
			$('#'+id[i]+'').slideToggle();
			if(document.getElementById('news_list').style.display =="none" || id[i] == "add_news")
				$('#news_list').slideToggle();
		}
	}
}

function handleHttpResponse(){	
	if (http.readyState == 4){
		if(http.status==200){
			$('#loading').slideToggle();
			document.getElementById('main_content').innerHTML = http.responseText;
		}
  	}
}
function handleImageResponse(){	
	if (http.readyState == 4){
		if(http.status==200){
			$('#loading').slideToggle();
			document.getElementById('add_image').innerHTML = http.responseText;
		}
  	}
}
PeopleU.prototype.addImage=function(obj){
	var url ="ajax.php?&add_image=true";
	$('#loading').slideToggle();
	http.onreadystatechange = handleImageResponse;
   	http.open("GET", url); 
   	http.send(null); 
}
function HttpFileUploadResponse(){	
	if (http.readyState == 4){
		if(http.status==200){
			$('#loading').slideToggle();
			document.getElementById('upload').innerHTML = http.responseText;
		}
  	}
}
function handleResponse() {
	if(http.readyState == 4){
		var response=http.responseText; 
		if(response.indexOf("Open File") != -1 || response.indexOf("<input") != -1 ){
			clearInterval(timeInterval);
			$('#loading').slideToggle();
			//document.getElementById('loading'+idname).innerHTML="";
		}
		
        document.getElementById('add_image').innerHTML=response;
		people.setText();
    }
    else {
    	document.getElementById('add_image').innerHTML="Uploading File. Please wait...";
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