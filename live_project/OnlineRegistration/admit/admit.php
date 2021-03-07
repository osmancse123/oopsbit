<?php
	error_reporting(1);
@session_start();
@date_default_timezone_set('Asia/Dhaka');
require_once("../../db_connect/config.php");
	require_once("../../db_connect/conect.php");

	$db = new database();

 $sql ="SELECT `reg_student_acadamic_information`.*,`reg_student_address_info`.*,`reg_student_guardian_information`.*,`reg_student_personal_info`.*,
`reg_student_previous_result`.*,`reg_student_passward`.*,`add_class`.`class_name`,`add_group`.`group_name` FROM `reg_student_acadamic_information` INNER JOIN `reg_student_address_info`
ON `reg_student_address_info`.`id`=`reg_student_acadamic_information`.`id` INNER JOIN `reg_student_guardian_information`
ON `reg_student_acadamic_information`.`id`=`reg_student_guardian_information`.`id` INNER JOIN `reg_student_personal_info`
ON `reg_student_personal_info`.`id`=`reg_student_acadamic_information`.`id` INNER JOIN `reg_student_previous_result`
ON `reg_student_previous_result`.`id`=`reg_student_acadamic_information`.`id` INNER JOIN`reg_student_passward` ON `reg_student_passward`.`studentId`=`reg_student_acadamic_information`.`id` INNER JOIN `add_class` ON `add_class`.`id`=`reg_student_acadamic_information`.`admission_disir_class`
INNER JOIN `add_group`  ON  `add_group`.`id`=`reg_student_acadamic_information`.`admission_disir_group` WHERE `reg_student_acadamic_information`.`id`='".$_SESSION["useridid"]."'";
	$result =  $db->select_query($sql);
		if($result->num_rows > 0){
			$fetch_result = $result->fetch_array();
		}

	$select_school="select * from project_info";
$cheke_school=$db->select_query($select_school);
if($cheke_school)
{
$fetch_school_information=$cheke_school->fetch_array();
}


?>


<!doctype html>
<html class="no-js" lang="">
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="Description" content="<?php echo $fetch_school_information['meta_tag'] ?>" />
		 <title><?php print $fetch_school_information['title'] ?></title>
		<link rel="shortcut icon" href="../../admin/all_image/<?php echo "shortcurt_iconSDMS2015";?>.png" />
</head>
<link rel="stylesheet" href="admit.css" />
<style media="print">

.print{display:none;}
h2{line-height: 10px; padding: 0px;}
.leftdiv{ line-height: 10px; }
</style>

<body>
<center>
	<div class="allbody">
		<div class="admitbody">
			<div class="admitheader" style="border:0px;" > 
				
				
	<table style="width:100%; padding-top:20px; border:0px;">
						
	<tr>
			
			<td align="center">

<h2  style="font-size:24px;"> <?php print $fetch_school_information['institute_name'] ?></h2>
	<h3 style=" font-size:18px;"> <?php print $fetch_school_information['location'] ?></h3>
 <h3 style=" font-size:16px;">www.joypursorojini.edu.bd,01728563480</h3>
					
		</td>
	</tr>
</table>
					
					
				
				
				
			
			</div>
			<div class="menutext">
				<h5>Admit Card - Admission Test - <?php echo date('Y');?></h5>
			</div>
			
		
		<div class="admitmid" style="height: 350px; ">
			<div class="leftdiv">
				<h2 >Name</h2>
				<h2>Father's Name</h2>
				<h2>Mother's Name</h2>
				<h2>Gender</h2>
				
				<h2>Class</h2>
				
				<h2>Group</h2>
				<h2>Admission Roll</h2>
				<h2>Date of Admission Test  </h2>

				
			</div>
			
			<div class="middiv" style="width:40px; float:left; clear:right;">
					<h2>:</h2>
					<h2>:</h2>
					<h2>:</h2>
					<h2>:</h2>
				
					<h2>:</h2>
					
					<h2>:</h2>
					
					<h2>:</h2>
					<h2>:</h2>
					<p>&nbsp;</p>
			</div>
			
			
			<div class="middiv">
					<h2><?php echo $fetch_result["student_name"]?></h2>
					<h2><?php echo $fetch_result["father_name"]?></h2>
					<h2><?php echo $fetch_result["mother_name"]?></h2>
					<h2><?php echo $fetch_result["gender"]?></h2>
				
					<h2><?php echo $fetch_result["class_name"]?></h2>
					
					<h2><?php echo $fetch_result["group_name"]?></h2>
					
					<h2><?php echo $fetch_result["id"]?></h2>
					<h2></h2>
					<p>&nbsp;</p>
			</div>


			<div class="rightdiv">
				<img src="../../other_img/<?php echo $fetch_result["id"];?>.jpg" height="158" width="169" style="border:none;" />			</div>
				
				<div style=" width:180px; height:30px;float:right; margin-top:-60px; font-size:18px;"><b>....................................</b></div>
				
				<div style=" width:180px; height:30px;float:right; margin-top:-40px; font-size:18px;">Head Master</div>
				
		</div>
		
		
		<br>
		<div style="border-top:1px #999999 solid;border-left:1px #999999 solid;border-right:1px #999999 solid; width:90%; margin-top:5px;">
		<div class="downtitlediv">
	
			<h5 style="text-align:left; padding-left:15px;">General instructions for Students </h5>
		</div>
		<div class="footerdiv" style=" text-align:left; ">
			<h4 style="padding-left:20px;">
	       	1. Students will bring this admit card with them for examination.
		  <p>2. Students must enter the exam hall 30 minutes before the start of the exam.
		  <p>3. No mobile phone, digital dairy, paper and other electronics device will be allowed in the exam hall.
 
		  <p>4. 
		Students may be suspended for violation of any instruction and adoption of any unfairmeans in the exam.

		</h4>
		
		</div>
		</div>
		
		
		<div class="atediv"><b style="text-align: right; background: #f4f4f4; display: block; padding-right: 10px; font-size: 12px;">Developed By: Skill Based Information Technology (SBIT) &nbsp;&nbsp;Web : <a href="http://sbit.com.bd/" target="_blank">www.sbit.com.bd</a></b>		</div>
		</div>
	
	</div>
	<br>
	
	<input type="submit"  class="print" value="Print" name="print" onClick="window.print()" style="height:30px; width:120px;" >	
	
	</center>
</body>
</html>
