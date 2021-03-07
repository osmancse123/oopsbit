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

					if (isset($_POST["SaveData"])) {
						@$id=$_POST["teacherId"];
						@$month=$_POST["month"];
						@$year=$_POST["year"];
						@$bonus_type=$_POST["bonus_type"];
						@$amount=$_POST["amount"];
						@$UID=$_SESSION["id"];
						@$date=date("Y-m-d");
						if (!empty($bonus_type)&&!empty($id)&&!empty($amount)&&!empty($month)) {
							# code...
						
						$sql="INSERT INTO teacher_payable_table (teacher_id,date,title,amount,month,year,user_id) values ('$id','$date','$bonus_type','$amount','$month','$year','$UID')";
						$db->insert_query($sql);
	if ($db->sms) {
		echo $db->sms;
	}
					}
else
{
	echo "<b style='color:red;'>Sorry!! Data Was Required</b>";
}
				}

				if (isset($_POST["view"])) {

$techer=$_POST["teacherId"];
$sql="SELECT teachers_information.teachers_id,teachers_information.teachers_name,teachers_information.designation,teachers_information.mobile_no,teacher_payable_table.* FROM teacher_payable_table inner join teachers_information on  teacher_payable_table.teacher_id=teachers_information.teachers_id WHERE teacher_payable_table.teacher_id='".$_POST["teacherId"]."'";
$qur=$db->select_query($sql);
if ($qur) {
$row=mysqli_fetch_assoc($qur);
					?>
						<style type="text/css">
		.text{display: none;}
		.rfd{display: none;}
	</style>
					<table class="table table-bordered">
					<tr>
							<td colspan="3" align="left" style=""><button class="btn-xs btn btn-warning" onclick="back()">Back</button></td>
						</tr>
						<tr class="success">
							<td colspan="3" align="center" style="font-weight: bold;font-size: 18px;color: navy;">Teacher Bonus Record</td>
						</tr>
						<tr>
							<td colspan="3">
							<b style="margin-left: 5px; color: navy; font-size: 13px;">ID : <?php echo $row["teachers_id"] ?></b>
							<b style="margin-left: 10px; color: navy; font-size: 13px;">Name : <?php echo $row["teachers_name"] ?></b>
								<b style="margin-left: 10px; color: navy; font-size: 13px;">Designation : <?php echo $row["designation"] ?></b>
								<b style="margin-left: 10px; color: navy; font-size: 13px;">Phone : <?php echo $row["mobile_no"] ?></b>
							</td>
						</tr>
						<?php

$sqls="SELECT * FROM teacher_payable_table WHERE teacher_payable_table.teacher_id='".$_POST["teacherId"]."' GROUP BY year";
$qurs=$db->select_query($sqls);
if ($qurs) {
while ($rowY=mysqli_fetch_assoc($qurs)) 
{

$sqlsm="SELECT * FROM teacher_payable_table WHERE teacher_payable_table.teacher_id='".$_POST["teacherId"]."' and year='".$rowY["year"]."' GROUP BY month order by id";
$qursm=$db->select_query($sqlsm);
if ($qursm) {
while ($month=mysqli_fetch_assoc($qursm)) 
{

						?>
						<tr><td colspan="3" style="font-weight: bold; font-size: 14px; color: green">Month :
<?php 

if ($month["month"]=="Jan") {
  echo "January";
}
else if ($month["month"]=="Feb") {
  echo "February";
}
else if ($month["month"]=="Mar") {
  echo "March";
}
else if ($month["month"]=="Apr") {
  echo "April";
}
else if ($month["month"]=="May") {
  echo "May";
}
else if ($month["month"]=="Jun") {
  echo "June";
}
else if ($month["month"]=="Jul") {
  echo "July";
}
else if ($month["month"]=="Aug") {
  echo "August";
}
else if ($month["month"]=="Sep") {
  echo "September";
}
else if ($month["month"]=="Oct") {
  echo "October";
}
else if ($month["month"]=="Nov") {
  echo "November";
}
else if ($month["month"]=="Dec") {
  echo "December";
}
else {
  echo $month["month"];
}
 ?>
   - <?php echo $rowY["year"]; ?>
						 </td></tr>

					 
						<tr class="info">
							<td>Head Title</td>
							<td>Amount</td>
							<td>Action</td>
						</tr>
						<?php
$sqla="select add_payment_title.payment_title, admin_users.Name,teacher_payable_table.* from teacher_payable_table inner join admin_users on  teacher_payable_table.user_id=admin_users.id inner join add_payment_title on teacher_payable_table.title=add_payment_title.id where teacher_id='$techer' and year='".$rowY["year"]."' and month='".$month["month"]."'";
$quera=$db->select_query($sqla);
if ($quera) {
  $total=0;
  $sub=0;
  $due=0;
  $pay=0;
while ($rowa=mysqli_fetch_assoc($quera))
 {

  
  $due=$due+$rowa["amount"];

	?>
						<tr id="tr_<?php echo $rowa["id"] ?>">
							<td><?php echo $rowa["payment_title"] ?></td>
							<td>
								
	<samp id="title_<?php echo $rowa["id"] ?>"><?php echo $rowa["amount"]?></samp>
	<input type="text" class="text" id="amount_<?php echo $rowa["id"] ?>" value="<?php echo $rowa["amount"]?>">

							</td>
							<td>
								
	<button class="btn btn-xs btn-info" id="edit_<?php echo $rowa["id"] ?>"  onclick="editSa('<?php echo $rowa['id'] ?>')">Edit</button>
	 <button onclick="return ForUpdate('<?php echo $rowa["id"] ?>')" id="up_<?php echo $rowa["id"] ?>" class="btn btn-xs btn-info rfd" type="button">Save</button>
 
    <button class="btn btn-xs btn-warning rfd" onclick="refreash('<?php echo $rowa["id"] ?>')" id="rf_<?php echo $rowa["id"] ?>" type="button">Refrash</button>  
    <button class="btn btn-xs btn-danger" onclick=" return Fordelete('<?php echo $rowa["id"] ?>')" type="button" id="del_<?php echo $rowa["id"] ?>">Delete</button></b>

							</td>
						</tr>
						<?php
}
}
?>
		<tr>
							<td></td>
							<td><?php echo $due; ?></td>
							<td></td>
		</tr>
<?php
}
}}}
						?>
					</table>
					<?php
				}}



				if (isset($_POST["update"]))
 {
	$id=$_POST["Mid"];
	$amount=$_POST["amount"];
	$UID=$_SESSION["id"];

	$sql="UPDATE  teacher_payable_table  SET amount='$amount',user_id='$UID' where id='$id'";
	$db->update_query($sql);
	if ($db->sms) {
		echo $db->sms;
	}
}
if (isset($_POST["deleteS"]))
 {
	$id=$_POST["Mid"];


	$sql="DELETE FROM teacher_payable_table  where id='$id'";
	$db->delete_query($sql);
	if ($db->sms) {
		echo $db->sms;
	}
}
?>