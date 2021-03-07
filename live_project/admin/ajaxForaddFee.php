<?php
@session_start();
error_reporting(1);
	require_once("../db_connect/config.php");
	require_once("../db_connect/conect.php");
	$db = new database();
	
			if(isset($_POST["name"])){

						$explodeclass=explode('and',$_POST["ClassId"]);
						$explodegroup=explode('and',$_POST["groupID"]); 

					$a = [];
					$id = $_POST["id"];
					 $sql = "SELECT `running_student_info`.*,`student_personal_info`.`student_name` FROM `running_student_info`
INNER JOIN `student_personal_info` ON `student_personal_info`.`id`=`running_student_info`.`student_id`
WHERE `running_student_info`.`class_id`='$explodeclass[0]'
AND `running_student_info`.`student_id`='$id'";
					$result = $db->select_query($sql);
					if($result){
							$fetch=$result->fetch_assoc();
							//$a  = array('name' =>$fetch['student_name'],'Sess'=>$fetch['session2']);
							//$msg=json_encode($a);
							$msg = $fetch['student_name'].'/'.$fetch['class_roll'];
							echo $msg;
							}
			}
			
			if(isset($_POST["showData"])){


					$explodeclass=explode('and',$_POST["ClassId"]);
						$explodegroup=explode('and',$_POST["groupID"]); 
					    $selectFees="SELECT * FROM `running_student_info` WHERE `student_id`='".$_POST["id"]."' AND `class_id`='$explodeclass[0]'";
					$resultFees=$db->select_query($selectFees);


						if(@$resultFees->num_rows>0){
								 $SelecByiffess="SELECT * FROM `add_fee` WHERE `class_id`='$explodeclass[0]'   AND `year`='".$_POST["year"]."'  AND `Common_Exceptional`='Common' ";


							
									$resultbyfeess=$db->select_query($SelecByiffess);
									$count=$resultbyfeess->num_rows;
									if(@$resultbyfeess->num_rows>0){



				?>
				<table class="table-bordered" style="width:100%;">
					<tr>	
						<td > &nbsp; &nbsp;

						 <input type="checkbox" value="checkbox" id="chkbx_all"  onclick="return enable_cb()"> &nbsp; <strong>
						 	<span class="text-danger">Select All</span></strong></input></td>
						<td align="center" width="100"><strong> SL. No. </strong></td>
						<td align="center" ><strong> Title </strong></td>
				
						<td align="center" width="200"><strong> Taka</strong></td>
						<td align="center" width="200"><strong>Total Taka</strong></td>
						
						</tr>

		<?php 
		$sl=0;
				while($fetch_fee=$resultbyfeess->fetch_array()){
					

				$findFe="SELECT * FROM `student_account_info` WHERE `studentID`='".$_POST["id"]."' AND `fee_id`='".$fetch_fee['id']."'";
					$resultFindfe= $db->select_query($findFe);
							if($resultFindfe){
										$fetchFinfe=$resultFindfe->fetch_array();
								}
							if($fetchFinfe["fee_id"] != $fetch_fee["id"]){
			$sl++;
			if($sl=='1'){
		?>		
		<tr>	
		<td  width="120"><input type="checkbox" id="check_elmnt" onclick="return totalShow()" class="check_elmnt" name="fee[]" value="<?php echo $fetch_fee[3].'and'.$fetch_fee[0];?>" />   &nbsp;


			

			


		<input type="hidden" name="forsum[]"  id="forsum-<?php echo $fetch_fee[0];?>" value="<?php echo  $fetch_fee[0]?>" />
		</td>

		<td width="100"><?php echo $sl."&nbsp;" ?></td>

		<td>

			<strong>
				<span class="text-info" style="font-size:15px;"><?php echo $fetch_fee[1];?> </span>
			</strong> 
		</td>

		<td align="center">

			<strong><?php echo  $fetch_fee[3]?></strong></td>


						<td rowspan="<?php echo $count;?>" align="center">
						
						<strong><span id="showresult"> </span></strong>
												</td>
					
						
						</tr>
						<?php } else {?>
			

	<tr>

		<td width="100"><input type="checkbox" id="check_elmnt" onclick="return totalShow()" class="check_elmnt" name="fee[]" value="<?php echo  $fetch_fee[3].'and'.$fetch_fee[0];?>" /> </td>

		<td width="120"> <?php echo $sl."&nbsp;" ?> </td>

		<td><strong><span class="text-info" style="font-size:15px;"><?php echo $fetch_fee[1];?> </span></strong>
		<input type="hidden" name="forsum[]" id="forsum-<?php echo $fetch_fee[0];?>" value="<?php echo  $fetch_fee[0]?>" />
		</td>
				<td align="center">&nbsp;<strong><?php echo  $fetch_fee[3]?></strong></td>
						
						</tr>
			<?php }  } ?>
			
			
		<?php  } ?>	
		</table>	
				<?php 
		 }  }	}
	
	
	
	if(isset($_POST["showDataforcolum"])){
					$explodeclass=explode('and',$_POST["ClassId"]);
						$explodegroup=explode('and',$_POST["groupID"]); 
				
								  $SelecByiffess="SELECT * FROM `add_fee` WHERE `class_id`='$explodeclass[0]'   AND `year`='".$_POST["year"]."'";
									$resultbyfeess=$db->select_query($SelecByiffess);
									$count=$resultbyfeess->num_rows;
									if(@$resultbyfeess->num_rows>0){
				?>
			

		<?php 
		$sl=0;
				while($fetch_fee=$resultbyfeess->fetch_array()){
				
				
			 	   $chekfee = "SELECT * FROM `columnwisefeesetupforstd` WHERE `fk_fee_id`='".$fetch_fee['id']."' AND `fk_cls_id`='$explodeclass[0]'";
					
					$resultchekfee= $db->select_query($chekfee);
					
				//	print_r($resultchekfee);
					if(mysqli_num_rows($resultchekfee)==0){
						
					
				
		
		?>		
	
		<input type="checkbox" name="checkbox[]" value="<?php echo $fetch_fee['id'];?>" /> &nbsp;&nbsp;<?php echo $fetch_fee['title'];?>&nbsp;&nbsp;
			
			
		<?php  }  }   }  	} ?>




	<?php
	
			if(isset($_POST["forsum"])){
			
			if(!empty($_POST["fess"])){
			$sum=0;
					for($a=0;$a < count($_POST["fess"]);$a++){
							$fessTotal=explode("and",$_POST['fess'][$a]);
							
							$sum=$sum+$fessTotal[0];
					}
					echo $sum;
					}
			}
	?>
	
	<?php  
	
			if(isset($_POST["moredata"])){
				$className=explode('and',$_POST["className"]);
				$groupname=explode('and',$_POST["groupname"]);
				$stdId=$_POST["stdId"];
				$year=$_POST["year"];
				
					if(!empty($_POST["fee"])){
				
							for($a=0;$a < count($_POST["fee"]);$a++){
					
								 $feeid=explode("and",$_POST['fee'][$a]);

								 	$insertSql="REPLACE INTO `student_account_info` (`studentID`,`class_id`,`fee_id`,`year`,`admin_id`) VALUES('$stdId','$className[0]','$feeid[1]','$year','".$_SESSION["id"]."')";
									$resultsql=$db->insert_query($insertSql);
							}
							if(isset($db->sms)){
									echo $db->sms;
							}
					}
			}
	?>
	
	<?php
	
			if(isset($_POST["forView"])){
					$className=explode('and',$_POST["className"]);
					$groupname=explode('and',$_POST["groupname"]);
					$stdId=$_POST["stdId"];
					$year=$_POST["year"];

					 $sql="SELECT `student_account_info`.*,`add_class`.`class_name`,`student_personal_info`.`student_name` 
FROM `student_account_info` INNER JOIN `add_class` ON `add_class`.`id`=`student_account_info`.`class_id`  INNER JOIN `student_personal_info` ON 
`student_personal_info`.`id`=`student_account_info`.`studentID` 
WHERE `student_account_info`.`class_id`='$className[0]'  AND `student_account_info`.`year`='$year' AND `student_account_info`.`studentID`='$stdId'
GROUP BY `student_account_info`.`studentID`";
					$resultsql=$db->select_query($sql);
					
						if($resultsql->num_rows > 0){
						$fetchsql=$resultsql->fetch_array();
						?>
							<table class="table table-bordered table-hover" style=" margin-top:20px;">
									<tr>
											<td colspan="6"><input type="button" name="back" id="back" onclick="return backpage()" class="btn btn-sm btn-danger" value="BACK"/></td>
									</tr>
									
									<tr>
											<td colspan="6" align="center"><strong><span><?php echo $fetchsql["class_name"] ?></span></strong></td>
									</tr>
									<tr>
											<td colspan="6" align="center">
											<?php
													$forroll="SELECT `class_roll` FROM `running_student_info` WHERE `student_id`='".$fetchsql["studentID"]."'";
													$resultRoll=$db->select_query($forroll);
														if($resultRoll->num_rows>0){
															$fetchRoll=$resultRoll->fetch_array();
														}
											?>
													<strong>
		<span>Name : <?php echo $fetchsql["student_name"].'&nbsp;&nbsp;&nbsp;&nbsp; Roll :&nbsp;'.$fetchRoll["class_roll"].'&nbsp;&nbsp;&nbsp;&nbsp;'." Student ID : ".$fetchsql["studentID"];?></span>
													</strong>
											</td>
									</tr>
									<?php

		$fordata="SELECT `student_account_info`.*,`add_fee`.`amount`,`title`,`Common_Exceptional`,`month_setup`.`name` FROM `student_account_info`
INNER JOIN `add_fee` ON `add_fee`.`id`=`student_account_info`.`fee_id` 
INNER JOIN `month_setup` ON `month_setup`.`id`=`add_fee`.`fk_month_id`
WHERE `student_account_info`.`studentID`='$stdId' AND 
`student_account_info`.`class_id`='$className[0]' and `student_account_info`.`year`='$year' order by `add_fee`.`id` ASC ";

									$resuldata=$db->select_query($fordata);
									$count=$resuldata->num_rows;
									if($resuldata->num_rows>0){
									$s=0;
									?>
									<tr>
											<td><strong>Sl</strong></td>
											<td><strong>Title</strong></td>
											<td><strong>Fee Type</strong></td>
											
											<td><strong>Month</strong></td>
											<td><strong>Amount</strong></td>
											<td class="notPrintHtml"><strong>Action</strong></td>

											
							  </tr>	
									<?php 
									$total=0;
									$totalCommon=0;
									$totalExceptionalFee=0;
			$countammount="SELECT `student_account_info`.*,`add_fee`.`amount`,`title`,`Common_Exceptional`,`month_setup`.`name` FROM `student_account_info`
INNER JOIN `add_fee` ON `add_fee`.`id`=`student_account_info`.`fee_id`
INNER JOIN `month_setup` ON `month_setup`.`id`=`add_fee`.`fk_month_id`
 WHERE `student_account_info`.`studentID`='$stdId' AND 
`student_account_info`.`class_id`='$className[0]' and `student_account_info`.`year`='".$_POST['year']."'";
//echo $countammount;
										$resultammout=$db->select_query($countammount);
											while($fetchresult1=$resultammout->fetch_array()){


											if($fetchresult1["Common_Exceptional"]=="Common")
											{
												$totalCommon=$totalCommon+$fetchresult1["amount"];
												$total=$total+$fetchresult1["amount"];
											}
											else
											{
													$total=$total+$fetchresult1["AmountExceptional"];
													$totalExceptionalFee=$totalExceptionalFee+$fetchresult1["AmountExceptional"];
											}


											}
											while($fetchResult=$resuldata->fetch_array()){
											
									$s++;
										?>	
										<tR>
											<td><?php echo $s ?></td>
											<td><?php print $fetchResult["title"];?></td>
											<td><?php echo $fetchResult["Common_Exceptional"];?></td>
												<td><?php echo $fetchResult["name"];?></td>

											<td>


												<?php 

										if($fetchResult["Common_Exceptional"]=="Common")
											{
											echo $fetchResult["amount"];
											}
											else
											{
													echo $fetchResult["AmountExceptional"];
											}


										?>
												

											</td>
											<td  class="notPrintHtml" style="vertical-align:middle; text-align:center"><button type="button" onclick="return deletefordata('<?php echo $fetchResult["fee_id"]?>')" id="delete-<?php echo $fetchResult["fee_id"]?>" name="delete" value="<?php echo $fetchResult["studentID"].'and'.$fetchResult["class_id"].'and'.$fetchResult["groupID"].'and'.$fetchResult["fee_id"].'and'.$fetchResult["year"] ?>" >Delete</button></td>
										</tR>	
										
												<?php  }?>
												

												<tr>
													<td colspan="4" align="right"><strong>Total Common Fee= </strong></td>
													<td><strong><?php echo $totalCommon;?></strong></td>
													<tD></tD>
													</tr>

													<tr>
													<td colspan="4" align="right"><strong>Total Exceptional Fee= </strong></td>
													<td><strong><?php echo $totalExceptionalFee;?></strong></td>
													<tD></tD>
													</tr>


													<tr>
													<td colspan="4" align="right"><strong>Net Total = </strong></td>
													<td><strong><?php echo $total;?></strong></td>
													<tD></tD>
													</tr>
												<?php } ?>
							</table>
							
						<?php  } else {
						
						
						?>
						
							<table class="table table-bordered table-hover" style=" margin-top:20px;">
									<tr>
											<td><input type="button" name="back" id="back" onclick="return backpage()" class="btn btn-sm btn-danger" value="BACK"/></td>
									</tr>
									
									<tr>
											<td>
												<span class="text-danger"><strong>No Data Found !!!!</strong></span>
											</td>
									</tr>
							</table>
						 <?php } ?>
			
		<?php 	}
	?>
	
	
<?php

		if(isset($_POST["deletedata"])){
				$explodedata=explode('and',$_POST["value"]);
				 $deletdquery="DELETE FROM `student_account_info` WHERE `studentID`='$explodedata[0]' AND `class_id`='$explodedata[1]' AND `fee_id`='$explodedata[3]' AND `year`='$explodedata[4]'";
				$resultdelet=$db->delete_query($deletdquery);
		}
?>

<?php
		if(isset($_POST["autoIDdd"])){
		$expolde= explode('and',$_POST["className"]);
		?>
				<table width="510" align="center"  class="table table-bordered  table-responsive table-hover" style="margin-top:30px;">
		<tr align="center">
				<td width="77">Select All<BR/>
					<input id="chkbx_all"  onclick="return check_all()" type="checkbox"  />
		  </td>
				<td width="147">Name</td>
				<td width="121">Roll No</td>
				<td width="64">Select Fee</td>
				
		</tr>
		<?php
				      $sqlForAll="SELECT `running_student_info`.*,`student_personal_info`.`student_name`,`student_acadamic_information`.`session2` FROM `running_student_info`
INNER JOIN `student_personal_info` ON `student_personal_info`.`id`=`running_student_info`.`student_id` INNER JOIN `student_acadamic_information`
ON `student_acadamic_information`.`id`=`running_student_info`.`student_id`
WHERE  `running_student_info`.`class_id`='$expolde[0]' AND `student_acadamic_information`.`session2`='".$_POST["session"]."'  ORDER BY `running_student_info`.`class_roll` ASC   LIMIT ".$_POST["from"].",".$_POST["to"]."";
			//echo  $sqlForAll;

			$resultForAll=$db->select_query($sqlForAll);
			if($resultForAll){
				while($fetchForAl=$resultForAll->fetch_array()){
		
		?>
		<tr>
				<td><input type="checkbox" class="check_elmnt" name="chek[]" id="chek-<?php echo $fetchForAl["student_id"];?>" value="<?php echo $fetchForAl["student_id"];?>" onclick="return byroollcheked('<?php echo $fetchForAl["student_id"];?>')" /></td>
				<td><?php echo $fetchForAl["student_name"];?>&nbsp&nbsp;</td>
				<td align="center"><span><?php echo $fetchForAl["class_roll"];?></span></td>
				<td>
				
				<?php
						  $selectFees="SELECT * FROM `add_fee` WHERE `Common_Exceptional`='Common' AND  `class_id`='$expolde[0]' and `year`='".$_POST["year"]."'";
						$resultFees=$db->select_query($selectFees);
							if($resultFees->num_rows > 0){
									while($fetchFees = $resultFees->fetch_array()){
									
												$findFe="SELECT * FROM `student_account_info` WHERE `studentID`='".$fetchForAl["student_id"]."' AND `fee_id`='".$fetchFees['id']."'";
												$resultFindfe= $db->select_query($findFe);
													if($resultFindfe){
														$fetchFinfe=$resultFindfe->fetch_array();
													}
													if($fetchFinfe["fee_id"] != $fetchFees["id"]){
									?>
									<input type="checkbox" id="disableId-<?php echo $fetchForAl["student_id"];?>" name="checkbox[]" class="feechck" value="<?php echo $fetchFees['id'].'and'.$fetchForAl["student_id"];?>" disabled="disabled"  checked /> &nbsp;&nbsp;<?php echo $fetchFees['title'];?>&nbsp;&nbsp;
									<?php
								}	}
							}
				?>
				
				</td>
				
		</tr>
		<?php } } ?>
			<tr>
				<td colspan="5" align="right">
					<span id="smsforR"></span>
				</td>
			</tr>
		<tr>
			<td colspan="5" align="right">
				<input type="button" name="submit" id="submit" value="Submit" class="btn btn-primary btn-defualt btn-sm" style="width:150px;" onclick="return Submit()"/>
			</td>
		</tr>
</table>

		<?php
		}
?>


<?php
		if(isset($_POST["chek"])){
					
					if($_POST["chek"] != "")
					{
					$explode = explode('and',$_POST["className"]);
					
							
									
									if($_POST["checkbox"] != ""){
											for($z=0;$z< count($_POST["checkbox"]) ;  $z++){


													$explodeStudentid= explode('and',$_POST["checkbox"][$z]);

													 $inserData = "INSERT INTO `student_account_info`(`studentID`,`class_id`,`fee_id`,`year`,`admin_id`) VALUES ('$explodeStudentid[1]','$explode[0]','$explodeStudentid[0]','".$_POST["year"]."','".$_SESSION["id"]."')";
													 //echo  $inserData;
													 
										 $resultisnsert=$db->insert_query($inserData);
												//$db->sms="Insert Successfully!!";	
											}
											
											
											if(isset($db->sms))
															{
																echo $db->sms;
															}
									
							}
					}
		}
?>

<?php
	if(isset($_POST["totalstd"])){
	
	$expolde = explode('and',$_POST['ClassId']);
	
				 $selectClassYear = "SELECT `student_account_info`.*,`add_class`.`class_name` FROM `student_account_info` INNER JOIN `add_class`
ON `student_account_info`.`class_id`=`add_class`.`id`
WHERE `student_account_info`.`class_id`='$expolde[0]' AND `student_account_info`.`year`='".$_POST["Session"]."' GROUP BY `student_account_info`.`year`";

					$resultForAll=$db->select_query($selectClassYear);
			if($resultForAll){
			$fetchAll=$resultForAll->fetch_array();
			?>
			<table class="table table-bordered table-hover" style=" margin-top:20px;">
									
									<tr>
											<td colspan="3" align="center"><strong><span><?php echo $fetchAll["class_name"].'(&nbsp;'.$fetchAll["year"].'&nbsp;)' ?></span></strong></td>
									</tr>
									<?php
											$student_Name = "SELECT `student_account_info`.*,`student_personal_info`.`student_name`,`running_student_info`.`class_roll`  FROM `student_account_info`
INNER JOIN `student_personal_info` ON `student_personal_info`.`id`=`student_account_info`.`studentID` INNER JOIN `running_student_info` ON `running_student_info`.`student_id`=`student_account_info`.`studentID`
WHERE `student_account_info`.`class_id`='$expolde[0]' AND `student_account_info`.`year`='".$_POST["Session"]."' GROUP BY `student_account_info`.`studentID`";

$resutlName=$db->select_query($student_Name);
			if($resutlName){
			
			$x=0;
					while($fetchName = $resutlName->fetch_array()){
					
					?>
					<tr>
											<td colspan="3" align="center"><strong><span><?php echo $fetchName["student_name"].'&nbsp;(&nbsp;'.$fetchName["class_roll"].'&nbsp;)'?></span></strong></td>
									</tr>
										<tR align="center">
											<td><strong>Fee Title</strong></td>
											<td><strong>Ammount </strong></td>
											
											<td><strong>Action</strong></td>
										</tR>	
									<?php
											$selectRecord = "SELECT `student_account_info`.*,`add_fee`.`title`,`amount` FROM `student_account_info`
INNER JOIN `add_fee` ON `add_fee`.`id`=`student_account_info`.`fee_id` WHERE `student_account_info`.`class_id`='$expolde[0]' AND `student_account_info`.`year`='".$_POST["Session"]."' AND `student_account_info`.`studentID`='".$fetchName["studentID"]."'";

$resultRecord=$db->select_query($selectRecord);
			if($resultRecord){
			
			$count = $resultRecord->num_rows;
			$total = 0;
					while($fetchRecord = $resultRecord->fetch_array()){
					$total = $total + $fetchRecord["amount"];
					
					
									?>
									<tR>
											<td><strong><?php echo $fetchRecord["title"];?></strong></td>
											<td><strong><?php echo $fetchRecord["amount"];?> </strong></td>
											
											<td><strong><button type="button" onclick="return deletefordata('<?php echo $fetchRecord["fee_id"]?>')" id="delete-<?php echo $fetchRecord["fee_id"]?>" name="delete" value="<?php echo $fetchRecord["studentID"].'and'.$fetchRecord["class_id"].'and'.$fetchRecord["fee_id"].'and'.$fetchRecord["year"] ?>" >Delete</button></strong></td>
										</tR>	
					<?php
					
					} 
					
					?>
					</tr>
										<tR align="">
											
											<td align="right"><strong>Total = </strong></td>
											<td colspan="2" align="left"><strong><?php
													echo $total;
											?></strong></td>
											
										</tR>	
					<?php }
					}
			}	
									?>
									<tr>
							</tr>
						</table>
			<?php
			
			
			
			}
	}
?>


<?php

		if(isset($_POST["deMultiple"])){
				$explodedata=explode('and',$_POST["value"]);
				 $deletdquery="DELETE FROM `student_account_info` WHERE `studentID`='$explodedata[0]' AND `class_id`='$explodedata[1]' AND `fee_id`='$explodedata[2]' AND `year`='$explodedata[3]'";
				$resultdelet=$db->delete_query($deletdquery);
		}
?>
