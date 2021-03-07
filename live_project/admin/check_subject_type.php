<?php
	require_once("../db_connect/config.php");
	require_once("../db_connect/conect.php");

	$db = new database();
	@$explode=explode('and',$_REQUEST['className']);
	@$explodegrouop=explode('and',$_REQUEST['groupName']);

	$select_group="SELECT * FROM `add_subject_info` WHERE `class_id`='$explode[0]' AND `group_id`='$explodegrouop[0]'  GROUP BY `select_subject_type`";
	
	$chek_query=$db->select_query($select_group);

	if($chek_query)
	{
		if($chek_query>0)
		{
			print '<option value="" disabled selected >Select Subject Type</option>';
		}

		while($fetch=$chek_query->fetch_array())
			{
				print "<option value='$fetch[0]and$fetch[5]'>".$fetch[5]."</option>";
			}
			
	}
	else
	{
			print "<option value='NullandNull'>"."Null"."</option>";
	}
	




?>