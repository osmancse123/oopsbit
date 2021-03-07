<!-- 
351905190001
311609100003
Annual Exam.
351905190002
311609110004
Annual Exam.
351905190003
311609230005
Annual Exam.
351905190004
311609230006
Annual Exam.
351905190005
311609230007
Test Exam.
351905250006
311609230007
Pre-Test Exam.
351905250007
311609100003
Half yearly Exam.
351905250009
311609110004
Half yearly Exam.
351905250010
311609230005
Half yearly Exam.
351905250011
311609230006
Half yearly Exam. -->

<?php
	error_reporting(1);
	require_once("../db_connect/config.php");
	require_once("../db_connect/conect.php");

	$db = new database();
	$prefix=date("y"."m"."d");
	$idd=$db->withoutPrefix('subject_information','SubInfoID',"38".$prefix,'12');

if(isset($_POST["Submit"]))
{


$select="select `SubInfoID`,`classID`,`examID`,`groupID`,`subjectId`,`subPartId`,`ContAss`,`Creative`,`MCQ`,`practical`,`total` from subject_information where `classID`='311609230007' AND `examID`='351905190005'";
$selectdata=$db->select_query($select);

while($fetch=$selectdata->fetch_array())
{
	// print "<pre>";
	// print_r($fetch);

	$sql ="INSERT INTO `subject_information` (`SubInfoID`,`classID`,`examID`,`groupID`,`subjectId`,`subPartId`,`ContAss`,`Creative`,`MCQ`,`practical`,`total`) VALUES ('$idd','$fetch[1]','351905250006','$fetch[3]','$fetch[4]','$fetch[5]','$fetch[6]','$fetch[7]','$fetch[8]','$fetch[9]','$fetch[10]')";
	//print $sql;
		$result=$db->insert_query($sql);
		
			$idd=$db->withoutPrefix('subject_information','SubInfoID',"38".$prefix,'12');



}





 }




?>

<!DOCTYPE html>
<html>
<head>
	<title> </title>
</head>
<body>
<form method="post">
	<input type="submit" name="Submit" value="Submit">
</form>
</body>
</html>