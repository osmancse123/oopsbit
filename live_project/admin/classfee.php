  <?php
	// error_reporting(1);
    session_start();
	if($_SESSION["logstatus"] === "Active")
	{
	require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
	date_default_timezone_set("Asia/Dhaka");
	$db = new database();

	$selApp="select * from project_info";
$queApp=$db->select_query($selApp);
$fetchApp=mysqli_fetch_assoc($queApp);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Student Accounts</title>
	
	
	<style type="text/css">
		
		@media print{
			.print{
				display:none;
			}
			


	</style>
  <script type="text/javascript" src="../js/vendor/jquery-1.11.3.min.js"></script>
	  <script src="textEdit/redactor/redactor.min.js"></script>
  
    <link rel="stylesheet" href="datespicker/datepicker.css">
    

   
     <script src="datespicker/bootstrap-datepicker.js"></script>
	 
	     <script src="../js/bootstrap.min.js"></script>
	 <script type="text/javascript">
	 
	 
	    $(document).ready(function () {
                    
                    $('#example1').datepicker({
                        format: "dd/mm/yyyy"
                    });  
                
                });
				
				
             $(document).ready(function()
  {
        var checking_html = '<img src="search_group/loading.gif" /> Checking...';
        $('#className').change(function()
        {
            $('#item_result').html(checking_html);
                check_availability();
               Check_exam_type();
        });
    
 });

         //function to check username availability   
function check_availability()
{
        var class_name = $('#className').val();
        $.post("check_grou_name.php", { className: class_name },
            function(result){
                //if the result is 1
                if(result !=0 )
                {
                    //show that the username is available
                    $('#groupname').html(result);
                    $('#item_result').html("");
                    $('#category_result').html('');
                }
                else
                {
                    //show that the username is NOT available
                    document.getElementById('category_result').style.color='RED';
                    $('#category_result').html('No Group Name Found');
                    $('#item_result').html("");
                    $('#groupname').html('');
                }
                
                $('#subject_type').html("");
                $('#sub_name').html("");
                $('#part_name').html('');
                $('#subjectcode').val('');
                 
        });

}

	
		

</script>
    </head>
  <body>
  	<form name="teacherinfo" action="" method="post"  enctype="multipart/form-data" class="form-horizontal marksEditEntry" >
           
			
                <table  height="100" width="960" align="center" style="border:1px #000 solid;" class="print" bgcolor="#f4f4f4">
                    
                    <tr>
                    		<td  colspan="3"><h1>Student Bill & Payment Report</h1></td>
                    </tr>

   					 <tr>
                    	
						<td><strong><span class="text-success" style="font-size: 15px;">Year</span></strong></td>
                        <td ><div class="col-md-8">
						 <input type="text"   class="form-control" name="year" style="width:280px; height: 25px; border-radius:0px;" placeholder="<?= date('Y');?>"  value="<?= date('Y');?>">
						 </div></td>
                    
					
					  </tr>
					

					<tr>
                    	<td >
                    		<strong><span class="text-success" style="font-size: 15px;">Select Class</span></strong></td>
                        <td ><div class="col-md-8">
                        <select class="form-control" name="className" id="className" style="width:285px; height: 30px;  font-size: 14px;">
                        <option>Select One</option>
                        <?php 
                            $select_class="SELECT * FROM `add_class`  ORDER BY `index` ASC";
                            $check_query=$db->select_query($select_class);
                            if($check_query){
                                while($fetch_class=$check_query->fetch_array())
                                {
                        ?>
                        <option value="<?php echo "$fetch_class[0]"?>"><?php echo $fetch_class[2];?></option><span id="item_result"></span>
                        <?php } } else {?>
                        <option></option>
                        <?php } ?>
                        </select></div>
                    </tr>

					
					 <tr id="date">
                    	
						
					</tr>
					
					
				
					
                <tr>

                	<td colspan="2" align="left"><input type="submit" name="showdata" value="Show Data" class="btn btn-danger btn-md" style="width: 120px; margin-left: 300px; height: 30px;" onClick="return ShowReportDaily()"></input>
				</td>

			</tr>
                </table>
							
                
				
				 
     </form>
     <?php
     		if(isset($_POST["showdata"])){
     				if($_POST["className"] != "Select One" and $_POST["year"] != ""){

     					 $sql = "SELECT `student_account_info`.*,`student_personal_info`.`student_name`,`running_student_info`.`class_roll` FROM `student_account_info`
INNER JOIN `student_personal_info` ON `student_personal_info`.`id`=`student_account_info`.`studentID`
INNER JOIN `running_student_info` ON `running_student_info`.`student_id`=`student_account_info`.`studentID`
WHERE `student_account_info`.`class_id`='$_POST[className]' AND student_account_info.`year`='$_POST[year]' GROUP BY `student_account_info`.`studentID`
 ORDER BY `running_student_info`.`class_roll` ASC";
			$resulsql = $db->select_query($sql);		
     		 ?>

     			
				 
				 	<table  cellspacing="0" cellpadding="0" align="center" width="960" style="margin-top:20px;" bgcolor="#fff">

<tr>
	<td colspan="12"  style="border-left: 1px #000 solid; border-top: 1px #000 solid;border-right: 1px #000 solid; font-weight: bold; height: 40px; width: 30px; "> 

 <table  width="100%"  border="0" align="left" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" >
    <tr>

   

      <td  height="50" colspan="4" align="center" >
      	<span style="float: left;">  <img src="all_image/logoSDMS2015.png" width="76" height="74" style="" /></span>
    <ul style=" padding-top:5px">
    
    <li style="color:#000000;font-family:microsoft-sun-serif;  font-size:26px; list-style: none;"><?php echo $fetchApp["institute_name"]?></li>
   <li style="list-style: none;"><p style="margin-top:-1px;font-size:16px;font-family:Arial, Helvetica, sans-serif"><?php echo $fetchApp["location"]?></p></li>
    <li style=" list-style: none; margin-top:-13px;font-size:14px;font-family:Arial, Helvetica, sans-serif"><?php echo $fetchApp["phone_number"].','.$fetchApp["email"];?></li>
     </ul>      </td>
<td style="border-bottom:1px solid #333333"></td>
    </tr>

</table>

	</td>
</tr>

				 					<tr>
				 						<td align="center" style="border-left: 1px #000 solid; border-top: 1px #000 solid;border-right: 1px #000 solid; font-weight: bold; height: 40px; width: 30px; ">SL.</td>
				 						<td align="center"style="border-top: 1px #000 solid;border-right: 1px #000 solid;font-weight: bold; width: 70px; ">ID</td>
				 						<td width="160" align="left"  style="border-top: 1px #000 solid;border-right: 1px #000 solid;font-weight: bold; ">Name</td>
				 						<td align="center" style="border-top: 1px #000 solid;font-weight: bold; border-right: 1px #000 solid; width: 35px;">Roll</td>
				 						<td align="center" style="border-top: 1px #000 solid;font-weight: bold;border-right: 1px #000 solid; ">Pre. Due</td>
				 						<td align="center" style="border-top: 1px #000 solid;font-weight: bold;border-right: 1px #000 solid; ">Common Fee</td>
				 						<td align="center" style="border-top: 1px #000 solid;font-weight: bold;border-right: 1px #000 solid; " >Exceptional Fee</td>

				 						<td align="center" style="border-top: 1px #000 solid;font-weight: bold;border-right: 1px #000 solid; ">Total Amount</td>
				 						<td align="center" style="border-top: 1px #000 solid;font-weight: bold;border-right: 1px #000 solid; ">Total Discount</td>
				 						<td align="center"style="border-top: 1px #000 solid;font-weight: bold;border-right: 1px #000 solid; ">Net Amount</td>
				 						<td width="70" align="center"  style="border-top: 1px #000 solid;font-weight: bold;border-right: 1px #000 solid; ">Paid</td>
				 						<td width="70" align="center" style="border-top: 1px #000 solid;font-weight: bold;border-right: 1px #000 solid; ">Due</td>

				 					</tr>
				 					<?php
			if(count($resulsql)>0){
				$i=1;
				$TotalpreviousAmount=0;
				$totalCommonFee=0;
				$totalExceptionalFee=0;
				$totalAmount=0;
				$totalDiscount=0;
				$totalNetAmount=0;
				$totalPaidamount=0;
				$totalDueAmount=0;
			while ($fetchsql = $resulsql->fetch_array()) {

			?>
			<tr>
										<td  align="center" style="border-left: 1px #000 solid; border-top: 1px #000 solid;border-right: 1px #000 solid; height: 30px; "> <?= $i++;?></td>
				 						<td align="center" style="border-top: 1px #000 solid;border-right: 1px #000 solid; "><?= $fetchsql["studentID"];?></td>

				 						<td align="left" style="border-top: 1px #000 solid;border-right: 1px #000 solid; padding-left:5px; " ><?= $fetchsql["student_name"];?></td>
				 						<td align="center" style="border-top: 1px #000 solid;border-right: 1px #000 solid; " ><?= $fetchsql["class_roll"];?></td>

				 						<td align="right" style="border-top: 1px #000 solid;border-right: 1px #000 solid; "><?php
			$previousDues = "SELECT student_account_info.`AmountExceptional` FROM `student_account_info`
INNER JOIN  `add_fee` ON `add_fee`.`id`=`student_account_info`.`fee_id`
WHERE `student_account_info`.`studentID`='$fetchsql[studentID]' AND `student_account_info`.`year`='".$_POST["year"]."' AND `add_fee`.`title`='Previous dues'";

			$selectQuery=$db->select_query($previousDues);
			if($selectQuery)
			{
					if($fetchPreviousDues = $selectQuery->fetch_array())
					{
						echo @$db->my_money_format($fetchPreviousDues[0]);
						$TotalpreviousAmount+=$fetchPreviousDues[0];
					}
			}
			else
			{
				$fetchPreviousDues[0]=0;
			}

		?>
&nbsp;
</td>
				 						<td align="right" style="border-top: 1px #000 solid;border-right: 1px #000 solid; "><?php
			$comonFree = "SELECT SUM(`add_fee`.`amount`) FROM `student_account_info`
INNER JOIN  `add_fee` ON `add_fee`.`id`=`student_account_info`.`fee_id`
WHERE `student_account_info`.`studentID`='$fetchsql[studentID]' AND `student_account_info`.`year`='".$_POST["year"]."' ";

			$selectcomonFee=$db->select_query($comonFree);
			if($selectcomonFee)
			{
					if($fetchcomonFree = $selectcomonFee->fetch_array())
					{
						echo @$db->my_money_format($fetchcomonFree[0]);
						$totalCommonFee+=$fetchcomonFree[0];
					}
			}
			
				?>
			&nbsp; 
		</td>
				 						<td align="right" style="border-top: 1px #000 solid;border-right: 1px #000 solid; "><?php
			$exceptionFee = "SELECT SUM(student_account_info.`AmountExceptional`) FROM `student_account_info`
INNER JOIN  `add_fee` ON `add_fee`.`id`=`student_account_info`.`fee_id`
WHERE `student_account_info`.`studentID`='$fetchsql[studentID]' AND `student_account_info`.`year`='".$_POST["year"]."' ";

			$selectExceptional=$db->select_query($exceptionFee);
			if($selectExceptional)
			{
					if($fetchExceptional = $selectExceptional->fetch_array())
					{
						 $exFee=$fetchExceptional[0]-$fetchPreviousDues[0];
						 echo @$db->my_money_format($exFee);
						$totalExceptionalFee=$totalExceptionalFee+$exFee;
					}
			}

		?>&nbsp;</td>

				 						<td  align="right" style="border-top: 1px #000 solid;border-right: 1px #000 solid; ">
				 							<?php
				 								$totalamm = "

				 								SELECT `student_account_info`.`fee_id`,SUM(`add_fee`.`amount`)+SUM(`student_account_info`.`AmountExceptional`) FROM `student_account_info`
INNER JOIN  `add_fee` ON `add_fee`.`id`=`student_account_info`.`fee_id`
WHERE `student_account_info`.`studentID`='$fetchsql[studentID]' AND `student_account_info`.`year`='".$_POST["year"]."'";

											$resul = $db->select_query($totalamm);
											if($resul)
											{
											  $fetchfeeAmount=$resul->fetch_array();
											  echo @$db->my_money_format($fetchfeeAmount[1]);
											  $totalAmount+=$fetchfeeAmount[1];
											}
											else
											{
												$fetchfeeAmount[1]=0;
											}
											
				 						?>


				 						 &nbsp;</td>
				 						<td align="right" style="border-top: 1px #000 solid;border-right: 1px #000 solid; ">
				 							<?php
											
	$totaldis = "SELECT SUM(`add_discount`.`discount`) FROM `add_discount` WHERE `student_id`='$fetchsql[studentID]' AND `year`='".$_POST["year"]."'";
											$resuldis = $db->select_query($totaldis)->fetch_array();
											echo @$db->my_money_format($resuldis[0]);



											$totalDiscount+=$resuldis[0];
				

				 							?>

				 						 &nbsp;</td>
				 						<td align="right" style="border-top: 1px #000 solid;border-right: 1px #000 solid; "><?php   $dis = $fetchfeeAmount[1]-$resuldis[0];
				 						print @$db->my_money_format($dis);

				 						$totalNetAmount+=$dis;
				

				 						?> &nbsp;</td>

				 						<td align="right" style="border-top: 1px #000 solid;border-right: 1px #000 solid; ">
				 							

<?php
			$paidAmount = "SELECT SUM(`student_paid_table`.`paid_amount`) FROM `student_paid_table`
INNER JOIN  `add_fee` ON `add_fee`.`id`=`student_paid_table`.`fk_fee_id`
WHERE `student_paid_table`.`student_id`='$fetchsql[studentID]' AND `student_paid_table`.`year`='".$_POST["year"]."'";

			$selectPaidAmount=$db->select_query($paidAmount);
			if($selectPaidAmount)
			{
					if($fetchPaidAmount = $selectPaidAmount->fetch_array())
					{
						echo @$db->my_money_format($fetchPaidAmount[0]);

						$totalPaidamount+=$fetchPaidAmount[0];
				

					}

			}
			else
			{
				$fetchPaidAmount[0]=0;
			}

		?>

				 					&nbsp; 	</td>
				 						<td align="right" style="border-top: 1px #000 solid;border-right: 1px #000 solid; ">
				 							<?php

				 								print @$db->my_money_format($dis-$fetchPaidAmount[0]);

				 							$totalDueAmount+=$dis-$fetchPaidAmount[0];
				 							?>

&nbsp;
				 						</td>


				 					</tr>
				 					<?php

} ?>
				<tr>
					<td height="40" colspan="4" style=" border-top: 1px #000 solid;border-right: 1px #000 solid;border-left: 1px #000 solid; border-bottom: 1px #000 solid;" align="right">
						<b>Total </b> &nbsp;
					</td>
					
					<td align="right" style=" border-top: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid;font-weight: bold;">
						<?php print @$db->my_money_format($TotalpreviousAmount);?>/=
						
					</td>
							<td align="right" style=" border-top: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid;font-weight: bold;">
						<?php print @$db->my_money_format($totalCommonFee);?>/=
					
					</td>
						<td align="right" style=" border-top: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid;font-weight: bold;">
						<?php print @$db->my_money_format($totalExceptionalFee);?>/=
					
					</td>
						<td align="right" style=" border-top: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid;font-weight: bold;">
						<?php print @$db->my_money_format($totalAmount);?>/=
					
					</td>
						<td align="right"  style=" border-top: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid;font-weight: bold;">
						
						<?php print @$db->my_money_format($totalDiscount);?>/=
					</td>
						<td align="right"  style=" border-top: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid;font-weight: bold;">
						<?php print @$db->my_money_format($totalNetAmount);?>/=
						
					</td>
						<td align="right"  style=" border-top: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid;font-weight: bold;">
						
						<?php print @$db->my_money_format($totalPaidamount);?>/=
					</td>
						<td align="right" style=" border-top: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid; font-weight: bold;">
						
						<?php print @$db->my_money_format($totalDueAmount);?>/=
					</td>
				</tr>

				<tr>
						<td align="center" height="50" colspan="12" style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid; font-weight: bold;"> <b>Developed by: Skill Based IT [SBIT]</b> </td>
				</tr>

				<tr>
						<td align="center" height="50" colspan="12">

							<input type="submit" value="print" name="print" class="print" onclick="window.print()" style=" height: 35px; width: 120px;">
						 </td>
				</tr>
<?php

						} else {


							print  "<tr><td colspan='12'>No Data</td></tr>";

						}
				 					?>
				 			</table>
			
		
     		 <?php 	
 }  }
     ?>

  </body>
</html>
<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>
