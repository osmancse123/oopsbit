<?php
	error_reporting(1);
@session_start();
	require_once("../db_connect/config.php");
	require_once("../db_connect/conect.php");
	$db = new database();
		if(isset($_POST["name"])){
		
				if(!empty($_POST["id"])){
				$a = [];
				 $forTeacherInfo="SELECT `teachers_name`,`designation`,`mobile_no` FROM `teachers_information` WHERE `teachers_id`='".$_POST["id"]."'";
				$resultForinof=$db->select_query($forTeacherInfo);
							if($resultForinof->num_rows> 0){
							
									$fetch=$resultForinof->fetch_assoc();
							//$a  = array('name' =>$fetch['student_name'],'Sess'=>$fetch['session2']);
							//$msg=json_encode($a);
							$msg = $fetch['teachers_name'].'/'.$fetch['designation'].'/'.$fetch['mobile_no'];
							echo $msg;
							}

							}
							
					}
	
	
		  // 		if(isset($_POST["paybalAMmount"])){
				
				// 		if(!empty($_POST["id"])){
				// 					$paybalAMMount="SELECT * FROM `teacher_payable_master_table` WHERE `teacher_id`='".$_POST["id"]."'";
				// 					$result = $db->select_query($paybalAMMount);
				// 					if($result ->num_rows > 0){
				// 							$fetchResult = $result->fetch_array();
				// 							$msg = $fetchResult['pay_amount'];
				// 								echo $msg;
				// 					}
				// 		}
				// }
				
				
				if(isset($_POST["AddandDelete"])){
				 $makeid=$db->autogenerat('teacher_payment_history','id','Rec-','9');
  					
							
						if(!empty($_POST["payAmount"])){
				
							   
		$insert_fee="INSERT INTO `teacher_payment_history` (`id`,`teacher_id`,`date`,`year`,`month`,`current_amount`,`payment_amout`,`user_id`) VALUES('$makeid','".$_POST['teacherId']."','".date('d/m/Y')."','".date('Y')."','".$_POST['month']."','".$_POST['total_amount']."','".$_POST['payAmount']."','".$_SESSION["id"]."')";
	
				$db->insert_query($insert_fee);
	if($db->sms){
												
											$arrayName = array('payId' => $makeid,'sms'=>$db->sms );
											 echo json_encode($arrayName);
												}
// 				$sqls="SELECT * FROM teacher_payable_master_table  where teacher_id='".$_POST['teacherId']."'";
// 				$qur=$db->select_query($sqls);
// 				if ($qur) {
//   $updatess="UPDATE teacher_payable_master_table SET `payable_date`='".date('d/m/Y')."',`pay_amount`='".$_POST["duammmount"]."' where teacher_id='".$_POST['teacherId']."'";
// 			$update=$db->update_query($updatess);
// 				}
// 				else
// 				{
// $ins="INSERT INTO teacher_payable_master_table (teacher_id,pay_amount,user_id) values ('".$_POST['teacherId']."','".$_POST["duammmount"]."','".$_SESSION["id"]."') ";
//  $check_insertx=$db->insert_query($ins);
// 				}
									
									 
				}
						else 
						{
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
					
					$forInformation ="SELECT `teacher_payment_history`.*,`teachers_information`.`teachers_name`,`teachers_information`.`designation`,`teachers_id`,`mobile_no`
FROM `teacher_payment_history` INNER JOIN `teachers_information` ON `teachers_information`.`teachers_id`=`teacher_payment_history`.`teacher_id`
WHERE `teacher_payment_history`.`teacher_id`='".$_POST["teacherId"]."' and teacher_payment_history.id='".$_POST["payId"]."'";
					$resultFormation = $db->select_query($forInformation);
							if($resultFormation->num_rows > 0){
									$fetchFormation =$resultFormation->fetch_array();
		 $forAlltitle = "SELECT teacher_payment_history_cart.*,add_payment_title.payment_title FROM `teacher_payment_history_cart` INNER JOIN `add_payment_title` ON `add_payment_title`.`id`=`teacher_payment_history_cart`.`tittle` where teacher_payment_history_cart.teacher_id='".$fetchFormation["teacher_id"]."' and teacher_payment_history_cart.payment_history_id='".$_POST["payId"]."'";
											$resultForTitla = $db->select_query($forAlltitle);
							}
							$foraccountannaem = "SELECT `Name` FROM `admin_users` WHERE `id`='".$fetchFormation["user_id"]."'";
								$foaccountresult = $db->select_query($foraccountannaem);
									if($foaccountresult->num_rows > 0){
										$fetchforamm=$foaccountresult->fetch_array();
									}
					
						?>
				<style type="text/css">
<!--
.style1 {color: #003366; font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;}
.style2 {color: #003366; font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;}
-->
                </style>
				
							<table width="536" border="0" cellpadding="0" cellspacing="0" class="table table-bordered col-md-12  col-lg-12" style="margin-top:10px;">
									<tr>
											<td height="91" align="justify" colspan="3">
											<ul style="width:113px; height:100px; float:left; clear:right; text-align:right; margin-left:90px;"><img src="all_image/Logo.png" height="100" width="113" />
											</ul>
											<ul style="width:413px; height:100px; float:left; clear:right; margin-top:10px;margin-left:50px;">
												<strong style=""><span style="font-size:19px; font-family:Algerian;"><?php echo $fetchSql["institute_name_en"];?></span><br/>
											<span style="font-size:13px;"><?php echo $fetchSql["phone_number"];?></span>&nbsp;,<span style="font-size:13px;">&nbsp; &nbsp;<?php echo $fetchSql["email"];?></span><br/>
												<span style="font-size:13px;"><?php echo $fetchSql["address_en"];?></span>									  </strong>
											</ul>										</td>
									</tr>		
									<tr>
										<td height="77" colspan="3">
												<table width="107%" border="0" align="center" cellpadding="0" cellspacing="0" style="width:100%;">
														<tr>
											<td height="28"><span class="style1" style="padding-left:10px;">Voucer ID</span></td>
												<td align="center">:</td>
												<td><span style="padding-left:10px;"><?php echo $fetchFormation["id"];?></span></td>
											<td><span class="style1" style="padding-left:10px;">Date</span></td>
											<td align="center">:</td>
											<td><span style="padding-left:10px;"><?php echo date('d/m/Y');?></span></td>
									</tr>
									<tr>
											<td height="30"><span class="style1" style="padding-left:10px;">Teacher Name</span></td>
												<td align="center">:</td>
												<td><span style="padding-left:10px;"><?php echo $fetchFormation["teachers_name"];?></span></td>
											<td><span class="style1" style="padding-left:10px;">ID </span></td>
											<td align="center">:</td>
											<td>&nbsp; <?php echo $fetchFormation["teachers_id"];?></td>
									</tr>
									<tr>
											<td height="27"><span class="style1" style="padding-left:10px;">Phone</span></td>
											<td>:</td>
											<td>&nbsp;<?php echo $fetchFormation["mobile_no"];?></td>
											<td><span class="style1">Designation</span></td>
											<td align="center">:</td>
											<td><span style="padding-left:10px;"><?php echo $fetchFormation["designation"];?></span></td>
									</tr>
										  </table>										</td>
									</tr>
									
									<tr>
										<td width="46" height="28"><span style="padding-left:10px;"><strong>Sl</strong></span></td>
										<td width="253"><span style="padding-left:10px;"><strong>Title</strong></span></td>
										<td width="140"><span style="padding-left:10px;"><strong>Taka</strong></span></td>
									</tr>
									
									<?php 
											if($resultForTitla->num_rows  >0 ){
											$sl = 0;
											$total = 0;
													while($fetchFortitle = $resultForTitla->fetch_array()){
													$total =$total+$fetchFortitle["amount"];
													$sl++;
									?>
									<tr>
											<td height="28"><span style="padding-left:10px;"><?php echo $sl;?></span></td>
										<td><span style="padding-left:10px;"><?php echo $fetchFortitle["payment_title"];?></span></td>
										<td><span style="padding-left:10px;"><?php echo $fetchFortitle["amount"];?></span></td>
							  </tr>	
											<?php } ?>
													<tR>
														<td height="29" colspan="2" align="right"><span class="style2" style="padding-left:10px;">Total Amount</span></td>
													    <td><span style="padding-left:10px;"><?php echo $total;
												


													?></span></td>
												</tR>
												
						
													
												<?php 
														 $forPaidAmmount ="SELECT payment_amout FROM teacher_payment_history WHERE teacher_id='".$fetchFormation["teacher_id"]."' and id='".$_POST["payId"]."' ";
														$resultPaidAmmount = $db->select_query($forPaidAmmount);
															if($resultPaidAmmount->num_rows > 0){
																$fetchpaidAmmon= $resultPaidAmmount->fetch_array();
																
															}
												?>
													<tR>
														<td height="31" colspan="2" align="right"><span class="style2" style="padding-left:10px;">Paid Amount</span></td>
													    <td><span style="padding-left:10px;"><?php echo $fetchpaidAmmon["payment_amout"];?></span></td>
												</tR>
												<tR>
														<td height="28" colspan="2" align="right"><span class="style2" style="padding-left:10px;">Due Amount</span></td>
													    <td><span style="padding-left:10px;">
													    	
<?php
if (isset($fetchpaidAmmon["payment_amout"])) 
{
	$due=$total-$fetchpaidAmmon["payment_amout"];
	echo $due;
}
?>

													    </span></td>
												</tR>
											<?php  }?>
				</table>
						<?php }
				?>
				<?php
if(isset($_POST["showPaymentTitle"])){

     $id=$_POST["teacherId"];
	$year=$_POST["year"];
	$month=$_POST["month"];
$queryAA="SELECT * FROM teacher_future_funds  WHERE teacher_future_funds.teacher_id='$id' and teacher_future_funds.month='$month' and teacher_future_funds.year='$year'";
    $resultAA=$db->select_query($queryAA);
    if ($resultAA>0) {

 $a=mysqli_fetch_assoc($resultAA);
  
	$tot=$a["total_salary"];
	$from_teacher=$a["from_teacher"];
	
	$gTotal=$tot-$from_teacher;
	if ($gTotal > 0)
	 {
	 	$arrayName = array('tota' =>$gTotal);
		echo json_encode($arrayName);
	}
                    
     }

}
	
if (isset($_POST["ShowHistory"]))
 {
 	 $selApp="select * from project_info";
$queApp=$db->select_query($selApp);
$fetchApp=mysqli_fetch_assoc($queApp);
?>

<style type="text/css">
<!--
.style1 {color: #003366; font-weight:bold; font-size:14px}
.style2 {color: #003399; font-weight:bold; font-size:14px}
li{list-style: none;text-align: justify;}

-->
</style>
<table width="948" height="262" border="0" align="center" cellpadding="0" cellspacing="0" class="table table-bordered">
  <tr>
    <td height="74" colspan="7">
    	
		<ul style="margin-left:60px;padding-top:20px;width:20%; float:left;clear:right;">
					<img src="all_image/Logo.png" width="90" height="80" style=""/>
					</ul>					
					<ul style="margin-left:-30px;padding-top:20px; float:left;clear:right">
					  
					  <li style="color:#000000;font-family:Algerian; text-shadow:0px 0px 2px #ccc; font-size:20px;"><?php echo $fetchApp["institute_name_en"]?></li>
	   <li><p style="margin-top:-1px;font-size:16px;font-family:Arial, Helvetica, sans-serif"><?php echo $fetchApp["address_en"]?></p>
	   </li>
	    <li style="margin-top:-13px;font-size:14px;font-family:Arial, Helvetica, sans-serif">www.joypursorojini.edu.bd, <?php echo $fetchApp["phone_number"]?></li>
	                  </ul>

    </td>
  </tr>
  <?php
  $techer=$_POST["teacherId"];
$tch="select * from teachers_information where teachers_id='$techer'";
$query=$db->select_query($tch);
if ($query) {
  # code...

$fetch=mysqli_fetch_assoc($query);
  ?>
  <tr>
    <td height="44" colspan="2"><span class="style2">Name : <?php echo $fetch["teachers_name"] ?></span></td>
    <td colspan="3"><span class="style2">ID No: <?php echo $fetch["teachers_id"] ?></span></td>
    <td colspan="2"><span class="style2">Designation : <?php echo $fetch["designation"] ?></span></td>
  </tr>
    <?php
  $techer=$_POST["teacherId"];
  $sql="select * from teacher_payment_history where teacher_id='$techer' group by year order by year desc";
$quer=$db->select_query($sql);
if ($quer) {
while ( $roww=mysqli_fetch_assoc($quer))
 {
$sql="select * from teacher_payment_history where teacher_id='$techer' and year='".$roww["year"]."' group by month ";
$quer=$db->select_query($sql);
if ($quer) {
while ( $row=mysqli_fetch_assoc($quer))
 {
  ?>
  <tr>
    <td height="37" colspan="7"><span class="style2">Month : <?php 

if ($row["month"]=="Jan") {
  echo "January";
}
else if ($row["month"]=="Feb") {
  echo "February";
}
else if ($row["month"]=="Mar") {
  echo "March";
}
else if ($row["month"]=="Apr") {
  echo "April";
}
else if ($row["month"]=="May") {
  echo "May";
}
else if ($row["month"]=="Jun") {
  echo "June";
}
else if ($row["month"]=="Jul") {
  echo "July";
}
else if ($row["month"]=="Aug") {
  echo "August";
}
else if ($row["month"]=="Sep") {
  echo "September";
}
else if ($row["month"]=="Oct") {
  echo "October";
}
else if ($row["month"]=="Nov") {
  echo "November";
}
else if ($row["month"]=="Dec") {
  echo "December";
}
else {
  echo $row["month"];
}
 ?>
   - <?php echo $roww["year"]; ?>
 </span></td>
  </tr>
  <tr>
    <td width="128" height="35"><span class="style1">Receipt No </span></td>
    <td width="156"><span class="style1">Date</span></td>
    <td width="134"><span class="style1">Sub-Total </span></td>
    <td width="125"><span class="style1">Prv. Dues </span></td>
    <td width="113"><span class="style1">Curr. Amount </span></td>
    <td width="137"><span class="style1">Payment</span></td>
    <td width="155"><span class="style1">User By </span></td>
  </tr>
  <?php
  $sqla="select admin_users.Name,teacher_payment_history.* from teacher_payment_history inner join admin_users on  teacher_payment_history.user_id=admin_users.id where teacher_id='$techer' and year='".$roww["year"]."' and month='".$row["month"]."'";
$quera=$db->select_query($sqla);
if ($quera) {
while ($rowa=mysqli_fetch_assoc($quera))
 {
 ?>
  <tr>
    <td height="36">&nbsp; <?php echo $rowa["id"] ?></td>
    <td>&nbsp; <?php echo $rowa["date"] ?></td>
    <td>&nbsp; <?php echo $rowa["sub_amount"] ?></td>
    <td>&nbsp; <?php echo $rowa["prv_due"] ?></td>
    <td>&nbsp; <?php echo $rowa["current_amount"] ?></td>
    <td>&nbsp; <?php echo $rowa["payment_amout"] ?></td>
    <td>&nbsp; <?php echo $rowa["Name"] ?></td>
  </tr>
   <?php
}}
  ?>
  <tr>
    <td height="36">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    <?php
}}}}}
  ?>
</table>
<?php
}
?>
