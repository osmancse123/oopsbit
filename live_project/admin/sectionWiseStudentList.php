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
	 		function ViwAcRecord(id){
						var idd = id;
						//alert(idd);
				if(idd != "")
					{
							$('#SingleView').show();
							$('#AllView').hide();
							
							$.ajax({
									url  : "selecOldRecord.php",
									type : "POST",
									data : {stID:idd},
									cache: false,
									success:function(data){
										$("#SingleView").html(data);
										//alert(data);
									}
							});
					
					}
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
										ViwAcRecord(StdID);
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
					
					<tr>
							<td colspan="14" align="center">
									<img src="all_image/logoSDMS2015.png" style="height:50px; width:50px; " />
									
									<strong><span style="font-size:22px; font-family:Arial, Helvetica, sans-serif" class="text-success"> <?php
				if(isset($fetchProjectInfo)){
					echo $fetchProjectInfo["institute_name"];
				}else {
					echo "";
				}
			?></span></strong>
			<br/>
			<strong><span style="font-size:16px;" class="text-success"><?php
				if(isset($fetchProjectInfo)){
					echo $fetchProjectInfo["location"];
				}else {
					echo "";
				}
			?></span><br/></strong>
	<strong><span style="font-size:16px;" class="text-success">Student's  List </span></strong>
							</td>
					</tr>
					
					
					<tr>
						<td colspan="14">
						
						<span class="text-justify text-success" style="font-size:16px; padding-left:20px"><strong>
						Class Name &nbsp;: <?php echo " ".$fetch[1];?></strong></span> 
						<span class="text-justify text-success " style="padding-left:400px"><strong>Group Name &nbsp; : <?php echo " ".$fetchg[1]; ?></strong></span>

						<span class="text-justify text-success " style="padding-left:400px"><strong>Section &nbsp; : <?php echo $_GET["sec"]; ?></strong></span>

				
				</td>
						
					</tr>
					
					<?php
							$selec_session="SELECT `running_student_info`.`student_id`,`student_acadamic_information`.`session2` FROM `running_student_info`  INNER JOIN `student_acadamic_information`
ON `student_acadamic_information`.`id`=`running_student_info`.`student_id` WHERE `running_student_info`.`class_id`='$cl' AND 
`running_student_info`.`group_id`='$gp' GROUP BY `student_acadamic_information`.`session2` ORDER BY `student_acadamic_information`.`session2` DESC";
							$rss=$db->select_query($selec_session);
							if($rss)
							{
								while($fss=$rss->fetch_array()){
								
								$total_STd="SELECT `student_acadamic_information`.`session2`,COUNT(`running_student_info`.`student_id`) AS totalstd FROM `running_student_info` 
INNER JOIN `student_acadamic_information` ON `student_acadamic_information`.`id`=`running_student_info`.`student_id`
WHERE `running_student_info`.`class_id`='$cl' AND `running_student_info`.`group_id`='$gp' 
AND `student_acadamic_information`.`session2`='".$fss[1]."'  GROUP BY `running_student_info`.`student_id`";
									$r_T_Std=$db->select_query($total_STd);
									if($r_T_Std){
										$to_Std=$r_T_Std->num_rows;
									}
									else
									{
										$to_Std=0;
									}
									$total_mal_std="SELECT `running_student_info`.`student_id`,`student_personal_info`.`gender`,`student_acadamic_information`.`session2`,COUNT(`running_student_info`.`student_id`) FROM  `running_student_info`
JOIN `student_personal_info` ON `student_personal_info`.`id`=`running_student_info`.`student_id` JOIN `student_acadamic_information`
ON `student_acadamic_information`.`id`=`running_student_info`.`student_id` WHERE `running_student_info`.`class_id`='$cl' AND `running_student_info`.`group_id`='$gp'
AND `student_acadamic_information`.`session2`='".$fss[1]."' AND `student_personal_info`.`gender`='Male' GROUP BY `running_student_info`.`student_id`";
									$r_tm_st=$db->select_query($total_mal_std);
									if($r_tm_st){
										$t_m_s=$r_tm_st->num_rows;
									}
									else
									{
										$t_m_s=0;
									}
									
									$t_fm_Std="SELECT `running_student_info`.`student_id`,`student_personal_info`.`gender`,`student_acadamic_information`.`session2`,COUNT(`running_student_info`.`student_id`) FROM  `running_student_info`
JOIN `student_personal_info` ON `student_personal_info`.`id`=`running_student_info`.`student_id` JOIN `student_acadamic_information`
ON `student_acadamic_information`.`id`=`running_student_info`.`student_id` WHERE `running_student_info`.`class_id`='$cl' AND `running_student_info`.`group_id`='$gp'
AND `student_acadamic_information`.`session2`='".$fss[1]."' AND `student_personal_info`.`gender`='Female' GROUP BY `running_student_info`.`student_id`";
								$r_fm_st=$db->select_query($t_fm_Std);
									if($r_fm_st){
										$t_fm_s=$r_fm_st->num_rows;
									}
									else
									{
										$t_fm_s=0;
									}
								?>
									<!-- <tr>
										<Td colspan="14" align="center"><span class="text-justify text-danger "><strong>Session &nbsp; : <?php echo " ".$fss[1].","; ?></strong></span>
										<span class="text-justify text-danger "><strong>Total Student &nbsp; : <?php echo " ".$to_Std.","; ?></strong></span>
										<span class="text-justify text-danger "><strong> &nbsp;Male&nbsp;:<?php echo $t_m_s;?> &nbsp;, Female: <?php echo $t_fm_s; ?> &nbsp;</strong></span>
										</Td>
									</tr> -->
					<?php
								$resultYearGroup = "SELECT `running_student_info`.*,`student_acadamic_information`.`session2` FROM `running_student_info`
INNER JOIN `student_acadamic_information` ON `student_acadamic_information`.`id`=`running_student_info`.`student_id`
WHERE `student_acadamic_information`.`session2`='$fss[1]' AND  `running_student_info`.`class_id`='$cl' AND `running_student_info`.`group_id`='$gp'  GROUP BY `running_student_info`.`year` ORDER BY `running_student_info`.`year` DESC";
							$resultYGroup  = $db->select_query($resultYearGroup);
								if($resultYGroup->num_rows > 0){
										while($fetchYGroup = $resultYGroup->fetch_array()){
											

										
					
					?>
							<tr>
										<td colspan="14" align="center"> <span class="text-justify text-success">
										<strong>Academic  Year &nbsp; :<?php echo $fetchYGroup['year']; ?></strong></span></td>
									</tr>
					
									<tr align="center" >
										<td width="5%">SL</td>
											<td width="5%">Student ID</td>
											<td width="2%">Roll</td>
											<td width="11%">Name</td>
											<td width="12%">Father Name</td>
											<td width="16%">Mother Name</td>
											<td width="13%">Present Address</td>
										<!-- 	<td width="9%">Permanent  Address</td> -->
											<td width="9%">Mobile NO</td>
											<td width="9%">Gender</td>
											<td width="9%">Religious</td>
											<td width="4%" class="noneBtnForprin">Total Subject</td>
										    <td width="7%">Image</td>
											<td width="21%" class="noneBtnForprin">View Details</td>
									</tr>
							<?php  
								 	    $sql3="SELECT `running_student_info`.`student_id`,`class_roll`,running_student_info.`class_id`,running_student_info.`group_id`,`student_personal_info`.`student_name`,`father_name`,
`religious`,`gender`,										`mother_name`,`student_acadamic_information`.`session2`,`student_address_info`.`present_village`,`present_PO`,`present_post_code`,`present_upazila`,`present_distric`,
`permanent_house_name`,`permanent_village`,`permanent_PO`,`permanent_post_code`,`permanent_upazila`,
`permanent_distric`,`student_guardian_information`.`guardian_contact`
 FROM `running_student_info`
 JOIN `student_personal_info` ON `student_personal_info`.`id`=`running_student_info`.`student_id` JOIN `student_acadamic_information`
 ON `running_student_info`.`student_id`=`student_acadamic_information`.`id` JOIN `student_guardian_information` ON `student_guardian_information`.`id`=`running_student_info`.`student_id`  JOIN `student_address_info` ON `student_address_info`.`id`=`running_student_info`.`student_id` WHERE `running_student_info`.`class_id`='$cl'and `running_student_info`.`section_id`='".$_GET["section"]."' AND 
  `running_student_info`.`group_id`='$gp'
 AND `student_acadamic_information`.`session2`='".$fss[1]."' AND `running_student_info`.`year`='".$fetchYGroup['year']."' ORDER BY `running_student_info`.`class_roll` ASC";
 									$re1=$db->select_query($sql3);
									if($re1){
									$j=0;
									while($fet=$re1->fetch_array()){
										$j++;
									
							?>
										<tr align="center" >
											<td style="height:30px;"><?php echo $j;?></td>
											<td><?php echo $fet[0];?></td>
											<td><?php echo $fet[1];?></td>
											<td><?php echo $fet['student_name'];?></td>
												<td><?php echo $fet['father_name'];?></td>
													<td><?php echo $fet['mother_name'];?></td>
														<td><?php echo $fet['present_village'].','.$fet['present_PO'].','.$fet['present_upazila'].','.$fet['present_distric'];?></td>
														<!-- <td><?php echo $fet['permanent_village'].','.$fet['permanent_PO'].','.$fet['permanent_upazila'].','.$fet['permanent_distric'];?></td> -->
														
															<td><?php echo $fet['guardian_contact'];?></td>
											<?php 
											 	$sql333="SELECT COUNT(`subject_id`) FROM `subject_registration_table` WHERE `std_id`='".$fet[0]."' and `class_id`='".$fet[2]."' and `group_id`='".$fet[3]."'";
												$chek9=$db->select_query($sql333);
												if($chek9){$r333=$chek9->fetch_array();} 
											?>
										<td><?php echo $fet['gender'];?></td><td><?php echo $fet['religious'];?></td>
											<td class="noneBtnForprin"><?php echo $r333[0];?></td>
											
												<td><img src='../other_img/<?php echo $fet[0];?>.jpg' width='70'  height='50'/></td>
												
												
											<td class="noneBtnForprin">
											<?php /*  
													$old_R="SELECT * FROM `student_academic_record` WHERE `student_id`='".$fet[0]."'";
													$old_c=$db->select_query($old_R);
													if($old_c){*/
											?>
												<input type="button" value="View Record" name="record" id="record" class="btn btn-success" style="width:120px" onClick="return ViwAcRecord('<?php echo $fet[0];?>')" />



												<a href="Student_information.php?edit=<?php echo $fet[0];?>" class="btn btn-danger" style='width:120px;' target="_blank"> Edit</a>


												<!--<br/>	<input type="button" value="View Details" onClick="return viwRunDetails('<?php echo $fet[0];?>')" name="details" id="details"  class="btn btn-info" style="width:120px; margin-top:5px;" />							<?php //} else {?>
												<input type="button" value="View Details" name="details" id="details"  class="btn btn-info" onClick="return viwRunDetails('<?php echo $fet[0];?>')" style="width:120px; margin-top:5px;" />-->
												<?php //} ?>
											</td>
									</tr>
							<?php } }?>
									
								<?php 
								
								}
							}
							
							}
								}
					
					?>
						<tr class="noneBtnForprin">
										<td colspan="13" align="center"> <span class="text-justify text-success">

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
