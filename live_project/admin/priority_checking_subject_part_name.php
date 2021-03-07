

<?php
session_start();
	require_once("../db_connect/config.php");
	require_once("../db_connect/conect.php");

	$db = new database();

	@$explode=explode('and',$_REQUEST['className']);
	@$explodegroup=explode('and',$_REQUEST['groupName']);
	 @$examtype=explode('and',$_REQUEST['examtype']);

	
		 $select_subject_name="SELECT * FROM `add_subject_part_info` WHERE `class_id`='$explode[0]' AND `group_id`='$explodegroup[0]' AND `subject_name`='".$_REQUEST["sub_name"]."' AND `exam_type`='$examtype[0]' ORDER BY `subject_part_name` ASC";
	
	

	


	$check_name=$db->select_query($select_subject_name);
	if($check_name)
	{
	if($check_name>0)
		{
			print '<option value="" disabled selected >Select Name</option>';
		}
		while($fetch_type=$check_name->fetch_array())
		{
			print "<option value='$fetch_type[5]'>".$fetch_type[5]."</option>";		
		}
	}
	else
	{
		print "<option value='NULL'>".Null."</option>";	
	}
	
	
	?>