<?php
	error_reporting(1);
	require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
	$db = new database();
	
	
	$className =explode('and',$_POST["className"]);
	$groupname = explode('and',$_POST["groupname"]);
	$examtype = explode('and',$_POST["examtype"]);
	$subject_type = $_POST["subject_type"];
	$sub_name = $_POST["sub_name"];
	$part_name = $_POST["part_name"];

		
	if($part_name!= "NULL")
	{
		$part = explode('and',$_POST["part_name"]); 
		$part_name=$part[0];
		
	}

	$session=$_POST["session"];
	$toss = $_POST["toss"];
	$fromss =$_POST["fromss"];

	$section=$_POST["section"];

if($section!= "NULL")
	{
		$sectionName = explode('and',$section); 
		$section=$sectionName[0];
		
	}

	//print $className[0].$groupname[0].$examtype[0].$subject_type.$sub_name.$part_name;
	
	if($className[1]=='Play' || $className[1]=='Nursery' || $className[1]=='K.G' || $className[1]=='One' || $className[1]=='Two' || $className[1]=='Three' || $className[1]=='Four' || $className[1]=='Five' || $className[1]=='Six' || $className[1]=='Seven' || $className[1]=='play' || $className[1]=='nursery' || $className[1]=='k.g' || $className[1]=='one' || $className[1]=='two' || $className[1]=='three' || $className[1]=='four' || $className[1]=='five' || $className[1]=='six' || $className[1]=='seven' || $className[1]=='Eight' || $className[1]=='eight'){
	
	
	
	if($part_name != "NULL")
	{

		$AddMarks ="SELECT `subject_information`.*,`add_class`.`class_name`,`add_group`.`group_name`,`add_subject_info`.`subject_name`,`select_subject_type`,`subject_code`,`add_subject_part_info`.`subject_part_name`,`subject_part_code`,`exam_type_info`.`exam_type` FROM `subject_information` JOIN `add_class` ON `add_class`.`id`=`subject_information`.`classID` JOIN `add_group` ON `add_group`.`id`=`subject_information`.`groupID` JOIN `add_subject_info` ON `add_subject_info`.`id`=`subject_information`.`subjectId`
JOIN  `add_subject_part_info` ON `add_subject_part_info`.`part_id`=`subject_information`.`subPartId` JOIN `exam_type_info` ON `exam_type_info`.`exam_id`=`subject_information`.`examID` WHERE `subject_information`.`classID`='$className[0]'
AND `subject_information`.`groupID`='$groupname[0]' AND `subject_information`.`examID`='$examtype[0]' AND `subject_information`.`subjectId`='$sub_name' AND `subject_information`.`subPartId`='$part_name'";

		//print_r($AddMarks);
		$chek_All = $db->select_query($AddMarks);
		if($chek_All){
			$fetch_All=$chek_All->fetch_array();
			//print_r($fetch_All);
			//print"dd";
		}
	}
	else 
	{
			$AddMarks="SELECT `subject_information`.*,`add_class`.`class_name`,`add_group`.`group_name`,`add_subject_info`.`subject_name`,`select_subject_type`,`subject_code`,`exam_type_info`.`exam_type`
FROM `subject_information` JOIN `add_class` ON `add_class`.`id`=`subject_information`.`classID` JOIN `add_group` ON `add_group`.`id`=`subject_information`.`groupID` JOIN `add_subject_info` ON `add_subject_info`.`id`=`subject_information`.`subjectId` JOIN `exam_type_info` ON `exam_type_info`.`exam_id`=`subject_information`.`examID` WHERE `subject_information`.`classID`='$className[0]' AND `subject_information`.`groupID`='$groupname[0]' AND `subject_information`.`examID`='$examtype[0]' AND `subject_information`.`subjectId`='$sub_name'";
		$chek_All = $db->select_query($AddMarks);
		if($chek_All){
		$fetch_All=$chek_All->fetch_array();
			//print_r($fetch_All);
			//print"dd";
		}
	}	
?>

<table class="table table-responsive table-reflow table-bordered table-hover" style="margin-top:20px;">
          
		    <tr>
              <td class="bg-info" colspan="8"><input type="button" name="back" id="back" value="BACK" onclick="return ShowBack()" class="btn btn-sm btn-danger" /><STRONG><span class="text-success text-uppercase" style="font-weight: bold; padding-left:120px;  font-size: 18px; font-family:inherit; letter-spacing: 1px;">Add <?php echo  $fetch_All["exam_type"]; ?>  &nbsp; Marks At &nbsp;<?php echo $fetch_All["class_name"];?> &nbsp; In <?php echo $fetch_All["subject_name"];?></span></STRONG></td>
            </tr>
				 <tr>
              <td colspan="8" class="bg-success" align="center"><span class="text-warning"><strong>Examination Type : &nbsp; <?php echo  $fetch_All["exam_type"]; ?></span></strong></td>
            </tr>
			  <tr>
					  <td
						 colspan="2"><strong><span class="text-success" style="font-size: 15px;"> Class Name</span></strong></td>
                        <td colspan="6">
							<div class="col-md-6">
							<input type="hidden" name="exType" id="exType" value="<?php echo $fetch_All["examID"]; ?>" />
							<select class="form-control" name="CLiD" id="CLiD" READONLY style="width:280px; border-radius:0px;">
								<option  value="<?php echo "$fetch_All[classID]and$fetch_All[class_name]" ?>"><?php echo $fetch_All["class_name"];?></option>
							</select>
							</div>
						</td>
               </tr>
			   	<tr>
                        <td colspan="2"><strong><span class="text-success" style="font-size: 15px;"> Group Name</span></strong></td>
                        <td colspan="6"><div class="col-md-6">
									<select class="form-control" name="GRid" id="GRid" READONLY style="width:280px; border-radius:0px;">
                           <option  value="<?php echo "$fetch_All[groupID]and$fetch_All[group_name]" ?>"><?php echo $fetch_All["group_name"];?></option>
                        			</select>
						</div></td>
                    </tr>
				 	<tr>
                        <td colspan="2"><strong><span class="text-success" style="font-size: 15px;">Subject Type</span></strong></td>
                        <td colspan="6"><div class="col-md-6"><select class="form-control" name="subTy" id="subTy" READONLY style="width:280px; border-radius:0px;">
                           <option  value="<?php echo "$fetch_All[subjectId]" ?>"><?php echo $fetch_All["select_subject_type"];?></option>
                        </select></div></td>
                    </tr>
					<tr>
                        <td colspan="2"><strong><span class="text-success" style="font-size: 15px;">Subject Name</span></strong></td>
                        <td colspan="6"><div class="col-md-6"><select class="form-control" name="subNa" id="subNa" READONLY style="width:280px; border-radius:0px;">
                            <option  value="<?php echo "$fetch_All[subjectId]" ?>"><?php echo $fetch_All["subject_name"];?></option>
                        </select></div></td>
                    </tr>
					<tr>
                        <td colspan="2"><strong><span class="text-success" style="font-size: 15px;">Subject Code</span></strong></td>
                        <td colspan="6"><div class="col-md-6"><select class="form-control" name="subCo" id="subCo" READONLY style="width:280px; border-radius:0px;"> <option  value="<?php echo "$fetch_All[subjectId]" ?>"><?php echo $fetch_All["subject_code"];?></option>
                           	
                        </select></div></td>
                    </tr>
					<tr>
                        <td colspan="2"><strong><span class="text-success" style="font-size: 15px;">Subject Part Name</span></strong></td>
                        <td colspan="6"><div class="col-md-6"><select class="form-control" name="subPna" id="subPna" READONLY style="width:280px; border-radius:0px;">
                           <option  value="<?php echo "$fetch_All[subPartId]" ?>"><?php echo $fetch_All["subject_part_name"];?></option>
                        </select></div></td>
                    </tr>
					<tr>
                        <td colspan="2"><strong><span class="text-success" style="font-size: 15px;">Subject Part Code</span></strong></td>
                        <td colspan="6"><div class="col-md-6"><select class="form-control" name="subPaC" id="subPaC" READONLY style="width:280px; border-radius:0px;">
						 <option  value="<?php echo "$fetch_All[subPartId]" ?>"><?php echo $fetch_All["subject_part_code"];?></option>
                           
                        </select></div></td>
                    </tr>
					<tr>
                        <td colspan="2"><strong><span class="text-success" style="font-size: 15px;">Session</span></strong></td>
                        <td colspan="6"><div class="col-md-6"><select class="form-control" name="seSs" id="seSs" READONLY style="width:280px; border-radius:0px;"><option  value="<?php echo $session; ?>"><?php echo $session;?></option>
                           
                        </select></div></td>
                    </tr>	
                    <tr>
                        <td colspan="2"><strong><span class="text-success" style="font-size: 15px;">Section</span></strong></td>
                        <td colspan="6"><div class="col-md-6"><select class="form-control" name="section" id="section" READONLY style="width:280px; border-radius:0px;"><option  value="<?php echo $sectionName[1]; ?>"><?php echo $sectionName[1];?></option>
                           
                        </select></div></td>
                    </tr>
</table>
<br>
<table class="table table-responsive table-bordered table-hover" style="margin-top: -20px">
            
            <tr>
              <td colspan="10" align="center"><label for="from" class="text-warning">Roll No -</label>
                <input type="text"  name="from" id="from" value="<?php echo $fromss ?>"   style="width:120px; background:#F7071D; border:none; font-weight:bold; color:#fff; height:25px;  text-align:center;">
-
<label for="to" class="text-warning">To Roll No - </label>
<input type="text" name="to" id="to" value="<?php  echo $toss;?>"  style="width:120px; background:#F7071D; border:none; font-weight:bold; color:#fff; height:25px;
text-align:center;"/>

<input type='button'  onClick="return showChekTo()" class='btn btn-success btn-sm' value='Search' />

</td>
            </tr>



			<tr>
              <td width="5%" rowspan="2" align="center">&nbsp;<strong><span class="text-justify text-danger">SL NO</span></strong></td>
              <td width="12%" rowspan="2" align="center">&nbsp;<strong><span class="text-justify text-danger">Name</span></td>
              <td width="11%" rowspan="2" align="center">&nbsp;<strong><span class="text-justify text-danger">Student Roll</span></td>
              <td width="10%" rowspan="2" align="center">&nbsp;<strong><span class="text-justify text-danger">Full Mark</span></td>
              <td colspan="4" align="center">&nbsp;<strong><span class="text-justify text-danger">Marks</span></td>
              <td width="9%" rowspan="2" align="center">&nbsp;<strong><span class="text-justify text-danger">Obtain Marks</span></td>
              <td width="9%" rowspan="2" align="center">&nbsp;<strong><span class="text-justify text-danger">Letter Grade</span></td>
            </tr>
            <tr>
              <td width="11%" align="center">&nbsp;<strong><span class="text-justify text-danger">Cont. Asses. </span></td>
              <td width="11%" align="center">&nbsp;<strong><span class="text-justify text-danger">Creative</span></td>
              <td width="10%" align="center">&nbsp;<strong><span class="text-justify text-danger">MCQ</span></td>
              <td width="11%" align="center">&nbsp;<strong><span class="text-justify text-danger">Parctical</span></td>
              
            </tr>
		
			<?php
					if($part_name == "NULL"){
						
							if(!empty($fromss) and !empty($toss)){
							//print "coll";
								
					
							
								 $showAll="SELECT `running_student_info`.*,`subject_registration_table`.`subject_id`,`student_personal_info`.`student_name`,`subject_information`.`subjectId`,`ContAss`,`Creative`,`MCQ`,`practical`,`total`,
	`student_acadamic_information`.`session2` FROM `running_student_info` JOIN `subject_registration_table` ON `subject_registration_table`.`std_id`=`running_student_info`.`student_id`
	JOIN `student_personal_info` ON `student_personal_info`.`id`=`running_student_info`.`student_id` JOIN `subject_information` ON `subject_information`.`subjectId`=`subject_registration_table`.`subject_id`
	JOIN `student_acadamic_information` ON `student_acadamic_information`.`id`=`running_student_info`.`student_id` WHERE `running_student_info`.`class_id`='$className[0]' AND `running_student_info`.`section_id`='$section' AND `running_student_info`.`group_id`='$groupname[0]' AND `subject_registration_table`.`subject_id`='$sub_name' AND `subject_information`.`examID`='$examtype[0]' AND `subject_information`.`subjectId`='$sub_name'  AND `student_acadamic_information`.`session2`='$session' AND `running_student_info`.`class_roll` 
	BETWEEN $fromss AND $toss GROUP BY `running_student_info`.`student_id`  ORDER BY `running_student_info`.`class_roll` ASC";
//print $showAll;
						$chek_all=$db->select_query($showAll);
							
							}
							else 
							
							{
							 $showAll="SELECT `running_student_info`.*,`subject_registration_table`.`subject_id`,`student_personal_info`.`student_name`,`subject_information`.`subjectId`,`ContAss`,`Creative`,`MCQ`,`practical`,`total`,
`student_acadamic_information`.`session2` FROM `running_student_info` JOIN `subject_registration_table` ON `subject_registration_table`.`std_id`=`running_student_info`.`student_id`
JOIN `student_personal_info` ON `student_personal_info`.`id`=`running_student_info`.`student_id` JOIN `subject_information` ON `subject_information`.`subjectId`=`subject_registration_table`.`subject_id`
JOIN `student_acadamic_information` ON `student_acadamic_information`.`id`=`running_student_info`.`student_id` WHERE `running_student_info`.`class_id`='$className[0]' AND `running_student_info`.`section_id`='$section' AND `running_student_info`.`group_id`='$groupname[0]' AND `subject_registration_table`.`subject_id`='$sub_name' AND `subject_information`.`examID`='$examtype[0]' AND `subject_information`.`subjectId`='$sub_name'  AND `student_acadamic_information`.`session2`='$session'
GROUP BY `running_student_info`.`student_id` ORDER BY `running_student_info`.`class_roll` ";
						$chek_all=$db->select_query($showAll);


						}
					
					}else{
					if(!empty($fromss) and !empty($toss)){
					//print "done";
						 $showAll="SELECT `running_student_info`.*,`subject_registration_table`.`subject_id`,`student_personal_info`.`student_name`,`subject_information`.`subjectId`,`subPartId`,`ContAss`,`Creative`,`MCQ`,`practical`,`total`,
`student_acadamic_information`.`session2` FROM `running_student_info` JOIN `subject_registration_table` ON `subject_registration_table`.`std_id`=`running_student_info`.`student_id`
JOIN `student_personal_info` ON `student_personal_info`.`id`=`running_student_info`.`student_id` JOIN `subject_information` ON `subject_information`.`subjectId`=`subject_registration_table`.`subject_id`
JOIN `student_acadamic_information` ON `student_acadamic_information`.`id`=`running_student_info`.`student_id` WHERE `running_student_info`.`class_id`='$className[0]' AND `running_student_info`.`section_id`='$section' AND `running_student_info`.`group_id`='$groupname[0]' AND `subject_registration_table`.`subject_id`='$sub_name' AND `subject_information`.`examID`='$examtype[0]' AND `subject_information`.`subjectId`='$sub_name' AND `subject_information`.`subPartId`='$part_name'  AND `student_acadamic_information`.`session2`='$session' AND `running_student_info`.`class_roll` BETWEEN $fromss AND $toss GROUP BY `running_student_info`.`student_id` ORDER BY `running_student_info`.`class_roll` ASC";
	$chek_all=$db->select_query($showAll);
	//print_r()
							
							}
							else 
							
							{
						 $showAll="SELECT `running_student_info`.*,`subject_registration_table`.`subject_id`,`student_personal_info`.`student_name`,`subject_information`.`subjectId`,`subPartId`,`ContAss`,`Creative`,`MCQ`,`practical`,`total`,
`student_acadamic_information`.`session2` FROM `running_student_info` JOIN `subject_registration_table` ON `subject_registration_table`.`std_id`=`running_student_info`.`student_id`
JOIN `student_personal_info` ON `student_personal_info`.`id`=`running_student_info`.`student_id` JOIN `subject_information` ON `subject_information`.`subjectId`=`subject_registration_table`.`subject_id`
JOIN `student_acadamic_information` ON `student_acadamic_information`.`id`=`running_student_info`.`student_id` WHERE `running_student_info`.`class_id`='$className[0]' AND `running_student_info`.`section_id`='$section'
AND `running_student_info`.`group_id`='$groupname[0]' AND `subject_registration_table`.`subject_id`='$sub_name' AND `subject_information`.`examID`='$examtype[0]' AND `subject_information`.`subjectId`='$sub_name' AND `subject_information`.`subPartId`='$part_name'  AND `student_acadamic_information`.`session2`='$session'
GROUP BY `running_student_info`.`student_id` ORDER BY `running_student_info`.`class_roll` ASC LIMIT 0,80";
	$chek_all=$db->select_query($showAll);
	}
					}
					if($chek_all){
					$sl=0;
					global $count;
					$count=0;
					while($fetch_show_alll=$chek_all->fetch_array()){
					//print_r($fetch_show_alll);
							if($part_name == "NULL"){
							  $fetchOldRecord ="SELECT `Count_Ass`,`Creative`,`Mcq`,`Practical`,`obtainMark`,`LetterGrade`,`GradePoint` FROM `marksheet` WHERE `STudentID`='".$fetch_show_alll["student_id"]."' AND 
`StudentRoll`='".$fetch_show_alll["class_roll"]."' AND `ClassId`='".$fetch_show_alll["class_id"]."' AND `GroupID`='".$fetch_show_alll["group_id"]."'  AND `SubjectId`='".$fetch_show_alll["subject_id"]."' AND `ExamId` ='".$examtype[0]."'";
							
							}else {
								  $fetchOldRecord ="SELECT `Count_Ass`,`Creative`,`Mcq`,`Practical`,`obtainMark`,`LetterGrade`,`GradePoint` FROM `marksheet` WHERE `STudentID`='".$fetch_show_alll["student_id"]."' AND 
`StudentRoll`='".$fetch_show_alll["class_roll"]."' AND `ClassId`='".$fetch_show_alll["class_id"]."' AND `GroupID`='".$fetch_show_alll["group_id"]."'  AND `SubjectId`='".$fetch_show_alll["subject_id"]."' AND `SubjectPartID`='".$fetch_show_alll["subPartId"]."' AND `ExamId` ='".$examtype[0]."'";
							}
							$resultOldrecor=$db->select_query($fetchOldRecord);
							if($resultOldrecor){
								$fetoldrec=$resultOldrecor->fetch_array();
								
							}else{
								
								$fetoldrec["Count_Ass"] ="";
								$fetoldrec["Creative"] ="";
								$fetoldrec["Mcq"] ="";
								$fetoldrec["Practical"] ="";
								$fetoldrec["obtainMark"] ="";
								$fetoldrec["LetterGrade"] ="";
							}
						
			$sl++;
			$count++;
			
			?>
			
			<tr>
                        <td align="center"><strong><span class="text-success"><?php  echo $sl;?></span></strong>
                        <input type="hidden" name="stdid[]" id="stdid[]" value="<?php  echo $fetch_show_alll["student_id"];?>" ></input>
                        </td>
                         <td align="center"><strong><span class="text-success"><?php  echo $fetch_show_alll["student_name"];?></span></strong>
                       
                        </td>
                         <td align="center"><strong><span class="text-success"><?php echo $fetch_show_alll["class_roll"];?></span></strong>
                        <input type="hidden" name="stdrole[]" id="stdrole[]" value="<?php  echo $fetch_show_alll["class_roll"];?>"></input>
                        </td>
                        <td align="center"><strong><span class="text-success"><?php  echo $fetch_show_alll["total"]; ?></span></strong>
                        <input type="hidden" name="fullmark[]" id="fullmark-<?php  echo $sl;?>" value="<?php  echo $fetch_show_alll["total"];?>" ></input>
                        </td>
                        <td align="center">
                          <input type="text" style="width: 70px; border-radius:0px; text-align:center" autocomplete="off" onkeyup="calculaten(<?php  echo $sl;?>)"   class="form-control" name="counAssMark[]" id="counAssMark-<?php  echo $sl;?>" value="<?php echo $fetoldrec["Count_Ass"];?>"  placeholder="<?php echo $fetch_show_alll["ContAss"];?>"></input>
                          <input type="hidden" name="counAss[]" id="counAss-<?php  echo $sl;?>" value="<?php echo $fetch_show_alll["ContAss"];?>"></input>
                        </td>
                        <td align="center">
                          <input type="text" style="width: 70px; border-radius:0px; text-align:center"  autocomplete="off" onkeyup="calculaten(<?php  echo $sl;?>)" class="form-control" name="CreaTiveMark[]" id="CreaTiveMark-<?php  echo $sl;?>" placeholder="<?php echo $fetch_show_alll["Creative"];?>"  value="<?php echo $fetoldrec["Creative"];?>" ></input>
                          <input type="hidden" name="Creative[]" id="Creative-<?php  echo $sl;?>" value="<?php echo $fetch_show_alll["Creative"];?>"></input>
                        </td>
                         <td align="center">
                          <input type="text" style="width: 70px; border-radius:0px; text-align:center"  autocomplete="off" onkeyup="calculaten(<?php  echo $sl;?>)" class="form-control" name="MeqMark[]" id="MeqMark-<?php  echo $sl;?>" placeholder="<?php echo $fetch_show_alll["MCQ"];?>"  value="<?php echo $fetoldrec["Mcq"];?>" ></input>
                          <input type="hidden" name="Mcq[]" id="Mcq-<?php  echo $sl;?>" value="<?php echo $fetch_show_alll["MCQ"];?>"></input>
                        </td>
                         <td align="center">
                          <input type="text" style="width: 70px; border-radius:0px; text-align:center" autocomplete="off" onkeyup="calculaten(<?php  echo $sl;?>)"  class="form-control" name="practicalMark[]" id="practicalMark-<?php  echo $sl;?>" placeholder="<?php echo $fetch_show_alll["practical"];?>"  value="<?php echo $fetoldrec["Practical"];?>" ></input>
                          <input type="hidden" name="practical[]" id="practical-<?php  echo $sl;?>" value="<?php echo $fetch_show_alll["practical"];?>"></input>
                        </td>
                        <td><input  type="text" readonly="" name="obtainmark[]" id="obtainmark-<?php  echo $sl;?>" class="form-control" style="width: 70px; border-radius:0px; text-align:center"  value="<?php echo $fetoldrec["obtainMark"];?>"   ></input></td>
                        <td><input type="text"  readonly="" name="lettergrade[]" id="lettergrade-<?php  echo $sl;?>" class="form-control" style="width: 70px; border-radius:0px; text-align:center"  value="<?php echo $fetoldrec["LetterGrade"];?>" ></input></td>
                        
                      </tr>
					  <?php } } ?>
					  <tr>
					   <?php if($count==0){?>
				 <tr><td colspan="11">	<span class="text-danger" style="font-size:18px"><strong><a href='#' onclick='return GoBackPage()'>No Student Have Found,Go Back</a></strong></span></td></tr>
				 <?php } ?>
			
			
			<tr>
                <td class="danger" colspan="10" bgcolor="#dddddd" align="center"><span id="sms">
                    
                </span> </td>
            </tr>
				 <tr>
				  <td colspan="10"  align="center">
				  <input type="hidden" value="<?php echo $count ;?>" id="countValue" />
				  <input type="button" name="add" value="SAVE" class="btn btn-success btn-sm" style="width: 80px;" onclick="return AddMarksheet()"></input>
     
                  <input type="reset" name="reset"  value="RELOAD" class="btn btn-danger btn-sm"   style="width: 100px;"style="width: 80px;" onclick="return alreset()"></input>
                 </td>
			 </tr>
		
</table>




<?php } else { 
	
	if($part_name != "NULL")
	{
		$AddMarks ="SELECT `subject_information`.*,`add_class`.`class_name`,`add_group`.`group_name`,`add_subject_info`.`subject_name`,`select_subject_type`,`subject_code`,`add_subject_part_info`.`subject_part_name`,`subject_part_code`,`exam_type_info`.`exam_type` FROM `subject_information` JOIN `add_class` ON `add_class`.`id`=`subject_information`.`classID` JOIN `add_group` ON `add_group`.`id`=`subject_information`.`groupID` JOIN `add_subject_info` ON `add_subject_info`.`id`=`subject_information`.`subjectId`
JOIN  `add_subject_part_info` ON `add_subject_part_info`.`part_id`=`subject_information`.`subPartId` JOIN `exam_type_info` ON `exam_type_info`.`exam_id`=`subject_information`.`examID` WHERE `subject_information`.`classID`='$className[0]'
AND `subject_information`.`groupID`='$groupname[0]' AND `subject_information`.`examID`='$examtype[0]' AND `subject_information`.`subjectId`='$sub_name' AND `subject_information`.`subPartId`='$part_name'";
		//print_r($AddMarks);
		$chek_All = $db->select_query($AddMarks);
		if($chek_All){
			$fetch_All=$chek_All->fetch_array();
			//print_r($fetch_All);
			//print"dd";
		}
	}
	else 
	{
			$AddMarks="SELECT `subject_information`.*,`add_class`.`class_name`,`add_group`.`group_name`,`add_subject_info`.`subject_name`,`select_subject_type`,`subject_code`,`exam_type_info`.`exam_type`
FROM `subject_information` JOIN `add_class` ON `add_class`.`id`=`subject_information`.`classID` JOIN `add_group` ON `add_group`.`id`=`subject_information`.`groupID` JOIN `add_subject_info` ON `add_subject_info`.`id`=`subject_information`.`subjectId` JOIN `exam_type_info` ON `exam_type_info`.`exam_id`=`subject_information`.`examID` 
WHERE `subject_information`.`classID`='$className[0]' AND `subject_information`.`groupID`='$groupname[0]' AND `subject_information`.`examID`='$examtype[0]' AND `subject_information`.`subjectId`='$sub_name'";
		$chek_All = $db->select_query($AddMarks);
		if($chek_All){
		$fetch_All=$chek_All->fetch_array();
			//print_r($fetch_All);
		//	print"dd";
		}
	}	
?>

<table class="table table-responsive table-reflow table-bordered table-hover" style="margin-top:20px;">
          
		    <tr>
              <td class="bg-info" colspan="8"><input type="button" name="back" id="back" value="BACK" onclick="return ShowBack()" class="btn btn-sm btn-danger" /><STRONG><span class="text-success text-uppercase" style="font-weight: bold; padding-left:120px;  font-size: 18px; font-family:inherit; letter-spacing: 1px;">Add <?php echo  $fetch_All["exam_type"]; ?>  &nbsp; Marks At &nbsp;<?php echo $fetch_All["class_name"];?> &nbsp; In <?php echo $fetch_All["subject_name"];?></span></STRONG></td>
            </tr>
				 <tr>
              <td colspan="8" class="bg-success" align="center"><span class="text-warning"><strong>Examination Type : &nbsp; <?php echo  $fetch_All["exam_type"]; ?></span></strong></td>
            </tr>
			  <tr>
					  <td
						 colspan="2"><strong><span class="text-success" style="font-size: 15px;"> Class Name</span></strong></td>
                        <td colspan="6">
							<div class="col-md-6">
							<input type="hidden" name="exType" id="exType" value="<?php echo $fetch_All["examID"]; ?>" />
							<select class="form-control" name="CLiD" id="CLiD" READONLY style="width:280px; border-radius:0px;">
								<option  value="<?php echo "$fetch_All[classID]and$fetch_All[class_name]" ?>"><?php echo $fetch_All["class_name"];?></option>
							</select>
							</div>
						</td>
               </tr>
			   	<tr>
                        <td colspan="2"><strong><span class="text-success" style="font-size: 15px;"> Group Name</span></strong></td>
                        <td colspan="6"><div class="col-md-6">
									<select class="form-control" name="GRid" id="GRid" READONLY style="width:280px; border-radius:0px;">
                           <option  value="<?php echo "$fetch_All[groupID]and$fetch_All[group_name]" ?>"><?php echo $fetch_All["group_name"];?></option>
                        			</select>
						</div></td>
                    </tr>
				 	<tr>
                        <td colspan="2"><strong><span class="text-success" style="font-size: 15px;">Subject Type</span></strong></td>
                        <td colspan="6"><div class="col-md-6"><select class="form-control" name="subTy" id="subTy" READONLY style="width:280px; border-radius:0px;">
                           <option  value="<?php echo "$fetch_All[subjectId]" ?>"><?php echo $fetch_All["select_subject_type"];?></option>
                        </select></div></td>
                    </tr>
					<tr>
                        <td colspan="2"><strong><span class="text-success" style="font-size: 15px;">Subject Name</span></strong></td>
                        <td colspan="6"><div class="col-md-6"><select class="form-control" name="subNa" id="subNa" READONLY style="width:280px; border-radius:0px;">
                            <option  value="<?php echo "$fetch_All[subjectId]" ?>"><?php echo $fetch_All["subject_name"];?></option>
                        </select></div></td>
                    </tr>
					<tr>
                        <td colspan="2"><strong><span class="text-success" style="font-size: 15px;">Subject Code</span></strong></td>
                        <td colspan="6"><div class="col-md-6"><select class="form-control" name="subCo" id="subCo" READONLY style="width:280px; border-radius:0px;"> <option  value="<?php echo "$fetch_All[subjectId]" ?>"><?php echo $fetch_All["subject_code"];?></option>
                           	
                        </select></div></td>
                    </tr>
					<tr>
                        <td colspan="2"><strong><span class="text-success" style="font-size: 15px;">Subject Part Name</span></strong></td>
                        <td colspan="6"><div class="col-md-6"><select class="form-control" name="subPna" id="subPna" READONLY style="width:280px; border-radius:0px;">
                           <option  value="<?php echo "$fetch_All[subPartId]" ?>"><?php echo $fetch_All["subject_part_name"];?></option>
                        </select></div></td>
                    </tr>
					<tr>
                        <td colspan="2"><strong><span class="text-success" style="font-size: 15px;">Subject Part Code</span></strong></td>
                        <td colspan="6"><div class="col-md-6"><select class="form-control" name="subPaC" id="subPaC" READONLY style="width:280px; border-radius:0px;">
						 <option  value="<?php echo "$fetch_All[subPartId]" ?>"><?php echo $fetch_All["subject_part_code"];?></option>
                           
                        </select></div></td>
                    </tr>
					<tr>
                        <td colspan="2"><strong><span class="text-success" style="font-size: 15px;">Session</span></strong></td>
                        <td colspan="6"><div class="col-md-6"><select class="form-control" name="seSs" id="seSs" READONLY style="width:280px; border-radius:0px;"><option  value="<?php echo $session; ?>"><?php echo $session;?></option>
                           
                        </select></div></td>
                    </tr>
</table>
<table class="table table-responsive table-bordered table-hover" style="margin-top: -20px">
            <tr>
              <td colspan="10" align="center"><label for="from" class="text-warning">Roll No -</label>
                <input type="text"  name="from" id="from" value="<?php echo $fromss ?>"   style="width:120px; background:#F7071D; border:none; font-weight:bold; color:#fff; height:25px;  text-align:center;">
-
<label for="to" class="text-warning">To Roll No - </label>
<input type="text" name="to" id="to" value="<?php  echo $toss;?>"  style="width:120px; background:#F7071D; border:none; font-weight:bold; color:#fff; height:25px;
text-align:center;"/>

<input type='button'  onClick="return showChekTo()" class='btn btn-success btn-sm' value='Search' />

</td>
            </tr>
			<tr>
              <td width="5%" rowspan="2" align="center">&nbsp;<strong><span class="text-justify text-danger">SL NO</span></strong></td>
              <td width="12%" rowspan="2" align="center">&nbsp;<strong><span class="text-justify text-danger">Name</span></td>
              <td width="11%" rowspan="2" align="center">&nbsp;<strong><span class="text-justify text-danger">Student Roll</span></td>
              <td width="10%" rowspan="2" align="center">&nbsp;<strong><span class="text-justify text-danger">Full Mark</span></td>
              <td colspan="4" align="center">&nbsp;<strong><span class="text-justify text-danger">Marks</span></td>
              <td width="9%" rowspan="2" align="center">&nbsp;<strong><span class="text-justify text-danger">Obtain Marks</span></td>
              <td width="9%" rowspan="2" align="center">&nbsp;<strong><span class="text-justify text-danger">Letter Grade</span></td>
            </tr>
            <tr>
              <td width="11%" align="center">&nbsp;<strong><span class="text-justify text-danger">Cont. Asses. </span></td>
              <td width="11%" align="center">&nbsp;<strong><span class="text-justify text-danger">Creative</span></td>
              <td width="10%" align="center">&nbsp;<strong><span class="text-justify text-danger">MCQ</span></td>
              <td width="11%" align="center">&nbsp;<strong><span class="text-justify text-danger">Parctical</span></td>
              
            </tr>
		
			<?php
					if($part_name == "NULL"){
						
							if(!empty($fromss) and !empty($toss)){
							//print "coll";
								
					
							
								 $showAll="SELECT `running_student_info`.*,`subject_registration_table`.`subject_id`,`student_personal_info`.`student_name`,`subject_information`.`subjectId`,`ContAss`,`Creative`,`MCQ`,`practical`,`total`,
	`student_acadamic_information`.`session2` FROM `running_student_info` JOIN `subject_registration_table` ON `subject_registration_table`.`std_id`=`running_student_info`.`student_id`
	JOIN `student_personal_info` ON `student_personal_info`.`id`=`running_student_info`.`student_id` JOIN `subject_information` ON `subject_information`.`subjectId`=`subject_registration_table`.`subject_id`
	JOIN `student_acadamic_information` ON `student_acadamic_information`.`id`=`running_student_info`.`student_id` WHERE `running_student_info`.`class_id`='$className[0]'
	AND `running_student_info`.`group_id`='$groupname[0]' AND `subject_registration_table`.`subject_id`='$sub_name' AND `subject_information`.`examID`='$examtype[0]' AND `subject_information`.`subjectId`='$sub_name'  AND `student_acadamic_information`.`session2`='$session' AND `running_student_info`.`class_roll` 
	BETWEEN $fromss AND $toss GROUP BY `running_student_info`.`student_id`  ORDER BY `running_student_info`.`class_roll` ASC";
//print $showAll;
						$chek_all=$db->select_query($showAll);
							
							}
							else 
							
							{
							 $showAll="SELECT `running_student_info`.*,`subject_registration_table`.`subject_id`,`student_personal_info`.`student_name`,`subject_information`.`subjectId`,`ContAss`,`Creative`,`MCQ`,`practical`,`total`,
`student_acadamic_information`.`session2` FROM `running_student_info` JOIN `subject_registration_table` ON `subject_registration_table`.`std_id`=`running_student_info`.`student_id`
JOIN `student_personal_info` ON `student_personal_info`.`id`=`running_student_info`.`student_id` JOIN `subject_information` ON `subject_information`.`subjectId`=`subject_registration_table`.`subject_id`
JOIN `student_acadamic_information` ON `student_acadamic_information`.`id`=`running_student_info`.`student_id` WHERE `running_student_info`.`class_id`='$className[0]'
AND `running_student_info`.`group_id`='$groupname[0]' AND `subject_registration_table`.`subject_id`='$sub_name' AND `subject_information`.`examID`='$examtype[0]' AND `subject_information`.`subjectId`='$sub_name'  AND `student_acadamic_information`.`session2`='$session'
GROUP BY `running_student_info`.`student_id` ORDER BY `running_student_info`.`class_roll` ASC LIMIT 0,30";
						$chek_all=$db->select_query($showAll);
						}
					
					}else{
					if(!empty($fromss) and !empty($toss)){
					//print "done";
						 $showAll="SELECT `running_student_info`.*,`subject_registration_table`.`subject_id`,`student_personal_info`.`student_name`,`subject_information`.`subjectId`,`subPartId`,`ContAss`,`Creative`,`MCQ`,`practical`,`total`,
`student_acadamic_information`.`session2` FROM `running_student_info` JOIN `subject_registration_table` ON `subject_registration_table`.`std_id`=`running_student_info`.`student_id`
JOIN `student_personal_info` ON `student_personal_info`.`id`=`running_student_info`.`student_id` JOIN `subject_information` ON `subject_information`.`subjectId`=`subject_registration_table`.`subject_id`
JOIN `student_acadamic_information` ON `student_acadamic_information`.`id`=`running_student_info`.`student_id` WHERE `running_student_info`.`class_id`='$className[0]'
AND `running_student_info`.`group_id`='$groupname[0]' AND `subject_registration_table`.`subject_id`='$sub_name' AND `subject_information`.`examID`='$examtype[0]' AND `subject_information`.`subjectId`='$sub_name' AND `subject_information`.`subPartId`='$part_name'  AND `student_acadamic_information`.`session2`='$session' AND `running_student_info`.`class_roll` BETWEEN $fromss AND $toss GROUP BY `running_student_info`.`student_id` ORDER BY `running_student_info`.`class_roll` ASC";
	$chek_all=$db->select_query($showAll);
	//print_r()
							
							}
							else 
							
							{
						 $showAll="SELECT `running_student_info`.*,`subject_registration_table`.`subject_id`,`student_personal_info`.`student_name`,`subject_information`.`subjectId`,`subPartId`,`ContAss`,`Creative`,`MCQ`,`practical`,`total`,
`student_acadamic_information`.`session2` FROM `running_student_info` JOIN `subject_registration_table` ON `subject_registration_table`.`std_id`=`running_student_info`.`student_id`
JOIN `student_personal_info` ON `student_personal_info`.`id`=`running_student_info`.`student_id` JOIN `subject_information` ON `subject_information`.`subjectId`=`subject_registration_table`.`subject_id`
JOIN `student_acadamic_information` ON `student_acadamic_information`.`id`=`running_student_info`.`student_id` WHERE `running_student_info`.`class_id`='$className[0]'
AND `running_student_info`.`group_id`='$groupname[0]' AND `subject_registration_table`.`subject_id`='$sub_name' AND `subject_information`.`examID`='$examtype[0]' AND `subject_information`.`subjectId`='$sub_name' AND `subject_information`.`subPartId`='$part_name'  AND `student_acadamic_information`.`session2`='$session'
GROUP BY `running_student_info`.`student_id` ORDER BY `running_student_info`.`class_roll` ASC LIMIT 0,30";
	$chek_all=$db->select_query($showAll);
	}
					}
					if($chek_all){
					$sl=0;
					global $count;
					$count=0;
					while($fetch_show_alll=$chek_all->fetch_array()){
					//print_r($fetch_show_alll);
							if($part_name == "NULL"){
							  $fetchOldRecord ="SELECT `Count_Ass`,`Creative`,`Mcq`,`Practical`,`obtainMark`,`LetterGrade`,`GradePoint` FROM `marksheet` WHERE `STudentID`='".$fetch_show_alll["student_id"]."' AND 
`StudentRoll`='".$fetch_show_alll["class_roll"]."' AND `ClassId`='".$fetch_show_alll["class_id"]."' AND `GroupID`='".$fetch_show_alll["group_id"]."'  AND `SubjectId`='".$fetch_show_alll["subject_id"]."' AND `ExamId` ='".$examtype[0]."'";
							
							}else {
								  $fetchOldRecord ="SELECT `Count_Ass`,`Creative`,`Mcq`,`Practical`,`obtainMark`,`LetterGrade`,`GradePoint` FROM `marksheet` WHERE `STudentID`='".$fetch_show_alll["student_id"]."' AND 
`StudentRoll`='".$fetch_show_alll["class_roll"]."' AND `ClassId`='".$fetch_show_alll["class_id"]."' AND `GroupID`='".$fetch_show_alll["group_id"]."'  AND `SubjectId`='".$fetch_show_alll["subject_id"]."' AND `SubjectPartID`='".$fetch_show_alll["subPartId"]."' AND `ExamId` ='".$examtype[0]."'";
							}
							$resultOldrecor=$db->select_query($fetchOldRecord);
							if($resultOldrecor){
								$fetoldrec=$resultOldrecor->fetch_array();
								
							}else{
								
								$fetoldrec["Count_Ass"] ="";
								$fetoldrec["Creative"] ="";
								$fetoldrec["Mcq"] ="";
								$fetoldrec["Practical"] ="";
								$fetoldrec["obtainMark"] ="";
								$fetoldrec["LetterGrade"] ="";
							}
						
			$sl++;
			$count++;
			
			?>
			
			<tr>
                        <td align="center"><strong><span class="text-success"><?php  echo $sl;?></span></strong>
                        <input type="hidden" name="stdid[]" id="stdid[]" value="<?php  echo $fetch_show_alll["student_id"];?>" ></input>
                        </td>
                         <td align="center"><strong><span class="text-success"><?php  echo $fetch_show_alll["student_name"];?></span></strong>
                       
                        </td>
                         <td align="center"><strong><span class="text-success"><?php echo $fetch_show_alll["class_roll"];?></span></strong>
                        <input type="hidden" name="stdrole[]" id="stdrole[]" value="<?php  echo $fetch_show_alll["class_roll"];?>"></input>
                        </td>
                        <td align="center"><strong><span class="text-success"><?php  echo $fetch_show_alll["total"]; ?></span></strong>
                        <input type="hidden" name="fullmark[]" id="fullmark-<?php  echo $sl;?>" value="<?php  echo $fetch_show_alll["total"];?>" ></input>
                        </td>
                        <td align="center">
                          <input type="text" style="width: 70px; border-radius:0px; text-align:center" autocomplete="off" onkeyup="calculate(<?php  echo $sl;?>)"   class="form-control" name="counAssMark[]" id="counAssMark-<?php  echo $sl;?>" value="<?php echo $fetoldrec["Count_Ass"];?>"  placeholder="<?php echo $fetch_show_alll["ContAss"];?>"></input>
                          <input type="hidden" name="counAss[]" id="counAss-<?php  echo $sl;?>" value="<?php echo $fetch_show_alll["ContAss"];?>"></input>
                        </td>
                        <td align="center">
                          <input type="text" style="width: 70px; border-radius:0px; text-align:center"  autocomplete="off" onkeyup="calculate(<?php  echo $sl;?>)" class="form-control" name="CreaTiveMark[]" id="CreaTiveMark-<?php  echo $sl;?>" placeholder="<?php echo $fetch_show_alll["Creative"];?>"  value="<?php echo $fetoldrec["Creative"];?>" ></input>
                          <input type="hidden" name="Creative[]" id="Creative-<?php  echo $sl;?>" value="<?php echo $fetch_show_alll["Creative"];?>"></input>
                        </td>
                         <td align="center">
                          <input type="text" style="width: 70px; border-radius:0px; text-align:center"  autocomplete="off" onkeyup="calculate(<?php  echo $sl;?>)" class="form-control" name="MeqMark[]" id="MeqMark-<?php  echo $sl;?>" placeholder="<?php echo $fetch_show_alll["MCQ"];?>"  value="<?php echo $fetoldrec["Mcq"];?>" ></input>
                          <input type="hidden" name="Mcq[]" id="Mcq-<?php  echo $sl;?>" value="<?php echo $fetch_show_alll["MCQ"];?>"></input>
                        </td>
                         <td align="center">
                          <input type="text" style="width: 70px; border-radius:0px; text-align:center" autocomplete="off" onkeyup="calculate(<?php  echo $sl;?>)"  class="form-control" name="practicalMark[]" id="practicalMark-<?php  echo $sl;?>" placeholder="<?php echo $fetch_show_alll["practical"];?>"  value="<?php echo $fetoldrec["Practical"];?>" ></input>
                          <input type="hidden" name="practical[]" id="practical-<?php  echo $sl;?>" value="<?php echo $fetch_show_alll["practical"];?>"></input>
                        </td>
                        <td><input  type="text" readonly="" name="obtainmark[]" id="obtainmark-<?php  echo $sl;?>" class="form-control" style="width: 70px; border-radius:0px; text-align:center"  value="<?php echo $fetoldrec["obtainMark"];?>"   ></input></td>
                        <td><input type="text"  readonly="" name="lettergrade[]" id="lettergrade-<?php  echo $sl;?>" class="form-control" style="width: 70px; border-radius:0px; text-align:center"  value="<?php echo $fetoldrec["LetterGrade"];?>" ></input></td>
                        
                      </tr>
					  <?php } } ?>
					  <tr>
					   <?php if($count==0){?>
				 <tr><td colspan="11">	<span class="text-danger" style="font-size:18px"><strong><a href='#' onclick='return GoBackPage()'>No Student Have Found,Go Back</a></strong></span></td></tr>
				 <?php } ?>
			
			
			<tr>
                <td class="danger" colspan="10" bgcolor="#dddddd" align="center"><span id="sms">
                    
                </span> </td>
            </tr>
				 <tr>
				  <td colspan="10"  align="center">
				  <input type="hidden" value="<?php echo $count ;?>" id="countValue" />
				  <input type="button" name="add" value="SAVE" class="btn btn-success btn-sm" style="width: 80px;" onclick="return AddMarksheet()"></input>
     
                  <input type="reset" name="reset"  value="RELOAD" class="btn btn-danger btn-sm"   style="width: 100px;"style="width: 80px;" onclick="return alreset()"></input>
                 </td>
			 </tr>
		
</table>





 <?php }?>


