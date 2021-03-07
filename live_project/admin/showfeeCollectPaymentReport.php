<?php
    error_reporting(1);
	@session_start();
    require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
	 $db = new database();
	 
			?>
			<?php
			if(isset($_POST["forDaily"])){
				
			$dailyAmmount = "SELECT * FROM `student_paid_table` WHERE `date`='".$_POST["date"]."'  GROUP BY `student_paid_table`.`voucher` ORDER BY `student_paid_table`.`student_id` ASC ";
			$resultAmmount = $db->select_query($dailyAmmount);
				if($resultAmmount->num_rows  > 0){
			
		?><Div class="col-md-12 col-lg-12" style="margin-top:10px;">
			<table class="table table-bordered">
			<tr>
					<td width="24">Class </td>
					<?php
							 $substrDate = substr($_POST["date"],6,4);
							 $selectColumn = "SELECT * FROM `coloumn_setup` WHERE `year`='$substrDate'";
							$resultColumn = $db->select_query($selectColumn);
							if($resultColumn->num_rows > 0){
								while($fetch_column = $resultColumn->fetch_array()){
					?>
					<td width="106"><?php echo $fetch_column["Name"];?></td>
					
					<?php } }?>
					<td width="24">Total </td>
				</tr>
					
					
				
				<?php
						 $selectClass = "SELECT * FROM `add_class` ORDER BY `id` ASC";
						$resultCls = $db->select_query($selectClass);
							if($resultCls->num_rows > 0){
									while($fetchcls = $resultCls->fetch_array()){
									?>
									</tr>
										<td>
											<?php echo $fetchcls["class_name"];?>
										</td>
										<?php
										$resultColumn2 = $db->select_query($selectColumn);
											if($resultColumn2->num_rows > 0){
											$totalAmmount = 0;
											while($fetch_column2 = $resultColumn2->fetch_array()){
										?>
										<td>
											<?php
												  	$selectPaidAmmount = "SELECT `student_paid_table`.*,`columnwisefeesetupforstd`.*,SUM(`student_paid_table`.`paid_amount`) AS totalpaid FROM `student_paid_table` INNER JOIN `columnwisefeesetupforstd` ON `columnwisefeesetupforstd`.`fk_fee_id`=`student_paid_table`.`fk_fee_id` 
WHERE `student_paid_table`.`class_id`='$fetchcls[0]' AND `student_paid_table`.`year`='$substrDate' AND `student_paid_table`.`date`='".$_POST["date"]."' AND columnwisefeesetupforstd.`fk_column_id`='$fetch_column2[0]' GROUP BY columnwisefeesetupforstd.`fk_column_id`";
									$reuslPa=$db->select_query($selectPaidAmmount);
										if($reuslPa->num_rows > 0){
												$fetchPa = $reuslPa->fetch_array();
												echo  $db->my_money_format($fetchPa["totalpaid"]);
												$totalAmmount = $totalAmmount+$fetchPa["totalpaid"];
										}else {
											echo $fetchPa["totalpaid"] = "";
										}
											?>
										</td>
										<?php }  } ?>
									<td>
											<?php echo $db->my_money_format($totalAmmount);?>
										</td>
									<tr>
									<?php
									
									}							
							}
				?>
				
				
			</table>
			</Div>	
			
					<?php }  }
	 
	 ?>
	 
	 <?php
			if(isset($_POST["monthlyreport"])){
				
			 $dailyAmmount = "SELECT * FROM `student_paid_table` WHERE `month`='".$_POST["month"]."'  GROUP BY `student_paid_table`.`voucher` ORDER BY `student_paid_table`.`student_id` ASC ";
			$resultAmmount = $db->select_query($dailyAmmount);
				if($resultAmmount->num_rows  > 0){
			
		?>
		<Div class="col-md-12 col-lg-12" style="margin-top:10px;">
			<table class="table table-bordered">
			<tr>
					<td width="24">Class </td>
					<?php
							 $substrDate = substr($_POST["date"],6,4);
							 $selectColumn = "SELECT * FROM `coloumn_setup` WHERE `year`='".$_POST["year"]."'";
							$resultColumn = $db->select_query($selectColumn);
							if($resultColumn->num_rows > 0){
								while($fetch_column = $resultColumn->fetch_array()){
					?>
					<td width="106"><?php echo $fetch_column["Name"];?></td>
					
					<?php } }?>
					<td width="24">Total </td>
				</tr>
				
					<?php
						 $selectClass = "SELECT * FROM `add_class` ORDER BY `id` ASC";
						$resultCls = $db->select_query($selectClass);
							if($resultCls->num_rows > 0){
									while($fetchcls = $resultCls->fetch_array()){
									?>
									</tr>
										<td>
											<?php echo $fetchcls["class_name"];?>
										</td>
										<?php
										$resultColumn2 = $db->select_query($selectColumn);
											if($resultColumn2->num_rows > 0){
											$totalAmmount = 0;
											while($fetch_column2 = $resultColumn2->fetch_array()){
										?>
										<td>
											<?php
												   	$selectPaidAmmount = "SELECT `student_paid_table`.*,`columnwisefeesetupforstd`.*,SUM(`student_paid_table`.`paid_amount`) AS totalpaid FROM `student_paid_table` INNER JOIN `columnwisefeesetupforstd` ON `columnwisefeesetupforstd`.`fk_fee_id`=`student_paid_table`.`fk_fee_id` 
WHERE `student_paid_table`.`class_id`='$fetchcls[0]' AND `student_paid_table`.`year`='".$_POST["year"]."' AND `student_paid_table`.`month`='".$_POST["month"]."' AND columnwisefeesetupforstd.`fk_column_id`='$fetch_column2[0]' GROUP BY columnwisefeesetupforstd.`fk_column_id`";
									$reuslPa=$db->select_query($selectPaidAmmount);
										if($reuslPa->num_rows > 0){
												$fetchPa = $reuslPa->fetch_array();
												echo  $db->my_money_format($fetchPa["totalpaid"]);
												$totalAmmount = $totalAmmount+$fetchPa["totalpaid"];
										}else {
											echo $fetchPa["totalpaid"] = "";
										}
											?>
										</td>
										<?php }  } ?>
									<td>
											<?php echo $db->my_money_format($totalAmmount);?>
										</td>
									<tr>
									<?php
									
									}							
							}
				?>
				
				
				
				</table>
		</Div>
		<?php } } ?>
		
		
	 <?php
			if(isset($_POST["showEarlypost"])){
				
			 $dailyAmmount = "SELECT * FROM `student_paid_table` WHERE `year`='".$_POST["year1"]."'  GROUP BY `student_paid_table`.`voucher` ORDER BY `student_paid_table`.`student_id` ASC ";
			$resultAmmount = $db->select_query($dailyAmmount);
				if($resultAmmount->num_rows  > 0){
			
		?>
		<Div class="col-md-12 col-lg-12" style="margin-top:10px;">
			<table class="table table-bordered">
			<tr>
					<td width="24">Class </td>
					<?php
							 $substrDate = substr($_POST["date"],6,4);
							 $selectColumn = "SELECT * FROM `coloumn_setup` WHERE `year`='".$_POST["year1"]."'";
							$resultColumn = $db->select_query($selectColumn);
							if($resultColumn->num_rows > 0){
								while($fetch_column = $resultColumn->fetch_array()){
					?>
					<td width="106"><?php echo $fetch_column["Name"];?></td>
					
					<?php } }?>
					<td width="24">Total </td>
				</tr>
				
					<?php
						 $selectClass = "SELECT * FROM `add_class` ORDER BY `id` ASC";
						$resultCls = $db->select_query($selectClass);
							if($resultCls->num_rows > 0){
									while($fetchcls = $resultCls->fetch_array()){
									?>
									</tr>
										<td>
											<?php echo $fetchcls["class_name"];?>
										</td>
										<?php
										$resultColumn2 = $db->select_query($selectColumn);
											if($resultColumn2->num_rows > 0){
											$totalAmmount = 0;
											while($fetch_column2 = $resultColumn2->fetch_array()){
										?>
										<td>
											<?php
												   	$selectPaidAmmount = "SELECT `student_paid_table`.*,`columnwisefeesetupforstd`.*,SUM(`student_paid_table`.`paid_amount`) AS totalpaid FROM `student_paid_table` INNER JOIN `columnwisefeesetupforstd` ON `columnwisefeesetupforstd`.`fk_fee_id`=`student_paid_table`.`fk_fee_id` 
WHERE `student_paid_table`.`class_id`='$fetchcls[0]' AND `student_paid_table`.`year`='".$_POST["year1"]."'  AND columnwisefeesetupforstd.`fk_column_id`='$fetch_column2[0]' GROUP BY columnwisefeesetupforstd.`fk_column_id`";
									$reuslPa=$db->select_query($selectPaidAmmount);
										if($reuslPa->num_rows > 0){
												$fetchPa = $reuslPa->fetch_array();
												echo  $db->my_money_format($fetchPa["totalpaid"]);
												$totalAmmount = $totalAmmount+$fetchPa["totalpaid"];
										}else {
											echo $fetchPa["totalpaid"] = "";
										}
											?>
										</td>
										<?php }  } ?>
									<td>
											<?php echo $db->my_money_format($totalAmmount);?>
										</td>
									<tr>
									<?php
									
									}							
							}
				?>
				
				
				
				</table>
		</Div>
		
		<?php }  }?>
		
		<?php
		
				if(isset($_GET["std"]))
				{
				 		$stdselectFess = "SELECT * FROM `student_paid_table` WHERE `student_id`='".$_GET["id"]."' AND `class_id`='".$_GET["clas"]."' AND `year`='".$_GET["yearstd"]."'";
							$resultstdFees = $db->select_query($stdselectFess);
								if($resultstdFees->num_rows > 0){
				
				?>
				<Div class="col-md-12 col-lg-12" style="margin-top:30px; margin-left:50px;">
						<table class="table table-bordered" border="1" cellpadding="0" cellspacing="0" style="width:1000px;">
								<tr align="center">
									<td width="24">মাস </td>
									<td width="24">রশিদ নং</td>
									<td width="24">বকেয়া</td>
									<?php
											 $substrDate = substr($_POST["date"],6,4);
											  $selectFee = "SELECT * FROM `add_fee` WHERE `year`='".$_GET["yearstd"]."' and `class_id`='".$_GET["clas"]."'";
											$resultFee = $db->select_query($selectFee);
											if($resultFee->num_rows > 0){
												while($fetchFee = $resultFee->fetch_array()){
									?>
									<td width="106"><?php echo $fetchFee["title"];?></td>
									
									<?php } }?>
									<td width="24">মোট  </td>
									<td width="24">মোট  আদায়</td>
									<td width="24">মোট  বাকী</td>
									<td width="24">আদায়কারীর স্বাক্ষর ও তারীখ</td>
									<td width="24">মন্তব্য</td>
								</tr>
								
								<?php
										$selectMonth = "SELECT * FROM  `month_setup` ORDER BY `id` ASC";
										$resultMonth = $db->select_query($selectMonth);
											if($resultMonth->num_rows > 0){
												while($fetchMonth = $resultMonth->fetch_array()){
												?>
												<tr align="">
												<td width="24" style="padding-left:5px;"><?php echo  $fetchMonth["name"];?> </td>
												<td></td>
												<td></td>
													<?php 
													$resultFeew = $db->select_query($selectFee);
											if($resultFeew->num_rows > 0){
												while($fetchFeew = $resultFeew->fetch_array()){
												
													
												?>
													<td width="106" align="center"><?php
													$selemmount = "SELECT `student_account_info`.*,`add_fee`.`title`,`amount`,`id` FROM `student_account_info`
INNER JOIN `add_fee`  ON `student_account_info`.`fee_id`=`add_fee`.`id` WHERE `student_account_info`.`studentID`='".$_GET["id"]."' AND
`student_account_info`.`class_id`='".$_GET["clas"]."' AND `student_account_info`.`fee_id`='$fetchFeew[id]' AND `student_account_info`.`year`='".$_GET["yearstd"]."'  AND `add_fee`.`fk_month_id`='$fetchMonth[id]' ";
														$resultaccamm = $db->select_query($selemmount);
															if($resultaccamm->num_rows > 0){
																	$fetchResulacc = $resultaccamm ->fetch_array();
																	 	$paidAmmount = "SELECT `student_paid_table`.*,SUM(`student_paid_table`.`paid_amount`) AS totalPaid FROM `student_paid_table`
WHERE `student_paid_table`.`class_id`='".$_GET["clas"]."' AND `student_paid_table`.`year`='".$_GET["yearstd"]."' AND `student_paid_table`.`student_id`='".$_GET["id"]."' AND `student_paid_table`.`fk_fee_id`='$fetchFeew[id]'";
																	$resultPaidAmmount = $db->select_query($paidAmmount);
																		if($resultPaidAmmount->num_rows > 0){
																				$fetchPaidAmmount = $resultPaidAmmount->fetch_array();
																				print   $db->my_money_format($fetchPaidAmmount["totalPaid"]);
																		}
																		else{
																		 $fetchPaidAmmount["totalPaid"] ="";
																		}
															}
												?>
												</td>	
												<?php } }
													?>
												<td width="24"></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												</tr>
												<?php
												}
											}
								?>
						</table>
				</Div>
							<?php
				
				
				 } }
		?>