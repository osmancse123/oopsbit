<?php
	require_once("../db_connect/config.php");
	require_once("../db_connect/conect.php");

	$db = new database();
	@$explode=explode('and',$_REQUEST['className']);
	@$explodegroup=explode('and',$_REQUEST['groupName']);
	$slect_section="SELECT * FROM `add_section` WHERE `class_id`='$explode[0]' AND `group_id`='$explodegroup[0]'";
	$chek_query=$db->select_query($slect_section);

	if($chek_query)
	{
		if($chek_query>0)
		{
			print '<option value="" disabled selected >Select Section</option>';
		}

		while($fetch=$chek_query->fetch_array())
			{
				print "<option value='$fetch[0]and$fetch[3]'>".$fetch[3]."</option>";
			}
	}
	else
	{
			print "<option value='NullandNull'>"."Null"."</option>";
	}
	




?>