<!--<div class="sub_heading">Write  some "News" type articles up:</div>
<ul>
<ul class="list">
  <li>Held hostage by my own company</li>
  <li>Reduce cycle time, improve responsiveness</li>
  <li>What the heck is PeopleU?</li>
  <li>Outsourcing vs. Insourcing vs. Flexsourcing</li>
  <li>Is augmentation right for me?</li>
</ul>
-->
<table border="0" cellspacing="0" cellpadding="0" width="95%">
{foreach from=$pu->getNews('',1) key=news_id item=news}
  <tr>
    <td scope="col" style="padding-right:30px;" ><span class="content"><a class="content font_11" href="#news_{$news_id}"><strong>{$news.title|ucfirst}</strong></a> - {$news.added_date|date_format:"%m.%d.%y"}</span></td>
  </tr>
  <tr>
  <td class="line_brd" ><img src="images/dotted.jpg"  alt=""/></td>
  </tr>
{foreachelse}
  <tr>
    <td scope="row" class="required">News not found</td>
  </tr>
{/foreach}
 
</table>