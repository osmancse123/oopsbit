<?php
	error_reporting(1);
@session_start();
@date_default_timezone_set('Asia/Dhaka');
require_once("../../db_connect/config.php");
	require_once("../../db_connect/conect.php");

	$db = new database();

   $sql ="SELECT `running_student_info`.*,`student_personal_info`.`student_name`,`father_name`,`mother_name`,`gender`,
`add_class`.`class_name`,`add_group`.`group_name`,`student_acadamic_information`.`session2` FROM  `running_student_info` INNER JOIN `student_personal_info`
ON `student_personal_info`.`id`=`running_student_info`.`student_id` INNER JOIN `add_class`
ON `add_class`.`id`=`running_student_info`.`class_id` INNER JOIN `add_group` ON `add_group`.`id`=`running_student_info`.`group_id`
INNER JOIN `student_acadamic_information` ON `student_acadamic_information`.`id`=`running_student_info`.`student_id`
WHERE `running_student_info`.`class_id`='".$_GET["clID"]."' AND `running_student_info`.`group_id`='".$_GET["gpna"]."' AND `running_student_info`.`student_id`='".$_GET["stdRoll"]."'";
	$result =  $db->select_query($sql);
		if($result->num_rows > 0){
			$fetch_result = $result->fetch_array();
		}
		
		$selectExamName = "SELECT `exam_type` FROM `exam_type_info` WHERE `exam_id`='".$_GET["exId"]."' AND `select_class`='".$_GET["clID"]."'";
		$resultForName  = $db->select_query($selectExamName);
			if($resultForName->num_rows  > 0)
					{
					$fetchColass = $resultForName->fetch_array();
					
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
		<link rel="shortcut icon" href="../all_image/<?php echo "shortcurt_iconSDMS2015";?>.png" />
</head>
<link rel="stylesheet" href="admit.css" />
<style>
	@media print{
			.noneBtnForprin{
				display:none;
			}
			#dont{
				display:none;
			}
			.dontprint{
			display:none;
			}
			@page 
			{
				size:  auto;   /* auto is the initial value */
				margin: 0mm;  /* this affects the margin in the printer settings */
			}
		
			html
			{
				background-color: #FFFFFF; 
				margin: 0px;  /* this affects the margin on the html before sending to printer */
			}
		
			body
			{
				border: solid 0px blue ;
				margin: 10mm 15mm 10mm 15mm; /* margin you want for the content */
			}
		}
</style>
<body>
<center>

		<div class="admitbody">
			<div class="admitheader"  > 
				<div class="headerimg" ><img src="../all_image/logoSDMS2015.png"  style="height:100%; width:100%l; 	"/></div>
				<div class="headertext" style="text-align:center; ">
					<table style="width:100%">
							<tr align="center">
								<td> <div style="padding-left:110px;">
								 <h2  style="font-size:30px;"> <?php print $fetch_school_information['institute_name'] ?></h2>
					  <h3 style="padding-left:55px; font-size:18px;"> <?php print $fetch_school_information['location'] ?></h3>
					 <h3 style="padding-left:80px; font-size:24px;"> Admit Card</h3>
								</div></td>
							</tr>
					</table>
					
					
				</div>
				
				
			
			</div>
			<div class="menutext">
				<h5><?php echo $fetchColass["exam_type"];?> - <?php echo date('Y');?></h5>
			</div>
			
		
		<div class="admitmid">
			<div class="leftdiv">
				<h2>Name</h2>
				<h2>Father's Name</h2>
				<h2>Mother's Name</h2>
				<h2>Gender</h2>
				
				<h2>Class</h2>
				<?php
					
							if($fetch_result["group_name"] != "Null"){
					?>
				<h2>Group</h2>
				<?php } ?>
				<h2>Roll No</h2>
				<h2>Student ID</h2>
				
			</div>
			
			<div class="middiv" style="width:40px; float:left; clear:right;">
					<h2>:</h2>
					<h2>:</h2>
					<h2>:</h2>
					<h2>:</h2>
				
					<h2>:</h2>
					
					<h2>:</h2>
					<?php
					
							if($fetch_result["group_name"] != "Null"){
					?>
					<h2>:</h2>
					<h2>:</h2>
					<?php  }?>
					<p>&nbsp;</p>
			</div>
			
			
			<div class="middiv">
					<h2><?php echo $fetch_result["student_name"]?></h2>
					<h2><?php echo $fetch_result["father_name"]?></h2>
					<h2><?php echo $fetch_result["mother_name"]?></h2>
					<h2><?php echo $fetch_result["gender"]?></h2>
				
					<h2><?php echo $fetch_result["class_name"]?></h2>
					<?php
					
							if($fetch_result["group_name"] != "Null"){
					?>
					<h2><?php echo $fetch_result["group_name"]?></h2>
					<?php } ?>
					<h2><?php echo $fetch_result["class_roll"]?></h2>
					
					<h2><?php echo $fetch_result["student_id"]?></h2>
					
					
					
					<p>&nbsp;</p>
			</div>
			<div class="rightdiv">
				<img src="../../other_img/<?php echo $fetch_result["student_id"];?>.jpg" height="171" width="150" style="border:none;" />			</div>
				
				<div style="width:200px; height:30px;float:left; margin-top:-40px; padding-left:10px;  font-size:18px; text-align:center"> <span><strong>Issue Date : <?php echo date('d/m/Y')?></span></strong> </div>
				<div style=" width:150px; height:30px;float:left; margin-top:-60px; padding-left:420px; font-size:18px;"><br/><strong>Office Assistant</strong></div>
				<div style=" width:150px; height:30px;float:right; margin-top:-60px; font-size:18px;"><br/><strong>Head Master</strong></div>
				
		</div>
		
		
			
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
		
		<div class="atediv"  style="background:#B7AAA6;padding-top:5px;"><b style="text-align: center;  font-size: 16px; padding-left:12px;">Web : presidencyschool.edu.bd, &nbsp;&nbsp;Mobile: <?php print $fetch_school_information['phone_number'] ?>,&nbsp;&nbsp;&nbsp;&nbsp;Email:<?php print $fetch_school_information['email'] ?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b style="text-align: right; background: #f4f4f4;  font-size: 12px;"></b>		</div>
		</div>
	
	</div>
	<br>
	
	<input type="submit"  class="noneBtnForprin" value="Print" name="print" onClick="window.print()" style="height:30px; width:120px;" >	
	
	</center>
</body>
</html>
