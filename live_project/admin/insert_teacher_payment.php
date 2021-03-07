<?php
	require_once("../db_connect/config.php");
	require_once("../db_connect/conect.php");

	$db = new database();
		$id=$db->escape($_POST['tcherId']);
		$SHsection=$db->escape($_POST['SHsection']);
		$date=$db->escape($_POST['date']);
		$paymenttitle=$db->escape($_POST['paymenttitle']);
		$payedamount=$db->escape($_POST['payedamount']);
		$monthly=date('M');
		$Years=date('Y');
		$fetch[0]=$db->autogenerat('teacher_payable_table','payment_id','TCP-','9');
		if(!empty($id) && !empty($SHsection)&& !empty($paymenttitle)&& !empty($payedamount)&& !empty($date))
		{
			$query="INSERT INTO `teacher_payable_table` (`id`,`payment_id`,`section_id`,`date`,`title`,`amount`,`month`,`year`,`user_id`) VALUES ('$id','".$fetch[0]."','$SHsection','$date','$paymenttitle','$payedamount','$monthly','$Years','1')";
			$resultisnsert=$db->insert_query($query);
			
			$fetch[0]=$db->autogenerat('teacher_payable_table','payment_id','TCP-','9');
$msg="<span class='text-center text-success glyphicon glyphicon-success'><strong>&nbsp;Payable Add Successfully</strong></span>";
			echo $msg;
		}
		else
		{
			$msg="<span class='text-center text-danger glyphicon glyphicon-remove'><strong>&nbsp;Please Fill Up TextField</strong></span>";
			echo $msg;
		}
