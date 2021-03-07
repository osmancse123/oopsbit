<?php

	error_reporting(1);
	require_once("../db_connect/config.php");
	require_once("../db_connect/conect.php");
    date_default_timezone_set('Asia/Dhaka');

	$db = new database();
	global $msg;
	
		 $presentrecorddd = "SELECT `running_student_info`.*,`add_class`.`class_name`,`add_group`.`group_name`,`student_personal_info`.`father_name`,`student_name`,`student_acadamic_information`.`session2`
FROM `running_student_info` INNER JOIN `add_class` ON `add_class`.`id`=`running_student_info`.`class_id`
INNER JOIN `add_group` ON `add_group`.`id`=`running_student_info`.`group_id` INNER JOIN `student_personal_info`
ON `student_personal_info`.`id`=`running_student_info`.`student_id` INNER JOIN `student_acadamic_information`
ON `student_acadamic_information`.`id`=`running_student_info`.`student_id`  WHERE `running_student_info`.`class_id`='".$_GET["clID"]."' 
AND `running_student_info`.`group_id`='".$_GET["gpna"]."' AND `student_acadamic_information`.`session2`='".$_GET["session"]."'
AND `running_student_info`.`class_roll`  BETWEEN '".$_GET["stdRollfrom"]."' AND '".$_GET["stdRollto"]."' ORDER BY `running_student_info`.`class_roll` ASC LIMIT 1";
	$resultPreRecorddd =  $db->select_query($presentrecorddd);
		if($resultPreRecorddd->num_rows > 0){
			$fetchpreRecorddd = $resultPreRecorddd->fetch_array();
		}
		
	$ProjectInfo="SELECT * FROM `project_info`";
		$resultProjectInfo = $db->select_query($ProjectInfo);
			if($resultProjectInfo->num_rows > 0){
					$fetchProjectInfo = $resultProjectInfo->fetch_array();
			}
?>
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
<table width="927" height="193" border="1" cellpadding="0" cellspacing="0" align="center" style="margin-top:10px;">
  
  <tr >
  	
    <td height="76" colspan="9" align="center">&nbsp;
	<div align="center" style="margin-left:250px;">
	<div style="float:left; clear:right"><img src="all_image/joyput.jpg" style="height:50px; width:50px; " /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
	<div style="float:left">
			<strong><span style="font-size:22px; font-family:Arial, Helvetica, sans-serif" class="text-success"><?php
				if(isset($fetchProjectInfo)){
					echo $fetchProjectInfo["institute_name"];
				}else {
					echo "";
				}
			?></span></strong><br/>
			<strong><span style="font-size:16px;" class="text-success"><?php
				if(isset($fetchProjectInfo)){
					echo $fetchProjectInfo["location"];
				}else {
					echo "";
				}
			?></span><br/></strong>
	<strong><span style="font-size:16px;" class="text-success">Students' List </span></strong></div></div>	</td>
   </tr>
  <tr align="">
    <td height="21" colspan="9">&nbsp;<strong>Present Session &nbsp; : &nbsp; <?php  if(isset($fetchpreRecorddd)) { echo $fetchpreRecorddd["session2"]; } else { echo ""; }  ?> <span style="padding-left:200px;">Class &nbsp; : &nbsp;<?php if(isset($fetchpreRecorddd)) { echo $fetchpreRecorddd["class_name"]; } else { echo ""; }  ?></span><?php if($fetchpreRecorddd["group_name"] 
	!="Null" && $fetchpreRecorddd["group_name"] 
	!="null" ) {?><span  style="padding-left:200px;">Group &nbsp; :&nbsp; <?php if(isset($fetchpreRecorddd)) { 
	
	
	echo $fetchpreRecorddd["group_name"]; } else { echo ""; }  ?></span><?php } ?></strong></td>
   </tr>
  <tr align="center">
    <td width="84" height="24">ID No. </td>
    <td width="202">Student's Name </td>
    <td width="208">Father's Name </td>
    <td width="96">Previous Session </td>
    <td width="66">Previous Class </td>
    <td width="79">Previous Group </td>
    <td width="66">Previous Roll </td>
    <td width="60">Present Roll </td>
    <td width="46">Reg. Sub. </td>
  </tr>
  <?php
  			
				$presentrecord = "SELECT `running_student_info`.*,`add_class`.`class_name`,`add_group`.`group_name`,`student_personal_info`.`father_name`,`student_name`,`student_acadamic_information`.`session2`
FROM `running_student_info` INNER JOIN `add_class` ON `add_class`.`id`=`running_student_info`.`class_id`
INNER JOIN `add_group` ON `add_group`.`id`=`running_student_info`.`group_id` INNER JOIN `student_personal_info`
ON `student_personal_info`.`id`=`running_student_info`.`student_id` INNER JOIN `student_acadamic_information`
ON `student_acadamic_information`.`id`=`running_student_info`.`student_id`  WHERE `running_student_info`.`class_id`='".$_GET["clID"]."' 
AND `running_student_info`.`group_id`='".$_GET["gpna"]."' AND `student_acadamic_information`.`session2`='".$_GET["session"]."'
AND `running_student_info`.`class_roll`  BETWEEN '".$_GET["stdRollfrom"]."' AND '".$_GET["stdRollto"]."' ORDER BY `running_student_info`.`class_roll` ASC";
	$resultPreRecord =  $db->select_query($presentrecord);
		if($resultPreRecord->num_rows > 0){
			while($fetchpreRecord = $resultPreRecord->fetch_array()){
		
  ?>
  
  <?php
   		$preViousRecord =  "SELECT `student_academic_record`.*,`add_class`.`class_name`,`add_group`.`group_name` FROM `student_academic_record`
INNER JOIN `add_class` ON `add_class`.`id`=`student_academic_record`.`class_id` INNER JOIN `add_group`
ON `add_group`.`id`=`student_academic_record`.`groupID` WHERE `student_academic_record`.`student_id`='".$fetchpreRecord["student_id"]."'";
	$resultPReviousRecord = $db->select_query($preViousRecord);
		if($resultPReviousRecord->num_rows > 0){
				$fetchRecord =$resultPReviousRecord->fetch_array();
		}
   
   ?>	
  <tr align="center">
    <td height="21"> <?php if(isset($fetchpreRecord)) { 
	
	
	echo $fetchpreRecord["student_id"]; } else { echo ""; }  ?></td>
    <td> <?php if(isset($fetchpreRecord)) { 
	
	
	echo $fetchpreRecord["student_name"]; } else { echo ""; }  ?></td>
    <td> <?php if(isset($fetchpreRecord)) { 
	
	
	echo $fetchpreRecord["father_name"]; } else { echo ""; }  ?></td>
    <td><?php 
			if(isset($fetchRecord)){
				echo $fetchRecord["session"];
			}else {
				echo "";
			}
	?></td>
   	
   
    <td>   <?php 
			if(isset($fetchRecord)){
				echo $fetchRecord["class_name"];
			}else {
				echo "";
			}
	?></td>
    <td>  <?php 
			if(isset($fetchRecord)){
				echo $fetchRecord["group_name"];
			}else {
				echo "";
			}
	?> </td>
    <td>  <?php 
			if(isset($fetchRecord)){
				echo $fetchRecord["class_roll"];
			}else {
				echo "";
			}
	?></td>
    <td>    <?php if(isset($fetchpreRecord)) { 
	
	
	echo $fetchpreRecord["class_roll"]; } else { echo ""; }  ?></td>
	<?php 
												$sql333="SELECT COUNT(`subject_id`) FROM `subject_registration_table` WHERE `std_id`='".$fetchpreRecord["student_id"]."'";
												$chek9=$db->select_query($sql333);
												if($chek9){$r333=$chek9->fetch_array();} 
											?>
    <td>&nbsp;<?php echo $r333[0];?></td>
  </tr>
  <?php  } }?>
   <tr class="noneBtnForprin">
  	
    <td height="33" colspan="9" align="center">&nbsp;
	<input type="button" class="btn btn-sm btn-danger" onclick="window.print()" value ="PRINT"/>	</td>
   </tr>
</table>