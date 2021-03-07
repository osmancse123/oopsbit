  <?php
	error_reporting(1);
	require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
	date_default_timezone_set("Asia/Dhaka");
	$db = new database();
	
	$className =explode('and',$_POST["className"]);
	$groupname = explode('and',$_POST["groupname"]);
	$examtype = explode('and',$_POST["examtype"]);
	$session=$_POST["session"];
	$toss = $_POST["toss"];
	$fromss = $_POST["fromss"];
	$sqlforTitle="SELECT `institute_name` FROM `project_info`";
	$chke=$db->select_query($sqlforTitle);
	if($chke){
			$fetch_tiitle=$chke->fetch_array();
	}
	
	
	 $sql1="SELECT `marksheet`.*,`add_class`.`class_name`,`add_group`.`group_name`,`exam_type_info`.`exam_type`
FROM `marksheet` JOIN `add_class` ON `add_class`.`id`=`marksheet`.`ClassId` JOIN `add_group` ON `add_group`.`id`=`marksheet`.`GroupID`
JOIN   `exam_type_info` ON `exam_type_info`.`exam_id`=`marksheet`.`ExamId`
WHERE `marksheet`.`ClassId`='$className[0]' AND `marksheet`.`ExamId`='$examtype[0]' AND `marksheet`.`GroupID`='$groupname[0]'  AND `marksheet`.`Session`='$session'";

  $count="SELECT `marksheet`.*,`add_class`.`class_name`,`add_group`.`group_name`,`exam_type_info`.`exam_type`
FROM `marksheet` JOIN `add_class` ON `add_class`.`id`=`marksheet`.`ClassId` JOIN `add_group` ON `add_group`.`id`=`marksheet`.`GroupID`
JOIN   `exam_type_info` ON `exam_type_info`.`exam_id`=`marksheet`.`ExamId`
WHERE `marksheet`.`ClassId`='$className[0]' AND `marksheet`.`ExamId`='$examtype[0]' AND `marksheet`.`GroupID`='$groupname[0]'  AND `marksheet`.`Session`='$session' GROUP BY `marksheet`.`STudentID`";

$chek1=$db->select_query($sql1);
 
 if($chek1){
 	$fetchAll=$chek1->fetch_array();
	
 }



$check2=$db->select_query($count);
 
 if($check2){
 	 	$count1=$check2->num_rows;
	
 }



?>
<table class="table table-responsive table-bordered table-hover" style="margin-top:10px;">
			<tr>
			  <td ><input type="button" name="back" id="back" value="BACK" onclick="return bakpage()" class="btn btn-sm btn-danger" /></td><td align="center" colspan="11"><STRONG><span style="padding-left:0px; font-size:18px;" class="text-uppercase text-success text-muted"><?php echo $fetch_tiitle["institute_name"];?></span></STRONG></td>
			</tr>
			
			<tr style="font-size:15px">
				<div class="col-md-6 col-lg-6">
					<td colspan="4" style="width:15px;"><strong class="text-success"><span style="padding-left:10px">Class Name</span></strong></td>
					<td width="93" align=""><strong class="text-success"><span style="padding-left:10px">:</span></strong></td>
					<td colspan="2" align=""><strong class="text-success"><span style="padding-left:10px"><?php  echo $fetchAll["class_name"];?></span></strong></td>
				</div>	
				<div class="col-md-6 col-lg-6" >
					<td colspan="2"><strong class="text-success"><span style="padding-left:10px">Group Name</span></strong></td>
					<td width="21"><span style="padding-left:10px"><strong class="text-success">:</strong></span></td>
					<td width="286" colspan="2"><strong class="text-success"><span style="padding-left:10px"><?php  echo $fetchAll["group_name"];?></span></strong></td>
				</div>	
    		</tr>
			<tr  style="font-size:15px">
				<div class="col-md-6 col-lg-6">
					<td colspan="4" style="width:15px;"><strong class="text-success"><span style="padding-left:10px">Exam Name</span></strong></td>
					<td><span style="padding-left:10px"><strong class="text-success">:</strong></span></td>
					<td colspan="2"><strong class="text-success"><span style="padding-left:10px"><?php  echo $fetchAll["exam_type"];?></span></strong></td>
				</div>	
				<div class="col-md-6 col-lg-6">
					<td colspan="2"><span style="padding-left:10px"><strong class="text-success">Session</strong></span></td>
					<td width="21"><span style="padding-left:10px"><strong class="text-success">:</strong></span></td>
					<td colspan="2"><span style="padding-left:10px"><strong class="text-success"><?php  echo $fetchAll["Session"];?></strong></span></td>
				</div>	
    		</tr>
			<tr align="" style="font-size:15px">
				<div class="col-md-6 col-lg-6">
					<td colspan="4" style="width:15px;"><strong class="text-success"><span style="padding-left:10px">Total Students</span></strong></td>
					<td><span style="padding-left:10px"><strong class="text-success">:</strong></span></td>
					<td colspan="2"><strong class="text-success"><span style="padding-left:10px">
					
					<?php echo $count1; ?></span></strong></td>
				</div>	
    		</tr>
			</strong>
		 <tr>
              <td height="35" colspan="12" align="center"><label for="from" class="text-warning">Roll No -</label>
                <input type="text"  name="from" id="from" value="<?php echo $fromss ?>"   style="width:120px; background:#F7071D; border:none; font-weight:bold; color:#fff; height:25px;  text-align:center;">
-
<label for="to" class="text-warning">To Roll No - </label>
<input type="text" name="to" id="to" value="<?php  echo $toss;?>"  style="width:120px; background:#F7071D; border:none; font-weight:bold; color:#fff; height:25px;  text-align:center;" />
	<input type="button" value="Search" onclick="return showChekTo()" />
</td>
            </tr>
			
			<tr>
              <td width="47" height="50" align="center">&nbsp;<strong><span class="text-justify text-info">SL NO</span></strong></td>
              <td width="42" colspan="1" align="center">&nbsp; <strong><span class="text-justify text-info">Name</span></td>
              <td colspan="2" align="center">&nbsp; <strong><span class="text-justify text-info"> Roll</span></td>
              <td colspan="2"  align="center">&nbsp; <strong><span class="text-justify text-info">Total Reg Subject</span> </td>
              <td width="155" align="center">&nbsp;  <strong><span class="text-justify text-info">Marks Completed Subject</span></td>
              <td colspan="4" align="center">&nbsp;<strong><span class="text-justify text-info">Details</span></td>
		    </tr>
            
			<?php
			if(!empty($fromss) and !empty($toss)){
					$query1="SELECT `marksheet`.* ,`student_personal_info`.`student_name` FROM `marksheet` INNER JOIN `student_personal_info` ON `student_personal_info`.`id`=`marksheet`.`STudentID`    WHERE `ClassId`='$className[0]' AND `GroupID`='$groupname[0]' AND `ExamId`='$examtype[0]'  AND `marksheet`.`StudentRoll` BETWEEN $fromss AND $toss  GROUP BY `marksheet`.`STudentID` ORDER BY `marksheet`.`StudentRoll`  ASC";
					//print($query1);
						$check_query=$db->select_query($query1);
					
					}else {
					
						$query1="SELECT `marksheet`.* ,`student_personal_info`.`student_name` FROM `marksheet` INNER JOIN `student_personal_info` ON `student_personal_info`.`id`=`marksheet`.`STudentID`    WHERE `ClassId`='$className[0]' AND `GroupID`='$groupname[0]' AND `ExamId`='$examtype[0]' AND  `Session`='$session'  GROUP BY `marksheet`.`STudentID`  ORDER BY `marksheet`.`StudentRoll`  ASC LIMIT 0,20";
						$check_query=$db->select_query($query1);
					}
						
					if($check_query){
					$sl=0;
					$count2=0;
						while($fetch_query=$check_query->fetch_array())
						{
						$sl++;
						$count2++;
							?>
			
					<tr>
              <td width="47" height="89"  align="center">&nbsp;<strong><?php echo $count2;?></strong></td>
              <td width="42" colspan="1"  align="center"> <strong><?php echo $fetch_query['student_name'];?></strong></td>
              <td  colspan="2" align="center">&nbsp; <strong> <?php echo $fetch_query['StudentRoll'];?></strong></td>
			  	<td colspan="2"  align="center">&nbsp;
				
				
					<strong><?php
				
						 $totalRegSub = "SELECT COUNT(`subject_id`) FROM `subject_registration_table` WHERE `std_id`='".$fetch_query["STudentID"]."' AND `class_id`='$className[0]' AND `group_id`='$groupname[0]'";
						$TresultReg = $db->select_query($totalRegSub);
						if($TresultReg){
							 $fetchRegsub = $TresultReg->fetch_array();
							   $fetchRegsub[0];
						}
						
					$totalpart = "SELECT count(`add_subject_part_info`.`part_id`) FROM `subject_registration_table`
INNER JOIN `add_subject_part_info` ON `add_subject_part_info`.`subject_name` = `subject_registration_table`.`subject_id`
 WHERE `subject_registration_table`.`std_id`='".$fetch_query["STudentID"]."' AND `subject_registration_table`.`class_id`='$className[0]' AND `subject_registration_table`.`group_id`='$groupname[0]'
AND `add_subject_part_info`.`exam_type`='$examtype[0]' GROUP BY `add_subject_part_info`.`subject_name`";
									$resultchekpart =  $db->select_query($totalpart);
								if($resultchekpart){
							 $totalpart = $resultchekpart->fetch_array();
							
						}
								 
								  
						
						
						print  $totalsub = $fetchRegsub[0]+$totalpart[0];
						
						
				?></strong>
				</td>
				<td width="155"  align="center">&nbsp; <strong>
					<?php
					
						  $resultforComplete = "SELECT COUNT(`SubjectId`) FROM `marksheet` WHERE `STudentID`='".$fetch_query["STudentID"]."' AND `ClassId`='$className[0]' AND `GroupID`='$groupname[0]' AND `ExamId`='$examtype[0]' AND `Session`='$session'";
						$rrsss =  $db->select_query($resultforComplete);
						if($rrsss){
							 $fetcComp = $rrsss->fetch_array();
							   $fetcComp[0];
						}
						
						
							   $rrsss1 = "SELECT * FROM `marksheet` WHERE `STudentID`='".$fetch_query["STudentID"]."' AND `ClassId`='$className[0]' AND `GroupID`='$groupname[0]' AND `ExamId`='$examtype[0]' AND `Session`='$session'";
						$resultrsss =  $db->select_query($rrsss1);
						if($resultrsss){
									while($fetchResultRsssFf = $resultrsss->fetch_array()){
							
										  	 $selectpartRess = "SELECT * FROM marksheet  WHERE  `STudentID`='".$fetchResultRsssFf['STudentID']."' AND `ClassId`='$className[0]' AND `GroupID`='$groupname[0]' AND `ExamId`='$examtype[0]' AND `Session`='$session' AND  `SubjectId`='".$fetchResultRsssFf['SubjectId']."'";
											$forrrrrr =  $db->select_query($rrsss1);
											
												if($forrrrrr){
														while($resultforrrrr = $forrrrrr->fetch_array()){
																if($resultforrrrr["SubjectPartID"] != ""){
																	$numrows = $resultforrrrr->num_rows;
																}
														
														}
												}
									}
								
						}
					print 	$totalsssss =  $fetcComp[0] + $numrows ;
						
						
					?>
				</strong></td>
              <td colspan="4"  align="center">&nbsp;
                <table width="636" border="1" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="118" align="center">&nbsp;</td>
                    <td width="194" align="center">Comp.</td>
                    <td width="209" align="center">Group.</td>
                    <td width="105" align="center">Opt.</td>
                  </tr>
                  <tr>
                    <td align="center">Reg Sub </td>
                    <td height="21">&nbsp;
					<?php
					
						  $showSubjectCom = "SELECT `subject_registration_table`.*,`add_subject_info`.`subject_code` FROM `subject_registration_table`  INNER JOIN `add_subject_info` ON `add_subject_info`.`id` = `subject_registration_table`.`subject_id` where  subject_registration_table.`std_id`='".$fetch_query["STudentID"]."' AND subject_registration_table.`class_id`='$className[0]' AND subject_registration_table.`group_id`='$groupname[0]' AND `add_subject_info`.`select_subject_type`='CompulsorySubject'";	
					 	$resulShowSubjectcom = $db->select_query($showSubjectCom);
						if($resulShowSubjectcom){
						
						while($fetchShowSubCom =$resulShowSubjectcom->fetch_array()){
						
						
						
						
					 	$chekpart = "SELECT * FROM `add_subject_part_info` WHERE `exam_type`='$examtype[0]' AND `subject_name`='".$fetchShowSubCom["subject_id"]."' AND `class_id`='$className[0]' AND `group_id`='$groupname[0]'";
								$resultchekpart =  $db->select_query($chekpart);
								if($resultchekpart->num_rows > 0)
								{
									while($fetchForPar = $resultchekpart->fetch_array()){
									print $fetchForPar["subject_part_code"].',';
									}
								}else {
								print $fetchShowSubCom['subject_code'].',';
								}
								
						}
						
								
						}
						
						
					?>					</td>
                    <td>&nbsp;
					<?php
					
						  $showSubjectGrop = "SELECT `subject_registration_table`.*,`add_subject_info`.`subject_code` FROM `subject_registration_table`  INNER JOIN `add_subject_info` ON `add_subject_info`.`id` = `subject_registration_table`.`subject_id` where  subject_registration_table.`std_id`='".$fetch_query["STudentID"]."' AND subject_registration_table.`class_id`='$className[0]' AND subject_registration_table.`group_id`='$groupname[0]' AND `add_subject_info`.`select_subject_type`='GroupSubject'";	
					 	$resulShowSubjectgrop = $db->select_query($showSubjectGrop);
						if($resulShowSubjectgrop){
						
						while($fetchShowSubGoryup =$resulShowSubjectgrop->fetch_array()){
						
						
						
						
					 	$chekpartGroyp = "SELECT * FROM `add_subject_part_info` WHERE `exam_type`='$examtype[0]' AND `subject_name`='".$fetchShowSubGoryup["subject_id"]."' AND `class_id`='$className[0]' AND `group_id`='$groupname[0]'";
								$resultchgroyp=  $db->select_query($chekpartGroyp);
								if($resultchgroyp->num_rows > 0)
								{
								while($fetchForParGrop = $resultchgroyp->fetch_array()){
									print $fetchForParGrop["subject_part_code"].',';
									}
								}else {
								print $fetchShowSubGoryup['subject_code'].',';
								}
								
						}
						
								
						}
						
						
					?>
						
						
						
					</td>
                    <td>&nbsp;
					<?php
					
						  $showSubjectOpt = "SELECT `subject_registration_table`.*,`add_subject_info`.`subject_code` FROM `subject_registration_table`  INNER JOIN `add_subject_info` ON `add_subject_info`.`id` = `subject_registration_table`.`subject_id` where  subject_registration_table.`std_id`='".$fetch_query["STudentID"]."' AND subject_registration_table.`class_id`='$className[0]' AND subject_registration_table.`group_id`='$groupname[0]' AND `add_subject_info`.`select_subject_type`='OptionalSubject'";	
					 	$resbuOption = $db->select_query($showSubjectOpt);
						if($resbuOption){
						
						while($fetchoptional =$resbuOption->fetch_array()){
						
						
						
						
					  	$chekOptional = "SELECT * FROM `add_subject_part_info` WHERE `exam_type`='$examtype[0]' AND `subject_name`='".$fetchoptional["subject_id"]."' AND `class_id`='$className[0]' AND `group_id`='$groupname[0]'";
								$resultOptional=  $db->select_query($chekOptional);
								if($resultOptional->num_rows > 0)
								{
								while($fetchOptionalkkd = $resultOptional->fetch_array()){
									print $fetchOptionalkkd["subject_part_code"].',';
									}
								}else {
								print $fetchoptional['subject_code'];
								}
							
						}
						
								
						}
						
						
					?>
					
					
					</td>
                  </tr>
				    <tr>
				      <td align="center">Marks Entry Com </td>
                    <td height="21">&nbsp;
					
						<?php
						
						  	$compleSubject = "SELECT `marksheet`.*,`add_subject_info`.`subject_code`  FROM `marksheet`
						 INNER JOIN `add_subject_info` ON `add_subject_info`.`id`=`marksheet`.`SubjectId`
						  WHERE `marksheet`.`STudentID`='".$fetch_query["STudentID"]."' AND `marksheet`.`ClassId`='$className[0]' AND `marksheet`.`GroupID`='$groupname[0]' AND `marksheet`.`ExamId`='$examtype[0]' AND `marksheet`.`Session`='$session'   AND `add_subject_info`.`select_subject_type`='CompulsorySubject'  GROUP BY `marksheet`.`SubjectId`";
						  $resultComSubjCom = $db->select_query($compleSubject);
						if($resultComSubjCom){
						
						while($fetchComSubcom =$resultComSubjCom->fetch_array()){
						
								  $selecComSubCompar = "SELECT `marksheet`.*,`add_subject_part_info`.`subject_part_code` FROM `marksheet`
INNER JOIN `add_subject_part_info`
 ON  `marksheet`.`SubjectPartID`=`add_subject_part_info`.`part_id`
WHERE `marksheet`.`SubjectId`='".$fetchComSubcom["SubjectId"]."' AND `marksheet`.`STudentID`='".$fetch_query["STudentID"]."' AND `marksheet`.`ClassId`='$className[0]' AND `marksheet`.`GroupID`='$groupname[0]' AND `marksheet`.`ExamId`='$examtype[0]' AND `marksheet`.`Session`='$session'";

	 $rescuComParNo = $db->select_query($selecComSubCompar);
						if($rescuComParNo->num_rows > 0){
								while($fethcpartNOel=$rescuComParNo->fetch_array()){
								print $fethcpartNOel['subject_part_code'].',';
								}
						}else{
							print $fetchComSubcom['subject_code'].',';
						}
						
						}
						
						}
						?>					  </td>
                    <td>&nbsp;
					<?php
						
						 	$compleSubjectG = "SELECT `marksheet`.*,`add_subject_info`.`subject_code`  FROM `marksheet`
						 INNER JOIN `add_subject_info` ON `add_subject_info`.`id`=`marksheet`.`SubjectId`
						  WHERE `marksheet`.`STudentID`='".$fetch_query["STudentID"]."' AND `marksheet`.`ClassId`='$className[0]' AND `marksheet`.`GroupID`='$groupname[0]' AND `marksheet`.`ExamId`='$examtype[0]' AND `marksheet`.`Session`='$session'   AND `add_subject_info`.`select_subject_type`='GroupSubject' GROUP BY `marksheet`.`SubjectId`";
						  $resublComSubG = $db->select_query($compleSubjectG);
						if($resublComSubG){
						
						while($fetchConSbug =$resublComSubG->fetch_array()){
						
								 $selComSubGP = "SELECT `marksheet`.*,`add_subject_part_info`.`subject_part_code` FROM `marksheet`
INNER JOIN `add_subject_part_info`
 ON  `marksheet`.`SubjectPartID`=`add_subject_part_info`.`part_id`
WHERE `marksheet`.`SubjectId`='".$fetchConSbug["SubjectId"]."' AND `marksheet`.`STudentID`='".$fetch_query["STudentID"]."' AND `marksheet`.`ClassId`='$className[0]' AND `marksheet`.`GroupID`='$groupname[0]' AND `marksheet`.`ExamId`='$examtype[0]' AND `marksheet`.`Session`='$session'";

	 $resulconSubGp = $db->select_query($selComSubGP);
						if($resulconSubGp->num_rows > 0){
								while($fetchConMSubGp=$resulconSubGp->fetch_array()){
								print $fetchConMSubGp['subject_part_code'].',';
								}
						}else{
							print $fetchConSbug['subject_code'].',';
						}
						
						}
						
						}
						?>
						
						
					</td>
                    <td>&nbsp;
					<?php
						
						 	$conmPUsOpat = "SELECT `marksheet`.*,`add_subject_info`.`subject_code`  FROM `marksheet`
						 INNER JOIN `add_subject_info` ON `add_subject_info`.`id`=`marksheet`.`SubjectId`
						  WHERE `marksheet`.`STudentID`='".$fetch_query["STudentID"]."' AND `marksheet`.`ClassId`='$className[0]' AND `marksheet`.`GroupID`='$groupname[0]' AND `marksheet`.`ExamId`='$examtype[0]' AND `marksheet`.`Session`='$session'   AND `add_subject_info`.`select_subject_type`='OptionalSubject' GROUP BY `marksheet`.`SubjectId`";
						  $resulCpoParS = $db->select_query($conmPUsOpat);
						if($resulCpoParS){
						
						while($fetchConPaospt =$resulCpoParS->fetch_array()){
						
								  $selConGposkhtj = "SELECT `marksheet`.*,`add_subject_part_info`.`subject_part_code` FROM `marksheet`
INNER JOIN `add_subject_part_info`
 ON  `marksheet`.`SubjectPartID`=`add_subject_part_info`.`part_id`
WHERE `marksheet`.`SubjectId`='".$fetchConPaospt["SubjectId"]."' AND `marksheet`.`STudentID`='".$fetch_query["STudentID"]."' AND `marksheet`.`ClassId`='$className[0]' AND `marksheet`.`GroupID`='$groupname[0]' AND `marksheet`.`ExamId`='$examtype[0]' AND `marksheet`.`Session`='$session'";

	 $resulConGpPar = $db->select_query($selConGposkhtj);
						if($resulConGpPar->num_rows > 0){
								while($fetchConGppar=$resulConGpPar->fetch_array()){
								print $fetchConGppar['subject_part_code'].',';
								}
						}else{
							print $fetchConPaospt['subject_code'];
						}
						
						}
						
						}
						?>
						
						
					</td>
                  </tr>
                </table>
                <strong>&nbsp;<strong></td>
			  </tr>
			  
			  <?php 
			  } }
			  ?>
			
			  <?php if($count2==0){?>
				 <tr><td colspan="11">	<span class="text-danger" style="font-size:18px"><strong><a href='#' onclick='return GoBackPage()'>No Student Have Found,Go Back</a></strong></span></td></tr>
				 <?php } ?>
			
			
			
			<tr>
				<td colspan="12" align="center"><input type="button" name="print" value="Print" onclick="return printpage()" class="btn btn-danger btn-sm" id="print" /></td>
			</tr>
</table> 
