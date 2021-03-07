

<?php
	require_once("../db_connect/config.php");
	require_once("../db_connect/conect.php");

	$db = new database();

	@$explode=explode('and',$_REQUEST['className']);
	@$explodegroup=explode('and',$_REQUEST['groupName']);
	
	$slectype="SELECT * FROM `add_subject_info` WHERE `class_id`='$explode[0]' AND `group_id`='$explodegroup[0]' GROUP BY `select_subject_type` ORDER BY `select_subject_type` ASC";
	$check_type=$db->select_query($slectype);
	if($check_type)
	{
	if($check_type > 0)
		{
			print '<option value="" disabled selected >Select Type</option>';
		}
		while($fetch_type=$check_type->fetch_array())
		{
			print "<option value='$fetch_type[5]'>".$fetch_type[5]."</option>";		
		}
	}
	else
	{
		print "<option value='NULL'>"."Null"."</option>";	
	}
	
	
	?>