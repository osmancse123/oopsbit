
<?php
@session_start();
error_reporting(1);
	require_once("../db_connect/config.php");
	require_once("../db_connect/conect.php");



	$db = new database();
	function send_msg($api_url,$from_number, $to_numbers, $text)
	{		
		$post_data = json_encode(array("from" => $from_number, "to" => $to_numbers, "text" => $text));
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $api_url);
			curl_setopt($ch,CURLOPT_HTTPHEADER,array("Content-Type:application/json", "Accept: application/json", "Authorization: Basic c2JpdDpORXdRNXJRTw=="));
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_VERBOSE, 0);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		
		curl_exec($ch);
		
		if($errno = curl_errno($ch)) 
		{
		    $error_message = curl_strerror($errno);
		    $error_message = "cURL error ({$errno}):\n {$error_message}";
		}
		else
			$error_message = true;
	 
		curl_close($ch);
		
		return $error_message;
		
		}





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
							
							$selectPaid="SELECT SUM(`paid_amount`) AS 'paidAmount' FROM `student_paid_table` WHERE `student_id`='$id' AND `class_id`='$explodeclass[0]' AND `year`='".$_POST["year"]."'";
							$queryPaid = $db->select_query($selectPaid);
							if($queryPaid){
							$fetchpaidAmount=$queryPaid->fetch_array();
							}


							//$a  = array('name' =>$fetch['student_name'],'Sess'=>$fetch['session2']);
							//$msg=json_encode($a);
				$msg = $fetch['student_name'].'/'.$fetch['class_roll'].'/'.$fetchpaidAmount[0].'/';
							echo $msg;
							}
			}




	
			if(isset($_POST["sumOfDue"])){
			
		$sum=0;
			if(!empty($_POST["fess"])){
			
					for($a=0;$a < count($_POST["fess"]);$a++){


							$fessTotal=explode("and",$_POST['fess'][$a]);
							
							$sum=$sum+$fessTotal[1];
					}
					echo  $sum;

					

					}

			}
	



			
			if(isset($_POST["showData"])){
					$explodeclass=explode('and',$_POST["ClassId"]);

						$explodegroup=explode('and',$_POST["groupID"]); 
						$sID=$_POST["id"]; 
						$date=$_POST["date"]; 
					   $selectFees="SELECT * FROM `running_student_info` WHERE `student_id`='".$_POST["id"]."' AND `class_id`='$explodeclass[0]'";
					$resultFees=$db->select_query($selectFees);

						if(@$resultFees->num_rows>0){

								 $SelecByiffess="SELECT add_fee.title,add_fee.amount,add_fee.id as 'FeID',temp_cart.* from temp_cart inner join add_fee on temp_cart.fee_id=add_fee.id where temp_cart.student_id='$sID' and temp_cart.date='$date'";
									$resultbyfeess=$db->select_query($SelecByiffess);
									$count=$resultbyfeess->num_rows;
									
									if(@$resultbyfeess->num_rows>0){
				?>
    <link rel="stylesheet" href="select/chosen.css">
  <script src="select/chosen.jquery.js"></script>
  <script>
    jQuery(document).ready(function(){
      jQuery(".chosen").data("placeholder","Select Slot").chosen();
    });
  </script>
				
				<table width="90%" class="table-bordered" style="width:100%;">
					<tr>	<td width="25%" ><strong> Fee Title</strong></td>
						<td width="40" align="center" ><strong> Slot</strong></td>
						<td width="20" align="center" ><strong> Prv. Dues</strong></td>
						<td width="20" align="center" ><strong> Cur.Pay</strong></td>
						<td width="20" align="center" ><strong> Total</strong></td>
						<td width="20" align="center" ><strong> Disc</strong></td>
						<td width="20" align="center" ><strong> G-Total</strong></td>
						<td width="20" align="center" ><strong> Paid</strong></td>
						<td width="30" align="center" ><strong> Dues</strong></td>
						<td width="30" align="center" ><strong> Disc Remark</strong></td>
						<!-- <td align="center"  ><strong>Total Taka</strong></td> -->
						
				  </tr>

		<?php 
		$tot=0;
		$sl=0;
		$totals=0;
				while($fetch_fee=$resultbyfeess->fetch_array()){
			$sl++;
		$due=$fetch_fee["prv_dues"];
		$curPay=$fetch_fee["amount"];
		$totals=$curPay+$due;
		?>		
		<tr id="tr_<?php echo $sl ?>">	
		<td >
	<input type="checkbox"  onclick="return checkdelete('<?php echo $fetch_fee["id"]?>','<?php echo $sl ?>')" name="check" id="check_<?php echo $sl ?>" value="<?php echo $fetch_fee["id"]?>">&nbsp; &nbsp; <?php echo $sl."&nbsp;|" ?><strong><span class="text-info" style="font-size:15px;"><?php echo $fetch_fee["title"];?><input type="hidden" name="fee_id_no[]" value="<?php echo $fetch_fee["FeID"];?>"> <br>

						 </span></strong>
		
		</td>
		<td>		<div class="col-lg-12 col-md-12">
<!-- <select>
        <option value="1">January</option>
        <option value="2">February</option>
        <option value="3">March</option>
        <option value="4">April</option>
        <option value="5">May</option>
        <option value="6">June</option>
        <option value="7">July</option>
        <option value="8">August</option>
        <option value="9">September</option>
        <option value="10">October</option>
        <option value="11">November</option>
        <option value="12">December</option>
    </select> -->
                <select onchange="return month('<?php echo $sl ?>')" class="chosen" multiple="true" style="width:200px;" name="slot" id="month_<?php echo $sl ?>">
       <option value="Jan">January</option>
        <option value="Feb">February</option>
        <option value="Mar">March</option>
        <option value="Apr">April</option>
        <option value="May">May</option>
        <option value="Jun">June<
        /option>
        <option value="Jul">July</option>
        <option value="Aug">August</option>
        <option value="Sep">September</option>
        <option value="Oct">October</option>
        <option value="Nov">November</option>
        <option value="Dec">December</option>
  </select><input type="hidden" name="slotB[]" id="resutlSlot_<?php echo $sl ?>">
						           
					</div></td>
		<td align="center"><strong><input type="text" name="dues_payable[]" style="width: 70px;" id="prvDue_<?php echo $sl ?>" value="<?php echo $fetch_fee["prv_dues"];?>"></strong></td>
		<td align="center"><strong><input type="text" name="current_payable[]" style="width: 70px;" value="<?php echo $fetch_fee[1]; ?>" id="curPay_<?php echo $sl ?>"></strong></td>
		<td align="center"><strong><input type="text" name="total_payable[]" style="width: 70px;" id="total_<?php echo $sl ?>" value="<?php echo $totals; ?>"></strong></td>

		<td align="center"><strong><input type="text" name="discont[]" style="width: 70px;" id="dis_<?php echo $sl ?>" value="0" onkeyup="return grandTotalWithDiscount('<?php echo $sl ?>')" ></strong></td>
<?php

$discont=$_POST["discont"];

$tot=$totals-$discont;
?>
		<td align="center"><strong><input type="text" name="G_total[]" style="width: 70px;" id="G_total_<?php echo $sl ?>" value="<?php echo $tot ?>"></strong></td>
		<td align="center"><strong><input type="text" onkeyup="return dueAmount('<?php echo $sl ?>')" name="paid[]" class="amt totalSum" style="width: 70px;" id="paid_<?php echo $sl ?>"></strong></td>
		<td align="center"><strong><input type="text" name="due[]" style="width: 70px;" id="due_<?php echo $sl ?>"></strong></td>	
		<td align="center"><strong><input type="text" name="remarka[]" style="width: 70px;" id="rem_<?php echo $sl ?>"></strong></td>
				  </tr>

		<?php  } ?>	
</table>	
				<?php 
		 }  }	}
	?>
	
	
	
	
	
	<?php
	
			if(isset($_POST["forView"])){
					$className=explode('and',$_POST["className"]);
					$groupname=explode('and',$_POST["groupname"]);
					$stdId=$_POST["stdId"];
					$year=$_POST["year"];
					$sql="SELECT `student_account_info`.*,`add_class`.`class_name`,`add_group`.`group_name`,`student_personal_info`.`student_name`
FROM `student_account_info` INNER JOIN `add_class` ON `add_class`.`id`=`student_account_info`.`class_id`
INNER JOIN `add_group` ON `add_group`.`id`=`student_account_info`.`groupID` INNER JOIN `student_personal_info`
ON `student_personal_info`.`id`=`student_account_info`.`studentID`
WHERE `student_account_info`.`class_id`='$className[0]' AND `student_account_info`.`groupID`='$groupname[0]' AND `student_account_info`.`year`='$year' AND `student_account_info`.`studentID`='$stdId'
GROUP BY `student_account_info`.`studentID`";
					$resultsql=$db->select_query($sql);
					
						if($resultsql->num_rows > 0){
						$fetchsql=$resultsql->fetch_array();
						?>
							<table class="table table-bordered table-hover" style=" margin-top:20px;">
									<tr>
											<td colspan="3"><input type="button" name="back" id="back" onclick="return backpage()" class="btn btn-sm btn-danger" value="BACK"/></td>
									</tr>
									
									<tr>
											<td colspan="3" align="center"><strong><span><?php echo $fetchsql["class_name"].'&nbsp;(&nbsp;'.$fetchsql["group_name"].'&nbsp;)' ?></span></strong></td>
									</tr>
									<tr>
											<td colspan="3" align="center">
											<?php
													$forroll="SELECT `class_roll` FROM `running_student_info` WHERE `student_id`='".$fetchsql["studentID"]."'";
													$resultRoll=$db->select_query($forroll);
														if($resultRoll->num_rows>0){
															$fetchRoll=$resultRoll->fetch_array();
														}
											?>
													<strong><span><?php echo $fetchsql["student_name"].'&nbsp;(&nbsp;'.$fetchRoll["class_roll"].'&nbsp;)';?></span></strong>
											</td>
									</tr>
									<?php
									 $fordata="SELECT `student_account_info`.*,`add_fee`.`amount`,`title` FROM `student_account_info`
INNER JOIN `add_fee` ON `add_fee`.`id`=`student_account_info`.`fee_id` WHERE `student_account_info`.`studentID`='$stdId' AND 
`student_account_info`.`class_id`='$className[0]' AND `student_account_info`.`groupID`='$groupname[0]'";
									$resuldata=$db->select_query($fordata);
									$count=$resuldata->num_rows;
									if($resuldata->num_rows>0){
									$s=0;
									?>
									<tR>
											<td><strong>Title</strong></td>
											<td><strong>Taka</strong></td>
											<td><strong>Action</strong></td>
							  </tR>	
									<?php 
									$total=0;
										 $countammount="SELECT `student_account_info`.*,`add_fee`.`amount`,`title` FROM `student_account_info`
INNER JOIN `add_fee` ON `add_fee`.`id`=`student_account_info`.`fee_id` WHERE `student_account_info`.`studentID`='$stdId' AND 
`student_account_info`.`class_id`='$className[0]' AND `student_account_info`.`groupID`='$groupname[0]'";
										$resultammout=$db->select_query($countammount);
											while($fetchresult1=$resultammout->fetch_array()){
											$total=$total+$fetchresult1["amount"];
											}
											while($fetchResult=$resuldata->fetch_array()){
											
									$s++;
										?>	
										<tR>
											<td><?php echo $s.'&nbsp;|&nbsp;'.$fetchResult["title"];?></td>
											<td><?php echo $fetchResult["amount"];?></td>
											<td style="vertical-align:middle; text-align:center"><button type="button" onclick="return deletefordata('<?php echo $fetchResult["fee_id"]?>')" id="delete-<?php echo $fetchResult["fee_id"]?>" name="delete" value="<?php echo $fetchResult["studentID"].'and'.$fetchResult["class_id"].'and'.$fetchResult["groupID"].'and'.$fetchResult["fee_id"].'and'.$fetchResult["year"] ?>" >Delete</button></td>
										</tR>	
										
												<?php  }?>
													<tr>
													<td align="right"><strong>Total = </strong></td>
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
				 $deletdquery="DELETE FROM `student_account_info` WHERE `studentID`='$explodedata[0]' AND `class_id`='$explodedata[1]' AND `groupID`='$explodedata[2]' AND `fee_id`='$explodedata[3]' AND `year`='$explodedata[4]'";
				$resultdelet=$db->delete_query($deletdquery);
		}
?>


<?php
		if(isset($_POST["NewInsWiseFees"])){
		$explode= explode('and',$_POST["className"]);
		if($_POST["InstrumentId"] === "ALL")

		{
				 	$selFees="SELECT `student_account_info`.*,`add_fee`.`title`,`amount`,`Common_Exceptional` FROM `student_account_info`
INNER JOIN `add_fee` ON `add_fee`.`id`=`student_account_info`.`fee_id` WHERE 
`student_account_info`.`class_id`='$explode[0]' AND `student_account_info`.`studentID`='".$_POST["id"]."' AND `student_account_info`.`year`='".$_POST["year"]."' ORDER BY `add_fee`.`index` ASC ";



				$resultFees = $db->select_query($selFees);
				$totaldue = 0;
					if($resultFees->num_rows > 0 ){
		?>
		
				<table width="830" class="table table-bordered table-hover" style=" margin-top:20px;">
									<tr align="center">
											<td width="162"><strong>Fee Title</strong><br/>
<input type="checkbox" onclick="return selectallfee()" id="selectall"   name="selectall"/>

											</td>
											<td width="141"><strong>Amount</strong></td>
											<td width="157"><strong>Dis.</strong></td>
											<td width="70"><strong>Net Amount</strong></td>
											<td width="68"><strong>Paid</strong></td>
											<td width="67"><strong>Due</strong></td>
											<td width="133"><strong>Receive</strong></td>
									</tr>
									
									<?php
									$tabindex=0;
									while($fetch_query = $resultFees->fetch_array()){

										$tabindex++;

										$forDis= "SELECT * FROM `add_discount` WHERE `student_id`='".$_POST["id"]."' AND `year`='".$_POST["year"]."' AND `class_id`='$explode[0]' and feeid='$fetch_query[fee_id]'";
							$resDist = $db->select_query($forDis);
								if($resDist->num_rows > 0){
										$fetchdis=$resDist->fetch_array();
										$discount = $fetchdis["discount"];
								}else {
								$discount = "";
								}
								
								$paidAmmount = "SELECT SUM(`paid_amount`) AS total
FROM `student_paid_table` WHERE `fk_fee_id`='$fetch_query[fee_id]' AND `student_id`='".$_POST["id"]."' AND `class_id`='$explode[0]' AND `year`='".$_POST["year"]."'";
								
								$RelpaidAmmount = $db->select_query($paidAmmount);
								if($RelpaidAmmount->num_rows > 0){
										$fetchPaidAmount=$RelpaidAmmount->fetch_array();
										$padiAMmount = $fetchPaidAmount["total"];
								}else {
								$padiAMmount = "";
								}
								
								if($fetch_query['Common_Exceptional']=="Common")
											{
												$netAmmount =  $fetch_query["amount"] - $discount;
											}
											else
											{
														
														$netAmmount =  $fetch_query["AmountExceptional"] - $discount;

											}

								
								


								$dueAmmount = $netAmmount-$padiAMmount ;
 $totaldue = $totaldue+$dueAmmount;
								if($netAmmount  != $padiAMmount && $netAmmount  > $padiAMmount){
									?>
									

									<tr>
											<td><strong><input type="checkbox"  id="FeesID-<?php echo $fetch_query["fee_id"];?>" onclick="return disss('<?php echo $fetch_query["fee_id"];?>')" name="FeesID[]" class="titlewc" value="<?php echo $fetch_query["fee_id"]."and".$dueAmmount;?>" /> &nbsp | <?php echo $fetch_query["title"];?></strong></td>


										<td style="width:120px;"><input    type="text" name="ammount[]" id="ammount-<?php echo $fetch_query["fee_id"]?>" 

											value="<?php 

											if($fetch_query['Common_Exceptional']=="Common")
											{
												echo $fetch_query["amount"];
											}
											else
											{
														echo $fetch_query["AmountExceptional"];

											}

										


											?>" 

											disabled="disabled" readonly="" class="form-control" style="border-radius:0px; width:120px; text-align:center "/>

										</td>




											<td style="width:120px;"><input     type="text" name="discount[]" id="discount-<?php echo $fetch_query["fee_id"]?>"  value="<?php echo $discount;?>" disabled="disabled" readonly="" class="form-control" style="border-radius:0px; width:120px; text-align:center "/></td>
											<td style="width:120px;"><input     type="text" name="netAmmount[]" id="netAmmount-<?php echo $fetch_query["fee_id"]?>"  value="<?php echo $netAmmount;?>" disabled="disabled" readonly="" class="form-control" style="border-radius:0px; width:120px; text-align:center "/></td>
											<td style="width:120px;"><input     type="text" name="paidAmm[]" id="paidAmm-<?php echo $fetch_query["fee_id"]?>"  value="<?php echo $padiAMmount ;?>" disabled="disabled" readonly="" class="form-control"  style="border-radius:0px; width:100px; text-align:center "/></td>
											<td style="width:110px;"><input type="text" name="due[]" id="due-<?php echo $fetch_query["fee_id"]?>" class="form-control"  style="border-radius:0px; width:120px; text-align:center " value="<?php echo $dueAmmount;?>" disabled="disabled" readonly=""/>
											<input type="hidden" name="Due" id="Due-<?php echo $fetch_query["fee_id"]?>" value="<?php echo $dueAmmount;?>" />
											</td>

											<td style="width:120px;">
											<input type="text" tabindex="<?php print $tabindex?>" name="ReciveAmm[]" id="ReciveAmm-<?php echo $fetch_query["fee_id"]?>" class="form-control rcv" onkeyup="return showDue('<?php echo $fetch_query["fee_id"]?>')" onkeypress="return sums();"  style="border-radius:0px; width:120px; text-align:center " disabled="disabled"/></td>
									</tr>
									<?php  } } ?>
									
								
									
				</table>
		<?php
		 
		} }else {
				  $selquery = "SELECT `instrumentwisefee`.*,`student_account_info`.`studentID`,`AmountExceptional`,`add_fee`.`title`,`amount`,`Common_Exceptional`
FROM  `instrumentwisefee` INNER JOIN `student_account_info` ON `student_account_info`.`fee_id`=`instrumentwisefee`.`fk_fee_id`
INNER JOIN `add_fee` ON `add_fee`.`id`=`instrumentwisefee`.`fk_fee_id` WHERE 
 `instrumentwisefee`.`fk_ins_id`='".$_POST["InstrumentId"]."' AND `instrumentwisefee`.`fk_cls_id`='$explode[0]' AND `student_account_info`.`year`='".$_POST["year"]."'
AND `student_account_info`.`studentID`='".$_POST["id"]."' ORDER BY `add_fee`.`index` ASC ";

//echo $selquery;

		$resultQuery =  $db->select_query($selquery);
		$totaldue = 0;
				if($resultQuery > 0){

						
				
		?>
				<table width="830" class="table table-bordered table-hover" style=" margin-top:20px;">
									<tr align="center">
							<td width="162"><strong>Fee Title</strong><br/>
<input type="checkbox" onclick="return selectallfee()" id="selectall"   name="selectall"/>

											</td>
											<td width="141"><strong>Amount</strong></td>
											<td width="157"><strong>Dis.</strong></td>
											<td width="70"><strong>Net Amount</strong></td>
											<td width="68"><strong>Paid</strong></td>
											<td width="67"><strong>Due</strong></td>
											<td width="133"><strong>Receive</strong></td>
									</tr>
									
									
									
									<?php 
									$tabindex=0;
											

											while($fetch_query = $resultQuery->fetch_array()){
												$tabindex++;
											

											$forDis= "SELECT * FROM `add_discount` WHERE `student_id`='".$_POST["id"]."' AND `year`='".$_POST["year"]."' AND `class_id`='$explode[0]' and feeid='$fetch_query[fk_fee_id]'";


							$resDist = $db->select_query($forDis);
								if($resDist->num_rows > 0){
										$fetchdis=$resDist->fetch_array();
										$discount = $fetchdis["discount"];
								}else{
								$discount = "";
								}
								
								
								$paidAmmount = "SELECT SUM(`paid_amount`) AS total
FROM `student_paid_table` WHERE `fk_fee_id`='$fetch_query[fk_fee_id]' AND `student_id`='".$_POST["id"]."' AND `class_id`='$explode[0]' AND `year`='".$_POST["year"]."'";
								
								$RelpaidAmmount = $db->select_query($paidAmmount);
								if($RelpaidAmmount->num_rows > 0){
										$fetchPaidAmount=$RelpaidAmmount->fetch_array();
										$padiAMmount = $fetchPaidAmount["total"];
								}else {
								$padiAMmount = "";
								}
								
						
								
								if($fetch_query['Common_Exceptional']=="Common")
											{
												$netAmmount =  $fetch_query["amount"] - $discount;
											}
											else
											{
														
														$netAmmount =  $fetch_query["AmountExceptional"] - $discount;
											}



								
								
								$dueAmmount = $netAmmount-$padiAMmount ;	
									if($netAmmount  != $padiAMmount && $netAmmount  > $padiAMmount ){?>
									<tr>
										<td><strong><input type="checkbox"  id="FeesID-<?php echo $fetch_query["fk_fee_id"];?>" onclick="return disss('<?php echo $fetch_query["fk_fee_id"];?>')" name="FeesID[]" class="titlewc" value="<?php echo $fetch_query["fk_fee_id"]."and".$dueAmmount;?>" /> &nbsp | <?php echo $fetch_query["title"];?></strong></td>


											


											<td style="width:120px;"><input    type="text" name="ammount[]" id="ammount-<?php echo $fetch_query["fk_fee_id"]?>" 

												value="<?php 
										if($fetch_query['Common_Exceptional']=="Common")
											{echo $fetch_query["amount"];
											}
											else
											{echo $fetch_query["AmountExceptional"];
										}?>"



												 disabled="disabled" readonly="" class="form-control" style="border-radius:0px; width:120px; text-align:center "/></td>



											<td style="width:120px;"><input     type="text" name="discount[]" id="discount-<?php echo $fetch_query["fk_fee_id"]?>"  value="<?php echo $discount;?>" disabled="disabled" readonly="" class="form-control" style="border-radius:0px; width:120px; text-align:center "/></td>
											<td style="width:120px;"><input     type="text" name="netAmmount[]" id="netAmmount-<?php echo $fetch_query["fk_fee_id"]?>"  value="<?php echo $netAmmount;?>" disabled="disabled" readonly="" class="form-control" style="border-radius:0px; width:120px; text-align:center "/></td>
											<td style="width:120px;"><input     type="text" name="paidAmm[]" id="paidAmm-<?php echo $fetch_query["fk_fee_id"]?>"  value="<?php echo $padiAMmount;?>" disabled="disabled" readonly="" class="form-control"  style="border-radius:0px; width:100px; text-align:center "/></td>
											<td style="width:110px;">

												<input type="text" name="due[]" id="due-<?php echo $fetch_query["fk_fee_id"]?>" class="form-control"  style="border-radius:0px; width:120px; text-align:center " value="<?php echo $dueAmmount;?>" readonly="" disabled="disabled"/>
											<input type="hidden" name="Due" id="Due-<?php echo $fetch_query["fk_fee_id"]?>" value="<?php echo $dueAmmount;?>" />
											</td>
											<td style="width:120px;">
											<input type="text" tabindex="<?php print $tabindex?>" name="ReciveAmm[]" id="ReciveAmm-<?php echo $fetch_query["fk_fee_id"]?>" class="form-control rcv" onkeyup="return showDue('<?php echo $fetch_query["fk_fee_id"]?>')"  onkeypress="return sums();"  style="border-radius:0px; width:120px; text-align:center " disabled="disabled"/></td>
									</tr>
									<?php
											} ?>

<!-- <input type="hidden" name="Due"  value="<?php echo $dueAmmount;?>" /> -->
											<?php }
									?>
									
									
				</table>
		<?php  } } }
?>

<?php
		if(isset($_POST["showInfee"])){
		
		?> 
		
		<link rel="stylesheet" href="select/chosen.css">
  <script src="select/chosen.jquery.js"></script>
  <script>
    jQuery(document).ready(function(){
      jQuery(".chosen").data("placeholder","Select Fees").chosen();
    });
  </script>
  
      <script type="text/javascript" src="chosen-sprite@2x.png"></script>
    
  
    
      <script type="text/javascript" src="chosen-sprite.png"></script>
Select Fee's &nbsp; :

<?php
$explode= explode('and',$_POST["ClassId"]);
					 $selFees="SELECT `student_account_info`.*,`add_fee`.`title`,`amount`,`Common_Exceptional`  FROM `student_account_info`
INNER JOIN `add_fee` ON `add_fee`.`id`=`student_account_info`.`fee_id` WHERE 
`student_account_info`.`class_id`='$explode[0]' AND `student_account_info`.`studentID`='".$_POST["id"]."' AND `student_account_info`.`year`='".$_POST["year"]."'";

//echo $selFees;

?>

   <select onchange="return viewFees()"  class="chosen"   id="chosen" multiple="true" style="width:100%; border-radius:0px;" name="slot" id="month_<?php echo $sl ?>">
      		<?php
					


				$resultFees = $db->select_query($selFees);
					if($resultFees->num_rows > 0 ){
					while($fetch_query = $resultFees->fetch_array()){
					
					
					$forDis= "SELECT * FROM `add_discount` WHERE `student_id`='".$_POST["id"]."' AND `year`='".$_POST["year"]."' AND `class_id`='$explode[0]' and feeid='$fetch_query[fee_id]'";


							$resDist = $db->select_query($forDis);

								if($resDist->num_rows > 0){

										$fetchdis=$resDist->fetch_array();
									 	$discount = $fetchdis["discount"];
								}

								else{
										$discount = "";
								}
								
								
								$paidAmmount = "SELECT SUM(`paid_amount`) AS total
FROM `student_paid_table` WHERE `fk_fee_id`='$fetch_query[fee_id]' AND `student_id`='".$_POST["id"]."' AND `class_id`='$explode[0]' AND `year`='".$_POST["year"]."'";


								
								$RelpaidAmmount = $db->select_query($paidAmmount);
								if($RelpaidAmmount->num_rows > 0){

										$fetchPaidAmount=$RelpaidAmmount->fetch_array();
									 	$padiAMmount = $fetchPaidAmount["total"];
								}else {
								$padiAMmount = "";
								}
								
								
								if($fetch_query['Common_Exceptional']=="Common")
											{
												$netAmmount =  $fetch_query["amount"] - $discount;
											}
											else
											{
														
														$netAmmount =  $fetch_query["AmountExceptional"] - $discount;

											}

								
								
								$dueAmmount = $netAmmount-$padiAMmount ;	
								
								if($netAmmount  != $padiAMmount && $netAmmount  > $padiAMmount ){
					
					
			?>
		<option value="<?php echo $fetch_query["fee_id"];?>"><?php echo $fetch_query["title"];?></option>
			<?php } }  } ?>
  
 
  </select>
 
  
  
		<?php }
?>
<?php
		if(isset($_POST["SingleWiseFee"])){
				$count =  count($_POST["feesId"]);
					$explode= explode('and',$_POST["ClassId"]);
					if($count   > 0 ){?>
									<table width="830" class="table table-bordered table-hover" style=" margin-top:20px;">
												<tr align="center">


								<td width="162"><strong>Fee Title</strong><br/>
<input type="checkbox" onclick="return selectallfee()" id="selectall"   name="selectall"/>


														<td width="141"><strong>Amount</strong></td>
														<td width="157"><strong>Dis.</strong></td>
														<td width="70"><strong>Net Amount</strong></td>
														<td width="68"><strong>Paid</strong></td>
														<td width="67"><strong>Due</strong></td>
														<td width="133"><strong>Receive</strong></td>
												</tr>
									
								
					<?php
					$tabindex=0;
							for($x = 0; $x <$count; $x++  ){
									$tabindex++;


									 $queryforshowFee = "SELECT `student_account_info`.*,`add_fee`.`title`,`amount`,`Common_Exceptional` FROM `student_account_info`
INNER JOIN `add_fee` ON `student_account_info`.`fee_id`=`add_fee`.`id` WHERE 
`student_account_info`.`class_id`='$explode[0]' AND `student_account_info`.`studentID`='".$_POST["id"]."' AND `student_account_info`.`year`='".$_POST["year"]."' AND  `student_account_info`.`fee_id`='".$_POST["feesId"][$x]."' ORDER BY `add_fee`.`index` ASC ";
//echo $queryforshowFee;



									$resultForshofee = $db->select_query($queryforshowFee);	
											if($resultForshofee->num_rows > 0){

														$fetch_query = $resultForshofee->fetch_array();	
														
								$forDis= "SELECT * FROM `add_discount` WHERE `student_id`='".$_POST["id"]."' AND `year`='".$_POST["year"]."' AND `class_id`='$explode[0]' and feeid='".$_POST["feesId"][$x]."'";
							$resDist = $db->select_query($forDis);
								if($resDist->num_rows > 0){
										$fetchdis=$resDist->fetch_array();
									$discount = $fetchdis["discount"];
								}else{
								$discount = "";
								}
								
								$paidAmmount = "SELECT SUM(`paid_amount`) AS total
FROM `student_paid_table` WHERE `fk_fee_id`='$fetch_query[fee_id]' AND `student_id`='".$_POST["id"]."' AND `class_id`='$explode[0]' AND `year`='".$_POST["year"]."'";
								
								$RelpaidAmmount = $db->select_query($paidAmmount);
								if($RelpaidAmmount->num_rows > 0){
										$fetchPaidAmount=$RelpaidAmmount->fetch_array();
										$padiAMmount = $fetchPaidAmount["total"];
								}else {
								$padiAMmount = "";
								}
								
								
								if($fetch_query['Common_Exceptional']=="Common")
											{
												$netAmmount =  $fetch_query["amount"] - $discount;
											}
											else
											{
														
														$netAmmount =  $fetch_query["AmountExceptional"] - $discount;

											}


								
								$dueAmmount = $netAmmount-$padiAMmount ;
										
									
									}
									
									if($netAmmount  != $padiAMmount && $netAmmount  > $padiAMmount){

?>
									<tr>
											<td><strong><input type="checkbox"  id="FeesID-<?php echo $fetch_query["fee_id"];?>" onclick="return disss('<?php echo $fetch_query["fee_id"];?>')" name="FeesID[]" class="titlewc" value="<?php echo $fetch_query["fee_id"]."and".$dueAmmount;?>" /> &nbsp | <?php echo $fetch_query["title"];?></strong></td>


											<td style="width:120px;"><input    type="text" name="ammount[]" id="ammount-<?php echo $fetch_query["fee_id"]?>" 


										value="<?php 
										if($fetch_query['Common_Exceptional']=="Common")
											{echo $fetch_query["amount"];
											}
											else
											{echo $fetch_query["AmountExceptional"];
										}?>"

											disabled="disabled" readonly="" class="form-control" style="border-radius:0px; width:120px; text-align:center "/></td>


											<td style="width:120px;"><input     type="text" name="discount[]" id="discount-<?php echo $fetch_query["fee_id"]?>"  value="<?php echo $discount;?>" disabled="disabled" readonly="" class="form-control" style="border-radius:0px; width:120px; text-align:center "/></td>
											<td style="width:120px;"><input     type="text" name="netAmmount[]" id="netAmmount-<?php echo $fetch_query["fee_id"]?>"  value="<?php echo $netAmmount;?>" disabled="disabled" readonly="" class="form-control" style="border-radius:0px; width:120px; text-align:center "/></td>
											<td style="width:120px;"><input     type="text" name="paidAmm[]" id="paidAmm-<?php echo $fetch_query["fee_id"]?>"  value="<?php echo $padiAMmount?>" disabled="disabled" readonly="" class="form-control"  style="border-radius:0px; width:100px; text-align:center "/></td>
											<td style="width:110px;"><input type="text" name="due[]" id="due-<?php echo $fetch_query["fee_id"]?>" class="form-control"  style="border-radius:0px; width:120px; text-align:center " value="<?php echo $dueAmmount;?>" disabled="disabled", readonly=""/>
											<input type="hidden" name="Due" id="Due-<?php echo $fetch_query["fee_id"]?>" value="<?php echo $dueAmmount;?>" />
											</td>
											<td style="width:120px;">
											<input type="text" tabindex="<?php print $tabindex?>"  onkeypress="return sums();" onkeydown="return sums();" name="ReciveAmm[]" id="ReciveAmm-<?php echo $fetch_query["fee_id"]?>" class="form-control rcv" onkeyup="return showDue('<?php echo $fetch_query["fee_id"]?>')"  style="border-radius:0px; width:120px; text-align:center " disabled="disabled"/></td>
									</tr>
									
									
<?php
							
						} 	}
							?>
							
							</table><?php
								
								
					}
		}
?>


<?php  
	
			if(isset($_POST["moredataV"])){
				
				
				
				$className=explode('and',$_POST["className"]);
				$stdId=$_POST["stdId"];
				$year=$_POST["year"];
				$feeid=$_POST["fee_id_no"];
				
				$d=explode('/',$_POST["date"]);
				$yyyyMMdd=$d[2]."-".$d[1]."-".$d[0];
				
				$substrDate = substr($_POST["date"],3,2);

				 $count = count($_POST["FeesID"]);
				
				 


		     $selectClas="SELECT `index` FROM `add_class` WHERE `id`='$className[0]'";
             if($invalue=$db->select_query($selectClas)->fetch_array())
             {
             	if($invalue[0]==6 or $invalue[0]==7 or $invalue[0]==8 or $invalue[0]==9)
             		{
             			$invalue[0]='0'.$invalue[0];
             		}
             	
             	$y=date('y').$invalue[0];
             }
            $ID=$db->voucherID('student_paid_table','voucher',$y,'8',$className[0]);

				 		for($x = 0; $x < $count ;$x++){
							
							$feeId=explode('and',$_POST["FeesID"][$x]);

						   $insertQuery="INSERT INTO `student_paid_table` (`student_id`,`voucher`,`class_id`,`paid_amount`,`date`,`admin_id`,`month`,`year`,`fk_fee_id`,`defult_Date`) 
								VALUES ('$stdId','$ID','$className[0]','".$_POST["ReciveAmm"][$x]."','".$yyyyMMdd."','".$_SESSION["id"]."','$substrDate','".$_POST["year"]."','".$feeId[0]."','".date('Y-m-d')."')";
								$resultQuery  = $db->insert_query($insertQuery);
								 
						
						}
						echo $ID;
		
}
	?>
