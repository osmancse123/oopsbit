<?php
    error_reporting(1);
	@session_start();
	   date_default_timezone_set("Asia/Dhaka");
    require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
	$db = new database();
	 $selApp="select * from project_info";
$queApp=$db->select_query($selApp);
$fetchApp=mysqli_fetch_assoc($queApp);
?>
			<?php
			if(isset($_POST["forDaily"])){
				
				 $year = explode("-", $_POST["date"]);
				 $newDate=$year[2].'-'.$year[1].'-'.$year[0];
				 $year[2];
				 $dailyAmmount = "SELECT * FROM `student_paid_table` WHERE `date`='". $newDate."'   GROUP BY `voucher` ORDER BY `student_paid_table`.`voucher` ASC";
			$resultAmmount = $db->select_query($dailyAmmount);
				if($resultAmmount->num_rows  > 0){
						
			?>
			<Div class="col-md-12 col-lg-12" style="margin-top:10px;">
			<table class="table table-bordered" style="font-size: 14px;">
				<tr>
					<td colspan="7">
					<table  width="100%"  border="0" align="left" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="border:0px;">
    <tr>

   

      <td  height="50" colspan="4" align="center" >
      	<span style="float: left;">  <img src="all_image/logoSDMS2015.png" width="76" height="74" style="" /></span>
    <ul style=" padding-top:5px">
    
    <li style="color:#000000;font-family:microsoft-sun-serif;  font-size:26px; list-style: none;"><?php echo $fetchApp["institute_name"]?></li>
   <li style="list-style: none;"><p style="margin-top:-1px;font-size:16px;font-family:Arial, Helvetica, sans-serif"><?php echo $fetchApp["location"]?></p></li>
    <li style=" list-style: none; margin-top:-13px;font-size:14px;font-family:Arial, Helvetica, sans-serif"><?php echo $fetchApp["phone_number"].','.$fetchApp["email"];?></li>
    <li style="list-style: none;"><h4>Daily Collection Report, Date: <?php print $_POST["date"]; ?> </h4></li>
     </ul>     


      </td>
<td style="border-bottom:1px solid #333333"></td>
    </tr>

</table>

					</td>
				</tr>
				<tr>
					<td width="24">SL</td>
					<td width="100">Voucher No.</td>
					<td width="100">Class</td>
					<td width="100">Student ID</td>
					<td width="100">Roll No.</td>
					<td width="400" >Student Name</td>
					
					<td width="100" >Paid Amount</td>
				
				</tr>
				<?php   
						$sl=0;
						$total = 0;
						
						while($fetchDailyAmmount = $resultAmmount->fetch_array()){
						$sl++;
						
						$totalpaidamoutbyvou="SELECT SUM(`paid_amount`) FROM `student_paid_table` WHERE `student_id`='$fetchDailyAmmount[student_id]' and voucher='$fetchDailyAmmount[voucher]'";
						$excresult = $db->select_query($totalpaidamoutbyvou)->fetch_array();
					    $total = $total+$excresult[0];
						
						
					
						?>
				<tr>
					<td style="height: 20px;" ><?php echo $sl;?></td>
					<td width="106">


						<a target="_blank" href='student_print_vaocher.php?id="<?php echo $fetchDailyAmmount["student_id"];?>"&&Lid="dddd"&&year="<?php echo  $year[2];?>"&&date="<?php echo $_POST["date"] ;?>"&&clas="<?php echo $fetchDailyAmmount["class_id"].'and'.'name';?>"&&last_id="<?php echo $fetchDailyAmmount["voucher"];?>"'>
							<?php echo $fetchDailyAmmount["voucher"];?></a>

					</td>
					
					<td >
						<?php 
							$forClassName= "SELECT `class_name` FROM `add_class` WHERE `id`='".$fetchDailyAmmount["class_id"]."'";
							$resulclassName = $db->select_query($forClassName);
								if($resulclassName->num_rows > 0){
										$fetchClassName = $resulclassName->fetch_array();
								}
					
					echo $fetchClassName["class_name"];?></td>
					<td><?php print $fetchDailyAmmount["student_id"]; ?></td>

				
						<?php
							$forStudentNameAnoroll="SELECT `running_student_info`.`class_roll`,`student_personal_info`.`student_name` FROM `running_student_info`
INNER JOIN `student_personal_info` ON `student_personal_info`.`id`=`running_student_info`.`student_id`
WHERE `running_student_info`.`student_id`='".$fetchDailyAmmount["student_id"]."'";
							$resulforStudent=$db->select_query($forStudentNameAnoroll);
								if($resulforStudent->num_rows > 0){
								
								$fetcForstudent =$resulforStudent->fetch_array();
								}
					 ?>
					 <td><?php print $fetcForstudent["class_roll"];?></td>
					 <td><?php echo $fetcForstudent["student_name"];;?></td>
					 
					<td  align="right"><?php echo  $db->my_money_format($excresult[0]);?></td>
					<!--<td width="155"><?php echo $db->my_money_format($dueammount);?></td>-->
					
				</tr>
				<?php }?>
				<tr>
					<td colspan="6"  align="right"><strong>Total Received Amount : </strong></td>
					<td align="right"><strong><?php echo $db->my_money_format($total);?>/=</strong></td>
				
				</tr>
				<?php } else { ?>
				<tr>
					<td  colspan="6" align="right">
						<span><strong class="text-danger">No Data Have Found !!!</strong></span>
					</td>
					
				</tr>
				<?php } ?>
			</table>
			</Div>
			<?php }
	 
	 ?>
	        <?php   	

	        if(isset($_POST["monthlyreport"])){
			 $date1 = explode("-", $_POST["frsdate"]);
			 $date2 = explode("-", $_POST["snddate"]);
			$todate=$date1[2].'-'.$date1[1].'-'.$date1[0];
			$formDate=$date2[2].'-'.$date2[1].'-'.$date2[0];

			$dailyAmmount = "SELECT * FROM `student_paid_table` WHERE `date` BETWEEN '".$todate."' AND '".$formDate."'   GROUP BY `voucher` ORDER BY `student_paid_table`.`voucher` ASC";
			$resultAmmount = $db->select_query($dailyAmmount);
				if($resultAmmount->num_rows  > 0){
						
			?>


		
			<div class="col-md-12 col-lg-12" style="margin-top:10px;">
			<table class="table table-bordered" style="font-size: 14px;">
				<tr>
					<td colspan="7">
					<table  width="100%"  border="0" align="left" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="border:0px;">
    <tr>

   

      <td  height="50" colspan="4" align="center" >
      	<span style="float: left;">  <img src="all_image/logoSDMS2015.png" width="76" height="74" style="" /></span>
    <ul style=" padding-top:5px">
    
    <li style="color:#000000;font-family:microsoft-sun-serif;  font-size:26px; list-style: none;"><?php echo $fetchApp["institute_name"]?></li>
   <li style="list-style: none;"><p style="margin-top:-1px;font-size:16px;font-family:Arial, Helvetica, sans-serif"><?php echo $fetchApp["location"]?></p></li>
    <li style=" list-style: none; margin-top:-13px;font-size:14px;font-family:Arial, Helvetica, sans-serif"><?php echo $fetchApp["phone_number"].','.$fetchApp["email"];?></li>
    <li style="list-style: none;"><h4>Day-to-Day Collection Report, [ <?php print $_POST["frsdate"]; ?> - <?php print $_POST["snddate"]; ?> ] </h4></li>
     </ul>     


      </td>
<td style="border-bottom:1px solid #333333"></td>
    </tr>

</table>

					</td>
				</tr>
				<tr>
					<td width="24">SL</td>
					<td width="100">Voucher No.</td>
					<td width="100">Class</td>
					<td width="100">Student ID</td>
					<td width="100">Roll No.</td>
					<td width="400" >Student Name</td>
					
					<td width="100" >Paid Amount</td>
				
				</tr>
				<?php   
						$sl=0;
						$total = 0;
						
						while($fetchDailyAmmount = $resultAmmount->fetch_array()){
						$sl++;
						
						$totalpaidamoutbyvou="SELECT SUM(`paid_amount`) FROM `student_paid_table` WHERE `student_id`='$fetchDailyAmmount[student_id]' and voucher='$fetchDailyAmmount[voucher]'";
						$excresult = $db->select_query($totalpaidamoutbyvou)->fetch_array();
					    $total = $total+$excresult[0];
						
						
					
						?>
				<tr>
					<td style="height: 20px;" ><?php echo $sl;?></td>
					<td width="106">


						<a target="_blank" href='student_print_vaocher.php?id="<?php echo $fetchDailyAmmount["student_id"];?>"&&Lid="dddd"&&year="<?php echo  $date1[2];?>"&&date="<?php echo $_POST["date"] ;?>"&&clas="<?php echo $fetchDailyAmmount["class_id"].'and'.'name';?>"&&last_id="<?php echo $fetchDailyAmmount["voucher"];?>"'>
							<?php echo $fetchDailyAmmount["voucher"];?></a>

					</td>
					
					<td >
						<?php 
							$forClassName= "SELECT `class_name` FROM `add_class` WHERE `id`='".$fetchDailyAmmount["class_id"]."'";
							$resulclassName = $db->select_query($forClassName);
								if($resulclassName->num_rows > 0){
										$fetchClassName = $resulclassName->fetch_array();
								}
					
					echo $fetchClassName["class_name"];?></td>
					<td><?php print $fetchDailyAmmount["student_id"]; ?></td>

				
						<?php
							$forStudentNameAnoroll="SELECT `running_student_info`.`class_roll`,`student_personal_info`.`student_name` FROM `running_student_info`
INNER JOIN `student_personal_info` ON `student_personal_info`.`id`=`running_student_info`.`student_id`
WHERE `running_student_info`.`student_id`='".$fetchDailyAmmount["student_id"]."'";
							$resulforStudent=$db->select_query($forStudentNameAnoroll);
								if($resulforStudent->num_rows > 0){
								
								$fetcForstudent =$resulforStudent->fetch_array();
								}
					 ?>
					 <td><?php print $fetcForstudent["class_roll"];?></td>
					 <td align="left"><?php echo $fetcForstudent["student_name"];;?></td>
					 
					<td  align="right"><?php echo  $db->my_money_format($excresult[0]);?></td>
					<!--<td width="155"><?php echo $db->my_money_format($dueammount);?></td>-->
					
				</tr>
				<?php }?>
				<tr>
					<td colspan="6"  align="right"><strong>Total Received Amount : </strong></td>
					<td align="right"><strong><?php echo $db->my_money_format($total);?>/=</strong></td>
				
				</tr>
				<?php } else { ?>
				<tr>
					<td  colspan="6" align="right">
						<span><strong class="text-danger">No Data Have Found !!!</strong></span>
					</td>
					
				</tr>
				<?php } ?>
			</table>
			</Div>

			<?php }
	 
	 ?>
	 
	 <?php
			if(isset($_POST["showEarlypost"])){
			
			

			$dailyAmmount = "SELECT * FROM `student_paid_table` WHERE  LEFT(`date`,4)='".$_POST["years"]."'  GROUP BY `voucher` ORDER BY `student_paid_table`.`voucher` ASC";

			$resultAmmount = $db->select_query($dailyAmmount);
				if($resultAmmount->num_rows  > 0){
						
			?>
			<div class="col-md-12 col-lg-12" style="margin-top:10px;">
			<table class="table table-bordered" style="font-size: 14px;">
				<tr>
					<td colspan="7">
					<table  width="100%"  border="0" align="left" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="border:0px;">
    <tr>

   

      <td  height="50" colspan="4" align="center" >
      	<span style="float: left;">  <img src="all_image/logoSDMS2015.png" width="76" height="74" style="" /></span>
    <ul style=" padding-top:5px">
    
    <li style="color:#000000;font-family:microsoft-sun-serif;  font-size:26px; list-style: none;"><?php echo $fetchApp["institute_name"]?></li>
   <li style="list-style: none;"><p style="margin-top:-1px;font-size:16px;font-family:Arial, Helvetica, sans-serif"><?php echo $fetchApp["location"]?></p></li>
    <li style=" list-style: none; margin-top:-13px;font-size:14px;font-family:Arial, Helvetica, sans-serif"><?php echo $fetchApp["phone_number"].','.$fetchApp["email"];?></li>
    <li style="list-style: none;"><h4>Yearly Collection Report, [ <?php print $_POST["years"]; ?> ] </h4></li>
     </ul>     


      </td>
<td style="border-bottom:1px solid #333333"></td>
    </tr>

</table>

					</td>
				</tr>
				<tr>
					<td width="24">SL</td>
					<td width="100">Voucher No.</td>
					<td width="100">Class</td>
					<td width="100">Student ID</td>
					<td width="100">Roll No.</td>
					<td width="400" >Student Name</td>
					
					<td width="100" >Paid Amount</td>
				
				</tr>
				<?php   
						$sl=0;
						$total = 0;
						
						while($fetchDailyAmmount = $resultAmmount->fetch_array()){
						$sl++;
						
						$totalpaidamoutbyvou="SELECT SUM(`paid_amount`) FROM `student_paid_table` WHERE `student_id`='$fetchDailyAmmount[student_id]' and voucher='$fetchDailyAmmount[voucher]'";
						$excresult = $db->select_query($totalpaidamoutbyvou)->fetch_array();
					    $total = $total+$excresult[0];
						
						
					
						?>
				<tr>
					<td style="height: 20px;" ><?php echo $sl;?></td>
					<td width="106">


						<a target="_blank" href='student_print_vaocher.php?id="<?php echo $fetchDailyAmmount["student_id"];?>"&&Lid="dddd"&&year="<?php echo  $_POST[years];?>"&&date="<?php echo $_POST["date"] ;?>"&&clas="<?php echo $fetchDailyAmmount["class_id"].'and'.'name';?>"&&last_id="<?php echo $fetchDailyAmmount["voucher"];?>"'>
							<?php echo $fetchDailyAmmount["voucher"];?></a>

					</td>
					
					<td >
						<?php 
							$forClassName= "SELECT `class_name` FROM `add_class` WHERE `id`='".$fetchDailyAmmount["class_id"]."'";
							$resulclassName = $db->select_query($forClassName);
								if($resulclassName->num_rows > 0){
										$fetchClassName = $resulclassName->fetch_array();
								}
					
					echo $fetchClassName["class_name"];?></td>
					<td><?php print $fetchDailyAmmount["student_id"]; ?></td>

				
						<?php
							$forStudentNameAnoroll="SELECT `running_student_info`.`class_roll`,`student_personal_info`.`student_name` FROM `running_student_info`
INNER JOIN `student_personal_info` ON `student_personal_info`.`id`=`running_student_info`.`student_id`
WHERE `running_student_info`.`student_id`='".$fetchDailyAmmount["student_id"]."'";
							$resulforStudent=$db->select_query($forStudentNameAnoroll);
								if($resulforStudent->num_rows > 0){
								
								$fetcForstudent =$resulforStudent->fetch_array();
								}
					 ?>
					 <td><?php print $fetcForstudent["class_roll"];?></td>
					 <td align="left"><?php echo $fetcForstudent["student_name"];;?></td>
					 
					<td  align="right"><?php echo  $db->my_money_format($excresult[0]);?></td>
					<!--<td width="155"><?php echo $db->my_money_format($dueammount);?></td>-->
					
				</tr>
				<?php }?>
				<tr>
					<td colspan="6"  align="right"><strong>Total Received Amount : </strong></td>
					<td align="right"><strong><?php echo $db->my_money_format($total);?>/=</strong></td>
				
				</tr>
				<?php } else { ?>
				<tr>
					<td  colspan="6" align="right">
						<span><strong class="text-danger">No Data Have Found !!!</strong></span>
					</td>
					
				</tr>
				<?php } ?>
			</table>
			</Div>
			<?php }
	 
	 ?>