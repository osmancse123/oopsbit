<?php
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
					 $sql = "SELECT `student_account_info`.*,`running_student_info`.`class_roll`,`student_personal_info`.`student_name`
FROM `student_account_info` INNER JOIN `running_student_info` ON `running_student_info`.`student_id`=`student_account_info`.`studentID`
INNER JOIN `student_personal_info` ON `student_personal_info`.`id`=`student_account_info`.`studentID`
WHERE `student_account_info`.`studentID`='$id'
 AND `student_account_info`.`class_id`='$explodeclass[0]'
 GROUP BY `student_account_info`.`studentID`";
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

						$datachek="SELECT `student_account_info`.*,`add_fee`.`title`,amount,`Common_Exceptional` FROM `student_account_info`
INNER JOIN `add_fee` ON `add_fee`.`id`=`student_account_info`.`fee_id`
WHERE `student_account_info`.`studentID`='".$_POST["id"]."' AND `student_account_info`.`class_id`='$explodeclass[0]'
 AND `student_account_info`.`year`='".$_POST["year"]."'";

// echo $datachek;
						$resultchek=$db->select_query($datachek);
						if($resultchek->num_rows > 0){
						

						?>
					
						<table width="77%" class="table table-bordered" style="width:100%;">
								<tr align="center">
										<td width="4%"><strong>Select One</strong></td>
										<td width="20%"><strong>Fee Title</strong></td>
										<td width="12%"><strong>Fee Ammount</strong></td>
										<td width="11%"><strong>Discount</strong></td>
										<td width="17%"><strong>Paid Ammount</strong></td>
										<td width="36%"><strong>Referance BY</strong></td>
								</tr>
								<?php 
														while($fetchchek=$resultchek->fetch_array()){


														

	$alreadyAddDiscount="SELECT * FROM `add_discount` WHERE `student_id`='$fetchchek[0]'  AND `class_id`='$fetchchek[1]' AND `year`='".$_POST["year"]."' AND `feeid`='$fetchchek[2]'";
	

							$checkAllreadyDiscountAdd=$db->select_query($alreadyAddDiscount);
							if(!$checkAllreadyDiscountAdd)
							{

							
							?>
								<tr>
										<td>
											


											<input type="checkbox" name="chekOne[]" id="chekOne-<?php echo $fetchchek["fee_id"]; ?>" value="<?php echo $fetchchek["fee_id"]; ?>"  onclick="return DesableUndis('<?php echo $fetchchek["fee_id"]; ?>')"/>


										</td>
										 <td> <?php echo $fetchchek["title"];?>  </td>




										 <td>
										 	<input type="text" name="ammount[]" id="ammount-<?php echo $fetchchek["fee_id"]; ?>" value="<?php 
										 		if($fetchchek["Common_Exceptional"]=="Common")
										 		{
										 	echo $fetchchek["amount"];

										 }
										 else
										 {
										 	echo $fetchchek["AmountExceptional"];
										 }


										 	?>"  style="width:100%; height:30px; text-align:center" readonly="" disabled="disabled" />
										 </td>



										  <td>
										 	<input type="text" name="discount[]" id="discount-<?php echo $fetchchek["fee_id"]; ?>" onkeyup="return MinusResult('<?php echo $fetchchek["fee_id"]; ?>')"  style="width:100%; height:30px; text-align:center" disabled="disabled" />
										 </td>
										 
										  <td>
										 	<input type="text" name="paidAmmount[]" id="paidAmmount-<?php echo $fetchchek["fee_id"]; ?>"  style="width:100%; height:30px; text-align:center" disabled="disabled" />
										 </td>
										 <td>
										 	<input type="text" name="refBy[]" id="refBy-<?php echo $fetchchek["fee_id"]; ?>" onkeyup="return MinusResult()"  style="width:100%; height:30px; text-align:center" disabled="disabled" />
										 </td>
										 
								</tr>
						<?php
					}
						 } ?>
</table>
						
						
					<?php	

				}
			}
?>

<?php

		if(isset($_POST["forShammount"])){
			$explodeclass=explode('and',$_POST["ClassId"]);
						$explodegroup=explode('and',$_POST["groupID"]); 
			 	$showammount="SELECT `amount` FROM `add_fee` WHERE `id`='".$_POST["feeID"]."' AND `class_id`='$explodeclass[0]'  AND `year`='".$_POST["year"]."'";
				$resultmount=$db->select_query($showammount);
					if($resultmount->num_rows > 0){
							$fetchammount=$resultmount->fetch_array();
								echo $fetchammount["amount"];
					}
		}
?>

<?php
		if(isset($_POST["moredata"])){

				$explodeclass=explode('and',$_POST["className"]);

				 if($_POST["chekOne"]!="")
				 {
				 		for($x=0;$x < count($_POST["chekOne"]);$x++ ){
				 		if($_POST["discount"][$x]!="" && $_POST["discount"][$x]!="0")
				 			{



								 $sql = "INSERT INTO `add_discount` (`student_id`,`class_id`,`year`,`roll`,`feeid`,`discount`,`admin_id`,`date`,`refBy`) VALUES 
								('".$_POST["stdId"]."','$explodeclass[0]','".$_POST["year"]."','".$_POST["roll"]."','".$_POST["chekOne"][$x]."','".$_POST["discount"][$x]."','".$_SESSION["id"]."','".date('y/m/d')."','".$_POST["refBy"][$x]."')";
						$resulsql=$db->insert_query($sql);
					}
						}
				 }
				
				
				
			 	
				
					if(isset($db->sms)){
						echo $db->sms;
					}
					
		}
		
		if(isset($_POST["forView"])){
		
				$className=explode('and',$_POST["className"]);
					$groupname=explode('and',$_POST["groupname"]);
					$stdId=$_POST["stdId"];
					$year=$_POST["year"];
					$feeID=$_POST["feetitle"];
				 	$forcheksql="SELECT `add_discount`.*,`add_class`.`class_name`,`student_personal_info`.`student_name`
,`running_student_info`.`class_roll` FROM `add_discount` INNER JOIN `add_class`
ON `add_class`.`id`=`add_discount`.`class_id`  INNER JOIN `student_personal_info`
ON `student_personal_info`.`id`=`add_discount`.`student_id`
INNER JOIN `running_student_info` ON `running_student_info`.`student_id`=`add_discount`.`student_id`
WHERE `add_discount`.`student_id`='$stdId' AND `add_discount`.`class_id`='$className[0]'  AND `add_discount`.`year`='$year'";
				$resultSql=$db->select_query($forcheksql);
					if($resultSql->num_rows > 0){
					$fetchSql=$resultSql->fetch_array();
						?>
							<table class="table table-bordered table-hover" style=" margin-top:20px;">
									<tr>
											<td colspan="6"><input type="button" name="back" id="back" onclick="return backpage()" class="btn btn-sm btn-danger" value="BACK"/></td>
									</tr>
									
								<tr>
											<td colspan="6" align="center"><strong><span><?php echo $fetchSql["class_name"].'&nbsp;(&nbsp;'.$fetchSql["year"].'&nbsp;)' ?></span></strong></td>
									</tr>
									<tr>
											<td colspan="6" align="center"><strong><span><?php echo $fetchSql["student_name"].'&nbsp;(&nbsp;'.$fetchSql["class_roll"].'&nbsp;)' ?></span></strong></td>
									</tr>
									<tR>
											<td><strong>Title</strong></td>
											<td><strong>Taka</strong></td>
											<td><strong>Discount</strong></td>
											<td><strong>Net Ammount</strong></td>
											<td><strong>Referance By</strong></td>
											<td><strong>Action</strong></td>
										</tR>	
									<?php
											
							
$forshowFeerelativedis="SELECT `add_discount`.*,`add_fee`.`title`,`amount`,`Common_Exceptional`,`student_account_info`.`AmountExceptional` FROM `add_discount` INNER JOIN `add_fee`ON `add_fee`.`id`=`add_discount`.`feeid` INNER JOIN  `student_account_info` ON `add_discount`.`feeid`=`student_account_info`.`fee_id`WHERE `add_discount`.`class_id`='$className[0]' AND `add_discount`.`year`='$year' AND `add_discount`.`student_id`='$stdId' AND `student_account_info`.`studentID`='$stdId'";




//echo $forshowFeerelativedis;
											$resulforallviews=$db->select_query($forshowFeerelativedis);
												if($resulforallviews->num_rows > 0){
												$sl = 0;
														while($fetchForallViews=$resulforallviews->fetch_array()){

														
									
										$sl++;
										?>
											<tR>
											<td><strong><?php echo $sl.'&nbsp; |&nbsp;'.$fetchForallViews["title"];?></strong></td>
											<td><strong><?php 

											if($fetchForallViews["Common_Exceptional"]=="Common")
											{
												echo $fetchForallViews["amount"];
												$netammount = $fetchForallViews["amount"]-$fetchForallViews["discount"];

											}
											else
											{
												echo $fetchForallViews["AmountExceptional"];
												$netammount = $fetchForallViews["AmountExceptional"]-$fetchForallViews["discount"];
											}


											

											?></strong></td>
											<td><strong><?php echo $fetchForallViews["discount"];?></strong></td>
												<td><strong><?php echo $netammount ;?></strong></td>
												<td><strong><?php echo $fetchForallViews["refBy"];?></strong></td>
											<td><button type="button" onclick="return deletefordata('<?php echo $fetchForallViews["feeid"]?>')" id="delete-<?php echo $fetchForallViews["feeid"]?>" name="delete" value="<?php echo $fetchForallViews["student_id"].'and'.$fetchForallViews["class_id"].'and'.$fetchForallViews["feeid"].'and'.$fetchForallViews["year"] ?>" >Delete</button></td>
										</tR>		
									<?php } } ?>
							</table>	
						
						<?php 
					}else {?>
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
					<?php }
		}
		

?>

<?php

		if(isset($_POST["deletedata"])){
		
				$explodedata=explode('and',$_POST["value"]);
			 	$deletesql="DELETE FROM `add_discount`  WHERE `student_id`='$explodedata[0]' AND `class_id`='$explodedata[1]' AND `year`='$explodedata[3]' AND `feeid`='$explodedata[2]'";
				$db->delete_query($deletesql);
		}
?>

<?php
		if(isset($_POST["dddd"])){
			
	@$explode=explode('and',$_REQUEST['className']);
	$select_group="SELECT * FROM `instrumentsetup` WHERE `fk_cl_id`='$explode[0]'";
	$chek_query=$db->select_query($select_group);

	if($chek_query)
	{
		if($chek_query>0)
		{
			print '<option value="" disabled selected >Select One</option>';
		}

		while($fetch=$chek_query->fetch_array())
			{
				print "<option value='$fetch[0]'>".$fetch[1]."</option>";
			}
	}
	else
	{
			print "<option value='NullandNull'>"."Null"."</option>";
	}
	





		}
?>


<?php
			if(isset($_POST["showFees"])){
						$clsid = explode('and',$_POST["className"]);

								 $seleFees = "SELECT * FROM `add_fee` where `class_id`='$clsid[0]' ORDER BY `id` ASC";
								$checkFess=$db->select_query($seleFees);
								if($checkFess)
								{
									$excls = explode('and',$_POST["className"]);
									while($fetFes=$checkFess->fetch_array())
								{
									$selectFees = "SELECT * FROM `instrumentwisefee` WHERE `fk_fee_id`='".$fetFes['id']."' AND  `fk_cls_id`='$excls[0]' ";
										$chekffff=$db->select_query($selectFees);
											if($chekffff){
													$fetchRRRRRR = $chekffff->fetch_array();
											}
											if($fetchRRRRRR["fk_fee_id"] != $fetFes["id"]){
				?>
						<input type="checkbox" name="checkbox[]" value="<?php echo $fetFes['id'];?>" /> &nbsp;&nbsp;<?php echo $fetFes['title'];?>&nbsp;&nbsp;<br/>
						<?php }  }  }   } ?>
						
						
