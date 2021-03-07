<?php
    error_reporting(1);
	@session_start();
    require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
	$db = new database();
	
	if(isset($_POST["forDaily"])){
		
				 $year = explode("/", $_POST["today"]);
				 $year[2];

				 $cusDate=$year[2].'-'.$year[1].'-'.$year[0];
				  $dailyAmmount = "SELECT * FROM `student_paid_table` WHERE `date`='".$cusDate."' and class_id='".$_POST["className"]."'   GROUP BY `voucher` ORDER BY `student_paid_table`.`voucher` ASC";
			$resultAmmount = $db->select_query($dailyAmmount);
				if($resultAmmount->num_rows  > 0){ 
				
				
				?>
				
				<table class="table table-bordered">
				<tr>
					<td width="24">Sl</td>
					<td width="106">Voucher No</td>
					<td width="199">Class Name</td>
					<td width="341">Student Name(Roll No)</td>
					<td width="116">Today Paid Ammount</td>
					<td width="155">Total Paid Ammount</td>
					<td width="119">Total Ammount</td>
				</tr>
				<?php   
						$sl=0;
						$total = 0;
						
						while($fetchDailyAmmount = $resultAmmount->fetch_array()){
						$sl++;
						
						$totalpaidamoutbyvou="SELECT SUM(`paid_amount`) FROM `student_paid_table` WHERE `student_id`='$fetchDailyAmmount[student_id]' and voucher='$fetchDailyAmmount[voucher]'";
						$excresult = $db->select_query($totalpaidamoutbyvou)->fetch_array();
					    $total = $total+$excresult[0];
						
						
						$totalpaidammount = "SELECT SUM(`paid_amount`) FROM `student_paid_table` WHERE `student_id`='".$fetchDailyAmmount["student_id"]."' AND `year`='$year[2]'";
						
						$resultpaidamm   = $db->select_query($totalpaidammount);
						if($resultpaidamm  -> num_rows >0){
								$fettotalpaid  = $resultpaidamm->fetch_array();
								
						}
						
						
						
						
						$totalAmmountbyStudent = "SELECT `student_account_info`.`fee_id`,`studentID`,`add_fee`.`amount`,SUM(`add_fee`.`amount`) FROM `student_account_info`
INNER JOIN  `add_fee` ON `add_fee`.`id`=`student_account_info`.`fee_id` WHERE `student_account_info`.`studentID`='".$fetchDailyAmmount["student_id"]."' and `student_account_info`.`year`='$year[2]'";
				$resultAmmountBystudent   = $db->select_query($totalAmmountbyStudent);
						if($resultAmmountBystudent  -> num_rows >0){
								$fetchAmmountBystudent  = $resultAmmountBystudent->fetch_array();
								
						}
						
						$totaldiscount ="SELECT SUM(`add_discount`.`discount`) FROM `add_discount` WHERE `student_id`='$fetchDailyAmmount[student_id]' AND  `year`='$year[2]'";
						$exedis =  $db->select_query($totaldiscount)->fetch_array();
						$totalammount = $fetchAmmountBystudent[3]-$exedis[0];
						
					
						
				?>
					
				<tr>
					<td width="24"><?php echo $sl;?></td>
					<td width="106"><a target="_blank" href='student_print_vaocher.php?id="<?php echo $fetchDailyAmmount["student_id"];?>"&&Lid="dddd"&&year="<?php echo  $year[2];?>"&&date="<?php echo $_POST["date"] ;?>"&&clas="<?php echo $fetchDailyAmmount["class_id"].'and'.'name';?>"&&last_id="<?php echo $fetchDailyAmmount["voucher"];?>"'><?php echo $fetchDailyAmmount["voucher"];?></a></td>
					<td width="199"><?php 
							$forClassName= "SELECT `class_name` FROM `add_class` WHERE `id`='".$fetchDailyAmmount["class_id"]."'";
							$resulclassName = $db->select_query($forClassName);
								if($resulclassName->num_rows > 0){
										$fetchClassName = $resulclassName->fetch_array();
								}
					
					echo $fetchClassName["class_name"];?></td>
					<td width="341"><?php
							$forStudentNameAnoroll="SELECT `running_student_info`.`class_roll`,`student_personal_info`.`student_name` FROM `running_student_info`
INNER JOIN `student_personal_info` ON `student_personal_info`.`id`=`running_student_info`.`student_id`
WHERE `running_student_info`.`student_id`='".$fetchDailyAmmount["student_id"]."'";
							$resulforStudent=$db->select_query($forStudentNameAnoroll);
								if($resulforStudent->num_rows > 0){
								
								$fetcForstudent =$resulforStudent->fetch_array();
								}
					 echo $fetcForstudent["student_name"].'('.$fetcForstudent["class_roll"].')';?></td>
					<td width="116"><?php echo  $db->my_money_format($excresult[0]);?></td>
				<td width="155"><?php echo $db->my_money_format($fettotalpaid [0]);?></td>
					<td width="119"><?php echo $db->my_money_format($totalammount);?></td>
				</tr>
				<?php }?>
				<tr>
					<td colspan="4"  align="right"><strong>Today Total Paid  Ammount</strong></td>
					<td colspan="3"><strong><?php echo $db->my_money_format($total);?></strong></td>
				
				</tr>
				<?php } else { ?>
				<tr>
					<td  colspan="6" align="right">
						<span><strong class="text-danger">No Data Have Found !!!</strong></span>
					</td>
					
				</tr>
				<?php } 
				
				
	
	}
	
	

		
	if(isset($_POST["formonthly"])){
		
				
				
				 
				   $dailyAmmount = "SELECT `student_paid_table`.*,`running_student_info`.`class_roll` FROM `student_paid_table`
INNER JOIN `running_student_info` ON `running_student_info`.`student_id`=`student_paid_table`.`student_id`
  WHERE   `student_paid_table`.`month`='".$_POST["monthID"]."' and `student_paid_table`.`year`='".$_POST["year"]."' and `student_paid_table`.class_id='".$_POST["className"]."'  GROUP BY `student_paid_table`.`student_id` ORDER BY `running_student_info`.`class_roll`  ASC";
			$resultAmmount = $db->select_query($dailyAmmount);
				if($resultAmmount->num_rows  > 0){ 
				

				
				
				
			
				
				
				
				?>
				
				<table class="table table-bordered">
				<tr>
					<td width="30">Sl</td>
					<td width="200">Date</td>
					<td width="50">Voucher No.</td>
					<td width="50">Student ID</td>
					<td width="30">Roll No</td>
					<td width="341">Student Name</td>
					<td width="199">Class Name</td>
					<td width="116">Paid Ammount</td>
				
				</tr>
				<?php   
						$sl=0;
						$total = 0;
						
						while($fetchDailyAmmount = $resultAmmount->fetch_array()){
						$sl++;
						
	$totalpaidamoutbyvou="SELECT SUM(`paid_amount`) FROM `student_paid_table` WHERE `student_id`='$fetchDailyAmmount[student_id]' and `year`='".$_POST["year"]."' and `student_paid_table`.`month`='".$_POST["monthID"]."'";

						$excresult = $db->select_query($totalpaidamoutbyvou)->fetch_array();
					    $total = $total+$excresult[0];
						
						
						// $totalpaidammount = "SELECT SUM(`paid_amount`) FROM `student_paid_table` WHERE `student_id`='".$fetchDailyAmmount["student_id"]."' AND `year`='".$_POST["year"]."'";
						
						// $resultpaidamm   = $db->select_query($totalpaidammount);
						// if($resultpaidamm  -> num_rows >0){
						// $fettotalpaid  = $resultpaidamm->fetch_array();
							
						// }
						
						
						
						
// 						$totalAmmountbyStudent = "SELECT `student_account_info`.`fee_id`,`studentID`,`add_fee`.`amount`,SUM(`add_fee`.`amount`) FROM `student_account_info`
// INNER JOIN  `add_fee` ON `add_fee`.`id`=`student_account_info`.`fee_id` WHERE `student_account_info`.`studentID`='".$fetchDailyAmmount["student_id"]."' and `student_account_info`.`year`='".$_POST["year"]."'";
// 				$resultAmmountBystudent   = $db->select_query($totalAmmountbyStudent);
// 						if($resultAmmountBystudent  -> num_rows >0){
// 								$fetchAmmountBystudent  = $resultAmmountBystudent->fetch_array();
								
// 						}
						
						// $totaldiscount ="SELECT SUM(`add_discount`.`discount`) FROM `add_discount` WHERE `student_id`='$fetchDailyAmmount[student_id]' AND  `year`='".$_POST["year"]."'";
						// $exedis =  $db->select_query($totaldiscount)->fetch_array();
						// $totalammount = $fetchAmmountBystudent[3]-$exedis[0];
						
					
						
				?>
					
				<tr>
					<td width="24"><?php echo $sl;?></td>
					<td><?php echo $fetchDailyAmmount["date"];?></td>
					<td width="106">

						<a target="_blank" href='student_print_vaocher.php?id="<?php echo $fetchDailyAmmount["student_id"];?>"&&Lid="dddd"&&year="<?php echo  $_POST["year"];?>"&&date="<?php echo $_POST["date"] ;?>"&&clas="<?php echo $fetchDailyAmmount["class_id"].'and'.'name';?>"&&last_id="<?php echo $fetchDailyAmmount["voucher"];?>"'>

						<?php echo $fetchDailyAmmount["voucher"];?>
					
				</a></td>

				<td><?php echo $fetchDailyAmmount[0];?></td>
					
					<td ><?php
							$forStudentNameAnoroll="SELECT `running_student_info`.`class_roll`,`student_personal_info`.`student_name` FROM `running_student_info`
INNER JOIN `student_personal_info` ON `student_personal_info`.`id`=`running_student_info`.`student_id`
WHERE `running_student_info`.`student_id`='".$fetchDailyAmmount["student_id"]."'";
							$resulforStudent=$db->select_query($forStudentNameAnoroll);
								if($resulforStudent->num_rows > 0){
								
								$fetcForstudent =$resulforStudent->fetch_array();
								}
					 echo $fetcForstudent["class_roll"];?></td>

					 <td><?php  echo $fetcForstudent["student_name"];?></td>



					 <td width="199"><?php 
							$forClassName= "SELECT `class_name` FROM `add_class` WHERE `id`='".$fetchDailyAmmount["class_id"]."'";
							$resulclassName = $db->select_query($forClassName);
								if($resulclassName->num_rows > 0){
										$fetchClassName = $resulclassName->fetch_array();
								}
					
					echo $fetchClassName["class_name"];?></td>


					<td width="116"><?php echo  $db->my_money_format($excresult[0]);?></td>
			<!-- 	<td width="155"><?php echo $db->my_money_format($fettotalpaid [0]);?></td>
					<td width="119"><?php echo $db->my_money_format($totalammount);?></td> -->
				</tr>
				<?php }?>
				<tr>
					<td colspan="7"  align="right"><strong>Today Total Paid  Ammount</strong></td>
					<td ><strong><?php echo $db->my_money_format($total);?></strong></td>
				
				</tr>
				<?php } else { ?>
				<tr>
					<td  colspan="6" align="right">
						<span><strong class="text-danger">No Data Have Found !!!</strong></span>
					</td>
					
				</tr>
				<?php } 
				
				

				
	
	}  
	
	
	
		
	if(isset($_POST["foryear"])){
		
				
				
				 
				    $dailyAmmount = "SELECT `student_paid_table`.*,`running_student_info`.`class_roll` FROM `student_paid_table`
INNER JOIN `running_student_info` ON `running_student_info`.`student_id`=`student_paid_table`.`student_id`
  WHERE   `student_paid_table`.`year`='".$_POST["year"]."' and `student_paid_table`.class_id='".$_POST["className"]."'  GROUP BY `student_paid_table`.`student_id` ORDER BY `running_student_info`.`class_roll`  ASC";
			$resultAmmount = $db->select_query($dailyAmmount);
				if($resultAmmount->num_rows  > 0){ 
				
				
				
			
				
				
				
				?>
				
				<table class="table table-bordered">
				<tr>
					<td width="30">Sl</td>
					<td width="200">Date</td>
					<td width="50">Voucher No.</td>
					<td width="50">Student ID</td>
					<td width="30">Roll No</td>
					<td width="341">Student Name</td>
					<td width="199">Class Name</td>
					<td width="116">Paid Ammount</td>
				<!-- 	<td width="155">Total Paid Ammount</td>
					<td width="119">Total Ammount</td> -->
				</tr>
				<?php   
						$sl=0;
						$total = 0;
						
						while($fetchDailyAmmount = $resultAmmount->fetch_array()){
						$sl++;
						
						$totalpaidamoutbyvou="SELECT SUM(`paid_amount`) FROM `student_paid_table` WHERE `student_id`='$fetchDailyAmmount[student_id]' and `year`='".$_POST["year"]."'";

						$excresult = $db->select_query($totalpaidamoutbyvou)->fetch_array();
					    $total = $total+$excresult[0];
						
						
						// $totalpaidammount = "SELECT SUM(`paid_amount`) FROM `student_paid_table` WHERE `student_id`='".$fetchDailyAmmount["student_id"]."' AND `year`='".$_POST["year"]."'";
						
						// $resultpaidamm   = $db->select_query($totalpaidammount);
						// if($resultpaidamm  -> num_rows >0){
						// $fettotalpaid  = $resultpaidamm->fetch_array();
							
						// }
						
						
						
						
// 						$totalAmmountbyStudent = "SELECT `student_account_info`.`fee_id`,`studentID`,`add_fee`.`amount`,SUM(`add_fee`.`amount`) FROM `student_account_info`
// INNER JOIN  `add_fee` ON `add_fee`.`id`=`student_account_info`.`fee_id` WHERE `student_account_info`.`studentID`='".$fetchDailyAmmount["student_id"]."' and `student_account_info`.`year`='".$_POST["year"]."'";
// 				$resultAmmountBystudent   = $db->select_query($totalAmmountbyStudent);
// 						if($resultAmmountBystudent  -> num_rows >0){
// 								$fetchAmmountBystudent  = $resultAmmountBystudent->fetch_array();
								
// 						}
						
						// $totaldiscount ="SELECT SUM(`add_discount`.`discount`) FROM `add_discount` WHERE `student_id`='$fetchDailyAmmount[student_id]' AND  `year`='".$_POST["year"]."'";
						// $exedis =  $db->select_query($totaldiscount)->fetch_array();
						// $totalammount = $fetchAmmountBystudent[3]-$exedis[0];
						
					
						
				?>
					
				<tr>
					<td width="24"><?php echo $sl;?></td>
					<td><?php echo $fetchDailyAmmount["date"];?></td>
					<td width="106">

						<a target="_blank" href='student_print_vaocher.php?id="<?php echo $fetchDailyAmmount["student_id"];?>"&&Lid="dddd"&&year="<?php echo  $_POST["year"];?>"&&date="<?php echo $_POST["date"] ;?>"&&clas="<?php echo $fetchDailyAmmount["class_id"].'and'.'name';?>"&&last_id="<?php echo $fetchDailyAmmount["voucher"];?>"'>

						<?php echo $fetchDailyAmmount["voucher"];?>
					
				</a></td>

				<td><?php echo $fetchDailyAmmount[0];?></td>
					
					<td ><?php
							$forStudentNameAnoroll="SELECT `running_student_info`.`class_roll`,`student_personal_info`.`student_name` FROM `running_student_info`
INNER JOIN `student_personal_info` ON `student_personal_info`.`id`=`running_student_info`.`student_id`
WHERE `running_student_info`.`student_id`='".$fetchDailyAmmount["student_id"]."'";
							$resulforStudent=$db->select_query($forStudentNameAnoroll);
								if($resulforStudent->num_rows > 0){
								
								$fetcForstudent =$resulforStudent->fetch_array();
								}
					 echo $fetcForstudent["class_roll"];?></td>

					 <td><?php  echo $fetcForstudent["student_name"];?></td>



					 <td width="199"><?php 
							$forClassName= "SELECT `class_name` FROM `add_class` WHERE `id`='".$fetchDailyAmmount["class_id"]."'";
							$resulclassName = $db->select_query($forClassName);
								if($resulclassName->num_rows > 0){
										$fetchClassName = $resulclassName->fetch_array();
								}
					
					echo $fetchClassName["class_name"];?></td>


					<td width="116"><?php echo  $db->my_money_format($excresult[0]);?></td>
			<!-- 	<td width="155"><?php echo $db->my_money_format($fettotalpaid [0]);?></td>
					<td width="119"><?php echo $db->my_money_format($totalammount);?></td> -->
				</tr>
				<?php }?>
				<tr>
					<td colspan="7"  align="right"><strong>Today Total Paid  Ammount</strong></td>
					<td ><strong><?php echo $db->my_money_format($total);?></strong></td>
				
				</tr>
				<?php } else { ?>
				<tr>
					<td  colspan="6" align="right">
						<span><strong class="text-danger">No Data Have Found !!!</strong></span>
					</td>
					
				</tr>
				<?php } 
				
				
	
	}  
	
	
	
?>
			
			
			
			
			
			