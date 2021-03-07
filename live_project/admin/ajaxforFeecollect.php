<?php
		date_default_timezone_set('Asia/Dhaka');
		error_reporting(1);
		@session_start();

		require_once("../db_connect/config.php");
	require_once("../db_connect/conect.php");
	$db = new database();
	
	
		if(isset($_POST["name"])){
						$explodeclass=explode('and',$_POST["ClassId"]);
						$explodegroup=explode('and',$_POST["groupID"]); 

					$a = [];
					$id = $_POST["id"];
					 $sql = "SELECT `student_account_info`.*,`running_student_info`.`class_roll`,`student_personal_info`.`student_name`,`father_name`,`mother_name`,`contact_no`,`student_acadamic_information`.`session2`
FROM `student_account_info` INNER JOIN `running_student_info` ON `running_student_info`.`student_id`=`student_account_info`.`studentID`
INNER JOIN `student_personal_info` ON `student_personal_info`.`id`=`student_account_info`.`studentID` INNER JOIN `student_acadamic_information` ON `student_acadamic_information`.`id`=`student_account_info`.`studentID`
WHERE `student_account_info`.`studentID`='$id' AND `student_account_info`.`groupID`='$explodegroup[0]'
 AND `student_account_info`.`class_id`='$explodeclass[0]'
 GROUP BY `student_account_info`.`studentID`";
					$result = $db->select_query($sql);
					if($result){
							$fetch=$result->fetch_assoc();
							//$a  = array('name' =>$fetch['student_name'],'Sess'=>$fetch['session2']);
							//$msg=json_encode($a);
							$msg = $fetch['student_name'].'/'.$fetch['class_roll'].'/'.$fetch['father_name'].'/'.$fetch['mother_name'].'/'.$fetch['contact_no'].'/'.$fetch['session2'];
							echo $msg;
							}
			}	
			
			if(isset($_POST["totalfees"])){
						$x = [];
						$explodeclass=explode('and',$_POST["ClassId"]);
						$explodegroup=explode('and',$_POST["groupID"]); 
						
					$forTotalammout="SELECT `student_account_info`.*,`add_fee`.`amount`,SUM(`add_fee`.`amount`) FROM `student_account_info`
INNER JOIN  `add_fee` ON `add_fee`.`id`=`student_account_info`.`fee_id` WHERE 
`student_account_info`.`class_id`='$explodeclass[0]' AND `student_account_info`.`groupID`='$explodegroup[0]' AND `student_account_info`.`studentID`='".$_POST["id"]."' AND 
`student_account_info`.`year`='".$_POST["year"]."'";
					$resultFortotal=$db->select_query($forTotalammout);
							if($resultFortotal->num_rows > 0){
									$fetchFortotal = $resultFortotal->fetch_array();
							}
					$forTotalDiscount = "SELECT SUM(`discount`) FROM `add_discount` WHERE  `class_id`='$explodeclass[0]' AND `student_id`='".$_POST["id"]."' AND `year`='".$_POST["year"]."' AND  `group_id`='$explodegroup[0]'";
					$resutTotalDiscount=$db->select_query($forTotalDiscount);
						if($resutTotalDiscount->num_rows > 0){
						
								$fetchFordiscount = $resutTotalDiscount->fetch_array();
						}
						
						 $forPaidAmmount ="SELECT SUM(`paid_amount`) FROM `student_paid_table` WHERE `student_id`='".$_POST["id"]."' AND `class_id`='$explodeclass[0]' AND `groupID`='$explodegroup[0]' AND `year`='".$_POST["year"]."'";
						$resulPaidAmmount = $db->select_query($forPaidAmmount);
							if($resulPaidAmmount->num_rows > 0){
							
									$fetForPaidAmmount = $resulPaidAmmount->fetch_array();
									$totalFaidAmmount = $fetchFortotal[9]-$fetchFordiscount[0]-$fetForPaidAmmount[0];
							}else {
						
						$totalFaidAmmount = $fetchFortotal[9]-$fetchFordiscount[0];
						}
					
					$showmsg = $fetchFortotal[9].'/'.$fetchFordiscount[0].'/'.$totalFaidAmmount.'/'.$fetForPaidAmmount[0];
					echo $showmsg;
			}
			
			
			
			
			if(isset($_POST["dataADD"])){
					
					 $paidAmount=$db->autogenerat('student_paid_table','voucher','Rec-','9');
					$otherIncome=$db->autogenerat('other_income','id','OTI-','9');
									
						if(!empty("paidAmount") && $_POST["paidAmount"] != 0){
						$explodeclass=explode('and',$_POST["className"]);
						$explodegroup=explode('and',$_POST["groupname"]); 
							 	$insertPaidAmmount = "INSERT INTO `student_paid_table` (`student_id`,`voucher`,`class_id`,`groupID`,`paid_amount`,`date`,`admin_id`,`month`,`year`) VALUES ('".$_POST["stdId"]."','$paidAmount','$explodeclass[0]','$explodegroup[0]','".$_POST["paidAmount"]."','".date('d/m/Y')."','".$_SESSION["id"]."','".date('M')."','".$_POST["year"]."')";
								$resulPaidAmmount = $db->insert_query($insertPaidAmmount);
								 $paidAmount=$db->autogenerat('student_paid_table','voucher','Rec-','9');
								if(isset($resulPaidAmmount)){
								$insertOhterincome = "INSERT INTO `other_income` (`id`,`date`,`title`,`description`,`amount`,`admin_id`) VALUES ('$otherIncome','".date('d/m/Y')."','Student Payment','Student ID :".$_POST['stdId']."','".$_POST['paidAmount']."','".$_SESSION["id"]."')";
								$resulOhterIncoem = $db->insert_query($insertOhterincome);
								$otherIncome=$db->autogenerat('other_income','id','OTI-','9');
								}
								
								
								if(isset($db->sms)){
									echo $db->sms;
								}
						}
			}
			
			
			if(isset($_POST["showVoucher"])){
			 $projectinof = "SELECT * FROM `project_info`";
				$resultSql=$db->select_query($projectinof);
					if($resultSql ->num_rows  > 0 ){
					$fetchSql = $resultSql->fetch_array();
						$explodeclass=explode('and',$_POST["className"]);
						$explodegroup=explode('and',$_POST["groupname"]); 
					$forDetailsSql = "SELECT `student_paid_table`.*,`student_personal_info`.`student_name`,`running_student_info`.`class_roll`
FROM `student_paid_table` INNER JOIN `student_personal_info` ON `student_personal_info`.`id`=`student_paid_table`.`student_id`
INNER JOIN `running_student_info` ON `running_student_info`.`student_id`=`student_paid_table`.`student_id`
WHERE `student_paid_table`.`student_id`='".$_POST["stdId"]."' AND `student_paid_table`.`class_id`='$explodeclass[0]' AND `student_paid_table`.`groupID`='$explodegroup[0]'
AND `student_paid_table`.`year`='".$_POST["year"]."' GROUP BY `student_paid_table`.`student_id`";
					$resultFordetailsSql = $db->select_query($forDetailsSql);
						if($resultFordetailsSql->num_rows  > 0){
								$fetchForDetals = $resultFordetailsSql->fetch_array();
						}
					
					?>
							<table class="table-bordered col-md-12  col-lg-12" style="margin-top:10px;">
									<tr>
											<td height="91" align="center" colspan="2"><strong><span style="font-size:15px;"><?php echo $fetchSql["institute_name"];?></span><br/>
											<span style="font-size:13px;"><?php echo $fetchSql["phone_number"];?></span>&nbsp;,<span style="font-size:13px;">&nbsp; &nbsp;<?php echo $fetchSql["email"];?></span><br/>
												<span style="font-size:13px;"><?php echo $fetchSql["location"];?></span>
									  </strong></td>
									</tr>		
									<tr>
											<td height="103" colspan="2">
										
														
														<table>
																<tr>
																		<td width="163" height="27"><span style="font-size:13px; font-weight:500;">&nbsp;Date &nbsp;&nbsp;</span></td>
																		<td width="25">:</td>
																		<td width="451"><span style="font-size:13px; font-weight:500">&nbsp;&nbsp;<?php echo $fetchForDetals["date"];?></span></td>
																		
																			<td width="130" height="21"><span style="font-size:13px; font-weight:500;">&nbsp;Student ID  &nbsp;&nbsp;</span></td>
																		<td width="54">:</td>
																		<td width="455"><span style="font-size:13px; font-weight:500">&nbsp;&nbsp;<?php echo $fetchForDetals["student_id"];?></span></td>
																</tr>
																
																<tr>
																		<td height="37"><span style="font-size:13px; font-weight:500;">&nbsp;Voucher ID  &nbsp;&nbsp;</span></td>
																		<td>:</td>
																		<td><span style="font-size:13px; font-weight:500">&nbsp;&nbsp;<?php echo $fetchForDetals["voucher"];?></span></td>
																		
																			<td height="37"><span style="font-size:13px; font-weight:500;">&nbsp;Name &nbsp;&nbsp;</span></td>
																		<td>:</td>
																		<td><span style="font-size:13px; font-weight:500">&nbsp;&nbsp;<?php echo $fetchForDetals["student_name"];?></span></td>
																</tr>
																<?php
																
																	$forName = "SELECT `Name` FROM `admin_users` WHERE `id`='".$fetchForDetals["admin_id"]."'";
														$resultName=$db->select_query($forName);
														if($resultName->num_rows > 0){
																	$fetchName = $resultName->fetch_array();
														}
														?>
																<tr>
																		<td height="21"><span style="font-size:13px; font-weight:500;">&nbsp;Reciver Name &nbsp;&nbsp;</span></td>
																		<td>&nbsp;:</td>
																		<td><span style="font-size:13px; font-weight:500">&nbsp;&nbsp;<?php 
													
														echo $fetchName["Name"];?></span></td>
														
															<td height="21"><span style="font-size:13px; font-weight:500;">&nbsp;Roll &nbsp;&nbsp;</span></td>
																		<td>:</td>
																		<td><span style="font-size:13px; font-weight:500">&nbsp;&nbsp;<?php echo $fetchForDetals["class_roll"];?></span></td>
																</tr>
														</table>
														
														
														
								
										
											
											
											
												

									  </td>
									</tr>
									<tr>
											<td width="597" align="left"><strong>&nbsp;&nbsp;&nbsp;&nbsp;Fee Title</strong></td>
											<td width="342" align="center"><strong>Ammount</strong></td>
									</tr>
									<?php
									
											$forPaidAmmount = "SELECT SUM(`paid_amount`) FROM `student_paid_table`
WHERE `student_id`='".$_POST["stdId"]."' AND `groupID`='$explodegroup[0]' AND `class_id`='$explodeclass[0]' AND `year`='".$_POST["year"]."'";
											$resultPaidAmmount =$db->select_query($forPaidAmmount);
												if($resultPaidAmmount->num_rows > 0){
														$fetchPaindAMount = $resultPaidAmmount->fetch_array();
												}
											
											$forDiscount = "SELECT SUM(`discount`) FROM `add_discount` WHERE `student_id`='".$_POST["stdId"]."' AND `class_id`='$explodeclass[0]' AND `year`='".$_POST["year"]."' AND `group_id`='$explodegroup[0]'";
											$resulfdiscount = $db->select_query($forDiscount);
												if($resulfdiscount->num_rows > 0){
														$fetchDiscount=$resulfdiscount->fetch_array();
												}
									
											$forTitle="SELECT `student_account_info`.*,`add_fee`.`title`,`amount` FROM `student_account_info`
INNER JOIN `add_fee` ON `add_fee`.`id`=`student_account_info`.`fee_id`
WHERE `student_account_info`.`class_id`='$explodeclass[0]' AND `student_account_info`.`groupID`='$explodegroup[0]' AND 
`student_account_info`.`studentID`='".$_POST["stdId"]."' AND `student_account_info`.`year`='".$_POST["year"]."'";
											$resultForTitle = $db->select_query($forTitle);
												if($resultForTitle->num_rows > 0){
												$sl = 0;
														while($fetchfortitla = $resultForTitle->fetch_array()){
														$total  = $total+$fetchfortitla["amount"];
												$sl++;
									?>
									<tr>
										<td width="597" height="21" ><strong>&nbsp;&nbsp;<?php echo $sl.'&nbsp;|&nbsp;'.$fetchfortitla["title"];?></strong></td>
											<td width="342"><strong>&nbsp;&nbsp;<?php echo $fetchfortitla["amount"];?></strong></td>
									</tr>
									<?php } 
									
									?>
										<tr>
											<Td height="38" align="right"><p><strong>&nbsp;&nbsp;</strong></p>
										    <p><strong>Total Ammount</strong>&nbsp;&nbsp;</p></Td>
											<Td align="left"><p><strong>&nbsp;&nbsp;&nbsp;</strong></p>
										    <p><strong> &nbsp; &nbsp;<?php echo $total;?></strong></p></Td>
										</tr>
										<tr>
											<Td align="right"><strong>&nbsp;&nbsp;Total Discount</strong>&nbsp;&nbsp;</Td>
											<Td align="left"><strong>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $fetchDiscount[0];?></strong></Td>
										</tr>
										<tr>
											<Td align="right"><strong>&nbsp;&nbsp;Total Paid Ammount</strong>&nbsp;&nbsp;</Td>
											<Td align="left"><strong>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $fetchPaindAMount[0];?></strong></Td>
										</tr>
										<?php
												$dueAMmount = $total-$fetchDiscount[0]-$fetchPaindAMount[0];
										?>
										<tr>
											<Td align="right"><strong>&nbsp;&nbsp;Due Ammount</strong>&nbsp;&nbsp;</Td>
											<Td align="left"><strong>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $dueAMmount;?></strong></Td>
										</tr>
                                        <tr>
											<Td align="left" colspan="2">
													<Div class="col-md-6" style="text-align:left; padding-left:5px;">&nbsp;&nbsp;&nbsp;<p><strong>&nbsp;&nbsp;</strong></p>
										    <p><strong style="border-top:1px #000000 solid;">Student Sign</strong>&nbsp;&nbsp;</p></Div>
											<Div class="col-md-6" style="text-align:right; padding-left:5px;">&nbsp;&nbsp;&nbsp;<p><strong>&nbsp;&nbsp;</strong></p>
										    <p><strong style="border-top:1px #000000 solid;">Reciver Sign</strong>&nbsp;&nbsp;</p></Div>
											</Td>
											
										</tr>
											<tr>
													<td colspan="2" align="center">
															<input type="button" onclick="window.print()" value="print" />
															<input type="button" onclick="backPargge()" value="Cancel" />
													</td>
											</tr>
									<?php } ?>
							</table>
					
					<?php
					
					}
			
			}

?>