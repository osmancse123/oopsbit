<?php
	require_once("../db_connect/config.php");
	require_once("../db_connect/conect.php");
	$db = new database();

	$id = $_POST["id"];
	$sql = "SELECT `student_personal_info`.`student_name`,`religious`,`student_acadamic_information`.`session2` FROM `student_personal_info` 
INNER JOIN `student_acadamic_information` ON `student_acadamic_information`.`id`=`student_personal_info`.`id` WHERE `student_personal_info`.`id`='$id'";
	$result = $db->select_query($sql);
	if($result){
			$fetch=$result->fetch_assoc();
			//$a  = array('name' =>$fetch['student_name'],'Sess'=>$fetch['session2']);
			//$msg=json_encode($a);
			$msg = $fetch['student_name'].'/'.$fetch['session2'].'/'.$fetch['religious'];
			echo $msg;
			
	
	}
	
	
?>