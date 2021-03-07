<?php
	//error_reporting(1);
	require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
	date_default_timezone_set("Asia/Dhaka");
	$db = new database();
			if(isset($_POST["restGen"])){
			
			$ClassId=explode('and',$_POST["ClassId"]);
		//print_r($ClassId);
		$ExamId=explode('and',$_POST["ExamId"]);
		$Session=$db->escape($_POST["Session"]);if(isset($ClassId) && $ClassId != "Select One" && isset($ExamId) && $ExamId != "Select Exam Name" && isset($Session) && !empty($Session))
		{
				$stdID=$db->escape($_POST["stdId"]);
				if(isset($stdID) and !empty($stdID)){
				
					$studenSubCnt="SELECT * FROM `gnerate_marks` WHERE `studentID`='$stdID' AND `ClassID`='$ClassId[0]' AND `ExamID`='$ExamId[0]' AND `session`='$Session'";
					
					$resulSubCnt=$db->select_query($studenSubCnt);
					if($resulSubCnt){
							while($fetchSubCount=$resulSubCnt->fetch_array()){
									$delet="DELETE FROM `result` WHERE `STD_ID`='$fetchSubCount[studentID]' AND `classId`='$fetchSubCount[ClassID]' AND `session`='$fetchSubCount[session]' AND `examId`='$fetchSubCount[ExamID]'";
								$db->delete_query($delet);
									 	$sqlCountSubject="SELECT `add_subject_info`.`subject_name`,`select_subject_type`,`gnerate_marks`.* FROM `gnerate_marks` 
INNER JOIN `add_subject_info` ON `add_subject_info`.`id`=`gnerate_marks`.`subjectID`
WHERE `gnerate_marks`.`studentID`='$fetchSubCount[studentID]' AND `gnerate_marks`.`ClassID`='$fetchSubCount[ClassID]' AND `gnerate_marks`.`ExamID`='$fetchSubCount[ExamID]' AND `gnerate_marks`.`session`='$fetchSubCount[session]'";
//print $sqlCountSubject;

										$flag=0;
										$total_sub=0;
										$total_grade=0;
										$cgpa=0;
										$withOutOp=0;
										$wopcgpa = 0;
										$failsubcount=0;
										$resultCSubje=$db->select_query($sqlCountSubject);
										if($resultCSubje){
										
											while($fetchCsub=$resultCSubje->fetch_array()){
											
												if($fetchCsub["select_subject_type"] == 'OptionalSubject')		
												{
														if($fetchCsub['gradePoint']>2)
														  $total_grade=($total_grade+($fetchCsub['gradePoint']-2));
														//print $total_grade;
												
												}else {
												
														if($fetchCsub['letterGrade']=='F')
															{
																$flag=1;
																$failsubcount=$failsubcount+1;
																 
															}
															
														
															$withOutOp=$withOutOp+$fetchCsub['gradePoint'];
															//print $withOutOp;
														
														 $total_sub++;
															$total_grade=$total_grade+$fetchCsub['gradePoint'];	
																										//print $total_grade;
												}
											
															
											
											}//2nd loop
											//print $total_grade."<br/>";
											//print $withOutOp."<br/>";
												if($total_grade>0 and $total_sub>0)
													 $cgpa=$total_grade/$total_sub;
												//print $cgpa;
													
													if($withOutOp>0 and $total_sub>0)
													$wopcgpa=$withOutOp/$total_sub;
												//print $wopcgpa;
												
												 	$wgpa=substr($wopcgpa,0,4);
													
													$wadditional=substr($wopcgpa,4,1);
													if($wadditional>=5)
													{
														$wgpa=$wgpa+0.01;
														
													}
													//print $wgpa; 
													
													
													
													$gpa=substr($cgpa,0,4);
													
													$additional=substr($cgpa,4,1);
													if($additional>=5)
													{
														$gpa=$gpa+0.01;
														
													}
													//print $gpa;
													if($flag==1)
													{
														$wgpa="0.00";
														$gpa="0.00";
													}
													if($gpa > 5.00)
													{
														$gpa = 5.00;
													
													}
													
													
													 $insertSql="INSERT INTO `result` (`STD_ID`,`std_roll`,`classId`,`GroupID`,`session`,`examId`,`CGPA`,`witoutOptional`,`totalFailSub`,`Year`) 
													VALUES('$fetchSubCount[studentID]','$fetchSubCount[studentRoll]','$fetchSubCount[ClassID]',$fetchSubCount[GroupID],'$fetchSubCount[session]','$fetchSubCount[ExamID]','$gpa','$wgpa','$failsubcount','".date('Y')."')";
													$db->insert_query($insertSql);
										}
							
							}
					
					}
					if(isset($db->sms)){echo $db->sms;}
					
				
				}else {
					print "Please Enter The Student ID";
				}	
		}else{
				print "Please Fill Up All Fields";
		}
			
			}
	
	
	?>