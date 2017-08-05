{$pu->checkLogin()}
{if $smarty.post.title}{$pu->newsUpdate()}{/if}
{if $smarty.post.delete}{$pu->deleteNews()}{/if}
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="" border="0" cellspacing="0" cellpadding="0" align="right">
  <tr>
  	 <th scope="col"><img src="../images/browse.gif"  title="Search" class="hand" onclick="people.getData('{$smarty.get.tpl_name}','');"/></th>
    <th scope="col"><img src="../images/search.gif"  title="Search" class="hand" onclick="people.setShowHide('search|add_news|reports|news_list')"/></th>
    <th scope="col"><img src="../images/report.gif"  title="Report" class="hand" onclick="people.setShowHide('reports|add_news|search|news_list')"/></th>
    <th scope="col"><img src="../images/insert.gif"  title="Add new record" class="hand" onclick="people.setShowHide('add_news|search|reports|news_list');people.setClear('data[]');"/></th>
  </tr>
</table></td>
  </tr>
  <tr>
    <td><div id="loading" align="center" style="display:none;position:absolute; height:800px; width:700px; top:50px;"><img src="../images/loading.gif"   title="Loading"/></div><div id="reports" style="display:none;"><table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><img src="../images/excel.gif"  title="Generate excel report" class="hand" onclick="people.reports('excel',document.getElementById('sql').value ,'cources');"/></td>
    <td><img src="../images/word.gif"  title="Generate word report" class="hand" onclick="people.reports('word',document.getElementById('sql').value ,'cources');"/></td>
    <td><img src="../images/csv.gif"  title="Generate csv report" class="hand" onclick="people.reports('csv',document.getElementById('sql').value ,'cources');"/></td>
  </tr>
</table>
</div><div id="search" style="display:{if $smarty.post.keyword}block{else}none{/if};"><table border="0" cellspacing="2" cellpadding="0">
  <tr>
    <td><input name="text_keyword" id="text_keyword" type="text"  class="text_box" value="{$smarty.post.keyword}" onkeyup='people.searchs("{$smarty.get.tpl_name}",this, event.keyCode);'/></td>
    <td><img src="../images/search_button.gif"  title="Search" class="hand" onclick="people.getData('{$smarty.get.tpl_name}','&keyword='+document.getElementById('text_keyword').value);"/></td>
  </tr>
</table>
</div><div id="add_news" style="display:{if $smarty.post.news_id}block{else}none{/if};">
<input type="hidden" name="data[]" id="news_id" value="{$smarty.post.news_id}"/>
<table border="0" cellspacing="4" cellpadding="0" width="100%">
  <tr>
    <th colspan="2" scope="col" class="header"><span id="edit_txt">Add</span> News</th>
  </tr>
  <tr>
    <th colspan="2" scope="col">&nbsp;</th>
  </tr>
  <tr>
    	<th align="left" scope="row" colspan="2">&nbsp;</th>
  </tr>
  <tr>
    <th align="left" scope="row">Image</th>
    <td align="left"><div id='add_image'>{if !$newsdata[$smarty.post.news_id].image}{$ajax->showFileUploader('upload')}{else}<a href='../images/{$newsdata[$smarty.post.news_id].image}' target='_blank'>Open File</a> &nbsp;&nbsp;&nbsp; <a href='javascript:people.deleteFile("deletefile.php?filename=../images/{$newsdata[$smarty.post.news_id].image}");'><img src='../images/delete.png'/></a><input type='hidden' name='title_image' id='title_image' value='{$newsdata[$smarty.post.news_id].image}'>{/if}</div></td>
  </tr>
   <tr>
    <th align="left" scope="row">Title<span class="star">*</span></th>
    <td><input type="text" name="data[]" id="title" class="text_box width" value="{$newsdata[$smarty.post.news_id].title}"  title="Enter title" onkeyup="people.setText();"/></td>
  </tr>
  <tr>
    <th align="left" scope="row">Description<span class="star">*</span></th>
    <td><label>
      <textarea name="data[]" id="description" rows="5" class="text_box width" title="Enter page description" onkeyup="people.setText();">{$newsdata[$smarty.post.news_id].description}</textarea>
    </label></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><br /><input type="submit"  name="addcourse" value=" Submit " class="submit_button" onclick=" return people.saveData('{$smarty.get.tpl_name}', 'data[]', '', 1);"/><input type="button"  name="addcourse" value=" Cancel " class="submit_button" onclick="people.setShowHide('add_news|search|reports|news_list')"/></td>
  </tr>
  <tr>
    	<td align="left" scope="row" colspan="2" id="preview"><strong>Preview</strong><div class="content pad" style="background-color:#353535;display:{if $smarty.post.news_id}block{else}none{/if};" id="ptext"><div id="p_content" class="height">{if $newsdata[$smarty.post.news_id].image}<div class="news_image"><img src="../images/{$newsdata[$smarty.post.news_id].image}"/></div>{/if}<div class="sub_heading">{$newsdata[$smarty.post.news_id].title}</div>{$newsdata[$smarty.post.news_id].description|replace:"\n":"<br />"}</div></div></td>
  </tr>
</table>
</div></td>
  </tr>
  <tr>
    <td><div id="news_list" style="display:{if !$smarty.post.news_id}block{else}none{/if}"><table width="100%" border="1" cellspacing="2" cellpadding="0" class="css_tbl">
  <tr>
    <th width="5%" align="center" class="header"><label for="multy_delete">
    <input type="checkbox" name="multy_delete" id="multi_delete" onclick="people.check(this.checked,'delete[]');" class="hand"/></label></th>
    <th width="29%" class="header" align="left">Title</th>
    <th width="45%" class="header">Description</th>
    <th class="header">Status</th>
    <th width="6%" class="header">Edit</th>
    <th width="6%" class="header">Delete</th>
   </tr>
  {foreach from=$pu->getNews() key=news_id item=news}
  <tr>
    <td align="center" class="header"><input type="checkbox" name="delete[]" id="delete_{$news_id}" class="hand" value="{$news_id}"/></td>
    
    <td class="css_td">{$news.title|ucfirst|truncate:"50"}</td>
    <td class="css_td" >{$news.description|ucfirst|truncate:"150"}</td>
     <td class="css_td" >{if $news.status eq "1"}<span class="active">Active</span>{else}<span class="required">Inactive</span>{/if}</td>
   <td align="center" class="css_td center"><img src="../images/edit.gif" title="Edit record" class="hand" onclick="people.getData('news.tpl','&news_id={$news_id}');"/></td>
    <td align="center" class="css_td center"><label for="delete_{$news_id}"><img src="../images/delete.png" title="Delete record" class="hand" onclick="people.deleteRecord('{$smarty.get.tpl_name}', '&delete=true&news_id={$news_id}','Are you sure you want to delete this course?');"/></label></td>
  </tr>{foreachelse}
  <tr>
    <td colspan="6"class="css_td red" align="center">News not found</td>
  </tr>
  {/foreach}
  {if $news.pages}
  <tr>
    <td class="css_td" align="center"><img src="../images/delete.png" title="Delete multiple record" class="hand" onclick="people.deleteRecords('{$smarty.get.tpl_name}', 'delete[]', '&delete=true&news_id=','Are you sure you want to delete selected course?')"/></td>
    <th colspan="5" class="v_align"><div class="page">
    {if $smarty.post.p > 0}
		{assign var="p" value=$smarty.post.p}
	{else}
		{assign var="p" value=1}
	{/if}
    {assign var="k_word" value=$smarty.post.keyword}
    {sliding_pager baseurl="javascript:people.getData('news.tpl','&keyword=$k_word&p=" url_append="');" pagecount=$news.pages|default:1 curpage=$p txt_prev="<img src='../images/pager_previous_icon.gif' alt='Previous' title='Previous'  class='hand'/>" txt_next="<img src='../images/pager_next_icon.gif' alt='Next' title='Next' class='hand'/>" txt_first="First" txt_last="Last" }&nbsp;</div></th>
  </tr>
  {/if}
</table></div>
<input type="hidden" name="sql" id="sql" value="{$pu->getQuery()}" />
</td>
  </tr>
</table>
<div id="content_test"></div>
	




