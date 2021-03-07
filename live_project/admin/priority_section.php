

<?php
error_reporting(1);
session_start();
	require_once("../db_connect/config.php");
	require_once("../db_connect/conect.php");

	$db = new database();
	@$explode=explode('and',$_REQUEST['className']);
	@$explodegroup=explode('and',$_REQUEST['groupName']);
	
			if($_SESSION["type"]!="Main Admin")
			{
				if(isset($_POST["partName"]))
					{
						//print $_POST["partName"];

						$part=explode('and',$_POST["partName"]);

				$selectSection="SELECT `subject_priority`.`section`,`add_section`.`section_name` FROM `subject_priority`
INNER JOIN `add_section` ON `add_section`.`id`=`subject_priority`.`section` WHERE `class`='$explode[0]' AND  `SubjectPart`='$part[1]' AND `group`='$explodegroup[0]' AND `subjectName`='".$_POST["subname"]."' AND `user`='".$_SESSION["id"]."'";


					}
					else
					{
								
				$selectSection="SELECT `subject_priority`.`section`,`add_section`.`section_name` FROM `subject_priority`
INNER JOIN `add_section` ON `add_section`.`id`=`subject_priority`.`section` WHERE `class`='$explode[0]' AND
 `group`='$explodegroup[0]' AND `subjectName`='".$_POST["subname"]."' AND `user`='".$_SESSION["id"]."'";

					}
										

						$check_section=$db->select_query($selectSection);
						if($check_section)
						{
							while($fetch_section=$check_section->fetch_array())
							{
									print "<option value='$fetch_section[0]and$fetch_section[1]'>".$fetch_section[1]."</option>";	
							}

						}

			}

			else
			{

						
						$selectSection="SELECT * FROM `add_section` WHERE `class_id`='$explode[0]' AND `group_id`='$explodegroup[0]'";
						//print $selectSection;

						$check_section=$db->select_query($selectSection);
						if($check_section)
						{
							while($fetch_section=$check_section->fetch_array())
							{
									print "<option value='$fetch_section[0]and$fetch_section[3]'>".$fetch_section[3]."</option>";	
							}

						}
			}

	
	
	
	?>