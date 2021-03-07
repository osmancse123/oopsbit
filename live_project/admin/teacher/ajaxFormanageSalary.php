<?php
	@session_start();

require_once("../../db_connect/conect.php");
	$db = new database();
if (isset($_POST["AddandDelete"]))
 {
	$id=$_POST["teacherId"];
	$amount=$_POST["paidAmount"];
	$UID=$_SESSION["id"];

	$sql="INSERT INTO teacher_manage_salary (teacher_id,amount,user_id) VALUES ('$id','$amount','$UID')";
	$db->insert_query($sql);
	if ($db->sms) {
		echo $db->sms;
	}
}
if (isset($_POST["update"]))
 {
	$id=$_POST["Mid"];
	$amount=$_POST["amount"];
	$UID=$_SESSION["id"];

	$sql="UPDATE  teacher_manage_salary  SET amount='$amount',user_id='$UID' where id='$id'";
	$db->update_query($sql);
	if ($db->sms) {
		echo $db->sms;
	}
}
if (isset($_POST["deleteS"]))
 {
	$id=$_POST["Mid"];


	$sql="DELETE FROM teacher_manage_salary  where id='$id'";
	$db->delete_query($sql);
	if ($db->sms) {
		echo $db->sms;
	}
}

if (isset($_POST["view"]))
 {
	?>
	<style type="text/css">
		.text{display: none;}
		.rfd{display: none;}
	</style>
<table class="table table-bordered">
<tr>
	<td colspan="5" align="left" style="color: navy; font-weight: bold;font-size: 18px;"> <button class="btn-xs btn btn-warning" onclick="back()">Back</button> <samp id="sms"></samp></td>
</tr>
<tr>
	<td colspan="5" align="center" style="color: navy; font-weight: bold;font-size: 18px;">Teacher Manage Salary</td>
</tr>
	<tr class="info">
		<td>SL</td>
	<td>Name</td>
	<td>Designation</td>
	<td>Main Salary</td>
	<td>Action</td>
	</tr>
	<?php
	$sqls="select teachers_information.teachers_name,teachers_information.designation,teacher_manage_salary.* from teacher_manage_salary inner join teachers_information on teacher_manage_salary.teacher_id=teachers_information.teachers_id";
	$quer=$db->select_query($sqls);
	if ($quer) {
		$i=1;
		while ($fetch=mysqli_fetch_assoc($quer)) {
			
	
	
	?>
		<tr id="tr_<?php echo $fetch["id"] ?>">
		<td><?php echo $i++;?></td>
	<td><?php echo $fetch["teachers_name"]?></td>
	<td><?php echo $fetch["designation"]?></td>
	<td>
	<samp id="title_<?php echo $fetch["id"] ?>"><?php echo $fetch["amount"]?></samp>
	<input type="text" class="text" id="amount_<?php echo $fetch["id"] ?>" value="<?php echo $fetch["amount"]?>">	
	</td>
	<td>
	<button class="btn btn-xs btn-info" id="edit_<?php echo $fetch["id"] ?>"  onclick="editSa('<?php echo $fetch['id'] ?>')">Edit</button>
	 <button onclick="return ForUpdate('<?php echo $fetch["id"] ?>')" id="up_<?php echo $fetch["id"] ?>" class="btn btn-xs btn-info rfd" type="button">Save</button>
 
    <button class="btn btn-xs btn-warning rfd" onclick="refreash('<?php echo $fetch["id"] ?>')" id="rf_<?php echo $fetch["id"] ?>" type="button">Refrash</button>  
    <button class="btn btn-xs btn-danger" onclick=" return Fordelete('<?php echo $fetch["id"] ?>')" type="button" id="del_<?php echo $fetch["id"] ?>">Delete</button></b> </td>

	 </td>
	</tr>
	<?php
}	}
	?>
</table>
	<?php
}
?>
