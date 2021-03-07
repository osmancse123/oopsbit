  <?php
error_reporting(1);
	@session_start();
	if($_SESSION["logstatus"] === "Active")
	{	require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
	date_default_timezone_set("Asia/Dhaka");
	$db = new database();
	
		$clId=$_GET["clID"];
		$gpId=$_GET["gpna"];
		$examId=$_GET["exId"];
		$session=$_GET["session"];
		
			$sqlProjectInfo="SELECT * FROM `project_info`";
			$result_query=$db->select_query($sqlProjectInfo);
			if($result_query){
					$fetch_query=$result_query->fetch_array();
				
			}
	
		$sql_2="SELECT `result`.*,`add_class`.`class_name`,`add_group`.`group_name`,`exam_type_info`.`exam_type` FROM `result`
JOIN `add_class` ON `add_class`.`id`=`result`.`classId` JOIN `add_group` ON `add_group`.`id`=`result`.`GroupID`
JOIN `exam_type_info` ON `exam_type_info`.`exam_id`=`result`.`examId` WHERE `result`.`classId`='$clId' AND `result`.`GroupID`='$gpId' AND `result`.`examId`='$examId' AND `result`.`session`='$session' GROUP BY `result`.`session`";	
	
	//print $sql_2;
		$resultSql=$db->select_query($sql_2);
		if($resultSql){
				$fetchsql=$resultSql->fetch_array();
		}
	?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Show Subject Wise Failed List</title>
<style>
	@media print{
			.noneBtnForprin{
				display:none;
			}
			#dont{
				display:none;
			}
			.dontprint{
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
	<script type="text/javascript" src="../js/vendor/jquery-1.11.3.min.js"></script>
	
    <link href="../css/bootstrap.min.css" rel="stylesheet">
</head>
<style media="print">
.print{display:none;}
</style>
	<body>
  	<form name="teacherinfo" action="" method="post"  enctype="multipart/form-data" class="form-horizontal marksEditEntry" >
            <div class="col-md-10 col-md-offset-1"  style="border:2px #CCCCCC solid; margin-top:10px;">
                <span class="text-justify text-uppercase text-warning" style="font-weight: bold;  font-size: 18px;"><strong style="padding-left:5px"></strong></span><br/>
			
                <table cellpadding="0" cellspacing="0"  class="table table-responsive table-hover " style="margin-top:0px;">					
                			<tr style="border:1px #CCCCCC solid">
									<td align="center"><img src="all_image/logoSDMS2015.png" style="height:80px; padding-left:2px; padding-top:2px;"/></td>
										<td align="center">
												<span class="text-justify text-info" style="font-size:24px;"><strong> <?php echo $fetch_query["institute_name"];?> </strong></span><br/>
								<span class="text-justify text-info" style="font-size:15px; "><strong><?php echo $fetch_query["location"];?> </strong></span><br/>
									<span class="text-justify text-info" style="font-size:20px; "><strong><?php if($resultSql){echo $fetchsql["class_name"];}else{echo "";}?> </strong></span><br/>	
										</td>
										<td></td>
							</tr>
							
							<tr style="border:1px #CCCCCC solid" class="warning">
									<td align="left" ><span class="text-justify text-info" style="font-size:14px; padding-left:5px;"><strong>  Group 	: <?php if($resultSql){ echo $fetchsql["group_name"];}else{echo "";}?></strong></span></td>
									<td align="center"><span class="text-justify text-info" style="font-size:14px;"><strong> Exam Type 	: 	<?php if($resultSql){ echo $fetchsql["exam_type"];}else {echo "";}?> </strong></span></td>
									<td align="right" ><span class="text-justify text-info" style="font-size:14px;"><strong>  	Session 	: 	<?php if($resultSql){ echo $session;}else {echo "";}?> </strong></span></td>
							</tr>
							
							
							<tr class="" style="border:1px #CCCCCC solid">
									<td colspan="3" align="center"><span class="text-justify text-success" style="font-size:18px;"><strong>  Subject Wise Failed  List  </strong></span></td>
							</tr>
						
							<?php
								$sqlSubCount="SELECT * FROM `result`  WHERE `totalFailSub` !='0' AND `classId`='$clId' AND `GroupID`='$gpId' 
								AND `session`='$session' AND `examId`='$examId' GROUP BY `totalFailSub` ORDER BY `totalFailSub` ASC";
							//	print $sqlSubCount;
								
								
								
								$resultSubcount=$db->select_query($sqlSubCount);
								if($resultSubcount){
								
									while($fetchSub=$resultSubcount->fetch_array()){
								
							 ?>
							 
							<tr style="border:1px #CCCCCC solid">
								<td colspan="3"><span class="glyphicon glyphicon-hand-right text-justify text-success" style="font-size:15px;"><strong> <?php echo $fetchSub["totalFailSub"]?>  Subject Failed Student's </strong></span></td>
							</tr>
							<tr style="border:1px #CCCCCC solid">
									<td colspan="3">
									<?php 
											$sqlq="SELECT * FROM `result` WHERE `totalFailSub`='$fetchSub[totalFailSub]'  AND `classId`='$fetchSub[classId]' AND `GroupID`='$fetchSub[GroupID]' AND `session`='$fetchSub[session]' AND `examId`='$fetchSub[examId]' ORDER BY `std_roll` ASC  ";
									//	print $sqlq;
											$result=$db->select_query($sqlq);
											if($result){
											$sl=0;
												while($fetch_wise_sub=$result->fetch_array()){
												$sl++;
									?>
									<strong><span>
									<?php 
									$forName="SELECT `student_personal_info`.`student_name` FROM `student_personal_info` WHERE `id`='$fetch_wise_sub[STD_ID]'";
									$resulName=$db->select_query($forName);if($resulName){$fetch_name=$resulName->fetch_array();}
									
									$forRoll="SELECT * FROM `running_student_info` WHERE `student_id`='$fetch_wise_sub[STD_ID]'  AND `class_id`='$fetchSub[classId]'";
									$resultRoll=$db->select_query($forRoll);
									if($resultRoll){
										$fetch_roll=$resultRoll->fetch_array();
									}
									?>
									
									<div class="col-lg-4 col-md-4 col-sm-4"> <?php echo "<span class='label label-danger label-as-badge'> ".$sl.".</span>&nbsp;". "(&nbsp;".$fetch_roll["class_roll"]."&nbsp) &nbsp".$fetch_name["student_name"]."&nbsp";?> ( <?php  $subsubCod="SELECT `gnerate_marks`.`subjectID`,`add_subject_info`.`subject_code` FROM `gnerate_marks` 
			INNER JOIN `add_subject_info` ON `add_subject_info`.`id`=`gnerate_marks`.`subjectID` WHERE `gnerate_marks`.`studentID`='$fetch_wise_sub[STD_ID]' AND `gradePoint`='0.00' AND `select_subject_type` !='OptionalSubject'  AND `examId`='$fetchSub[examId]'   AND `classId`='$fetchSub[classId]' AND `GroupID`='$fetchSub[GroupID]'"; ?>
				<?php
				
			

 $resultsubcode=$db->select_query($subsubCod);
 $count=$resultsubcode->num_rows;
$mmm=0;
  if($resultsubcode){
      while($fetchsubsubCod= $resultsubcode->fetch_array()){
  $mmm++;
  if($mmm<$count){ echo "<span>".$fetchsubsubCod['subject_code'].",</span>"; }else if($mmm==$count){ echo "<span>".$fetchsubsubCod['subject_code']."</span>";  }
  
  // print $fetchsubsubCod["subject_code"].'&nbsp;,'; 
} }?>)</span> &nbsp; &nbsp;</span></strong></div>
									<?php } } ?>
									</td>
									
							</tr>
						
						
						<?php  } } ?>
						<tr  style="border:1px #CCCCCC solid"> 
							<td colspan="3" align="center" class="dontprint"><input type="submit" name="print" class="btn btn-danger btn-sm print noneBtnForprin" value="Print" onClick="window.print()"/></td>
						</tr>	
							
						
				</table>
					
						
					
							
                </div>
				
				
		
     </form>
 <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>
