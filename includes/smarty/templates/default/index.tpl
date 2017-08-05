<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>.:People U:.</title>
<link rel="shortcut icon" href="images/favicon.ico" />
<link href="styles/style.css" type="text/css" rel="stylesheet" />
<link href="styles/scroll-rel.css" type="text/css" rel="stylesheet" />
<!-- Include the .JS for the scroller from respective folder -->
<script src="js/dw_scrollObj.js" type="text/javascript"></script>
<script src="js/dw_hoverscroll.js" type="text/javascript"></script>
<script src="js/dw_event.js" type="text/javascript"></script>
<script src="js/dw_slidebar.js" type="text/javascript"></script>
<script src="js/dw_scroll_aux.js" type="text/javascript"></script>
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/scripts.js" type="text/javascript"></script>

<!-- Call this function on Body tag -->
<script src="scripts/AC_RunActiveContent.js" type="text/javascript"></script>

{literal}
<script type="text/javascript">
		function initScrollLayer() {
		  // arguments: id of layer containing scrolling layers (clipped layer), id of layer to scroll, if horizontal scrolling, id of element containing scrolling content (table?)
		  var wndo = new dw_scrollObj('wn', 'lyr1');
		  
		  // bSizeDragBar set true by default (explained at www.dyn-web.com/dhtml/scroll/ ) wndo.bSizeDragBar = false;
		  
		  // arguments: dragBar id, track id, axis ("v" or "h"), x offset, y offset (x/y offsets of dragBar in track)
		  wndo.setUpScrollbar("dragBar", "track", "v", 1, 1);
		  
		  // pass id('s) of scroll area(s) if inside table(s) i.e., if you have 3 (with id's wn1, wn2, wn3): dw_scrollObj.GeckoTableBugFix('wn1', 'wn2', 'wn3');
		  dw_scrollObj.GeckoTableBugFix('wn'); 
		}
</script>
{/literal}
</head>
<body {if $content neq "news.tpl" && $content neq "contact.tpl"}onload="initScrollLayer();"{/if} >
	<table border="0" cellpadding="0" cellspacing="0" width="997px" align="center"  bgcolor="#242424">
		<tr><!--Navigation part-->
			<td colspan="2">
				<table border="0" cellpadding="0" cellspacing="0" id="menu_bg">
					<tr>
						<td><img src="images/logo.jpg"  alt="PeopleU"/></td>
						<td width="50px"><img src="images/spacer.gif" alt="Spacer" /></td>
						<td valign="top">
							<table border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td class="{if $smarty.session.content eq 'main.tpl' || !$smarty.session.content}menu_img{/if} menu" id="main_td"><a href="javascript:object.getData('main','&amp;flag=1');" class="menu" onclick="object.setClass(document.getElementById('main_td'));">Home</a></td>
									<td width="30px"><img src="images/spacer.gif" alt="Spacer" /></td>
									
									<td class="{if $smarty.session.content eq 'services.tpl'}menu_img{/if} menu" id="services_td"><a href="javascript:object.getData('services','&amp;flag=1');" onclick="object.setClass(document.getElementById('services_td'));" class="menu">Services</a></td>
									<td width="30px"><img src="images/spacer.gif" alt="Spacer" /></td>
									<td class="{if $smarty.session.content eq 'global.tpl'}menu_img{/if} menu" id="global_td"><a href="javascript:object.getData('global','&amp;flag=1');" onclick="object.setClass(document.getElementById('global_td'));" class="menu">Global Sourcing</a></td>
									<td width="30px"><img src="images/spacer.gif" alt="Spacer"/></td>
									<td class="{if $smarty.session.content eq 'news.tpl'}menu_img{/if} menu" id="news_td"><a href="javascript:object.getData('news','&amp;flag=1');" class="menu" onclick="object.setClass(document.getElementById('news_td'));">News</a></td>
									<td width="30px"><img src="images/spacer.gif" alt="Spacer"/></td>
                                    <td class="{if $smarty.session.content eq 'aboutus.tpl'}menu_img{/if} menu" id="about_td"><a href="javascript:object.getData('aboutus','&amp;flag=1');" class="menu" onclick="object.setClass(document.getElementById('about_td'));">About us</a></td>
									<td width="30px"><img src="images/spacer.gif" alt="Spacer"/></td>
									<td class="{if $smarty.session.content eq 'contact.tpl'}menu_img{/if} menu" id="cotact_td"><a href="javascript:object.getData('contact','&amp;flag=1');" class="menu" onclick="object.setClass(document.getElementById('cotact_td'));">Contact us</a></td>
								</tr>
							</table>						</td>
					</tr>
				</table>			</td>
		</tr>
		<tr><td colspan="2" align="center" style="padding-left:2px;"><!--<img src="images/inner_banner.jpg" />-->
        {literal}
		 <script type="text/javascript">
	if (AC_FL_RunContent == 0) {
		alert("This page requires AC_RunActiveContent.js.");
	} else {
		AC_FL_RunContent(
			'codebase', 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0',
			'width', '960',
			'height', '220',
			'src', 'mainBanner',
			'quality', 'high',
			'pluginspage', 'http://www.macromedia.com/go/getflashplayer',
			'align', 'middle',
			'play', 'true',
			'loop', 'true',
			'scale', 'showall',
			'wmode', 'window',
			'devicefont', 'false',
			'id', 'mainBanner',
			'bgcolor', '#242424',
			'name', 'mainBanner',
			'menu', 'false',
			'allowFullScreen', 'false',
			'allowScriptAccess','sameDomain',
			'movie', 'images/mainBanner',
			'salign', ''
			); //end AC code
	}
</script>
<noscript>
	<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="960" height="220" id="mainBanner" align="middle">
	<param name="allowScriptAccess" value="sameDomain" />
	<param name="allowFullScreen" value="false" />
    <param name="menu" value="false" />
	<param name="movie" value="mainBanner.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#242424" />	<!--<embed src="images/mainBanner.swf"   ></embed>-->
	</object>
</noscript>
<!--quality="high" menu="false" bgcolor="#000000" width="997" height="220" name="mainBanner" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"-->
{/literal}

</td></tr><!--banner part-->
		<tr><!--content part-->
			<td colspan="2" id="cont_pos"><table border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td>
							<table border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td valign="top"><img src="images/top_left_curve.jpg" alt="Top left curve"/></td>
									<td class="bg_image" ></td>
									<td  valign="top"><img src="images/top_right_curve.jpg" alt="Top right curve"/></td>
								</tr>
							</table>						</td>
					</tr>
					<tr>
						<td bgcolor="#353535">
							<div id="main_content">{include file="default/$content"}</div>						
                        </td>
					</tr>
					<tr>
						<td valign="top">
							<table border="0" cellpadding="0" cellspacing="0" align="center">
								<tr>
									<td valign="top"><img src="images/bottom_left_curve.jpg" alt="Bottom left curve"/></td>
									<td class="bg_image"></td>
									<td  valign="top"><img src="images/bottom_right_curve.jpg" alt="Bottom right curve"/></td>
								</tr>
							</table>						</td>
					</tr>
					
				</table>			</td>
		</tr>
		<tr><td height="10px" colspan="2"><img src="images/spacer.gif" alt="Spacer"/></td></tr>
		<tr>
			<td class="footer" id="footer_pos">copyright &copy; 2008.All rights reserved.</td>
		    <td class="footer" align="right"><div align="right" style="padding-right:15px;"><a href="http://validator.w3.org/check?uri=referer"><img
        src="http://www.w3.org/Icons/valid-xhtml10"
        alt="Valid XHTML 1.0 Transitional" height="31" width="88" /></a>

<a href="http://validator.w3.org/check?uri=referer"><img
        src="http://www.w3.org/Icons/valid-xhtml10-blue"
        alt="Valid XHTML 1.0 Transitional" height="31" width="88" /></a>
        <a href="http://jigsaw.w3.org/css-validator/">
        <img style="border:0;width:88px;height:31px"
            src="http://jigsaw.w3.org/css-validator/images/vcss"
            alt="Valid CSS!" />
    </a>
    <a href="http://jigsaw.w3.org/css-validator/">
    <img style="border:0;width:88px;height:31px"
        src="http://jigsaw.w3.org/css-validator/images/vcss-blue"
        alt="Valid CSS!" />
</a>
        </div>
        </td>
		</tr>
		<tr><td height="10px" colspan="2"><img src="images/spacer.gif" alt="Spacer"/></td></tr>
	</table>
</body>
</html>
