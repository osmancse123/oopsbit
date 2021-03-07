<?php
	error_reporting(1);
	require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
	date_default_timezone_set("Asia/Dhaka");
	$db = new database();
	
			
			
			if(isset($_POST["showdata"])){
					$selProject="SELECT * FROM `project_info`";
					$resproject=$db->select_query($selProject);
					@$counrows=$resproject->num_rows;
					if($counrows>0){
							$fetchResult=$resproject->fetch_array();
					}
					?>
						<table width="1105"  class="table table-bordered table-responsive" style=" margin-bottom:0px">
						
						   <tr>
						<td height="43" colspan="17" align="center">&nbsp;<span><strong class="text-capitalize text-success" style="font-size:16px" ><?php if(isset($fetchResult)){ echo @$fetchResult["institute_name"];} else {echo @$fetchResult["institute_name"]; }?></strong></span></td>
					  </tr>
					  <?php
					  
					  		if(!empty($_POST["selectClass"]) and $_POST["selectClass"]!="Select Class" and !empty($_POST["example1"]))
							{
									$goupid=explode('and',$_POST["selectGroup"]);
									  $dateStudent="SELECT * FROM `studentpresent` WHERE `classID`='".$_POST["selectClass"]."' AND `GroupID`='$goupid[0]'  AND `date`='".$_POST["example1"]."'";
									 $result=$db->select_query($dateStudent);
									 @$countResult=$result->num_rows;	
											if($countResult > 0)
											{
											
											$clasNameAndGroupName="SELECT `studentpresent`.`classID`,`add_class`.`class_name`,`add_group`.`group_name` FROM `studentpresent`
INNER JOIN `add_class` ON `add_class`.`id`=`studentpresent`.`classID` INNER JOIN `add_group` ON `add_group`.`id`=`studentpresent`.`GroupID`
WHERE `studentpresent`.`classID`='".$_POST["selectClass"]."' AND `GroupID`='$goupid[0]' GROUP BY `studentpresent`.`GroupID`";
											$ResultNal=$db->select_query($clasNameAndGroupName);
												if(isset($ResultNal)){
														$fetchName=$ResultNal->fetch_array();
												}
											
											
											  $ForSubjectSelect="SELECT * FROM `studentpresent` WHERE `classID`='".$_POST["selectClass"]."' AND `GroupID`='$goupid[0]' AND `date`='".$_POST["example1"]."' LIMIT 1";
											$ResultForSbuject=$db->Select_query($ForSubjectSelect);
												if(isset($ResultForSbuject)){
														$fetchOneSuject=$ResultForSbuject->fetch_array();
															if($fetchOneSuject["SubjectPartId"]=="NULL"){
															  $OneSubject=$fetchOneSuject["subjectID"];
														}else{
															 $OneSubject=$fetchOneSuject["SubjectPartId"];
														}
												}
											
											
											
											
											
											if($fetchOneSuject["SubjectPartId"]=="NULL"){
												  $studnetprest="SELECT * FROM `studentpresent` WHERE `classID`='".$_POST["selectClass"]."' and `GroupID`='$goupid[0]' and `subjectID`='$OneSubject'";
												 
												 }else{
												  $studnetprest="SELECT * FROM `studentpresent` WHERE `classID`='".$_POST["selectClass"]."' and `GroupID`='$goupid[0]' and `SubjectPartId`='$OneSubject'";
												 }
												$resultprest=$db->select_query($studnetprest);
												if(isset($resultprest)){
														$fetchresult=$resultprest->fetch_array();
														   $totalSTudent="SELECT COUNT(`student_id`) AS totalstd  FROM `running_student_info` WHERE `class_id`='".$fetchresult["classID"]."' and  `group_id`='$goupid[0]'";
														$resultStudent=$db->select_query($totalSTudent);
														if(isset($resultStudent)){
															$fetchtotalStudent=$resultStudent->fetch_array();
															$totalstd= $fetchtotalStudent[0];
															
														}
														
														
														  $totalMalestd="SELECT `running_student_info`.`class_id`,`student_personal_info`.`gender`,COUNT(`student_personal_info`.`id`)
FROM `running_student_info` INNER JOIN `student_personal_info` ON `running_student_info`.`student_id`=`student_personal_info`.`id`
WHERE `running_student_info`.`class_id`='".$_POST["selectClass"]."' AND `running_student_info`.`group_id`='$goupid[0]' AND `student_personal_info`.`gender`='Male'";
														$resultTotalmale=$db->select_query($totalMalestd);
															if(isset($resultTotalmale)){
																$fetctotmalestd=$resultTotalmale->fetch_array();
																$totalmalestd= $fetctotmalestd[2];
															}
															
															 $totalfeMalestd="SELECT `running_student_info`.`class_id`,`student_personal_info`.`gender`,COUNT(`student_personal_info`.`id`)
FROM `running_student_info` INNER JOIN `student_personal_info` ON `running_student_info`.`student_id`=`student_personal_info`.`id`
WHERE `running_student_info`.`class_id`='".$_POST["selectClass"]."'  AND `running_student_info`.`group_id`='$goupid[0]' AND `student_personal_info`.`gender`='Female'";
														$resultTotalfemale=$db->select_query($totalfeMalestd);
															if(isset($resultTotalfemale)){
																$fetctotfemalestd=$resultTotalfemale->fetch_array();
																$totalfemalestd= $fetctotfemalestd[2];
															}
													
													if($fetchOneSuject["SubjectPartId"]=="NULL"){
												 	$totalstdPresent="SELECT COUNT(`StudentID`) FROM `studentpresent` WHERE  `classID`='".$fetchresult["classID"]."' AND `GroupID`='$goupid[0]' AND `present`='1' AND `date`='".$_POST["example1"]."' and `subjectID`='$OneSubject'";
													} else {
													
													$totalstdPresent="SELECT COUNT(`StudentID`) FROM `studentpresent` WHERE  `classID`='".$fetchresult["classID"]."' AND `GroupID`='$goupid[0]' AND `present`='1' AND `date`='".$_POST["example1"]."' and `SubjectPartId`='$OneSubject'";
													}
													$resultTotalPrest=$db->select_query($totalstdPresent);
														if(isset($resultTotalPrest)){
																$fetTotalStud=$resultTotalPrest->fetch_array();
																 	$totalPreStud=$fetTotalStud[0];
																  	$makePersantage=$totalPreStud/$totalstd*100;
																		$totalPrestudpersantage=substr($makePersantage,0,5);
																		 $GetPoint=substr($makePersantage,5,1);
																		 	if($GetPoint>=5){
																			$totalPrestudpersantage=$totalPrestudpersantage+0.01;
																			
																			}
														}
														if($fetchOneSuject["SubjectPartId"]=="NULL"){
														  $totalstdabsent="SELECT COUNT(`StudentID`) FROM `studentpresent` WHERE  `classID`='".$fetchresult["classID"]."'  AND `GroupID`='$goupid[0]' AND `absent`='1'  AND `date`='".$_POST["example1"]."' and `subjectID`='$OneSubject'";}else {
														  
														    $totalstdabsent="SELECT COUNT(`StudentID`) FROM `studentpresent` WHERE  `classID`='".$fetchresult["classID"]."'  AND `GroupID`='$goupid[0]' AND `absent`='1'  AND `date`='".$_POST["example1"]."'  and `SubjectPartId`='$OneSubject'";
														  
														  }
													$resultTotalabsent=$db->select_query($totalstdabsent);
														if(isset($resultTotalabsent)){
																$fetTotalStudabsent=$resultTotalabsent->fetch_array();
																 	  $totalabsentStud=$fetTotalStudabsent[0];
																	   $MakeUnapparoved=$totalabsentStud/$totalstd*100;
																	   
																	    $totalabsentpersantage=substr($MakeUnapparoved,0,5);
																		 $getUnApprove=substr($MakeUnapparoved,5,1);
																		 	if($getUnApprove>=5){
																			$totalabsentpersantage=$totalabsentpersantage+0.01;
																			
																			}
														}
															if($fetchOneSuject["SubjectPartId"]=="NULL"){
														  $totalstdapproved="SELECT COUNT(`StudentID`) FROM `studentpresent` WHERE  `classID`='".$fetchresult["classID"]."'  AND `GroupID`='$goupid[0]' AND `onvacation`='1'  AND `date`='".$_POST["example1"]."'  and `subjectID`='$OneSubject'";}else {
														   $totalstdapproved="SELECT COUNT(`StudentID`) FROM `studentpresent` WHERE  `classID`='".$fetchresult["classID"]."'  AND `GroupID`='$goupid[0]' AND `onvacation`='1'  AND `date`='".$_POST["example1"]."'  and `SubjectPartId`='$OneSubject'";
														  
														  	}
													$resultTotalapp=$db->select_query($totalstdapproved);
														if(isset($resultTotalapp)){
																$fetTotalStudap=$resultTotalapp->fetch_array();
																 	    $totalabsentSapp=$fetTotalStudap[0];
																	    $MakeApprovePersantage=$totalabsentSapp/$totalstd*100;
																		
																		 $totalapppersantage=substr($MakeApprovePersantage,0,5);
																		 $geaPProved=substr($MakeApprovePersantage,5,1);
																		 	if($geaPProved>=5){
																			$totalapppersantage=$totalapppersantage+0.01;
																			
																			}
														}
														
													 		$TotalFullAbsent= $totalabsentStud+$totalabsentSapp;
														  	 $MakeabsentPersantage=$TotalFullAbsent/$totalstd*100;
														
															
															 $TotalFullAbsentPersantage=substr($MakeabsentPersantage,0,5);
																		 $GetabsentPoint=substr($MakeabsentPersantage,5,1);
																		 	if($GetabsentPoint>=5){
																			$TotalFullAbsentPersantage=$TotalFullAbsentPersantage+0.01;
																			
																			}
															
														
														
														if($fetchOneSuject["SubjectPartId"]=="NULL"){
												 	 	  $totalMaleSTudent="SELECT COUNT(`StudentID`),`studentpresent`.`StudentID`,`student_personal_info`.`gender` FROM `studentpresent`
INNER JOIN `student_personal_info` ON `studentpresent`.`StudentID`=`student_personal_info`.`id`
WHERE `student_personal_info`.`gender`='Male' AND `studentpresent`.`date`='".$_POST["example1"]."' AND `studentpresent`.`classID`='".$fetchresult["classID"]."' AND `studentpresent`.`GroupID`='$goupid[0]' AND `studentpresent`.`present`='1' and `studentpresent`.`subjectID`='$OneSubject'";}else{

$totalMaleSTudent="SELECT COUNT(`StudentID`),`studentpresent`.`StudentID`,`student_personal_info`.`gender` FROM `studentpresent`
INNER JOIN `student_personal_info` ON `studentpresent`.`StudentID`=`student_personal_info`.`id`
WHERE `student_personal_info`.`gender`='Male' AND `studentpresent`.`date`='".$_POST["example1"]."' AND `studentpresent`.`classID`='".$fetchresult["classID"]."' AND `studentpresent`.`GroupID`='$goupid[0]' AND `studentpresent`.`present`='1' and `studentpresent`.`SubjectPartId`='$OneSubject'";

}
												
												$resultmaleSTudentPre=$db->select_query($totalMaleSTudent);
													if(isset($resultmaleSTudentPre)){
																$fetmalStupre=$resultmaleSTudentPre->fetch_array();
																 	     $totamalePres=$fetmalStupre[0];
																	      $MakeMalePresent=$totamalePres/$totalmalestd*100;
																		  
																		  
																		   $totalMalepre=substr($MakeMalePresent,0,5);
																		 $getMalePresentPersante=substr($MakeMalePresent,5,1);
																		 	if($getMalePresentPersante>=5){
																			$totalMalepre=$totalMalepre+0.01;
																			
																			}
													}	
													
													if($fetchOneSuject["SubjectPartId"]=="NULL"){
													 $totalMalestudentAbsent="SELECT COUNT(`StudentID`),`studentpresent`.`StudentID`,`student_personal_info`.`gender` FROM `studentpresent`
INNER JOIN `student_personal_info` ON `studentpresent`.`StudentID`=`student_personal_info`.`id`
WHERE `student_personal_info`.`gender`='Male' AND `studentpresent`.`date`='".$_POST["example1"]."' AND `studentpresent`.`classID`='".$fetchresult["classID"]."' AND `studentpresent`.`GroupID`='$goupid[0]' AND `studentpresent`.`absent`='1' and `studentpresent`.`subjectID`='$OneSubject'";}else{

 $totalMalestudentAbsent="SELECT COUNT(`StudentID`),`studentpresent`.`StudentID`,`student_personal_info`.`gender` FROM `studentpresent`
INNER JOIN `student_personal_info` ON `studentpresent`.`StudentID`=`student_personal_info`.`id`
WHERE `student_personal_info`.`gender`='Male' AND `studentpresent`.`date`='".$_POST["example1"]."' AND `studentpresent`.`classID`='".$fetchresult["classID"]."' AND `studentpresent`.`GroupID`='$goupid[0]' AND `studentpresent`.`absent`='1' and `studentpresent`.`SubjectPartId`='$OneSubject'";

	}
													$resultMaleStudntabsent=$db->select_query($totalMalestudentAbsent);
														if(isset($resultMaleStudntabsent)){
																		$fetmalestAbsent=$resultMaleStudntabsent->fetch_array();
																 	      $totalmaleAbsent=$fetmalestAbsent[0];
																	        $makeMaleUnapp=$totalmaleAbsent/$totalmalestd*100;
																		   
																		   
																		   
																		   	  $totalMaleAbsentPer=substr($makeMaleUnapp,0,5);
																		 $gemalUn=substr($makeMaleUnapp,5,1);
																		 	if($gemalUn>=5){
																			$totalMaleAbsentPer=$totalMaleAbsentPer+0.01;
																			
																			}
														}
														
														
													
														
														
														
														if($fetchOneSuject["SubjectPartId"]=="NULL"){
													 	$totalMaleStudentApprovedAbsent="SELECT COUNT(`StudentID`),`studentpresent`.`StudentID`,`student_personal_info`.`gender` FROM `studentpresent`
INNER JOIN `student_personal_info` ON `studentpresent`.`StudentID`=`student_personal_info`.`id`
WHERE `student_personal_info`.`gender`='Male' AND `studentpresent`.`date`='".$_POST["example1"]."' AND `studentpresent`.`classID`='".$fetchresult["classID"]."' AND `studentpresent`.`GroupID`='$goupid[0]' AND `studentpresent`.`onvacation`='1'  and `studentpresent`.`subjectID`='$OneSubject'";}else{
	$totalMaleStudentApprovedAbsent="SELECT COUNT(`StudentID`),`studentpresent`.`StudentID`,`student_personal_info`.`gender` FROM `studentpresent`
INNER JOIN `student_personal_info` ON `studentpresent`.`StudentID`=`student_personal_info`.`id`
WHERE `student_personal_info`.`gender`='Male' AND `studentpresent`.`date`='".$_POST["example1"]."' AND `studentpresent`.`classID`='".$fetchresult["classID"]."' AND `studentpresent`.`GroupID`='$goupid[0]' AND `studentpresent`.`onvacation`='1'  and `studentpresent`.`SubjectPartId`='$OneSubject'";


}
													$resultMaleStudntApprove=$db->select_query($totalMaleStudentApprovedAbsent);
														if(isset($resultMaleStudntApprove)){
																		$MaleStudentApprovedabsent=$resultMaleStudntApprove->fetch_array();
																 	       $totalMaleStudentApprovedAbsent=$MaleStudentApprovedabsent[0];
																	        $makeMaleaApprove=$totalMaleStudentApprovedAbsent/$totalmalestd*100;
																			 
																			 
																			  $TotalMaleStudentAppPersentage=substr($makeMaleaApprove,0,5);
																		 $getMaleAbasent=substr($makeMaleaApprove,5,1);
																		 	if($getMaleAbasent>=5){
																			$TotalMaleStudentAppPersentage=$TotalMaleStudentAppPersentage+0.01;
																			
																			}
																			
														}
														
														 	$TotalMaleStudentAbsent= $totalmaleAbsent+$totalMaleStudentApprovedAbsent;
														  $MakeMaleAbsentPer=$TotalMaleStudentAbsent/$totalmalestd*100;
														 
														  $TotalMalesStudnetAbsenPersante=substr($MakeMaleAbsentPer,0,5);
																		 $geMaleABsent=substr($MakeMaleAbsentPer,5,1);
																		 	if($geMaleABsent>=5){
																			$TotalMalesStudnetAbsenPersante=$TotalMalesStudnetAbsenPersante+0.01;
																			
																			}
														 
														 
													 	
														if($fetchOneSuject["SubjectPartId"]=="NULL"){
														 $totalFemaleStudentAtendance="SELECT COUNT(`StudentID`),`studentpresent`.`StudentID`,`student_personal_info`.`gender` FROM `studentpresent`
INNER JOIN `student_personal_info` ON `studentpresent`.`StudentID`=`student_personal_info`.`id`
WHERE `student_personal_info`.`gender`='Female' AND `studentpresent`.`date`='".$_POST["example1"]."' AND `studentpresent`.`classID`='".$fetchresult["classID"]."' AND `studentpresent`.`GroupID`='$goupid[0]' AND `studentpresent`.`present`='1' and `studentpresent`.`subjectID`='$OneSubject'";}else{
 $totalFemaleStudentAtendance="SELECT COUNT(`StudentID`),`studentpresent`.`StudentID`,`student_personal_info`.`gender` FROM `studentpresent`
INNER JOIN `student_personal_info` ON `studentpresent`.`StudentID`=`student_personal_info`.`id`
WHERE `student_personal_info`.`gender`='Female' AND `studentpresent`.`date`='".$_POST["example1"]."' AND `studentpresent`.`classID`='".$fetchresult["classID"]."' AND `studentpresent`.`GroupID`='$goupid[0]' AND `studentpresent`.`present`='1'  and `studentpresent`.`SubjectPartId`='$OneSubject'";


}
														$ResultFemaleStudentAttenda=$db->select_query($totalFemaleStudentAtendance);
															if(isset($ResultFemaleStudentAttenda)){
																$fetchFEmalleSTudentATt=$ResultFemaleStudentAttenda->fetch_array();
																 $totlFemaleStudnetAtt=$fetchFEmalleSTudentATt[0];
																 $makeFemaleStudn=$totlFemaleStudnetAtt/$totalfemalestd*100;
																 
																  $totalFemaleAttenPersentage=substr($makeFemaleStudn,0,5);
																		 $getFemalStudetn=substr($makeFemaleStudn,5,1);
																		 	if($getFemalStudetn>=5){
																			$totalFemaleAttenPersentage=$totalFemaleAttenPersentage+0.01;
																			
																			}
																 
																 
																
															}
															
															if($fetchOneSuject["SubjectPartId"]=="NULL"){
														 	 $totalFEmaleStudentAbsent="SELECT COUNT(`StudentID`),`studentpresent`.`StudentID`,`student_personal_info`.`gender` FROM `studentpresent`
INNER JOIN `student_personal_info` ON `studentpresent`.`StudentID`=`student_personal_info`.`id`
WHERE `student_personal_info`.`gender`='Female' AND `studentpresent`.`date`='".$_POST["example1"]."' AND `studentpresent`.`classID`='".$fetchresult["classID"]."' AND `studentpresent`.`GroupID`='$goupid[0]' AND `studentpresent`.`absent`='1'  and `studentpresent`.`subjectID`='$OneSubject'";}else{

 $totalFEmaleStudentAbsent="SELECT COUNT(`StudentID`),`studentpresent`.`StudentID`,`student_personal_info`.`gender` FROM `studentpresent`
INNER JOIN `student_personal_info` ON `studentpresent`.`StudentID`=`student_personal_info`.`id`
WHERE `student_personal_info`.`gender`='Female' AND `studentpresent`.`date`='".$_POST["example1"]."' AND `studentpresent`.`classID`='".$fetchresult["classID"]."' AND `studentpresent`.`GroupID`='$goupid[0]' AND `studentpresent`.`absent`='1'  and `studentpresent`.`SubjectPartId`='$OneSubject'";


}
															$ResultFemaleStudentAbsent=$db->select_query($totalFEmaleStudentAbsent);
																if(isset($ResultFemaleStudentAbsent)){
																			$fetchFemaleStudentAbsent=$ResultFemaleStudentAbsent->fetch_array();
																			  $TotalFemaleSTudentAbsent=$fetchFemaleStudentAbsent[0];
																			  $makeFemaleUnapp=$TotalFemaleSTudentAbsent/$totalfemalestd*100;
																		
																		  $totalFemaleStudentAbsentPersan=substr($makeFemaleUnapp,0,5);
																		 $fetFemaleUnappr=substr($makeFemaleUnapp,5,1);
																		 	if($fetFemaleUnappr>=5){
																			$totalFemaleStudentAbsentPersan=$totalFemaleStudentAbsentPersan+0.01;
																			
																			}	  
																			  
																			  
																			  
																			  
																			  
																			  
																}
																if($fetchOneSuject["SubjectPartId"]=="NULL"){
																 $totalFemaleSutdentOnvecation="SELECT COUNT(`StudentID`),`studentpresent`.`StudentID`,`student_personal_info`.`gender` FROM `studentpresent`
INNER JOIN `student_personal_info` ON `studentpresent`.`StudentID`=`student_personal_info`.`id`
WHERE `student_personal_info`.`gender`='Female' AND `studentpresent`.`date`='".$_POST["example1"]."' AND `studentpresent`.`classID`='".$fetchresult["classID"]."' AND `studentpresent`.`GroupID`='$goupid[0]'  AND `studentpresent`.`onvacation`='1'   and `studentpresent`.`subjectID`='$OneSubject'";}else{

 $totalFemaleSutdentOnvecation="SELECT COUNT(`StudentID`),`studentpresent`.`StudentID`,`student_personal_info`.`gender` FROM `studentpresent`
INNER JOIN `student_personal_info` ON `studentpresent`.`StudentID`=`student_personal_info`.`id`
WHERE `student_personal_info`.`gender`='Female' AND `studentpresent`.`date`='".$_POST["example1"]."' AND `studentpresent`.`classID`='".$fetchresult["classID"]."' AND `studentpresent`.`GroupID`='$goupid[0]'  AND `studentpresent`.`onvacation`='1'   and `studentpresent`.`SubjectPartId`='$OneSubject'
";


}
																	$ResutlStudentOnvecation=$db->select_query($totalFemaleSutdentOnvecation);
																	
																	if(isset($ResutlStudentOnvecation)){
																				$fetchfemaleStudentOnvaction=$ResutlStudentOnvecation->fetch_array();
																				 $TotalFemaleStudentonvaction=$fetchfemaleStudentOnvaction[0];
																			 	$makfemaleApp=$TotalFemaleStudentonvaction/$totalfemalestd*100;
												
														 $TotlFemalStudnetVacationPersantage=substr($makfemaleApp,0,5);
																		 $getFeamleapp=substr($makfemaleApp,5,1);
																		 	if($getFeamleapp>=5){
																			$TotlFemalStudnetVacationPersantage=$TotlFemalStudnetVacationPersantage+0.01;
																			
																			}
												
												
												
												
												
												
												
																	}
																	
																	 $TotaFemaleStudentAbsent= $TotalFemaleSTudentAbsent+$TotalFemaleStudentonvaction;
																	 $makeFemaleAbsent=$TotaFemaleStudentAbsent/$totalfemalestd*100;
																	 
																	  $TotalFemaleStudentAbsentPersantage=substr($makeFemaleAbsent,0,5);
																		 $getFEmaleAbsent=substr($makeFemaleAbsent,5,1);
																		 	if($getFEmaleAbsent>=5){
																			$TotalFemaleStudentAbsentPersantage=$TotalFemaleStudentAbsentPersantage+0.01;
																			
																			}
													
												}
												  
					  ?>
									<tr>
										<td colspan="13" align="center">&nbsp;<span class="text-success" style="font-size:15px;"><strong>Student's in   attendance on the <?php echo $_POST["example1"]?>  date.</strong></span></td>
									</tr>
									<tr>
										<td colspan="13" align="center">&nbsp;<span class="text-success" style="font-size:14px;"><strong>Class Name&nbsp;:&nbsp;<?php if(isset($ResultNal)){ echo $fetchName[1] ;} else {echo "";} ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Group Name&nbsp;:&nbsp;<?php if(isset($ResultNal)){ echo  $fetchName[2];} else {echo "";} ?></strong></span></td>
									</tr>
									<tr>
											<td colspan="13" align="center">&nbsp;<span class="text-danger" style="font-size:15px;"><strong>Total Student's &nbsp;: &nbsp;<?php if($resultStudent){?>(<?php echo $totalstd;?>)<?php } ?>
											<br/>
											( &nbsp;Male :&nbsp;<?php if($resultStudent){ echo $totalmalestd; }  ?>&nbsp;&nbsp;&nbsp;Female :&nbsp;<?php if($resultTotalfemale){ echo $totalfemalestd; } ?> )
											</strong></span></td>
									</tr>
									<tr>
										<td colspan="6" align="center">&nbsp;<span class="text-success" style="font-size:15px;"><strong>Total Student's in   Attendance  &nbsp;</strong></span></td>
										<td  colspan="7" align="center">&nbsp;<span class="text-danger" style="font-size:15px;"><strong>Total Student's in   Absent   &nbsp;</strong></span></td>
  </tr>
									<tr>
											<td width="184"  height="21" align="center"><span class="text-success" style="font-weight:600">Total Attendance</span></td>
											<td colspan="5"  align="left"><span class="text-success" style="font-weight:600"><?php if(isset($resultTotalPrest)){ echo $totalPreStud;} else {echo "";}?>
											</span></td>
											<td width="184" align="center"><span class="text-danger" style="font-weight:600">Total Absent</span></td>
											<td colspan="2"  align="left"><span class="text-danger" style="font-weight:600"><?php if(isset($TotalFullAbsent)){ echo $TotalFullAbsent;} else {echo "";}?></span></td>
											<td colspan="2"  align="left"><span class="text-danger" style="font-weight:600">Percentage</span></td>
											<td width="141"  align="left"><span class="text-danger" style="font-weight:600"><?php if(isset($TotalFullAbsentPersantage)){ echo $TotalFullAbsentPersantage;} else {echo "";}?>%</span></td>
									</tr>
									<tr>
											<td height="22"  align="center"><span class="text-success" style="font-weight:600">Percentage</span></td>
											<td colspan="5"  align="left"><span class="text-success" style="font-weight:600"><?php if(isset($resultTotalPrest)){ echo $totalPrestudpersantage;} else {echo "";}?>%</span></td>
											<td  align="center"><span class="text-danger" style="font-weight:600">Approved</span></td>
											<td colspan="2"><span class="text-danger" style="font-weight:600">
											
											<?php if(isset($resultTotalapp)){ echo $totalabsentSapp.'&nbsp;('.$totalapppersantage.'% )';} else {echo "";}?></span></td>
											<td colspan="2"><span class="text-danger" style="font-weight:600">Un Approved</span></td>
											<td><span class="text-danger" style="font-weight:600"><?php if(isset($resultTotalabsent)){ echo $totalabsentStud.'&nbsp;('.$totalabsentpersantage.'%)';} else {echo "";}?></span></td>
									</tr>

									</tr>
									
									
									<tr>
										<td colspan="6" align="center">&nbsp;<span class="text-success" style="font-size:15px;"><strong>Total Male Student's in   Attendance  &nbsp;</strong></span></td>
										<td  colspan="7" align="center">&nbsp;<span class="text-success" style="font-size:15px;"><strong>Total Female Student's in   Absent   &nbsp;</strong></span></td>
  </tr>
									<tr>
											<td width="184" rowspan="2"  align="center"><br/>
								      <span class="text-success" style="font-weight:600">Total Attendance</span></td>
												
											<td width="17" rowspan="2"  align="left"><br/>
											  <span class="text-success" style="font-weight:600">
											  <?php if(isset($resultmaleSTudentPre)){ echo $totamalePres."&nbsp;(".$totalMalepre."%)";} else { echo "";}?>
									  </span></td>
											<td height="21" colspan="2"  align="left"><span class="text-danger" style="font-weight:600"> &nbsp;<br/>Total Absent</span></td>
									  <td  align="left" colspan="2"><br/>
									  	<span class="text-danger" style="font-weight:600">
											  <?php if(isset($TotalMaleStudentAbsent)){ echo $TotalMaleStudentAbsent."&nbsp;(".$TotalMalesStudnetAbsenPersante."%)";} else { echo "";}?>
                                        </span>									  </td>
											<td width="184" rowspan="2"  align="center"><span class="text-success" style="font-weight:600; padding-top:50px;"><br/>
										    Total Attendance</span></td>
											<td width="31" rowspan="2"  align="left"><br/>
											  <span class="text-success" style="font-weight:600">
											  <?php if(isset($ResultFemaleStudentAttenda)){ echo $totlFemaleStudnetAtt."&nbsp;(".$totalFemaleAttenPersentage."%)";} else { echo "";}?>
                                        </span>	</td>
											<td colspan="2"  align="center"><span class="text-danger" style="font-weight:600">Total Absent</span></td>
											<td colspan="2"  align="left"><span class="text-danger" style="font-weight:600">
											  <?php if(isset($TotaFemaleStudentAbsent)){ echo $TotaFemaleStudentAbsent."&nbsp;(".$TotalFemaleStudentAbsentPersantage."%)";} else { echo "";}?>
                                        </span>	</td>
									</tr>
									<tr>
											<td width="65" height="21"  align="left"><span class="text-danger" style="font-weight:600">Approved</span></td>
											<td width="39"  align="left"><span class="text-danger" style="font-weight:600">
											  <?php if(isset($resultMaleStudntApprove)){ echo $totalMaleStudentApprovedAbsent."&nbsp;(".$TotalMaleStudentAppPersentage."%)";} else { echo "";}?>
                                        </span>	</td>
											<td width="103"  align="left"><span class="text-danger" style="font-weight:600">Unapproved</span></td>
											<td width="59"  align="left"><span class="text-danger" style="font-weight:600">
											  <?php if(isset($resultMaleStudntabsent)){ echo $totalmaleAbsent."&nbsp;(".$totalMaleAbsentPer."%)";} else { echo "";}?>
                                        </span>		</td>
											<td width="103"  align="center"><span class="text-danger" style="font-weight:600">Approved</span></td>
											<td width="46"  align="center"><span class="text-danger" style="font-weight:600">
											  <?php if(isset($ResutlStudentOnvecation)){ echo $TotalFemaleStudentonvaction."&nbsp;(".$TotlFemalStudnetVacationPersantage."%)";} else { echo "";}?>
                                        </span> </td>
											<td width="81"><span class="text-danger" style="font-weight:600">Unapproved</span></td>
											<td><span class="text-danger" style="font-weight:600">
											  <?php if(isset($ResultFemaleStudentAbsent)){ echo $TotalFemaleSTudentAbsent."&nbsp;(".$totalFemaleStudentAbsentPersan."%)";} else { echo "";}?>
                                        </span>	</td>
									</tr>
									
									
									<?php } else {?>
									  <tr>
							<td colspan="13" align="center">&nbsp;<span class="text-danger" style="font-size:15px;"><strong>There wasn't  the attendance of the day...</strong></span></td>
						  </tr>
									
									<?php } ?>
						  
						  <?php } else {?>
						   <tr>
							<td colspan="13" align="center">&nbsp;<span class="text-danger" style="font-size:15px;"><strong>Please Fill Up All fields...</strong></span></td>
						  </tr>
						  
						  <?php } ?>
						  <tr id="trNotprint">
							<td colspan="13" align="center">&nbsp;<input type="submit" value="Print" onclick="window.print()"/></td>
						  </tr>
						  </table>
					<?php
			}

?>