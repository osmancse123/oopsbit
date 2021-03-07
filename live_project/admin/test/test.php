

<?php
	error_reporting(1);
	require_once("../../db_connect/config.php");
	require_once("../../db_connect/conect.php");
				
				
				$db = new database();
				 $sql2="SELECT * FROM `subject_registration_table` WHERE  `class_id`='311611180002' AND `group_id`='321611180004' GROUP BY `subject_registration_table`.`std_id`";
					$chke6=$db->select_query($sql2);
					if($chke6){
						while($fetch_all=$chke6->fetch_array()){
						$ins = "INSERT INTO `subject_registration_table` VALUES('$fetch_all[0]','311611180002','321611180004','361711200085')";
		$db->update_query($ins);
					}
					}
					
	?>