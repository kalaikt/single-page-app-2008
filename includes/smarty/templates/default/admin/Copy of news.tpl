{literal}
<script type="text/javascript">
function getNews(){
	var sql="SELECT title, description, added_date FROM news";
	obj_ajax1 = new ServerRequest("news_list",sql,true,5,"title, description, date");
	obj_ajax1.control_empty=false;
	obj_ajax1.control_insert=true;
	obj_ajax1.control_search=true;
	obj_ajax1.control_edit=true;
	obj_ajax1.control_browse=true;
	obj_ajax1.report_word=true;
	obj_ajax1.report_excel=true;
	obj_ajax1.report_csv=true;
	obj_ajax1.root_path ='grid/';{/literal}
	obj_ajax1.default_fields_values = 'user_id:{$smarty.session.admin_user_id},added_date:NOW()';
	{literal}
	obj_ajax1.mandatory_fields = 'title,description';
	obj_ajax1.fields_unshow_new = 'added_date,user_id';
	obj_ajax1.fields_unshow='added_date';
	obj_ajax1.fields_label = 'user ID, title, description, URL';
	obj_ajax1.fetch_rows(obj_ajax1);
}
setTimeout("getNews()",100);
</script>
{/literal}
<div id="news_list" align="left" style="width:730px;"></div>