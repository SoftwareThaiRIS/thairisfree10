<?php
############################################
# ThaiRIS (Thai Radiology Information System)
# Version: 1.0
# File last modified: 8 Nov 2016
# File name: dictate-wokrlist.php
# Description :  Show Order worklist in examroom
# http://www.thairis.net
# Email : info.xraythai@gmail.com
###########################################
include "connectdb.php";
include ("session.php");
include ("function.php");
$searchbox = $_POST['searchbox'];
$datestart = $_POST['date001'];
$dateend = $_POST['date002'];
$searchtoday = $_POST['today'];
$todaytype = $_POST['todaytype'];
$searchmrn = $_POST['mrn'];
$searchacc = $_POST['acc'];
$searchname = $_POST['searchname'];
$searchlast = $_POST['searchlast'];
$mod1 = $_POST['Mod_option1'];
$mod2 = $_POST['Mod_option2'];
$mod3 = $_POST['Mod_option3'];
$mod4 = $_POST['Mod_option4'];
$mod5 = $_POST['Mod_option5'];
$mod6 = $_POST['Mod_option6'];
$mod7 = $_POST['Mod_option7'];
$mod8 = $_POST['Mod_option8'];
$date1 = $_POST['date1'];
$date2 = $_POST['date2'];
$selectuserID = $_POST['selectuserID1'];

if ($_POST['reset'] == 'reset')
	{
		$searchbox = '';
		$datestart = '';
		$dateend = '';
		$searchtoday = '';
		$todaytype = '';
		$searchmrn = '';
		$searchacc ='';
		$searchname = '';
		$searchlast = '';
		$mod1 = '';
		$mod2 = '';
		$mod3 = '';
		$mod4 = '';
		$mod5 = '';
		$mod6 = '';
		$mod7 = '';
		$mod8 = '';
		$date1 = '';
		$date2 = '';
		$selectuserID = '';
	}

if ($date1 =='')
	{
		//$date1 = '2013-01-01';
		$date1 = date('Y-m-d');
	}

if ($date2 =='')
	{
		$date2 = date('Y-m-d');
		//$date2 = '2500-12-30';
	}
	
if ($selectuserID !='')
	{
		($usercodesearch = $selectuserID);
	}
	
else 
	{
		($usercodesearch = $usercode);
	}


?>

<!DOCTYPE HTML>
<html>
<head>
<title>Reporting</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<link href="css/main.css" rel="stylesheet" type="text/css" />
<link href="css/layout.css" rel="stylesheet" type="text/css" />
<link href="css/modal.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="css/button.css" />
<style type="text/css">

<!--

body {  margin: 0px  0px; padding: 0px  0px}

a:link { color: #005CA2; text-decoration: none}

a:visited { color: #005CA2; text-decoration: none}

a:active { color: #0099FF; text-decoration: underline}

a:hover { color: #0099FF; text-decoration: underline}

-->

</style>
<link rel="stylesheet" type="text/css" href="css/smoothness/jquery-ui-1.7.2.custom.css">  
<style type="text/css">  
/* Overide css code ????????????????????????????????????????????????????????????????????????????????????????????? */  
.ui-datepicker{  
    width:170px;  
    font-family:tahoma;  
    font-size:11px;  
    text-align:center;  
}  
</style> 
<script type="text/JavaScript" src="reporting.js"></script>
<script type="text/javascript" src="unlockexam.js"></script>
<script>
<!--
// Auto Refresh 
//enter refresh time in "minutes:seconds" Minutes should range from 0 to inifinity. Seconds should range from 0 to 59
var limit="22:59"
if (document.images)
	{ 
		var parselimit=limit.split(":")
		parselimit=parselimit[0]*60+parselimit[1]*1
	}
function beginrefresh()
	{
		if (!document.images)
			return
		if (parselimit==1)
			window.location.reload()
		else
			{
				parselimit-=1
				curmin=Math.floor(parselimit/60)
				cursec=parselimit%60
				if (curmin!=0)
					curtime=curmin+" minutes and "+cursec+" seconds left until page refresh!"
				else
					curtime=cursec+" seconds left until page refresh!"
					window.status=curtime
					//setTimeout("beginrefresh()",1000)
					setTimeout("beginrefresh()",500)
			}
	}

window.onload=beginrefresh
//-->
</script>
    <script language=JavaScript src="frames_body_array_<?php echo $LANGUAGE; ?>.js" type=text/javascript></script>
    <script language=JavaScript src="mmenu.js" type=text/javascript></script>  
	<link href="css/main.css" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
<link href="css/ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
<!-- Add jQuery library -->
	<script type="text/javascript" src="./lib/jquery-1.9.0.min.js"></script>
	<script type="text/javascript" src="./source/jquery.fancybox.js"></script>
	<link rel="stylesheet" type="text/css" href="./source/jquery.fancybox.css" media="screen" />
	
	
	<script type="text/javascript">
		$(document).ready(function() {
			/*
			 *  Simple image gallery. Uses default settings
			 */
			$(".fancybox").fancybox({
				afterClose : function() {
					location.reload();
					return;
				}
			});
			

			$("#fancybox-manual-b").click(function() {
				$.fancybox.open({
					href : 'iframe.html',
					type : 'iframe',
					padding : 5
				});
			});

		});
	</script>
	<style type="text/css">
		.fancybox-custom .fancybox-skin {
			box-shadow: 0 0 50px #222;
		}
	</style>

<STYLE>
	.TESTcpYearNavigation,
	.TESTcpMonthNavigation
			{
			background-color:#000000;
			text-align:center;
			vertical-align:center;
			text-decoration:none;
			color:#FFFFFF;
			font-weight:bold;
			}
	.TESTcpDayColumnHeader,
	.TESTcpYearNavigation,
	.TESTcpMonthNavigation,
	.TESTcpCurrentMonthDate,
	.TESTcpCurrentMonthDateDisabled,
	.TESTcpOtherMonthDate,
	.TESTcpOtherMonthDateDisabled,
	.TESTcpCurrentDate,
	.TESTcpCurrentDateDisabled,
	.TESTcpTodayText,
	.TESTcpTodayTextDisabled,
	.TESTcpText
			{
			font-family:arial;
			font-size:8pt;
			}
	TD.TESTcpDayColumnHeader
			{
			text-align:right;
			border:solid thin #6677DD;
			border-width:0 0 1 0;
			}
	.TESTcpCurrentMonthDate,
	.TESTcpOtherMonthDate,
	.TESTcpCurrentDate
			{
			text-align:right;
			text-decoration:none;
			}
	.TESTcpCurrentMonthDateDisabled,
	.TESTcpOtherMonthDateDisabled,
	.TESTcpCurrentDateDisabled
			{
			color:#D0D0D0;
			text-align:right;
			text-decoration:line-through;
			}
	.TESTcpCurrentMonthDate
			{
			color:#6677DD;
			font-weight:bold;
			}
	.TESTcpCurrentDate
			{
			color: #FFFFFF;
			font-weight:bold;
			}
	.TESTcpOtherMonthDate
			{
			color:#808080;
			}
	TD.TESTcpCurrentDate
			{
			color:#FFFFFF;
			background-color: #6677DD;
			border-width:1;
			border:solid thin #000000;
			}
	TD.TESTcpCurrentDateDisabled
			{
			border-width:1;
			border:solid thin #FFAAAA;
			}
	TD.TESTcpTodayText,
	TD.TESTcpTodayTextDisabled
			{
			border:solid thin #6677DD;
			border-width:1 0 0 0;
			}
	A.TESTcpTodayText,
	SPAN.TESTcpTodayTextDisabled
			{
			height:20px;
			}
	A.TESTcpTodayText
			{
			color:#6677DD;
			font-weight:bold;
			}
	SPAN.TESTcpTodayTextDisabled
			{
			color:#FFFFFF;
			}
	.TESTcpBorder
			{
			border:solid thin #000000;
			}
</STYLE>

<script type="text/javascript">
		$(document).ready(function() {
			/*
			*   Examples - images
			*/

			$("a#example1").fancybox();

			$("a#example2").fancybox({
				'overlayShow'	: false,
				'transitionIn'	: 'elastic',
				'transitionOut'	: 'elastic'
			});

			$("a#example3").fancybox({
				'transitionIn'	: 'none',
				'transitionOut'	: 'none'	
			});

			$("a#example4").fancybox({
				'opacity'		: true,
				'overlayShow'	: false,
				'transitionIn'	: 'elastic',
				'transitionOut'	: 'none'
			});

			$("a#example5").fancybox();

			$("a#example6").fancybox({
				'titlePosition'		: 'outside',
				'overlayColor'		: '#000',
				'overlayOpacity'	: 0.9
			});

			$("a#example7").fancybox({
				'titlePosition'	: 'inside'
			});

			$("a#example8").fancybox({
				'titlePosition'	: 'over'
			});

			$("a[rel=example_group]").fancybox({
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'titlePosition' 	: 'over',
				'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
					return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
				}
			});

			/*
			*   Examples - various
			*/

			$("#various1").fancybox({
				'titlePosition'		: 'inside',
				'transitionIn'		: 'none',
				'transitionOut'		: 'none'
			});

			$("#various2").fancybox();

			$("#various3").fancybox({
				'width'				: '75%',
				'height'			: '75%',
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'type'				: 'iframe'
			});

			$("#various4").fancybox({
				'padding'			: 0,
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none'
			});
			
<?php

for ($X=0; $X<51; $X++)
	{	
		echo "$(\"#variousL-A".$X."\").fancybox({
				'width'				: '75%',
				'height'			: '90%',
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'type'				: 'iframe'
				});"
			;}

for ($X=0; $X<51; $X++)
	{	
		echo "$(\"#variousL-B".$X."\").fancybox({
				'width'				: '75%',
				'height'			: '90%',
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'type'				: 'iframe'
				});"
			;}
			?>	
			
			
		});
</script>
</head>


<body bgcolor="gray" leftmargin="3">
<div id="header-wrap">
	<div id="header-container">
		<table border=0 cellspacing=0 cellpedding=0 width=100%>
			<tr>
				<td  BACKGROUND="cornner/hl.gif" border=0 width=20 height=36></td>
				<td background="cornner/bg.gif" height=36 width=70% align=right><img src=icons/arrow-curve-180-left.png><a href=dictate-worklist.php style="text-decoration: none"><b><font color=white> Back To Worklist </font></b></a></td>
				<td background="cornner/hm1.gif" width=33 align=right></td>
				<td background="cornner/hm2.gif"><b>My Workload</b></td>
				<td background="cornner/hm4.gif" width=1></td>
				<td background="cornner/hm2.gif"><?php echo $username; ?></td>
	            <td background="cornner/hm3.gif" width=30></td>
			</tr>
		</table>
	</div>
</div>
<br />
<br />

<?php

$sql1 = "UPDATE xray_request_detail SET LOCKBY ='' WHERE xray_request_detail.LOCKBY= '$userid'";
mysql_query($sql1);

// Default Display (No search)
$sql = "SELECT 
			xray_patient_info.MRN, 
			xray_patient_info.CENTER_CODE, 
			xray_patient_info.NAME AS PTNAME, 
			xray_patient_info.LASTNAME  AS PTLASTNAME, 
			xray_patient_info.NAME_ENG AS NAMEENG, 
			xray_patient_info.LASTNAME_ENG AS LASTNAMEENG, 
			xray_patient_info.BIRTH_DATE, 
			xray_request.REQUEST_NO AS req_no, 
			xray_request_detail.ID AS ORDERID, 
			xray_request_detail.REQUEST_DATE AS REQ_DATE, 
			xray_request_detail.REQUEST_TIME AS REQ_TIME, 
			xray_request_detail.REQUEST_TIMESTAMP AS ORDERTIME, 
			xray_request_detail.ARRIVAL_TIME AS ARRIVAL, 
			xray_request_detail.START_TIME AS START_TIME, 
			xray_request_detail.ASSIGN_TIME AS ASSIGNTIME,
			xray_request_detail.REQUEST_NO AS REQNUMBER, 
			xray_request_detail.REQUEST_DATE,
			xray_request_detail.ACCESSION, 
			xray_request_detail.XRAY_CODE AS XRAY_CODE, 
			xray_request_detail.STATUS, 
			xray_request_detail.URGENT, 
			xray_request_detail.ACCESSION,
			xray_request_detail.ASSIGN AS ASSIGN,
			xray_request_detail.STATUS AS STATUS,
			xray_request_detail.READY_TIME AS TIMEREADY,
			xray_request_detail.LOCKBY,
			xray_request_detail.FLAG1,
			xray_request_detail.REPORT_BOOK,
			xray_report.APPROVE_DATE AS REP_DATE,
			xray_report.APPROVE_TIME AS REP_TIME,
			xray_report.APPROVE_BY,
			xray_code.XRAY_TYPE_CODE AS MODALITY,
			xray_code.DESCRIPTION, 
			xray_code.BIRAD_FLAG, 
			xray_department.NAME_THAI AS DEP,
			xray_referrer.NAME AS DOCTORNAME, 
			xray_referrer.LASTNAME AS DOCTORLASTNAME,
			xray_user.NAME AS RAD
			FROM  xray_request 
			LEFT JOIN xray_request_detail ON (xray_request_detail.REQUEST_NO = xray_request.REQUEST_NO) 
			LEFT JOIN xray_user ON (xray_request_detail.ASSIGN = xray_user.CODE) 
			LEFT JOIN xray_patient_info ON (xray_request.MRN = xray_patient_info.MRN) 
			LEFT JOIN xray_department ON (xray_request.DEPARTMENT_ID = xray_department.DEPARTMENT_ID) 
			LEFT JOIN xray_referrer ON (xray_request.REFERRER = xray_referrer.REFERRER_ID)
			LEFT JOIN xray_code ON xray_code.XRAY_CODE = xray_request_detail.XRAY_CODE 
			LEFT JOIN xray_report ON (xray_request_detail.ACCESSION = xray_report.ACCESSION) 
			WHERE 
			(xray_patient_info.CENTER_CODE ='$center_code' AND xray_patient_info.MRN like '%$searchmrn%' AND xray_request_detail.ACCESSION like '%$searchacc%' 
			AND xray_patient_info.NAME like '%$searchname%' AND xray_patient_info.LASTNAME like '%$searchlast%')
			AND (xray_report.APPROVE_DATE between '$date1' AND '$date2') 
			AND xray_code.DESCRIPTION like '%$mod8%'
			AND (xray_code.XRAY_TYPE_CODE like '%$mod1%' AND xray_code.XRAY_TYPE_CODE like '%$mod2%'
				AND xray_code.XRAY_TYPE_CODE like '%$mod3%' AND xray_code.XRAY_TYPE_CODE like '%$mod4%' 
				AND xray_code.XRAY_TYPE_CODE like '%$mod5%'AND xray_code.XRAY_TYPE_CODE like '%$mod6%' 
				AND xray_code.XRAY_TYPE_CODE like '%$mod7%')
			AND xray_report.APPROVE_BY = '$userid'
			ORDER BY REP_DATE ASC, REP_TIME ASC
			LIMIT 0 , 999 ";
			
//			WHERE xray_code.XRAY_TYPE_CODE IN ('$mod1','$mod2','$mod3','$mod4','$mod5','$mod6','$mod7')
$result = mysql_query($sql);
			
// HN xray_patient_info.MRN
// REQNUMBER xray_request.REQUEST_NO
// ACCESSION xray_request_detail.ACCESSION
// PATIENT NAME xray_patient_info.NAME AS PTNAME
// PATIENT LASTNAME xray_patient_info.LASTNAME  AS PTLASTNAME
// XRAY DESCRIPTION xray_code.DESCRIPTION AS DESCRIPTION
// PHYSICIAN NAME xray_referrer.NAME
// PHYSICIAN LASTNAME xray_referrer.LASTNAME
// DEPARTMENT xray_department.NAMETHAI
// XRAY CODE xray_code.XRAY_CODE

?>
<table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#79acf3">
		<tr>
				<td align=center width=20%><b>Export To</b></td><td align=center width=25%><b>Patient Search</b></td>
				<td align=center width=25%><b>Modality</b></td><td align=center width=25%><b>Date</b></td>
		</tr>
  <tr>
    <td bgcolor="#f8d290" align=center>
	<form method="post" action="workload-my.php">

<a href=#><img src=image/pdf.png width=35></a>
<a href=#><img src=image/xls.png width=35></a>
	  </td>
	  
    <td  bgcolor="#f8d290"><p>
		<INPUT TYPE=hidden NAME="searchbox" value="1">
 				<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr> 
							<td  valign="top"  >  	HN </td>
							<td><input type="text" name="mrn" id="MRN"></td>
							<td>ACC </td>
							<td><input type="text" name="acc"></td>
						</tr>
						<tr>
							<td> Name </td><td><input type="text" name="searchname"></td>
							<td>Lastname </td><td><input type="text" name="searchlast"></td>
						</tr>
					</table>
					<center>

					</center>
    </p>
    </td>
			<td align=center bgcolor="#f8d290"> 

				<INPUT TYPE=hidden NAME="today" value="1">
				<table>
				<tr>
					<td><input type="checkbox" name=Mod_option1 value="CT" /><label for="demo_box_1" name="demo_lbl_1" class="css-label"> CT</label></td>
					<td><input type="checkbox" name=Mod_option2 value="MRI" /><label for="demo_box_1" name="demo_lbl_2" class="css-label"> MRI</label></td>
					<td><input type="checkbox" name=Mod_option3 value="XRAY" /><label for="demo_box_1" name="demo_lbl_3" class="css-label"> XRAY</label></td>
					<td><input type="checkbox" name=Mod_option4 value="MAMMO" /><label for="demo_box_1" name="demo_lbl_4" class="css-label"> MAMMO</label></td>
				</tr>
				<tr>
					<td><input type="checkbox" name=Mod_option5 value="US" /><label for="demo_box_1" name="demo_lbl_5" class="css-label"> U/S</label></td>
					<td><input type="checkbox" name=Mod_option6 value="FLUORO" /><label for="demo_box_1" name="demo_lbl_6" class="css-label"> FLU/IVP</label></td>
					<td><input type="checkbox" name=Mod_option7 value="BMD" /><label for="demo_box_1" name="demo_lbl_7" class="css-label"> BMD</label></td>
					<td><input type="checkbox" name=Mod_option8 value="PORTABLE" /><label for="demo_box_1" name="demo_lbl_8" class="css-label"> PORTABLE</label></td>
				</tr>
				</table>

				<!--<center><input type=button value="refresh" onClick="window.open('order.php','main')"></center>-->
			</td>

<td bgcolor="#f8d290">
<center>
<input type="text" name="date1" id="dateInput1" value=<?php echo $date1; ?> size=8/> 
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>  
<script type="text/javascript" src="js/jquery-ui-1.7.2.custom.min.js"></script> 
<script type="text/javascript">  
$(function(){  
    var dateBefore=null;  
    $("#dateInput1").datepicker({  
        dateFormat: 'yy-mm-dd',  
        showOn: 'button',  
        buttonImage: 'image/calandar.jpg',  
        buttonImageOnly: true,  
        dayNamesMin: ['??????', '???', '???', '???', '??????', '???', '???'],   
        monthNamesShort: ['??????????????????','??????????????????????????????','??????????????????','??????????????????','?????????????????????','????????????????????????','?????????????????????','?????????????????????','?????????????????????','??????????????????','???????????????????????????','?????????????????????'],  
        changeMonth: true,  
        changeYear: true ,  
        beforeShow:function(){  
            if($(this).val()!=""){  
                var arrayDate=$(this).val().split("-");       
                arrayDate[2]=parseInt(arrayDate[2]);  
                //arrayDate[2]=parseInt(arrayDate[2])-543;  
				$(this).val(arrayDate[0]+"-"+arrayDate[1]+"-"+arrayDate[2]);  
            }  
            setTimeout(function(){  
                $.each($(".ui-datepicker-year option"),function(j,k){  
                    var textYear=parseInt($(".ui-datepicker-year option").eq(j).val());  
                    //var textYear=parseInt($(".ui-datepicker-year option").eq(j).val())+543;  
					$(".ui-datepicker-year option").eq(j).text(textYear);  
                });               
            },50);  
  
        },  
        onChangeMonthYear: function(){  
            setTimeout(function(){  
                $.each($(".ui-datepicker-year option"),function(j,k){  
                    var textYear=parseInt($(".ui-datepicker-year option").eq(j).val());  
                    //var textYear=parseInt($(".ui-datepicker-year option").eq(j).val())+543;  
					$(".ui-datepicker-year option").eq(j).text(textYear);  
                });               
            },50);        
        },  
        onClose:function(){  
            if($(this).val()!="" && $(this).val()==dateBefore){           
                var arrayDate=dateBefore.split("-");  
                arrayDate[2]=parseInt(arrayDate[2]);  
                //arrayDate[2]=parseInt(arrayDate[2])+543;  
			   $(this).val(arrayDate[0]+"-"+arrayDate[1]+"-"+arrayDate[2]);      
            }         
        },  
        onSelect: function(dateText, inst){   
            dateBefore=$(this).val();  
            var arrayDate=dateText.split("-");  
            arrayDate[2]=parseInt(arrayDate[2]);  
            //arrayDate[2]=parseInt(arrayDate[2])+543; 
			$(this).val(arrayDate[0]+"-"+arrayDate[1]+"-"+arrayDate[2]);  
        }  
  
    });  
      
});  
</script>						

<input type="text" name="date2" id="dateInput2" value=<?php echo $date2; ?> size=8/> 
<script type="text/javascript">  
$(function(){  
    var dateBefore=null;  
    $("#dateInput2").datepicker({  
        dateFormat: 'yy-mm-dd',  
        showOn: 'button',  
        buttonImage: 'image/calandar.jpg',  
        buttonImageOnly: true,  
        dayNamesMin: ['??????', '???', '???', '???', '??????', '???', '???'],   
        monthNamesShort: ['??????????????????','??????????????????????????????','??????????????????','??????????????????','?????????????????????','????????????????????????','?????????????????????','?????????????????????','?????????????????????','??????????????????','???????????????????????????','?????????????????????'],  
        changeMonth: true,  
        changeYear: true ,  
        beforeShow:function(){  
            if($(this).val()!=""){  
                var arrayDate=$(this).val().split("-");       
                arrayDate[2]=parseInt(arrayDate[2]);  
                //arrayDate[2]=parseInt(arrayDate[2])-543;  
				$(this).val(arrayDate[0]+"-"+arrayDate[1]+"-"+arrayDate[2]);  
            }  
            setTimeout(function(){  
                $.each($(".ui-datepicker-year option"),function(j,k){  
                    var textYear=parseInt($(".ui-datepicker-year option").eq(j).val());  
                    //var textYear=parseInt($(".ui-datepicker-year option").eq(j).val())+543;  
					$(".ui-datepicker-year option").eq(j).text(textYear);  
                });               
            },50);  
  
        },  
        onChangeMonthYear: function(){  
            setTimeout(function(){  
                $.each($(".ui-datepicker-year option"),function(j,k){  
                    var textYear=parseInt($(".ui-datepicker-year option").eq(j).val());  
                    //var textYear=parseInt($(".ui-datepicker-year option").eq(j).val())+543;  
					$(".ui-datepicker-year option").eq(j).text(textYear);  
                });               
            },50);        
        },  
        onClose:function(){  
            if($(this).val()!="" && $(this).val()==dateBefore){           
                var arrayDate=dateBefore.split("-");  
                arrayDate[2]=parseInt(arrayDate[2]);  
                //arrayDate[2]=parseInt(arrayDate[2])+543;  
			   $(this).val(arrayDate[0]+"-"+arrayDate[1]+"-"+arrayDate[2]);      
            }         
        },  
        onSelect: function(dateText, inst){   
            dateBefore=$(this).val();  
            var arrayDate=dateText.split("-");  
            arrayDate[2]=parseInt(arrayDate[2]);  
            //arrayDate[2]=parseInt(arrayDate[2])+543; 
			$(this).val(arrayDate[0]+"-"+arrayDate[1]+"-"+arrayDate[2]);  
        }  
  
    });  
      
});  
</script>	

</center>
	</td>
	</tr>

  <tr><td colspan=4 bgcolor=#79acf3><center>
  <button type=submit class="positive" name="reset" value="reset"><img src="icons/arrow-circle-225-left.png" width=15 alt="reset" border=0 /> Reset </button>
  <button type=submit class="positive" value="submit"><img src="icons/find.png" width=15 alt="Search" border=0 /> Search </button>
  </center></td></tr>
</form>
</table>
</table>
<br />
<?php

echo "<table border='0' cellspacing='1' bgcolor='#79acf3' width=100%>
<tr>
<th><font color=#000000>Report</font></th>
<th><font color=#000000>Image</font></th>
<th><font color=#000000> HN / ACC</font></th>
<th><font color=#000000> Approved By</font></th>
<th><font color=#000000>Patient</font></th>
<th><font color=#000000>Mod</font></th>
<th><font color=#000000>Procedure</font></th>
<th><font color=#000000>Physician</font></th>
<th><font color=#000000>Report Date</font></th>
<th>Edit</th>
<th>Addendum</th>
</tr>\n";
$bg ="#FFCCCC";
$count = 0;
while($row = mysql_fetch_array($result))
	{
		if($bg == "#FFFFFF") 
			{ //Chang Color
				$bg = "#C8C8C8";
			} 
		else 
			{
				$bg = "#FFFFFF";
			}
		$count = $count+1;
		echo "<tr bgcolor=$bg onMouseOver=this.bgColor='gold'; onMouseOut=this.bgColor='".$bg."';>";
		$URGENT = $row['URGENT'];
		echo "<td align=center><a href=showreport.php?ACCESSION=".$row['ACCESSION']." target=_blank><img src=image/report.gif></td>";
		echo "<td align=center><a href=http://127.0.0.1:8080/?AccessionID=$ACCESSION&UserName=$pacs_login target=pacsResult><img src=images/eye.png></a></td>";
		echo "<td>".$row['MRN']."<br />";
		echo "<img src=arrow.gif> <a id='variousL-A".$count."' href=order-info.php?MRN=".$row['MRN']."&ACCESSION=".$row['ACCESSION'].">";
		echo "<font size=-2 color=green>".$row['ACCESSION']."</font></a></td>";
		echo "<td>";
		//echo "<font size=-1 color=gray>".$row[RAD]."/ </font><br />";
		
$result3 = mysql_query("SELECT NAME FROM xray_user WHERE ID = '$row[APPROVE_BY]'");

while($row1 = mysql_fetch_array($result3))
	{
			$APPROVE = $row1['NAME'];
			echo $APPROVE;
	}
		
		echo "</td>";
		//echo "<td><a href='#'><img border=0 src=./folder-icon.gif onClick=\"window.open('order-info.php?ACCESSION=".$row[ACCESSION]."','mywindow1','scrollbars=yes,resizable=yes,screenX=0,screenY=100,width=600,height=500')\"></a><font size=-1>".$row[ACCESSION]."</font></td>";
		echo "<td><a id='variousL-B".$count."' href=patient-info.php?MRN=".$row['MRN']."><img border=0 src=./image/folder.png></a> ".$row['PTNAME']."   ".$row['PTLASTNAME']."</td>";
		echo "<td>".$row['MODALITY']." </td>";
		echo "<td>".$row['DESCRIPTION']."</td>";
		echo "<td>".$row['DOCTORNAME']." ".$row['DOCTORLASTNAME']."<br /><font size=-1 color=green>".$row['DEP']."</font></td>";
		echo "<td>".EngEachDate($row['REP_DATE'].$row['REP_TIME'])."</td>";
		echo "<td align=center>";
		echo "-</td>";
		echo "<td align=center><a  class=\"fancybox fancybox.iframe\" href=addendum-dictate.php?ORDERID=".$row['ORDERID'].">";
		echo "<button type=button class=\"positive\" value=\"Preview\"><img src=\"icons/newspaper--plus.png\" alt=\"\"/> Addendum</button></a></td>";

		echo "</tr>\n";	
	}
echo "<tr><th colspan=9 align=right>";
echo "Total =".$count;
echo "</th></tr></table>";
echo "</br>";
echo "<center><font color=white>CopyRight(C)</font></center>";
?>
<iframe name="pacsResult" frameborder="0" width="0" height="0" src=""></iframe>
<script language=javascript>
document.searchmrn.MRN.focus();
</script>
</body>
</html>