
this.flag=true;
this.event_rate=5;
this.inc=5;
this.idx=0;
this.temp=new Array();
this.event_date=new Date(2007,8,15);
this.txt_name='';
this.obj='';
this.price=0;
this.is_available='';
var str_date=document.getElementById('filled_date').value;
//alert(str_date);
this.reserved_date = str_date.split("|");
//alert(this.reserved_date);
function Calendar (cname, id, date,divid,price)
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
	
	this.price=price;
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
	this.dayLabels = new Array("Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat");
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

function renderCalendar (calendar,flg)
{
	calHtml1 ='<table class=\'table\' border="0" cellpadding="0" cellspacing="2" class="tbl"><tr class="tbl"><td align="right" class="tbl"><a class=\'a\' href="#" onclick="scrollMonthBack(cal1)"><<</a>&nbsp;&nbsp;&nbsp;</td><td class="tbl"><select name="'+calendar.attachedId +'_month" id="'+calendar.attachedId +'_month" class="tbl" style="border:#cccccc solid 1px; "><option value="1">January</option><option value="2">February</option><option value="3">March</option><option value="4">April</option><option value="5">May</option><option value="6">June</option><option value="7">July</option><option value="8">August</option><option value="9">September</option><option value="10">October</option><option value="11">November</option><option value="12">December</option></select></td><td class="tbl"><select name="'+ calendar.attachedId +'_year" id="'+ calendar.attachedId +'_year" class="tbl" style="width:80px; border:#cccccc solid 1px;">';
	for(i=(this.event_date.getFullYear()-5);i<(this.event_date.getFullYear()+5);i++){
	calHtml1 +='<option value="'+i+'">'+i+'</option>';
	}
	calHtml1 +='</select><td align="left" class="tbl"><a class=\'a\' href="#" onclick="scrollMonthForward(cal1)">>></a></td></tr></table>';
	calHtml1 += ("<table class='table' id=\"cal_" + calendar.attachedId + "\" cellspacing=0\">");
	calHtml1 += ((calendar.scrolling)?buildHeader(calendar):buildStaticHeader(calendar));
	calHtml1 += buildCalendarTable (calendar);
	

	document.getElementById(calendar.div_id).innerHTML = calHtml1;
	this.txt_name=calendar.attachedId;
	if (calendar.viewOnly == false) {
		eval("document.getElementById(\"" + calendar.attachedId + "_month\").onchange = function () {updateFromMultiMonth("+calendar.name+", this);}");
		eval("document.getElementById(\"" + calendar.attachedId + "_year\").onchange = function () {updateFromMultiYear("+calendar.name+", this);}");
	}
	document.getElementById(calendar.attachedId+'_month').value=calendar.calendarDate.getUTCMonth()+1;
	document.getElementById(calendar.attachedId+'_year').value=calendar.calendarDate.getUTCFullYear();
	this.obj=calendar;
}
function resets_promotion(name){
	document.getElementById(name).value="";
	for(i=1;i<=31;i++){
		if(document.getElementById('td_'+i)){
			if(this.event_date.getUTCDate()+1==i)
				document.getElementById('td_'+i).className='eventdate1';
			else if(document.getElementById('td_'+i).className=='cell_bg'){
				if(i==new Date().getDate())
					document.getElementById('td_'+i).className='eventdate1';
				else
					document.getElementById('td_'+i).className='div_enable';
			}
		}
	}
}

function scrollMonthBack (calendar)
{
	calendar.calendarDate.setUTCMonth(calendar.calendarDate.getUTCMonth() - 1);
	document.getElementById(calendar.attachedId+'_month').value=calendar.calendarDate.getUTCMonth()+1;
	document.getElementById(calendar.attachedId+'_year').value=calendar.calendarDate.getUTCFullYear();
	renderCalendar (calendar);
	
}

function selectDate (calendar, day,amt)
{
	if (!calendar.viewOnly) {
		calendar.calendarDate.setUTCDate(day);
		setFieldValue(calendar.attachedId, calendar.calendarDate, amt,calendar.price);
	}
	calendar.calendarDate = new Date();
}

function scrollMonthForward (calendar)
{
	calendar.calendarDate.setUTCMonth(calendar.calendarDate.getUTCMonth() + 1);
	document.getElementById(calendar.attachedId+'_month').value=calendar.calendarDate.getUTCMonth()+1;
	document.getElementById(calendar.attachedId+'_year').value=calendar.calendarDate.getUTCFullYear();
	renderCalendar (calendar);
	
}

function setFieldValue(fieldId, date,amt,price) {
		
	if(this.flag){
		if(document.getElementById('td_'+date.getUTCDate()).className == 'cell_bg'){
			
			in_val=document.getElementById(fieldId).value;
			str=new String(in_val);
			
			string="|"+date.getUTCFullYear() + "-" + (date.getUTCMonth()+1) + "-" + date.getUTCDate()+"$"+amt;
										
			document.getElementById(fieldId).value = in_val.replace(string,"");
			in_val = document.getElementById(fieldId).value;
			str1 = new String(in_val);
			if(str.length == str1.length)
				document.getElementById(fieldId).value = in_val.replace(date.getUTCFullYear() + "-" + (date.getUTCMonth()+1) + "-" + date.getUTCDate()+"$"+amt,"");
			
			document.getElementById('premiere_total_price').value=(eval(document.getElementById('premiere_total_price').value)-amt);
			setPremiereAmount();
			if(amt==price)
				document.getElementById('td_'+date.getUTCDate()).className='eventdate1';
			else if(this.event_date.getUTCDate()+1==date.getUTCDate())
				document.getElementById('td_'+date.getUTCDate()).className='eventdate1';
			else 
				document.getElementById('td_'+date.getUTCDate()).className='div_enable';
		}
		else{
			document.getElementById(fieldId).value +=document.getElementById(fieldId).value==""?date.getUTCFullYear() + "-" + (date.getUTCMonth()+1) + "-" + date.getUTCDate()+"$"+amt:"|"+date.getUTCFullYear() + "-" + (date.getUTCMonth()+1) + "-" + date.getUTCDate()+"$"+amt;
			document.getElementById('td_'+date.getUTCDate()).className='cell_bg';
			document.getElementById('premiere_total_price').value=document.getElementById('premiere_total_price').value!=""?(eval(document.getElementById('premiere_total_price').value)+amt):amt;
			setPremiereAmount();
		}
	}
	else
		document.getElementById(fieldId).value =date.getUTCFullYear() + "/" + (date.getUTCMonth()+1) + "/" + date.getUTCDate();
			
	document.getElementById(fieldId + "_year").value = date.getUTCFullYear();
	document.getElementById(fieldId + "_month").selectedIndex = date.getUTCMonth();
	
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
		"<td colspan=\"7\" >"
		+ calendar.monthLabels[calendar.calendarDate.getUTCMonth()] 
		+ ", " + calendar.calendarDate.getUTCFullYear()
		+ "</td>");	
	calHtml2 += ("</tr>");
	
	calHtml2 +=  (
		"<tr >")

	for (i = 0; i < 7; i++) {
		showDay = i + calendar.firstDayOfWeek;
		if (showDay > 6) showDay = showDay - 7;
		calHtml2 +=  (
			"<td >"
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
	var cur_date=new Date(currentDate.getUTCFullYear(),currentDate.getUTCMonth(),currentDate.getUTCDate());
	var evt_date=new Date(this.event_date.getUTCFullYear(),this.event_date.getUTCMonth()-1,this.event_date.getUTCDate()+1);
	
	var evt_date=new Date(this.event_date.getUTCFullYear(),this.event_date.getUTCMonth()-1,this.event_date.getUTCDate()+1);
	str=currentDate.getUTCDate()==(this.event_date.getUTCDate()+1)&& this.event_date.getUTCMonth()==calendar.calendarDate.getUTCMonth()+1 && this.event_date.getUTCFullYear()==calendar.calendarDate.getUTCFullYear()?'$'+getAmount(currentDate,evt_date,calendar):'';
	t=currentDate.getUTCDate()==(this.event_date.getUTCDate()+1)&& this.event_date.getUTCMonth()==calendar.calendarDate.getUTCMonth()+1 && this.event_date.getUTCFullYear()==calendar.calendarDate.getUTCFullYear()?"'eventdate' title='Event end date'":"day";
	s=currentDate.getUTCDate()==(this.event_date.getUTCDate()+1)&& this.event_date.getUTCMonth()==calendar.calendarDate.getUTCMonth()+1 && this.event_date.getUTCFullYear()==calendar.calendarDate.getUTCFullYear()?"eventdate":calendar.disabledDayStyle;
	
	if(t!='day'){
		//var sel_date=setSelectedField(calendar.attachedId,currentDate);
		//var class=sel_date?"cell_bg":"eventdate1";
		calHtml += ("<td id='td_"+currentDate.getUTCDate()+"' class=\"eventdate1\" title=' Event end date ' onclick=\"selectDate(" + calendar.name + ", " + currentDate.getUTCDate() + ","+(getAmount(currentDate,evt_date,calendar))+")\">");
		calHtml += ("<div class='div'>");
		calHtml += (currentDate.getUTCDate()+'</div><div class="rate1">$'+(getAmount(currentDate,evt_date,calendar)));
		calHtml += ("</div>");
		calHtml += ("</td>");
	}
	else{
		calHtml += ('<td class='+ t +'>');
		calHtml += ("<div  class=\"div\">");
		calHtml += (currentDate.getUTCDate()+'</div><span class="rate1">'+str);
		calHtml += ("</span>");
		calHtml += ("</td>");
	}

}
function getAmount(cur_date,ev_date,calendar){
	cur_days_diff= Math.floor((ev_date.getTime()  - new Date().getTime())/(1000*60*60*24));
	days_diff=(Math.ceil(ev_date.getTime())-Math.ceil(cur_date.getTime()))/(1000*60*60*24);
	init_amt=(cur_days_diff - days_diff)+calendar.price;
	return init_amt;
}
function RenderDayEnabled (calendar, currentDate, dayStyle)
{
	
	currentDayStyle = dayStyle;
	var cur_date=new Date(currentDate.getUTCFullYear(),currentDate.getUTCMonth(),currentDate.getUTCDate());
	var evt_date=new Date(this.event_date.getUTCFullYear(),this.event_date.getUTCMonth()-1,this.event_date.getUTCDate()+1);
	var class="";
	//var sel_date=setSelectedField(calendar.attachedId,currentDate);
	
	if(getAmount(currentDate,evt_date,calendar)==calendar.price){
		//class=sel_date?"cell_bg":"eventdate1";
		calHtml += ("<td id='td_"+currentDate.getUTCDate()+"' class=\"eventdate1\" title=' TODAY ' onclick=\"selectDate(" + calendar.name + ", " + currentDate.getUTCDate() + ","+(getAmount(currentDate,evt_date,calendar))+")\">");
		calHtml += ("<div class='div'>");
		calHtml += (currentDate.getUTCDate()+'</div><span class="rate1">$'+(getAmount(currentDate,evt_date,calendar)));
		calHtml += ("</span><br><span class='sz'>TODAY</span>");
		calHtml += ("</td>");
	}
	else if(cur_date<evt_date && this.flag){
		class=sel_date?"cell_bg":"div_enable";
		calHtml += ("<td id='td_"+currentDate.getUTCDate()+"' class=\""+class+"\" onclick=\"selectDate(" + calendar.name + ", " + currentDate.getUTCDate() + ","+(getAmount(currentDate,evt_date,calendar))+")\">");
		calHtml += ("<div class='div'>");
		calHtml += (currentDate.getUTCDate()+'</div><div class="rate">$'+(getAmount(currentDate,evt_date,calendar)));
		calHtml += ("</div>");
		calHtml += ("</td>");
	}
	else{
		calHtml += ('<td class=\"td\">');
		calHtml += ("<div id='td"+currentDate.getUTCDate()+"'>");
		calHtml += (currentDate.getUTCDate()+'</div>');
		calHtml += ("</td>");
	}
	
}
function RenderDayReserved (calendar, currentDate)
{
	var cur_date=new Date(currentDate.getUTCFullYear(),currentDate.getUTCMonth(),currentDate.getUTCDate());
	var evt_date=new Date(this.event_date.getUTCFullYear(),this.event_date.getUTCMonth()-1,this.event_date.getUTCDate()+1);
	
		calHtml += ("<td id='td_"+currentDate.getUTCDate()+"' class=\"div_enable resered\" title='Reserved date'>");
		calHtml += ("<div class='div'>");
		calHtml += (currentDate.getUTCDate()+'</div><span>FULL</span>');
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
	reserve=false;
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
			currentDateString1 = currentDate.getUTCFullYear() + "-" + (currentDate.getUTCMonth()+1) + "-" + currentDate.getUTCDate();
			for(j=0;j<this.reserved_date.length;j++){
				
				var arr_obj=this.reserved_date[j].split("-");
				var reserved_date_string=eval(arr_obj[0])+"-"+eval(arr_obj[1])+"-"+eval(arr_obj[2]);
				if(reserved_date_string==currentDateString1){
					reserve=true;
					break;
				}
				else
					reserve=false;
			}
				
			if (currentDate < calendar.minDate) 
			{
				RenderDayDisabled (calendar, currentDate);
			} 
			else if (currentDate > calendar.maxDate) 
			{
				RenderDayDisabled (calendar, currentDate);
			}
			else if (reserve) 
			{
				RenderDayReserved(calendar, currentDate);
			}
			else if (currentDate.getUTCMonth() != calendar.calendarDate.getUTCMonth())
			{
				RenderDayDisabled (calendar, currentDate);
			}
			else if (currentDate.getUTCDate() < calendar.calendarDate.getUTCDate() && new Date().getUTCMonth()==calendar.calendarDate.getUTCMonth() &&  new Date().getUTCFullYear()==calendar.calendarDate.getUTCFullYear())
			{
				PreviousDayDisabled (calendar, currentDate);
			}
			else if (calendar.calendarDate.getUTCFullYear()<new Date().getUTCFullYear())
			{
				PreviousDayDisabled (calendar, currentDate);
			}
			else if (calendar.calendarDate.getUTCMonth()<new Date().getUTCMonth())
			{
				if( calendar.calendarDate.getUTCFullYear()<=new Date().getUTCFullYear())
					PreviousDayDisabled (calendar, currentDate);
				else
					RenderDayEnabled (calendar, currentDate, calendar.todayDayStyle);
			}
			
			else if (currentDate.getUTCDate() == (this.event_date.getUTCDate()+1) && this.event_date.getUTCMonth()==calendar.calendarDate.getUTCMonth()+1 && this.event_date.getUTCFullYear()==calendar.calendarDate.getUTCFullYear())
			{
				PreviousDayDisabled (calendar, currentDate);
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

/*function setSelectedField(id,date){
	
	var str_sel=document.getElementById(id).value;
	var arr=str_sel.split("|");
	var Field_flg=0;
	var arr_1= new Array();
	var arr_2= new Array();
	if(str_sel!=""){
		for(ii=0;ii<arr.length;ii++){
			arr_1=arr[ii].split("$");
			arr_2=arr_1[0].split("-");
			if(arr_2.length>1){
				if(eval(arr_2[0])==date.getUTCFullYear() && eval(arr_2[1]-1) == date.getUTCMonth() && eval(arr_2[2]) == date.getUTCDate()){
					Field_flg =1;
					break;
				}
				else
					Field_flg =0;
				
			}
		}
	}
	return Field_flg;
}
*/

// set values premiere and feature events
function setPremiereAmount(){
	var premire_amt = document.getElementById('premiere_total_price');
	var obj_tot = document.getElementById('total_price_hidden');
	var bold_amt = document.getElementById('bold_price_hidden');
	var border_amt = document.getElementById('border_price_hidden');
	var highlight_amt = document.getElementById('highlight_price_hidden');
	var subtext_amt = document.getElementById('subtext_price_hidden');
	var feature_amt = document.getElementById('feature_total_price');
	var tot_price=0;
	tot_price+=premire_amt.value==""?0:eval(premire_amt.value);
	tot_price+=bold_amt.value==""?0:eval(bold_amt.value);
	tot_price+=border_amt.value==""?0:eval(border_amt.value);
	tot_price+=highlight_amt.value==""?0:eval(highlight_amt.value);
	tot_price+=subtext_amt.value==""?0:eval(subtext_amt.value);
	tot_price+=feature_amt.value==""?0:eval(feature_amt.value);
	
	obj_tot.value= tot_price;
	
	display_premiere=eval(premire_amt.value)==0 || premire_amt.value==""?"none":"block";
	display_feature=eval(feature_amt.value)==0 || feature_amt.value==""?"none":"block";
	display_tot=eval(obj_tot.value)==0 || obj_tot.value==""?"none":"block";
	
	document.getElementById('premiere_price').style.display=display_premiere;
	document.getElementById('feature_price').style.display=display_feature;
	document.getElementById('total').style.display=display_tot;
	document.getElementById('premiere').innerHTML=premire_amt.value;
	document.getElementById('feature_sp').innerHTML=feature_amt.value;
	document.getElementById('total_price').innerHTML=obj_tot.value;
}
