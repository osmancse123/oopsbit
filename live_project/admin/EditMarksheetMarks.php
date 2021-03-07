<?php
	error_reporting(1);
	require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
	$db = new database();
	
	$xlassID=explode('and',$_POST["CLiD"]);
	$groupID=explode('and',$_POST["GRid"]);
	$xount=count($_POST["stdrole"]);
	for($x=0; $x<$xount; $x++){
	if($_POST["lettergrade"][$x] =="A+")
          {
            $grdepoint[$x]="5.00";
          }
          else if($_POST["lettergrade"][$x] =="A")
          {
            $grdepoint[$x]="4.00";
          }   
          else if($_POST["lettergrade"][$x] =="A-")
          {
            $grdepoint[$x]="3.50";
          }
           else if($_POST["lettergrade"][$x]=="B")
          {
            $grdepoint[$x]="3.00";
          }   
          else if($_POST["lettergrade"][$x]=="C")
          {
            $grdepoint[$x]="2.00";
          } 
          else if($_POST["lettergrade"][$x]=="D")
          {
            $grdepoint[$x]="1.00";
          }
          else
          {
            $grdepoint[$x]="0.00";
            $_POST["lettergrade"][$x]="F";
          }
		  if($_POST["subPna"] == "NULL")
		  {
		  	$chek_query="SELECT * FROM `marksheet` WHERE `STudentID`='".$_POST["stdid"][$x]."' AND StudentRoll='".$_POST["stdrole"][$x]."' AND `ClassId`='$xlassID[0]' AND `GroupID`='$groupID[0]' AND `ExamId`='".$_POST["exType"]."' AND `SubjectId`='".$_POST["subNa"]."'  AND `Session`='".$_POST["seSs"]."'";
		  }
		  else{
		  $chek_query="SELECT * FROM `marksheet` WHERE `STudentID`='".$_POST["stdid"][$x]."' AND StudentRoll='".$_POST["stdrole"][$x]."' AND `ClassId`='$xlassID[0]' AND `GroupID`='$groupID[0]' AND `ExamId`='".$_POST["exType"]."' AND `SubjectId`='".$_POST["subNa"]."' AND `SubjectPartID`='".$_POST["subPna"]."' AND `Session`='".$_POST["seSs"]."'";
		  }
		  $chcek_query=$db->select_query($chek_query);
		  if($chcek_query){
		  $sql="REPLACE INTO `marksheet` (`STudentID`,`StudentRoll`,`ClassId`,`GroupID`,`ExamId`,`SubjectId`,`SubjectPartID`,`Session`,`Count_Ass`,`Creative`,`Mcq`,`Practical`,`obtainMark`,`LetterGrade`,`GradePoint`) values ('".$_POST["stdid"][$x]."','".$_POST["stdrole"][$x]."','$xlassID[0]','$groupID[0]','".$_POST["exType"]."','".$_POST["subNa"]."','".$_POST["subPna"]."','".$_POST["seSs"]."','".$_POST["counAssMark"][$x]."','".$_POST["CreaTiveMark"][$x]."','".$_POST["MeqMark"][$x]."','".$_POST["practicalMark"][$x]."','".$_POST["obtainmark"][$x]."','".$_POST["lettergrade"][$x]."','$grdepoint[$x]')";
		$db->update_query($sql);
		}
		
		
}
if(isset($db->sms))
{
	print $db->sms;
}
?>