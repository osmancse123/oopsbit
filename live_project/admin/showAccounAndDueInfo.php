<?php
    error_reporting(1);
	@session_start();
    require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
	 $db = new database();
	 

?>

		<?php
				if(isset($_POST["forteacher"])){
				$sql = "SELECT `teacher_payable_master_table`.*,`teachers_information`.`teachers_name`,`designation` FROM `teacher_payable_master_table`
INNER JOIN `teachers_information` ON `teacher_payable_master_table`.`teacher_id`=`teachers_information`.`teachers_id`
WHERE `teacher_payable_master_table`.`teacher_id`='".$_POST["teacherId"]."' AND RIGHT(`payable_date`,4)='".$_POST["Years"]."'";
				$resultSql =  $db->select_query($sql);
					if($resultSql->num_rows > 0){
							$fetchSql = $resultSql->fetch_array();
							
							
							
					
				?>
				<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Teacher Account Info</h4>
      </div>
      <div class="modal-body" style="height:300px;">
       <?php
	   		 $projectinof = "SELECT * FROM `project_info`";
				$resultSql2=$db->select_query($projectinof);
					if($resultSql2 ->num_rows  > 0 ){
					$fetchSql1 = $resultSql2->fetch_array();
					}
					
					$forInformation = "SELECT `teachers_name`,`designation`,`teachers_id`,`email`,`mobile_no` FROM `teachers_information` WHERE `teachers_id`='".$fetchSql[0]."'";
							$resultINformaion = $db->select_query($forInformation);
								if($resultINformaion ->num_rows > 0){
										$fetchInforrmaiont  =$resultINformaion ->fetch_array();
								}
	   ?>
	   <div class=" col-lg-12 col-md-12">
				
								<div class="col-lg-12 col-md-12 table-bordered" style="text-align:center; margin-top:10px;">
								<strong><span style="font-size:15px;"><?php echo $fetchSql1["institute_name"];?></span><br/>
											<span style="font-size:13px;"><?php echo $fetchSql1["phone_number"];?></span>&nbsp;,<span style="font-size:13px;">&nbsp; &nbsp;<?php echo $fetchSql1["email"];?></span><br/>
												<span style="font-size:13px;"><?php echo $fetchSql1["location"];?></span>
									  </strong>
								</div>
								
								<div class="col-lg-6 col-md-6 table-bordered" style="margin-top:0px;">
									<Div>	<span style="font-size:13px; font-weight:500;">&nbsp;Date &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : </span>
										<span style="font-size:13px; font-weight:500">&nbsp;&nbsp;<?php echo date('d/m/Y');?></span></Div>
										
											<Div>	<span style="font-size:13px; font-weight:500;">&nbsp;Teacher Name &nbsp;&nbsp;&nbsp;&nbsp;: </span>
										<span style="font-size:13px; font-weight:500">&nbsp;&nbsp;<?php echo $fetchInforrmaiont["teachers_name"];?></span></Div>
																
										<Div>	<span style="font-size:13px; font-weight:500;">&nbsp;Designation &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; : </span>
										<span style="font-size:13px; font-weight:500">&nbsp;&nbsp;<?php 
													
														echo $fetchInforrmaiont["designation"];?></span></Div>
										
								</div>
								<Div class="col-lg-6 col-md-6 table-bordered" style="margin-top:0px;">
								<Div>	<span style="font-size:13px; font-weight:500;">&nbsp;Teacher ID  &nbsp;&nbsp; :</span>
										<span style="font-size:13px; font-weight:500">&nbsp;&nbsp;<?php echo $fetchInforrmaiont["teachers_id"];?></span></Div>
										
										<Div>	<span style="font-size:13px; font-weight:500;">&nbsp;Email &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</span>
										<span style="font-size:13px; font-weight:500">&nbsp;&nbsp;<?php echo $fetchInforrmaiont["email"];?></span></Div>
										
										<Div>	<span style="font-size:13px; font-weight:500;">&nbsp;Mobile No &nbsp;&nbsp; &nbsp;:</span>
										<span style="font-size:13px; font-weight:500">&nbsp;&nbsp;<?php echo $fetchInforrmaiont["mobile_no"];?></span></Div>
								
								</Div>
								<?php
										$forTotalAmmount = "SELECT SUM(`amount`) FROM `teacher_payable_table` WHERE `id`='".$_POST["teacherId"]."'  AND RIGHT(`date`,4)='".$_POST["Years"]."'";
										$resultForammun = $db->select_query($forTotalAmmount);
											if($resultForammun ->num_rows > 0){
											$fetchForammount =$resultForammun ->fetch_array();
											}
											
										 	$fortotalpiandammount = "SELECT SUM(`payment_amout`) FROM `teacher_payment_history` WHERE `teacher_id`='".$_POST["teacherId"]."' AND RIGHT(`date`,4)='".$_POST["Years"]."'";
											$resultForpaidAmmount  =$db->select_query($fortotalpiandammount);
												if($resultForpaidAmmount ->num_rows > 0){
													$fetchForPaidAmmount = $resultForpaidAmmount ->fetch_array();
												}
										
								?>
								<Div class="col-lg-9 col-md-9 table-bordered"><strong>&nbsp;&nbsp;Total Ammount</strong></strong></Div>
					<Div class="col-lg-3 col-md-3 table-bordered"><strong><strong>&nbsp;&nbsp;<?php echo $db->my_money_format($fetchForammount[0]);//$db->my_money_format($fetchfortitla[9]);?></strong></strong></Div>
					<Div class="col-lg-9 col-md-9 table-bordered"><strong>&nbsp;&nbsp;Total Paid Ammount </strong></strong></Div>
					<Div class="col-lg-3 col-md-3 table-bordered"><strong><strong>&nbsp;&nbsp;<?php echo  $db->my_money_format($fetchForPaidAmmount[0]);//$db->my_money_format($fetchForDetals[4]);?></strong></strong></Div>
					
						<Div class="col-lg-9 col-md-9 table-bordered"><strong>&nbsp;&nbsp;Due Ammount </strong></strong></Div>
					<Div class="col-lg-3 col-md-3 table-bordered"><strong><strong>&nbsp;&nbsp;<?php echo $db->my_money_format($fetchSql["pay_amount"]);//$db->my_money_format($dueAmmount);?></strong></strong></Div>


	</div>
  
  
  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
						<table class="table table-hover table-bordered">
								<tr style="text-align:center">
									<td width="292">Name</td>
									<td width="284">Designation</td>
									
									<td width="194">Present Ammount</td>
								</tr>
								<tr style="text-align:left" style="padding-left:10px;">
									<td width="292"><a href="#" data-toggle="modal" data-target="#myModal"><?php echo $fetchSql["teachers_name"];?></a></td>
									<td width="284"><?php echo $fetchSql["designation"];?></td>
									
									<td width="194"><?php echo $db->my_money_format($fetchSql["pay_amount"]);?></td>
								</tr>
						</table>
				<?php
				  } }
		?>
		
		<?php
				if(isset($_POST["forstruffID"])){
				$sql = "SELECT `struffpayablemastertable`.*,`stuff_information`.`stuff_name`,`designation` FROM `struffpayablemastertable`
INNER JOIN  `stuff_information` ON `struffpayablemastertable`.`struffId`=`stuff_information`.`stuff_id`
WHERE `struffpayablemastertable`.`struffId`='".$_POST["struffID"]."' AND RIGHT(`Payable_Date`,4)='".$_POST["sYears"]."'";
				$resultSql =  $db->select_query($sql);
					if($resultSql->num_rows > 0){
							$fetchSql = $resultSql->fetch_array();
							
							
							
					
				?>
				<div id="myModal" class="modal fade" role="dialog" style="text-align:left">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Struff's Account Info</h4>
      </div>
      <div class="modal-body" style="height:300px;">
       <?php
	   		 $projectinof = "SELECT * FROM `project_info`";
				$resultSql2=$db->select_query($projectinof);
					if($resultSql2 ->num_rows  > 0 ){
					$fetchSql1 = $resultSql2->fetch_array();
					}
					
					$forInformation = "SELECT `stuff_id`,`stuff_name`,`designation`,`mobile_no`,`gender` FROM `stuff_information` WHERE `stuff_id`='".$fetchSql[0]."'";
							$resultINformaion = $db->select_query($forInformation);
								if($resultINformaion ->num_rows > 0){
										$fetchInforrmaiont  =$resultINformaion ->fetch_array();
								}
	   ?>
	   <div class=" col-lg-12 col-md-12">
				
								<div class="col-lg-12 col-md-12 table-bordered" style="text-align:center; margin-top:10px;">
								<strong><span style="font-size:15px;"><?php echo $fetchSql1["institute_name"];?></span><br/>
											<span style="font-size:13px;"><?php echo $fetchSql1["phone_number"];?></span>&nbsp;,<span style="font-size:13px;">&nbsp; &nbsp;<?php echo $fetchSql1["email"];?></span><br/>
												<span style="font-size:13px;"><?php echo $fetchSql1["location"];?></span>
									  </strong>
								</div>
								
								<div class="col-lg-6 col-md-6 table-bordered" style="margin-top:0px;">
									<Div>	<span style="font-size:13px; font-weight:500;">&nbsp;Date &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : </span>
										<span style="font-size:13px; font-weight:500">&nbsp;&nbsp;<?php echo date('d/m/Y');?></span></Div>
										
											<Div>	<span style="font-size:13px; font-weight:500;">&nbsp;Teacher Name &nbsp;&nbsp;&nbsp;&nbsp;: </span>
										<span style="font-size:13px; font-weight:500">&nbsp;&nbsp;<?php echo $fetchInforrmaiont["stuff_name"];?></span></Div>
																
										<Div>	<span style="font-size:13px; font-weight:500;">&nbsp;Designation &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; : </span>
										<span style="font-size:13px; font-weight:500">&nbsp;&nbsp;<?php 
													
														echo $fetchInforrmaiont["designation"];?></span></Div>
										
								</div>
								<Div class="col-lg-6 col-md-6 table-bordered" style="margin-top:0px;">
								<Div>	<span style="font-size:13px; font-weight:500;">&nbsp;Teacher ID  &nbsp;&nbsp; :</span>
										<span style="font-size:13px; font-weight:500">&nbsp;&nbsp;<?php echo $fetchInforrmaiont["stuff_id"];?></span></Div>
										
										<Div>	<span style="font-size:13px; font-weight:500;">&nbsp;Gendar &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</span>
										<span style="font-size:13px; font-weight:500">&nbsp;&nbsp;<?php echo $fetchInforrmaiont["gender"];?></span></Div>
										
										<Div>	<span style="font-size:13px; font-weight:500;">&nbsp;Mobile No &nbsp;&nbsp; &nbsp;:</span>
										<span style="font-size:13px; font-weight:500">&nbsp;&nbsp;<?php echo $fetchInforrmaiont["mobile_no"];?></span></Div>
								
								</Div>
								<?php
										$forTotalAmmount = "SELECT SUM(`ammount`) FROM `struffpayablesetup` WHERE `struffId`='".$_POST["struffID"]."'  AND RIGHT(`date`,4)='".$_POST["sYears"]."'";
										$resultForammun = $db->select_query($forTotalAmmount);
											if($resultForammun ->num_rows > 0){
											$fetchForammount =$resultForammun ->fetch_array();
											}
											
										 	$fortotalpiandammount = "SELECT SUM(`payment_ammount`) FROM `struffpaymenthistory` WHERE `stuffId`='".$_POST["struffID"]."' AND RIGHT(`date`,4)='".$_POST["sYears"]."'";
											$resultForpaidAmmount  =$db->select_query($fortotalpiandammount);
												if($resultForpaidAmmount ->num_rows > 0){
													$fetchForPaidAmmount = $resultForpaidAmmount ->fetch_array();
												}
										
								?>
								<Div class="col-lg-9 col-md-9 table-bordered"><strong>&nbsp;&nbsp;Total Ammount</strong></strong></Div>
					<Div class="col-lg-3 col-md-3 table-bordered"><strong><strong>&nbsp;&nbsp;<?php echo $db->my_money_format($fetchForammount[0]);//$db->my_money_format($fetchfortitla[9]);?></strong></strong></Div>
					<Div class="col-lg-9 col-md-9 table-bordered"><strong>&nbsp;&nbsp;Total Paid Ammount </strong></strong></Div>
					<Div class="col-lg-3 col-md-3 table-bordered"><strong><strong>&nbsp;&nbsp;<?php echo  $db->my_money_format($fetchForPaidAmmount[0]);//$db->my_money_format($fetchForDetals[4]);?></strong></strong></Div>
					
						<Div class="col-lg-9 col-md-9 table-bordered"><strong>&nbsp;&nbsp;Due Ammount </strong></strong></Div>
					<Div class="col-lg-3 col-md-3 table-bordered"><strong><strong>&nbsp;&nbsp;<?php echo $db->my_money_format($fetchSql["payAmmount"]);//$db->my_money_format($dueAmmount);?></strong></strong></Div>


	</div>
  
  
  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
						<table class="table table-hover table-bordered">
								<tr style="text-align:center">
									<td width="292">Name</td>
									<td width="284">Designation</td>
									
									<td width="194">Present Ammount</td>
								</tr>
								<tr style="text-align:left" style="padding-left:10px;">
									<td width="292"><a href="#" data-toggle="modal" data-target="#myModal"><?php echo $fetchSql["stuff_name"];?></a></td>
									<td width="284"><?php echo $fetchSql["designation"];?></td>
									
									<td width="194"><?php echo $db->my_money_format($fetchSql["payAmmount"]);?></td>
								</tr>
						</table>
				<?php
				  } }
		?>
		
		
		
		
		
		<?php
				if(isset($_POST["forSTudent"])){
				
				$forChek="SELECT `studentID`,`class_id` FROM `student_account_info` WHERE `year`='".$_POST["stdYears"]."' AND `studentID`='".$_POST["Student"]."'";
				$resultForChek = $db->select_query($forChek);
					if($resultForChek->num_rows > 0){
				 $sql = "SELECT SUM(`add_fee`.`amount`),`student_account_info`.*,`add_fee`.`amount`,`student_personal_info`.`student_name`,`contact_no`,`email`,`gender` FROM `student_account_info`
INNER JOIN `add_fee` ON `student_account_info`.`fee_id`=`add_fee`.`id` INNER JOIN `student_personal_info` ON `student_personal_info`.`id`=`student_account_info`.`studentID` WHERE `student_account_info`.`studentID`='".$_POST["Student"]."'
AND `student_account_info`.`year`='".$_POST["stdYears"]."'";
				$resultSql =  $db->select_query($sql);
					if($resultSql->num_rows > 0){
					
						
					
							$fetchSql = $resultSql->fetch_array();
							
								$FORdISScount = "SELECT SUM(`discount`) FROM  `add_discount` WHERE `student_id`='".$_POST["Student"]."' AND `year`='".$_POST["stdYears"]."'";
								$fordiscount = $db->select_query($FORdISScount);
										if($fordiscount->num_rows > 0){
												$ferdiscount = $fordiscount->fetch_array();
										}
							$forSql = "SELECT SUM(`paid_amount`) FROM `student_paid_table` WHERE `student_id`='".$_POST["Student"]."' AND `year`='".$_POST["stdYears"]."'";
							
							$resultForsql = $db->select_query($forSql);
									if($resultForsql ->num_rows > 0){
											$fetchForSql  = $resultForsql->fetch_array();
										//	print_r($fetchForSql);
										
										$dueAmmount = $fetchSql[0]-$fetchForSql[0]-$ferdiscount[0];
										
									}
							
							
					
				?>
				<div id="myModal" class="modal fade" role="dialog" style="text-align:left">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Student Account Info</h4>
      </div>
      <div class="modal-body" style="height:300px;">
       <?php
	   		 $projectinof = "SELECT * FROM `project_info`";
				$resultSql2=$db->select_query($projectinof);
					if($resultSql2 ->num_rows  > 0 ){
					$fetchSql1 = $resultSql2->fetch_array();
					}
					
					
	   ?>
	   <div class=" col-lg-12 col-md-12">
				
								<div class="col-lg-12 col-md-12 table-bordered" style="text-align:center; margin-top:10px;">
								<strong><span style="font-size:15px;"><?php echo $fetchSql1["institute_name"];?></span><br/>
											<span style="font-size:13px;"><?php echo $fetchSql1["phone_number"];?></span>&nbsp;,<span style="font-size:13px;">&nbsp; &nbsp;<?php echo $fetchSql1["email"];?></span><br/>
												<span style="font-size:13px;"><?php echo $fetchSql1["location"];?></span>
									  </strong>
								</div>
								
								<div class="col-lg-6 col-md-6 table-bordered" style="margin-top:0px;">
									<Div>	<span style="font-size:13px; font-weight:500;">&nbsp;Date &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : </span>
										<span style="font-size:13px; font-weight:500">&nbsp;&nbsp;<?php echo date('d/m/Y');?></span></Div>
										
											<Div>	<span style="font-size:13px; font-weight:500;">&nbsp;Student Name &nbsp;&nbsp;&nbsp;&nbsp;: </span>
										<span style="font-size:13px; font-weight:500"> &nbsp;&nbsp;<?php echo $fetchSql["student_name"];?></span></Div>
																
										<Div>	<span style="font-size:13px; font-weight:500;">&nbsp;Gendar &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; : </span>
										<span style="font-size:13px; font-weight:500">&nbsp;&nbsp;<?php 
													
														echo $fetchSql["gender"];?></span></Div>
										
								</div>
								<Div class="col-lg-6 col-md-6 table-bordered" style="margin-top:0px;">
								<Div>	<span style="font-size:13px; font-weight:500;">&nbsp;Student ID  &nbsp;&nbsp; :</span>
										<span style="font-size:13px; font-weight:500">&nbsp;&nbsp;<?php echo $fetchSql["studentID"];?></span></Div>
										
										<Div>	<span style="font-size:13px; font-weight:500;">&nbsp;Email &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</span>
										<span style="font-size:13px; font-weight:500">&nbsp;&nbsp;<?php echo $fetchSql["email"];?></span></Div>
										
										<Div>	<span style="font-size:13px; font-weight:500;">&nbsp;Mobile No &nbsp;&nbsp; &nbsp;:</span>
										<span style="font-size:13px; font-weight:500">&nbsp;&nbsp;<?php echo $fetchSql["contact_no"];?></span></Div>
								
								</Div>
								
						
								<Div class="col-lg-9 col-md-9 table-bordered"><strong>&nbsp;&nbsp;Total Ammount</strong></strong></Div>
					<Div class="col-lg-3 col-md-3 table-bordered"><strong><strong>&nbsp;&nbsp;<?php echo $db->my_money_format($fetchSql[0]);//$db->my_money_format($fetchfortitla[9]);?></strong></strong></Div>
					<Div class="col-lg-9 col-md-9 table-bordered"><strong>&nbsp;&nbsp;Total Discount</strong></strong></Div>
					<Div class="col-lg-3 col-md-3 table-bordered"><strong><strong>&nbsp;&nbsp;<?php echo $db->my_money_format($ferdiscount[0]);//$db->my_money_format($fetchfortitla[9]);?></strong></strong></Div>
					<Div class="col-lg-9 col-md-9 table-bordered"><strong>&nbsp;&nbsp;Total Paid Ammount </strong></strong></Div>
					<Div class="col-lg-3 col-md-3 table-bordered"><strong><strong>&nbsp;&nbsp;<?php echo  $db->my_money_format($fetchForSql[0]);//$db->my_money_format($fetchForDetals[4]);?></strong></strong></Div>
					
						<Div class="col-lg-9 col-md-9 table-bordered"><strong>&nbsp;&nbsp;Due Ammount </strong></strong></Div>
					<Div class="col-lg-3 col-md-3 table-bordered"><strong><strong>&nbsp;&nbsp;<?php echo $db->my_money_format($dueAmmount);//$db->my_money_format($dueAmmount);?></strong></strong></Div>


	</div>
  
  
  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
						<table class="table table-hover table-bordered">
								<tr style="text-align:center">
									<td width="292">Name</td>
									<td width="284">Gendar</td>
									
									<td width="194">Due Ammount</td>
								</tr>
								<tr style="text-align:left" style="padding-left:10px;">
									<td width="292"><a href="#" data-toggle="modal" data-target="#myModal"><?php echo $fetchSql["student_name"];?></a></td>
									<td width="284"><?php echo $fetchSql["gender"];?></td>
									
									<td width="194"><?php echo $db->my_money_format($dueAmmount);?></td>
								</tr>
						</table>
				<?php
				 } } }
		?>