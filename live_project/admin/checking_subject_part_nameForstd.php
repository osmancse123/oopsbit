

<?php
	require_once("../db_connect/config.php");
	require_once("../db_connect/conect.php");

	$db = new database();

	@$explode=$_REQUEST['className'];
	@$explodegroup=explode('and',$_REQUEST['groupName']);
	
	 $select_subject_name="SELECT * FROM `add_subject_part_info` WHERE `class_id`='$explode' AND `group_id`='$explodegroup[0]' AND `subject_name`='".$_REQUEST["sub_name"]."' ORDER BY `subject_part_name` ASC";
	$check_name=$db->select_query($select_subject_name);
	if($check_name)
	{

		while($fetch_type=$check_name->fetch_array())
		{
			print "<option value='$fetch_type[0]'>".$fetch_type[5]."</option>";		
		}
	}
	else
	{
		print "<option value='NULL'>".Null."</option>";	
	}
	
	
	?>