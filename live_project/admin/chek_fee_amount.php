<?php
	require_once("../db_connect/config.php");
	require_once("../db_connect/conect.php");

	$db = new database();
	$fee_id=$_REQUEST['FEE_id'];
	$student_id=$_REQUEST['std_di'];
	$select_amount="SELECT `add_fee`.`amount` FROM `student_account_info` INNER JOIN `add_fee` ON `student_account_info`.`fee_id`=`add_fee`.`id`
WHERE `student_account_info`.`fee_id`='$fee_id' AND `student_account_info`.`studentID`='$student_id'";
	$chek_Amount=$db->select_query($select_amount);
	if($chek_Amount)
	{
		$feth_amount=$chek_Amount->fetch_array();
		print $feth_amount[0];
	}


	?>