<?php
	require_once("../db_connect/config.php");
	require_once("../db_connect/conect.php");

	$db = new database();
	@$explode=explode('and',$_REQUEST['className']);
	@$explodegroup=explode('and',$_REQUEST['group_name']);
	$select_group="SELECT * FROM `add_subject_info` WHERE `class_id`='$explode[0]' AND `group_id`='$explodegroup[0]' AND `select_subject_type`='GroupSubject'";
	$chek_query=$db->select_query($select_group);

	if($chek_query)
	{
		

		while($fetch=$chek_query->fetch_array())
			{
				print "<input value=".$fetch[0].'codenumber'.$fetch[3]." type='checkbox' name='selective[]' class='slsub'>"."&nbsp;"."<span class='text-info' style='font-size:15px;font-weight:bold;'>".$fetch[3]."&nbsp;"."(".$fetch[4].")"."</span>"."<br/>"."</input>";
			}
	}
	
	




?>