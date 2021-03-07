<?php
	require_once("../db_connect/config.php");
	require_once("../db_connect/conect.php");

	$db = new database();
	@$explode=explode('and',$_REQUEST['className']);
	$select_group="SELECT * FROM `instrumentsetup` WHERE `fk_cl_id`='$explode[0]'";
	$chek_query=$db->select_query($select_group);

	if($chek_query)
	{
		if($chek_query>0)
		{
			print '<option>Select One</option>';
				print '<option>ALL</option>';
		}

		while($fetch=$chek_query->fetch_array())
			{
				print "<option value='$fetch[0]'>".$fetch[1]."</option>";
			}
	}
	else
	{
					print '<option>Select One</option>';
				print '<option>ALL</option>';
	}
	




?>