{literal}
<style type="text/css">
  TABLE.calendar { text-align: center; }
  TH.month { background-color: #E0E0E0; }
  TD.prev-month { text-align: left; }
  TD.next-month { text-align: right; }
  TH.day-of-week { font-size: 8pt; }
  TD.selected-day { background-color: #FFFFFF; }
  TD.day { background-color: #E0E0E0; }
  TD.today { background-color: #E0E0E0; font-weight: bold; }
</style>
{/literal}
<table class="calendar" border="0" cellpadding="1" cellspacing="1" width="300" height="300">
  
  <tr>
  	<td class="prev-month" colspan="3">
      <a href="/motionu/events/index.php?a=promotion{$prev_month_end|date_format:$url_format}"> << </a><!--{$prev_month_abbrev} -->
    </td>
    <td>
    </td>
	<td class="next-month" colspan="3">
      <a href="/motionu/events/index.php?a=promotion{$next_month_begin|date_format:$url_format}"> >> </a><!--{$next_month_abbrev} -->
    </td>
  </tr>
  <tr>
  {section name="day_of_week" loop=$day_of_week_abbrevs}
    <th class="day-of-week">{$day_of_week_abbrevs[day_of_week]}</th>
  {/section}
  </tr>
	{section name="row" loop=$calendar}
		<tr>
		  {section name="col" loop=$calendar[row]}
			{assign var="date" value=$calendar[row][col]}
			{if $date == $selected_date}
			  <td class="selected-day">{$date|date_format:"%e"}</td>
			{elseif $date < $day}
				<td bgcolor="#99CC33" style="background-repeat:no-repeat;">{$date|date_format:"%e"}</td>
			{elseif $date|date_format:"%m" == $month}
			  <td class="day">
				<a href="/motionu/events/index.php?a=promotion{$date|date_format:$url_format}">
				  {$date|date_format:"%e"}
				</a>
			  </td>
			{else}
			  <td style="background-color: #E0E0E0;"></td>
			{/if}
		  {/section}
		</tr>
	{/section}
  <tr>
    <td class="today" colspan="7">
      {if $today_url != ""}
        <a href="/motionu/events/index.php?a=promotion{$today_url}">Today</a>
      {else}
        Today
      {/if}
    </td>
  </tr>
</table>
