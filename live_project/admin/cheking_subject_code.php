

<?php
	require_once("../db_connect/config.php");
	require_once("../db_connect/conect.php");

	$db = new database();

	@$explode=explode('and',$_REQUEST['className']);
	@$explodegroup=explode('and',$_REQUEST['groupName']);
	
	$select_subject_name="SELECT * FROM `add_subject_info` WHERE `class_id`='$explode[0]' AND `group_id`='$explodegroup[0]' AND `select_subject_type`='".$_REQUEST["sub_type"]."'
AND `id`='".$_REQUEST["subname"]."'";
	$check_name=$db->select_query($select_subject_name);
	if($check_name)
	{

		$fetch_type=$check_name->fetch_array();
		print $fetch_type[4];
	}
	else
	{
		print "";
	}
	
	
	
	?>