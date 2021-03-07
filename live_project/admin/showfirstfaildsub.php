  <?php
	error_reporting(1);
	@session_start();
	if($_SESSION["logstatus"] === "Active")
	{
	require_once("../db_connect/config.php");
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
JOIN `exam_type_info` ON `exam_type_info`.`exam_id`=`result`.`examId`  WHERE `result`.`classId`='$clId' AND `result`.`GroupID`='$gpId' AND `result`.`session`='$session' AND `result`.`examId`='$examId' GROUP BY `result`.`session`";	
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
    
    <title>Show Result Sheet</title>
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
	<script type="text/javascript" src="../js/vendor/jquery-1.11.3.min.js"></script>
	
    <link href="../css/bootstrap.min.css" rel="stylesheet">
</head>

	<body>
  	<form name="teacherinfo" action="" method="post"  enctype="multipart/form-data" class="form-horizontal marksEditEntry" >
            <div class="col-md-10 col-md-offset-1"  style="border:2px #CCCCCC solid; margin-top:10px;"><br/> <br/>
                <span class="text-justify text-uppercase text-warning" style="font-weight: bold; padding-top: 15px; font-size: 18px;"><strong style="padding-left:5px"></strong></span><br/>
			
                <table cellpadding="0" cellspacing="0"  class="table table-responsive table-hover " style="margin-top:0px;">					
                			<tr style="border:1px #CCCCCC solid">
									<td align="center"><img src="all_image/logoSDMS2015.png" style="height:80px; padding-left:5px; padding-top:2px;"/></td>
										<td align="center" colspan="6">
												<span class="text-justify text-info" style="font-size:24px;"><strong> <?php echo $fetch_query["institute_name"];?> </strong></span><br/>
								<span class="text-justify text-info" style="font-size:15px; "><strong><?php echo $fetch_query["location"];?> </strong></span><br/>
									<span class="text-justify text-info" style="font-size:20px; "><strong><?php if($resultSql){echo $fetchsql["class_name"];}else{echo "";}?> </strong></span><br/>	
										</td>
							</tr>
							
							<tr style="border:1px #CCCCCC solid" class="warning">
									<td align="left" colspan="3"><span class="text-justify text-info" style="font-size:14px; padding-left:5px;"><strong>  Group 	: <?php if($resultSql){ echo $fetchsql["group_name"];}else{echo "";}?></strong></span></td>
									<td align="center" colspan="2"><span class="text-justify text-info" style="font-size:14px;"><strong> Exam Type 	: 	<?php if($resultSql){ echo $fetchsql["exam_type"];}else {echo "";}?> </strong></span></td>
									<td align="right" colspan="2"><span class="text-justify text-info" style="font-size:14px;"><strong>  	Session 	: 	<?php if($resultSql){ echo $session;}else {echo "";}?> </strong></span></td>
							</tr>
							<tr class="" style="border:1px #CCCCCC solid">
									<td colspan="7" align="center"><span class="text-justify text-danger" style="font-size:16px;"><strong>  Subject Wise Pass Failed Sheet </strong></span> </td>
							</tr>
							
							
							<tr align="center">
							<td style="border:1px #999999 solid;">SL NO</td>
								<td style="border:1px #999999 solid;" colspan="3">Subject Name</td>
								<td style="border:1px #999999 solid;">Total   Student</td>
								<td style="border:1px #999999 solid;">Total Pass  Student</td>
								<td style="border:1px #999999 solid;">Total Failded Student</td>
								
								
							</tr>
							
							<?php 
							/*$sql="SELECT COUNT(`STD_ID`) FROM `result`  WHERE `result`.`classId`='$clId' AND `result`.`GroupID`='$gpId' AND `result`.`examId`='$examId'";
							//print $sql;
							$result=$db->select_query($sql);
							if($result)
							{
								$row=$result->fetch_array();
							}
							$rows = $row[0];
							
							$page_rows =20;
							$last = ceil($rows/$page_rows);
							if($last < 1)
							{
								$last = 1;
							}
							$pagenum = 1;
							if(isset($_GET["pn"]))
							{
								
								$pagenum = preg_replace('#[^0-9]#','',$_GET['pn']);
							}
							if($pagenum < 1)
							{
									$pagenum = 1;
							}
							else if($pagenum > $last){
								$pagenum = $last;
								
							}
								$sl =0;
							$limit ='LIMIT '.($pagenum-1) * $page_rows.','.$page_rows;
							$sql1= "SELECT `result`.*,`student_personal_info`.`student_name`,`father_name`,`mother_name`,`student_acadamic_information`.`session2`  FROM `result`
INNER JOIN `student_personal_info` ON `student_personal_info`.`id`=`result`.`STD_ID` INNER JOIN `student_acadamic_information` ON `student_acadamic_information`.`id`=`result`.`STD_ID` WHERE `result`.`classId`='$clId' AND `student_acadamic_information`.`session2`='$session' AND `result`.`GroupID`='$gpId' AND `result`.`examId`='$examId'  ORDER BY `result`.`std_roll` ASC $limit";
							$result1=$db->select_query($sql1);
							$textline1= "Commetee Members(<b>$rows</b>)";
							$textline2="Page<b>$pagenum</b>of<b>$last</b>";
							$pagenationCtrl = '';
							if($last != 1){
								//$pagenationCtrl.= '';
								if($pagenum > 1 )
								{
									$previous = $pagenum-1;
									$pagenationCtrl.= '<li><a href="'.$_SERVER['PHP_SELF'].'?clID='.$clId.'&gpna='.$gpId.'&exId='.$examId.'&session='.$session.'&pn='.$previous.'" class="previous">Previous</a></li> &nbsp;';
										for($i = $pagenum-4;$i < $pagenum; $i++){
											
											if($i > 0){
												
												$pagenationCtrl.= '<li><a href="'.$_SERVER['PHP_SELF'].'?clID='.$clId.'&gpna='.$gpId.'&exId='.$examId.'&session='.$session.'&pn='.$i.'" class="pagination">'.$i.'</a> </li>&nbsp;';
											}
											
										}
										
								}
								$pagenationCtrl.=''.$pagenum.'&nbsp;';
									for($i = $pagenum+1;$i <= $last; $i++){
											$pagenationCtrl.= '<li><a href="'.$_SERVER['PHP_SELF'].'?clID='.$clId.'&gpna='.$gpId.'&exId='.$examId.'&session='.$session.'&pn='.$i.'" class="pagination">'.$i.'</a> </li>&nbsp;';
											if($i >= $pagenum+4){
												
												break;
											}
											
										}
										if($pagenum != $last)
										{
											$next=$pagenum+1;
											$pagenationCtrl.='&nbsp; &nbsp;<li><a href="'.$_SERVER['PHP_SELF'].'?clID='.$clId.'&gpna='.$gpId.'&exId='.$examId.'&session='.$session.'&pn='.$next.'" class="next">Next</a></li>';
										}
										//$pagenationCtrl.="</ul>";
							}	*/			
							
						
						
						
						

						$sql1= "SELECT `result`.*,`gnerate_marks`.`subjectID`,`add_subject_info`.`subject_name`,`subject_code` FROM `result`
INNER JOIN `gnerate_marks` ON `gnerate_marks`.`studentID` = `result`.`STD_ID` INNER JOIN `add_subject_info`
ON `add_subject_info`.`id`=`gnerate_marks`.`subjectID` WHERE `result`.`classId`='$clId' AND `result`.`GroupID`='$gpId'
AND `result`.`session`='$session' AND `result`.`examId`='$examId'
 GROUP BY `gnerate_marks`.`subjectID`  ORDER BY `add_subject_info`.`serial` ASC";
							$result1=$db->select_query($sql1);
							if($result1){
						
								while($fetchAll=$result1->fetch_array()){
								$sl++;
							?>
							
							<tr  class="">
								<td align="center"  style="border:1px #999999 solid;"><?php echo $sl; ?></td>
								<td style="border:1px #999999 solid;" colspan="3" style="padding-left:20px;">&nbsp;&nbsp;<?php echo $fetchAll['subject_name']."(&nbsp;".$fetchAll['subject_code']."&nbsp;)" ;?></td>
								<td style="border:1px #999999 solid;" align="center">
								
								<?php
								
								
										$taotastd = "SELECT COUNT(`studentID`) FROM `gnerate_marks` WHERE `ClassID`='$clId' AND `GroupID`='$gpId' AND `ExamID`='$examId' AND `session`='$session' AND `subjectID`='".$fetchAll["subjectID"]."'";
										$resulttotalstd = $db->select_query($taotastd);
											if($resulttotalstd){
													$fetchtotalstd = $resulttotalstd->fetch_array();
													echo $fetchtotalstd[0];
											}
								?>
								</td>
								<td style="border:1px #999999 solid;" align="center">	<?php
								
								
										$totapassstd = "SELECT COUNT(`studentID`) FROM `gnerate_marks` WHERE `ClassID`='$clId' AND `GroupID`='$gpId' AND `ExamID`='$examId' AND `session`='$session' AND `subjectID`='".$fetchAll["subjectID"]."' and gradePoint != '0.00'";
										$resutlpassstd = $db->select_query($totapassstd);
											if($resutlpassstd){
													$fetchpassstd = $resutlpassstd->fetch_array();
													echo $fetchpassstd[0];
											}
								?></td>
								<td style="border:1px #999999 solid;" align="center">	<?php
								
								
										$totafalistd = "SELECT COUNT(`studentID`) FROM `gnerate_marks` WHERE `ClassID`='$clId' AND `GroupID`='$gpId' AND `ExamID`='$examId' AND `session`='$session' AND `subjectID`='".$fetchAll["subjectID"]."'  and gradePoint = '0.00'";
										$resutlfialstd = $db->select_query($totafalistd);
											if($resutlfialstd){
													$fetchfailstd = $resutlfialstd->fetch_array();
													echo $fetchfailstd[0];
											}
								?></td>
								
							</tr>
							
							<?php  }  } ?>
							
							<tr  class="active " style="border:1px #CCCCCC solid">
									<td colspan="7" align="center" class="dontPrint"><input type="button" name="print" id="print" value="Print"  onClick="window.print()" class="btn btn-danger btn-sm noneBtnForprin"/> </td>
							</tr>
				</table>
					
						<ul class="pager not" >
						<?php echo $pagenationCtrl;?>
						</ul>
					
							
                </div>
				
				
		
     </form>
 <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>
