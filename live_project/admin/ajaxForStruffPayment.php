<?php
	error_reporting(1);
@session_start();
	require_once("../db_connect/config.php");
	require_once("../db_connect/conect.php");
	$db = new database();
	
	
		if(isset($_POST["name"])){
		
				if(!empty($_POST["id"])){
				$a = [];
				 $forTeacherInfo="SELECT `stuff_name`,`designation`,`mobile_no` FROM  `stuff_information` WHERE `stuff_id`='".$_POST["id"]."'";
				$resultForinof=$db->select_query($forTeacherInfo);
							if($resultForinof->num_rows> 0){
							
									$fetch=$resultForinof->fetch_assoc();
							//$a  = array('name' =>$fetch['student_name'],'Sess'=>$fetch['session2']);
							//$msg=json_encode($a);
							$msg = $fetch['stuff_name'].'/'.$fetch['designation'].'/'.$fetch['mobile_no'];
							echo $msg;
							}

							}
							
					}
					
					if(isset($_POST["paybalAMmount"])){
				
						if(!empty($_POST["id"])){
									$paybalAMMount="SELECT * FROM `struffpayablemastertable` WHERE `struffId`='".$_POST["id"]."'";
									$result = $db->select_query($paybalAMMount);
									if($result ->num_rows > 0){
											$fetchResult = $result->fetch_array();
											$msg = $fetchResult['payAmmount'];
												echo $msg;
									}
						}
				}
				
				if(isset($_POST["AddandDelete"])){
				 $makeid=$db->autogenerat('struffpaymenthistory','id','PID-','9');
  				$makeidCost=$db->autogenerat('other_cost','id','OTC-','9');
					
							
						if(!empty($_POST["paidAmount"])){
							
							   
						
								$insert_fee="INSERT INTO `struffpaymenthistory` (`id`,`stuffId`,`date`,`year`,`current_ammount`,`payment_ammount`,`userId`) VALUES('$makeid','".$_POST['struffID']."','".date('d/m/Y')."','".date('Y')."','".$_POST['totalpayable']."','".$_POST['paidAmount']."','".$_SESSION["id"]."')";
       								 $check_insert=$db->insert_query($insert_fee);
									   $makeid=$db->autogenerat('struffpaymenthistory','id','PID-','9');
									 if(isset($check_insert)){
									 
									 		  $updatess="UPDATE `struffpayablemastertable` SET `Payable_Date`='".date('d/m/Y')."',`payAmmount`='".$_POST["duammmount"]."' where struffId='".$_POST['struffID']."'";
											   $update=$db->update_query($updatess);
									 		 $insert_cost="INSERT INTO `other_cost` (`id`,`date`,`title`,`description`,`amount`,`admin_id`) VALUES('$makeidCost','".date('d/m/Y')."','Struff Payment','CostFor-".$_POST['struffName']."','".$_POST['paidAmount']."','".$_SESSION["id"]."')";
      										  $check_insertAA=$db->insert_query($insert_cost);
											  	$makeidCost=$db->autogenerat('other_cost','id','OTC-','9');
												
												if(isset($db->sms)){
												echo $db->sms;
												}
									 }
						}else {
								echo "<span class='text-center text-danger glyphicon glyphicon-remove'><strong>Please Fill Up Important Fields..!!</strong></span>";
						}
				}
				
	?>
	<?php
						if(isset($_POST["showDAta"])){
						 $projectinof = "SELECT * FROM `project_info`";
				$resultSql=$db->select_query($projectinof);
					if($resultSql ->num_rows  > 0 ){
					$fetchSql = $resultSql->fetch_array(); }
					
					  $forInformation ="SELECT `struffpaymenthistory`.*,`stuff_information`.`stuff_name`,`designation`,`mobile_no`
FROM `struffpaymenthistory` INNER JOIN `stuff_information` ON `stuff_information`.`stuff_id`=`struffpaymenthistory`.`stuffId`
WHERE `struffpaymenthistory`.`stuffId`='".$_POST["struffID"]."'";
					$resultFormation = $db->select_query($forInformation);
							if($resultFormation->num_rows > 0){
									$fetchFormation =$resultFormation->fetch_array();
									 $forAlltitle = "SELECT `struffpayablesetup`.*,`add_payment_title`.`payment_title` FROM `struffpayablesetup`
INNER JOIN `add_payment_title` ON `add_payment_title`.`id`=`struffpayablesetup`.`title`
WHERE `struffpayablesetup`.`struffId`='".$fetchFormation["stuffId"]."'";
											$resultForTitla = $db->select_query($forAlltitle);
							}
							$foraccountannaem = "SELECT `Name` FROM `admin_users` WHERE `id`='".$fetchFormation["userId"]."'";
								$foaccountresult = $db->select_query($foraccountannaem);
									if($foaccountresult->num_rows > 0){
										$fetchforamm=$foaccountresult->fetch_array();
									}
					
						?>
							<table class="table table-bordered col-md-12  col-lg-12" style="margin-top:10px;">
									<tr>
											<td height="91" align="center" colspan="3"><strong><span style="font-size:15px;"><?php echo $fetchSql["institute_name"];?></span><br/>
											<span style="font-size:13px;"><?php echo $fetchSql["phone_number"];?></span>&nbsp;,<span style="font-size:13px;">&nbsp; &nbsp;<?php echo $fetchSql["email"];?></span><br/>
												<span style="font-size:13px;"><?php echo $fetchSql["location"];?></span>
									  </strong></td>
									</tr>		
									<tr>
										<td colspan="3">
												<table style="width:100%;" align="center">
														<tr>
											<td><span style="padding-left:10px;">Date</span></td>
												<td align="center">:</td>
												<td><span style="padding-left:10px;"><?php echo date('d/m/Y');?></span></td>
											<td><span style="padding-left:10px;">Struff Name</span></td>
											<td align="center">:</td>
											<td><span style="padding-left:10px;"><?php echo $fetchFormation["stuff_name"];?></span></td>
											
									</tr>
									<tr>
											<td><span style="padding-left:10px;">Voucer ID</span></td>
												<td align="center">:</td>
												<td><span style="padding-left:10px;"><?php echo $fetchFormation["id"];?></span></td>
											<td><span style="padding-left:10px;">Designation </span></td>
											<td align="center">:</td>
											<td><span style="padding-left:10px;"><?php echo $fetchFormation["designation"];?></span></td>
											
									</tr>
									<tr>
											<td><span style="padding-left:10px;">Accountant Name</span></td>
											<td>:</td>
											<td><span style="padding-left:10px;"><?php echo $fetchforamm["Name"];?></span></td>
											<td><span style="padding-left:10px;">Mobile No</span></td>
											<td align="center">:</td>
											<td><span style="padding-left:10px;"><?php echo $fetchFormation["mobile_no"];?></span></td>
											
									</tr>
												</table>
										</td>
									</tr>
									
									<tr>
										<td><span style="padding-left:10px;"><strong>Sl</strong></span></td>
										<td><span style="padding-left:10px;"><strong>Title</strong></span></td>
										<td><span style="padding-left:10px;"><strong>Taka</strong></span></td>
									</tr>
									
									<?php 
											if($resultForTitla->num_rows  >0 ){
											$sl = 0;
											$total = 0;
													while($fetchFortitle = $resultForTitla->fetch_array()){
													$total =$total+$fetchFortitle["ammount"];
													$sl++;
									?>
									<tr>
											<td><span style="padding-left:10px;"><?php echo $sl;?></span></td>
										<td><span style="padding-left:10px;"><?php echo $fetchFortitle["payment_title"];?></span></td>
										<td><span style="padding-left:10px;"><?php echo $db->my_money_format($fetchFortitle["ammount"]);?></span></td>
										</tr>	
											<?php } ?>
													<tR>
														<td colspan="2" align="right"><span style="padding-left:10px;">Total Ammount</span></td>
													<td><span style="padding-left:10px;"><?php echo $db->my_money_format($total);
												


													?></span></td>
												</tR>
												
												<?php 
														$forPayableAmmount ="SELECT `payAmmount` FROM `struffpayablemastertable` WHERE `struffId`='".$fetchFormation["stuffId"]."'" ;
														$resultPaymbalAMmount = $db->select_query($forPayableAmmount);
															if($resultPaymbalAMmount->num_rows > 0){
																	$fetchPaybalAmmount =$resultPaymbalAMmount->fetch_array();
															}
												?>
													
												<?php 
														  $forPaidAmmount ="SELECT SUM(`payment_ammount`) FROM `struffpaymenthistory` WHERE `stuffId`='".$fetchFormation["stuffId"]."' AND `year`='".date('Y')."'";
														$resultPaidAmmount = $db->select_query($forPaidAmmount);
															if($resultPaidAmmount->num_rows > 0){
																$fetchpaidAmmon= $resultPaidAmmount->fetch_array();
																
															}
												?>
													<tR>
														<td colspan="2" align="right"><span style="padding-left:10px;">Paid Ammount</span></td>
													<td><span style="padding-left:10px;"><?php echo $db->my_money_format($fetchpaidAmmon[0])?></span></td>
												</tR>
												<tR>
														<td colspan="2" align="right"><span style="padding-left:10px;">Due Ammount</span></td>
													<td><span style="padding-left:10px;"><?php echo $db->my_money_format($fetchPaybalAmmount["payAmmount"]);?></span></td>
												</tR>
											<?php  }?>
									
							</table>
						<?php }
				?>
	