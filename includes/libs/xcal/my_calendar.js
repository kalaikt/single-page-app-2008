function handleHttpResponse() 
{	
	if (http.readyState == 4) 
	{
		if(http.status==200) 
		{
			var results=http.responseText;
			document.getElementById('my_cal').innerHTML = results;
		}
  	}
}

function getEvents(date) 
{    
	var url ='getmy_cal.php?date='+date;
	http.open("GET",url, true);
	http.onreadystatechange = handleHttpResponse;
	http.send(null);
}
function getHTTPObject() 
{
	var xmlhttp;
 
  	if(window.XMLHttpRequest)
  	{
    	xmlhttp = new XMLHttpRequest();
  	}
  	else if (window.ActiveXObject)
  	{
    	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	    if (!xmlhttp)
		{
        	xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
    	}
	}
	return xmlhttp;
}
var http = getHTTPObject();



this.flag=true;
this.event_rate=5;
this.inc=5;
this.idx=0;
this.temp=new Array();
this.event_date=new Date(2007,8,15);
this.txt_name='';
function Calendar (cname, id, date,divid)
{
	// Used to notify the calendar that it is attached to a single html field.
	this.fallback_single = 0;
	
	//Calendar Div tag id
	this.div_id=divid;
	
	// Used to notify the claendar that it is attached to 3 html fields.
	this.fallback_multi = 1;

	// Used to notify the calendar that it is attached to both field sets.
	this.fallback_both = 2;

	// Read-only calendar
	this.viewOnly = false;
	
	// Allows the user to select weekends
	this.allowWeekends = true;
	
	// Allows the user to select weekdays
	this.allowWeekdays = true;
	
	// The minimum date that the user can select (inclusive)
	this.minDate = "--";
	
	
	// The maximum date that the user can select (exclusive)
	this.maxDate = "--";
	
	// Allow the user to scroll dates
	this.scrolling = true;
	
	// The id of this calendar
	this.name = cname;
	
	// The first day of the week in the calendar (0-Sunday, 6-Saturday)
	this.firstDayOfWeek = 0;
	
	// Fallback method
	this.fallback = this.fallback_both;
	
	// Sets the date and strips out time information
	this.calendarDate = date;
	this.calendarDate.setUTCHours(0);
	this.calendarDate.setUTCMinutes(0);
	this.calendarDate.setUTCSeconds(0);
	this.calendarDate.setUTCMilliseconds(0);
	
	// The field id that the calendar is attached to.
	// For single input, this is used "as is". for the
	// Multi-input, it is given a suffix for _day, _month
	// and _year inputs.
	this.attachedId = id;
	document.getElementById(this.attachedId).value = "";
		// The left and right month control icons
	this.controlLeft = "&#171;";
	this.controlRight = "&#187;";
		
	// The left and right month control icons (when disabled)
	this.controlLeftDisabled = "";
	this.controlRightDisabled = "";
	
	// The css classes for the calendar and header
	this.calendarStyle = "cal_calendar";
	this.headerStyle = "cal_header";
	this.headerCellStyle = "cal_cell";
	this.headerCellStyleLabel = "cal_labelcell";
	
	// The css classes for the rows
	this.weekStyle = "cal_week";
	this.evenWeekStyle = "cal_evenweek";
	this.oddWeekStyle = "cal_oddweek";
	
	// The css classes for the day elements
	this.dayStyle = "cal_day";
	this.disabledDayStyle = "cal_disabled";
	this.commonDayStyle = "cal_common";
	this.holidayDayStyle = "cal_holiday";
	this.eventDayStyle = "cal_event";
	this.todayDayStyle = "cal_today";
	
	// specifies the labels for this calendar
	this.dayLabels = new Array("S", "M", "T", "W", "T", "F", "S");
	this.monthLabels = new Array(
		"January", "February", "March", "April"
		, "May", "June", "July", "August"
		, "September", "October", "November", "December");
	
	// Specifies the dates of any event. The events are to be defined as arrays,
	// with element 0 being the date and element 1 being an id.
	this.eventDates = new Array();
	//this.inc=0;
	// Attach event handlers to any fallback fields.
	if (this.viewOnly == false) {
	
		
		
		if ((this.fallback = this.fallback_both) || (this.fallback = this.fallback_single)) {
			eval("document.getElementById(\"" + this.attachedId + "\").onchange = function () {updateFromSingle("+this.name+", this);}");
		}
	} 
	selectEvent = new Function();
}

function setInit(bool,date){
	this.flag=bool;
	this.event_date=date;
	renderCalendar (cal1);
}

function updateFromSingle (sender, helper) {
	//this.event_rate=5;
	newDate = new Date (helper.value);
	newDate.setUTCDate(newDate.getUTCDate()+1);
	sender.calendarDate = newDate;
	renderCalendar (sender);
}

function updateFromMultiDay (sender, helper) {
	//this.event_rate=5;
	if (isNaN(helper.value)) {
		helper.value = sender.calendarDate.getUTCDate();
		return false;
	}
	sender.calendarDate.setUTCDate(helper.value);
	renderCalendar (sender);
}

function updateFromMultiMonth (sender, helper) {
	//this.event_rate=5;
	if (isNaN(helper.value)) {
		helper.value = sender.calendarDate.getUTCMonths() -1;
		return false;
	}
	sender.calendarDate.setUTCMonth(helper.value-1);
	renderCalendar (sender);
}

function updateFromMultiYear (sender, helper) {
	//this.event_rate=5;
	if (isNaN(helper.value)) {
		helper.value = sender.calendarDate.getUTCFullYear();
		return false;
	}
	
	sender.calendarDate.setUTCFullYear(helper.value);
	renderCalendar (sender);
}

function getFirstCalendarDate (calendar)
{
	return new Date (
		calendar.calendarDate.getUTCFullYear()
		, calendar.calendarDate.getUTCMonth()
		, 1
	);
}
function resets(name){
	document.getElementById(name).value="";
	for(i=1;i<=31;i++){
		if(document.getElementById('td_'+i)){
			document.getElementById('td_'+i).className='div_enable';
		}
	}
}
function renderCalendar (calendar,flg)
{
	calHtml1 ='<table class=\'table\' border="0" cellpadding="0" cellspacing="2" class="tbl"><tr class="tbl"><td align="right" class="tbl"><a class=\'a\' href="#" onclick="scrollMonthBack(cal1)"><<</a>&nbsp;</td><td class="tbl"><select name="'+calendar.attachedId +'_month" id="'+calendar.attachedId +'_month" class="tbl" style="border:#cccccc solid 1px;"><option value="1">January</option><option value="2">February</option><option value="3">March</option><option value="4">April</option><option value="5">May</option><option value="6">June</option><option value="7">July</option><option value="8">August</option><option value="9">September</option><option value="10">October</option><option value="11">November</option><option value="12">December</option></select></td><td class="tbl"><select name="'+ calendar.attachedId +'_year" id="'+ calendar.attachedId +'_year" class="tbl" style="border:#cccccc solid 1px;">';
	for(i=(this.event_date.getFullYear()-5);i<(this.event_date.getFullYear()+5);i++){
	calHtml1 +='<option value="'+i+'">'+i+'</option>';
	}
	calHtml1 +='</select><td align="left" class="tbl">&nbsp;<a class=\'a\' href="#" onclick="scrollMonthForward(cal1)">>></a></td></tr></table>';
	calHtml1 += ("<table class='table' id=\"cal_" + calendar.attachedId + "\" cellspacing=0\">");
	calHtml1 += ((calendar.scrolling)?buildHeader(calendar):buildStaticHeader(calendar));
	calHtml1 += buildCalendarTable (calendar);
	//calHtml1 +="<tr class=br_none><td class=br_none colspan=7><a class='a' href='javascript:resets(\"" + calendar.attachedId + "\");'>Clear</a></td></tr>";
	calHtml1 += ("</table>");
	//calHtml1 += ("<span align=right><a href='javascript:resets(\"" + calendar.attachedId + "\");'>Clear</a></span>");

	document.getElementById(calendar.div_id).innerHTML = calHtml1;
	this.txt_name=calendar.attachedId;
	eval("document.getElementById(\"" + calendar.attachedId + "_month\").onchange = function () {updateFromMultiMonth("+calendar.name+", this);}");
	eval("document.getElementById(\"" + calendar.attachedId + "_year\").onchange = function () {updateFromMultiYear("+calendar.name+", this);}");
	document.getElementById(calendar.attachedId+'_month').value=calendar.calendarDate.getUTCMonth()+1;
	document.getElementById(calendar.attachedId+'_year').value=calendar.calendarDate.getUTCFullYear();
	
	document.getElementById('td_'+new Date().getUTCDate()).className='cell_bg';
	
}

function scrollMonthBack (calendar)
{
	calendar.calendarDate.setUTCMonth(calendar.calendarDate.getUTCMonth() - 1);
	document.getElementById(calendar.attachedId+'_month').value=calendar.calendarDate.getUTCMonth()+1;
	document.getElementById(calendar.attachedId+'_year').value=calendar.calendarDate.getUTCFullYear();
	renderCalendar (calendar);
}

function selectDate (calendar, day)
{
	if (!calendar.viewOnly) {
		calendar.calendarDate.setUTCDate(day);
		setFieldValue(calendar.attachedId, calendar.calendarDate);
	}
}

function scrollMonthForward (calendar)
{
	calendar.calendarDate.setUTCMonth(calendar.calendarDate.getUTCMonth() + 1);
	document.getElementById(calendar.attachedId+'_month').value=calendar.calendarDate.getUTCMonth()+1;
	document.getElementById(calendar.attachedId+'_year').value=calendar.calendarDate.getUTCFullYear();
	renderCalendar (calendar);
}

function setFieldValue(fieldId, date) {
	resets(fieldId);
	
	document.getElementById('td_'+date.getUTCDate()).className='cell_bg';
	document.getElementById(fieldId).value =date.getUTCFullYear() + "-" + (date.getUTCMonth()+1) + "-" + date.getUTCDate();
			
	document.getElementById(fieldId + "_year").value = date.getUTCFullYear();
	document.getElementById(fieldId + "_month").selectedIndex = date.getUTCMonth();
	
	show();
	getEvents(date.getUTCFullYear() + "-" + (date.getUTCMonth()+1) + "-" + date.getUTCDate());
}
function show(){
	display=document.getElementById('cal_tester_display').style.display;
	display=display=='block'?'none':'block';
	document.getElementById('show_cal').innerHTML=document.getElementById('show_cal').innerHTML=='HIDE CALENDAR'?'SHOW CALENDAR':'HIDE CALENDAR';
	document.getElementById('cal_tester_display').style.display=display;
}
	
function buildHeader (calendar)
{
	enableLeft = true;
	enableRight = true;
	
	if (calendar.minDate != "--") 
	{
		if (calendar.calendarDate.getUTCFullYear() <= calendar.minDate.getUTCFullYear())
		{
			if (calendar.calendarDate.getUTCMonth() <= calendar.minDate.getUTCMonth())
			{
				enableLeft = false;
			}
		}
	}

	if (calendar.maxDate != "--") 
	{
		if (calendar.calendarDate.getUTCFullYear() >= calendar.maxDate.getUTCFullYear())
		{
			if (calendar.calendarDate.getUTCMonth() >= calendar.maxDate.getUTCMonth())
			{
				enableRight = false;
			}
		}
	}

	calHtml2 = "";
	
	calHtml2 +=  (
		"<tr class=\""
		+ calendar.headerStyle
		+ "\">")

	for (i = 0; i < 7; i++) {
		showDay = i + calendar.firstDayOfWeek;
		if (showDay > 6) showDay = showDay - 7;
		calHtml2 +=  (
			"<td  class=\""
			+ calendar.headerCellStyle
			+ "\">"
			+ calendar.dayLabels[showDay]
			+ "</td>");
	}

	calHtml2 += ("</tr>");
	return calHtml2
}

function buildStaticHeader (calendar)
{
	calHtml2 = "";
	
	calHtml2 +=  (
		"<tr class=\""
		+ calendar.headerStyle
		+ "\">");
	calHtml2 +=  (
		"<td colspan=\"7\" class=\""
		+ calendar.headerCellStyleLabel
		+ "\">"
		+ calendar.monthLabels[calendar.calendarDate.getUTCMonth()] 
		+ ", " + calendar.calendarDate.getUTCFullYear()
		+ "</td>");	
	calHtml2 += ("</tr>");
	
	calHtml2 +=  (
		"<tr class=\""
		+ calendar.headerStyle
		+ "\">")

	for (i = 0; i < 7; i++) {
		showDay = i + calendar.firstDayOfWeek;
		if (showDay > 6) showDay = showDay - 7;
		calHtml2 +=  (
			"<td class=\""
			+ calendar.headerCellStyle
			+ "\">"
			+ calendar.dayLabels[showDay]
			+ "</td>");
	}

	calHtml2 += ("</tr>");
	return calHtml2
}




function RenderDayDisabled (calendar, currentDate)
{
	calHtml += ('<td class="day">');
	calHtml += ("<span style='visibility:hidden' class=\"" + calendar.disabledDayStyle + "\">");
	calHtml += (currentDate.getUTCDate());
	calHtml += ("</span>");
	calHtml += ("</td>");
}
function PreviousDayDisabled (calendar, currentDate)
{
	t=currentDate.getUTCDate()==(this.event_date.getUTCDate()+1)&& this.event_date.getUTCMonth()==calendar.calendarDate.getUTCMonth()+1 && this.event_date.getUTCFullYear()==calendar.calendarDate.getUTCFullYear()?"eventdate":"day";
	s=currentDate.getUTCDate()==(this.event_date.getUTCDate()+1)&& this.event_date.getUTCMonth()==calendar.calendarDate.getUTCMonth()+1 && this.event_date.getUTCFullYear()==calendar.calendarDate.getUTCFullYear()?"eventdate":calendar.disabledDayStyle;
	calHtml += ('<td class='+ t +'>');
	calHtml += ("<div  class=\"" + s + "\">");
	calHtml += (currentDate.getUTCDate()+'</div><br/><span>&nbsp;');
	calHtml += ("</span>");
	calHtml += ("</td>");
}
function getAmount(cur_date,ev_date){
	cur_days_diff= Math.floor((ev_date.getTime()  - new Date().getTime())/(1000*60*60*24));
	days_diff=(Math.ceil(ev_date.getTime())-Math.ceil(cur_date.getTime()))/(1000*60*60*24);
	init_amt=(cur_days_diff - days_diff)+5;
	return init_amt;
}
function RenderDayEnabled (calendar, currentDate, dayStyle)
{
	currentDayStyle = dayStyle;
	
	calHtml += ("<td id='td_"+currentDate.getUTCDate()+"' class=\"div_enable\" onclick=\"selectDate(" + calendar.name + ", " + currentDate.getUTCDate() + ")\">");
	calHtml += (currentDate.getUTCDate());
	calHtml += ("</td>");
}

function RenderDayEvent (calendar, currentDate, dayStyle, eventId)
{
	currentDayStyle = dayStyle;
	calHtml += ('<td class="day">');
	calHtml += ("<span class=\"" + dayStyle + "\" onclick=\"selectDate(" + calendar.name + ", " + currentDate.getUTCDate() + "); " + calendar.name + ".selectEvent('" + eventId + "')\">");
	calHtml += (currentDate.getUTCDate());
	calHtml += ("</span>");
	calHtml += ("</td>");
}

function buildCalendarTable (calendar)
{
	currentDate = getFirstCalendarDate(calendar);
	odd = 0;
	
	while (currentDate.getUTCDay() != calendar.firstDayOfWeek)
	{
		currentDate.setUTCDate(currentDate.getUTCDate() - 1);
	}
	calHtml = "";
	do
	{
		odd += 1;

		calHtml +=  (
			"<tr class=\"tr\">")

		for (i = 0;i < 7;i++)
		{
			currentDayStyle = calendar.dayStyle;
			currentEventStyle = calendar.commonDayStyle;
			currentDateString = currentDate.getUTCFullYear() + "/" + (currentDate.getUTCMonth()+1) + "/" + currentDate.getUTCDate();
		
			if (currentDate < calendar.minDate) 
			{
				RenderDayDisabled (calendar, currentDate);
			} 
			else if (currentDate > calendar.maxDate) 
			{
				RenderDayDisabled (calendar, currentDate);
			} 
			else if (currentDate.getUTCMonth() != calendar.calendarDate.getUTCMonth())
			{
				RenderDayDisabled (calendar, currentDate);
			}
			else if (currentDate.getUTCDate() == calendar.calendarDate.getUTCDate())
			{
				if ((currentDate.getUTCDay() == 0) || (currentDate.getUTCDay() == 6))
				{
					if (calendar.allowWeekends == true)
					{
						RenderDayEnabled (calendar, currentDate, calendar.todayDayStyle);
					} 
					else 
					{
						RenderDayDisabled (calendar, currentDate);	
						month = calendar.calendarDate.getUTCMonth();
						calendar.calendarDate.setUTCDate(calendar.calendarDate.getUTCDate()+1);
						if (month != calendar.calendarDate.getUTCMonth())
						{
							renderCalendar(calendar);
						}
						
					}
				} else {
					if (calendar.allowWeekdays == true)
					{
						RenderDayEnabled (calendar, currentDate, calendar.todayDayStyle);
					} 
					else 
					{
						RenderDayDisabled (calendar, currentDate);	
						month = calendar.calendarDate.getUTCMonth();
						calendar.calendarDate.setUTCDate(calendar.calendarDate.getUTCDate()+1);
						if (month != calendar.calendarDate.getUTCMonth())
						{
							renderCalendar(calendar);
						}
						
					}
				}
			}
			else if ((currentDate.getUTCDay() == 0) || (currentDate.getUTCDay() == 6))
			{
				if (calendar.allowWeekends == true)
				{
				
					style = calendar.holidayDayStyle
					
					for (j=0; j < calendar.eventDates.length; j++)
					{
						if (calendar.eventDates[j][0] == currentDateString) 
						{
							style = calendar.eventDayStyle;
							RenderDayEvent (calendar, currentDate, style, calendar.eventDates[j][0]);
						}
					}
					
					if (style == calendar.holidayDayStyle)
					{
						RenderDayEnabled (calendar, currentDate, style);
					}
				} 
				else 
				{
					RenderDayDisabled (calendar, currentDate);	
				}
			} else {
				if (calendar.allowWeekdays == true)
				{
					style = calendar.commonDayStyle

					for (j=0; j < calendar.eventDates.length; j++)
					{
						if (calendar.eventDates[j][0] == currentDateString) 
						{
							style = calendar.eventDayStyle;
							RenderDayEvent (calendar, currentDate, style, calendar.eventDates[j][0]);
						}
					}

					if (style == calendar.commonDayStyle)
					{
						RenderDayEnabled (calendar, currentDate, style);
					}
				} 
				else 
				{
					RenderDayDisabled (calendar, currentDate);	
				}
			}

			currentDate.setUTCDate(currentDate.getUTCDate() + 1);	
		}
		
		calHtml += ("</tr>");
		

	} while (currentDate.getUTCMonth() == calendar.calendarDate.getUTCMonth());
	return calHtml;
}
