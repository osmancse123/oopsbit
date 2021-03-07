<?php
	error_reporting(1);
	@session_start();
	if($_SESSION["logstatus"] === "Active")
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
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <script type="text/javascript" src="textEdit/lib/jquery-1.9.0.min.js"></script>
        <link rel="stylesheet" href="datespicker/datepicker.css">
    <link rel="stylesheet" href="datespicker/bootstrap.min.css">

   
     <script src="datespicker/bootstrap-datepicker.js"></script>
	 <script>
	 		
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
					<?php
						 $sql ="SELECT `exstudentreport`.`ClassId`,`add_class`.`class_name` FROM `exstudentreport` INNER JOIN `add_class`
ON `add_class`.`id`=`exstudentreport`.`ClassId` WHERE `exstudentreport`.`ClassId`='$cl' GROUP BY `exstudentreport`.`ClassId`";
						$re=$db->select_query($sql);
						if($re){
							$fetch=$re->fetch_array();
						}
						 $sql2="SELECT `exstudentreport`.`GroupId`,`add_group`.`group_name` FROM `exstudentreport` INNER JOIN `add_group`
ON `exstudentreport`.`GroupId`=`add_group`.`id` WHERE `exstudentreport`.`ClassId`='$cl' AND `exstudentreport`.`GroupId`='$gp'
GROUP BY `exstudentreport`.`GroupId`";
						$result=$db->select_query($sql2);
						if($result){
							$fetchg=$result->fetch_array();
						}
					?>
					<tr class="noneBtnForprin">
						<td colspan="6"><a href="ViewAllexStudent.php" class="btn btn-sm btn-danger ">BACk</a>
						</td>
						
					</tr>
					<tr>
						<td colspan="6">
						<div align="center" style="margin-left:250px;">
	<div style="float:left; clear:right"><img src="all_image/logoSDMS2015.png" style="height:50px; width:50px; " /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
	<div style="float:left">
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
			?></span><br/></strong>
	<strong><span style="font-size:16px;" class="text-success">Students' List </span></strong></div></div></td>
						
					</tr>
					<tr>
						<td colspan="5">
						
						<span class="text-justify text-success" style="font-size:16px; padding-left:20px"><strong>
						Class Name &nbsp;: <?php echo " ".$fetch[1];?></strong></span> <span class="text-justify text-success " style="padding-left:400px"><strong>Group Name &nbsp; : <?php echo " ".$fetchg[1]; ?></strong></span></td>
						
					</tr>
					
					<?php
							  $selec_session="SELECT * FROM `exstudentreport`  WHERE `exstudentreport`.`ClassId`='$cl' AND 
`exstudentreport`.`GroupId`='$gp' GROUP BY `exstudentreport`.`session` ORDER BY `exstudentreport`.`session` DESC";
							$rss=$db->select_query($selec_session);
							if($rss)
							{
								while($fss=$rss->fetch_array()){
								
								$total_STd="SELECT COUNT(`Id`) AS totalstd FROM `exstudentreport` 
WHERE `exstudentreport`.`ClassId`='$cl' AND `exstudentreport`.`GroupId`='$gp' 
AND `exstudentreport`.`session`='".$fss['session']."'  GROUP BY `exstudentreport`.`Id`";
									$r_T_Std=$db->select_query($total_STd);
									if($r_T_Std){
										$to_Std=$r_T_Std->num_rows;
									}
									else
									{
										$to_Std=0;
									}
								
								?>
									<tr>
										<Td colspan="5" align="center"><span class="text-justify text-danger "><strong>Session &nbsp; : <?php echo " ".$fss[7].","; ?></strong></span>
										<span class="text-justify text-danger "><strong>Total Student &nbsp; : <?php echo " ".$to_Std.","; ?></strong></span>
									
										</Td>
									</tr>
				
							
					
									<tr align="center" >
											<td>Student ID</td>
											<td>Roll</td>
											<td>Name</td>
											<td>Father Name</td>
											<td class="noneBtnForprin">Mother Name</td>
									</tr>
							<?php  
									   $sql3="SELECT * FROM `exstudentreport` WHERE `exstudentreport`.`ClassId`='$cl' AND
  `exstudentreport`.`GroupId`='$gp'
 AND `exstudentreport`.`session`='".$fss['session']."' ORDER BY `exstudentreport`.`classRoll` ASC";
 									$re1=$db->select_query($sql3);
									if($re1){
									
									while($fet=$re1->fetch_array()){
									
							?>
										<tr align="center">
											<td><?php echo $fet[0];?></td>
											<td><?php echo $fet['classRoll'];?></td>
											<td><?php echo $fet['StudentName'];?></td>
											
											<td><?php echo $fet['FatherName'];?></td>
											<td class="noneBtnForprin">
										<?php echo $fet['MotherName'];?>
											</td>
									</tr>
							<?php } }?>
									
								<?php 
								
								}
							}
							
						
					
					?>
						<tr class="noneBtnForprin">
										<td colspan="5" align="center"> <span class="text-justify text-success">
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
