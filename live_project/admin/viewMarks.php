  <?php
	error_reporting(1);
	require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
	date_default_timezone_set("Asia/Dhaka");
	$db = new database();
	
	$className =explode('and',$_POST["className"]);
	$groupname = explode('and',$_POST["groupname"]);
	$examtype = explode('and',$_POST["examtype"]);
	$subject_type = $_POST["subject_type"];
	$sub_name = $_POST["sub_name"];
	$part_name = $_POST["part_name"];
	$session=$_POST["session"];
	$toss = $_POST["toss"];
	$fromss = $_POST["fromss"];
	$sqlforTitle="SELECT `institute_name` FROM `project_info`";
	$chke=$db->select_query($sqlforTitle);
	if($chke){
			$fetch_tiitle=$chke->fetch_array();
	}
	
	if($part_name ==  "NULL"){
	$sql1="SELECT `marksheet`.*,`add_class`.`class_name`,`add_group`.`group_name`,`add_subject_info`.`subject_name`,`subject_code`,`select_subject_type`,
`subject_information`.`ContAss`,`subject_information`.`Creative`,`subject_information`.`total`,`subject_information`.`MCQ`,`subject_information`.`practical`,`exam_type_info`.`exam_type`
FROM `marksheet` JOIN `add_class` ON `add_class`.`id`=`marksheet`.`ClassId` JOIN `add_group` ON `add_group`.`id`=`marksheet`.`GroupID`
JOIN `add_subject_info` ON `add_subject_info`.`id`=`marksheet`.`SubjectId` JOIN `subject_information` ON `subject_information`.`subjectId`=`marksheet`.`SubjectId` 
JOIN `exam_type_info` ON `exam_type_info`.`exam_id`=`marksheet`.`ExamId`
WHERE `marksheet`.`ClassId`='$className[0]' AND `marksheet`.`ExamId`='$examtype[0]' AND `marksheet`.`GroupID`='$groupname[0]'  AND `marksheet`.`SubjectId`='$sub_name' AND `marksheet`.`Session`='$session'";
$chek1=$db->select_query($sql1);

}  else {
 $sql1="SELECT `marksheet`.*,`add_class`.`class_name`,`add_group`.`group_name`,`add_subject_info`.`subject_name`,`subject_code`,`select_subject_type`,
`add_subject_part_info`.`subject_part_name`,`subject_part_code`,`subject_information`.`ContAss`,`subject_information`.`Creative`,`subject_information`.`MCQ`,`subject_information`.`total`,`subject_information`.`practical`,`exam_type_info`.`exam_type`
FROM `marksheet` JOIN `add_class` ON `add_class`.`id`=`marksheet`.`ClassId` JOIN `add_group` ON `add_group`.`id`=`marksheet`.`GroupID`
JOIN `add_subject_info` ON `add_subject_info`.`id`=`marksheet`.`SubjectId` JOIN `add_subject_part_info` ON `add_subject_part_info`.`part_id`=`marksheet`.`SubjectPartID`
JOIN `subject_information` ON `subject_information`.`subjectId`=`marksheet`.`SubjectId` AND `marksheet`.`SubjectPartID`=`subject_information`.`subPartId`
JOIN `exam_type_info` ON `exam_type_info`.`exam_id`=`marksheet`.`ExamId` WHERE `marksheet`.`ClassId`='$className[0]' AND `marksheet`.`ExamId`='$examtype[0]' AND `marksheet`.`GroupID`='$groupname[0]'  AND `marksheet`.`SubjectId`='$sub_name' AND `marksheet`.`Session`='$session' AND `marksheet`.`SubjectPartID`='$part_name'";
	$chek1=$db->select_query($sql1);

 }
 
 if($chek1){
 	$fetchAll=$chek1->fetch_array();
	
 }

?>
<table class="table table-responsive table-bordered table-hover" style="margin-top:10px;">
			<tr>
				<td ><input type="button" name="back" id="back" value="BACK" onclick="return bakpage()" class="btn btn-sm btn-danger" /></td><td align="center" colspan="11"><STRONG><span style="padding-left:0px; font-size:18px;" class="text-uppercase text-success text-muted"><?php echo $fetch_tiitle["institute_name"];?></span></STRONG></td>
			
			</tr>
			
			<tr style="font-size:15px">
				<div class="col-md-6 col-lg-6">
					<td colspan="2" style="width:15px;"><strong class="text-success"><span style="padding-left:10px">Class Name</span></strong></td>
					<td align=""><strong class="text-success"><span style="padding-left:10px">:</span></strong></td>
					<td colspan="4" align=""><strong class="text-success"><span style="padding-left:10px"><?php  echo $fetchAll["class_name"];?></span></strong></td>
				</div>	
				<div class="col-md-6 col-lg-6" >
					<td colspan="2"><strong class="text-success"><span style="padding-left:10px">Group Name</span></strong></td>
					<td width="95"><span style="padding-left:10px"><strong class="text-success">:</strong></span></td>
					<td colspan="2"><strong class="text-success"><span style="padding-left:10px"><?php  echo $fetchAll["group_name"];?></span></strong></td>
				</div>	
    		</tr>
			<tr  style="font-size:15px">
				<div class="col-md-6 col-lg-6">
					<td colspan="2" style="width:15px;"><strong class="text-success"><span style="padding-left:10px">Exam Name</span></strong></td>
					<td><span style="padding-left:10px"><strong class="text-success">:</strong></span></td>
					<td colspan="4"><strong class="text-success"><span style="padding-left:10px"><?php  echo $fetchAll["exam_type"];?></span></strong></td>
				</div>	
				<div class="col-md-6 col-lg-6">
					<td colspan="2"><span style="padding-left:10px"><strong class="text-success">Session</strong></span></td>
					<td width="95"><span style="padding-left:10px"><strong class="text-success">:</strong></span></td>
					<td colspan="2"><span style="padding-left:10px"><strong class="text-success"><?php  echo $session;?></strong></span></td>
				</div>	
    		</tr>
			<tr align="" style="font-size:15px">
				<div class="col-md-6 col-lg-6">
					<td colspan="2" style="width:15px;"><strong class="text-success"><span style="padding-left:10px">Subject Name</span></strong></td>
					<td><span style="padding-left:10px"><strong class="text-success">:</strong></span></td>
					<td colspan="4"><strong class="text-success"><span style="padding-left:10px">
					
					<?php  if($part_name == "NULL") {
								echo $fetchAll["subject_name"];
								 }
						else {
							echo $fetchAll["subject_part_name"]; 
						}
						?></span></strong></td>
				</div>	
				<div class="col-md-6 col-lg-6">
					<td colspan="2"><span style="padding-left:10px"><strong class="text-success">Subject Code</strong></span></td>
					<td width="95"><span style="padding-left:10px"><strong class="text-success">:</strong></span></td>
					<td colspan="2"><strong class="text-success"><span style="padding-left:10px"><?php
						  if($part_name == "NULL") {
								echo $fetchAll["subject_code"];
								 }
						else {
							echo $fetchAll["subject_part_code"]; 
						}
						
					?></span></strong></td>
				</div>	
    		</tr>
			</strong>
		 <tr>
              <td colspan="12" align="center"><label for="from" class="text-warning">Roll No -</label>
                <input type="text"  name="from" id="from" value="<?php echo $fromss ?>"   style="width:120px; background:#F7071D; border:none; font-weight:bold; color:#fff; height:25px;  text-align:center;">
-
<label for="to" class="text-warning">To Roll No - </label>
<input type="text" name="to" id="to" value="<?php  echo $toss;?>"  style="width:120px; background:#F7071D; border:none; font-weight:bold; color:#fff; height:25px;  text-align:center;" onchange="return showChekTo()"  onkeyup="return showChekTo()"/>
</td>
            </tr>
			
			
			<tr>
              <td width="62" rowspan="2" align="center">&nbsp;<strong><span class="text-justify text-info">SL NO</span></strong></td>
              <td width="138" rowspan="2" align="center">&nbsp; <strong><span class="text-justify text-info">Name</span></td>
              <td width="65" rowspan="2" align="center">&nbsp; <strong><span class="text-justify text-info"> Roll</span></td>
              <td width="72" rowspan="2" align="center">&nbsp; <strong><span class="text-justify text-info">Full Mark</span></td>
              <td colspan="4" align="center">&nbsp; <strong><span class="text-justify text-info">Marks</span></td>
              <td width="95" rowspan="2" align="center">&nbsp; <strong><span class="text-justify text-info">Obtain Marks</span></td>
              <td width="153" rowspan="2" align="center">&nbsp;<strong><span class="text-justify text-info">Letter Grade</span></td>
			  <td width="147" rowspan="2" align="center">&nbsp;<strong><span class="text-justify text-info">Grade Point</span></td>
			   <td width="147" rowspan="2" align="center">&nbsp;<strong><span class="text-justify text-info">Action</span></td>
            </tr>
            <tr>
              <td width="166" align="center">&nbsp;<strong><span class="text-justify text-info">Cont. Asses.<br/>(<?php echo $fetchAll["ContAss"];?>) </span></td>
              <td width="132" align="center">&nbsp;<strong><span class="text-justify text-info">Creative
			  <br/>(<?php echo $fetchAll["Creative"];?>)</span></td>
              <td width="65" align="center">&nbsp;<strong><span class="text-justify text-info">MCQ<br/>(<?php echo $fetchAll["MCQ"];?>)</span></td>
              <td width="121" align="center">&nbsp;<strong><span class="text-justify text-info">Parctical<br/>(<?php echo $fetchAll["practical"];?>)</span></td>
              
            </tr>
			
			<?php
					if($part_name == "NULL"){
					if(!empty($fromss) and !empty($toss)){
					$query1="SELECT `marksheet`.* ,`student_personal_info`.`student_name` FROM `marksheet` INNER JOIN `student_personal_info` ON `student_personal_info`.`id`=`marksheet`.`STudentID`    WHERE `ClassId`='$className[0]' AND `GroupID`='$groupname[0]' AND `ExamId`='$examtype[0]' AND `SubjectId`='$sub_name' AND `Session`='$session' AND `marksheet`.`StudentRoll` BETWEEN $fromss AND $toss ORDER BY `marksheet`.`StudentRoll`  ASC";
					//print($query1);
						$check_query=$db->select_query($query1);
					
					}else {
					
						$query1="SELECT `marksheet`.* ,`student_personal_info`.`student_name` FROM `marksheet` INNER JOIN `student_personal_info` ON `student_personal_info`.`id`=`marksheet`.`STudentID`    WHERE `ClassId`='$className[0]' AND `GroupID`='$groupname[0]' AND `ExamId`='$examtype[0]' AND `SubjectId`='$sub_name' AND `Session`='$session' ORDER BY `marksheet`.`StudentRoll`  ASC ";
						$check_query=$db->select_query($query1);
					}
						
					}else {
					if(!empty($fromss) and !empty($toss)){
						$query1="SELECT `marksheet`.* ,`student_personal_info`.`student_name` FROM `marksheet` INNER JOIN `student_personal_info` ON `student_personal_info`.`id`=`marksheet`.`STudentID`    WHERE `ClassId`='$className[0]' AND `GroupID`='$groupname[0]' AND `ExamId`='$examtype[0]' AND `SubjectId`='$sub_name' AND `SubjectPartID`='$part_name' AND `Session`='$session' AND     `marksheet`.`StudentRoll` BETWEEN $fromss AND $toss
						ORDER BY `marksheet`.`StudentRoll`  ASC";
						//print($query1);
					$check_query=$db->select_query($query1);
						}
						else {
						
						$query1="SELECT `marksheet`.* ,`student_personal_info`.`student_name` FROM `marksheet` INNER JOIN `student_personal_info` ON `student_personal_info`.`id`=`marksheet`.`STudentID`    WHERE `ClassId`='$className[0]' AND `GroupID`='$groupname[0]' AND `ExamId`='$examtype[0]' AND `SubjectId`='$sub_name' AND `SubjectPartID`='$part_name' AND `Session`='$session' ORDER BY `marksheet`.`StudentRoll`  ASC";
					$check_query=$db->select_query($query1);
						}	
					}
			
					
					
					
					if($check_query){
					$sl=0;
					$count=0;
						while($fetch_query=$check_query->fetch_array())
						{
						$sl++;
						$count++;
							?>
	<!--						<tr>
              <td width="62" rowspan="2" align="center">&nbsp;<strong><span class="text-justify text-success"><?php echo $sl;?></span></strong></td>
              <td width="138" rowspan="2" align="center">&nbsp; <strong><span class="text-justify text-success"><?php echo $fetch_query["student_name"];?></span></td>
              <td width="65" rowspan="2" align="center">&nbsp; <strong><span class="text-justify text-success"> <?php echo $fetch_query["StudentRoll"];?></span></td>
              <td width="72" rowspan="2" align="center">&nbsp; <strong><span class="text-justify text-success"><?php echo $fetchAll["total"];?></span></td>
              <td colspan="4" align="center">&nbsp; <strong><span class="text-justify text-info">Marks Details</span></td>
              <td width="95" rowspan="2" align="center">&nbsp; <strong><span class="text-justify text-success"><?php echo $fetch_query["obtainMark"];?></span></td>
              <td width="153" rowspan="2" align="center">&nbsp;<strong><span class="text-justify text-success"><?php echo $fetch_query["LetterGrade"];?></span></td>
			  <td width="147" rowspan="2" align="center">&nbsp;<strong><span class="text-justify text-success"><?php echo $fetch_query["GradePoint"];?></span></td>
            </tr>
            <tr>
              <td width="166" align="center">&nbsp;<strong><span class="text-justify text-success"><?php echo $fetch_query["Count_Ass"];?> </span></td>
              <td width="132" align="center">&nbsp;<strong><span class="text-justify text-success"><?php echo $fetch_query["Creative"];?></span></td>
              <td width="65" align="center">&nbsp;<strong><span class="text-justify text-success"><?php echo $fetch_query["Mcq"];?></span></td>
              <td width="121" align="center">&nbsp;<strong><span class="text-justify text-success"><?php echo $fetch_query["Practical"];?></span></span></td>
              
            </tr>-->
					<tr id="tr-<?php  echo $fetch_query["STudentID"];?>">
              <td width="62"  align="center">&nbsp;<strong><span class="text-justify text-success"><?php echo $sl;?></span></strong></td>
              <td width="138"  align="center">&nbsp; <strong><span class="text-justify text-success"><?php echo $fetch_query["student_name"];?></span></td>
              <td width="65"  align="center">&nbsp; <strong><span class="text-justify text-success"> <?php echo $fetch_query["StudentRoll"];?></span></td>
			  	<td width="72"  align="center">&nbsp; <strong><span class="text-justify text-success"><?php echo $fetchAll["total"];?></span></td>
				<td width="72"  align="center">&nbsp; <strong><span class="text-justify text-success"><?php echo $fetch_query["Count_Ass"];?></span></td>
				<td width="72"  align="center">&nbsp; <strong><span class="text-justify text-success"><?php echo $fetch_query["Creative"];?></span></td>
				<td width="72"  align="center">&nbsp; <strong><span class="text-justify text-success"><?php echo $fetch_query["Mcq"];?></span></td>
				<td width="72"  align="center">&nbsp; <strong><span class="text-justify text-success"><?php echo $fetch_query["Practical"];?></span></td>
				 <td width="95"  align="center">&nbsp; <strong><span class="text-justify text-success"><?php echo $fetch_query["obtainMark"];?></span></td>
              <td width="153"  align="center">&nbsp;<strong><span class="text-justify text-success"><?php echo $fetch_query["LetterGrade"];?></span></td>
			  <td width="147"  align="center">&nbsp;<strong><span class="text-justify text-success"><?php echo $fetch_query["GradePoint"];?></span></td>
			  <td width="147"  align="center">&nbsp;<strong><span class="text-justify text-success">
			  
			  <input type="hidden" id="clsid-<?php echo $fetch_query["STudentID"];?>" value="<?php echo $fetch_query["ClassId"];?>" />
			  <input type="hidden" id="gpid-<?php echo $fetch_query["STudentID"];?>" value="<?php echo $fetch_query["GroupID"];?>" />
			  <input type="hidden" id="ExamId-<?php echo $fetch_query["STudentID"];?>" value="<?php echo $fetch_query["ExamId"];?>" />
			 <input type="hidden" id="SubjectId-<?php echo $fetch_query["STudentID"];?>" value="<?php echo $fetch_query["SubjectId"];?>" /> 
			  <input type="hidden" id="SubjectPartID-<?php echo $fetch_query["STudentID"];?>" value="<?php echo $fetch_query["SubjectPartID"];?>" />  
			 <input type="hidden" id="Session-<?php echo $fetch_query["STudentID"];?>" value="<?php echo $fetch_query["Session"];?>" />  
			 
			  <input type="button" name="delete" class="btn btn-sm btn-danger" onClick="return deleteBYid('<?php echo $fetch_query["STudentID"]; ?>')"  value="Delete" /></span></td>
			  </tr>
			
							
							<?php 
						
						}
					}	
					
			?>
			
			<tr>
					   <?php if($count==0){?>
				 <tr><td colspan="12>	<span class="text-danger" style="font-size:18px"><strong><a href='#' onclick='return GoBackPage()'>No Student Have Found,Go Back</a></strong></span></td></tr>
				 <?php } ?>
			
			
			<tr>
			<tr>
				<td colspan="12" align="center"><input type="button" name="print" value="Print" onclick="return printpage()" class="btn btn-danger btn-sm" id="print" /></td>
			</tr>
		
</table> 