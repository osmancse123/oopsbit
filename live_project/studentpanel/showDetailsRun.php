<?php
	error_reporting(1);
	@session_start();
		
	if($_SESSION["userlogin"] === "1")
	{

require_once("../db_connect/config.php");
	require_once("../db_connect/conect.php");

	$db = new database();
	$cl = $_GET["clID"];
	$gp =$_GET["grID"];
	
	$ProjectInfo="SELECT * FROM `project_info`";
		$resultProjectInfo = $db->select_query($ProjectInfo);
			if($resultProjectInfo->num_rows > 0){
					$fetchProjectInfo = $resultProjectInfo->fetch_array();
			}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <title></title>
    <link href="../admin/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <script type="text/javascript" src="../admin/textEdit/lib/jquery-1.9.0.min.js"></script>
        <link rel="stylesheet" href="../admin/datespicker/datepicker.css">
    <link rel="stylesheet" href="../admin/datespicker/bootstrap.min.css">

   
     <script src="../admin/datespicker/bootstrap-datepicker.js"></script>
	 <script>
	 		function ViwAcRecord(id){
						var idd = id;
						//alert(idd);
				if(idd != "")
					{
							$('#SingleView').show();
							$('#AllView').hide();
							
							$.ajax({
									url : "selecOldRecord.php",
									type:"POST",
									data : {stID:idd},
									cache: false,
									success:function(data){
										$("#SingleView").html(data);
										//alert(data);
									}
							});
					
					}
			}
			
			function ShowAllStde(){
				$('#SingleView').hide();
				$('#AllView').show();
							
			}
			function viwRunDetails(getid){
				var RunId = getid;
				//alert(RunId);
				if(RunId != ""){
						$('#RunAllDeta').show();
						$('#AllView').hide();
						
						$.ajax({
									url : "selecOldRecord.php",
									type:"POST",
									data : {RunId:getid},
									cache: false,
									success:function(data){
										$("#RunAllDeta").html(data);
										//alert(data);
									}
							});
				}
			}
			
			function HidRunRecord(){
				$('#RunAllDeta').hide();
				$('#AllView').show();
			}
			function SubDelByid(YID)
			{
				var DelID='10';
				var StdID=$('#StID-'+YID).val();
				//alert(subID);
				//alert("ddd");
				var  subID= $('#subId-'+YID).val();
				//alert(StdID);
				
				if(subID != "" && StdID!="")
				{
					if(confirm("Are you sure?")){
					$.ajax({
						url:"selecOldRecord.php",
										type:"POST",
										data : {subID:subID,StdID:StdID,DelID:DelID},
										cache: false,
										success:function(data){
										//alert(data);
										ShowRunnDeatisl(StdID);
							}
						
					});
					}
					return false;
				}
			}
			
			
			function ShowRunnDeatisl(getid){
						
				var getid=getid;
				
				var  ViewssubID= "dddd";
				//alert(StdID);
				
				if(getid != "" && ViewssubID!="")
				{
				
					$.ajax({
						url:"selecOldRecord.php",
										type:"POST",
										data : {getid:getid,ViewssubID:ViewssubID},
										cache: false,
										success:function(data){
										
									$("#SingleView").html(data);
							}
						
					});
				
					
				}
						
			}
	 </script>
	 <style>
	@media print{
			.noneBtnForprin{
				display:none;
			}
			.not{
				display:none;
			}
			#dont{
				display:none;
			}
			.dontPrint{
			display:none;
			}
			@page 
			{
				size:  auto;   /* auto is the initial value */
				margin: 0mm;  /* this affects the margin in the printer settings */
			}
		
			html
			{
				background-color: #FFFFFF; 
				margin: 0px;  /* this affects the margin on the html before sending to printer */
			}
		
			body
			{
				border: solid 0px blue ;
				margin: 10mm 15mm 10mm 15mm; /* margin you want for the content */
			}
		}
</style>
	 </head>
	 <body>
	 <form name="" action="" method="post">
	 		<div class="col-md-12 col-lg-12 col-xs-12" id="AllView">
				<table class="table table-responsive table-hover table-bordered" style="margin-top:20px">
					
					<tr class="noneBtnForprin">
						<td colspan="6"><a href="doneFormFillup.php" class="btn btn-sm btn-danger ">BACk</a>
						</td>
						
					</tr>
					
				
					
				
				
									<tr align="center" >
											<td>Student ID</td>
											<td>Roll</td>
											<td>Name</td>
											<td>Total Subject</td>
											<td class="noneBtnForprin">View Details</td>
									</tr>
									
										<?php  
									   $sql3="SELECT `running_student_info`.`student_id`,`class_roll`,`student_personal_info`.`student_name`,`student_acadamic_information`.`session2`
 FROM`running_student_info`
 JOIN `student_personal_info` ON `student_personal_info`.`id`=`running_student_info`.`student_id` JOIN `student_acadamic_information`
 ON `running_student_info`.`student_id`=`student_acadamic_information`.`id` WHERE `running_student_info`.`student_id`='".$_SESSION["useridid"]."'";
 									$re1=$db->select_query($sql3);
									if($re1){
									
									$fet=$re1->fetch_array();
									
							?>
										<tr align="center">
											<td><?php echo $fet[0];?></td>
											<td><?php echo $fet[1];?></td>
											<td><?php echo $fet[2];?></td>
											<?php 
												$sql333="SELECT COUNT(`subject_id`) FROM `subject_registration_table` WHERE `std_id`='".$fet[0]."'";
												$chek9=$db->select_query($sql333);
												if($chek9){$r333=$chek9->fetch_array();} 
											?>
											<td><?php echo $r333[0];?></td>
											<td class="noneBtnForprin">
											<?php /*  
													$old_R="SELECT * FROM `student_academic_record` WHERE `student_id`='".$fet[0]."'";
													$old_c=$db->select_query($old_R);
													if($old_c){*/
											?>
												<input type="button" value="View Record" name="record" id="record" class="btn btn-success" style="width:120px" onClick="return ViwAcRecord('<?php echo $fet[0];?>')" /><!--<br/>	<input type="button" value="View Details" onClick="return viwRunDetails('<?php echo $fet[0];?>')" name="details" id="details"  class="btn btn-info" style="width:120px; margin-top:5px;" />							<?php //} else {?>
												<input type="button" value="View Details" name="details" id="details"  class="btn btn-info" onClick="return viwRunDetails('<?php echo $fet[0];?>')" style="width:120px; margin-top:5px;" />-->
												<?php //} ?>
											</td>
									</tr>
							<?php } ?>
							
							
						
					
					
				</table>
			
			</div>
			<div class="col-md-8 col-lg-8 col-xs-12 col-md-offset-1" id="SingleView">
				
			</div>
			
			<div class="col-md-10 col-lg-10 col-xs-12 col-md-offset-1" id="RunAllDeta">
				
			</div>
	 	
	 </form>
	 
	 <script src="../admin/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
<?php } else { print "<script>location='../Admission/Registration/signIN/signIn.php'</script>";}?>

