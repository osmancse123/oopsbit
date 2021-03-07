<?php
error_reporting(0);
require_once("../db_connect/config.php");
require_once("../db_connect/conect.php");
	
$db = new database();

			
			if(isset($_POST["deleterAll"]))
			{
				$stdid=$_POST["stdid"];
				$groupId=$_POST["groupId"];

				$deleteResult="DELETE FROM `result` WHERE `STD_ID`='$stdid' AND `GroupID`='$groupId'";
			    $db->select_query($deleteResult);

			    $deleteResult="DELETE FROM `marksheet` WHERE `STudentID`='$stdid' AND `GroupID`='$groupId' ";
			    $db->select_query($deleteResult);

			    $deleteResult="DELETE `gnerate_marks` WHERE `studentID`='$stdid' AND `GroupID`='$groupId'";
			    $db->select_query($deleteResult);
			}

			if(isset($_POST["sub"]))
			{
				$stdid=$_POST["stdid"];
				$groupId=$_POST["groupId"];
					$sub=$_POST["sub"];

				$deleteResult="DELETE FROM `result` WHERE `STD_ID`='$stdid' AND `GroupID`='$groupId'";
			    $db->select_query($deleteResult);

			    $deleteResult="DELETE FROM `marksheet` WHERE `STudentID`='$stdid' AND `GroupID`='$groupId' and `subjectID`='$sub'";
			    $db->select_query($deleteResult);

			    $deleteResult="DELETE `gnerate_marks` WHERE `studentID`='$stdid' AND `GroupID`='$groupId' AND `SubjectId`='$sub'";
			    $db->select_query($deleteResult);
			}

			
			

?>