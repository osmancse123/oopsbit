<?php
	require_once("../db_connect/config.php");
	require_once("../db_connect/conect.php");

	$db = new database();
	@$explode=explode('and',$_REQUEST['className']);
	$select_examtype="SELECT * FROM `exam_type_info` WHERE `select_class`='$explode[0]'";
	$chek_query_exaqmtype=$db->select_query($select_examtype);

	if($chek_query_exaqmtype)
	{
		if($chek_query_exaqmtype>0)
		{
			print '<option value="" disabled selected >Select Exam Name</option>';
		}
		
		while($fetch=$chek_query_exaqmtype->fetch_array())
			{
				print "<option value='$fetch[0]and$fetch[2]'>".$fetch[2]."</option>";
			}
	}
	else
	{
			print "<option value='NullandNull'>"."Null"."</option>";
	}




?>