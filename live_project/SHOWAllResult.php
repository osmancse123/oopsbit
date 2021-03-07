<?php
	error_reporting(1);
	require_once("db_connect/config.php");
	require_once("db_connect/conect.php");

	$db = new database();
	
	$sqlt="SELECT * FROM `project_info`";
	$resultsqlt=$db->select_query($sqlt);
	if($resultsqlt){
		$fetch_Sql=$resultsqlt->fetch_array();
	}
	
	$clasId=explode('and',$_POST["className"]);
	$exmaid=explode('and',$_POST["ExamName"]);
	$year=$db->escape($_POST["Year"]);
	$roll=$db->escape($_POST["RollNo"]);
	
		if(isset($clasId) and isset($exmaid) and isset($year) and isset($roll)){
		
	 	 $sql ="SELECT * FROM `result` WHERE `std_roll`='$roll' AND `classId`='$clasId[0]' AND  `Year`='$year'  AND `examId`='$exmaid[0]'";
		$resultSql=$db->select_query($sql);
			if($resultSql){
					$fetchSql=$resultSql->fetch_array();
					
					if($fetchSql["std_roll"] == $roll ){
					if(isset($fetchSql))
						{
							 $sqlForStudentDetails="SELECT `result`.*,`exam_type_info`.`exam_type`,`add_class`.`class_name`,`add_group`.`group_name`,
`student_personal_info`.`student_name`,`father_name`,`mother_name`,`date_of_brith`,
`student_acadamic_information`.`regular_iregular`
FROM  `result` JOIN `exam_type_info` ON `exam_type_info`.`exam_id`=`result`.`examId` JOIN `add_class`
ON `add_class`.`id`=`result`.`classId` JOIN `add_group` ON `add_group`.`id`=`result`.`GroupID` JOIN `student_personal_info`
ON `student_personal_info`.`id`=`result`.`STD_ID` JOIN `student_acadamic_information` ON `student_acadamic_information`.`id`=`result`.`STD_ID`
WHERE `result`.`STD_ID`='$fetchSql[STD_ID]' AND `result`.`std_roll`='$fetchSql[std_roll]' AND `result`.`examId`='$fetchSql[examId]'";
							$resultforSqldetails=$db->select_query($sqlForStudentDetails);
							if($resultforSqldetails){
									$fetch_resultforSqldetails=$resultforSqldetails->fetch_array();
							}
						}
					
			}
				
		}
	}
	
?>

<div class="col-lg-7 col-sm-12 col-lg-offset-2 jumbotron" style="border:3px #FFFFFF solid; background:#FFFFFF" id="AddMarksStep1">
								<div class="col-lg-12" id="main">
									<div class="col-lg-2" style="margin-top:3px;"><img src="admin/all_image/logoSDMS2015.png" class="img-rounded" style="height:80px;50px; margin-bottom:5px;"/></div>
									<div class="col-lg-10">
											
	
								<table class="table-responsive">
													<tr>
														<td width="1290"><span class="text-justify" style="font-size:18px; color:#FFFFFF;
														 border-bottom:2px  #FFFFFF solid; display:block"><strong>Ministry of Education</strong>
	</span></td>
													</tr>
													<tr>
														<td><span class="text-justify" style="font-size:20px; color:#FFFFFF;"><strong><?php if(isset($fetch_Sql)){echo $fetch_Sql["institute_name"]; }else {echo "";}?></strong>
	</span></td></tr>
											<tr >
													<td align="right"><br/><span class="text-justify" style="font-size:13px; color:#FFFFFF;"><strong><a href="./" style="font-size:13px; color:#FFFFFF; text-decoration:none" >Official Website of CMC</a></strong>
	</span><br/></td>
											</tr>
											</table>
										
									</div>
								</div>
								<?php 
									if(isset($fetchSql)){
								?>
							<div>
							
							<table border="0" class="table-responsive" cellpadding="0" cellspacing="0">
								<tr align="center">
									<td width="1103" height="50px" align="center"><span style="font-size:16px"><strong><?php if(isset($fetch_resultforSqldetails)){ echo $fetch_resultforSqldetails["exam_type"]."&nbsp;Result&nbsp;".$fetch_resultforSqldetails["Year"];} else {echo "";}?> </strong></td>
								</tr>
							</table>
							
												</div>
								<div>
									
									
									<table cellpadding="0" cellspacing="0" class="table-responsive" style=" border:2px #FFFFFF solid; background:#F2F2F2 " >
												  <tr style="border:1px #FFFFFF solid">
													<td width="133" style="border:1px #FFFFFF solid">&nbsp;&nbsp;Roll No.</td>
													<td width="444" style="border:1px #FFFFFF solid">&nbsp;&nbsp;<?php if(isset($fetch_resultforSqldetails)){ echo $fetch_resultforSqldetails["std_roll"];} else {echo "";}?> </td>
													<td width="195" style="border:1px #FFFFFF solid">&nbsp;&nbsp;Name</td>
													<td width="518" style="border:1px #FFFFFF solid">&nbsp;&nbsp;<?php if(isset($fetch_resultforSqldetails)){ echo $fetch_resultforSqldetails["student_name"];} else {echo "";}?></td>
												  </tr>
												  <tr style="border:1px #FFFFFF solid">
													<td width="133" style="border:1px #FFFFFF solid">&nbsp;&nbsp;Class</td>
													<td width="444" style="border:1px #FFFFFF solid">&nbsp;&nbsp;<?php if(isset($fetch_resultforSqldetails)){ echo $fetch_resultforSqldetails["class_name"];} else {echo "";}?></td>
													<td width="195" style="border:1px #FFFFFF solid">&nbsp;&nbsp;Father's Name</td>
													<td width="518" style="border:1px #FFFFFF solid">&nbsp;&nbsp;<?php if(isset($fetch_resultforSqldetails)){ echo $fetch_resultforSqldetails["father_name"];} else {echo "";}?></td>
												  </tr>
												  <tr style="border:1px #FFFFFF solid">
													<td width="133" style="border:1px #FFFFFF solid">&nbsp;&nbsp;Group</td>
													<td width="444" style="border:1px #FFFFFF solid">&nbsp;&nbsp;<?php if(isset($fetch_resultforSqldetails)){ echo $fetch_resultforSqldetails["group_name"];} else {echo "";}?></td>
													<td width="195" style="border:1px #FFFFFF solid">&nbsp;&nbsp;Mother's Name</td>
													<td width="518" style="border:1px #FFFFFF solid">&nbsp;&nbsp;<?php if(isset($fetch_resultforSqldetails)){ echo $fetch_resultforSqldetails["mother_name"];} else {echo "";}?></td>
												  </tr>
												  <tr style="border:1px #FFFFFF solid">
													<td width="133" style="border:1px #FFFFFF solid">&nbsp;&nbsp;Type</td>
													<td width="444" style="border:1px #FFFFFF solid">&nbsp;&nbsp;<?php if(isset($fetch_resultforSqldetails)){ echo $fetch_resultforSqldetails["regular_iregular"];} else {echo "";}?></td>
													<td width="195" style="border:1px #FFFFFF solid">&nbsp;&nbsp;Date Of Brith</td>
													<td width="518" style="border:1px #FFFFFF solid">&nbsp;&nbsp;<?php if(isset($fetch_resultforSqldetails)){ echo $fetch_resultforSqldetails["date_of_brith"];} else {echo "";}?></td>
												  </tr>
												  <tr style="border:1px #FFFFFF solid">
													<td width="133" style="border:1px #FFFFFF solid">&nbsp;&nbsp;Result</td>
													<td width="444" style="border:1px #FFFFFF solid">&nbsp;<?php if(isset($fetch_resultforSqldetails)){ 
														if($fetch_resultforSqldetails["CGPA"] == "0.00" ){?>
														<span><strong class="text-danger">FAILED</strong></span>
														<?php } else {?>
														<span><strong class="text-success">PASSED</strong></span>
														<?php }
													}?></td>
													<td width="195" style="border:1px #FFFFFF solid">&nbsp;&nbsp;Institute</td>
													<td width="518" style="border:1px #FFFFFF solid">&nbsp;&nbsp;<?php if(isset($fetch_Sql)){echo $fetch_Sql["institute_name"]; }else {echo "";}?></td>
												  </tr>
												   <tr style="border:1px #FFFFFF solid">
													<td width="133" style="border:1px #FFFFFF solid">&nbsp;&nbsp;GPA</td>
													<td colspan="3" style="border:1px #FFFFFF solid">&nbsp;&nbsp;<?php if(isset($fetch_resultforSqldetails)){ echo $fetch_resultforSqldetails["CGPA"];} else {echo "";}?></td>
												  </tr>
												  
								  </table>

								</div>
								
								
								<div><table border="0" class="table-responsive" cellpadding="0" cellspacing="0">
								<tr align="center">
									<td width="1103" height="50px" align="center"><span style="font-size:16px"><strong>Grade Sheet</strong></td>
								</tr>
							</table>
												</div>
								<div>
									
									
									<table cellpadding="0" class="class-resposive " cellspacing="0" style="width:100%; border:2px #FFFFFF solid; background:#F2F2F2 " >
												  <tr style="border:1px #FFFFFF solid; background:#CECECE; ">
													<td width="184" style="border:1px #FFFFFF solid">&nbsp;&nbsp;<b>Code</b></td>
													<td width="301" style="border:1px #FFFFFF solid">&nbsp;&nbsp;<b>Subject</b></td>
													<td width="218" style="border:1px #FFFFFF solid">&nbsp;&nbsp;<b>Full Marks</b></td>
													
													<td width="218" style="border:1px #FFFFFF solid">&nbsp;&nbsp;<b>CA</b></td>
													<td width="218" style="border:1px #FFFFFF solid">&nbsp;&nbsp;<b>CT </b></td>
													<td width="218" style="border:1px #FFFFFF solid">&nbsp;&nbsp;<b>MC</b></td>
													<td width="218" style="border:1px #FFFFFF solid">&nbsp;&nbsp;<b>PT</b></td>
													
													<td width="218" style="border:1px #FFFFFF solid">&nbsp;&nbsp;<b>Obtain Marks</b></td>
													<td width="218" style="border:1px #FFFFFF solid">&nbsp;&nbsp;<b>Grade</b></td>
													
													
												  </tr>
												  <?php
												    $sqlSubjectAll="SELECT `gnerate_marks`.`subjectID`,letterGrade,obtainMarks,fullMarks,`add_subject_info`.`subject_code`,`subject_name` FROM `gnerate_marks`
INNER JOIN `add_subject_info` ON `add_subject_info`.`id`=`gnerate_marks`.`subjectID` WHERE `gnerate_marks`.`studentID`='$fetch_resultforSqldetails[STD_ID]' AND `gnerate_marks`.`ClassID`='$fetch_resultforSqldetails[classId]'
AND `gnerate_marks`.`ExamID`='$fetch_resultforSqldetails[examId]' AND `gnerate_marks`.`GroupID`='$fetch_resultforSqldetails[GroupID]' AND `gnerate_marks`.`studentRoll`='$fetch_resultforSqldetails[std_roll]' AND `add_subject_info`.`select_subject_type`='CompulsorySubject'  ORDER BY `add_subject_info`.`serial` ASC";
												  	$resulSubjecAll=$db->select_query($sqlSubjectAll);
													if($resulSubjecAll)
													{
												
														while($fetchResulSubje=$resulSubjecAll->fetch_array()){
														
													 	 $selectAllresult = "SELECT SUM(`Count_Ass`) AS countass,SUM(`Creative`)  AS CA,SUM(`Mcq`) AS MC,SUM(`Practical`) AS pt,SUM(`obtainMark`) AS om FROM `marksheet` WHERE `StudentRoll`='$fetch_resultforSqldetails[std_roll]' AND `ClassId`='$fetch_resultforSqldetails[classId]' AND `GroupID`='$fetch_resultforSqldetails[GroupID]' AND `ExamId`='$fetch_resultforSqldetails[examId]' AND `SubjectId`='$fetchResulSubje[subjectID]'";
															$relslre=$db->select_query($selectAllresult);
												if($relslre)
													{
												
													$fetresls=$relslre->fetch_array();
														
														}
												?>
												  <tr style="border:1px #FFFFFF solid;"
												 
												  <?php
												  		if($fetchResulSubje["letterGrade"] == 'F'){?>
															 bgcolor="#FC728A"
														<?php }
												  
												  ?> >
													<td width="184" style="border:1px #FFFFFF solid">&nbsp;&nbsp;<?php echo $fetchResulSubje["subject_code"];?></td>
													<td width="301" style="border:1px #FFFFFF solid">&nbsp;&nbsp;<?php echo $fetchResulSubje["subject_name"];?></td>
													<td width="218" style="border:1px #FFFFFF solid">&nbsp;&nbsp;<?php echo $fetchResulSubje["fullMarks"];?></td>
													
												   <td width="184" style="border:1px #FFFFFF solid">&nbsp;&nbsp;<?php echo $fetresls["countass"];?></td>
													<td width="301" style="border:1px #FFFFFF solid">&nbsp;&nbsp;<?php echo $fetresls["CA"];?></td>
													<td width="218" style="border:1px #FFFFFF solid">&nbsp;&nbsp;<?php echo $fetresls["MC"];?></td>
													<td width="218" style="border:1px #FFFFFF solid">&nbsp;&nbsp;<?php echo $fetresls["pt"];?></td>
													
													
													
												    <td width="218" style="border:1px #FFFFFF solid">&nbsp;&nbsp;<?php echo $fetchResulSubje["obtainMarks"];?></td>
													<td width="218" style="border:1px #FFFFFF solid">&nbsp;&nbsp;<?php echo $fetchResulSubje["letterGrade"];?></td>
														
													
													
												  </tr>
												  	
												  <?php }  }?>
												  
												    <?php
												  $sqlSubjectAll="SELECT `gnerate_marks`.`subjectID`,letterGrade,obtainMarks,fullMarks,`add_subject_info`.`subject_code`,`subject_name` FROM `gnerate_marks`
INNER JOIN `add_subject_info` ON `add_subject_info`.`id`=`gnerate_marks`.`subjectID` WHERE `gnerate_marks`.`studentID`='$fetch_resultforSqldetails[STD_ID]' AND `gnerate_marks`.`ClassID`='$fetch_resultforSqldetails[classId]'
AND `gnerate_marks`.`ExamID`='$fetch_resultforSqldetails[examId]' AND `gnerate_marks`.`GroupID`='$fetch_resultforSqldetails[GroupID]' AND `gnerate_marks`.`studentRoll`='$fetch_resultforSqldetails[std_roll]' AND `add_subject_info`.`select_subject_type`='GroupSubject'  ORDER BY `add_subject_info`.`serial` ASC";
												  	$resulSubjecAll=$db->select_query($sqlSubjectAll);
													if($resulSubjecAll)
													{
													
														while($fetchResulSubje=$resulSubjecAll->fetch_array()){
														
														 $selectAllresult = "SELECT SUM(`Count_Ass`) AS countass,SUM(`Creative`)  AS CA,SUM(`Mcq`) AS MC,SUM(`Practical`) AS pt,SUM(`obtainMark`) AS om FROM `marksheet` WHERE `StudentRoll`='$fetch_resultforSqldetails[std_roll]' AND `ClassId`='$fetch_resultforSqldetails[classId]' AND `GroupID`='$fetch_resultforSqldetails[GroupID]' AND `ExamId`='$fetch_resultforSqldetails[examId]' AND `SubjectId`='$fetchResulSubje[subjectID]'";
															$relslre=$db->select_query($selectAllresult);
												if($relslre)
													{
												
													$fetresls=$relslre->fetch_array();
														
														}
												
												 ?>
												  <tr style="border:1px #FFFFFF solid;"
												  <?php
												  		if($fetchResulSubje["letterGrade"] == 'F'){?>
															 bgcolor="#FC728A"
														<?php }
												  
												  ?>
												  >
													<td width="184" style="border:1px #FFFFFF solid">&nbsp;&nbsp;<?php echo $fetchResulSubje["subject_code"];?></td>
													<td width="301" style="border:1px #FFFFFF solid">&nbsp;&nbsp;<?php echo $fetchResulSubje["subject_name"];?></td>
													<td width="218" style="border:1px #FFFFFF solid">&nbsp;&nbsp;<?php echo $fetchResulSubje["fullMarks"];?></td>
													
													
													   <td width="184" style="border:1px #FFFFFF solid">&nbsp;&nbsp;<?php echo $fetresls["countass"];?></td>
													<td width="301" style="border:1px #FFFFFF solid">&nbsp;&nbsp;<?php echo $fetresls["CA"];?></td>
													<td width="218" style="border:1px #FFFFFF solid">&nbsp;&nbsp;<?php echo $fetresls["MC"];?></td>
													<td width="218" style="border:1px #FFFFFF solid">&nbsp;&nbsp;<?php echo $fetresls["pt"];?></td>
													
													
													
													<td width="218" style="border:1px #FFFFFF solid">&nbsp;&nbsp;<?php echo $fetchResulSubje["obtainMarks"];?></td>
													
													<td width="218" style="border:1px #FFFFFF solid">&nbsp;&nbsp;<?php echo $fetchResulSubje["letterGrade"];?></td>
													
													
												  </tr>
												  	
												  <?php } }?>
												    <?php
												  $sqlSubjectAll="SELECT `gnerate_marks`.`subjectID`,letterGrade,obtainMarks,fullMarks,`add_subject_info`.`subject_code`,`subject_name` FROM `gnerate_marks`
INNER JOIN `add_subject_info` ON `add_subject_info`.`id`=`gnerate_marks`.`subjectID` WHERE `gnerate_marks`.`studentID`='$fetch_resultforSqldetails[STD_ID]' AND `gnerate_marks`.`ClassID`='$fetch_resultforSqldetails[classId]'
AND `gnerate_marks`.`ExamID`='$fetch_resultforSqldetails[examId]' AND `gnerate_marks`.`GroupID`='$fetch_resultforSqldetails[GroupID]' AND `gnerate_marks`.`studentRoll`='$fetch_resultforSqldetails[std_roll]' AND `add_subject_info`.`select_subject_type`='OptionalSubject'  ORDER BY `add_subject_info`.`serial` ASC";
												  	$resulSubjecAll=$db->select_query($sqlSubjectAll);
													if($resulSubjecAll)
													{
													
														while($fetchResulSubje=$resulSubjecAll->fetch_array()){
														
														
															 $selectAllresult = "SELECT SUM(`Count_Ass`) AS countass,SUM(`Creative`)  AS CA,SUM(`Mcq`) AS MC,SUM(`Practical`) AS pt,SUM(`obtainMark`) AS om FROM `marksheet` WHERE `StudentRoll`='$fetch_resultforSqldetails[std_roll]' AND `ClassId`='$fetch_resultforSqldetails[classId]' AND `GroupID`='$fetch_resultforSqldetails[GroupID]' AND `ExamId`='$fetch_resultforSqldetails[examId]' AND `SubjectId`='$fetchResulSubje[subjectID]'";
															$relslre=$db->select_query($selectAllresult);
												if($relslre)
													{
												
													$fetresls=$relslre->fetch_array();
														
														}
												
												  ?>
												  <tr style="border:1px #FFFFFF solid;"  <?php
												  		if($fetchResulSubje["letterGrade"] == 'F'){?>
															 bgcolor="#FC728A"
														<?php }
												  
												  ?>
												  >
													<td width="184" style="border:1px #FFFFFF solid">&nbsp;&nbsp;<?php echo $fetchResulSubje["subject_code"];?></td>
													<td width="301" style="border:1px #FFFFFF solid">&nbsp;&nbsp;<?php echo $fetchResulSubje["subject_name"];?></td>
														<td width="218" style="border:1px #FFFFFF solid">&nbsp;&nbsp;<?php echo $fetchResulSubje["fullMarks"];?></td>
														
														
													   <td width="184" style="border:1px #FFFFFF solid">&nbsp;&nbsp;<?php echo $fetresls["countass"];?></td>
													<td width="301" style="border:1px #FFFFFF solid">&nbsp;&nbsp;<?php echo $fetresls["CA"];?></td>
													<td width="218" style="border:1px #FFFFFF solid">&nbsp;&nbsp;<?php echo $fetresls["MC"];?></td>
													<td width="218" style="border:1px #FFFFFF solid">&nbsp;&nbsp;<?php echo $fetresls["pt"];?></td>
													
													
													
													
												
													<td width="218" style="border:1px #FFFFFF solid">&nbsp;&nbsp;<?php echo $fetchResulSubje["obtainMarks"];?></td>
													<td width="218" style="border:1px #FFFFFF solid">&nbsp;&nbsp;<?php echo $fetchResulSubje["letterGrade"];?></td>
													
												  </tr>
												  
												  	
												  <?php } }?>
												  
								  </table>

								</div>
								
								<?php } else {?>
							
								<span class="text-danger"><strong>No Result Have Found ....!!</strong></span>
							<?php } ?>
							<div>
									
								<div style="margin-top:5px;"><table border="0" cellpadding="0" cellspacing="0">
								<tr align="center">
									<td width="1103" height="0px" align="center"><span style="font-size:13px"><strong><a href="#" onclick="return ShowBack()" class="link">Search Again</a></strong></td>
								</tr>
							</table>
												</div>
										
  </div>
							<div class="col-lg-12" style="border-top:5px #006600 solid; margin-top:10px;">	</div>
							<div class="col-lg-12" style="margin-top:1px; background:#E7E7E4; height:85px; border-radius:0px 0px 5px 5px"> 	
							
							<table border="0"  class="table-responsive">
  							<tr>
							<td width="998" height="92"><span style="font-size:14px; color:#8C8C8C">2015-2016 SBIT, All rights reserved.</span></td>
							<td width="181"><span style="font-size:14px; color:#8C8C8C"> 	Powered by</span></td>
							<td width="163"><img src="admin/all_image/hompageCodeSDMS2015.jpg" class="img-rounded" style="height:50px; width:130px;" /></td>
						  </tr>
						
						</table>
						</div>
						
								
</div>