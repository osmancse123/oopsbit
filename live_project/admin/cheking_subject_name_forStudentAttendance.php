

<?php
	require_once("../db_connect/config.php");
	require_once("../db_connect/conect.php");

	$db = new database();

		@$explode=$_POST['className'];
	@$explodegroup=explode('and',$_REQUEST['groupName']);
	
	print $select_subject_name="SELECT * FROM `add_subject_info` WHERE `class_id`='$explode' AND `group_id`='$explodegroup[0]' ORDER BY `subject_name` ASC";
	$check_name=$db->select_query($select_subject_name);
	
	if($check_name)
	{
	if($check_name>0)
		{
			print '<option value="" disabled selected >Select Name</option>';
		}
		while($fetch_type=$check_name->fetch_array())
		{
			print "<option value='$fetch_type[0]'>".$fetch_type[3]."</option>";		
		}
	}
	else
	{
		print "<option value='NULL'>"."Null"."</option>";	
	}
	
	
	?>