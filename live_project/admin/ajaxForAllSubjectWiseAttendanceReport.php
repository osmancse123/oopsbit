<?php

	require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
	date_default_timezone_set("Asia/Dhaka");
	$db = new database();
	
			

?>

<table class="table table-bordered table-responsive" style="margin-top:0px; margin-bottom:0px">
		<?php
				if(isset($_POST["selectClass"]) and $_POST["selectClass"] !="Select Class" and isset($_POST["selectGroup"]) and $_POST["selectGroup"] !="" and $_POST["fromdate"] !="" and  isset($_POST["fromdate"]) and $_POST["todate"] !="" and isset($_POST["todate"])  and  isset($_POST["stdId"]) and $_POST["stdId"] !=""){
				$groupId=explode('and',$_POST["selectGroup"]);
				
						 $sqlFor1st="SELECT `studentpresent`.*,`student_personal_info`.`student_name` FROM `studentpresent`
INNER JOIN `student_personal_info` ON `student_personal_info`.`id`=`studentpresent`.`StudentID`
WHERE `studentpresent`.`StudentID`='".$_POST["stdId"]."' AND `studentpresent`.`classID`='".$_POST["selectClass"]."' AND `studentpresent`.`GroupID`='$groupId[0]' 
AND `studentpresent`.`date` BETWEEN '".$_POST["fromdate"]."' AND '".$_POST["todate"]."' GROUP BY `studentpresent`.`StudentID`";
						$resultFor1st=$db->select_query($sqlFor1st);
							if(@$resultFor1st->num_rows>0){
							
									$fetFor1stsql=$resultFor1st->fetch_array();
									
									 $forColspan="SELECT * FROM `studentpresent` WHERE `StudentID`='".$_POST["stdId"]."' AND `classID`='".$_POST["selectClass"]."' AND `GroupID`='$groupId[0]' AND `date` BETWEEN  '".$_POST["fromdate"]."' AND '".$_POST["todate"]."' GROUP BY `studentpresent`.`date`";
				$resultColspan=$db->select_query($forColspan);
					if($resultColspan->num_rows>0){
							while($fetColspan=$resultColspan->fetch_array()){
											$forSubjectName="SELECT * FROM `studentpresent` WHERE  `date`='".$fetColspan["date"]."' AND `StudentID`='".$fetColspan["StudentID"]."'";
						$FrosubjecResult=$db->select_query($forSubjectName);
							if(@$FrosubjecResult->num_rows>0){	
							$sl=0;
							$colspan=4;
									while($fetchForREsult=$FrosubjecResult->fetch_array()){
										if($fetchForREsult["SubjectPartId"]=='NULL'){
										$sl++;
										 $colspan=$colspan+1;
									}else {
										$sl++;
										 $colspan=$colspan+1;
										
									}
									}}
							
							}
							
							}
		?>
				
				<tr>
				  <td colspan="<?php echo $colspan;?>" align="center">&nbsp;<span><strong class="text-capitalize text-success" style="font-size:14px" >From  27-09-2016  To  30-09-2016  Date List Of Student's Attendance</strong></span></td>
				</tr>
				<tr>
				  <td colspan="<?php echo $colspan;?>"  align="center">&nbsp;<span><strong class="text-capitalize text-success" style="font-size:14px" >Class Name &nbsp;:
		<?php
		
				 $ForClsAndGrop="SELECT `studentpresent`.`classID`,`add_class`.`class_name`,`add_group`.`group_name` FROM `studentpresent`
INNER JOIN `add_class` ON `add_class`.`id`=`studentpresent`.`classID` INNER JOIN `add_group`
ON `add_group`.`id`=`studentpresent`.`GroupID` WHERE `studentpresent`.`classID`='".$_POST["selectClass"]."' AND `studentpresent`.`GroupID`='$groupId[0]' AND  `studentpresent`.`StudentID`='".$_POST["stdId"]."'
GROUP BY `studentpresent`.`GroupID`";
				$ResultForcls=$db->select_query($ForClsAndGrop);
					if($ResultForcls->num_rows>0){
							$FetchForClss=$ResultForcls->fetch_array();
					}
		?>
		&nbsp;<?php 
				if(isset($ResultForcls)){ echo $FetchForClss["class_name"];} else {echo "";}
		?>&nbsp;  Group Name &nbsp: &nbsp;<?php 
				if(isset($ResultForcls)){ echo $FetchForClss["group_name"];} else {echo "";}
		?> &nbsp; </strong></span></td>
		
		
		
		</tr>
				<tr>
				  <td colspan="<?php echo $colspan;?>" align="center">&nbsp;<span><strong class="text-capitalize text-info" style="font-size:14px" >Student Name &nbsp;:&nbsp;<?php
						echo $fetFor1stsql["student_name"];
						
						?>  &nbsp;&nbsp; &nbsp;&nbsp; Roll No&nbsp;:&nbsp;<?php
						echo $fetFor1stsql["RollNo"];
						
						?> </strong></span></td>
				</tr>
				
				<?php
			   $forDate="SELECT * FROM `studentpresent` WHERE `StudentID`='".$_POST["stdId"]."' AND `classID`='".$_POST["selectClass"]."' AND `GroupID`='$groupId[0]' AND `date` BETWEEN  '".$_POST["fromdate"]."' AND '".$_POST["todate"]."' GROUP BY `studentpresent`.`date`";
				$ResulDate=$db->select_query($forDate);
					if($ResulDate->num_rows>0){
							while($fetDAte=$ResulDate->fetch_array()){
		?>
				<tr>
				  <td width="115" rowspan="5" align="center"><br/><br/><br/><br/><?php echo $fetDAte["date"];?></td>
				  <td colspan="2" align="center">Serial NO </td>
				 <?php
				 		    $forSubjectName="SELECT * FROM `studentpresent` WHERE  `date`='".$fetDAte["date"]."' AND `StudentID`='".$fetDAte["StudentID"]."'";
						$FrosubjecResult=$db->select_query($forSubjectName);
							if(@$FrosubjecResult->num_rows>0){	
							$sl=0;
							$colspan=0;
									while($fetchForREsult=$FrosubjecResult->fetch_array()){
										if($fetchForREsult["SubjectPartId"]=='NULL'){
										$sl++;
										$colspan=$colspan+1;
									}else {
										$sl++;
										$colspan=$colspan+1;
										
									}
									 
										
				 
				 ?>
				 
				  
				  <td width="983" align="center">&nbsp;<?php echo $sl;?></td>
				  <?php  } }?>
  </tr>
				<tr>
				  <td colspan="2" align="center">Subject Name </td>
				  <?php
				  
				  		$ResulForName=$db->select_query($forSubjectName);
								if(@$ResulForName->num_rows>0){
										while($fetchName=$ResulForName->fetch_array()){
				  ?>
				  
				  <td>&nbsp;
				  			<strong><?php 
									if($fetchName["SubjectPartId"]=='NULL'){
												$selectsubjectName="SELECT * FROM `add_subject_info` WHERE `id`='".$fetchName["subjectID"]."'";
												$resultsubecxtName=$db->select_query($selectsubjectName);
														if($resultsubecxtName->num_rows>0){
																$fetcSubjecName=$resultsubecxtName->fetch_array();
																}
																echo $fetchSubjecPart["subject_part_name"]="";
																 echo $fetchSubjecPart["subject_part_code"]="";
											
											echo $fetcSubjecName["subject_name"].'('.$fetcSubjecName["subject_code"].')';
									}else{
									
										echo $fetcSubjecName["subject_name"]="";
										echo $fetcSubjecName["subject_code"]="";
										
												$selectSubjecPartID="SELECT * FROM `add_subject_part_info` WHERE `part_id`='".$fetchName["SubjectPartId"]."'";
													$ResulSUbjePart=$db->select_query($selectSubjecPartID);
														if(@$ResulSUbjePart->num_rows>0){
																$fetchSubjecPart=$ResulSUbjePart->fetch_array();
																}
										echo $fetchSubjecPart["subject_part_name"].'('.$fetchSubjecPart["subject_part_code"].')';
									}
							?></strong>
				  </td>
				  
				  <?php  } }?>
  </tr>
				<tr>
				  <td width="102" rowspan="2"><br/>Absence</td>
				  <td width="81">Approved</td>
				  <?php
				  
				  		$resultForApproved=$db->select_query($forSubjectName);
							if(@$resultForApproved->num_rows>0){
							$TotalApp=0;
									while($fetchForApprove=$resultForApproved->fetch_array()){
				  ?>
				  
				  <td align="center">&nbsp;
				  		<?php
						
								if($fetchForApprove["onvacation"]=='1'){
								
						?>
						<span class='text-center text-success glyphicon glyphicon-ok'></span>
						<?php } else {?>
						
						<span class='text-center text-danger glyphicon glyphicon-remove'></span>

						<?php
						        } ?>
				  </td>
				  
				  <?php  } }?>
  </tr>
				<tr>
				  <td>Unpproved</td>
				   <?php
				  
				  		$resultForUnapproved=$db->select_query($forSubjectName);
							if(@$resultForUnapproved->num_rows>0){
									while($fetchForUnapp=$resultForUnapproved->fetch_array()){
				  ?>
				  
				  <td align="center">&nbsp;
				  
				  	<?php
						
								if($fetchForApprove["absent"]=='1'){
						?>
						<span class='text-center text-success glyphicon glyphicon-ok'></span>
						<?php } else {?>
						
						<span class='text-center text-danger glyphicon glyphicon-remove'></span>

						<?php
						        } ?>
				  </td>
				  
				  <?php  } }?>
  </tr>
				<tr>
				  <td colspan="2" align="center">Attendance</td>
				  <?php
				  
				  		$resultForAttendance=$db->select_query($forSubjectName);
							if(@$resultForAttendance->num_rows>0){
									while($fetForAttendance=$resultForAttendance->fetch_array()){
				  ?>
				  
				 
				  <td align="center">&nbsp;
				    	<?php
						
								if($fetForAttendance["present"]=='1'){
						?>
						<span class='text-center text-success glyphicon glyphicon-ok'></span>
						<?php } else {?>
						
						<span class='text-center text-danger glyphicon glyphicon-remove'></span>

						<?php
						        } ?>
				  </td>
				  <?php  } }?>
				
				</tr>
				
				<?php  } } ?>
				  <tr>
				  	<td colspan="10" align="center">
							<input type="submit" name="print" id="print" value="Print" onclick="window.print()"/>					</td>
				  </tr>
				<?php } else {?>
				<tr>
					<td colspan="9" align="center">&nbsp;<span><strong class="text-capitalize text-danger" style="font-size:14px" >Not Found..</strong></span></td>
				</tr>
				<?php } ?>
				<?php } else {?>
		<tr>
				<td colspan="9" align="center">&nbsp;<span><strong class="text-capitalize text-danger" style="font-size:14px" >Please Fill Up Important Fields..</strong></span></td>
		</tr>
		<?php } ?>
</table>

				
				
				