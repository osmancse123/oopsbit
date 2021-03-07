<!-- SubjectPriorityAdd.php -->

<?php

	require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
	date_default_timezone_set("Asia/Dhaka");
	$db = new database();

	if(isset($_POST["add"]))
	{
		if(!empty($_POST["groupname"]) && !empty($_POST["section"]))
		{

		$group=explode("and", $_POST["groupname"]);
		$section=explode("and", $_POST["section"]);

		$insert="INSERT INTO `subject_priority` (`user`,`class`,`group`,`section`,`subjectName`,`SubjectPart`) VALUES('".$_POST["selectUser"]."','".$_POST["className"]."','".$group[0]."','".$section[0]."','".$_POST["sub_name"]."','".$_POST["part_name"]."')";

    	$db->insert_query($insert);

    	print "Insert Successfully!!";
    	
       }

	}
	if(isset($_POST["del"]))
	{
		$id=$_POST["id"];
	

		$del="DELETE FROM `subject_priority` where id='$id'";

    	$db->select_query($del);

    	print "Delete Successfully!!";


	}

	if(isset($_POST['view']))
	{
		$selectUser=$_POST["selectUser"];
		//print $selectUser;
		$sql="SELECT  `subject_priority`.*,`admin_users`.`Name` FROM `subject_priority` INNER JOIN `admin_users` ON `admin_users`.`id`= `subject_priority`.`user` WHERE  `user`='$selectUser'  GROUP BY `class`";

		$query=$db->select_query($sql);
		if($query)
		{
			$fetch=$query->fetch_array();
		
		
		?>


			<table class="table table-bordered">
					<tr>
							<td colspan="7"> <?php print $fetch['Name']?> </td>
					</tr>

					<?php
					$sql="SELECT  `subject_priority`.*,`admin_users`.`Name` FROM `subject_priority` INNER JOIN `admin_users` ON `admin_users`.`id`= `subject_priority`.`user` WHERE  `user`='$selectUser'  GROUP BY `class`";
	
								$query=$db->select_query($sql);

					if($query)
							{
								
								while($fetch=$query->fetch_array())
								{

								$selectClass="SELECT `add_class`.`class_name` FROM `add_class` WHERE `id`='".$fetch['class']."'";
								$queryClass=$db->select_query($selectClass);
								if($queryClass)
								{
									$fetchClassName=$queryClass->fetch_array();
								}
		

		
					?>
					<tr>
							<td colspan="7" align="center"> <?php print $fetchClassName[0]; ?></td>
					</tr>


	<tr>
							<td>SL</td> 
							<td>Subject Code</td>
							<td>Subject Name</td>
							<td>Part Name</td>
							<td>Group</td>
							<td>Section</td>
							<td>Action</td>
							

							
					</tr>

					<?php
					$selectSubName="
SELECT `add_subject_info`.`subject_code`,`add_subject_info`.`subject_name`,`add_group`.`group_name`,`add_section`.`section_name`,`subject_priority`.`SubjectPart`,subject_priority.`id` FROM `subject_priority` 
INNER JOIN `add_subject_info` ON `add_subject_info`.`id`=`subject_priority`.`subjectName`
INNER JOIN `add_section` ON `add_section`.`id`=`subject_priority`.`section`
INNER JOIN `add_group` ON `add_group`.`id`=`subject_priority`.`group`
WHERE `subject_priority`.`user`='$selectUser'  AND  `subject_priority`.`class`='".$fetch['class']."'   ORDER BY  `add_subject_info`.`serial` ASC";
	$querysubjectName=$db->select_query($selectSubName);

					if($querysubjectName)
							{
								$i=0;
								while($fetchSubName=$querysubjectName->fetch_array())
								{
									$i++;


					?>
					<tr>
							<td><?php print $i; ?></td> 
							<td><?php print $fetchSubName[0]; ?></td>
							<td><?php print $fetchSubName[1]; ?></td>
								<td>
									<?php 
										print $fetchSubName['SubjectPart'];
									 ?>

								</td>
							<td><?php print $fetchSubName[2]; ?></td>
						
							<td><?php print $fetchSubName[3]; ?></td>
							<td><a href="#" class="btn btn-danger" onclick="confirmDelete(<?php print $fetchSubName[5];?>)"> Delete </a></td>
							

							
					</tr>
					<?php
				}
			}
				}
			}
				?>

			</table>

<?php
	}
}


?>