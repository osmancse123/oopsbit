<?php
	error_reporting(1);
	require_once("../db_connect/config.php");
	require_once("../db_connect/conect.php");
	$db = new database();
	
	if(isset($_POST["deleteFee"]))
	{
	
		$delete="DELETE FROM `student_account_info` WHERE `studentID`='".$_POST["stdID"]."' AND `fee_id`='".$_POST["feeId"]."'";
		//echo $sqll;
	

		$deletedata=$db->select_query($delete);
		if($deletedata)
		{
			print "Delete Successfully";
		}
		else
		{
			print "Delete Successfully";
		}
	}

	if(isset($_POST["viewFee"]))
	{

	$id=$_POST['id'];
		$classId=$_POST['ClassId'];

		$selectStudent="SELECT `running_student_info`.*,`student_personal_info`.`student_name` 
FROM `running_student_info`INNER JOIN `student_personal_info`
ON `student_personal_info`.`id`=`running_student_info`.`student_id` WHERE `student_id`='$id' and `class_id`='$classId'";

		$result=$db->select_query($selectStudent);
		if($result)
		{

				if($fetchinfo=$result->fetch_array())
				{?>


						<div class="col-md-12 col-sm-12 col-lg-12 bg-success " style="padding: 20px; ">
							<div class="col-md-4 col-sm-4 col-lg-4">
							Name: <?php print $fetchinfo['student_name']?>
							</div>
								<div class="col-md-4 col-sm-4 col-lg-4">
							Roll: <?php print $fetchinfo['class_roll']?>
							</div>
								<div class="col-md-4 col-sm-4 col-lg-4">
							Year: <?php print $fetchinfo['year']?>
							</div>
								

						</div>

				<?php
			}
	?>


<table class="table table-hover">
		


		<?php
	
	$sql="SELECT `student_account_info`.`fee_id`,`student_account_info`.`AmountExceptional`,`add_fee`.`title`,`student_personal_info`.`student_name`,`student_personal_info`.`id` FROM student_account_info
INNER JOIN add_fee ON `add_fee`.`id`=student_account_info.`fee_id`
INNER JOIN student_personal_info ON `student_personal_info`.`id`=student_account_info.`studentID`
WHERE student_account_info.`studentID`='".$id."' AND `add_fee`.`Common_Exceptional`='exceptional'  AND `student_account_info`.`class_id`='".$classId."'";


$query=$db->select_query($sql);
		 while($fetch_data=$query->fetch_array()) 
		{
		
		
	?>
	
		<tr>
			<td><?php print $fetch_data[2];?></td>
			<td><?php print $fetch_data[1];?></td>
			<td><?php print $fetch_data[0];?></td>
			<td><?php print $fetch_data[3];?></td>
			<td><a href="#" onclick="return deleteFee(<?php print $fetch_data[0];?>)" class="btn btn-primary" >Delete</a></td>
		
		</tr>
		<?php
	}
	?>


</table>
<?php
	}
	else
	{

		print "<h3>Student Not Found!!</h3>";
	}

}




	if(isset($_POST["addExceptionalFee"]))
	{
	
		$id=$_POST['studentID'];
		$classId=$_POST['className'];

	

		$selectStudent="SELECT `running_student_info`.*,`student_personal_info`.`student_name` 
FROM `running_student_info`INNER JOIN `student_personal_info`
ON `student_personal_info`.`id`=`running_student_info`.`student_id` WHERE `student_id`='$id' and `class_id`='$classId'";

		$result=$db->select_query($selectStudent);
		if($result)
		{

				if($fetchinfo=$result->fetch_array())
				{

				}

	
		$a=count($_POST["x"]);
		
		for($i=0;$i<$a;$i++)
		{
	
			$feeID=$_POST["x"][$i];
			$feeamount="amount-".$_POST["x"][$i];

			$amount=$_POST[$feeamount];

			
			if($amount!="" && $amount!="0")
			{
			  $insert_fee="INSERT INTO `student_account_info`(`studentID`,`class_id`,`fee_id`,`year`,`admin_id`,`AmountExceptional`) VALUES('".$id."','".$classId."','$feeID','".$_POST["year"]."','306','$amount')
";
        	  $insert_fee_studnt=$db->insert_query($insert_fee);

		if($insert_fee_studnt)
		{
			echo "Successfully!!";
		}
		else
		{
			echo "Successfully!!";
		}

        	}
			
		
		}
		

	}
	else
	{
		print "<h3>Student Not Found!!</h3>";
	}
	
	}


if(isset($_POST["stdinfo"]))
{

		
		$id=$_POST['id'];
		$classId=$_POST['ClassId'];

		$selectStudent="SELECT `running_student_info`.*,`student_personal_info`.`student_name` 
FROM `running_student_info`INNER JOIN `student_personal_info`
ON `student_personal_info`.`id`=`running_student_info`.`student_id` WHERE `student_id`='$id' and `class_id`='$classId'";

		$result=$db->select_query($selectStudent);
		if($result)
		{

				if($fetchinfo=$result->fetch_array())
				{?>


						<div class="col-md-12 col-sm-12 col-lg-12 bg-success " style="padding: 20px; ">
							<div class="col-md-4 col-sm-4 col-lg-4">
							Name: <?php print $fetchinfo['student_name']?>
							</div>
								<div class="col-md-4 col-sm-4 col-lg-4">
							Roll: <?php print $fetchinfo['class_roll']?>
							</div>
								<div class="col-md-4 col-sm-4 col-lg-4">
							Year: <?php print $fetchinfo['year']?>
							</div>
								

						</div>

				<?php
			}

			
?>

<table class="table table-hover" style="background: #fff">
      <?php

		$sqll="SELECT * FROM `add_fee` WHERE `Common_Exceptional`='exceptional' AND `class_id`='".$classId."' AND `year`='".$_POST["year"]."'";
		//echo $sqll;
	$tbindex=0;

		$querysl=$db->select_query($sqll);
		 while($fetcRowl=$querysl->fetch_array()) 
		{
			$tbindex++;
			$al="SELECT * FROM `student_account_info` WHERE `studentID`='".$id."' AND `fee_id`='$fetcRowl[id]'";
			$q=$db->select_query($al);
			//echo $al;
				if(!$q)
				{
			?>
			
			<tr>

			  <td align="right"><input type="checkbox" onclick="return enableDisable(<?php print $fetcRowl[0];?>)" name="x[]" id="<?php print $fetcRowl[0];?>" value="<?php print $fetcRowl[0];?>" style="height: 18px;  width: 18px;"> &nbsp;&nbsp;&nbsp;</td>

					<td> <?php print $fetcRowl[1]; ;?></td>

					<td> <input type="text" disabled="disabled" tabindex="<?php print $tbindex; ?>" name="amount-<?php print $fetcRowl[0];?>" id="amount-<?php print $fetcRowl[0];?>" class="form-control" style="max-width:300px;" autocomplete="off"></td>

			</tr>



			
		<?php
	}
	   }
		
		?>

</table>

		<div class="col-md-12">	<input name="save" type="button" id="save" value="Save"  class="btn btn-primary" onclick="return addFe()"  />&nbsp;&nbsp;
         <input type="button" name="view" value="View" onclick="return viewFee()"   class="btn btn-primary" /> </div>
<?php
}
	
	else
	{
		print "<h3>Student Not Found!!</h3>";
	}
	
}
	?>