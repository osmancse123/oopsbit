<?php
	//error_reporting(1);
	require_once("../db_connect/config.php");
	require_once("../db_connect/conect.php");

	$db = new database();
	//print "ddd";
		if(isset($_POST["restGen"])){
		//print "ddd";
		$ClassId=explode('and',$_POST["ClassId"]);
		$ExamId=explode('and',$_POST["ExamId"]);
		$Session=$db->escape($_POST["Session"]);
		$stdId = $db->escape($_POST["stdId"]);
		if(isset($ClassId) and $ClassId != "Select One" and isset($ExamId) and $ExamId != "Select Exam Name" and
	isset($Session) and $Session != "Select Session"){
					if(isset($stdId) && !empty($stdId )){
							$countStudent="SELECT * FROM `marksheet` WHERE `STudentID`='$stdId' AND `ClassId`='$ClassId[0]' AND `ExamId`='$ExamId[0]' AND  `Session`='$Session'";
								//print $countStudent;
							$resultstduent=$db->select_query($countStudent);
							if($resultstduent){
									while($fetch_Student=$resultstduent->fetch_array()){
											$subJectCount="SELECT * FROM `marksheet` WHERE `STudentID`='$stdId' AND `ClassId`='$ClassId[0]' AND `ExamId`='$ExamId[0]' AND `Session`='$Session'  GROUP BY `SubjectId`";
											//print $subJectCount;
											$reSubCount=$db->select_query($subJectCount);
											if($reSubCount){
													while($fetch_sub_conut=$reSubCount->fetch_array()){
													
															//$fetch_Subjec
														$parCode="SELECT `add_subject_info`.`select_subject_type`,`marksheet`.* FROM `marksheet` 
INNER JOIN `add_subject_info` ON `add_subject_info`.`id`=`marksheet`.`SubjectId`
WHERE `marksheet`.`STudentID`='$fetch_sub_conut[STudentID]'  AND `marksheet`.`ClassId`='$fetch_sub_conut[ClassId]' AND `marksheet`.`ExamId`='$fetch_sub_conut[ExamId]' AND 
`marksheet`.`SubjectId`='$fetch_sub_conut[SubjectId]' AND `marksheet`.`Session`='$fetch_sub_conut[Session]'";
//print $parCode;
												$resultPart=$db->select_query($parCode);
										if($resultPart)
										{
											$rows=$resultPart->num_rows;
											if($rows>1){
												//print $rows;
													$sub_part=0;
													$part_Gpa=0;
													$Sub=0;
													$mcq=0;
													$cre=0;
													$pac=0;
													$con_ass=0;
													
													$std_mcq=0;
													$std_cre=0;
													$std_pac=0;
													$std_con_ass=0;
													$netstdcre = 0;
													while($fetch_parta=$resultPart->fetch_array()){
														$sub_part++;
														//only subjectpart information
														$onlysubPart="SELECT * FROM `subject_information` WHERE `subPartId`='$fetch_parta[SubjectPartID]'";
														$chek_only_part=$db->select_query($onlysubPart);
														if($chek_only_part){
																$fetch_only_part=$chek_only_part->fetch_array();
																
																$mcq=$mcq+$fetch_only_part["MCQ"];
																$cre=$cre+$fetch_only_part["Creative"];
																$pac=$pac+$fetch_only_part["practical"];
																$con_ass=$con_ass+$fetch_only_part["ContAss"];
																
																$subType=$fetch_parta["select_subject_type"];
																
																$part_Gpa=$part_Gpa+$fetch_parta["GradePoint"];
																
																$std_mcq=$std_mcq+$fetch_parta["Mcq"];
																$std_cre=$std_cre+$fetch_parta["Creative"];
																$std_pac=$std_pac+$fetch_parta["Practical"];
																$std_con_ass=$std_con_ass+$fetch_parta["Count_Ass"];
																
																
																
																
														
														}
														}
														
														
														$fail=0;
															$totla=$mcq+$cre+$pac+$con_ass;
														$oMark=$std_mcq+$std_cre+$std_pac+$std_con_ass;
														
														
														
														
																		if($ClassId[1]=='Play' || $ClassId[1]=='Nursery' || $ClassId[1]=='K.G' || $ClassId[1]=='One' || $ClassId[1]=='Two' || $ClassId[1]=='Three' || $ClassId[1]=='Four' || $ClassId[1]=='Five' || $ClassId[1]=='Six' || $ClassId[1]=='Seven' || $ClassId[1]=='play' || $ClassId[1]=='nursery' || $ClassId[1]=='k.g' || $ClassId[1]=='one' || $ClassId[1]=='two' || $ClassId[1]=='three' || $ClassId[1]=='four' || $ClassId[1]=='five' || $ClassId[1]=='six' || $ClassId[1]=='seven' || $ClassId[1]=='Eight' || $ClassId[1]=='eight'){
											
											if($oMark == 33 or $oMark == 66){
															$netstdcre = $oMark+1; 
														}else{
															$netstdcre = $oMark; 
														
														}
														
											
											}else  {
											
											
											
														
														if($std_cre == 33 or $std_cre == 66){
															$netstdcre = $std_cre+1; 
														}else{
														$netstdcre = $std_cre; 
														}
														
														
														if($mcq>0){
																if((float)$mcq/3>$std_mcq){
																
																		$fail=1;
																}
														}
														
														
														if($cre>0){
																if((float)$cre/3>$netstdcre){
																
																		$fail=1;
																}
														}
														
														
														if($pac>0){
																if((float)$pac/3>$std_pac){
																
																		$fail=1;
																}
														}
														
														
														if($con_ass>0){
																if((float)$con_ass/3>$std_con_ass){
																
																		$fail=1;
																}
														}
														
													
														}
														
															
														if($fail != 1){
														
																if($oMark >= 0 * $totla/100 and $oMark <= 32.99 * $totla/100)
																{
																	 $letter_grade="F";
                                           							 $grade_point="0.00";
																}
																
																else if ($oMark >= 33 * $totla/100 and $oMark <= 39.99 * $totla/100){
																
																 	 $letter_grade="D";
                                            						$grade_point="1.00";
																}
																
																else if ($oMark >= 40 * $totla/100 and $oMark <= 49.99 * $totla/100){
																
																 	 $letter_grade="C";
                                            						 $grade_point="2.00";
																}
																
																else if ($oMark >= 50 * $totla/100 and $oMark <= 59.99 * $totla/100){
																
																 	   $letter_grade="B";
                                            							$grade_point="3.00";
																}
																
																else if ($oMark >= 60 * $totla/100 and $oMark <= 69.99 * $totla/100){
																
																 	   $letter_grade="A-";
                                           								 $grade_point="3.50";
																}
																else if ($oMark >= 70 * $totla/100 and $oMark <= 79.99 * $totla/100){
																
																 	 	 $letter_grade="A";
																		$grade_point="4.00";
																}
																
																else if ($oMark >= 80 * $totla/100 and $oMark <= 100 * $totla/100){
																
																 	 	 $letter_grade="A+";
                                            								$grade_point="5.00";
																}
																
													$oldResutl="SELECT * FROM `gnerate_marks` WHERE `studentID`='$fetch_Student[STudentID]' AND `ClassID`='$ClassId[0]' AND `ExamId`='$ExamId[0]' AND `Session`='$Session' AND `subjectID`='$fetch_sub_conut[SubjectId]'";
												//print $oldResutl;
													$chekOld=$db->select_query($oldResutl);
													if($chekOld){
														$generate_result="REPLACE INTO `gnerate_marks` (`studentID`,`ClassID`,`GroupID`,`ExamId`,`Session`,`studentRoll`,`subjectID`,`fullMarks`,`obtainMarks`,`letterGrade`,`gradePoint`) VALUES ('$fetch_Student[STudentID]','$ClassId[0]','$fetch_Student[GroupID]','$ExamId[0]','$Session','$fetch_Student[StudentRoll]','$fetch_sub_conut[SubjectId]','$totla','$oMark','$letter_grade','$grade_point')";
															//print $generate_result;
																$result_generate=$db->update_query($generate_result);
																
														
													}else {
														$generate_result="INSERT INTO `gnerate_marks` (`studentID`,`ClassID`,`GroupID`,`ExamId`,`Session`,`studentRoll`,`subjectID`,`fullMarks`,`obtainMarks`,`letterGrade`,`gradePoint`) VALUES ('$fetch_Student[STudentID]','$ClassId[0]','$fetch_Student[GroupID]','$ExamId[0]','$Session','$fetch_Student[StudentRoll]','$fetch_sub_conut[SubjectId]','$totla','$oMark','$letter_grade','$grade_point')";
															//	print $generate_result;
																$result_generate=$db->insert_query($generate_result);
														
													}
																
																
																
																
																
														}
														else{
													$oldResutl="SELECT * FROM `gnerate_marks` WHERE `studentID`='$fetch_Student[STudentID]' AND `ClassID`='$ClassId[0]' AND `ExamId`='$ExamId[0]' AND `Session`='$Session' AND `subjectID`='$fetch_sub_conut[SubjectId]'";
													$chekOld=$db->select_query($oldResutl);
													if($chekOld){
														$generate_result="REPLACE INTO `gnerate_marks` (`studentID`,`ClassID`,`GroupID`,`ExamId`,`Session`,`studentRoll`,`subjectID`,`fullMarks`,`obtainMarks`,`letterGrade`,`gradePoint`) VALUES ('$fetch_Student[STudentID]','$ClassId[0]','$fetch_Student[GroupID]','$ExamId[0]','$Session','$fetch_Student[StudentRoll]',$fetch_sub_conut[SubjectId],'$totla','$oMark','F','0.00')";
																$result_generate=$db->update_query($generate_result);
													}else {
														$generate_result="INSERT INTO `gnerate_marks` (`studentID`,`ClassID`,`GroupID`,`ExamId`,`Session`,`studentRoll`,`subjectID`,`fullMarks`,`obtainMarks`,`letterGrade`,`gradePoint`) VALUES ('$fetch_Student[STudentID]','$ClassId[0]','$fetch_Student[GroupID]','$ExamId[0]','$Session','$fetch_Student[StudentRoll]',$fetch_sub_conut[SubjectId],'$totla','$oMark','F','0.00')";
																$result_generate=$db->insert_query($generate_result);
													}
															
																
															
														}
													
													
													
											}//end par area
												else {
											
													
												$fetch_sub=$resultPart->fetch_array();
												$sele_total="SELECT * FROM `subject_information` WHERE `subjectId`='$fetch_sub[SubjectId]' AND `ExamId`='$ExamId[0]' AND `classID`='$ClassId[0]'";
												
													$re_total=$db->select_query($sele_total);
													if($re_total){
														
														$fetch_total=$re_total->fetch_array();
													}
													$oldResutl="SELECT * FROM `gnerate_marks` WHERE `studentID`='$fetch_Student[STudentID]' AND `ClassID`='$ClassId[0]' AND `ExamId`='$ExamId[0]' AND `Session`='$Session' AND `subjectID`='$fetch_sub[SubjectId]'";
													//print $oldResutl;
													$chekOld=$db->select_query($oldResutl);
													if($chekOld){
													$generate_result="REPLACE INTO `gnerate_marks` (`studentID`,`ClassID`,`GroupID`,`ExamId`,`Session`,`studentRoll`,`subjectID`,`fullMarks`,`obtainMarks`,`letterGrade`,`gradePoint`) VALUES 
													('$fetch_Student[STudentID]','$ClassId[0]','$fetch_Student[GroupID]','$ExamId[0]','$Session','$fetch_Student[StudentRoll]','$fetch_sub[SubjectId]','$fetch_total[total]','$fetch_sub[obtainMark]','$fetch_sub[LetterGrade]','$fetch_sub[GradePoint]')";
														$result_generate=$db->update_query($generate_result);
													}else {
														$generate_result="INSERT INTO `gnerate_marks` (`studentID`,`ClassID`,`GroupID`,`ExamId`,`Session`,`studentRoll`,`subjectID`,`fullMarks`,`obtainMarks`,`letterGrade`,`gradePoint`) VALUES 
													('$fetch_Student[STudentID]','$ClassId[0]','$fetch_Student[GroupID]','$ExamId[0]','$Session','$fetch_Student[StudentRoll]','$fetch_sub[SubjectId]','$fetch_total[total]','$fetch_sub[obtainMark]','$fetch_sub[LetterGrade]','$fetch_sub[GradePoint]')";
														$result_generate=$db->insert_query($generate_result);
														//print $result_generate;
													}												
														//print $generate_result;
												
												
												
										}
										}	
													
													
													
													//see that
													}
											}
										
									}
									if(isset($db->sms)){
										
										echo $db->sms;
									}
							}
					}else {
						print "Please Enter The Student ID";
					}
		}
		else{
				print "Please Fill Up the Fields";
		}

	}

	
	
	?>