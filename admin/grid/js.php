
<script language="Javascript">
function getObj (o) {
	if(document.getElementById) return document.getElementById(o);
	if(document.all) return document.all[o];
}

scHREF = new Array();
scID   = new Array();
scType = new Array();
<?php
	$c = count ($org);
	for ($i=0; $i<=$c; $i++) {
		echo 'scHREF[' . $i ."] = '";
		if ($org[$i]['href'] != '') {
			echo AT_PACKAGE_URL_BASE.$pkg.'/'.$org[$i]['href'];
		}
		echo "';\n"
		. 'scID[' . $i ."] = '" . $org[$i]['id'] . "';\n"
		. 'scType[' . $i ."] = '" . $org[$i]['type'] . "';\n"
		;
	}
?>

var scoidx      = 0;
var nextscoidx  = 0;
var autonext    = null;
var scowindow   = null;
var isRunning   = false;
var isLaunching = false;
var invalidInit = false;
var initstat    = '';
var scoWidth  = screen.availWidth;
var scoHeight = screen.availHeight;
var auto_advance = <?php echo ($prefs['auto_advance'] == 1 ?'true':'false'); ?>;
var show_comm = <?php echo ($prefs['show_rte_communication'] == 1?'true':'false'); ?>;

//function LMSInitialize(s) {
//	isRunning   = true;
//	isLaunching = false;
//	scoidx     = nextscoidx;
//	nextscoidx = null;
//	autonext   = null;
//	var o = getObj('im'+scoidx);
//	if (document.getElementById('im'+scoidx)) {
//		o.src = '<?php echo $im;?>busy.png';
//		o.alt   = 'scorm_sco_is_running';
//		o.title = 'scorm_sco_is_running';
//		rv = window.document.RTE.LMSInitialize(s);
//		initstat = window.document.RTE.ATutorGetValue('cmi.core.lesson_status');
//	} else {
//		rv = window.document.RTE.LMSInitialize(s);
//	}
//	invalidInit = (s == '2') ? true : false;
//return rv;
//}

function LMSInitialize (s) {
	rv = window.document.RTE.LMSInitialize (s);
	if (rv != 'true') return rv;

	isRunning   = true;
	isLaunching = false;

	scoidx     = nextscoidx;
	nextscoidx = null;
	autonext   = null;

	var o = getObj ('im'+scoidx);
	o.src = '<?php echo $im;?>busy.png';
	o.alt   = 'scorm_sco_is_running';
	o.title = 'scorm_sco_is_running';
	initstat = window.document.RTE.ATutorGetValue (
		'cmi.core.lesson_status'
	);
	return rv;
}

function LMSFinish(s) {
	checkResize();
	var stat = window.document.RTE.ATutorGetValue ('cmi.core.lesson_status');

	if (stat != '' && scoidx) {
		var o = getObj('im'+scoidx);
		o.alt = stat;
		o.title = stat;
		if (stat == 'not attempted') stat = 'not-attempted';
		o.src = '<?php echo $im;?>'+stat+'.png';
		if (!autonext && auto_advance && !initstat.equals(stat)) {
			if (stat == 'completed' ||
			    stat == 'passed'    ||
			    stat == 'browsed') {
				for (i=scoidx+1; i<scHREF.length; i++) {
					if (scHREF[i].length) {
						autonext = i;
						checkResize();
						break;
					}
				}
			}
		}
	}

	rv = window.document.RTE.LMSFinish(s);
	if (rv == 'true') {
		scowindow.close();
		scowindow = null;
		isRunning = false;
		scoidx    = null;
		if (autonext) setTimeout ('Launch (autonext)', 500);
	}
	/*
	if(stat == 'completed' ||
		stat == 'passed'   ||
		stat == 'browsed') {
		window.location.reload();
	} */
	return rv;
}

function LMSSetValue (l, r) {
	//alert(l+': '+r);
	return window.document.RTE.LMSSetValue (l, r);
}

function LMSGetValue (l) {
	return window.document.RTE.LMSGetValue (l);
}

function LMSGetLastError () {
	var last_error;
	last_error = window.document.RTE.LMSGetLastError();
	if(last_error == '301' && invalidInit) {
	return '201'; 
	} else {
	return last_error;
	}
}

function LMSGetErrorString (s) {
	return window.document.RTE.LMSGetErrorString (s);
}

function LMSGetDiagnostic (s) {
	return window.document.RTE.LMSGetDiagnostic (s);
}

function LMSCommit (s) {
	return window.document.RTE.LMSCommit (s);
}

function Launch (i) {
	if (autonext && autonext != i) return;
	nextscoidx = null; 
	if (i == scoidx) return;

	if (scowindow && scowindow.closed) {
		isLaunching = false;
		isRunning   = false;
		scowindow   = null;
		if (isRunning) {
			window.document.RTE.ATutorReset(scID[scoidx]);
			isRunning = false;
		}
	}

	if (isLaunching) return;

	if (scowindow != null) {
	       if (!isRunning) return;
	       scowindow.close();
	}

	isLaunching = true;
	if (scType[i] == 'sco') {
		try {
			window.document.RTE.ATutorPrepare(scID[i]);
		} catch (Exception) {
			alert ('Please update to the latest version of Java Runtime Enviornment.');
			return;
		}
		checkResize();
		nextscoidx = i;
	} else {
		nextscoidx = null;
	}

	isLaunching = true;
	scowindow = window.open (
		scHREF[i],
		'Scorm',
		'width='+scoWidth+',height='+scoHeight+','+
		'toolbar=no,menubar=no,status=no,scrollbars=yes'
	);
	if (scType[i] == 'sco') {
		this.API = this;
		if (scowindow) scowindow.API = this;
	}
	scowindow.focus();
}

function cleanup () {
	if (scowindow) scowindow.close();
}

function checkResize () {
	try {
		w = scowindow.innerWidth;
		h = scowindow.innerHeight;
		if (w >= 640 && h >= 480) {
			scoWidth  = w; 
			scoHeight = h;
		}
	} catch (Exception) {};
}

this.onunload=cleanup;
</script>
<?php
	$p = "\n".'<div id="scorm_1_2_toc" style="display:block">'."\n";
	for ($i=$c-1; $i>=0; $i--) {
		$p .= $tree[$i] . '<br />'."\n";
	}
	$p .= '</div>' . "\n";
	echo utf8_decode($p); 
?>