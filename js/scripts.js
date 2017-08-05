function PeopleU(){
	this.temp=0;
}
object = new PeopleU();
PeopleU.prototype.getData=function(tpl_name, params){   
	var url ="index.php?&tpl="+tpl_name;
	$('#loading').slideToggle();
	http.open("POST",url, true);
	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	http.setRequestHeader("Content-length", params.length);
	http.setRequestHeader("Connection", "close");
	http.onreadystatechange = handleHttpResponse;
	http.send(params);
} 
PeopleU.prototype.isValidData=function(name,idx){   
	var obj = document.getElementsByName(name);
	flg = true;
	flg1 = true;
	for(i=idx;i<obj.length;i++){
		if(obj[i].value==''){
			alert(obj[i].title);
			obj[i].focus();
			flg = false;
			break;
		}
		if(obj[i].id == 'email'){
			if(!(obj[i].value).match(/^[a-zA-Z][\w\.-]*[a-zA-Z0-9]@[a-zA-Z0-9][\w\.-]*[a-zA-Z0-9]\.[a-zA-Z][a-zA-Z\.]*[a-zA-Z]$/)){
				alert('Invalid email ID');
				obj[i].focus();
				obj[i].select();
				flg = false;
				break;
			}
			
		}
	}
	return flg;
}
PeopleU.prototype.setShowHide=function(ids,obj){   
	id = ids.split('|');
	this.content='';
	for(i=0;i<id.length;i++){
		if(i>0 && document.getElementById(id[i]).style.display !="none"){
			$('#'+id[i]+'').slideToggle();
		}
		else if(i==0){
			if(document.getElementById(id[i]).style.display =="none")
				$('#'+id[i]+'').slideToggle();
			/*if(document.getElementById('course_list').style.display =="none")
				$('#course_list').slideToggle();*/
		}
	}
	if(obj){
		object.setBrd(obj);
	}
}
PeopleU.prototype.setBrd=function(obj){
	temp = document.getElementsByTagName('td');
	
	for(i=0;i<temp.length;i++){
		if(temp[i].className == 'submenu selected'){
			temp[i].className = 'submenu';
			break;
		}
	}
	obj.className='submenu selected';
}

PeopleU.prototype.isValidEmail=function(name){
	if(!(name.value).match(/^[a-zA-Z][\w\.-]*[a-zA-Z0-9]@[a-zA-Z0-9][\w\.-]*[a-zA-Z0-9]\.[a-zA-Z][a-zA-Z\.]*[a-zA-Z]$/)){
		alert('Invalid email ID');
		name.focus();
		name.select();
		return false;
	}
	return true;
}
PeopleU.prototype.saveData=function(tpl, name, param, idx){   
	str ='';
	obj = document.getElementsByName(name);
	if(object.isValidData(name, idx)){
		for(i=0;i<obj.length;i++){
			str = str + '&'+obj[i].id + "=" + obj[i].value;
		}
		object.getData(tpl , str+param);
	}
}
PeopleU.prototype.setClass=function(obj){
	objs = document.getElementsByTagName('td');
	for(i=0;i<objs.length;i++){
		if(objs[i].className == "menu_img menu"){
			objs[i].className = "menu"; 
			break;
		}
	}
	obj.className = 'menu_img menu';
}
function handleHttpResponse(){	
	if (http.readyState == 4){
		if(http.status==200){
			document.getElementById('main_content').innerHTML = http.responseText;
			if(document.getElementById('hold')){
				initScrollLayer();
			}
		}
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