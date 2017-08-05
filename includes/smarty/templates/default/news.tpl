{include file="default/loader.tpl"}
<table cellpadding="0" cellspacing="0" border="0" width="100%">
  <tr>
    <td colspan="2" align="left" style="padding-left:30px;"><!--<img src="images/contact.jpg">--></td>
     <td align="left"> &nbsp;<!--<img src="images/new.jpg">--></td>
  </tr>
  <tr>
<td width="52%" class="content pad" valign="top">
<table border="0" cellspacing="0" cellpadding="0">
{foreach from=$pu->getNews('',1) key=news_id item=news}
  <tr>
    <td scope="col"> <div class="sub_heading" id="news_{$news_id}">{$news.title|ucfirst} <span class="content"><strong>- {$news.added_date|date_format:"%m.%d.%y"}</strong></span></div><div><br /></div>
 <div class="news_desc">{if $news.image}<div class="news_image"><img src="images/{$news.image}" alt=""/></div>{/if}{$news.description|ucfirst|replace:"\n":"<br />"}</div>
 </td>
  </tr>
   <tr>
    <td scope="row">&nbsp;</td>
  </tr>
{foreachelse}
  <tr>
    <td scope="row" class="required">News not found</td>
  </tr>
{/foreach}
 
</table>

 
 </td>
	<td width="3%" valign="top" class="content"><img src="images/line_sep.jpg" alt=""/></td>
	<td width="38%" align="left" valign="top" class="content" style="padding-top:10px;">{include file="default/whatsnew.tpl"}</td>
</tr>
</table>