<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/auth/auth.php') ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="iso-8859-2">
<title>Image Roller</title>
<script type='text/javascript' src='https://ssl-webplayer.unity3d.com/download_webplayer-3.x/3.0/uo/jquery.min.js'></script>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="ajaxfileupload.js"></script>
<script type="text/javascript">
<!--
var unityObjectUrl = "http://webplayer.unity3d.com/download_webplayer-3.x/3.0/uo/UnityObject2.js";
if (document.location.protocol == 'https:')
unityObjectUrl = unityObjectUrl.replace("http://", "https://ssl-");
document.write('<script type="text\/javascript" src="' + unityObjectUrl + '"><\/script>');
-->
</script>
<script type="text/javascript">
<!--
var bottomStripHeight = 70;			
var myWidth = 0, myHeight = 0, borderSize = 0;

var config = 
{
	width: "100%", 
	height: "100%",
	params: {enableDebugging:"0",disableContextMenu: true}
};

var selectedPlayer = "ImageRoller";
/*getPlayerFromUrl();
function getPlayerFromUrl()
{
	//load the URL into a variable
	var url = window.location.href;
	var pn = url.indexOf("?");
	
	
	if(pn==-1)
	{
		return;
	}
	else
	{
		selectedPlayer = url.substring(pn + 1);
		document.title = selectedPlayer + " " + document.title;
	}
}*/

var u = new UnityObject2(config);

jQuery(function() 
{
	var $missingScreen = jQuery("#unityPlayer").find(".missing");
	var $brokenScreen = jQuery("#unityPlayer").find(".broken");
	$missingScreen.hide();
	$brokenScreen.hide();
	
	u.observeProgress(function (progress) 
	{
		switch(progress.pluginStatus) 
		{
		case "unsupported":
			document.location = "galleries/gallery_" + selectedScene + "/?lang=" + actualLang;
			break;
		case "broken":
			$brokenScreen.find("a").click(function (e) {
				e.stopPropagation();
				e.preventDefault();
				u.installPlugin();
				return false;
			});
			$brokenScreen.show();
			break;
		case "missing":
			$missingScreen.find("a").click(function (e) {
				e.stopPropagation();
				e.preventDefault();
				u.installPlugin();
				return false;
			});
			$missingScreen.show();
			break;
		case "installed":
			$missingScreen.remove();
			break;
		case "first":
			break;
		}
	});
	u.initPlugin(jQuery("#unityPlayer")[0], selectedPlayer + ".unity3d");
});

function reportSize() 
{
	myWidth = 0, myHeight = 0;
	if( typeof( window.innerWidth ) == 'number' ) {
		//Non-IE
		myWidth = window.innerWidth;
		myHeight = window.innerHeight;
	} else {
		if( document.documentElement &&
				( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
			//IE 6+ in 'standards compliant mode'
			myWidth = document.documentElement.clientWidth;
			myHeight = document.documentElement.clientHeight;
		} else {
			if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
				//IE 4 compatible
				myWidth = document.body.clientWidth;
				myHeight = document.body.clientHeight;
			}
		}
	}
}

var user_id = "";
var editionObject = "";
var mat_index = -1; 
var div_index = -1;
var datatype = "";
var prev_div_index = -1;
var selectTex = "Select a .jpg or .png file up to 4 MB and click Upload button";
var actionUrl = "";

function requestData(gameobject,data_type,mat_ind)
{
	datatype = data_type;
	mat_index = mat_ind;
	editionObject = gameobject;
	prev_div_index = div_index;
	switch(data_type){
	case "texture":
		actionUrl = 'user_textures/doajaxfileupload.php'+"?user_id="+user_id+"&go="+editionObject+"&mat_index="+mat_index;
		break;
	default:
		document.getElementById('select').innerHTML = "?";
		break;
	}
	ShowDiv(2);
}
function ShowDiv(i)	
{
	if(i==0)
	{
		document.getElementById('info1').style.display = "block";
	}
	else
	{
		document.getElementById('info1').style.display = "none";
	}
	if(i==2)
	{
		document.getElementById('fileloader').style.display = "block"; 
	}
	else
	{
		document.getElementById('fileloader').style.display = "none";
	}
	
	div_index = i;
}

function ajaxFileUpload() 
{
	u.getUnity().SendMessage(editionObject, "submissionDone","");
	div_index = prev_div_index;
	ShowDiv(0);
	$("#loading")
	.ajaxStart(function(){
		//$(this).src="user_textures/pbar-ani.gif";
	})
	.ajaxComplete(function(){
		//$(this).src="user_textures/pbar.png";
	});
	
	$.ajaxFileUpload
	(
	{
url:actionUrl,
secureuri:false,
fileElementId:'fileToUpload',
dataType: 'json',
data:{name:'logan', id:'id'},
success: function (data, status)
		{
			if(typeof(data.error) != 'undefined')
			{
				if(data.error != '')
				{
					alert(data.error);
				}else
				{
					var i1 = data.msg.indexOf(" ");
					u.getUnity().SendMessage(editionObject, "takeData", data.msg.substring(i1+1));
					//u.getUnity().SendMessage(data.msg.substring(0,i1), "takeData", data.msg.substring(i1+1));
				}
			}
		},
error: function (data, status, e)
		{
			alert(e);
		}
	}
	)
	return false;
}
function calculatewindow() 
{
	reportSize();
	myHeight -= bottomStripHeight;
	document.getElementById("content").style.height = myHeight + 'px';
	document.getElementById("unityPlayer").style.height = myHeight + 'px';
}
//document.body.onload = function (){calculatewindow();}
window.onresize = function (){calculatewindow();}	
//-->

var publishedUrlId = "10";
//window.location = '?id='+1;
publishedUrlId = getUrlParameter('id');
//window.alert(id);
function getUrlParameter(sParam)
{
	var sPageURL = window.location.search.substring(1);
	var sURLVariables = sPageURL.split('&');
	for (var i = 0; i < sURLVariables.length; i++) 
	{
		var sParameterName = sURLVariables[i].split('=');
		if (sParameterName[0] == sParam) 
		{
			return sParameterName[1];
		}
	}
}

function getPublishedID()
{
	if(publishedUrlId==null)
		publishedUrlId = "null";
		
	u.getUnity().SendMessage("loadingControl", "setPublishedID", publishedUrlId);
}

</script>
<style type="text/css">
@media handheld{ 
	div.missing { display: none; }
	div.missing img{ display: none; }
	div.missing a{ display: none; }
}
<!--
/* hide from ie on mac \*/
html 
{
height:100%;
margin: 0px;
padding: 0px;
overflow: hidden;
}
/* end hide */
body 
{
	font-family: Times New Roman, Verdana, Arial, sans-serif;
	background-color: #cccccc;
color: #808080;
	text-align: center;
	font-size: medium;
border:0;
padding: 0;
margin: 0;
overflow:hidden;
}
a:link, a:visited 
{
color: #000;
}
a:active, a:hover 
{
color: #0F0;
	font-weight: bold;
}
p.header 
{
	font-size: small;
}
p.header span 
{
	font-weight: bold;
}
div.footer 
{
	
}
div.content 
{
width: 100%;
height: 100%;
border:0;
padding: 0;
margin: 0;
overflow:hidden;	
}
#fileloader 
{
width: 100%;
height: 70px;
	background-color: #FFF;
padding: 0px;
margin: 0;
color: #000;
}
div.info 
{
width: 100%;
height: 70px;
	background-color: #FFF;
padding: 8px;
margin: 0;
color: #000;
	font-size: 20px;
}
div.gallink 
{
}
div.missing 
{
margin: auto;
position: relative;
top: 50%;
width: 193px;
}
div.missing a 
{
height: 63px;
position: relative;
top: -31px;
}
div.missing img 
{
	border-width: 0px;
}
div#unityPlayer 
{
cursor: default;
width: 100%;
}
#fileloader form 
{
	font-size: 20px;
padding: 8px;
float:centre;
overflow: hidden;
}
div.upload 
{
width: 157px;
height: 57px;
background: url(user_textures/choseFile.png);
float:left;
overflow: hidden;
}
div.upload input 
{
display: block !important;
width: 157px !important;
height: 57px !important;
opacity: 0 !important;
overflow: hidden !important;
}
div.btn 
{
width: 157px;
height: 57px;
background: url(user_textures/upload.png);
float:left;
overflow: hidden;
}
div.btn button 
{
display: block !important;
width: 157px !important;
height: 57px !important;
opacity: 0 !important;
overflow: hidden !important;
}
-->
</style>
</head>
<body onload="calculatewindow()">
<div id="content">
<div id="unityPlayer">
<div class="missing">
<a href="http://unity3d.com/webplayer/" title="Unity Web Player. Install now!">
<img alt="Unity Web Player. Install now!" src="http://webplayer.unity3d.com/installation/getunity.png" width="193" height="63" />
</a>
</div>
</div>
</div>
<div id="fileloader" style="display: none">
<form action="" method="POST" enctype="multipart/form-data" name="form" class="strip">
<div class="upload">
<input id="fileToUpload" type="file" class="upload" name="fileToUpload" id="fileToUpload" onchange="return ajaxFileUpload();">
</div>
<div align="left" class="fileloader">
<span id = "select"> Select a image file (.jpg, .png or .gif) to upload </span>
</div>
</form>    
</div>
<!---->
<div class="info" id="info1" style="display: none">
<div align="center">
<table width="795" border="0" >
<tr valign="top">
<td width="491" valign="top"><div id="info1i" align="center">Orbit -Drag with LeftMouse | Zoom-MouseScroll</div></td>
</tr>
</table>
</div>
</div>
<div class="info">   
</div>
</body>
</html>