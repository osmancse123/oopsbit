<?php
    error_reporting(1);
	@session_start();
	if($_SESSION["logstatus"] === "Active")
	{	
	require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
	date_default_timezone_set("Asia/Dhaka");
	$db = new database();
	  $sqlForTest="SELECT `running_student_info`.*,`student_personal_info`.`gender`,`date_of_brith`,`student_name`,`father_name`,`mother_name`,`student_address_info`.`permanent_village`,
 `permanent_PO`,`present_distric`,`permanent_upazila`,`student_acadamic_information`.`session2`,`add_class`.`class_name`,`add_group`.`group_name`
  FROM`running_student_info` INNER JOIN `student_personal_info` ON `student_personal_info`.`id`=`running_student_info`.`student_id`
   INNER JOIN `student_address_info` ON `student_address_info`.`id`=`running_student_info`.`student_id` INNER JOIN 
   `student_acadamic_information` ON `student_acadamic_information`.`id`=`running_student_info`.`student_id` INNER JOIN 
`add_class` ON `add_class`.`id`=`running_student_info`.`class_id` INNER JOIN `add_group` ON `add_group`.`id`=`running_student_info`.`group_id`
WHERE `running_student_info`.`student_id`='".$_GET["stdid"]."'";
	$resultForAll=$db->select_query($sqlForTest);
		if($resultForAll){
				$fetchForall=$resultForAll->fetch_array();
		}
		
		$projectinfo="SELECT  * FROM `project_info`";
		$result=$db->select_query($projectinfo);
		if($result>0){
			$fetch_result=$result->fetch_array();
		}
		
		
			$select_school="select * from project_info";
$cheke_school=$db->select_query($select_school);
if($cheke_school)
{
$fetch_school_information=$cheke_school->fetch_array();
}
?>
<html>
	<head>
		
		<title>
			Certificate
		</title>
		<link rel="shortcut icon" href="all_image/<?php echo "shortcurt_iconSDMS2015";?>.png" />
		<style media="print">
.dont-print{display:none;}
        </style>
		<style type="text/css"> 
		
		*{padding:0px; margin:0px;}.style5 {font-size: 24px}
.style12 {font-family: "Times New Roman", Times, serif}
.style14 {font-size: 24px; font-family: "Times New Roman", Times, serif; }
        .style16 {font-size: 16px; font-weight: bold; font-family: "Times New Roman", Times, serif; }
.style17 {font-size: 16px}
        .style19 {font-size: 18px; font-weight: bold; font-family: "Times New Roman", Times, serif; }
        </style>
	</head>
	 <meta charset="utf-8">
	<body>

	<center>
<table width="1325" height="600" background="all_image/transfet_certificateSDMS2015.jpg" style=" border:0px;" align="center" >
  <tr>
    <td width="1006" height="285" align="right" valign="bottom"></td>
    <td width="307" valign="bottom"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="35%">&nbsp;</td>
        <td width="4%">&nbsp;</td>
        <td width="61%">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><span class="style16">EIIN</span></td>
        <td><span class="style16">:</span></td>
        <td><span class="style16">106462</span></td>
      </tr>
     <!-- <tr>
        <td><span class="style16">College Code </span></td>
        <td><span class="style16">:</span></td>
        <td><span class="style16">6755</span></td>
      </tr>
      <tr>
        <td><span class="style16">Center Code </span></td>
        <td><span class="style16">:</span></td>
        <td><span class="style16">333</span></td>
      </tr> -->
      <tr>
        <td><span class="style17"></span></td>
        <td><span class="style17"></span></td>
        <td><span class="style17"></span></td>
      </tr>
      <tr>
        <td><span style="font-size:18px; font-weight:bold;">Date</span></td>
        <td><span class="style19">:</span></td>
        <td><span style="font-size:18px; font-weight:bold;"><?php print $_GET["date"]?></span></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="615" colspan="2" valign="top"><table width="100%" height="71%" border="0" cellpadding="0" cellspacing="0">
     
      <tr>
        <td height="48"><span class="style12"></span></td>
        <td><span class="style12"></span></td>
      </tr>
      <tr>
        <td height="104"><span class="style12"></span></td>
        <td colspan="3" align="justify" valign="top"><p class="style14" style="text-align:justify">
		This is to certify that<br/>
		Name <span style="padding-left:100px;"></span>: <?php echo $fetchForall["student_name"];?> <br/>
		Father's Name  <span style="padding-left:19px;"></span>: <?php echo $fetchForall["father_name"];?> <br/>
		Mother's Name   <span style="padding-left:10px;"></span>  : <?php echo $fetchForall["mother_name"];?> <br/>
		Address       <span style="padding-left:78px;"></span> :	 <?php echo $fetchForall["permanent_village"];?>, <?php echo $fetchForall["permanent_PO"];?>,   <?php echo $fetchForall["permanent_upazila"];?>,  <?php echo $fetchForall["present_distric"];?>.	<br/><br/>was a regular/irregular student of Joypur Sorojini High School.
		<?php if($fetchForall["gender"] == "Male") { ?>He <?php } else { ?> She <?php } ?> has been studying here in class <?php echo $fetchForall["class_name"];?><?php if($fetchForall["group_name"] != "Null") { ?>  , group  <?php echo $fetchForall["group_name"];?> <?php } ?>.
		According to our admission register, <?php if($fetchForall["gender"] == "Male") { ?>His <?php } else { ?> Her <?php } ?> date of birth was <?php echo $fetchForall["date_of_brith"];?> .
		 <?php if($fetchForall["gender"] == "Male") { ?>His <?php } else { ?> Her <?php } ?>  roll no. was <?php echo $fetchForall["class_roll"];?>.<br/><br/>
		
				
	<!--	This is to certify that  <?php echo $fetchForall["student_name"];?> was a regular student  in <?php echo $fetch_school_information["institute_name"];?><?php echo $fetchForall["session2"];?> class <?php echo $fetchForall["class_name"];?> in   <?php echo $fetchForall["group_name"];?> group, 
class roll -<?php echo $fetchForall["class_roll"];?> . <?php if($fetchForall["gender"] == "Male") { ?>His <?php } else { ?> Her <?php } ?>  father's name<?php echo $fetchForall["father_name"];?>  and mother's name ayesha,
<?php echo $fetchForall["mother_name"];?>,Village <?php echo $fetchForall["permanent_village"];?>, Post Office <?php echo $fetchForall["permanent_PO"];?>, Upazilla  <?php echo $fetchForall["permanent_upazila"];?> Zilla <?php echo $fetchForall["present_distric"];?>.
-->
		
<br/>	



According to  <?php if($fetchForall["gender"] == "Male") { ?>his <?php } else { ?> her <?php } ?> application, this certificate was issued following Board's order no. ................................................ date..................................... serial no...................<br/><br/>
I wish <?php if($fetchForall["gender"] == "Male") { ?>his <?php } else { ?> her <?php } ?> every success of life.<br/><br/><!--</br/><br/>
Head Master</br/>
Joypur Sorojini High School </br/>-->

		</p></td>
        <td><span class="style12"></span></td>
      </tr>
      <tr>
        <td height="31"><span class="style12"></span></td>
        <td colspan="3"><span class="style14"> </span></td>
        <td><span class="style12"></span></td>
      </tr>
      <tr>
        <td><span class="style12"></span></td>
        <td width="28%"><span class="style12"></span></td>
        <td width="29%"><span class="style12"></span></td>
        <td width="27%"><span class="style12"></span></td>
        <td><span class="style12"></span></td>
      </tr>
    </table>
      <p>&nbsp;</p>
    <p>&nbsp;</p>
    </td>
  </tr>
</table>
<form name="frm" method="post" >
<input type="submit" value="Print" onClick="window.print()" class="dont-print" />
</form>
<p>&nbsp;</p>
	</center>
</html>
</body>
        	<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>


