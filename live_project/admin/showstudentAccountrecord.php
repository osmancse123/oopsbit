<?php


	error_reporting(1);
	@session_start();
	if($_SESSION["logstatus"] === "Active")
	{
	require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
	date_default_timezone_set("Asia/Dhaka");
	$db = new database();
	if(isset($_POST["showdata"])){
	
			$personalinformation = "SELECT `running_student_info`.*,`add_class`.`class_name`,`student_personal_info`.`student_name`,`father_name`,
`mother_name` FROM `running_student_info` INNER JOIN `add_class` ON `add_class`.`id`=`running_student_info`.`class_id`
INNER JOIN `student_personal_info` ON `student_personal_info`.`id`=`running_student_info`.`student_id`
WHERE `running_student_info`.`student_id`='".$_POST["stdId"]."'";

$resultinfo = $db->select_query($personalinformation)->fetch_array();

function convertNumberToWord($num = false)
{
    $num = str_replace(array(',', ' '), '' , trim($num));
    if(! $num) {
        return false;
    }
    $num = (int) $num;
    $words = array();
    $list1 = array('', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven',
        'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
    );
    $list2 = array('', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety', 'hundred');
    $list3 = array('', 'thousand', 'million', 'billion', 'trillion', 'quadrillion', 'quintillion', 'sextillion', 'septillion',
        'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quattuordecillion',
        'quindecillion', 'sexdecillion', 'septendecillion', 'octodecillion', 'novemdecillion', 'vigintillion'
    );
    $num_length = strlen($num);
    $levels = (int) (($num_length + 2) / 3);
    $max_length = $levels * 3;
    $num = substr('00' . $num, -$max_length);
    $num_levels = str_split($num, 3);
    for ($i = 0; $i < count($num_levels); $i++) {
        $levels--;
        $hundreds = (int) ($num_levels[$i] / 100);
        $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ( $hundreds == 1 ? '' : 's' ) . ' ' : '');
        $tens = (int) ($num_levels[$i] % 100);
        $singles = '';
        if ( $tens < 20 ) {
            $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '' );
        } else {
            $tens = (int)($tens / 10);
            $tens = ' ' . $list2[$tens] . ' ';
            $singles = (int) ($num_levels[$i] % 10);
            $singles = ' ' . $list1[$singles] . ' ';
        }
        $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' );
    } //end for loop
    $commas = count($words);
    if ($commas > 1) {
        $commas = $commas - 1;
    }
    return implode(' ', $words);
}


	?>
	<div class="has-feedback col-xs-12 col-sm-10 col-lg-10 col-md-10 col-sm-offset-1 col-md-offset-1">
				<table width="50%" class="table table-responsive table-hover table-bordered">
							<tr>
								<td width="24%">Name</td>
								<td width="5%" align="center">:</td>
								<td width="71%">&nbsp;<?php echo $resultinfo["student_name"];?></td>
							</tr>
							<tr>
								<td>Father Name</td>
								<td width="5%" align="center">:</td>
								<td>&nbsp;<?php echo $resultinfo["father_name"];?></td>
							</tr>
							<tr>
								<td>Mother Name</td>
								<td align="center">:</td>
								<td width="71%">&nbsp; <?php echo $resultinfo["mother_name"];?></td>
							</tr>
							<tr>
								<td>Class</td>
								<td align="center">:</td>
								<td width="71%">&nbsp; <?php echo $resultinfo["class_name"];?></td>
							</tr>
							
							<tr>
								<td>Roll No</td>
								<td align="center">:</td>
								<td width="71%">&nbsp; <?php echo $resultinfo["class_roll"];?></td>
							</tr>
							
							
				</table>

		<table width="50%" class="table table-responsive table-hover table-bordered" style="margin-top:-20px;">
							<tr align="center">
								<td width="24%"><span class="text-danger"><b>Total Ammount In Account</b></span></td>
								<td width="24%"><span class="text-danger"><b>Total Discount In Account</b></span></td>	
								<td width="24%"><span class="text-danger"><b>Net Ammount In Account</b></span></td>
							</tr>
							<tr align="center">
								<td width="24%">
					
								<?php
									  $totalamm= "SELECT `student_account_info`.*,
									  SUM(`add_fee`.`amount`)+SUM(`student_account_info`.`AmountExceptional`) FROM `student_account_info`
INNER JOIN `add_fee` ON `add_fee`.`id`=`student_account_info`.`fee_id` WHERE
`student_account_info`.`studentID`='".$_POST["stdId"]."' AND `student_account_info`.`year`='".$_POST["year"]."'";

 $resulttatol= $db->select_query($totalamm)->fetch_array();
 print @$db->my_money_format($resulttatol[6]);

 ?>
								
								
								</td>
								<td width="24%">
								
								
								<?php 
								   $totaldis= "SELECT SUM(`add_discount`.`discount`) FROM `add_discount` WHERE `student_id`='".$_POST["stdId"]."' AND `year`='".$_POST["year"]."'";
 $resuldis= $db->select_query($totaldis)->fetch_array();
 print @$db->my_money_format($resuldis[0]);
 ?></td>
								<td width="24%">
									<?php
									
											 $netammount = $resulttatol[6]-$resuldis[0];
											echo  @$db->my_money_format($netammount);
									?>
								</td>
							</tr>
	</table>
	
	
		<table width="50%" class="table table-responsive table-hover table-bordered" style="margin-top:-20px;">
							<tr align="center">
									<td width="24%"><span class="text-danger"><b>Total Paid Ammount</b></span></td>
								<td width="24%"><span class="text-danger"><b>Total Due Ammount</b></span></td>
								
							</tr>
							<tr align="center">
							<td width="24%">
							
							<?php 
								    $totalpaid= "SELECT SUM(`student_paid_table`.`paid_amount`) FROM `student_paid_table`
WHERE  `student_id`='".$_POST["stdId"]."' AND `year`='".$_POST["year"]."'";
 $resultpaid= $db->select_query($totalpaid)->fetch_array();
 print @$db->my_money_format($resultpaid[0]);
 ?>
						
							
							
							</td>
								<td width="24%">
								<?php
										$dueammount =  $netammount-$resultpaid[0];
							 print @$db->my_money_format($dueammount);
								?>
								
								</td>
								
							</tr>
						
	</table>
	
	<table width="50%" class="table table-responsive table-hover table-bordered" style="margin-top:-20px;">
	
	<?php
								 $selFees="SELECT `student_account_info`.*,`add_fee`.`title`,`amount` FROM `student_account_info`
INNER JOIN `add_fee` ON `add_fee`.`id`=`student_account_info`.`fee_id` WHERE `student_account_info`.`studentID`='".$_POST["stdId"]."' AND `student_account_info`.`year`='".$_POST["year"]."'";
				$resultFees = $db->select_query($selFees);
				
				if($resultFees->num_rows > 0 ){
							?>
							
							
							<tr align="center">
									<td width="25%"><span class="text-success"><b>Fee Title</b></span></td>
									<td width="10%"><span class="text-success"><b>Ammount</b></span></td>
									<td width="13%"><span class="text-success"><b>Discount</b></span></td>
									<td width="15%"><span class="text-success"><b>Net Ammount</b></span></td>
									<td width="20%"><span class="text-success"><b>Paid  Ammount</b></span></td>
									<td width="17%"><span class="text-success"><b>Due   Ammount</b></span></td>
								
								
							</tr>
							<?php
							
								while($fetch_query = $resultFees->fetch_array()){
							?>
							<tr>
									<td width="25%"><span class="text-info"><b>&nbsp;&nbsp;&nbsp;<?php echo $fetch_query["title"];?></b></span></td>
									<td width="10%"><span class="text-info"><b>&nbsp;&nbsp;&nbsp;<?php echo  @$db->my_money_format($fetch_query["amount"]);?></b></span></td>
									<td width="13%"><span class="text-info"><b>&nbsp;&nbsp;&nbsp;<?php 
									
									
										$forDis= "SELECT * FROM `add_discount` WHERE `student_id`='".$_POST["stdId"]."' AND `year`='".$_POST["year"]."' and feeid='$fetch_query[fee_id]'";
							$resDist = $db->select_query($forDis);
								if($resDist->num_rows > 0){
										$fetchdis=$resDist->fetch_array();
										$discount = $fetchdis["discount"];
								}else {
								$discount = "";
								}
								
								
								echo  @$db->my_money_format($discount) ;
								
									?></b></span></td>
									<td width="15%"><span class="text-info"><b>
											<?php
														$netammount = $fetch_query["amount"]-$discount;
														echo @$db->my_money_format($netammount);
											?>
									
										</b></span></td>
								
								<td width="20%"><span class="text-info"><b>
											<?php
											
										 	$paidammount = "SELECT SUM(`student_paid_table`.`paid_amount`) FROM `student_paid_table` WHERE `student_id`='".$_POST["stdId"]."' AND `fk_fee_id`='$fetch_query[fee_id]' AND `year`='".$_POST["year"]."'";
											$resultpaidammount = $db->select_query($paidammount)->fetch_array();
														//$paided = $netammount-$resultpaidammount[0];
														echo @$db->my_money_format($resultpaidammount[0]);
											?>
									
										</b></span></td>
										
										<td width="17%"><span class="text-info"><b>
											<?php
										
														$dueammount = $netammount -$resultpaidammount[0];
														echo  @$db->my_money_format($dueammount);
											?>
									
										</b></span></td>
							</tr>
							
							<?php }  }?>
							
							
						
	</table>
				
				
				
	</div>
	<?php
	}
		if(isset($_POST["showdatarigister"])){
		
		
		$projectinfo="SELECT  * FROM `project_info`";
		$result=$db->select_query($projectinfo);
		if($result>0){
			$fetch_result=$result->fetch_array();
		}
		
			$personalinformation = "SELECT `running_student_info`.*,`add_class`.`class_name`,`student_personal_info`.`student_name`,`father_name`,
`mother_name`,`student_guardian_information`.`guardian_contact`,`student_address_info`.`present_village`,
`present_upazila`,`present_distric`,`add_group`.`group_name`,`add_section`.`section_name`
 FROM `running_student_info` INNER JOIN 
`add_class` ON `add_class`.`id`=`running_student_info`.`class_id`
INNER JOIN `student_personal_info` ON `student_personal_info`.`id`=`running_student_info`.`student_id`
INNER JOIN `student_guardian_information` ON `student_guardian_information`.`id`=
`running_student_info`.`student_id`
INNER JOIN `add_group` ON `add_group`.`id`=`running_student_info`.`group_id`
INNER JOIN `add_section` ON `add_section`.`id`=`running_student_info`.`section_id`
INNER JOIN `student_address_info` ON `student_address_info`.`id`=`running_student_info`.`student_id`
WHERE `running_student_info`.`student_id`='".$_POST["stdId"]."'";

//print $personalinformation ;


$resultinfo = $db->select_query($personalinformation)->fetch_array();


		?>
		
		
			<div class="has-feedback col-xs-12 col-sm-12 col-lg-13 col-md-13 " style="border:1px #000000 solid; max-width:1100px; ">
				<table width="900" class="table table-responsive">
						
						<tr style="border:1px #FFFFFF solid">
								<td width="20%" style="border:1px #FFFFFF solid; padding-top:15px;" ><span style="padding-top:5px;">Organization Name -</span></td>
							
								<td colspan="2" style="border:1px #FFFFFF solid">&nbsp;<b style="font-size:24px; letter-spacing:1px; font-family:Georgia, 'Times New Roman', Times, serif"><?php echo $fetch_result['institute_name'];?></b></td>
						</tr>
			</table>
			<table width="900" class="table table-responsive" style=" margin-top:-20px;">
						
						<tr style="border:1px #FFFFFF solid">
								<td width="20%" style="border:1px #FFFFFF solid; padding-top:15px;"  align="center"><b style="font-size:24px; letter-spacing:1px; font-family:Georgia, 'Times New Roman', Times, serif">
									Student Ledger Book
								</b></td>
						</tr>
			</table>
				<table width="900" class="table table-responsive"style=" margin-top:-20px;">
					<tr  style="border:1px #FFFFFF solid">
								<td width="16%" style="border:1px #FFFFFF solid">Name</td>
								<td width="3%" align="center" style="border:1px #FFFFFF solid">:</td>
								<td width="23%" style="border:1px #FFFFFF solid">&nbsp;<?php echo $resultinfo["student_name"];?></td>
								
								<td width="22%" style="border:1px #FFFFFF solid">Father Name</td>
								<td width="4%" align="center" style="border:1px #FFFFFF solid">:</td>
								<td width="32%" style="border:1px #FFFFFF solid">&nbsp;<?php echo $resultinfo["father_name"];?></td>
								
								
								
				  </tr>
							
							
							<tr>
								<td style="border:1px #FFFFFF solid">Mother Name</td>
								<td align="center" style="border:1px #FFFFFF solid">:</td>
								<td width="23%" style="border:1px #FFFFFF solid">&nbsp; <?php echo $resultinfo["mother_name"];?></td>
								
								<td style="border:1px #FFFFFF solid">Guardian Contact No</td>
								<td width="4%" align="center" style="border:1px #FFFFFF solid">:</td>
								<td style="border:1px #FFFFFF solid">&nbsp;<?php echo $resultinfo["guardian_contact"];?></td>
							</tr>
							<tr>
								<td style="border:1px #FFFFFF solid">Address</td>
								<td align="center" style="border:1px #FFFFFF solid">:</td>
								<td width="23%" style="border:1px #FFFFFF solid">&nbsp; <?php echo $resultinfo["present_village"].','.$resultinfo["present_upazila"].','.$resultinfo["present_distric"];?></td>
							</tr>
							
							
							
				</table>
				
				<table width="100%" class="table table-responsive"style=" margin-top:-10px;">
				
								<tr>
									<td width="15%" height="23"  style="border:1px #FFFFFF solid">Pay Rate :-</td>
									<td width="18%"  style="border:1px #FFFFFF solid"></td>
									<td width="14%"  style="border:1px #FFFFFF solid">Class :-</td>
									<td width="18%"  style="border:1px #FFFFFF solid"><?php echo $resultinfo["class_name"];?></td>
									<td width="12%"  style="border:1px #FFFFFF solid">Section :-</td>
									<td width="23%"  style="border:1px #FFFFFF solid"><?php echo $resultinfo["section_name"];?></td>
									
								</tr>
								
								
								<tr>
									<td  style="border:1px #FFFFFF solid">Roll NO :-</td>
									<td  style="border:1px #FFFFFF solid"><?php echo $resultinfo["class_roll"];?></td>
									<td  style="border:1px #FFFFFF solid">ID No :-</td>
									<td  style="border:1px #FFFFFF solid"><?php echo $resultinfo["student_id"];?></td>
									<td  style="border:1px #FFFFFF solid">Group :-</td>
									<td  style="border:1px #FFFFFF solid"><?php 
									
											if($resultinfo["group_name"]=="Null"){
												print "";
											}else {
												echo $resultinfo["group_name"];
											}
									?></td>
									
								</tr>
				</table>
				
					
				
				<table width="1053" class="tblborder" >
						  <tr>
								
							<th width="6%"  class="heigh"  ><div class="rotate"  style=" ">মাস</div></th>
										<th width="9%" class="heigh" ><div class="rotate">রশিদ নং</div></th>
										<th width="4%" class="heigh" ><div class="rotate">বকেয়া</div></th>
										<?php
										
	$selectcou = "SELECT * FROM `coloumn_setup` WHERE `year`='".$_POST["year"]."'";
												$resultcol = $db->select_query($selectcou);
													if(count($resultcol) >0)
													{
													while($fetchcol = $resultcol->fetch_array()){
														$explode = explode(' ',$fetchcol["Name"]);
													
															
										?>
							<th width="2%" >
								<div class="rotate">

								<?php echo implode('&nbsp;',$explode);?>
									


								</div></th>
										<?php
										}
										}
										?>
							<th width="14%" class="heigh" ><div class="rotate">Total</div></th>
							<th width="6%" class="heigh" ><div class="rotate">Discount </div></th>
							<th width="11%" class="heigh" ><div class="rotate">Net&nbsp;Ammount </div></th>

							<th width="10%" class="heigh"  ><div class="rotate">Total&nbsp;Payment</div></th>
							<th width="12%" class="heigh" ><div class="rotate">Total&nbsp;Due</div></th>
							<th width="17%" class="heigh"><div class="rotate">Sign&nbsp;Of&nbsp;Register&nbsp;and&nbsp;Date</div></th>
							<th width="9%" class="heigh"><div class="rotate">Comments</div></th>
										
										
										
						  </tr>
						  
						  	<?php
								$selMonth = "SELECT * FROM `month_setup` ORDER BY `id` ASC";
								$checkMont=$db->select_query($selMonth);
								if($checkMont)
								{


							
								$totalnetammout = 0;
								$totalpaidammoun = 0;
								$sumdeuammount=0;
								$net_total_Amount=0;
								$net_paid_amount=0;
								$net_discount_Amount=0;

								//Previous dues fixed dora hotaca.............................................
//

									$select_old_due="SELECT `add_fee`.*,`student_account_info`.`fee_id`,`student_account_info`.`AmountExceptional` FROM `add_fee`
								INNER JOIN `student_account_info` ON `add_fee`.`id`=`student_account_info`.`fee_id` WHERE `add_fee`.`title`='Previous dues' 
								AND `student_account_info`.`studentID`='$resultinfo[student_id]' AND `add_fee`.`year`='".$_POST["year"]."' AND `add_fee`.`class_id`='$resultinfo[class_id]'";

								//echo $select_old_due;
								$OlddueCheck=$db->select_query($select_old_due);
								if($OlddueCheck)
								{
									$fetmonth=$OlddueCheck->fetch_array();
									$previousdueamount =$fetmonth['AmountExceptional'];
								}
								else
								{
									$previousdueamount=0;
								}

//Previous dues fixed dora hotaca.............................................
//


						
							while($fetmonth=$checkMont->fetch_array())
								{
								
								
								 $totalammountformont="SELECT `student_account_info`.*,SUM(`add_fee`.`amount`) as montammount,SUM(`student_account_info`.`AmountExceptional`) AS 'exceptionalAmount' FROM `student_account_info`
INNER JOIN `add_fee` ON `add_fee`.`id`=`student_account_info`.`fee_id`
WHERE `student_account_info`.`studentID`='".$resultinfo["student_id"]."' AND `student_account_info`.`year`='".$_POST["year"]."'
AND `add_fee`.`fk_month_id`='$fetmonth[id]'";

//echo $totalammountformont;




	$totaldiscount ="SELECT SUM(`add_discount`.`discount`) AS sumdiscount,`add_fee`.`title` FROM `add_discount`
INNER JOIN `add_fee` ON `add_fee`.`id`=`add_discount`.`feeid`
WHERE `add_discount`.`student_id`='".$resultinfo["student_id"]."' AND `add_discount`.`year`='".$_POST["year"]."' AND `add_fee`.`fk_month_id`='$fetmonth[id]'";



											 $student_paid_ammount = "SELECT SUM(`student_paid_table`.`paid_amount`) as totapaid FROM `student_paid_table`
WHERE `student_paid_table`.`student_id`='".$resultinfo["student_id"]."' AND `student_paid_table`.`year`='".$_POST["year"]."' AND 
`student_paid_table`.`month`='$fetmonth[id]'";


$resultammountformont = $db->select_query($totalammountformont)->fetch_array();
$resultdiscountforma=$db->select_query($totaldiscount)->fetch_array();
$result_paid_ammount_mon = $db->select_query($student_paid_ammount)->fetch_array();


						 $netammount = ($resultammountformont['montammount']+$resultammountformont['exceptionalAmount'])-$resultdiscountforma['sumdiscount'];
						 
						 $netdueammount =  $netammount-$result_paid_ammount_mon['totapaid'];
					// .......................total ...........					


						 	$net_total_Amount=$net_total_Amount+$resultammountformont['montammount']+$resultammountformont['exceptionalAmount'];
						 	$net_discount_Amount=$net_discount_Amount+$resultdiscountforma['sumdiscount'];

						 

						 	$net_paid_amount=$net_paid_amount+$result_paid_ammount_mon['totapaid'];
					
					


						//.............................
								
	?>
						   <tr align="center">
								
								<td align="center"><?php echo $fetmonth[1];?></td>
								<td class="heigh2">
							<?php
								
								 $vourcerno = "SELECT `student_paid_table`.`voucher` FROM `student_paid_table`  
WHERE `student_paid_table`.`student_id`='".$resultinfo["student_id"]."' 
AND `student_paid_table`.`year`='".$_POST["year"]."' 
AND `student_paid_table`.`month`='$fetmonth[id]'  GROUP BY `student_paid_table`.`voucher`";
$resultvoucernow = $db->select_query($vourcerno);
		if(mysqli_num_rows($resultvoucernow) >0){
			while($fetchvou = $resultvoucernow->fetch_array()){
					print $fetchvou[0].'<br/>';
			}
		}
								?>
								
								
								</td>
								<td> <?php 

								if($fetmonth['id']=='01')
								{
									echo $previousdueamount;
								}
								else
								{
									echo $sumdeuammount;
								}
									
									

								 ?></td>
								<?php
										$resultcosl = $db->select_query($selectcou);
											if(count($resultcosl) >0)
											{
											while($fetchcols = $resultcosl->fetch_array()){
											
											 $sqlyear="SELECT `columnwisefeesetupforstd`.*,`student_account_info`.*,SUM(`add_fee`.`amount`) AS totalammount,SUM(`student_account_info`.`AmountExceptional`) AS 'exceptionalAmount' FROM 
`student_account_info` INNER JOIN  `columnwisefeesetupforstd` ON  
`columnwisefeesetupforstd`.`fk_fee_id`=`student_account_info`.`fee_id`
INNER JOIN `add_fee` ON `add_fee`.`id`=`student_account_info`.`fee_id`
WHERE `student_account_info`.`studentID`='".$resultinfo["student_id"]."' AND `columnwisefeesetupforstd`.`fk_column_id`='".$fetchcols['id']."'
AND `student_account_info`.`year`='".$_POST["year"]."'  AND `add_fee`.`fk_month_id`='$fetmonth[id]'";

											$resultsql = $db->select_query($sqlyear)->fetch_array();
											
										?>
										<td width="2%"><?php $a=$resultsql['exceptionalAmount']+$resultsql['totalammount'];
										if($a!="0")
											{
												echo $a;
												}  ?></td>
										
										<?php 
										  }  }
										?>
										
										
								<td width="14%">
									<?php
											
												
												echo $resultammountformont['montammount']+$resultammountformont['exceptionalAmount'];
									?>								</td>
								<td>
										<?php
											 
										echo $resultdiscountforma['sumdiscount'];

										?>
								</td>
								<td>
								<?php
										echo ($sumdeuammount+$resultammountformont['montammount']+$resultammountformont['exceptionalAmount'])-$resultdiscountforma['sumdiscount'];

										$sumdeuammount = $sumdeuammount+$netdueammount;

											
								?>
								</td>
								<td>
									<?php

										echo $result_paid_ammount_mon['totapaid'];
									?>
								
								</td>
								<td>
								
								<?php  	echo $sumdeuammount;?>
								</td>	
								<td></td>
								<td></td>
								
										
						  </tr>
						  	<?php
								}  }
								?>
								
					
				
							  
						  
						  
	
</table>


<table width="600" class="table table-responsive">
				
		<tr>
			<td width="15%" height="23"  style="border:1px #FFFFFF solid"> Net Total : <?php echo 
								@$db->my_money_format($net_total_Amount);?></td>
							

								<td width="18%"  style="border:1px #FFFFFF solid">Total Discount : <?php echo @$db->my_money_format($net_discount_Amount);?></td>



</tr>

<tr>
	<td width="18%"  style="border:1px #FFFFFF solid">Total Paid : <?php echo @$db->my_money_format($net_paid_amount);?></td>
							<td width="18%"  style="border:1px #FFFFFF solid">Total Due : <?php 
								$due=$net_total_Amount-($net_discount_Amount+$net_paid_amount);

							echo @$db->my_money_format($due)?></td></tr>
								
			  </table>


				<style type="text/css">  
			.rotate {
  display: inline-block;
  filter: progid: DXImageTransform.Microsoft.BasicImage(rotation=3);
  -webkit-transform: rotate(270deg);
  -ms-transform: rotate(270deg);
  transform: rotate(270deg);
   width: 40px;
   margin-top:200px;


}

.rotate2{

  display: inline-block;
  filter: progid: DXImageTransform.Microsoft.BasicImage(rotation=3);
  -webkit-transform: rotate(270deg);
  -ms-transform: rotate(270deg);
  transform: rotate(270deg);
   width: 40px;
   margin-top:200px;
   
}
.tblborder,
.tblborder td,
.tblborder th {
  border-collapse: collapse;
  border: 1px solid #000;
}
.tblborder td,
.tblborder th {
  padding: 0px 0px;
  
}

.heigh{
		height:250px; 
	
}
			</style>
</div>
		<?php
		}	
	
	
	} else { print "<script>location='../adminloginpanel/index.php'</script>";}
	
	
	
	?>