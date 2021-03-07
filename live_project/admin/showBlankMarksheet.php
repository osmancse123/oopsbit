<?php
	error_reporting(1);
	@session_start();
	if($_SESSION["logstatus"] === "Active")
	{

require_once("../db_connect/config.php");
	require_once("../db_connect/conect.php");

	$db = new database();
	$cl = $_GET["clID"];
	$gp =$_GET["gpna"];
	 $session = $_GET["session"];
	$fromroll =$_GET["fromroll"];
	$to = $_GET["to"];
	
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
				<table width="100%" class="table" border="1" cellpadding="0" cellspacing="0" style="margin-top:20px">
					
					
					<tr>
						<td colspan="10" align="center">
						
			<strong><span style="font-size:22px; font-family:Arial, Helvetica, sans-serif" class="text-success"><?php
				if(isset($fetchProjectInfo)){
					echo $fetchProjectInfo["institute_name"];
				}else {
					echo "";
				}
			?></span></strong><br/>
			<strong><span style="font-size:16px;" class="text-success"><?php
				if(isset($fetchProjectInfo)){
					echo $fetchProjectInfo["location"];
				}else {
					echo "";
				}
			?></span>
	
	
		<br/><br/></strong>
		<span style="font-size:16px;" class="text-success">Exam Name  ................................................. </span> &nbsp;&nbsp;&nbsp;
	 <span style="font-size:16px;" class="text-success">Subject Name  ................................................. </span>
	<br/>	<br/>
	<span style="font-size:16px;" class="text-success">Total Cont. Asses  ................ </span> &nbsp;&nbsp;&nbsp;
	 <span style="font-size:16px;" class="text-success">Creative  ...................</span>&nbsp;&nbsp;&nbsp;
	 <span style="font-size:16px;" class="text-success"> MCQ ................ </span> &nbsp;&nbsp;&nbsp;
	 <span style="font-size:16px;" class="text-success">Parctical  ...................</span>
	<br/></strong>
	<strong><span style="font-size:16px;" class="text-success">Marksheet </span></strong>
	
	
	</td>
						
					</tr>
					
					<tr>
						<td colspan="10" align="center">
						<?php
						$sql ="SELECT `running_student_info`.`class_id`,`add_class`.`class_name` FROM `running_student_info` INNER JOIN `add_class`
ON `add_class`.`id`=`running_student_info`.`class_id` WHERE `running_student_info`.`class_id`='$cl' GROUP BY `running_student_info`.`class_id`";
						$re=$db->select_query($sql);
						if($re){
							$fetch=$re->fetch_array();
						}
						$sql2="SELECT `running_student_info`.`group_id`,`add_group`.`group_name` FROM `add_group` INNER JOIN `running_student_info`
ON `running_student_info`.`group_id`=`add_group`.`id` WHERE `running_student_info`.`class_id`='$cl' AND `running_student_info`.`group_id`='$gp'
GROUP BY `running_student_info`.`group_id`";
						$result=$db->select_query($sql2);
						if($result){
							$fetchg=$result->fetch_array();
						}
					?>
					
						<strong>
						Class Name &nbsp;: <?php echo " ".$fetch[1];?></strong>,&nbsp;&nbsp;<strong>Group Name &nbsp; : <?php echo " ".$fetchg[1]; ?></strong>,&nbsp;&nbsp;<strong>Session &nbsp; : <?php echo " ".$session; ?></strong></td>
						
					</tr>
				
							
					
									<tr align="center">
									<td width="5%" align="center">SL NO</td>
											<td width="11%"> &nbsp; &nbsp;  ID</td>
											<td width="6%">&nbsp; &nbsp; Roll</td>
											<td width="32%">&nbsp; &nbsp; Name</td>
											<td width="9%">Cont. Asses.</td>
											<td width="9%">Creative</td>
											<td width="8%">MCQ</td>
											<td width="10%">Parctical</td>
											<td width="10%">Total</td>
											
									</tr>
									
								
								
								<?php
								
										$selectquery = "SELECT `running_student_info`.*,`student_acadamic_information`.`session2`,`student_personal_info`.`student_name` FROM `running_student_info`
INNER JOIN `student_acadamic_information` ON `student_acadamic_information`.`id`=`running_student_info`.`student_id` INNER JOIN 
`student_personal_info` ON `student_personal_info`.`id`=`running_student_info`.`student_id` WHERE `running_student_info`.`class_id`='$cl'
AND `running_student_info`.`group_id`='$gp' AND `student_acadamic_information`.`session2`='$session' limit $fromroll,$to";

$resddddd = $db->select_query($selectquery);
			if($resddddd->num_rows > 0){
			$sl = 0;
					while($fetresddddd = $resddddd->fetch_array()){
					$sl ++;
				
								?>
									<tr  >
									<td align="center"><?php echo $sl;?></td>
											<td>&nbsp; &nbsp;<?php echo $fetresddddd["student_id"];?></td>
											<td>&nbsp; &nbsp;<?php echo $fetresddddd["class_roll"];?></td>
											<td>&nbsp; &nbsp;<?php echo $fetresddddd["student_name"];?></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											
									</tr>
									<?php 	}
			} ?>
									
							
					
						<tr class="noneBtnForprin">
										<td colspan="10" align="center"> <span class="text-justify text-success">
										<input name="button" type="button" class="btn btn-sm btn-danger" onClick="window.print()" value ="PRINT"/></td>
				  </tr>
			  </table>
			
			</div>
			<div class="col-md-8 col-lg-8 col-xs-12 col-md-offset-1" id="SingleView">
				
			</div>
			
			<div class="col-md-10 col-lg-10 col-xs-12 col-md-offset-1" id="RunAllDeta">
				
			</div>
	 	
	 </form>
	 
	 <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>
