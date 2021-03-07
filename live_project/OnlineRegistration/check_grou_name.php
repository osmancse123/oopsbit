<?php
	require_once("../db_connect/config.php");
	require_once("../db_connect/conect.php");

	$db = new database();
	@$explode=explode('and',$_REQUEST['className']);
	$select_group="SELECT * FROM `add_group` WHERE `class_id`='$explode[0]'";
	$chek_query=$db->select_query($select_group);

	if($chek_query)
	{
		if($chek_query>0)
		{
			print '<option value="" disabled selected >Select Group</option>';
		}

		while($fetch=$chek_query->fetch_array())
			{
				print "<option value='$fetch[0]and$fetch[2]'>".$fetch[2]."</option>";
			}
	}
	else
	{
			print "<option value='NullandNull'>"."Null"."</option>";
	}
	




?>