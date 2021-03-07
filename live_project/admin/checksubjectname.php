<?php
	require_once("../db_connect/config.php");
	require_once("../db_connect/conect.php");

	$db = new database();
	@$explode=explode('and',$_REQUEST['className']);
	@$explodegrouop=explode('and',$_REQUEST['groupName']);
	@$explode_sub_name=explode('and', $_REQUEST['stubjectype']);

	$select_group="SELECT `id`,`subject_name` FROM `add_subject_info` WHERE `class_id`='".$explode[0]."' AND `group_id`='".$explodegrouop[0]."' AND `select_subject_type`='".$explode_sub_name[1]."'";
$select_subject="SELECT `id`,`subject_name` FROM `add_subject_info` WHERE `class_id`='".$explode[0]."' AND  `select_subject_type`='".$explode_sub_name[1]."'";
	$chek_query=$db->select_query($select_group);
	$chek_subejct=$db->select_query($select_subject);

	if($chek_query)
	{
		if($chek_query>0)
		{
			print '<option value="" disabled selected >Select Subject Type</option>';
		}

		while($fetch=$chek_query->fetch_array())
			{
				print "<option value='$fetch[0]and$fetch[1]'>".$fetch[1]."</option>";
			}
	}
	else if($chek_subejct)
	{
		if($chek_subejct>0)
		{
			print '<option value="" disabled selected >Select Subject Type</option>';
		}

		while($fetchll=$chek_subejct->fetch_array())
			{
				print "<option value='$fetchll[0]andfetchll$fetchll[1]'>".$fetchll[1]."</option>";
			}
	}
	else
	{
			print "<option value='NullandNull'>"."Null"."</option>";
	}
	




?>