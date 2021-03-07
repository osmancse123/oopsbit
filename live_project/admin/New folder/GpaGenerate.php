<?php
	error_reporting(1);
	require_once("../db_connect/config.php");
	require_once("../db_connect/conect.php");

	$db = new database();
	//print "dddd";
	if(isset($_POST["totalstd"])){
			
		$ClassId=explode('and',$_POST["ClassId"]);
		$ExamId=explode('and',$_POST["ExamId"]);
		$Session=$db->escape($_POST["Session"]);

		$sql = "SELECT *  FROM `marksheet` WHERE `ClassId`='$ClassId[0]' AND `ExamId`='$ExamId[0]' AND `Session`='$Session' GROUP BY `STudentID`";
		//print $sql;
		$chek=$db->select_query($sql);
		if($chek){
				$rows=$chek->num_rows;
				print "Total Student = &nbsp;".$rows;
		}


	}
	
	
	
	if(isset($_POST["resultGen"])){

	$class_id=explode('and',$_POST["ClassId"]);
	$examId=explode('and',isset($_POST["ExamId"])?$_POST["ExamId"]:"");
	$session=$db->escape($_POST["Session"]);
		$sqlchek="SELECT * FROM `marksheet` WHERE `ClassId`='$class_id[0]' AND `ExamId`='$examId[0]' AND `Session`='$session' GROUP BY `STudentID` ORDER BY `STudentID` ASC LIMIT $_POST[from],$_POST[to]";
					//print $sqlchek;
				$chek_sql=$db->select_query($sqlchek);
				
		
	if(isset($class_id) and $class_id != "Select One" and isset($examId) and $examId != "Select Exam Name" and
	isset($session) and $session != "Select Session"){

	$sqlt = "SELECT *  FROM `marksheet` WHERE `ClassId`='$class_id[0]' AND `ExamId`='$examId[0]' AND `Session`='$session' GROUP BY `STudentID`";
		//print $sql;
		$chek=$db->select_query($sqlt);
		if($chek){
				$rows=$chek->num_rows;
				print "<input type='hidden' name='totalstd' id='totalstd' value='$rows'/>";
		}
	
		if(isset($_POST["from"]) && isset($_POST["to"]) && $_POST["from"] != "" && $_POST["to"] != ""){
		// for student count 
			
	
				if($chek_sql){
				
						while($fetch_sql=$chek_sql->fetch_array()){
								// for subject count
							$scountsubject="SELECT * FROM `marksheet` WHERE `STudentID`='$fetch_sql[STudentID]' AND `ClassId`='$fetch_sql[ClassId]' AND `ExamId`='$fetch_sql[ExamId]' AND `Session`='$fetch_sql[Session]' GROUP BY SubjectId";
								//print $scountsubject;
							$rcousub=$db->select_query($scountsubject);
							if($rcousub){
									while($fetcouSub=$rcousub->fetch_array()){
									
										//for subject part count wise student
										
									 	$spartCount="SELECT `add_subject_info`.`select_subject_type`,`marksheet`.* FROM `marksheet` 
INNER JOIN `add_subject_info` ON `add_subject_info`.`id`=`marksheet`.`SubjectId`
WHERE `marksheet`.`STudentID`='$fetcouSub[STudentID]'  AND `marksheet`.`ClassId`='$fetcouSub[ClassId]' AND `marksheet`.`ExamId`='$fetcouSub[ExamId]' AND 
`marksheet`.`SubjectId`='$fetcouSub[SubjectId]' AND `marksheet`.`Session`='$fetcouSub[Session]'";
										//print $spartCount;
										$resultPart=$db->select_query($spartCount);
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
													$excetobmark  = 0;
													$exactcre = 0;
													$netstdcre = 0;
													
													while($fetch_parta=$resultPart->fetch_array()){
														$sub_part++;
														//only subjectpart information
														$onlysubPart="SELECT * FROM `subject_information` WHERE `classID`='$fetcouSub[ClassId]' AND `examID`='$fetcouSub[ExamId]' AND  `subPartId`='$fetch_parta[SubjectPartID]'";

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
														
	/////////////////////////////  K.G  to Eight  ///////////////////

											if($ClassId[1]=='Play' || $ClassId[1]=='Nursery' || $ClassId[1]=='K.G' || $ClassId[1]=='One' || $ClassId[1]=='Two' || $ClassId[1]=='Three' || $ClassId[1]=='Four' || $ClassId[1]=='Five' || $ClassId[1]=='Six' || $ClassId[1]=='Seven' ||

														 $ClassId[1]=='play' || $ClassId[1]=='nursery' || $ClassId[1]=='k.g' || $ClassId[1]=='one' || $ClassId[1]=='two' || $ClassId[1]=='three' || $ClassId[1]=='four' || $ClassId[1]=='five' || $ClassId[1]=='six' || $ClassId[1]=='seven' || $ClassId[1]=='Eight' || $ClassId[1]=='eight'){

											
	
												
										$netstdcre = $oMark; 						
										if($totla>0){

													if($ClassId[1]=="Six" || $ClassId[1]=="Seven")
													{
															$CheckFailed=intval($totla*0.40);
													}
													else
													{
														$CheckFailed=intval($totla*0.33);
													}
													
													if($CheckFailed>$netstdcre)
													{
																
																		$fail=1;
													}
											}	

/////////////////////////////  end K.G  to Eight  ///////////////////						
					}
					else
					{
														
														
														
														
													$netstdcre = $std_cre; 
														
														if($mcq>0)
														{
															$checkMcq=intval($mcq*0.33);

																if($checkMcq>$std_mcq){
																
																		$fail=1;
																}
														}
														
														
														if($cre>0){

															$checkCretiv=intval($cre*0.33);
																if($checkCretiv>$netstdcre){
																
																		 $fail=1;
																}
														}
														
														
														if($pac>0){
															$checkPre=intval($pac*0.33);
																if($checkPre>$std_pac){
																
																		$fail=1;
																}
														}
														
														
														if($con_ass>0){
															$checkconAss=intval($con_ass*0.33);
																if($checkconAss>$std_con_ass){
																
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
																
																else if ($oMark > 33 * $totla/100 and $oMark <= 39.99 * $totla/100){

						if($class_id[0]=="311609100003" ||$class_id[0]=="311609110004")
						{
								 $letter_grade="F";
                                 $grade_point="0.00";
						}
						else
						{
							$letter_grade="D";
                             $grade_point="1.00";
						}
																
																 	 



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
																
													$oldResutl="SELECT * FROM `gnerate_marks` WHERE `studentID`='$fetch_sql[STudentID]' AND `ClassID`='$class_id[0]' AND `ExamID`='$examId[0]' AND `session`='$session' AND `subjectID`='$fetcouSub[SubjectId]'";
													$chekOld=$db->select_query($oldResutl);
													if($chekOld){
														$generate_result="REPLACE INTO `gnerate_marks` (`studentID`,`ClassID`,`GroupID`,`ExamID`,`session`,`studentRoll`,`subjectID`,`fullMarks`,`obtainMarks`,`letterGrade`,`gradePoint`) VALUES ('$fetch_sql[STudentID]','$class_id[0]','$fetch_sql[GroupID]','$examId[0]','$session','$fetch_sql[StudentRoll]','$fetcouSub[SubjectId]','$totla','$oMark','$letter_grade','$grade_point')";
															//	print $generate_result;
																$result_generate=$db->update_query($generate_result);
																
														
													}else {
														$generate_result="INSERT INTO `gnerate_marks` (`studentID`,`ClassID`,`GroupID`,`ExamID`,`session`,`studentRoll`,`subjectID`,`fullMarks`,`obtainMarks`,`letterGrade`,`gradePoint`) VALUES ('$fetch_sql[STudentID]','$class_id[0]','$fetch_sql[GroupID]','$examId[0]','$session','$fetch_sql[StudentRoll]','$fetcouSub[SubjectId]','$totla','$oMark','$letter_grade','$grade_point')";
															//	print $generate_result;
																$result_generate=$db->insert_query($generate_result);
														
													}
																
																
																
																
																
														}
														else{
															
													$oldResutl="SELECT * FROM `gnerate_marks` WHERE `studentID`='$fetch_sql[STudentID]' AND `ClassID`='$class_id[0]' AND `ExamID`='$examId[0]' AND `session`='$session' AND `subjectID`='$fetcouSub[SubjectId]'";
													$chekOld=$db->select_query($oldResutl);
													if($chekOld){
														$generate_result="REPLACE INTO `gnerate_marks` (`studentID`,`ClassID`,`GroupID`,`ExamID`,`session`,`studentRoll`,`subjectID`,`fullMarks`,`obtainMarks`,`letterGrade`,`gradePoint`) VALUES ('$fetch_sql[STudentID]','$class_id[0]','$fetch_sql[GroupID]','$examId[0]','$session','$fetch_sql[StudentRoll]',$fetcouSub[SubjectId],'$totla','$oMark','F','0.00')";
																$result_generate=$db->update_query($generate_result);
													}else {
														$generate_result="INSERT INTO `gnerate_marks` (`studentID`,`ClassID`,`GroupID`,`ExamID`,`session`,`studentRoll`,`subjectID`,`fullMarks`,`obtainMarks`,`letterGrade`,`gradePoint`) VALUES ('$fetch_sql[STudentID]','$class_id[0]','$fetch_sql[GroupID]','$examId[0]','$session','$fetch_sql[StudentRoll]',$fetcouSub[SubjectId],'$totla','$oMark','F','0.00')";
																$result_generate=$db->insert_query($generate_result);
													}
															
																
															
														}
													
													
													
											}//end par area
												else {
											
													
												$fetch_sub=$resultPart->fetch_array();
												$sele_total="SELECT * FROM `subject_information` WHERE `subjectId`='$fetch_sub[SubjectId]' AND `examID`='$examId[0]' AND `classID`='$class_id[0]'";
													$re_total=$db->select_query($sele_total);
													if($re_total){
														
														$fetch_total=$re_total->fetch_array();
													}
													$oldResutl="SELECT * FROM `gnerate_marks` WHERE `studentID`='$fetch_sql[STudentID]' AND `ClassID`='$class_id[0]' AND `ExamID`='$examId[0]' AND `session`='$session' AND `subjectID`='$fetch_sub[SubjectId]'";
													$chekOld=$db->select_query($oldResutl);
													if($chekOld){
													$generate_result="REPLACE INTO `gnerate_marks` (`studentID`,`ClassID`,`GroupID`,`ExamID`,`session`,`studentRoll`,`subjectID`,`fullMarks`,`obtainMarks`,`letterGrade`,`gradePoint`) VALUES 
													('$fetch_sql[STudentID]','$class_id[0]','$fetch_sql[GroupID]','$examId[0]','$session','$fetch_sql[StudentRoll]','$fetch_sub[SubjectId]','$fetch_total[total]','$fetch_sub[obtainMark]','$fetch_sub[LetterGrade]','$fetch_sub[GradePoint]')";
														$result_generate=$db->update_query($generate_result);
													}else {
														$generate_result="INSERT INTO `gnerate_marks` (`studentID`,`ClassID`,`GroupID`,`ExamID`,`session`,`studentRoll`,`subjectID`,`fullMarks`,`obtainMarks`,`letterGrade`,`gradePoint`) VALUES 
													('$fetch_sql[STudentID]','$class_id[0]','$fetch_sql[GroupID]','$examId[0]','$session','$fetch_sql[StudentRoll]','$fetch_sub[SubjectId]','$fetch_total[total]','$fetch_sub[obtainMark]','$fetch_sub[LetterGrade]','$fetch_sub[GradePoint]')";
														$result_generate=$db->insert_query($generate_result);
													}												
														//print $generate_result;
												
												
												
										}
										}	
										
										
										
									}
							}		
							
						}
						if(isset($db->sms)){ echo $db->sms ;}
				}
				
		}
		else 
		{
		
				print "Please Enter the Limit";
		}
		
		}
		else {
			print "Please Fill Up the Fields";
		}
		
	}
	
	
	
	
	
?>