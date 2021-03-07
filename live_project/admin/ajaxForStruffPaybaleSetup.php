<?php
	error_reporting(1);
@session_start();
	require_once("../db_connect/config.php");
	require_once("../db_connect/conect.php");
	$db = new database();
	
	
		if(isset($_POST["name"])){
		
				if(!empty($_POST["id"])){
				$a = [];
				 $forTeacherInfo="SELECT `stuff_name`,`designation`,`mobile_no` FROM `stuff_information` WHERE `stuff_id`='".$_POST["id"]."'";
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
	?>
	<?php
	
	if(isset($_POST["showPaymentTitle"])){
			?>
	
				<table class="table-bordered" style="width:100%;">
						<tr>
								<td style="vertical-align:middle;">
									<div class="col-md-5">
											<strong><span class="text-justify text-info"> Payment Title&nbsp;:</span></strong>
											<select name="paymenttitle"  id="payTitle" style="width:100%;  height:30px; margin-bottom:10px;" >
                    <option selected disabled>select one</option>
                    <?php 
$queryAA="select * from add_payment_title";
    $resultAA=$db->select_query($queryAA);
    if ($resultAA>0) {
    while($a=$resultAA->fetch_array())
    {
                    ?>
                    <option value="<?php echo $a['id'] ?>"><?php echo $a['payment_title'] ?></option>
                    <?php
                  }}?>
                  </select>
									</div>
									<div class="col-md-4">	<strong><span class="text-justify text-info"> Amount &nbsp;:</span></strong>
									<input type="text" class="" name="payedamount" id="payAmount"  style="width:100%;  height:30px; margin-bottom:10px;" ></input>
									
									</div>
									<div class="col-md-3">  
									<input type="button" name="add" id="id"  class="btn btn-info btn-sm" style="vertical-align:middle; text-align:center;margin-top:20px; padding-left:5px;" onclick="return TeacherpaymentADd()" value="ADD" />
									</div>
								</td>
						</tr>
				</table>
	
<?php 	}
	
?>

<?php
		if(isset($_POST["add"])){
				if(!empty("date") && !$_POST["SHsection"] !="Select One.." && !empty($_POST['paymenttitle']) && !empty($_POST['payedamount']))		{
						$struffPaymentID=$db->autogenerat('struffpayablesetup','PaymentId','SCP-','9');
						$id=$db->escape($_POST['struffID']);
						$SHsection=$db->escape($_POST['SHsection']);
						$date=$db->escape($_POST['date']);
						$paymenttitle=$db->escape($_POST['paymenttitle']);
						$payedamount=$db->escape($_POST['payedamount']);
						$monthly=date('M');
						$Years=date('Y');
						
								 $query="INSERT INTO  `struffpayablesetup` (`struffId`,`PaymentId`,sectionId,`date`,`title`,`ammount`,`month`,`year`,`userID`)
VALUES ('$id','$struffPaymentID','$SHsection','$date','$paymenttitle','$payedamount','$monthly','$Years','".$_SESSION["id"]."')";
						$resultisnsert=$db->insert_query($query);
			
				$struffPaymentID=$db->autogenerat('struffpayablesetup','PaymentId','SCP-','9');
					if(isset($db->sms)){
							echo $db->sms;
					}
				
				}else{
				
						echo "<span class='text-center text-danger glyphicon glyphicon-remove'><strong>&nbsp;Please Fill Up Important Fields..</strong></span>";
				}
		}
?>

<?php
		if(isset($_POST["showTeacherPayemntt"])){
		
		  $sears="SELECT `struffpayablesetup`.*,`add_payment_title`.`payment_title` FROM `struffpayablesetup`
INNER JOIN `add_payment_title` ON `add_payment_title`.`id`=`struffpayablesetup`.`title`
WHERE `struffpayablesetup`.`struffId`='".$_POST["struffID"]."' AND `struffpayablesetup`.`date`='".$_POST["date"]."'";
    $checked=$db->select_query($sears);
    
    	if($checked->num_rows>0)
   		 {
?>
<form method="post">
<table width="844"  align="center" cellpadding="0" cellspacing="0" bordercolor="#333333" class="table table-responsive box">
            <tr>
              <td width="8%" align="center" bgcolor="#000000"><span class="style1">Sl</span></td>
              <td width="51%" align="left" bgcolor="#000000"><span class="style1">&nbsp;&nbsp;Title</span></td>
              <td width="41%" align="center" bgcolor="#000000"><span class="style1">Amount</span></td>
            </tr>
            <?php

   		 	$i=1;
   		 	$total=0;
     while( $fetch=$checked->fetch_array())
     {
     	$total+=$fetch['ammount'];
  		
            ?>
            <tr>
              <td align="center">&nbsp;<?php echo $i++ ?></td>
              <td align="left">&nbsp;<?php echo $fetch['payment_title'] ?></td>
              <td align="left">&nbsp;<?php echo $fetch['ammount'] ?></td>
            </tr>
            <?php
        }
            ?>
             <tr>
              
              <td align="right" colspan="2">Total :</td>
              <td align="left"><input type="text" value="<?php echo $total;?>" name="payableAmountf" style="padding-left:5px;" readonly=""></td>
  </tr>
  <tr>
  		<td colspan="3">
				<span id="showMsg"></span>	
		</td>
  </tr>
  <tr>
  	 <td colspan="3" align="right"><button type="submit" name="save" class="btn btn-info btn-sm" onclick="return saveData()">Save</button></td>
  </tr>
          </form>
          <?php

} }
          ?>
		  
		  
		    <?php
		  		if(isset($_POST["saveData"])){
						if(!empty($_POST["payableAmountf"])){
				
								 $insertSql = "REPLACE INTO `struffpayablemastertable`(`struffId`,`Payable_Date`,`payAmmount`,`userId`) VALUES('".$_POST["struffID"]."','".$_POST["date"]."','".$_POST["payableAmountf"]."','".$_SESSION["id"]."')";
								$resultsql=$db->insert_query($insertSql);
										if(isset($db->sms)){
										
												echo $db->sms;
										}
								
								}
				
				}
		  ?>
		 

