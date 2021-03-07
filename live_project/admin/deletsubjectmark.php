  <?php
	error_reporting(1);
	require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
	date_default_timezone_set("Asia/Dhaka");
	$db = new database();
	
			if(isset($_POST["deltesub"])){
					
							$deletmarks = "DELETE FROM `marksheet` WHERE `STudentID`='".$_POST["stid"]."' AND `ClassId`='".$_POST["clsid"]."' AND `GroupID`='".$_POST["gpid"]."' AND `ExamId`='".$_POST["ExamId"]."' AND `SubjectId`='".$_POST["SubjectId"]."' AND `SubjectPartID`='".$_POST["SubjectPartID"]."'
AND `Session`='".$_POST["gpid"]."'";
							$db->delete_query($deletmarks );
			
			}
	?>