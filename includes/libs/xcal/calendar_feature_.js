this.flag_Feature=true;
this.event_rate=5;
this.inc=5;
this.idx=0;
this.temp_feature=new Array();
this.feature_eventdate=new Date(2007,8,15);
this.txt_name='';
this.obj_feature='';
function CalendarFeature(cname, id, date,divid,price)
{
	// Used to notify the calendarfeature that it is attached to a single html field.
	this.fallback_single = 0;
	
	//calendarfeature Div tag id
	this.div_id=divid;
	
	// Used to notify the claendar that it is attached to 3 html fields.
	this.fallback_multi = 1;

	// Used to notify the calendarfeature that it is attached to both field sets.
	this.fallback_both = 2;
	
	//price
	this.feature_price=price;

	// Read-only calendarfeature
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
	
	// The id of this calendarfeature
	this.name = cname;
	
	// The first day of the week in the calendarfeature (0-Sunday, 6-Saturday)
	this.firstDayOfWeek = 0;
	
	// Fallback method
	this.fallback = this.fallback_both;
	
	// Sets the date and strips out time information
	this.calendarfeatureDate = date;
	this.calendarfeatureDate.setUTCHours(0);
	this.calendarfeatureDate.setUTCMinutes(0);
	this.calendarfeatureDate.setUTCSeconds(0);
	this.calendarfeatureDate.setUTCMilliseconds(0);
	
	// The field id that the calendarfeature is attached to.
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
	
	// The css classes for the calendarfeature and header
	this.calendarfeatureStyle = "cal_calendarfeature";
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
	
	// specifies the labels for this calendarfeature
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
			eval("document.getElementById(\"" + this.attachedId + "\").onchange = function () {updateFromSingle_feature("+this.name+", this);}");
		}
	} 
	selectEvent = new Function();
}

function setInitFeature(bool,date,days){
	this.flag_Feature=bool;
	this.feature_eventdate=date;
	this.no_of_days=days
	rendercalendarfeature (cal1_feature);
}

function updateFromSingle_feature (sender, helper) {
	//this.event_rate=5;
	newDate = new Date (helper.value);
	newDate.setUTCDate(newDate.getUTCDate()+1);
	sender.calendarfeatureDate = newDate;
	rendercalendarfeature (sender);
}

function updateFromMultiDay_Feature (sender, helper) {
	//this.event_rate=5;
	if (isNaN(helper.value)) {
		helper.value = sender.calendarfeatureDate.getUTCDate();
		return false;
	}
	sender.calendarfeatureDate.setUTCDate(helper.value);
	rendercalendarfeature (sender);
}

function updateFromMultiMonth_Feature (sender, helper) {
	//this.event_rate=5;
	if (isNaN(helper.value)) {
		helper.value = sender.calendarfeatureDate.getUTCMonths() -1;
		return false;
	}
	sender.calendarfeatureDate.setUTCMonth(helper.value-1);
	rendercalendarfeature (sender);
}

function updateFromMultiYear_Feature (sender, helper) {
	//this.event_rate=5;
	if (isNaN(helper.value)) {
		helper.value = sender.calendarfeatureDate.getUTCFullYear();
		return false;
	}
	
	sender.calendarfeatureDate.setUTCFullYear(helper.value);
	rendercalendarfeature (sender);
}

function getFirstcalendarfeatureDate (calendarfeature)
{
	return new Date (
		calendarfeature.calendarfeatureDate.getUTCFullYear()
		, calendarfeature.calendarfeatureDate.getUTCMonth()
		, 1
	);
}

function rendercalendarfeature (calendarfeature,flg)
{
	calHtml1_feature ='<table class=\'table\' border="0" cellpadding="0" cellspacing="2" class="tbl"><tr class="tbl"><td align="right" class="tbl"><a class=\'a\' href="javascript:scrollMonthBack_Feature(cal1_feature)"><<</a>&nbsp;&nbsp;&nbsp;</td><td class="tbl"><select name="'+calendarfeature.attachedId +'_month" id="'+calendarfeature.attachedId +'_month" class="tbl" style="border:#cccccc solid 1px; "><option value="1">January</option><option value="2">February</option><option value="3">March</option><option value="4">April</option><option value="5">May</option><option value="6">June</option><option value="7">July</option><option value="8">August</option><option value="9">September</option><option value="10">October</option><option value="11">November</option><option value="12">December</option></select></td><td class="tbl"><select name="'+ calendarfeature.attachedId +'_year" id="'+ calendarfeature.attachedId +'_year" class="tbl" style="width:80px; border:#cccccc solid 1px;">';
	for(i=(this.feature_eventdate.getFullYear()-5);i<(this.feature_eventdate.getFullYear()+5);i++){
	calHtml1_feature +='<option value="'+i+'">'+i+'</option>';
	}
	calHtml1_feature +='</select><td align="left" class="tbl"><a class=\'a\' href="javascript:scrollMonthForward_Feature(cal1_feature)">>></a></td></tr></table>';
	calHtml1_feature += ("<table class='table' id=\"cal_" + calendarfeature.attachedId + "\" cellspacing=0>");
	calHtml1_feature += ((calendarfeature.scrolling)?buildHeader_Feature(calendarfeature):buildStaticHeader_feature(calendarfeature));
	calHtml1_feature += buildcalendarfeatureTable (calendarfeature);
	calHtml1_feature += ("</table>");
	document.getElementById(calendarfeature.div_id).innerHTML = calHtml1_feature;
	this.txt_name=calendarfeature.attachedId;
	eval("document.getElementById(\"" + calendarfeature.attachedId + "_month\").onchange = function () {updateFromMultiMonth_Feature("+calendarfeature.name+", this);}");
	eval("document.getElementById(\"" + calendarfeature.attachedId + "_year\").onchange = function () {updateFromMultiYear_Feature("+calendarfeature.name+", this);}");
	document.getElementById(calendarfeature.attachedId+'_month').value=calendarfeature.calendarfeatureDate.getUTCMonth()+1;
	document.getElementById(calendarfeature.attachedId+'_year').value=calendarfeature.calendarfeatureDate.getUTCFullYear();
	this.obj_feature=calendarfeature;
}
function resets(name){
	document.getElementById(name).value="";
	document.getElementById(this.no_of_days).value="";
	for(i=1;i<=31;i++){
		if(document.getElementById('tdf_'+i)){
			if(document.getElementById('tdf_'+i).className == 'cell_bg')
				if(new Date().getDate()==i)
					document.getElementById('tdf_'+i).className='eventdate1';
				else
					document.getElementById('tdf_'+i).className='div_enable';
		}
	}
	this.obj_feature.calendarfeatureDate=new Date();
}
function scrollMonthBack_Feature (calendarfeature)
{
	calendarfeature.calendarfeatureDate.setUTCMonth(calendarfeature.calendarfeatureDate.getUTCMonth() - 1);
	document.getElementById(calendarfeature.attachedId+'_month').value=calendarfeature.calendarfeatureDate.getUTCMonth()+1;
	document.getElementById(calendarfeature.attachedId+'_year').value=calendarfeature.calendarfeatureDate.getUTCFullYear();
	rendercalendarfeature (calendarfeature);
}

function selectDate_Feature (calendarfeature, day,amt)
{
	if (!calendarfeature.viewOnly) {
		calendarfeature.calendarfeatureDate.setUTCDate(day);
		setFieldValue_Feature(calendarfeature.attachedId, calendarfeature.calendarfeatureDate, calendarfeature.feature_price);
	}
}

function scrollMonthForward_Feature (calendarfeature)
{
	calendarfeature.calendarfeatureDate.setUTCMonth(calendarfeature.calendarfeatureDate.getUTCMonth() + 1);
	document.getElementById(calendarfeature.attachedId+'_month').value=calendarfeature.calendarfeatureDate.getUTCMonth()+1;
	document.getElementById(calendarfeature.attachedId+'_year').value=calendarfeature.calendarfeatureDate.getUTCFullYear();
	rendercalendarfeature (calendarfeature);
}

function setFieldValue_Feature(fieldId, date,amt) {
	if(this.flag_Feature){
		document.getElementById(fieldId).value +=document.getElementById(fieldId).value==""?date.getUTCFullYear() + "-" + (date.getUTCMonth()+1) + "-" + date.getUTCDate()+"$"+amt:"|"+date.getUTCFullYear() + "-" + (date.getUTCMonth()+1) + "-" + date.getUTCDate()+"$"+amt;
		if(document.getElementById('tdf_'+date.getUTCDate()))
			document.getElementById('tdf_'+date.getUTCDate()).className='cell_bg';
	}
	else{
		if(document.getElementById('tdf_'+date.getUTCDate()).className == 'cell_bg'){
				document.getElementById('feature_total_price').value=0;
				setPremiereAmount();
		 		resets(fieldId);
				
				if(getNumDays(date,new Date())==0)
					document.getElementById('tdf_'+date.getUTCDate()).className='eventdate1';
				else
					document.getElementById('tdf_'+date.getUTCDate()).className='div_enable';
		}
		else{
			resets(fieldId);
			document.getElementById(fieldId).value = date.getUTCFullYear() + "-" + (date.getUTCMonth()+1) + "-" + date.getUTCDate();
			var num_days=getNumDays(new Date(date.getUTCFullYear(),date.getUTCMonth()+1,date.getUTCDate()-1),this.feature_eventdate);
			document.getElementById(this.no_of_days).value = num_days
			document.getElementById('feature_total_price').value = num_days * amt;
			setPremiereAmount();
			if(document.getElementById('tdf_'+date.getUTCDate()))
				document.getElementById('tdf_'+date.getUTCDate()).className='cell_bg';
			
		}
	}
			
	document.getElementById(fieldId + "_year").value = date.getUTCFullYear();
	document.getElementById(fieldId + "_month").selectedIndex = date.getUTCMonth();
}

function buildHeader_Feature (calendarfeature)
{
	enableLeft = true;
	enableRight = true;
	
	if (calendarfeature.minDate != "--") 
	{
		if (calendarfeature.calendarfeatureDate.getUTCFullYear() <= calendarfeature.minDate.getUTCFullYear())
		{
			if (calendarfeature.calendarfeatureDate.getUTCMonth() <= calendarfeature.minDate.getUTCMonth())
			{
				enableLeft = false;
			}
		}
	}

	if (calendarfeature.maxDate != "--") 
	{
		if (calendarfeature.calendarfeatureDate.getUTCFullYear() >= calendarfeature.maxDate.getUTCFullYear())
		{
			if (calendarfeature.calendarfeatureDate.getUTCMonth() >= calendarfeature.maxDate.getUTCMonth())
			{
				enableRight = false;
			}
		}
	}

	calHtml2 = "";
	
	calHtml2 +=  (
		"<tr class=\""
		+ calendarfeature.headerStyle
		+ "\">")

	for (i = 0; i < 7; i++) {
		showDay = i + calendarfeature.firstDayOfWeek;
		if (showDay > 6) showDay = showDay - 7;
		calHtml2 +=  (
			"<td  class=\""
			+ calendarfeature.headerCellStyle
			+ "\">"
			+ calendarfeature.dayLabels[showDay]
			+ "</td>");
	}

	calHtml2 += ("</tr>");
	return calHtml2
}

function buildStaticHeader_feature (calendarfeature)
{
	calHtml2 = "";
	
	calHtml2 +=  (
		"<tr class=\""
		+ calendarfeature.headerStyle
		+ "\">");
	calHtml2 +=  (
		"<td colspan=\"7\" class=\""
		+ calendarfeature.headerCellStyleLabel
		+ "\">"
		+ calendarfeature.monthLabels[calendarfeature.calendarfeatureDate.getUTCMonth()] 
		+ ", " + calendarfeature.calendarfeatureDate.getUTCFullYear()
		+ "</td>");	
	calHtml2 += ("</tr>");
	
	calHtml2 +=  (
		"<tr class=\""
		+ calendarfeature.headerStyle
		+ "\">")

	for (i = 0; i < 7; i++) {
		showDay = i + calendarfeature.firstDayOfWeek;
		if (showDay > 6) showDay = showDay - 7;
		calHtml2 +=  (
			"<td class=\""
			+ calendarfeature.headerCellStyle
			+ "\">"
			+ calendarfeature.dayLabels[showDay]
			+ "</td>");
	}

	calHtml2 += ("</tr>");
	return calHtml2
}




function RenderDayDisabled_feature (calendarfeature, currentDate_feature)
{
	calHtml += ('<td class="day">');
	calHtml += ("<span style='visibility:hidden' class=\"" + calendarfeature.disabledDayStyle + "\">");
	calHtml += (currentDate_feature.getUTCDate());
	calHtml += ("</span>");
	calHtml += ("</td>");
}
function PreviousDayDisabled_feature (calendarfeature, currentDate_feature)
{
	t=currentDate_feature.getUTCDate()==(this.feature_eventdate.getUTCDate()+1)&& this.feature_eventdate.getUTCMonth()==calendarfeature.calendarfeatureDate.getUTCMonth()+1 && this.feature_eventdate.getUTCFullYear()==calendarfeature.calendarfeatureDate.getUTCFullYear()?"eventdate":"day";
	s=currentDate_feature.getUTCDate()==(this.feature_eventdate.getUTCDate()+1)&& this.feature_eventdate.getUTCMonth()==calendarfeature.calendarfeatureDate.getUTCMonth()+1 && this.feature_eventdate.getUTCFullYear()==calendarfeature.calendarfeatureDate.getUTCFullYear()?"eventdate":calendarfeature.disabledDayStyle;
	calHtml += ('<td class='+ t +'>');
	calHtml += ("<div  class=\"" + s + "\">");
	calHtml += (currentDate_feature.getUTCDate()+'</div>');
	calHtml += ("</td>");
}
function getAmount_feature(cur_date,ev_date){
	cur_days_diff= Math.floor((ev_date.getTime()  - new Date().getTime())/(1000*60*60*24));
	days_diff=(Math.ceil(ev_date.getTime())-Math.ceil(cur_date.getTime()))/(1000*60*60*24);
	init_amt=(cur_days_diff - days_diff)+5;
	return init_amt;
}
function getNumDays(cur_date,ev_date){
	days_diff=Math.floor((Math.ceil(ev_date.getTime())-Math.ceil(cur_date.getTime()))/(1000*60*60*24));
	return days_diff;
}

function RenderDayEnabled_feature (calendarfeature, currentDate_feature, dayStyle)
{
	currentDayStyle = dayStyle;
	var cur_date=new Date(currentDate_feature.getUTCFullYear(),currentDate_feature.getUTCMonth(),currentDate_feature.getUTCDate());
	
	var evt_date=new Date(this.feature_eventdate.getUTCFullYear(),this.feature_eventdate.getUTCMonth()-1,this.feature_eventdate.getUTCDate()+1);
	
	if(cur_date<evt_date && this.flag_Feature){
		calHtml += ("<td id='tdf_"+currentDate_feature.getUTCDate()+"' class=\"div_enable\" onclick=\"selectDate_Feature(" + calendarfeature.name + ", " + currentDate_feature.getUTCDate() + ","+(getAmount_feature(currentDate_feature,evt_date))+")\">");
		calHtml += ("<div class='div'>");
		calHtml += (currentDate_feature.getUTCDate()+'</div><div class="rate">$'+(getAmount_feature(currentDate_feature,evt_date)));
		calHtml += ("</div>");
		calHtml += ("</td>");
	}
	else{
		
		if(getNumDays(cur_date,new Date())==0){
		
			calHtml += ("<td id='tdf_"+currentDate_feature.getUTCDate()+"' class=\"eventdate1\" onclick=\"selectDate_Feature(" + calendarfeature.name + ", " + currentDate_feature.getUTCDate() + ","+currentDate_feature.getUTCDate()+")\">" );
			calHtml += ("<div id='td"+currentDate_feature.getUTCDate()+"'  >");
			calHtml += (currentDate_feature.getUTCDate()+'</div>');
			calHtml += ("</span><br><span class='sz'>TODAY</span>");
			calHtml += ("</td>");
		}
		else if(cur_date<evt_date){
			calHtml += ("<td id='tdf_"+currentDate_feature.getUTCDate()+"' class=\"div_enable\" onclick=\"selectDate_Feature(" + calendarfeature.name + ", " + currentDate_feature.getUTCDate() + ","+currentDate_feature.getUTCDate()+")\">" );
			calHtml += ("<div id='td"+currentDate_feature.getUTCDate()+"'  >");
			calHtml += (currentDate_feature.getUTCDate()+'</div>');
			calHtml += ("</td>");
		}
		else{
			calHtml += ("<td id='tdf_"+currentDate_feature.getUTCDate()+"' class=\"td\" >");
			calHtml += ("<div id='td"+currentDate_feature.getUTCDate()+"'  >");
			calHtml += (currentDate_feature.getUTCDate()+'</div>');
			calHtml += ("</td>");
		}
	}
	
	
}

function RenderDayEvent_feature (calendarfeature, currentDate_feature, dayStyle, eventId)
{
	currentDayStyle = dayStyle;
	calHtml += ('<td class="day">');
	calHtml += ("<span class=\"" + dayStyle + "\" onclick=\"selectDate_Feature(" + calendarfeature.name + ", " + currentDate_feature.getUTCDate() + "); " + calendarfeature.name + ".selectEvent('" + eventId + "')\">");
	calHtml += (currentDate_feature.getUTCDate());
	calHtml += ("</span>");
	calHtml += ("</td>");
}

function buildcalendarfeatureTable (calendarfeature)
{
	currentDate_feature = getFirstcalendarfeatureDate(calendarfeature);
	odd = 0;
	
	while (currentDate_feature.getUTCDay() != calendarfeature.firstDayOfWeek)
	{
		currentDate_feature.setUTCDate(currentDate_feature.getUTCDate() - 1);
	}
	calHtml = "";
	do
	{
		odd += 1;

		calHtml +=  (
			"<tr class=\"tr\">")

		for (i = 0;i < 7;i++)
		{
			currentDayStyle = calendarfeature.dayStyle;
			currentEventStyle = calendarfeature.commonDayStyle;
			currentDate_featureString = currentDate_feature.getUTCFullYear() + "/" + (currentDate_feature.getUTCMonth()+1) + "/" + currentDate_feature.getUTCDate();
		
			if (currentDate_feature < calendarfeature.minDate) 
			{
				RenderDayDisabled_feature (calendarfeature, currentDate_feature);
			} 
			else if (currentDate_feature > calendarfeature.maxDate) 
			{
				RenderDayDisabled_feature (calendarfeature, currentDate_feature);
			} 
			else if (currentDate_feature.getUTCMonth() != calendarfeature.calendarfeatureDate.getUTCMonth())
			{
				RenderDayDisabled_feature (calendarfeature, currentDate_feature);
			}
			else if (currentDate_feature.getUTCDate() < calendarfeature.calendarfeatureDate.getUTCDate() && new Date().getUTCMonth()==calendarfeature.calendarfeatureDate.getUTCMonth() &&  new Date().getUTCFullYear()==calendarfeature.calendarfeatureDate.getUTCFullYear())
			{
				PreviousDayDisabled_feature (calendarfeature, currentDate_feature);
			}
			else if (calendarfeature.calendarfeatureDate.getUTCFullYear()<new Date().getUTCFullYear())
			{
				PreviousDayDisabled_feature (calendarfeature, currentDate_feature);
			}
			else if (calendarfeature.calendarfeatureDate.getUTCMonth()<new Date().getUTCMonth())
			{
				if( calendarfeature.calendarfeatureDate.getUTCFullYear()<=new Date().getUTCFullYear())
					PreviousDayDisabled_feature (calendarfeature, currentDate_feature);
				else
					RenderDayEnabled_feature (calendarfeature, currentDate_feature, calendarfeature.todayDayStyle);
			}
			
			else if (currentDate_feature.getUTCDate() == (this.feature_eventdate.getUTCDate()+1) && this.feature_eventdate.getUTCMonth()==calendarfeature.calendarfeatureDate.getUTCMonth()+1 && this.feature_eventdate.getUTCFullYear()==calendarfeature.calendarfeatureDate.getUTCFullYear())
			{
				PreviousDayDisabled_feature (calendarfeature, currentDate_feature);
			}
			else if (currentDate_feature.getUTCDate() == calendarfeature.calendarfeatureDate.getUTCDate())
			{
				if ((currentDate_feature.getUTCDay() == 0) || (currentDate_feature.getUTCDay() == 6))
				{
					if (calendarfeature.allowWeekends == true)
					{
						RenderDayEnabled_feature (calendarfeature, currentDate_feature, calendarfeature.todayDayStyle);
					} 
					else 
					{
						RenderDayDisabled_feature (calendarfeature, currentDate_feature);	
						month = calendarfeature.calendarfeatureDate.getUTCMonth();
						calendarfeature.calendarfeatureDate.setUTCDate(calendarfeature.calendarfeatureDate.getUTCDate()+1);
						if (month != calendarfeature.calendarfeatureDate.getUTCMonth())
						{
							rendercalendarfeature(calendarfeature);
						}
						
					}
				} else {
					if (calendarfeature.allowWeekdays == true)
					{
						RenderDayEnabled_feature (calendarfeature, currentDate_feature, calendarfeature.todayDayStyle);
					} 
					else 
					{
						RenderDayDisabled_feature (calendarfeature, currentDate_feature);	
						month = calendarfeature.calendarfeatureDate.getUTCMonth();
						calendarfeature.calendarfeatureDate.setUTCDate(calendarfeature.calendarfeatureDate.getUTCDate()+1);
						if (month != calendarfeature.calendarfeatureDate.getUTCMonth())
						{
							rendercalendarfeature(calendarfeature);
						}
						
					}
				}
			}
			else if ((currentDate_feature.getUTCDay() == 0) || (currentDate_feature.getUTCDay() == 6))
			{
				if (calendarfeature.allowWeekends == true)
				{
				
					style = calendarfeature.holidayDayStyle
					
					for (j=0; j < calendarfeature.eventDates.length; j++)
					{
						if (calendarfeature.eventDates[j][0] == currentDate_featureString) 
						{
							style = calendarfeature.eventDayStyle;
							RenderDayEvent_feature (calendarfeature, currentDate_feature, style, calendarfeature.eventDates[j][0]);
						}
					}
					
					if (style == calendarfeature.holidayDayStyle)
					{
						RenderDayEnabled_feature (calendarfeature, currentDate_feature, style);
					}
				} 
				else 
				{
					RenderDayDisabled_feature (calendarfeature, currentDate_feature);	
				}


			} else {
				if (calendarfeature.allowWeekdays == true)
				{
					style = calendarfeature.commonDayStyle

					for (j=0; j < calendarfeature.eventDates.length; j++)
					{
						if (calendarfeature.eventDates[j][0] == currentDate_featureString) 
						{
							style = calendarfeature.eventDayStyle;
							RenderDayEvent_feature (calendarfeature, currentDate_feature, style, calendarfeature.eventDates[j][0]);
						}
					}

					if (style == calendarfeature.commonDayStyle)
					{
						RenderDayEnabled_feature (calendarfeature, currentDate_feature, style);
					}
				} 
				else 
				{
					RenderDayDisabled_feature (calendarfeature, currentDate_feature);	
				}
			}

			currentDate_feature.setUTCDate(currentDate_feature.getUTCDate() + 1);	
		}
		
		calHtml += ("</tr>");
		

	} while (currentDate_feature.getUTCMonth() == calendarfeature.calendarfeatureDate.getUTCMonth());
	return calHtml;
}
