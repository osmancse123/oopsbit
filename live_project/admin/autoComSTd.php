<?php
	error_reporting(1);
	require_once("../db_connect/config.php");
	require_once("../db_connect/conect.php");
	$db = new database();
	
if(isset($_POST["autoID"])){
		$o = '';
		$sql ="SELECT * FROM `student_personal_info` WHERE `id` LIKE '%".$_POST["autoID"]."%' ORDER BY `id` DESC";
		$result = $db->select_query($sql);
		$o = '<ul class="list-unstyled">';
		if($result){
		if(mysqli_num_rows($result)>0){
				while($fetch=$result->fetch_array()){
					$o.='<li>'.$fetch[0].'</li>';
				}
		}
		else {
			$o.='<li>Student Not found</li>';
		}
		}
		$o.='</ul>';
		echo $o;
	}
	
	if(isset($_POST["forMiss"])){
			$o = '';
		$sql ="SELECT * FROM `marksheet`  WHERE `STudentID` LIKE '%".$_POST["id"]."%'  GROUP BY `STudentID`";
		$result = $db->select_query($sql);
		$o = '<ul class="list-unstyled">';
		if($result){
		if(mysqli_num_rows($result)>0){
				while($fetch=$result->fetch_array()){
					$o.='<li>'.$fetch[0].'</li>';
				}
		}
		else {
			$o.='<li>Student Not found</li>';
		}
		}
		$o.='</ul>';
		echo $o;
	}
	
	if(isset($_POST["forMissCGPA"])){
			$o = '';
			$sql ="SELECT * FROM `gnerate_marks`  WHERE `studentID` LIKE '%".$_POST["CGPAid"]."%'  GROUP BY `studentID`";
			$result = $db->select_query($sql);
			$o = '<ul class="list-unstyled">';
			if($result){
			if(mysqli_num_rows($result)>0){
					while($fetch=$result->fetch_array()){
						$o.='<li>'.$fetch[0].'</li>';
					}
			}
			else {
				$o.='<li>Student Not found</li>';
			}
			}
			$o.='</ul>';
			echo $o;
	}	
	
	
	if(isset($_POST["forMisss"])){
			$o = '';
			$sql ="SELECT * FROM `result`  WHERE `std_roll` LIKE '%".$_POST["iddd"]."%'  GROUP BY `std_roll`";
			$result = $db->select_query($sql);
			$o = '<ul class="list-unstyled">';
			if($result){
			if(mysqli_num_rows($result)>0){
					while($fetch=$result->fetch_array()){
						$o.='<li>'.$fetch[1].'</li>';
					}
			}
			else {
				$o.='<li>Student Not found</li>';
			}
			}
			$o.='</ul>';
			echo $o;
	}	
	
	
	
	if(isset($_POST["foradmit"])){
			$o = '';
			$sql ="SELECT * FROM `running_student_info`  WHERE `student_id` LIKE '%".$_POST["iddd"]."%'   GROUP BY `student_id`";
			$result = $db->select_query($sql);
			$o = '<ul class="list-unstyled">';
			if($result){
			if(mysqli_num_rows($result)>0){
					while($fetch=$result->fetch_array()){
						$o.='<li>'.$fetch[0].'</li>';
					}
			}
			else {
				$o.='<li>Student Not found</li>';
			}
			}
			$o.='</ul>';
			echo $o;
	}	
	
	
	
	
	if(isset($_POST["forattendance"])){
			$o = '';
			$sql ="SELECT * FROM `studentpresent`  WHERE `StudentID` LIKE '%".$_POST["attendacID"]."%'  GROUP BY `StudentID`";
			$result = $db->select_query($sql);
			$o = '<ul class="list-unstyled">';
			if($result){
			if(mysqli_num_rows($result)>0){
					while($fetch=$result->fetch_array()){
						$o.='<li>'.$fetch[3].'</li>';
					}
			}
			else {
				$o.='<li>Student Not found</li>';
			}
			}
			$o.='</ul>';
			echo $o;
	}	


	if(isset($_POST["forAddFee"])){
			$explodeclass=explode('and',$_POST["ClassId"]);
			$explodegroup=explode('and',$_POST["groupID"]);
			$o = '';
			   $sql ="SELECT * FROM `running_student_info` WHERE `class_id`='$explodeclass[0]'  AND  `student_id` LIKE '%".$_POST["forFestdid"]."%'  GROUP BY `student_id`";

			$result = $db->select_query($sql);
			$o = '<ul class="list-unstyled">';
			if($result){
			if(mysqli_num_rows($result)>0){
					while($fetch=$result->fetch_array()){
						$o.='<li>'.$fetch[0].'</li>';
					}
			}
			else {
				$o.='<li>Student Not found</li>';
			}
			}
			$o.='</ul>';
			echo $o;
	}	
	
	
	if(isset($_POST["forDiscount"])){
	
				$explodeclass=explode('and',$_POST["ClassId"]);
			$explodegroup=explode('and',$_POST["groupID"]);
			$o = '';
			   $sql ="SELECT * FROM `student_account_info` WHERE `class_id`='$explodeclass[0]'  AND  `studentID` LIKE '%".$_POST["fordiscountID"]."%'  GROUP BY `studentID`";
			$result = $db->select_query($sql);
			$o = '<ul class="list-unstyled">';
			if($result){
			if(mysqli_num_rows($result)>0){
					while($fetch=$result->fetch_array()){
						$o.='<li>'.$fetch[0].'</li>';
					}
			}
			else {
				$o.='<li>Student Not found</li>';
			}
			}
			$o.='</ul>';
			echo $o;
	}
	
	if(isset($_POST["forTeacherManage"])){
	
	$o = '';
			$sql ="SELECT * FROM `teachers_information` WHERE `teachers_id` LIKE '%".$_POST["teacherID"]."%' GROUP BY `teachers_id`";
			$result = $db->select_query($sql);
			$o = '<ul class="list-unstyled">';
			if($result){
			if(mysqli_num_rows($result)>0){
					while($fetch=$result->fetch_array()){
						$o.='<li>'.$fetch[0].'</li>';
					}
			}
			else {
				$o.='<li>Teacher Not found</li>';
			}
			}
			$o.='</ul>';
			echo $o;
	
	}

		if(isset($_POST["forTeacherPay"])){
		
			$o = '';
			print $sql ="SELECT * FROM `teacher_payable_master_table` WHERE `teacher_id` LIKE '%".$_POST["teacherID"]."%' GROUP BY `teacher_id`";
			$result = $db->select_query($sql);
			$o = '<ul class="list-unstyled">';
			if($result){
			if(mysqli_num_rows($result)>0){
					while($fetch=$result->fetch_array()){
						$o.='<li>'.$fetch[0].'</li>';
					}
			}
			else {
				$o.='<li>Teacher Not found</li>';
			}
			}
			$o.='</ul>';
			echo $o;
		}


		
		if(isset($_POST["forStuff"])){
		
			$o = '';
			$sql ="SELECT * FROM `stuff_information` WHERE `stuff_id` LIKE '%".$_POST["struffID"]."%' GROUP BY `stuff_id`";
			$result = $db->select_query($sql);
			$o = '<ul class="list-unstyled">';
			if($result){
			if(mysqli_num_rows($result)>0){
					while($fetch=$result->fetch_array()){
						$o.='<li>'.$fetch[0].'</li>';
					}
			}
			else {
				$o.='<li>Teacher Not found</li>';
			}
			}
			$o.='</ul>';
			echo $o;
		}

		if(isset($_POST["forSturffPayableSetting"])){
		
			$o = '';
			 $sql ="SELECT * FROM `struffpayablemastertable` WHERE `struffId` LIKE '%".$_POST["struffID"]."%' GROUP BY `struffId`";
			$result = $db->select_query($sql);
			$o = '<ul class="list-unstyled">';
			if($result){
			if(mysqli_num_rows($result)>0){
					while($fetch=$result->fetch_array()){
						$o.='<li>'.$fetch[0].'</li>';
					}
			}
			else {
				$o.='<li>Teacher Not found</li>';
			}
			}
			$o.='</ul>';
			echo $o;
		}



		if(isset($_POST["forSTudenDUereport"])){
	
			
			$o = '';
			   $sql ="SELECT * FROM `student_account_info` WHERE   `studentID` LIKE '%".$_POST["Student"]."%'  GROUP BY `studentID`";
			$result = $db->select_query($sql);
			$o = '<ul class="list-unstyled">';
			if($result){
			if(mysqli_num_rows($result)>0){
					while($fetch=$result->fetch_array()){
						$o.='<li>'.$fetch[0].'</li>';
					}
			}
			else {
				$o.='<li>Student Not found</li>';
			}
			}
			$o.='</ul>';
			echo $o;
	}

?>