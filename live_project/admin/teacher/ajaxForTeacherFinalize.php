<?php
	@session_start();

require_once("../../db_connect/conect.php");
	$db = new database();
if(isset($_POST["name"])){
		
				if(!empty($_POST["id"])){
				$a = [];
				 $forTeacherInfo="SELECT teachers_information.teachers_name,teachers_information.designation,teachers_information.mobile_no,teacher_manage_salary.amount FROM teacher_manage_salary inner join teachers_information on teacher_manage_salary.teacher_id=teachers_information.teachers_id WHERE teacher_manage_salary.teacher_id='".$_POST["id"]."'";
				$resultForinof=$db->select_query($forTeacherInfo);
				if ($resultForinof) {
					# code...
				
							if($resultForinof->num_rows> 0){
							
									$fetch=$resultForinof->fetch_assoc();
							//$a  = array('name' =>$fetch['student_name'],'Sess'=>$fetch['session2']);
							//$msg=json_encode($a);
							$msg = $fetch['teachers_name'].'/'.$fetch['designation'].'/'.$fetch['mobile_no'].'/'.$fetch['amount'];
							echo $msg;
							}

							}
						}	
					}

					if (isset($_POST["totalBounus"])) {
						
						$month=$_POST["month"];
						$year=$_POST["year"];
						$id=$_POST["id"];

						$sqlv="select * from teacher_manage_salary where teacher_id='$id'";
						$quv=$db->select_query($sqlv);
						if ($quv) {
						$Mtk=mysqli_fetch_assoc($quv);

						$sql="select sum(amount) as 'Total' from teacher_payable_table where teacher_id='$id' and month='$month' and year='$year'";
						$qu=$db->select_query($sql);
						if ($qu) {
							$tk=mysqli_fetch_assoc($qu);
							$Gtotal=$Mtk["amount"]+$tk["Total"];
							echo $Gtotal;
						}
						else
						{
							echo $Mtk["amount"];
						}
}
else
{
	echo "00.00";
}
					}


					if (isset($_POST["AddandDelete"]))
					 {
						$id=$_POST["teacherId"];
						$month=$_POST["month"];
						$year=$_POST["year"];
						$totalSalary=$_POST["totalSalary"];
						$fromTeacher=$_POST["fromTeacher"];
						$fromSchool=$_POST["fromSchool"];
						$totalFuture=$_POST["totalFuture"];
						$obtainSalary=$_POST["obtainSalary"];
						$UID=$_SESSION["id"];

						$sql="INSERT INTO teacher_future_funds (teacher_id,month,year,date,total_salary,from_teacher,from_institute,total_future_amount,total_grand_salary,user_id) values ('$id','$month','$year','".date("d-m-Y")."','$totalSalary','$fromTeacher','$fromSchool','$totalFuture','$obtainSalary','$UID')";
						$db->insert_query($sql);
						if ($db->sms) {
							echo $db->sms;
						}
					}
?>