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
	$Session=$_GET["session"];
	$studentRoll=$_GET["stdRoll"];
			$select_school="select * from project_info";
$cheke_school=$db->select_query($select_school);
if($cheke_school)
{
$fetch_school_information=$cheke_school->fetch_array();
}
	$sql="SELECT `result`.*,`student_personal_info`.`student_name`,`father_name`,`mother_name`,`add_class`.`class_name`,`add_group`.`group_name` FROM `result`  JOIN `student_personal_info`
ON `student_personal_info`.`id`=`result`.`STD_ID` JOIN `add_class` ON `add_class`.`id`=`result`.`classId` JOIN `add_group` ON `add_group`.`id`=`result`.`GroupID`
WHERE `result`.`classId`='$clId' AND `result`.`GroupID`='$gpId' AND `result`.`examId`='$examId' AND `result`.`session`='$Session' AND `result`.`std_roll`='$studentRoll'";
	//print $sql;
	$result=$db->select_query($sql);
	if($result){
			$fetch_r=$result->fetch_array();
	}
	
	
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Tebulation Sheet </title>
	<link rel="shortcut icon" href="all_image/logoSDMS2015.png" />

	<script type="text/javascript" src="../js/vendor/jquery-1.11.3.min.js"></script>
	
    <link href="../css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
	@media print{
			.noneBtnForprin{
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

	<body>
  	<form name="teacherinfo" action="" method="post"  enctype="multipart/form-data" class="form-horizontal marksEditEntry" >
				<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 col-lg-offset-1 col-md-offset-1" style="margin-top:30px;">
				
						<table class="table table-responsive" style="border:2px #000000 solid">
							<tr style="border:1px #000000 solid" >
											 <td width="64" style="border-right:1px #FFFFFF solid;"> 	 <img src="all_image/logoSDMS2015.png"  style="height:50px; width:50px; margin-top:2px; margin-bottom:2px; margin-left:5px"/><span  style="font-size:18px;"> </td>
											  <td width="390" colspan="3" align="center">
											<span style="font-size:22px;"> <?php print $fetch_school_information['institute_name'] ?></span>
												 <br/>
												 <span style="font-size:18px; "> <?php print $fetch_school_information['location'] ?></span>
												
												 <span><strong style="font-size:18px;"><br/><?php
					  	$examName = "SELECT `exam_type` FROM `exam_type_info` WHERE `exam_id`='".$fetch_r["examId"]."'";
						$resultName = $db->select_query($examName);
							if($resultName->num_rows > 0){
								$fetchName = $resultName->fetch_array();
								
							}
							$selectSession="SELECT `session2` FROM `student_acadamic_information` WHERE `id`='".$fetch_r["STD_ID"]."'";
							$ressss = $db->select_query($selectSession);
							if($ressss->num_rows > 0){
								$fetchsss = $ressss->fetch_array();
								
							}
							echo $fetchName[0].'-'.$fetchsss[0]
					  ?></strong> </span>
							  &nbsp;</td>
							  </tr>
						</table>
						<table width="100%" cellpadding="0" cellspacing="0"  class=" table-responsive" style="border-left:2px #000000 solid;border-right:2px #000000 solid;border-bottom:0px #000000 solid; margin-top:-20px;">
							<tr>
								<td width="64%"></td>
								<td width="18%" align="right"><span><strong>MPO </strong></span></td>
								<td width="4%" align="right"><span><strong>:&nbsp; </strong></span></td>
								<td width="14%"><span><strong><?php  if(isset($fetch_school_information)){echo $fetch_school_information["collegeCode"];} else {echo "";}?></strong></span></td>
								
							</tr>
							<tr>
								<td width="64%"></td>
								<td width="18%" align="right"><span><strong>EIIN No  </strong></span></td>
								<td width="4%" align="right"><span><strong>:&nbsp; </strong></span></td>
								<td width="14%"><span><strong><?php  if(isset($fetch_school_information)){echo $fetch_school_information["Einncode"];} else {echo "";}?> </strong></span></td>
								
							</tr>
							
				  </table>
				  <table width="100%" cellpadding="0" cellspacing="0"  class=" table-responsive" style="border-left:2px #000000 solid;border-right:2px #000000 solid; border-bottom:2px #000000 solid; margin-top:-10px;">
							
							<tr>
								<td width="15%" align="right"><span><strong>Student ID &nbsp; :  </strong></span></td>
								<td width="85%" colspan="3"><span><strong> <?php
										if(isset($fetch_r)){ echo $fetch_r["STD_ID"];} else {echo "";}
									?>
								 </strong></span></td>
								
							</tr>
				  </table>
				  <div   class="table-responsive" style="border-left:2px #000000 solid;border-right:2px #000000 solid; border-bottom:2px #000000 solid; margin-top:0px;">
				  	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							<table  width="100%" cellpadding="0" cellspacing="0"  class=" table-responsive" style="">
								  <tr>
									<td width="251" height="29">&nbsp;<span><strong>Class Name &nbsp;   </strong></span></td>
									<td width="37"  height="29">&nbsp;:</td>
									<td width="503"  height="29">&nbsp;<span><strong> <?php
										if(isset($fetch_r)){ echo $fetch_r["class_name"];} else {echo "";}
									?>   </strong></span></td>
								  </tr>
								 <tr>
									<td width="251"  height="24">&nbsp;<span><strong>Group Name &nbsp;   </strong></span></td>
									<td width="37"  height="24">&nbsp;:</td>
									<td width="503"  height="24">&nbsp;<span><strong> <?php
										if(isset($fetch_r)){ echo $fetch_r["group_name"];} else {echo "";}
									?>   </strong></span></td>
							  </tr>
								  <tr>
									<td width="251"  height="26">&nbsp;<span><strong>Student's  Name &nbsp;  </strong></span></td>
									<td width="37"  height="26">&nbsp;:</td>
									<td width="503"  height="26">&nbsp;<span><strong> <?php
										if(isset($fetch_r)){ echo $fetch_r["student_name"];} else {echo "";}
									?>   </strong></span></td>
								  </tr>
								  <tr>
									<td width="251"  height="26">&nbsp;<span><strong>Father's Name &nbsp;  </strong></span></td>
									<td width="37"  height="26"> &nbsp;:</td>
									<td width="503"  height="26">&nbsp;<span><strong> <?php
										if(isset($fetch_r)){ echo $fetch_r["father_name"];} else {echo "";}
									?>   </strong></span></td>
								  </tr>
								  
								  <tr>
									<td width="251"  height="25">&nbsp;<span><strong>Mother's Name &nbsp;  </strong></span></td>
									<td width="37"  height="25"> &nbsp;:</td>
									<td width="503"  height="25">&nbsp;<span><strong> <?php
										if(isset($fetch_r)){ echo $fetch_r["mother_name"];} else {echo "";}
									?>   </strong></span></td>
								  </tr>
								  <tr>
									<td width="251"  height="24">&nbsp;<span><strong>Roll No &nbsp;  </strong></span></td>
									<td width="37"  height="24"> &nbsp;:</td>
									<td width="503"  height="24">&nbsp;<span><strong> <?php
										if(isset($fetch_r)){ echo $fetch_r["std_roll"];} else {echo "";}
									?>   </strong></span></td>
								  </tr>
								  <tr>
									<td width="251"  height="30">&nbsp;<span><strong>Session &nbsp;  </strong></span></td>
									<td width="37"  height="30"> &nbsp;:</td>
									<td width="503"  height="30">&nbsp;<span><strong> <?php
										if(isset($fetch_r)){ echo $fetch_r["session"];} else {echo "";}
									?>   </strong></span></td>
								  </tr>
								  
								   <tr>
									<td width="251"  height="30">&nbsp;<span><strong>Result &nbsp;  </strong></span></td>
									<td width="37"  height="30"> &nbsp;:</td>
									<td width="503"  height="30">&nbsp;<span><strong>  	<?php if(isset($fetch_r)){ 
														if($fetch_r["CGPA"] == "0.00" ){?>
														<span><strong  class="text-danger">FAILED</strong></span>
														<?php } else {?>
														<span><strong  class="text-success">PASSED</strong></span>
														<?php }
													}?>
													  </strong></span></td>
								  </tr>
								  
								  
								 
								</table>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
								<table  width="90%" cellpadding="0" cellspacing="0" border="1" style="margin-top:20px;">
								  <tr>
									<td width="63" height="30" align="center">&nbsp; <span class="text-warning"><strong>CA&nbsp;   </strong></span></td>
									<td width="53"  height="30" align="center"><strong class="text-warning">=</strong></td>
									<td width="234"  height="30" align="left"><strong class="text-warning">Cont. Asses.</strong></td>
								  </tr>
								  <tr>
									<td width="63" height="30" align="center">&nbsp; <span class="text-warning"><strong>CT&nbsp;   </strong></span></td>
									<td width="53"  height="30" align="center"><strong class="text-warning">=</strong></td>
									<td width="234"  height="30" align="left"><strong class="text-warning">Creative</strong></td>
								  </tr>
								  <tr>
									<td width="63" height="30" align="center">&nbsp; <span class="text-warning"><strong>MC&nbsp;   </strong></span></td>
									<td width="53"  height="30" align="center"><strong class="text-warning">=</strong></td>
									<td width="234"  height="30" align="left"><strong class="text-warning">MCQ</strong></td>
								  </tr>

								 <tr>
									<td width="63" height="30" align="center">&nbsp; <span class="text-warning"><strong>PT&nbsp;   </strong></span></td>
									<td width="53"  height="30" align="center"><strong class="text-warning">=</strong></td>
									<td width="234"  height="30" align="left"><strong class="text-warning">Parctical</strong></td>
								  </tr>
								
					  </table>
					</div>
				  	
				  </div>
				  	<div   class="table-responsive" style="border-left:2px #000000 solid;border-right:2px #000000 solid; border-bottom:2px #000000 solid; margin-top:0px;">
							<table class="table-responsive" width="100%" border="1" cellpadding="0" cellspacing="0">
									<tr align="center">
									
										<td width="7%">Sub Code</td>
										<td width="32%">Subject Name</td>
										<td width="7%">Full Marks</td
										>
										<td width="5%">CA</td>
										<td width="4%">CT</td>
										<td width="5%">MC</td>
										<td width="5%">PT</td>
										<td width="9%">Obtain Marks</td>
										<td width="9%">Letter Grade</td>
										<td width="10%">Grade Point</td>
										
										<td width="7%">GPA</td>
									</tr>
									<?php
									
									$sqlcount1="SELECT `marksheet`.*,`add_subject_info`.`select_subject_type` FROM `marksheet` 
INNER JOIN `add_subject_info` ON `add_subject_info`.`id`=`marksheet`.`SubjectId` WHERE `STudentID`='".$fetch_r["STD_ID"]."'
AND `add_subject_info`.`select_subject_type`='GroupSubject' AND `marksheet`.`ExamId`='$examId' AND `marksheet`.`Session`='$Session' AND `marksheet`.`ClassId`='$clId' AND `marksheet`.`GroupID`='$gpId' ORDER BY `add_subject_info`.`serial` ASC" ;
											$resultCount1=$db->select_query($sqlcount1);
								
											$c1 = $resultCount1->num_rows;
											
											
											
											 $sqlCount2="SELECT `marksheet`.*,`add_subject_info`.`select_subject_type` FROM `marksheet` 
INNER JOIN `add_subject_info` ON `add_subject_info`.`id`=`marksheet`.`SubjectId` WHERE `STudentID`='".$fetch_r["STD_ID"]."'
AND `add_subject_info`.`select_subject_type`='OptionalSubject' AND `marksheet`.`ExamId`='$examId' AND `marksheet`.`Session`='$Session' AND `marksheet`.`ClassId`='$clId' AND `marksheet`.`GroupID`='$gpId' ORDER BY `add_subject_info`.`serial` ASC" ;
											$resultCount2=$db->select_query($sqlCount2);
										
											$c2 = $resultCount2->num_rows;
											
											
											
									
											  $sqlforAll="SELECT `marksheet`.*,`add_subject_info`.`select_subject_type` FROM `marksheet` 
INNER JOIN `add_subject_info` ON `add_subject_info`.`id`=`marksheet`.`SubjectId` WHERE `STudentID`='".$fetch_r["STD_ID"]."'
AND `add_subject_info`.`select_subject_type`='CompulsorySubject' AND `marksheet`.`ExamId`='$examId' AND `marksheet`.`Session`='$Session' AND `marksheet`.`ClassId`='$clId' AND `marksheet`.`GroupID`='$gpId' ORDER BY `add_subject_info`.`serial` ASC" ;
											$resultForAll=$db->select_query($sqlforAll);
											if($resultForAll) {
											 $countt = $resultForAll->num_rows;
											  $total = $c1+$c2+$countt;
											$sl=0;
											$c = 0;
												while($fetchForall=$resultForAll->fetch_array()){
													//print_r($fetchForall);
											$sl++;
											if($c == 0){
									?>
											<tr align="">
												
												<?php
													if($fetchForall["SubjectPartID"]=="NULL"){
															$selectForsubject="SELECT * FROM `add_subject_info` WHERE `id`='".$fetchForall["SubjectId"]."' AND `exam_type`='$examId'";
															$resultForSub=$db->select_query($selectForsubject);
																//print "dd"."<br/>";
																if($resultForSub){
															$fetchForSub=$resultForSub->fetch_array();}
															//print_r($fetchForSub)."<br/>";
															
															$fetchforPar["subject_part_code"]="";
															$fetchforPar["subject_part_name"]="";
														}
														else {
															$selectForpart="SELECT * FROM `add_subject_part_info` WHERE `part_id`='".$fetchForall["SubjectPartID"]."' AND `exam_type`='$examId'";
															$resultForPart=$db->select_query($selectForpart);
															if($resultForPart){
															$fetchforPar=$resultForPart->fetch_array();}
															//print_r($fetchforPar);
															$fetchForSub["subject_code"]="";
															$fetchForSub["subject_name"]="";
															 $total = $c1+$c2+$countt+1;
														}	
														
																
												?>
												<td width="7%" align="center"><?php if(isset($fetchForSub)){ echo $fetchForSub["subject_code"];} else {echo "";}?><?php if(isset($fetchforPar)){ echo $fetchforPar["subject_part_code"];} else {echo "";}?></td>
												<td width="32%" align="left"><span style="padding-left:5px;"><?php if(isset($fetchForSub)){ echo $fetchForSub["subject_name"];} else {echo "";}?><?php if(isset($fetchforPar)){ echo $fetchforPar["subject_part_name"];} else {echo "";}?></span></td>
												
												<?php 
														if($fetchForall["SubjectPartID"]=="NULL"){
														
														$selecBysub="SELECT * FROM `subject_information` WHERE `subjectId`='".$fetchForall["SubjectId"]."' AND examID='$examId'";
														$resulBysub=$db->select_query($selecBysub);
															if($resulBysub){
																$fetchBySub=$resulBysub->fetch_array();
															}
															$fetcByPart["total"]="";
														}else {
															$selecBYpart="SELECT * FROM `subject_information` WHERE `subPartId`='".$fetchForall["SubjectPartID"]."' AND examID='$examId'";
																$resulByPart=$db->select_query($selecBYpart);
																	if($resulByPart)
																	{
																		$fetcByPart=$resulByPart->fetch_array();
																	}
																	$fetchBySub["total"]="";
														}
												?>
												<td width="7%" align="center"><?php if(isset($fetchBySub)){ echo $fetchBySub["total"];} else {echo "";}?><?php if(isset($fetcByPart)){ echo $fetcByPart["total"];} else {echo "";}?></td
												>
												<td width="5%" align="center"><?php echo $fetchForall["Count_Ass"];?></td>
												<td width="4%" align="center"><?php echo $fetchForall["Creative"];?></td>
												<td width="5%" align="center"><?php echo $fetchForall["Mcq"];?></td>
												<td width="5%" align="center"><?php echo $fetchForall["Practical"];?></td>
												<td width="9%"  align="center"><?php echo $fetchForall["obtainMark"];?></td>
												<td width="9%" align="center"><?php echo $fetchForall["LetterGrade"];?></td>
												<td width="10%" align="center"><?php echo $fetchForall["GradePoint"];?></td>
												
												<td width="7%" align="center" rowspan="<?php echo $total+1;?>"><?php echo $fetch_r["CGPA"];?></td>
											</tr>
											<?php } else {
												if($fetchForall["SubjectPartID"]=="NULL"){
															$selectForsubject="SELECT * FROM `add_subject_info` WHERE `id`='".$fetchForall["SubjectId"]."'";
															$resultForSub=$db->select_query($selectForsubject);
																//print "dd"."<br/>";
																if($resultForSub){
															$fetchForSub=$resultForSub->fetch_array();}
															//print_r($fetchForSub)."<br/>";
															$fetchforPar["subject_part_code"]="";
															$fetchforPar["subject_part_name"]="";
														}
														else {
															$selectForpart="SELECT * FROM `add_subject_part_info` WHERE `part_id`='".$fetchForall["SubjectPartID"]."' AND `exam_type`='$examId'";
															$resultForPart=$db->select_query($selectForpart);
															if($resultForPart){
															$fetchforPar=$resultForPart->fetch_array();}
															
															$fetchForSub["subject_code"]="";
															$fetchForSub["subject_name"]="";
															//print_r($fetchforPar);
														}
											?>
												<tr align="">
												
												<td width="7%" align="center"><?php if(isset($fetchForSub)){ echo $fetchForSub["subject_code"];} else {echo "";}?><?php if(isset($fetchforPar)){ echo $fetchforPar["subject_part_code"];} else {echo "";}?></td>
												<td width="32%" align="left"><span style="padding-left:5px;"><?php if(isset($fetchForSub)){ echo $fetchForSub["subject_name"];} else {echo "";}?><?php if(isset($fetchforPar)){ echo $fetchforPar["subject_part_name"];} else {echo "";}?></span></td>
												<?php
													if($fetchForall["SubjectPartID"]=="NULL"){
														
														$selecBysub="SELECT * FROM `subject_information` WHERE `subjectId`='".$fetchForall["SubjectId"]."' AND examID='$examId'";
														$resulBysub=$db->select_query($selecBysub);
															if($resulBysub){
																$fetchBySub=$resulBysub->fetch_array();
															}
															$fetcByPart["total"]="";
														}else {
															$selecBYpart="SELECT * FROM `subject_information` WHERE `subPartId`='".$fetchForall["SubjectPartID"]."' AND examID='$examId'";
																$resulByPart=$db->select_query($selecBYpart);
																	if($resulByPart)
																	{
																		$fetcByPart=$resulByPart->fetch_array();
																	}
																	$fetchBySub["total"]="";
														}
												?>
												<td width="7%" align="center"><?php if(isset($fetchBySub)){ echo $fetchBySub["total"];} else {echo "";}?><?php if(isset($fetcByPart)){ echo $fetcByPart["total"];} else {echo "";}?></td
												>
												<td width="5%" align="center"><?php echo $fetchForall["Count_Ass"];?></td>
												<td width="4%" align="center"><?php echo $fetchForall["Creative"];?></td>
												<td width="5%" align="center"><?php echo $fetchForall["Mcq"];?></td>
												<td width="5%" align="center"><?php echo $fetchForall["Practical"];?></td>
												
												<td width="9%"  align="center"><?php echo $fetchForall["obtainMark"];?></td>
												<td width="9%" align="center"><?php echo $fetchForall["LetterGrade"];?></td>
												<td width="10%" align="center"><?php echo $fetchForall["GradePoint"];?></td>
												
											</tr>
									<?php }$c++; }  } ?>
									
									<?php
									
											 $sqlforAlls="SELECT `marksheet`.*,`add_subject_info`.`select_subject_type` FROM `marksheet` 
INNER JOIN `add_subject_info` ON `add_subject_info`.`id`=`marksheet`.`SubjectId` WHERE `STudentID`='".$fetch_r["STD_ID"]."'
AND `add_subject_info`.`select_subject_type`='GroupSubject' AND `marksheet`.`ExamId`='$examId' AND `marksheet`.`Session`='$Session' AND `marksheet`.`ClassId`='$clId' AND `marksheet`.`GroupID`='$gpId' ORDER BY `add_subject_info`.`serial` ASC" ;
											$resultForAll=$db->select_query($sqlforAlls);
											if($resultForAll) {
											$counttt = $resultForAll->num_rows;
											$sl=0;
											$c = 0;
												while($fetchForall=$resultForAll->fetch_array()){
													//print_r($fetchForall);
											$sl++;
											if($c == 0){
									?>
											<tr align="">
												
												<?php
													if($fetchForall["SubjectPartID"]=="NULL"){
															$selectForsubject="SELECT * FROM `add_subject_info` WHERE `id`='".$fetchForall["SubjectId"]."'";
															$resultForSub=$db->select_query($selectForsubject);
																//print "dd"."<br/>";
																if($resultForSub){
															$fetchForSub=$resultForSub->fetch_array();}
															//print_r($fetchForSub)."<br/>";
															$fetchforPar["subject_part_code"]="";
															$fetchforPar["subject_part_name"]="";
														}
														else {
															$selectForpart="SELECT * FROM `add_subject_part_info` WHERE `part_id`='".$fetchForall["SubjectPartID"]."'  AND `exam_type`='$examId'";
															$resultForPart=$db->select_query($selectForpart);
															if($resultForPart){
															$fetchforPar=$resultForPart->fetch_array();}
															//print_r($fetchforPar);
															$fetchForSub["subject_code"]="";
															$fetchForSub["subject_name"]="";
														}	
														
																
												?>
												<td width="7%" align="center"><?php if(isset($fetchForSub)){ echo $fetchForSub["subject_code"];} else {echo "";}?><?php if(isset($fetchforPar)){ echo $fetchforPar["subject_part_code"];} else {echo "";}?></td>
												<td width="32%" align="left"><span style="padding-left:5px;"><?php if(isset($fetchForSub)){ echo $fetchForSub["subject_name"];} else {echo "";}?><?php if(isset($fetchforPar)){ echo $fetchforPar["subject_part_name"];} else {echo "";}?></span></td>
												
												<?php 
														if($fetchForall["SubjectPartID"]=="NULL"){
														
														$selecBysub="SELECT * FROM `subject_information` WHERE `subjectId`='".$fetchForall["SubjectId"]."' AND examID='$examId'";
														$resulBysub=$db->select_query($selecBysub);
															if($resulBysub){
																$fetchBySub=$resulBysub->fetch_array();
															}
															$fetcByPart["total"]="";
														}else {
															$selecBYpart="SELECT * FROM `subject_information` WHERE `subPartId`='".$fetchForall["SubjectPartID"]."' AND examID='$examId'";
																$resulByPart=$db->select_query($selecBYpart);
																	if($resulByPart)
																	{
																		$fetcByPart=$resulByPart->fetch_array();
																	}
																	$fetchBySub["total"]="";
														}
												?>
												<td width="7%" align="center"><?php if(isset($fetchBySub)){ echo $fetchBySub["total"];} else {echo "";}?><?php if(isset($fetcByPart)){ echo $fetcByPart["total"];} else {echo "";}?></td
												>
												<td width="5%" align="center"><?php echo $fetchForall["Count_Ass"];?></td>
												<td width="4%" align="center"><?php echo $fetchForall["Creative"];?></td>
												<td width="5%" align="center"><?php echo $fetchForall["Mcq"];?></td>
												<td width="5%" align="center"><?php echo $fetchForall["Practical"];?></td>
												<td width="9%"  align="center"><?php echo $fetchForall["obtainMark"];?></td>
												<td width="9%" align="center"><?php echo $fetchForall["LetterGrade"];?></td>
												<td width="10%" align="center"><?php echo $fetchForall["GradePoint"];?></td>
												
											</tr>
											<?php } else {
												if($fetchForall["SubjectPartID"]=="NULL"){
															$selectForsubject="SELECT * FROM `add_subject_info` WHERE `id`='".$fetchForall["SubjectId"]."'";
															$resultForSub=$db->select_query($selectForsubject);
																//print "dd"."<br/>";
																if($resultForSub){
															$fetchForSub=$resultForSub->fetch_array();}
															//print_r($fetchForSub)."<br/>";
															$fetchforPar["subject_part_code"]="";
															$fetchforPar["subject_part_name"]="";
														}
														else {
															$selectForpart="SELECT * FROM `add_subject_part_info` WHERE `part_id`='".$fetchForall["SubjectPartID"]."'  AND `exam_type`='$examId'";
															$resultForPart=$db->select_query($selectForpart);
															if($resultForPart){
															$fetchforPar=$resultForPart->fetch_array();}
															
															$fetchForSub["subject_code"]="";
															$fetchForSub["subject_name"]="";
															//print_r($fetchforPar);
														}
											?>
												<tr align="">
												
												<td width="7%" align="center"><?php if(isset($fetchForSub)){ echo $fetchForSub["subject_code"];} else {echo "";}?><?php if(isset($fetchforPar)){ echo $fetchforPar["subject_part_code"];} else {echo "";}?></td>
												<td width="32%" align="left"><span style="padding-left:5px;"><?php if(isset($fetchForSub)){ echo $fetchForSub["subject_name"];} else {echo "";}?><?php if(isset($fetchforPar)){ echo $fetchforPar["subject_part_name"];} else {echo "";}?></span></td>
												<?php
													if($fetchForall["SubjectPartID"]=="NULL"){
														
														$selecBysub="SELECT * FROM `subject_information` WHERE `subjectId`='".$fetchForall["SubjectId"]."' AND examID='$examId'";
														$resulBysub=$db->select_query($selecBysub);
															if($resulBysub){
																$fetchBySub=$resulBysub->fetch_array();
															}
															$fetcByPart["total"]="";
														}else {
															$selecBYpart="SELECT * FROM `subject_information` WHERE `subPartId`='".$fetchForall["SubjectPartID"]."' AND examID='$examId'";
																$resulByPart=$db->select_query($selecBYpart);
																	if($resulByPart)
																	{
																		$fetcByPart=$resulByPart->fetch_array();
																	}
																	$fetchBySub["total"]="";
														}
												?>
												<td width="7%" align="center"><?php if(isset($fetchBySub)){ echo $fetchBySub["total"];} else {echo "";}?><?php if(isset($fetcByPart)){ echo $fetcByPart["total"];} else {echo "";}?></td
												>
												<td width="5%" align="center"><?php echo $fetchForall["Count_Ass"];?></td>
												<td width="4%" align="center"><?php echo $fetchForall["Creative"];?></td>
												<td width="5%" align="center"><?php echo $fetchForall["Mcq"];?></td>
												<td width="5%" align="center"><?php echo $fetchForall["Practical"];?></td>
												
												<td width="9%"  align="center"><?php echo $fetchForall["obtainMark"];?></td>
												<td width="9%" align="center"><?php echo $fetchForall["LetterGrade"];?></td>
												<td width="10%" align="center"><?php echo $fetchForall["GradePoint"];?></td>
												
											</tr>
									<?php }$c++; }  } ?>
									<tr>
									
										<?php
									
											 $sqlforAllss="SELECT `marksheet`.*,`add_subject_info`.`select_subject_type` FROM `marksheet` 
INNER JOIN `add_subject_info` ON `add_subject_info`.`id`=`marksheet`.`SubjectId` WHERE `STudentID`='".$fetch_r["STD_ID"]."'
AND `add_subject_info`.`select_subject_type`='OptionalSubject' AND `marksheet`.`ExamId`='$examId' AND `marksheet`.`Session`='$Session' AND `marksheet`.`ClassId`='$clId' AND `marksheet`.`GroupID`='$gpId' ORDER BY `add_subject_info`.`serial` ASC" ;
											$resultForAll=$db->select_query($sqlforAllss);
											if($resultForAll) {
											$counttt = $resultForAll->num_rows;
											  $totalCount = $count+$countt+$counttt;
											$sl=0;
											$c = 0;
												while($fetchForall=$resultForAll->fetch_array()){
													//print_r($fetchForall);
											$sl++;
											if($c == 0){
									?>
											<tr align="">
												
												<?php
													if($fetchForall["SubjectPartID"]=="NULL"){
															$selectForsubject="SELECT * FROM `add_subject_info` WHERE `id`='".$fetchForall["SubjectId"]."'";
															$resultForSub=$db->select_query($selectForsubject);
																//print "dd"."<br/>";
																if($resultForSub){
															$fetchForSub=$resultForSub->fetch_array();}
															//print_r($fetchForSub)."<br/>";
															$fetchforPar["subject_part_code"]="";
															$fetchforPar["subject_part_name"]="";
														}
														else {
															$selectForpart="SELECT * FROM `add_subject_part_info` WHERE `part_id`='".$fetchForall["SubjectPartID"]."'  AND `exam_type`='$examId'";
															$resultForPart=$db->select_query($selectForpart);
															if($resultForPart){
															$fetchforPar=$resultForPart->fetch_array();}
															//print_r($fetchforPar);
															$fetchForSub["subject_code"]="";
															$fetchForSub["subject_name"]="";
														}	
														
																
												?>
												<td width="7%" align="center"><?php if(isset($fetchForSub)){ echo $fetchForSub["subject_code"];} else {echo "";}?><?php if(isset($fetchforPar)){ echo $fetchforPar["subject_part_code"];} else {echo "";}?></td>
												<td width="32%" align="left"><span style="padding-left:5px;"><?php if(isset($fetchForSub)){ echo $fetchForSub["subject_name"];} else {echo "";}?><?php if(isset($fetchforPar)){ echo $fetchforPar["subject_part_name"];} else {echo "";}?></span></td>
												
												<?php 
														if($fetchForall["SubjectPartID"]=="NULL"){
														
														$selecBysub="SELECT * FROM `subject_information` WHERE `subjectId`='".$fetchForall["SubjectId"]."' AND examID='$examId'";
														$resulBysub=$db->select_query($selecBysub);
															if($resulBysub){
																$fetchBySub=$resulBysub->fetch_array();
															}
															$fetcByPart["total"]="";
														}else {
															$selecBYpart="SELECT * FROM `subject_information` WHERE `subPartId`='".$fetchForall["SubjectPartID"]."' AND examID='$examId'";
																$resulByPart=$db->select_query($selecBYpart);
																	if($resulByPart)
																	{
																		$fetcByPart=$resulByPart->fetch_array();
																	}
																	$fetchBySub["total"]="";
														}
												?>
												<td width="7%" align="center"><?php if(isset($fetchBySub)){ echo $fetchBySub["total"];} else {echo "";}?><?php if(isset($fetcByPart)){ echo $fetcByPart["total"];} else {echo "";}?></td
												>
												<td width="5%" align="center"><?php echo $fetchForall["Count_Ass"];?></td>
												<td width="4%" align="center"><?php echo $fetchForall["Creative"];?></td>
												<td width="5%" align="center"><?php echo $fetchForall["Mcq"];?></td>
												<td width="5%" align="center"><?php echo $fetchForall["Practical"];?></td>
												<td width="9%"  align="center"><?php echo $fetchForall["obtainMark"];?></td>
												<td width="9%" align="center"><?php echo $fetchForall["LetterGrade"];?></td>
												<td width="10%" align="center"><?php echo $fetchForall["GradePoint"];?></td>
												
											</tr>
											<?php } else {
												if($fetchForall["SubjectPartID"]=="NULL"){
															$selectForsubject="SELECT * FROM `add_subject_info` WHERE `id`='".$fetchForall["SubjectId"]."'";
															$resultForSub=$db->select_query($selectForsubject);
																//print "dd"."<br/>";
																if($resultForSub){
															$fetchForSub=$resultForSub->fetch_array();}
															//print_r($fetchForSub)."<br/>";
															$fetchforPar["subject_part_code"]="";
															$fetchforPar["subject_part_name"]="";
														}
														else {
															$selectForpart="SELECT * FROM `add_subject_part_info` WHERE `part_id`='".$fetchForall["SubjectPartID"]."'  AND `exam_type`='$examId'";
															$resultForPart=$db->select_query($selectForpart);
															if($resultForPart){
															$fetchforPar=$resultForPart->fetch_array();}
															
															$fetchForSub["subject_code"]="";
															$fetchForSub["subject_name"]="";
															//print_r($fetchforPar);
														}
											?>
												<tr align="">
								
												<td width="32%" align="center"><?php if(isset($fetchForSub)){ echo $fetchForSub["subject_code"];} else {echo "";}?><?php if(isset($fetchforPar)){ echo $fetchforPar["subject_part_code"];} else {echo "";}?></td>
												<td width="7%" align="left"><span style="padding-left:5px;"><?php if(isset($fetchForSub)){ echo $fetchForSub["subject_name"];} else {echo "";}?><?php if(isset($fetchforPar)){ echo $fetchforPar["subject_part_name"];} else {echo "";}?></span></td>
												<?php
													if($fetchForall["SubjectPartID"]=="NULL"){
														
														$selecBysub="SELECT * FROM `subject_information` WHERE `subjectId`='".$fetchForall["SubjectId"]."' AND examID='$examId'";
														$resulBysub=$db->select_query($selecBysub);
															if($resulBysub){
																$fetchBySub=$resulBysub->fetch_array();
															}
															$fetcByPart["total"]="";
														}else {
															$selecBYpart="SELECT * FROM `subject_information` WHERE `subPartId`='".$fetchForall["SubjectPartID"]."' AND examID='$examId'";
																$resulByPart=$db->select_query($selecBYpart);
																	if($resulByPart)
																	{
																		$fetcByPart=$resulByPart->fetch_array();
																	}
																	$fetchBySub["total"]="";
														}
												?>
												<td width="5%" align="center"><?php if(isset($fetchBySub)){ echo $fetchBySub["total"];} else {echo "";}?><?php if(isset($fetcByPart)){ echo $fetcByPart["total"];} else {echo "";}?></td
												>
												<td width="4%" align="center"><?php echo $fetchForall["Count_Ass"];?></td>
												<td width="5%" align="center"><?php echo $fetchForall["Creative"];?></td>
												<td width="5%" align="center"><?php echo $fetchForall["Mcq"];?></td>
												<td width="9%" align="center"><?php echo $fetchForall["Practical"];?></td>
												
												<td width="9%"  align="center"><?php echo $fetchForall["obtainMark"];?></td>
												<td width="10%" align="center"><?php echo $fetchForall["LetterGrade"];?></td>
												
												<td width="7%" align="center"><?php echo $fetchForall["GradePoint"];?></td>
											</tr>
									<?php }$c++; }  } ?>
							</table>
							
							<table>
							   <tr>
                <td width="1196" height="120" align="center" valign="bottom">
				<table width="100%" height="33%" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-top:0px;">
                    <tr>
                      <td width="50%" height="54" valign="top"><strong>
                      <p> --------------------</p>Compared by</span></strong></td>
                      <td width="23%" align="center" valign="top">
                      </td>
                      
                      <td width="24%" align="center" valign="top"><strong><p> -------------------------</p>
                        Headmaster </strong></td>
                    </tr>
                </table>
				</td>
              </tr>
			  <tr>
									  <td class="dontPrint"  colspan="15" align="center"><input  type="submit" class="btn btn-sm btn-danger"  value="Print" class="noneBtnForprin" onClick="window.print()" /></td>
							  </tr>
									
							</table>
					</div>
				</div>
	
	  </form>
 <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>
